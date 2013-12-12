{{ Form::open('/modules/'.( $new ? '' : 'update'), 'POST', array('class' => 'form-horizontal')) }}
	@if (!$new) 
	{{ Form::hidden('id', $module->id); }}
	@endif
	
<div class="control-group">
	{{ Form::label('name', 'Name', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::text('name', $new ? '' : $module->name) }}
	</div>
</div>

<div class="control-group">
	{{ Form::label('controller', 'Controller', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::text('controller', $new ? '' : $module->controller) }}
	</div>
</div>

<div class="control-group">
	{{ Form::label('order', 'Order', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::text('order', $new ? '' : $module->order) }}
	</div>
</div>

<div class="control-group">
	{{ Form::label('description', 'Description', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::textarea('description', $new ? '' : $module->description, array('rows' => '3', 'cols' => '70')) }}
	</div>
</div>

<div class="control-group">
	<div class="controls">
		<div class="btn-group">
			{{ Form::submit('Save', array('class' => 'btn')) }}
			{{ HTML::link_to_action('modules@index', 'Back', array(), array('class' => 'btn')) }}
		</div>
	</div>
</div>
{{ Form::close() }}