<?php

class Create_Expenses_Table {    

	public function up()
    {
		Schema::create('expenses', function($table) {
			$table->increments('id');
			$table->date('expense_date');
			$table->decimal('amount', 10, 2);
			$table->integer('category_id');
			$table->integer('account_id');
			$table->text('remark');
			$table->timestamps();
	});

    }    

	public function down()
    {
		Schema::drop('expenses');

    }

}