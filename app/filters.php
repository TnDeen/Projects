<?php

/*
	location-of-this-file: app/
*/

// some irrelevant code...

Route::filter('exists', function($request)
{
	$id = $request->getParameter('users');
	$user = User::find($id);
	if ($user == null) return Redirect::to('users');
});

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});

Route::filter('auth.owner', function($request)
{
	$id = $request->getParameter('users');
	if (Auth::id() !== (int) $id) return Redirect::to('users');
});

// some more irrelevant code...