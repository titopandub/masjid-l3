<?php

class Create_Modules_Table {    

	public function up()
    {
		Schema::create('modules', function($table) {
			$table->increments('id')->unsigned();
			$table->string('name', 32);
			$table->string('controller', 32);
			$table->text('description');
			$table->integer('order');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('modules');

    }

}