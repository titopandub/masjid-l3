<?php

class Modules_Controller extends Base_Controller {

	public $restful = true;    

	public function get_index()
    {
        $data['modules'] = Module::order_by('order', 'asc')->get();
        return View::make('module.index', $data);
    }    

    public function post_index()
    {
        $module = array(
            'name' => Input::get('name'),
            'controller' => Input::get('controller'),
            'order' => Input::get('order'),
            'description' => Input::get('description'),
        );
        $new_module = Module::create($module);
        if ($new_module) {
            return Redirect::to_action('modules');
        }

    }    

    public function get_show($group_id)
    {
        $modules = Group::find($group_id)->modules()->order_by('order', 'asc')->get();
        $array = array_map(function($object) {
            return $object->to_array();
        }, $modules);
        $data = array('aaData' => $array, );
        return Response::json($data);

    }    

    public function get_edit($object_id = false)
    {
        if (!$object_id) return Redirect::to_action('modules@new');
        $object = Module::find($object_id);
        if (!$object) return Redirect::to_action('modules@new');
        $data['module'] = $object;
        $data['new'] = false;
        $view = View::make('module.edit');
        return $view->nest('form', 'module.form', $data);
    }    

    public function get_new()
    {
        $data = array(
            'new' => true,
        );
        $view = View::make('module.new');
        return $view->nest('form', 'module.form', $data);
    }    

    public function post_update()
    {
        $module = Module::find(Input::get('id'));
        $module->name = Input::get('name');
        $module->controller = Input::get('controller');
        $module->order = Input::get('order');
        $module->description = Input::get('description');
        $module->save();

        return Redirect::to_action('modules@index');
    }    

    public function delete_destroy($object_id = false)
    {
        $module = Module::find($object_id);
        $module->delete();

        return Redirect::to_action('modules@index');
    }

}