<!-- 
	location-of-this-file: app/views/
-->

@extends('layouts.master')

@section('title')
	Users
@stop

@section('content')
	@if(Auth::check())
		Current user: {{ Auth::user()->username }}. ({{ HTML::link('logout', 'logout') }})
		<hr>
	@endif
	<h1>List of all users.</h1>
	@foreach($users as $user)
		<p>{{ $user->username }} ({{ HTML::link('users/'.$user->id, 'profile') }})</p>
	@endforeach
@stop