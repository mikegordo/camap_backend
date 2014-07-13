@extends('layout.users')

@section('content')

	<h3>Редактировать пользователя</h3>

	{{ Form::model($user, [
		'route'        => ['users.update', $user->id],
		'autocomplete' => 'off',
		'method'       => 'put'
		]) }}

	@if ($errors->any())
		{{ implode('', $errors->all('<div class="error">:message</div>')) }}
	@endif

	{{ Form::hidden('id'); }}

	<div class="item">
		{{ Form::label('name', 'Name'); }}
		{{ Form::text('name'); }}
	</div>

	<div class="item">
		{{ Form::label('email', 'E-Mail Address'); }}
		{{ Form::text('email'); }}
	</div>

	<div class="item">
		{{ Form::label('password', 'New Password'); }}
		{{ Form::password('password'); }}
	</div>

	<div class="item">
		{{ Form::label('blocked', 'Blocked'); }}
		{{ Form::checkbox('blocked', 1); }}
	</div>

	<div class="item">
		{{ Form::submit('Update'); }}
		{{ link_to_route('users.index', 'Cancel', null, array('class' => 'cancel')) }}
	</div>

	@if (Session::has('message'))
	<div class="alert">
		<p>{{ Session::get('message') }}</p>
	</div>
	@endif

	{{ Form::close() }}


	{{ Form::model($user, [
		'route'        => ['users.destroy', $user->id],
		'autocomplete' => 'off',
		'method'       => 'delete'
		]) }}
	{{ Form::submit('Delete'); }}
	{{ Form::close() }}


@stop
