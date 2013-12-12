<?php

class Account extends Eloquent 
{
	public function transactions()
	{
		return $this->has_many('Transaction')
					->order_by('date', 'asc')
					->order_by('id', 'asc');
	}

	public function donations()
	{
		return $this->has_many('Donation')
					->order_by('donation_date', 'asc')
					->order_by('id', 'asc');
	}

	public function expenses()
	{
		return $this->has_many('Expense')
					->order_by('expense_date', 'asc')
					->order_by('id', 'asc');
	}

	public function transactions_desc()
	{
		return $this->has_many('Transaction')
					->order_by('date', 'desc')
					->order_by('id', 'desc');
	}

}