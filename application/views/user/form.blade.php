{{ Form::open('/users/'.( $new ? '' : 'update'), $new ? 'POST' : 'PUT', array('class' => 'form-horizontal')) }}
	@if (!$new) 
	{{ Form::hidden('id', $user->id); }}
	@endif
	
<div class="control-group">
	{{ Form::label('username', 'Username', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::text('username', $new ? '' : $user->username) }}
	</div>
</div>
	
<div class="control-group">
	{{ Form::label('password', 'Password', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::password('password') }}
	</div>
</div>

<div class="control-group">
	{{ Form::label('email', 'Email', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::text('email', $new ? '' : $user->email) }}
	</div>
</div>

<div class="control-group">
	{{ Form::label('group_id', 'Group', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::select('group_id', $groups, $new ? '' : $user->group_id) }}
	</div>
</div>

<div class="control-group">
	<div class="controls">
		<div class="btn-group">
			{{ Form::submit('Save', array('class' => 'btn')) }}
			{{ HTML::link_to_action('users@index', 'Back', array(), array('class' => 'btn')) }}
		</div>
	</div>
</div>
{{ Form::close() }}