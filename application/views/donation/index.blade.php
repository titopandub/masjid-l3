@layout('master')

@section('container')

<table class="table table-bordered table-js">
	<thead>
		<tr>
			<th>Donation ID</th>
			<th>Account</th>
			<th>Donation Date</th>
			<th>Remark</th>
			<th>Amount</th>
			<th>Category</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	@forelse ($donations as $donation)
		<tr>
			<td>{{ $donation->id }}</td>
			<td>{{ $donation->account->name }}</td>
			<td>{{ date('Y-m-d', strtotime($donation->donation_date)) }}</td>
			<td>{{ $donation->remark }}</td>
			<td>{{ $donation->amount }}</td>
			<td>{{ $donation->category->name }}</td>
			<td>
				{{ HTML::link_to_action('donations@edit', 'Edit', array($donation->id), array('class' => 'btn')) }}
				{{ HTML::link_to_action('donations@destroy', 'Delete', array($donation->id), array('class' => 'btn', 'data-method' => 'delete')) }}
			</td>
		</tr>
	@empty
	@endforelse
	</tbody>
</table>

{{ HTML::link_to_action('donations@new', 'New', array(), array('class' => 'btn')) }}

@endsection
