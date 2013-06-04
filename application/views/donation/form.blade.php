{{ Form::open('/donations/'.( $new ? '' : 'update'), $new ? 'POST' : 'PUT', array('class' => 'form-horizontal')) }}
	@if (!$new) 
	{{ Form::hidden('id', $donation->id); }}
	@endif

<div class="control-group">
	{{ Form::label('donation_date', 'Donation Date', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::text('donation_date', $new ? date('Y-m-d') : AppHelper::date($donation->donation_date), array('class' => 'datepick')) }}
	</div>
</div>
<div class="control-group">
	{{ Form::label('amount', 'Amount', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::text('amount', $new ? '' : $donation->amount, array('placeholder' => 'Amount')) }}
	</div>
</div>

<div class="control-group">
	{{ Form::label('remark', 'Remark', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::textarea('remark', $new ? '' : $donation->remark, array('placeholder' => 'Remark')); }}
	</div>
</div>

<div class="control-group">
	{{ Form::label('account_id', 'Account', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::select('account_id', $accounts, $new ? '' : $donation->account_id); }}
	</div>
</div>

<div class="control-group">
	{{ Form::label('category_id', 'Category', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::select('category_id', $categories, $new ? '' : $donation->category_id); }}
	</div>
</div>

<div class="control-group">
	<div class="controls">
		<div class="btn-group">
			{{ Form::submit('Save', array('class' => 'btn')) }}
			{{ HTML::link_to_action('donations@index', 'Back', array(), array('class' => 'btn')) }}
		</div>
	</div>
</div>
{{ Form::close() }}