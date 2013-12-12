<?php

class User extends Eloquent 
{
	public static $hidden = array('password');

	public function group()
	{
		return $this->belongs_to('Group', 'group_id');
	}

	public static function users_from_group($group_name)
	{
		$groups = array_map(function($group) {return $group->id;}, 
							Group::where('name', 'LIKE', '%' . $group_name . '%')->get());

		return static::with('group')
							->where_in('group_id', $groups)
							->order_by('username', 'asc')
							->get();
	}
}