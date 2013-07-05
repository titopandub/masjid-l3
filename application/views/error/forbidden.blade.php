@layout('master')

@section('container')
<div class="hero">
	<h1>Forbidden Access !!</h1>
	{{ HTML::link_to_action('dashboards@index', 'Back', array(), array('class' => 'btn')) }}
</div>
@endsection