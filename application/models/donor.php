<?php

class Donor extends Eloquent 
{
	public function donations()
	{
		return $this->has_many('Donation');
	}

}