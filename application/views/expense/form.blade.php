{{ Form::open('/expenses/'.( $new ? '' : 'update'), $new ? 'POST' : 'PUT', array('class' => 'form-horizontal')) }}
	@if (!$new) 
	{{ Form::hidden('id', $expense->id); }}
	@endif

<div class="control-group">
	{{ Form::label('expense_date', 'Expense Date', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::text('expense_date', $new ? date('Y-m-d') : AppHelper::date($expense->expense_date), array('class' => 'datepick')) }}
	</div>
</div>
<div class="control-group">
	{{ Form::label('amount', 'Amount', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::text('amount', $new ? '' : $expense->amount, array('placeholder' => 'Amount')) }}
	</div>
</div>

<div class="control-group">
	{{ Form::label('remark', 'Remark', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::textarea('remark', $new ? '' : $expense->remark, array('placeholder' => 'Remark')); }}
	</div>
</div>

<div class="control-group">
	{{ Form::label('account_id', 'Account', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::select('account_id', $accounts, $new ? '' : $expense->account_id); }}
	</div>
</div>

<div class="control-group">
	{{ Form::label('category_id', 'Category', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::select('category_id', $categories, $new ? '' : $expense->category_id); }}
	</div>
</div>

<div class="control-group">
	<div class="controls">
		<div class="btn-group">
			{{ Form::submit('Save', array('class' => 'btn')) }}
			{{ HTML::link_to_action('expenses@index', 'Back', array(), array('class' => 'btn')) }}
		</div>
	</div>
</div>
{{ Form::close() }}