<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Masjid App :: Al-Muttaqin</title>
	<?php 
	echo HTML::style('css/normalize.css'); 
	echo HTML::style('css/vendors/jquery-ui/jquery-ui-1.8.16.custom.css');
	echo HTML::style('css/vendors/bootstrap/bootstrap.css');
	echo HTML::style('css/vendors/datatables/dataTables.bootstrap.css');
	echo HTML::style('css/style.css');
	echo HTML::style('css/vendors/bootstrap/bootstrap-responsive.css');
	echo HTML::style('css/print.css', array('media' => 'print'));
	?>
</head>
<body>
	<div class="navbar">
		<div class="navbar-inner navbar-fixed-top">
			<a class="brand" href="#">Masjid Al-Muttaqin</a>
			<ul class="nav">
				<li><a href="#">Home</a></li>
				@if(! Auth::check())
				<li><a href="/login">Login</a></li>
				@endif
			</ul>
			<ul class="nav pull-right">
				@if(Auth::check())
				<li><a href="/logout">Logout</a></li>
				@endif
			</ul>
		</div>
	</div>
	
	<div id="container" class="container-fluid">
		<div class="row-fluid">
			<div class="span2">
				@if(Auth::check())
				<ul class="nav nav-tabs nav-stacked">
					@forelse ($navigation_modules as $module)
						<li>{{ HTML::link_to_action($module->controller . "@index", $module->name) }}</li>
					@empty
					<li>Nothing</li>
					@endforelse
				</ul>
				@endif
			</div>
			<div class="span10">
				@yield('container')
				@yield('modal')
			</div>
		</div>
	</div>
	
	<div id="delete-dialog" title="Confirmation Required">
		Are you sure to delete this?
	</div>

	<?php 
	echo HTML::script('js/vendors/jquery-1.9.1.js'); 
	echo HTML::script('js/vendors/jquery-migrate-1.1.1.js'); 
	echo HTML::script('js/vendors/bootstrap.js'); 
	echo HTML::script('js/vendors/jquery-ui-1.10.0.custom.min.js');
	echo HTML::script('js/vendors/jquery.dataTables.js');
	echo HTML::script('js/vendors/jquery.dataTables.rowGrouping.js');
	echo HTML::script('js/vendors/dataTables.bootstrap.js');
	echo HTML::script('js/vendors/jquery.livequery.js');
	echo HTML::script('js/vendors/jquery.printElement.min.js');
	echo HTML::script('js/vendors/date.js');
	echo HTML::script('js/vendors/jquery.helper.js');
	echo HTML::script('js/restfulizer.js'); 
	echo HTML::script('js/app.js'); 
	?>
	@yield('javascript')

</body>
</html>
