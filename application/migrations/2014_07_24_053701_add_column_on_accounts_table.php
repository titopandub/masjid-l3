<?php

class Add_Column_On_Accounts_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('accounts', function($table)
		{
			$table->text('announcement');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('accounts', function($table) {
			$table->drop_column(array('announcement'));
		});
	}

}