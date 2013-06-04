@layout('master')

@section('container')

<table class="table table-bordered table-js">
	<thead>
		<tr>
			<th>Username</th>
			<th>Email</th>
			<th>Group</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
@if ($users)
	@foreach ($users as $user)
		<tr>
			<td>{{ $user->username }}</td>
			<td>{{ $user->email }}</td>
			<td>{{ $user->group->name }}</td>
			<td>
				{{ HTML::link_to_action('users@edit', 'Edit', array($user->id), array('class' => 'btn')) }}
				{{ HTML::link_to_action('users@destroy', 'Delete', array($user->id), array('class' => 'btn', 'data-method' => 'delete')) }}
			</td>
		</tr>
	@endforeach
@endif
	</tbody>
</table>

{{ HTML::link_to_action('users@new', 'New', array(), array('class' => 'btn')) }}

@endsection