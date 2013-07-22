<?php

class Users_Controller extends Base_Controller {

	public $restful = true;    

	public function get_index($json = false)
    {
        if ($json) {
        	$users = User::users_from_group($json);
            $array = array_map(function($object) {
                 return $object->to_array();
            }, $users);
            $data = array('aaData' => $array, );
            return Response::json($data);
        } else {
        	$users = User::with('group')->order_by('username', 'asc')->get();
            $data = array('users' => $users,);
            return View::make('user.index', $data);
        }
    }

	public function post_login()
	{
	   	$userdata = array(
			'username'      => Input::get('username'),
			'password'      => Input::get('password'),
			'remember'		=> true
		);

		if (Auth::attempt($userdata)) {
			return Redirect::to_action('reports@index');
		} else {
			return Redirect::to_action('users@login')
								->with('notification', 'Incorrect Username or Password!!');
		}
	}

	public function get_login()
	{
		return View::make('user.login');
	}

	public function get_logout()
	{
		$user_id = Auth::user()->id;
		Cache::forget($user_id . 'modules');
		Auth::logout();
		return Redirect::to_action('users@login');
	}

	public function post_index()
	{
		$user = array(
			'username' => Input::get('username'),
			'password' => Hash::make(Input::get('password')),
			'email' => Input::get('email'),
			'group_id' => Input::get('group_id')
		);
		$new_user = User::create($user);
		if ($new_user) {
			return Redirect::to_action('users');
		}

	}    

	public function get_show()
	{

	}    

	public function get_edit($object_id = false)
	{
		$groups = Group::lists('name', 'id');
		if (!$object_id) return Redirect::to_action('users@new');
		$object = User::find($object_id);
		if (!$object) return Redirect::to_action('users@new');
		$data = array(
			'user' => $object, 
			'new' => false, 
			'groups' => $groups
		);
		$view = View::make('user.edit');
		return $view->nest('form', 'user.form', $data);
	}    

	public function get_new()
	{
		$groups = Group::lists('name', 'id');
		$data = array(
			'new' => true,
			'groups' => $groups
		);
		$view = View::make('user.new');
		return $view->nest('form', 'user.form', $data);
	}    

	public function put_update()
	{
		$user = User::find(Input::get('id'));
		$user->username = Input::get('username');
		$user->password = Hash::make(Input::get('password'));
		$user->email = Input::get('email');
		$user->group_id = Input::get('group_id');
		$user->save();

		return Redirect::to_action('users@index');
	}    

	public function delete_destroy($object_id = false)
    {
        $user = User::find($object_id);
        $user->delete();

        return Redirect::to_action('users@index');
    }

}