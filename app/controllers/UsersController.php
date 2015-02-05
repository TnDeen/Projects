<?php

/*
	location-of-this-file: app/controllers/
*/

class UsersController extends \BaseController {

	// Filters for checking if route parameter id's exist
	// and sometimes checking if logged in user is also the owner.
	public function __construct()
	{
		$this->beforeFilter('exists', array('only' => array('show', 'edit', 'update', 'destroy')));
		$this->beforeFilter('auth.owner', array('only' => array('edit', 'update', 'destroy')));
	}

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('users')->withUsers(User::all());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'username' => 'required|unique:users',
			'password' => 'required|min:6',
			'password-repeat' => 'required|same:password'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
			return Redirect::to('users/create')
				->withInput()
				->withErrors($validator->messages());

		User::create(array(
			'username' => Input::get('username'),
			'password' => Hash::make(Input::get('password')),
			'bio' => Input::get('bio')
		));

		return Redirect::to('users');
	}

	/**
	 * Display the specified resource.
	 * GET /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id);
		$owner = (Auth::id() === (int) $id);
		return View::make('profile')->withUser($user)->withOwner($owner);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /users/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{		
		return View::make('edit')->with('id', $id);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'username' => 'unique:users',
			'password' => 'min:6'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
			return Redirect::to('users/'.$id.'/edit')
				->withInput()
				->withErrors($validator->messages());

		$user = User::find($id);
		if (Input::has('username')) $user->username = Input::get('username');
		if (Input::has('bio')) $user->bio = Input::get('bio');
		if (Input::has('password')) $user->password = Hash::make(Input::get('password'));
		$user->save();

		return Redirect::to('users/'.$id);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$fallenOne = User::find($id);

		$fallenOne->delete();

		return Redirect::to('users');
	}

}