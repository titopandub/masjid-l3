<?php

class Accounts_Controller extends Base_Controller {

	public $restful = true;

	public function get_index()
    {
        $data['accounts'] = Account::order_by('id', 'asc')->get();
        return View::make('account.index', $data);
    }

    // use this params => $date, $account_id = 1, $periode = 'weekly'
    public function get_report()
    {
        $account_id = Input::get('account_id');
        $periode    = Input::get('periode', 'weekly');
        $date       = Input::get('date');
        $today      = strtotime(date('Y-m-d'));
        if (is_null($date) || empty($date)) {
            $last_week = $today - (3600 * 24 * 7);
            $date = date('Y-m-d', $last_week);
        }
        if ( 'daily' == $periode ) {
            $range = array('start' => $date, 'end' => $date);
        } else if ( 'weekly' == $periode ) {
            $range = AppHelper::range_week($date);    
        } else if ( 'monthly' == $periode ) {
            $range = AppHelper::range_month($date);
        }
        $account = Account::find($account_id);
        $donations = Donation::where_between('donation_date', $range['start'], $range['end'])
                             ->where_account_id($account_id)
                             ->get();
        $expenses = Expense::where_between('expense_date', $range['start'], $range['end'])
                           ->where_account_id($account_id)
                           ->get();
        $transactions = Transaction::where_between('date', $range['start'], $range['end'])
                                   ->where_account_id($account_id)
                                   ->get();
        if (isset($donations[0])) {
            $last_transaction = Transaction::earlier_than($transactions[0])
                                           ->where_account_id($account_id)
                                           ->first();
        } else {
            $last_transaction = Transaction::earlier_than_date($range['start']);
        }
        
        if (is_null($last_transaction)) {
            $last_transaction_balance = 0;
        } else {
            $last_transaction_balance = $last_transaction->balance->balance_amount;
        }

        $end_transaction = Transaction::where_between('date', $range['start'], $range['end'])
                                      ->where_account_id($account_id)
                                      ->order_by('date', 'desc')
                                      ->order_by('id', 'desc')
                                      ->first();
        if (is_null($end_transaction)) {
            $end_balance = 0;
        } else {
            $end_balance = $end_transaction->balance->balance_amount;
        }
        
        $data = array(
                    'range' => $range,
                    'account' => $account,
                    'donations' => $donations, 
                    'expenses' => $expenses,
                    'last_transaction_balance' => $last_transaction_balance,
                    'end_balance' => $end_balance,
                    'periode' => $periode,
                    );
        return View::make('account.report', $data);
        // echo var_dump($end_balance);
    }

    public function post_index()
    {
        if( ! AccountForm::is_valid() )
        {
            return Redirect::back()->with_input()->with_errors( AccountForm::$validation );
        }
        $new_account = Account::create(Input::get());
        if ($new_account) {
            return Redirect::to_action('accounts');
        }

    }    

    public function get_show()
    {

    }    

    public function get_edit($object_id = false)
    {
        if (!$object_id) return Redirect::to_action('accounts@new');
        $object = Account::find($object_id);
        if (!$object) return Redirect::to_action('accounts@new');
        $data = array(
            'new' => false, 
            'account' => $object,
        );
        $view = View::make('account.edit');
        return $view->nest('form', 'account.form', $data);
    }    

    public function get_new()
    {
        $data = array(
            'new' => true, 
        );
        $view = View::make('account.new');
        return $view->nest('form', 'account.form', $data);
    }    

    public function put_update()
    {
        $account = Account::find(Input::get('id'));
        if ( !$account ) {
            return Redirect::to_action('accounts@index');
        }

        # Set id to ignore on unique rules
        AccountForm::set('current_id', $account->id);

        if( ! AccountForm::is_valid() )
        {
            return Redirect::back()->with_input()->with_errors( AccountForm::$validation );
        }
        
        $account->name = Input::get('name');
        $account->account_number = Input::get('account_number');
        $account->account_type = Input::get('account_type');
        $account->save();

        return Redirect::to_action('accounts@index');
    }    

    public function delete_destroy($object_id = false)
    {
        $account = Account::find($object_id);
        $account->delete();

        return Redirect::to_action('accounts@index');
    }

}