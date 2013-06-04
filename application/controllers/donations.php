<?php

class Donations_Controller extends Base_Controller {

	public $restful = true;    

	public function get_index()
    {
        $data['donations'] = Donation::order_by('id', 'desc')->order_by('donation_date', 'desc')->get();
        return View::make('donation.index', $data);
    }    

    public function post_index()
    {
        if( ! DonationForm::is_valid() )
        {
            return Redirect::back()->with_input()->with_errors( DonationForm::$validation );
        }
        $new_donation = Donation::create(Input::get());
        if ($new_donation) {
            return Redirect::to_action('donations');
        }

    }    

    public function get_show()
    {

    }    

    public function get_edit($object_id = false)
    {
        $categories = Category::lists('name', 'id');
        $accounts = Account::lists('name', 'id');
        if (!$object_id) return Redirect::to_action('donations@new');
        $object = Donation::find($object_id);
        if (!$object) return Redirect::to_action('donations@new');
        $data = array(
            'new' => false, 
            'donation' => $object,
            'categories' => $categories,
            'accounts' => $accounts,
        );
        $view = View::make('donation.edit');
        return $view->nest('form', 'donation.form', $data);
    }    

    public function get_new()
    {
        $categories = Category::lists('name', 'id');
        $accounts = Account::lists('name', 'id');
        $data = array(
            'new' => true, 
            'categories' => $categories,
            'accounts' => $accounts,
        );
        $view = View::make('donation.new');
        return $view->nest('form', 'donation.form', $data);
    }    

    public function put_update()
    {
        $donation = Donation::find(Input::get('id'));
        if ( !$donation ) {
            return Redirect::to_action('donations@index');
        }

        # Set id to ignore on unique rules
        DonationForm::set('current_id', $donation->id);

        if( ! DonationForm::is_valid() )
        {
            return Redirect::back()->with_input()->with_errors( DonationForm::$validation );
        }
        
        $donation->donation_date = Input::get('donation_date');
        $donation->amount = Input::get('amount');
        $donation->remark = Input::get('remark');
        $donation->category_id = Input::get('category_id');
        $donation->account_id = Input::get('account_id');
        $donation->save();

        return Redirect::to_action('donations@index');
    }    

    public function delete_destroy($object_id = false)
    {
        $donation = Donation::find($object_id);
        $donation->delete();

        return Redirect::to_action('donations@index');
    }

}