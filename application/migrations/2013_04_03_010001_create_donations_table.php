<?php

class Create_Donations_Table {    

	public function up()
    {
		Schema::create('donations', function($table) {
			$table->increments('id');
			$table->date('donation_date');
			$table->decimal('amount', 10, 2);
			$table->integer('category_id');
			$table->integer('account_id');
			$table->text('remark');
			$table->integer('donor_id');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('donations');

    }

}