@extends('layout.users')

@section('content')

	<h3>Новый пользователь</h3>

	{{ Form::model($user, array('route' => array('users.store'), 'autocomplete' => 'off')) }}

	@if ($errors->any())
	{{ implode('', $errors->all('<div class="error">:message</div>')) }}
	@endif

	<div class="item">
		{{ Form::label('name', 'Name'); }}
		{{ Form::text('name'); }}
	</div>

	<div class="item">
		{{ Form::label('email', 'E-Mail Address'); }}
		{{ Form::text('email'); }}
	</div>

	<div class="item">
		{{ Form::label('password', 'Password'); }}
		{{ Form::password('password'); }}
	</div>

	<div class="item">
		{{ Form::label('blocked', 'Blocked'); }}
		{{ Form::checkbox('blocked', 1); }}
	</div>

	<div class="item">
		{{ Form::submit('Create'); }}
		{{ link_to_route('users.index', 'Cancel', null, array('class' => 'cancel')) }}
	</div>

	@if (Session::has('message'))
	<div class="alert">
		<p>{{ Session::get('message') }}</p>
	</div>
	@endif

	{{ Form::close() }}

@stop
