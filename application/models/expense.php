<?php

class Expense extends Eloquent 
{
	// public $includes = array('category', 'account');
	
	public function category()
	{
		return $this->belongs_to('Category');
	}

	public function account()
	{
		return $this->belongs_to('Account');
	}

	public function transaction()
	{
		return $this->has_one('Transaction');
	}

	public static function expenses()
	{
		return static::with(array('account','category', 'transaction', 'transaction.balance'))
                     ->order_by('id', 'desc')
                     ->order_by('expense_date', 'desc');
	}

	public function save()
	{
		parent::save();
		return $this->create_or_update_transaction();
	}

	public function delete()
	{
		parent::delete();
		return $this->handle_after_destroy();
	}

	public function create_or_update_transaction()
	{
		$t = $this->transaction;
		if (is_null($t)) {
			$transaction_data = new Transaction(array(
								'date' => $this->expense_date,
								'amount' => abs($this->amount) * -1,
								'item' => $this->remark,
								'category_id' => $this->category_id,
								'account_id' => $this->account_id,
								'currency' => 'IDR',
								));
			$this->transaction()->insert($transaction_data);
			// $t = Transaction::create(array(
			// 					'date' => $this->expense_date,
			// 					'amount' => $this->amount,
			// 					'item' => $this->remark,
			// 					'category_id' => $this->category_id,
			// 					'account_id' => $this->account_id,
			// 					'expense_id' => $this->id,
			// 					'currency' => 'IDR',
			// 					));
			return true;
		} else {
			$t->date = $this->expense_date;
	        $t->amount = abs($this->amount) * -1;
	        $t->item = $this->remark;
	        $t->category_id = $this->category_id;
	        $t->account_id = $this->account_id;
	        $t->currency = 'IDR';
	        $t->save();
		}
		
	}

	public function handle_after_destroy()
	{
		$expense_id = $this->id;
		if (! is_null($expense_id)) {
			$t = Transaction::where_expense_id($expense_id)->first();
			$transaction_id = $t->id;
			$b = Balance::where_transaction_id($transaction_id)->first();
			if (! is_null($t) && ! is_null($b)) {
				$b->delete();
				$t->delete();
				$t->update_later_balance();
			}
		}
	}
}