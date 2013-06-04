<?php

class Group extends Eloquent 
{
	public function modules()
	{
		return $this->has_many_and_belongs_to('Module')->with('permissions');
	}
}