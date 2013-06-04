<?php

class Add_Columns_On_Group_Module_Table {    

	public function up()
    {
		Schema::table('group_module', function($table) 
		{
			$table->string('permissions');
		});

    }    

	public function down()
    {
		Schema::table('group_module', function($table) {
			$table->drop_column(array('permissions'));
	});

    }

}