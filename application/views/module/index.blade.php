@layout('master')

@section('container')

<h2>List of modules</h2>

{{ HTML::link_to_action('modules@new', 'Create a New Module', array(), array('class' => 'btn btn-primary create-btn')) }}

<table class="table table-bordered table-js">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Controller</th>
			<th>Description</th>
			<th>Order</th>
			<th class="action">Action</th>
		</tr>
	</thead>
	<tbody>
@if ($modules)
	@foreach ($modules as $module)
		<tr>
			<td>{{ $module->id }}</td>
			<td>{{ $module->name }}</td>
			<td>{{ $module->controller }}</td>
			<td>{{ $module->description }}</td>
			<td>{{ $module->order }}</td>
			<td>
				{{ HTML::link_to_action('modules@edit', 'Edit', array($module->id), array('class' => 'btn btn-warning')) }}
				{{ HTML::link_to_action('modules@destroy', 'Delete', array($module->id), array('class' => 'btn btn-danger', 'data-method' => 'delete')) }}
			</td>
		</tr>
	@endforeach
@endif
	</tbody>
</table>

@endsection