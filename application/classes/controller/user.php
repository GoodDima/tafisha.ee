<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Controller_Abstract{
	
	public function action_index()
	{
		$this->template->content = View::factory('user/info.tpl');

		// Load the user information
		$user = Auth::instance()->get_user();

		// if a user is not logged in, redirect to login page
		if (!$user)
		{
			Request::current()->redirect('/user/login');
		}

//		$roles = $user->roles->find_all()->as_array();
		
//		var_dump($roles);

		$this->template->content->user=$user;
		
	}

	public function action_create()
	{
		$this->template->content = View::factory('user/create.tpl');

		if (HTTP_Request::POST == $this->request->method())
		{
			try {
				 
				// Create the user using form values
				$user = ORM::factory('user')->create_user($this->request->post(), array(
	                    'username',
	                    'password',
	                    'email'            
				));
				 
				// Grant user login role
				$user->add('roles', ORM::factory('role', array('name' => 'login')));
				 
				// Reset values so form is not sticky
				$_POST = array();
				 
				// Set success message
				$message = "You have added user '{$user->username}' to the database";
				 
			} catch (ORM_Validation_Exception $e) {
				 
				// Set failure message
				$message = 'There were errors, please see form below.';
				 
				// Set errors using custom messages
				$errors = $e->errors('models');
			}
			$this->template->content->errors = $errors;
			$this->template->content->message = $message;

		}
	}
	 
	public function action_login()
	{
		$this->template->content = View::factory('user/login.tpl');

		$message = '';

		if (HTTP_Request::POST == $this->request->method())
		{
			// Attempt to login user
			$remember = array_key_exists('remember', $this->request->post()) ? (bool) $this->request->post('remember') : FALSE;
			$user = Auth::instance()->login($this->request->post('username'), $this->request->post('password'), $remember);
			 
			// If successful, redirect user
			if ($user)
			{
				Request::current()->redirect('/user/index');
			}
			else
			{
				$message = 'Login failed';
			}
		}
		
		$this->template->content->message = $message;
		
	}
	
	public function action_logout()
	{
		// Log user out
		Auth::instance()->logout();
		Session::instance()->destroy();
		// Redirect to login page
		Request::current()->redirect('/user/login');
	}

	public function action_restore(){

		$this->template->content = View::factory('user/restore.tpl');

		if (HTTP_Request::POST == $this->request->method())
		{

			$data = $this->request->post();

			$user = ORM::factory('user')->where('email', '=', $data['email'])->find();
			
			if (!$user->loaded()){
				$message = 'No email found in our DB.';
			}else{
				$restore = ORM::factory('users_restore_attempt');
				$restore->hash = md5($user->id . '' . time());
				$restore->user_id = $user->id;
				$restore->save();

				$email = View::factory('user/restore_email.tpl');
				$email->hash = $restore->hash;
				$email = $email->render();

				Email::connect();
				Email::send($data['email'], 'do-not-reply@morfe.ru', 'Tafisha password restore', $email, true);
				$message = 'Message sent to your email.';

			}

		}

		$this->template->content->message = $message;

	}

	public function action_restore_hash(){

		$this->template->content = View::factory('user/restore_hash.tpl');

		$hash = $this->request->param('id');

		$this->template->content->hash = $hash;

		$restore = null;

		if (preg_match('|[a-f\d]{32}|', $hash)){
			$restore = ORM::factory('users_restore_attempt')->where('hash', '=', $hash)->find()->as_array();
			if (HTTP_Request::POST == $this->request->method()){
				$data = $this->request->post();

				$user = ORM::factory('user', $restore->user_id)->find();
				$user->update_user($data);

				Request::current()->redirect('/');
			}
		}else{
			Request::current()->redirect('/');
		}

		if (!is_array($restore)){
			$this->template->content->message = 'Restore hash not found.';
		}

	}

}