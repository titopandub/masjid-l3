@layout('master')

@section('container')
	{{ Form::open('/users/login', 'POST', array('class' => 'form-horizontal')) }}
					
	@if (Session::has('notification'))
		<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
  			<strong>Error!</strong>
  			{{ Session::get('notification') }}
		</div>
	@endif

	<div class="control-group">
		{{ Form::label('username', 'Username', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::text('username') }}
		</div>
	</div>
		
	<div class="control-group">
		{{ Form::label('password', 'Password', array('class' => 'control-label')) }}
		<div class="controls">
			{{ Form::password('password') }}
		</div>
	</div>

	<div class="control-group">
		<div class="controls">
		{{ Form::submit('Login', array('class' => 'btn')) }}
		</div>
	</div>
	{{ Form::close() }}
@endsection