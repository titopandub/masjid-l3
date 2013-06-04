<?php

class Category extends Eloquent 
{
	public function donations()
	{
		return $this->has_many('Donation');
	}

	public function transactions()
	{
		return $this->has_many('Transaction');
	}

}