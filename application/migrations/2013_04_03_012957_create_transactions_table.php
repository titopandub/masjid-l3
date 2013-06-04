<?php

class Create_Transactions_Table {    

	public function up()
    {
		Schema::create('transactions', function($table) {
			$table->increments('id');
			$table->date('date');
			$table->string('item');
			$table->decimal('amount', 10, 2);
			$table->string('currency');
			$table->integer('account_id');
			$table->integer('category_id');
			$table->integer('donation_id');
			$table->integer('expense_id');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('transactions');

    }

}