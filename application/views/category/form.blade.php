{{ Form::open('/categories/'.( $new ? '' : 'update'), $new ? 'POST' : 'PUT', array('class' => 'form-horizontal')) }}
	@if (!$new) 
	{{ Form::hidden('id', $category->id); }}
	@endif
	
<div class="control-group">
	{{ Form::label('name', 'Name', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::text('name', $new ? '' : $category->name, array('placeholder' => 'Name')) }}
	</div>
</div>

<div class="control-group">
	<div class="controls">
		<div class="btn-group">
			{{ Form::submit('Save', array('class' => 'btn')) }}
			{{ HTML::link_to_action('categories@index', 'Back', array(), array('class' => 'btn')) }}
		</div>
	</div>
</div>
{{ Form::close() }}