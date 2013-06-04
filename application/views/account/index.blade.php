@layout('master')

@section('container')

<table class="table table-bordered table-js">
	<thead>
		<tr>
			<th>Account Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	@forelse ($accounts as $account)
		<tr>
			<td>{{ $account->name }}</td>
			<td>
				{{ HTML::link_to_action('accounts@edit', 'Edit', array($account->id), array('class' => 'btn')) }}
				{{ HTML::link_to_action('accounts@destroy', 'Delete', array($account->id), array('class' => 'btn', 'data-method' => 'delete')) }}
			</td>
		</tr>
	@empty
	@endforelse
	</tbody>
</table>

{{ HTML::link_to_action('accounts@new', 'New', array(), array('class' => 'btn')) }}

@endsection
