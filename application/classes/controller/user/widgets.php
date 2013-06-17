<?php 

class Controller_User_Widgets extends Controller_Widget{

	public function action_userinfo(){

		$content = View::factory('user/widget/userinfo.tpl');
		$content->user = $this->user;
		echo $content;

	}

}