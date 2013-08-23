@layout('master')

@section('container')

<h2>List of categories</h2>

{{ HTML::link_to_action('categories@new', 'Create a New Category', array(), array('class' => 'btn btn-primary create-btn')) }}

<table class="table table-bordered table-js">
	<thead>
		<tr>
			<th class="table-id">ID</th>
			<th>Category Name</th>
			<th class="action">Action</th>
		</tr>
	</thead>
	<tbody>
	@forelse ($categories as $category)
		<tr>
			<td class="table-id">{{ $category->id }}</td>
			<td>{{ $category->name }}</td>
			<td class="action">
				{{ HTML::link_to_action('categories@edit', 'Edit', array($category->id), array('class' => 'btn btn-warning')) }}
				{{ HTML::link_to_action('categories@destroy', 'Delete', array($category->id), array('class' => 'btn btn-danger', 'data-method' => 'delete')) }}
			</td>
		</tr>
	@empty
	@endforelse
	</tbody>
</table>

@endsection
