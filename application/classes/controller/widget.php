<?php 

class Controller_Widget extends Controller_Template{
	
	public function before()
	{

		$this->auto_render = FALSE;
		parent::before();

	}
	
}