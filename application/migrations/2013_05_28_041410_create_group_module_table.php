<?php

class Create_Group_Module_Table {    

	public function up()
    {
		Schema::create('group_module', function($table) {
			$table->increments('id')->unsigned();
			$table->integer('module_id');
			$table->integer('group_id');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('module');

    }

}