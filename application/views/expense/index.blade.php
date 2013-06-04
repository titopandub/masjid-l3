@layout('master')

@section('container')

<table class="table table-bordered table-js">
	<thead>
		<tr>
			<th>Expense ID</th>
			<th>Account</th>
			<th>Expense Date</th>
			<th>Remark</th>
			<th>Amount</th>
			<th>Category</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	@forelse ($expenses as $expense)
		<tr>
			<td>{{ $expense->id }}</td>
			<td>{{ $expense->account->name }}</td>
			<td>{{ date('Y-m-d', strtotime($expense->expense_date)) }}</td>
			<td>{{ $expense->remark }}</td>
			<td>{{ $expense->amount }}</td>
			<td>{{ $expense->category->name }}</td>
			<td>
				{{ HTML::link_to_action('expenses@edit', 'Edit', array($expense->id), array('class' => 'btn')) }}
				{{ HTML::link_to_action('expenses@destroy', 'Delete', array($expense->id), array('class' => 'btn', 'data-method' => 'delete')) }}
			</td>
		</tr>
	@empty
	@endforelse
	</tbody>
</table>

{{ HTML::link_to_action('expenses@new', 'New', array(), array('class' => 'btn')) }}

@endsection
