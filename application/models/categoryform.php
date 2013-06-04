<?php 
class CategoryForm extends FormBaseModel\Base
{

	public static $rules = array(
		'name' => 'required|unique:categories'
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