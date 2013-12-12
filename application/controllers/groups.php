<?php

class Groups_Controller extends Base_Controller {

	public $restful = true;    

	public function get_index()
    {
        $data['groups'] = Group::order_by('name', 'asc')->get();
        return View::make('group.index', $data);
    }    

    public function post_index()
    {
        $group = array(
            'name' => Input::get('name'),
            'description' => Input::get('description'),
        );
        $new_group = Group::create($group);
        if ($new_group) {
            return Redirect::to_action('groups');
        }

    }

    public function post_add_module()
    {
        $content = Input::json();
        $all = (array) $content;
        // return var_dump($all['group_id']);
        $group = Group::find($all['group_id']);
        $module_id = $all['module_id'];
        if (isset($all['permissions'])) {
            if (is_array($all['permissions'])) {
                $permissions = implode(',', $all['permissions']);
            } else {
                $permissions = $all['permissions'];
            }
            $new_group_module = $group->modules()->attach($module_id, array('permissions' => $permissions));
        } else {
            $new_group_module = $group->modules()->attach($module_id);
        }
        if ($new_group_module) {
            return Response::json(array('response' => true));
        } else {
            return Response::json(array('response' => false));
        }
    } 

    public function post_delete_module()
    {
        $content = Input::json();
        $all = (array) $content;
        // return var_dump($all);
        $group = Group::find($all['group_id']);
        $delete_group_module = $group->modules()->detach($all['module_id']);
        // return var_dump($delete_group_module);
        if ($delete_group_module) {
            return Response::json(array('response' => true));
        } else {
            return Response::json(array('response' => false));
        }
    } 

    public function get_show()
    {

    }    

    public function get_edit($object_id = false)
    {
        $modules = Module::lists('name', 'id');
        if (!$object_id) return Redirect::to_action('groups@new');
        $object = Group::find($object_id);
        if (!$object) return Redirect::to_action('groups@new');
        $data = array(
            'group' => $object, 
            'new' => false, 
            'modules' => $modules
        );
        $view = View::make('group.edit');
        return $view->nest('form', 'group.form', $data);
    }    

    public function get_new()
    {
        $modules = Module::lists('name', 'id');
        $data = array(
            'new' => true,
            'modules' => $modules
        );
        $view = View::make('group.new');
        return $view->nest('form', 'group.form', $data);
    }    

    public function post_update()
    {
        $group = Group::find(Input::get('id'));
        $group->name = Input::get('name');
        $group->description = Input::get('description');
        $group->save();

        return Redirect::to_action('groups@index');
    }    

    public function delete_destroy($object_id = false)
    {
        $group = Group::find($object_id);
        $group->delete();

        return Redirect::to_action('groups@index');
    }
}