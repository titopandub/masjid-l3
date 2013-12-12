{{ Form::open('/accounts/'.( $new ? '' : 'update'), $new ? 'POST' : 'PUT', array('class' => 'form-horizontal')) }}
	@if (!$new) 
	{{ Form::hidden('id', $account->id); }}
	@endif
	
<div class="control-group">
	{{ Form::label('name', 'Name', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::text('name', $new ? '' : $account->name, array('placeholder' => 'Name')) }}
	</div>
</div>

<div class="control-group">
	{{ Form::label('account_number', 'Account Number', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::text('account_number', $new ? '' : $account->account_number, array('placeholder' => 'Account Number')) }}
	</div>
</div>

<div class="control-group">
	{{ Form::label('account_type', 'Account Type', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::text('account_type', $new ? '' : $account->account_type, array('placeholder' => 'Account Type')) }}
	</div>
</div>

<div class="control-group">
	{{ Form::label('secretary', 'Secretary', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::text('secretary', $new ? '' : $account->secretary, array('placeholder' => 'Secretary')) }}
	</div>
</div>

<div class="control-group">
	{{ Form::label('treasurer', 'Treasurer', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::text('treasurer', $new ? '' : $account->treasurer, array('placeholder' => 'Treasurer')) }}
	</div>
</div>

<div class="control-group">
	<div class="controls">
		<div class="btn-group">
			{{ Form::submit('Save', array('class' => 'btn')) }}
			{{ HTML::link_to_action('accounts@index', 'Back', array(), array('class' => 'btn')) }}
		</div>
	</div>
</div>
{{ Form::close() }}