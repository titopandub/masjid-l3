<?php 
class AccountForm extends FormBaseModel\Base
{

	public static $rules = array(
		'name' => 'required|unique:accounts'
	);

	public static function before_validation()
	{
		// change rules when updating
		if( Request::method() == 'PUT' )
		{
	        // unique: ignore values on record with id
	        $id = self::get('current_id');
	        self::$rules['name'] .= ",name,$id";
		}
	}

}