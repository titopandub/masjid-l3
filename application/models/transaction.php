<?php

class Transaction extends Eloquent 
{
	public $includes = array('balance');

	public function category()
	{
		return $this->belongs_to('Category');
	}

	public function account()
	{
		return $this->belongs_to('Account');
	}

	public function balance()
	{
		return $this->has_one('Balance');
	}

	public function donation()
	{
		return $this->belongs_to('donation_id');
	}

	public function save()
	{
		parent::save();
		$this->update_balance();
	}

	public function delete()
	{
		parent::delete();
		return $this->handle_after_destroy();
	}

	public static function earlier_than($transaction)
	{
		$current_date = date('Y-m-d', strtotime($transaction->date));
		$transaction_id = $transaction->id;
		return static::where(function ($query) use ($current_date, $transaction_id)
					{
						$query->where(function ($query) use ($current_date, $transaction_id) 
						{
							$query->where('date', '=',$current_date);
							$query->where('id', '<', $transaction_id);
						});
						$query->or_where('date', '<', $current_date);
					})
					->order_by('date', 'desc')
					->order_by('id', 'desc');
	}

	public static function later_than($transaction)
	{
		$current_date = date('Y-m-d', strtotime($transaction->date));
		$transaction_id = $transaction->id;
		return static::where(function ($query) use ($current_date, $transaction_id)
					{
						$query->where(function ($query) use ($current_date, $transaction_id) 
						{
							$query->where('date', '=',$current_date);
							$query->where('id', '>', $transaction_id);
						});
						$query->or_where('date', '>', $current_date);
					})
					->order_by('date', 'asc')
					->order_by('id', 'asc');
	}

	public function update_balance()
	{
		$pre_total = self::earlier_than($this)->first();
		// $pre_balance = self::earlier_than($this)->where('account_id', '=', $this->account_id)->first();
		$pre_balance = self::earlier_than($this)->where_account_id($this->account_id)->first();
		
		$total = 0;
		if (is_null($pre_total)) {
			$total = $this->amount;
		} else {
			$total = $pre_total->balance->total_amount + $this->amount;
		}
		$balance = 0;
		if (is_null($pre_balance)) {
			$balance = $this->amount;
		} else {
			$balance = $pre_balance->balance->balance_amount + $this->amount;
		}
		$b = $this->balance;
		if (is_null($b)) {
			$b = Balance::create(array(
									'balance_amount' => $balance, 
									'balance_currency' => $this->currency,
									'total_amount' => $total,
									'total_currency' => $this->currency,
									'transaction_id' => $this->id,
								));
		} else {
			$b->balance_amount = $balance;
			$b->balance_currency = $this->currency;
			$b->total_amount = $total;
			$b->total_currency = $this->currency;
			$b->save();
		}

		$this->update_later_balance();
	}

	public function update_later_balance()
	{
		$transactions = self::later_than($this)->get();
		foreach ($transactions as $key => $t) {
			$total = 0;
			$pre = self::earlier_than($t)->first();
			if (is_null($pre)) {
				$total = $t->amount;
			} else {
				$total = $t->amount + $pre->balance->total_amount;
			}
			$t->balance->total_amount = $total;
			$t->balance->save();
		}

		$accounts = Account::all();
		foreach ($accounts as $key => $account) {
			$transactions = self::later_than($this)->where_account_id($account->id)->get();
			foreach ($transactions as $key => $t) {
				$balance = 0;
				$pre = self::earlier_than($t)->where_account_id($t->account_id)->first();
				if (is_null($pre)) {
					$balance = $t->amount;
				} else {
					$balance = $t->amount + $pre->balance->balance_amount;
				}
				$t->balance->balance_amount = $balance;
				$t->balance->save();
			}
		}
	}

	public function set_date_to_now()
	{
		if (is_null($this->date)) {
			$this->date = date('Y-m-d');
		}
	}

	public function handle_after_destroy()
	{
		$transaction_id = $this->id;
		if (! is_null($transaction_id)) {
			$b = Balance::where_transaction_id($transaction_id);
			return $b->delete();
		}
		$this->update_later_balance();
	}

}