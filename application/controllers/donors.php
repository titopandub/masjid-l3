<?php

class Donors_Controller extends Base_Controller {

	public $restful = true;    

	public function get_index()
    {
        $data['donors'] = Donor::order_by('id', 'asc')->get();
        return View::make('donor.index', $data);
    }    

    public function post_index()
    {
        if( !DonorForm::is_valid() )
        {
            return Redirect::back()->with_input()->with_errors( DonorForm::$validation );
        }
        $new_donor = Donor::create(Input::get());
        if ($new_donor) {
            return Redirect::to_action('donors');
        }

    }    

    public function get_show()
    {

    }    

    public function get_edit($object_id = false)
    {
        if (!$object_id) return Redirect::to_action('donors@new');
        $object = Donor::find($object_id);
        if (!$object) return Redirect::to_action('donors@new');
        $data['donor'] = $object;
        $data['new'] = false;
        $view = View::make('donor.edit');
        return $view->nest('form', 'donor.form', $data);
    }    

    public function get_new()
    {
        $data = array(
            'new' => true, 
        );
        $view = View::make('donor.new');
        return $view->nest('form', 'donor.form', $data);
    }    

    public function put_update()
    {
        $donor = Donor::find(Input::get('id'));
        if ( !$donor ) {
            return Redirect::to_action('donors@index');
        }

        # Set id to ignore on unique rules
        DonorForm::set('current_id', $donor->id);

        if( !DonorForm::is_valid() )
        {
            return Redirect::back()->with_input()->with_errors( DonorForm::$validation );
        }
        
        $donor->name = Input::get('name');
        $donor->save();

        return Redirect::to_action('donors@index');
    }    

    public function delete_destroy($object_id = false)
    {
        $donor = Donor::find($object_id);
        $donor->delete();

        return Redirect::to_action('donors@index');
    }

}