{{ Form::open('/groups/'.( $new ? '' : 'update'), 'POST', array('class' => 'form-horizontal')) }}
	@if (!$new) 
	{{ Form::hidden('id', $group->id, array('id' => 'id')); }}
	@endif
	
<div class="control-group">
	{{ Form::label('name', 'Name', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::text('name', $new ? '' : $group->name) }}
	</div>
</div>

<div class="control-group">
	{{ Form::label('description', 'Description', array('class' => 'control-label')) }}
	<div class="controls">
		{{ Form::textarea('description', $new ? '' : $group->description, array('rows' => '3', 'cols' => '70')) }}
	</div>
</div>

@if (!$new)
	<a href="#" class="btn" id="add-module">Add</a>
	<table class="table table-bordered table-condensed" id="table-module">
		<thead>
			<tr>
				<th>Order</th>
				<th>Name</th>
				<th>Controller</th>
				<th>Description</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
	
	<div id="dialog" title="Confirmation Required">
		Are you sure to delete this?
	</div>
@endif

<div class="control-group">
	<div class="controls">
		<div class="btn-group">
			{{ Form::submit('Save', array('class' => 'btn')) }}
			{{ HTML::link_to_action('groups@index', 'Back', array(), array('class' => 'btn')) }}
		</div>
	</div>
</div>
{{ Form::close() }}

@section('modal')
	<div class="modal hide fade" id="modal-module">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3>Add Module</h3>
		</div>
		<div class="modal-body">
			<form class="form-horizontal" id="form-module">
				{{ Form::hidden('group_id', $new ? '' : $group->id, array('id' => 'group_id')) }}
				
				<div class="control-group">
					{{ Form::label('module_id', 'Module', array('class' => 'control-label')) }}
					<div class="controls">
						{{ Form::select('module_id', $modules) }}
					</div>
				</div>
				
				<div class="control-group">
					{{ Form::label('permissions', 'Permissions', array('class' => 'control-label')) }}
					<div class="controls">
						<label class="checkbox">
							{{ Form::checkbox('permissions', 'create') }}
							Create
						</label>
						<label class="checkbox">
							{{ Form::checkbox('permissions', 'read') }}
							Read
						</label>
						<label class="checkbox">
							{{ Form::checkbox('permissions', 'update') }}
							Update
						</label>
						<label class="checkbox">
							{{ Form::checkbox('permissions', 'delete') }}
							Delete
						</label>
						<label class="checkbox">
							{{ Form::checkbox('permissions', 'print') }}
							Print
						</label>
					</div>
				</div>
				
				<div class="control-group">
					<div class="controls">
						{{ Form::submit('Save', array('class' => 'btn')) }}
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection