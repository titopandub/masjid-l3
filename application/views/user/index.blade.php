@layout('master')

@section('container')

<h2>List of users</h2>

{{ HTML::link_to_action('users@new', 'Create a New User', array(), array('class' => 'btn btn-primary create-btn')) }}

<table class="table table-bordered table-js">
	<thead>
		<tr>
			<th>ID</th>
			<th>Username</th>
			<th>Email</th>
			<th>Group</th>
			<th class="action">Action</th>
		</tr>
	</thead>
	<tbody>
@if ($users)
	@foreach ($users as $user)
		<tr>
			<td>{{ $user->id }}</td>
			<td>{{ $user->username }}</td>
			<td>{{ $user->email }}</td>
			<td>{{ $user->group->name }}</td>
			<td>
				{{ HTML::link_to_action('users@edit', 'Edit', array($user->id), array('class' => 'btn btn-warning')) }}
				{{ HTML::link_to_action('users@destroy', 'Delete', array($user->id), array('class' => 'btn btn-danger', 'data-method' => 'delete')) }}
			</td>
		</tr>
	@endforeach
@endif
	</tbody>
</table>

@endsection