<?php

class Expense extends Eloquent 
{
	public $includes = array('category', 'account');
	
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

	public function save()
	{
		parent::save();
		return $this->create_or_update_transaction();
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
			// 					'donation_id' => $this->id,
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
}