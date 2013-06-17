<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Abstract{

	function action_index() {

		
		
		$view = View::factory('layouts/reference/index.tpl');
		$this->template->content = $view->render();
		
	}
	
	function action_index_tmp() {

	//	die($this->user);
	
//		$model = ORM::factory('Photo_Apparat', 4);
	
//		$model = $model->as_array();
	
		
		$view = View::factory('layouts/reference/index.tpl');
	
		$view->var = 'A variable';
	
//		$view->things = $model;
	

		$view->things = array(
		    'First'  => 'One',
		    'Second' => 'Two',
		    'Third'  => 'Three' );

	
	  // we can use the Smarty object if we want!
		$view->smarty()->assign('direct', 'Smarty');
	
		$this->template->title = 'Demo Page' ;
		$this->template->content = $view->render();
		$this->template->versions = array(
		    'smarty' => str_replace('Smarty-', '', Smarty::SMARTY_VERSION),
		    'kohana' => Kohana::VERSION . ' ' . Kohana::CODENAME,
		    'module' => Smarty_View::VERSION,
		    'php'    => phpversion(),
		    'server' => arr::get($_SERVER, 'SERVER_SOFTWARE'),
		);
	
	}
	
	
	function action_user() {
		
		$auth = Auth::instance();
		$auth->login($username, $password);
		
	}

}
