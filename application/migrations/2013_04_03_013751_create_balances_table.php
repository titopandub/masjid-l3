<?php

class Create_Balances_Table {    

	public function up()
    {
		Schema::create('balances', function($table) {
			$table->increments('id');
			$table->integer('transaction_id');
			$table->decimal('balance_amount', 10, 2);
			$table->string('balance_currency');
			$table->decimal('total_amount', 10, 2);
			$table->string('total_currency');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('balances');

    }

}