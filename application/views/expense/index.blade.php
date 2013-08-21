@layout('master')

@section('container')

<h2>List of expenses</h2>

{{ HTML::link_to_action('expenses@new', 'Create a New Expense', array(), array('class' => 'btn btn-primary create-btn')) }}

<table class="table table-bordered table-js">
	<thead>
		<tr>
			<th class="date">Date</th>
			<th>ID</th>
			<th class="account-name">Account</th>
			<th>Remark</th>
			<th class="amount">Amount</th>
			<th>Category</th>
			<th class="action">Action</th>
		</tr>
	</thead>
	<tbody>
	@forelse ($expenses as $expense)
		<tr>
			<td>{{ date('Y-m-d', strtotime($expense->expense_date)) }}</td>
			<td>{{ $expense->id }}</td>
			<td>{{ $expense->account->name }}</td>
			<td>{{ $expense->remark }}</td>
			<td>{{ AppHelper::idr_format($expense->amount) }}</td>
			<td>{{ $expense->category->name }}</td>
			<td>
				{{ HTML::link_to_action('expenses@edit', 'Edit', array($expense->id), array('class' => 'btn btn-warning')) }}
				{{ HTML::link_to_action('expenses@destroy', 'Delete', array($expense->id), array('class' => 'btn btn-danger', 'data-method' => 'delete')) }}
			</td>
		</tr>
	@empty
	@endforelse
	</tbody>
</table>

@endsection

@section('javascript')
<script type="text/javascript">
	// tableJS.fnSort( [ [2,'desc'] ] );
</script>
@endsection
