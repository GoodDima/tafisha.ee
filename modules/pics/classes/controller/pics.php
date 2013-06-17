<?php

class Controller_Pics extends Controller_Acl{

	static public $_sizes = array(
		array(1024, 1024),
		array(800, 800),
		array(400, 400),
		array(150, 150),
		array(60, 60),
	);
	
	static public $_aliases = array(
		'big' => 0,
		'normal' => 2,
		'small' => 4
	);
	
	public function action_list(){

		$pics_orm = new Model_Gallery();
		$this->template->content = View::factory('picslist.tpl');
		$this->template->content->galleries = $pics_orm->find_all()->as_array();

	}

	public function action_add(){

		$tag = $this->request->param('id');


		if (($data = $this->request->post('gallery')) !== null){
			$orm = new Model_Gallery();
			$orm->values($data);
			$orm->save();
			$this->request->redirect('/pics/list/');
		}

		$this->template->content = View::factory('galleryform.tpl');

		if ($tag){
			$orm = new Model_Gallery();
			$orm->tag = $tag;
			$this->template->content->gallery = $orm;
		}

	}

	public function action_edit(){

		$tag = $this->request->param('id');

		$orm = new Model_Gallery();
		$orm->where('tag', '=', $tag);
		$orm = $orm->find();
		if (($data = $this->request->post('gallery')) !== null){
			$orm->values($data);
			$orm->save();
			$this->request->redirect('/pics/list/');
		}

		if ($this->request->method() == Request::POST){
			if (isset($_FILES['picture'])){
				$sub_dir_name = $this->_save_image($_FILES['picture']);
				$item_orm = new Model_Gallery_Item();
				$item_orm->gallery_id = $orm->id;
				$item_orm->path = $sub_dir_name;
				$item_orm->save();
			}
		}

		$this->template->content = View::factory('galleryform.tpl');
		$this->template->content->gallery = $orm;

	}

	private function _save_image($image)
	{
		if (
		! Upload::valid($image) OR
		! Upload::not_empty($image) OR
		! Upload::type($image, array('jpg', 'jpeg', 'png', 'gif')))
		{
			return FALSE;
		}

		$sub_dir_name = strtolower(Text::random('alnum', 5)) . '/' . strtolower(Text::random('alnum', 5));
		$directory = sprintf('%suploads/%s/', DOCROOT, $sub_dir_name);

		mkdir($directory, 0755, true);

		if ($file = Upload::save($image, NULL, $directory))
		{

			foreach (self::$_sizes as $size){
				$filename = sprintf('%dx%d.jpg', $size[0], $size[1]);
				Image::factory($file)
					->resize($size[0], $size[1], Image::AUTO)
					->save($directory.$filename);
			}
			
			foreach (self::$_aliases as $alias => $key){
				
				symlink(
					sprintf('%s%dx%d.jpg', $directory, self::$_sizes[$key][0], self::$_sizes[$key][1]),
					sprintf('%s%s.jpg', $directory, $alias)
				);
				
			}

			// Delete the temporary file
			unlink($file);

			return $sub_dir_name;
		}

		return FALSE;
	}

}