<?php

class Reports_Controller extends Base_Controller {

	public $restful = true;    

	public function get_index()
    {
        $accounts = Account::lists('name', 'id');
        $data = array('accounts' => $accounts, );
        return View::make('report.index', $data);

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