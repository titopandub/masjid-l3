<?php

class Create_Donors_Table {    

	public function up()
    {
		Schema::create('donors', function($table) {
			$table->increments('id');
			$table->string('name');
			$table->text('address');
			$table->string('telephone');
			$table->string('email');
			$table->boolean('public');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('donors');

    }

}