<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller extends Kohana_Controller {

	private $_user = false;
	
	public function __get($name){
		
		if ($name == 'user'){
			if ($this->_user === false){
				$this->_user = $this->__get_user();
			}
			return $this->_user;
		}
		
	}
	
	private function __get_user(){

		return Auth::instance()->get_user();

	}

}
