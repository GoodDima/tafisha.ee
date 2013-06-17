<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Acl extends Controller_Abstract{

	private static $_permissions = array();
	private static $_session_field_name = 'acl';

	public function before(){

		if (!$this->user || !self::access_allowed($this->user->id)){
			$this->request->redirect('/denied');
		}

		parent::before();

	}

	static private function access_allowed($user_id){

		$controller = Request::current()->controller();
		$action = Request::current()->action();

		$raw_permissions = Session::instance()->get(self::$_session_field_name,false);
		if ($raw_permissions === false){
			self::_prepare_permissions($user_id);
		 	Session::instance()->set(self::$_session_field_name,serialize(self::$_permissions));
		}else{
			self::$_permissions = unserialize($raw_permissions);
		}

	 	return self::_check_permissions($controller, $action);

	}

	static public function check($controller, $action){

		return self::_check_permissions($controller, $action);

	}

	static public function check_any($controller, $actions){
		if (!is_array($actions)){
			return false;
		}

		for ($i = 0, $n = sizeof($actions); $i < $n; $i++){
			if (self::_check_permissions($controller, $actions[$i])){
				return true;
			}
		}
		return false;

	}

	static public function check_all($controller, $actions){
		if (!is_array($actions)){
			return false;
		}

		for ($i = 0, $n = sizeof($actions); $i < $n; $i++){
			if (!self::_check_permissions($controller, $actions[$i])){
				return false;
			}
		}
		return true;

	}

	static public function check_controller($controller){

		return self::_check_controller($controller);

	}


	static private function _prepare_permissions($user_id){
		// should be cached in future

		$sql =  'SELECT ap.* FROM roles_users AS aur '
			.   'INNER JOIN roles_permissions AS arp USING (role_id) '
			.   'INNER JOIN permissions AS ap ON ( ap.id = arp.permission_id ) '
			.   'WHERE aur.user_id = %d '
			.   'GROUP BY ap.id, ap.name;';

		$sql =  sprintf(
			$sql,
			$user_id
		);

		$result_raw = DB::query(Database::SELECT, $sql)->execute()->as_array();
		
		self::$_permissions = array();

		for($i = 0, $n = sizeof($result_raw); $i < $n; $i++){
			$permission = explode('/', $result_raw[$i]['name']);
			$tmp_array = &self::$_permissions;
			foreach ($permission as $node){
				if (!array_key_exists($node, $tmp_array)){
					$tmp_array[$node] = array();
				}
				$tmp_array = &$tmp_array[$node];
			}
		}

		//return self::$_permissions;

	}


	static private function _check_permissions($controller, $action){

		if (array_key_exists('*', self::$_permissions)){
			return true;
		}

		if (
			array_key_exists($controller, self::$_permissions) &&
			(
				array_key_exists('*', self::$_permissions[$controller]) ||
				array_key_exists($action, self::$_permissions[$controller])
			)
			)
			{
				return true;
			}

		return false;

	}

	static private function _check_controller($controller){

		if (
			array_key_exists('*', self::$_permissions) ||
			array_key_exists($controller, self::$_permissions)
			){
				return true;
			}

		return false;

	}

	public static function permissions_get()
	{
		return self::$_permissions;
	}


}