<?php

class Dashboards_Controller extends Base_Controller {

	public $restful = true;    

	public function get_index()
    {
        if (! Auth::guest())
        {
            $group = Auth::user()->group()->first();
            $group_modules = $group->modules()->pivot()->get();
            return var_dump($group_modules);
        }

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