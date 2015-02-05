<!-- 
	location-of-this-file: app/views/
-->

@extends('layouts.master')

@section('title')
	Join us
@stop

@section('content')
	@foreach($errors->all() as $error)
		<p>{{ $error }}</p>
	@endforeach
	{{ Form::open(array('url' => 'users')) }}
		<p>
			{{ Form::label('username', 'Username*') }}
			{{ Form::text('username') }}
		</p>
		<p>
			{{ Form::label('bio', 'Bio') }}
			{{ Form::textarea('bio') }}
		</p>
		<p>
			{{ Form::label('password', 'Password*') }}
			{{ Form::password('password') }}
		</p>
		<p>
			{{ Form::label('password-repeat', 'Password-Repeat*') }}
			{{ Form::password('password-repeat') }}
		</p>
		<p>
			{{ Form::submit() }}
		</p>
	{{ Form::close() }}
@stop