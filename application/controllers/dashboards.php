<?php

class Dashboards_Controller extends Base_Controller {

	public $restful = true;    

	public function get_index()
    {
        if (! Auth::guest())
        {
            $group = Auth::user()->group()->first();
            $group_modules = $group->modules()->pivot()->get();
            $data = array('group_modules' => $group_modules, );
            return View::make('dashboard.index', $data);
        }
        return View::make('dashboard.index');
    }    

	public function post_index()
    {

    }    

	public function get_show()
    {

    }    

	public function get_edit()
    {

    }    

	public function get_new()
    {

    }    

	public function put_update()
    {

    }    

	public function delete_destroy()
    {

    }

}