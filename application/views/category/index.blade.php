@layout('master')

@section('container')

<table class="table table-bordered table-js">
	<thead>
		<tr>
			<th>Category Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	@forelse ($categories as $category)
		<tr>
			<td>{{ $category->name }}</td>
			<td>
				{{ HTML::link_to_action('categories@edit', 'Edit', array($category->id), array('class' => 'btn')) }}
				{{ HTML::link_to_action('categories@destroy', 'Delete', array($category->id), array('class' => 'btn', 'data-method' => 'delete')) }}
			</td>
		</tr>
	@empty
	@endforelse
	</tbody>
</table>

{{ HTML::link_to_action('categories@new', 'New', array(), array('class' => 'btn')) }}

@endsection
