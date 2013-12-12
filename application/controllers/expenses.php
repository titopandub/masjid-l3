<?php

class Expenses_Controller extends Base_Controller {

	public $restful = true;    

	public function get_index()
    {
        $data['expenses'] = Expense::expenses()->get();
        return View::make('expense.index', $data);
    }    

    public function post_index()
    {
        if( ! ExpenseForm::is_valid() )
        {
            return Redirect::back()->with_input()->with_errors( ExpenseForm::$validation );
        }
        $new_expense = Expense::create(Input::get());
        if ($new_expense) {
            return Redirect::to_action('expenses');
        }

    }    

    public function get_show()
    {

    }    

    public function get_edit($object_id = false)
    {
        $categories = Category::lists('name', 'id');
        $accounts = Account::lists('name', 'id');
        if (!$object_id) return Redirect::to_action('expenses@new');
        $object = Expense::find($object_id);
        if (!$object) return Redirect::to_action('expenses@new');
        $data = array(
            'new' => false, 
            'expense' => $object,
            'categories' => $categories,
            'accounts' => $accounts,
        );
        $view = View::make('expense.edit');
        return $view->nest('form', 'expense.form', $data);
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
        $view = View::make('expense.new');
        return $view->nest('form', 'expense.form', $data);
    }    

    public function put_update()
    {
        $expense = Expense::find(Input::get('id'));
        if ( !$expense ) {
            return Redirect::to_action('expenses@index');
        }

        # Set id to ignore on unique rules
        ExpenseForm::set('current_id', $expense->id);

        if( ! ExpenseForm::is_valid() )
        {
            return Redirect::back()->with_input()->with_errors( ExpenseForm::$validation );
        }
        
        $expense->expense_date = Input::get('expense_date');
        $expense->amount = Input::get('amount');
        $expense->remark = Input::get('remark');
        $expense->category_id = Input::get('category_id');
        $expense->account_id = Input::get('account_id');
        $expense->save();

        return Redirect::to_action('expenses@index');
    }    

    public function delete_destroy($object_id = false)
    {
        $expense = Expense::find($object_id);
        $expense->delete();

        return Redirect::to_action('expenses@index');
    }

}