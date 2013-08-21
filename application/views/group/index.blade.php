@layout('master')

@section('container')

<h2>List of groups</h2>

{{ HTML::link_to_action('groups@new', 'Create a New Group', array(), array('class' => 'btn btn-primary create-btn')) }}

<table class="table table-bordered table-js">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Description</th>
			<th class="action">Action</th>
		</tr>
	</thead>
	<tbody>
@if ($groups)
	@foreach ($groups as $group)
		<tr>
			<td>{{ $group->id }}</td>
			<td>{{ $group->name }}</td>
			<td>{{ $group->description }}</td>
			<td>
				{{ HTML::link_to_action('groups@edit', 'Edit', array($group->id), array('class' => 'btn btn-warning')) }}
				{{ HTML::link_to_action('groups@destroy', 'Delete', array($group->id), array('class' => 'btn btn-danger', 'data-method' => 'delete')) }}
			</td>
		</tr>
	@endforeach
@endif
	</tbody>
</table>

@endsection