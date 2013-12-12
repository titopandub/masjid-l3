<?php

class Balance extends Eloquent 
{
	public function transaction()
	{
		return $this->belongs_to('transaction_id');
	}

}