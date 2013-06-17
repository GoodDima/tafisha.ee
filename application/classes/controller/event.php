<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Event extends Controller_Abstract{
	
	public $template = 'layouts/reference/empty.tpl';
	
	public function action_show(){
		
		$id = $this->request->param('id');
		$event = new Model_Event($id);
		if (!$event->loaded()){
			die('No event found');
		}
		$event->images = unserialize($event->images);

		$this->template->content = View::factory('event/show.tpl');
		$this->template->content->event = $event;

	}
	
}