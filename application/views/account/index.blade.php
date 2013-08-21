@layout('master')

@section('container')

<h2>List of accounts</h2>

{{ HTML::link_to_action('accounts@new', 'Create a New Account', array(), array('class' => 'btn btn-primary create-btn')) }}

<table class="table table-bordered table-js">
	<thead>
		<tr>
			<th>ID</th>
			<th>Account Name</th>
			<th class="action">Action</th>
		</tr>
	</thead>
	<tbody>
	@forelse ($accounts as $account)
		<tr>
			<td>{{ $account->id }}</td>
			<td>{{ $account->name }}</td>
			<td>
				{{ HTML::link_to_action('accounts@edit', 'Edit', array($account->id), array('class' => 'btn btn-warning')) }}
				{{ HTML::link_to_action('accounts@destroy', 'Delete', array($account->id), array('class' => 'btn btn-danger', 'data-method' => 'delete')) }}
			</td>
		</tr>
	@empty
	@endforelse
	</tbody>
</table>

@endsection
