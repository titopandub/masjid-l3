<?php

class Base_Controller extends Controller {

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

	public function __construct()
	{
		if (! (Auth::guest())) {
			$user_id = Auth::user()->id;
			$modules = Cache::get($user_id . 'modules', function () use ($user_id)
			{
				$group_id = Auth::user()->group_id;
				$modules = Group::find($group_id)->modules()->order_by('order', 'asc')->get();
				Cache::forever($user_id . 'modules', $modules);
				return $modules;
			});
			
			return View::share('navigation_modules', $modules);
		}
		
	}
}