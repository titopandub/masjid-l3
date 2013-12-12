<?php

class Create_Users_Table {    

	public function up()
    {
		Schema::create('users', function($table) {
			$table->increments('id')->unsigned();
			$table->string('username', 32)->unique();
		    $table->string('email', 32)->unique();
		    $table->string('password', 60);
		    $table->integer('group_id');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('users');

    }

}