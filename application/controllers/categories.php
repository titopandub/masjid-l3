<?php

class Categories_Controller extends Base_Controller {

	public $restful = true;    

	public function get_index()
    {
        $data['categories'] = Category::order_by('id', 'asc')->get();
        return View::make('category.index', $data);
    }    

    public function post_index()
    {
        if( !CategoryForm::is_valid() )
        {
            return Redirect::back()->with_input()->with_errors( CategoryForm::$validation );
        }
        $new_category = Category::create(Input::get());
        if ($new_category) {
            return Redirect::to_action('categories');
        }

    }    

    public function get_show()
    {

    }    

    public function get_edit($object_id = false)
    {
        if (!$object_id) return Redirect::to_action('categories@new');
        $object = Category::find($object_id);
        if (!$object) return Redirect::to_action('categories@new');
        $data = array(
            'new' => false, 
            'category' => $object,
        );
        $view = View::make('category.edit');
        return $view->nest('form', 'category.form', $data);
    }    

    public function get_new()
    {
        $data = array(
            'new' => true, 
        );
        $view = View::make('category.new');
        return $view->nest('form', 'category.form', $data);
    }    

    public function put_update()
    {
        $category = Category::find(Input::get('id'));
        if ( !$category ) {
            return Redirect::to_action('categories@index');
        }

        # Set id to ignore on unique rules
        CategoryForm::set('current_id', $category->id);

        if( !CategoryForm::is_valid() )
        {
            return Redirect::back()->with_input()->with_errors( CategoryForm::$validation );
        }
        
        $category->name = Input::get('name');
        $category->save();

        return Redirect::to_action('categories@index');
    }    

    public function delete_destroy($object_id = false)
    {
        $category = Category::find($object_id);
        $category->delete();

        return Redirect::to_action('categories@index');
    }

}