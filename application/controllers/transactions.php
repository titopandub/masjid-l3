<?php

class Transactions_Controller extends Base_Controller {

	public $restful = true;    

	public function get_index()
    {
        // $transaction = Donation::find(6);
        // // $transaction = $donation->transaction;
        // $transaction->amount = 70000;
        // $transaction->save();
        // // $transaction_later = Transaction::later_than($transaction)->get();
        // $data = array('transaction' => $transaction, );
        return View::make('transaction.index', $data);

        // $transaction = Transaction::find(7);
        // $transaction->delete();
        // $data = array('transaction' => $transaction, );
        // return View::make('transaction.index', $data);
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