<?php

/*
	location-of-this-file: app/controllers/
*/

class HomeController extends BaseController {

	// Filter for members area
	public function __construct()
	{
		$this->beforeFilter('auth', array('only' => 'getMembers'));
	}

	public function getIndex()
	{
		return Redirect::to('users');
	}

	public function getLogin()
	{
		return View::make('login');
	}
	public function postLogin()
	{
		$creds = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
		);

		if (Auth::attempt($creds)) {
			return Redirect::intended('users');
		} else {
			return Redirect::to('login')->withInput();
		}
	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('users');
	}

	public function getMembers()
	{
		return '<h1>This is the members area.</h1>';
	}

}