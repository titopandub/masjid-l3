@layout('master')

@section('container')

<h2>List of donations</h2>

{{ HTML::link_to_action('donations@new', 'Create a New Donation', array(), array('class' => 'btn btn-primary create-btn')) }}

<table class="table table-bordered table-js">
	<thead>
		<tr>
			<th class="date">Date</th>
			<th>ID</th>
			<th class="account-name">Account</th>
			<th>Remark</th>
			<th class="amount">Amount</th>
			<th class="category">Category</th>
			<th class="action">Action</th>
		</tr>
	</thead>
	<tbody>
	@forelse ($donations as $donation)
		<tr>
			<td>{{ date('Y-m-d', strtotime($donation->donation_date)) }}</td>
			<td>{{ $donation->id }}</td>
			<td>{{ $donation->account->name }}</td>
			<td>{{ $donation->remark }}</td>
			<td>{{ AppHelper::idr_format($donation->amount) }}</td>
			<td>{{ $donation->category->name }}</td>
			<td>
				{{ HTML::link_to_action('donations@edit', 'Edit', array($donation->id), array('class' => 'btn btn-warning')) }}
				{{ HTML::link_to_action('donations@destroy', 'Delete', array($donation->id), array('class' => 'btn btn-danger', 'data-method' => 'delete')) }}
			</td>
		</tr>
	@empty
	@endforelse
	</tbody>
</table>

@section('javascript')
<script type="text/javascript">
	// tableJS.fnSort( [ [2,'desc'] ] );
</script>
@endsection

@endsection
