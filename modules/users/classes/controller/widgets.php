<?php 

class Controller_Widgets extends Controller_Widget{

	public function action_menu(){

		echo View::factory('widget_menu.tpl');

	}

}