<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Users extends Controller_Acl{

	public function action_list(){
		
		$this->template->content = View::factory('list.tpl');
		$users_orm = new Model_User();
		$this->template->content->users = $users_orm->select()->limit(20)->find_all()->as_array();
		
		
	}

	public function action_edit(){

		$this->template->content = View::factory('edit.tpl');
		$id = $this->request->param('id');
		$user_orm = new Model_User($id);
		$this->template->content->user = $user_orm;
		
		

	}

	public function action_post(){

		if (($user = $this->request->post('user')) !== FALSE){

			$user_id = $this->request->post('user_id');
			$user_orm = new Model_User($user_id);
			$user_orm->values($user);
			$user_orm->save();

		}

		$this->request->redirect('/users/list/');

	}
	
}