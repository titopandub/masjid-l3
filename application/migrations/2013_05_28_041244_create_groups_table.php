<?php

class Create_Groups_Table {    

	public function up()
    {
		Schema::create('groups', function($table) {
			$table->increments('id')->unsigned();
			$table->string('name', 32)->unique();
			$table->text('description');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('groups');

    }

}