@layout('master')

@section('container')

<table class="table table-bordered table-js">
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
@if ($groups)
	@foreach ($groups as $group)
		<tr>
			<td>{{ $group->name }}</td>
			<td>{{ $group->description }}</td>
			<td>
				{{ HTML::link_to_action('groups@edit', 'Edit', array($group->id), array('class' => 'btn')) }}
				{{ HTML::link_to_action('groups@destroy', 'Delete', array($group->id), array('class' => 'btn', 'data-method' => 'delete')) }}
			</td>
		</tr>
	@endforeach
@endif
	</tbody>
</table>

{{ HTML::link_to_action('groups@new', 'New', array(), array('class' => 'btn')) }}

@endsection