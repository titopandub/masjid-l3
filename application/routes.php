<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/

Route::get('/', function()
{
	return View::make('master');
});

Route::controller(Controller::detect());

Route::any('login/(:all?)',         'users@login');
Route::any('logout',                'users@logout');
Route::get('/', array('as' => 'dashboard_index', 'uses' => 'dashboards@index'));

Route::group(array('before' => 'auth'), function ()
{
	Route::controller('accounts');
	Route::controller('balances');
	Route::controller('categories');
	Route::controller('donations');
	Route::controller('donors');
	Route::controller('expenses');
	Route::controller('groups');
	Route::controller('modules');
	Route::controller('reports');
	Route::controller('transactions');
	Route::get('users', array('as' => 'user_index', 'uses' => 'users@index'));
	Route::get('users/new', array('as' => 'user_new', 'uses' => 'users@new'));
	Route::get('users/edit/(:any)', array('as' => 'user_edit', 'uses' => 'users@edit'));
	Route::get('users/delete/(:any)', array('as' => 'user_delete', 'uses' => 'users@delete'));
});

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application. The exception object
| that is captured during execution is then passed to the 500 listener.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function($exception)
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Route::get('/', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login')->with('notification', 'Please login!');
});

Route::filter('check_permissions', function()
{
	$route = Router::route(Request::method(), URI::current());
	$uses = $route->action['uses'];
	list($controller, $action) = explode('@', $uses);

	$module = Module::where('controller', '=', $controller)->only('id');
	$group_id = Auth::user()->group_id;
	$check = Group::find($group_id)->modules()
						->where('module_id', '=', $module)
						->first();
	if ($check == null) {
		return View::make('error.forbidden');
	}
});