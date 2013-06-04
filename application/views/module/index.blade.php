@layout('master')

@section('container')

<table class="table table-bordered table-js">
	<thead>
		<tr>
			<th>Name</th>
			<th>Controller</th>
			<th>Description</th>
			<th>Order</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
@if ($modules)
	@foreach ($modules as $module)
		<tr>
			<td>{{ $module->name }}</td>
			<td>{{ $module->controller }}</td>
			<td>{{ $module->description }}</td>
			<td>{{ $module->order }}</td>
			<td>
				{{ HTML::link_to_action('modules@edit', 'Edit', array($module->id), array('class' => 'btn')) }}
				{{ HTML::link_to_action('modules@destroy', 'Delete', array($module->id), array('class' => 'btn', 'data-method' => 'delete')) }}
			</td>
		</tr>
	@endforeach
@endif
	</tbody>
</table>

{{ HTML::link_to_action('modules@new', 'New', array(), array('class' => 'btn')) }}

@endsection