<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Events extends Controller_Acl{
	
	public function action_index(){
		
	}
	
	public function action_typeslist(){

		$this->template->content = View::factory('typeslist.tpl');
		$types_orm = new Model_Events_Type();
		$this->template->content->types = $types_orm->find_all()->as_array();

	}

	public function action_eventslist(){

		$this->template->content = View::factory('eventslist.tpl');
		$events_orm = new Model_Event();
		$this->template->content->events = $events_orm->find_all()->as_array();

	}

	public function action_eventadd(){

		if (($data = $this->request->post('event')) !== null){
			$event = new Model_Event();
			$data['tags'] = sprintf('{%s}', $data['tags']);
			$event->values($data);
			$event->save();

			if ($_FILES){
				$images = $_FILES;
				$data['images'] = $this->_save_images_for_event($event->id, $images);
				$data['images'] = serialize($data['images']);
			}

			$this->request->redirect('/events/eventslist/');
			
		}

		$this->template->content = View::factory('eventedit.tpl');

		$types_orm = new Model_Events_Type();
		$this->template->content->types = $types_orm->find_all()->as_array();

	}
	
	public function action_eventedit(){
		
		$id = $this->request->param('id');
		
		$event = new Model_Event($id);
		if (!$event->loaded()){
			$this->request->redirect('/events/eventslist/');
		}
		$event->images = unserialize($event->images);
		if (($data = $this->request->post('event')) !== null){
			if ($_FILES){
				$images = $_FILES;
				if (!is_array($event->images)){
					$event->images = array();
				}
				$data['images'] = $this->_save_images_for_event($event->id, $images);
				$data['images'] = array_merge_recursive($event->images, $data['images']);		
				$data['images'] = serialize($data['images']);
			}
			$data['tags'] = sprintf('{%s}', $data['tags']);
			$event->values($data);
			$event->save();
			$this->request->redirect('/events/eventslist/');
		}

		$event->tags = trim($event->tags, '{}');
		$event->tags = str_replace('"', '', $event->tags);

		$this->template->content = View::factory('eventedit.tpl');
		$this->template->content->event = $event;

		$types_orm = new Model_Events_Type();
		$this->template->content->types = $types_orm->find_all()->as_array();

	}

	public function action_typeadd(){

		
		if (($data = $this->request->post('type')) !== null){
			$type = new Model_Events_Type();
			$type->values($data);
			$type->save();
			$this->request->redirect('/events/typeslist/');
		}
				
		$this->template->content = View::factory('typeform.tpl');
		
	}
	
	public function action_typeedit(){
		
		$id = $this->request->param('id');
		$type = new Model_Events_Type($id);
		if (!$type->loaded()){
			$this->request->redirect('/events/eventslist/');
		}
		
		if (($data = $this->request->post('type')) !== null){
			$type->values($data);
			$type->save();
			$this->request->redirect('/events/typeslist/');
		}
		
		$this->template->content = View::factory('typeform.tpl');
		$this->template->content->type = $type;

	}
	
	private function _save_images_for_event($event_id, $data){

		$uploads_dir = DOCROOT . 'uploads/events/id' . $event_id ;
		if (!is_dir($uploads_dir)){
			mkdir($uploads_dir, 0755, true);
		}
		$path = '/uploads/events/id' . $event_id;
		$images = array(); 
		foreach ($data["images"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$tmp_name = $data["images"]["tmp_name"][$key];
				$name = $data["images"]["name"][$key];
				$images[$key] = $path . '/' . $name;
				move_uploaded_file($tmp_name, "$uploads_dir/$name");
			}else if(is_array($error)){
				$images[$key] = array();
				foreach ($error as $_key => $_error) {
					if ($_error == UPLOAD_ERR_OK) {
						$_name = $data["images"]["name"][$key][$_key];
						$_tmp_name = $data["images"]["tmp_name"][$key][$_key];
						$images[$key][$_key] = $path . '/' . $_name;
						move_uploaded_file($_tmp_name, "$uploads_dir/$_name");
					}
				}
			}
		}
		return $images;

	}
	
}