<!-- 
	location-of-this-file: app/views/
-->

@extends('layouts.master')

@section('title')
	{{ $user->username }}
@stop

@section('content')
	<p>
		<h3>Username: {{ $user->username }}</h3>
	</p>
	<p>
		{{ $user->bio }}
	</p>
	@if($owner)
		{{ HTML::link('users/'.$user->id.'/edit', 'Edit My Profile') }}
	@endif
@stop