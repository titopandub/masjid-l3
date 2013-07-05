<?php

class Donation extends Eloquent 
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

	public function donor()
	{
		return $this->belongs_to('Donor');
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
								'date' => $this->donation_date,
								'amount' => $this->amount,
								'item' => $this->remark,
								'category_id' => $this->category_id,
								'account_id' => $this->account_id,
								'currency' => 'IDR',
								));
			$this->transaction()->insert($transaction_data);
			// $t = Transaction::create(array(
			// 					'date' => $this->donation_date,
			// 					'amount' => $this->amount,
			// 					'item' => $this->remark,
			// 					'category_id' => $this->category_id,
			// 					'account_id' => $this->account_id,
			// 					'donation_id' => $this->id,
			// 					'currency' => 'IDR',
			// 					));
			return true;
		} else {
			$remark = $this->donor_id ? ($this->remark . ' - ' . $this->donor->name) : $this->remark;
			$t->date = $this->donation_date;
	        $t->amount = $this->amount;
	        $t->item = $remark;
	        $t->category_id = $this->category_id;
	        $t->account_id = $this->account_id;
	        $t->currency = 'IDR';
	        $t->save();
		}
		
	}

	public function handle_after_destroy()
	{
		$donation_id = $this->id;
		if (! is_null($donation_id)) {
			$t = Transaction::where_donation_id($donation_id)->first();
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