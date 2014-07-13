@extends('layout.users')

@section('content')

	<h3>Пользователь</h3>

	<p>Просмотр пользователя</p>

	<span>ID {{ $user->id }}</span>
	<span>Name {{ $user->name }}</span>
	<span>E-mail {{ $user->email }}</span>
	<span>Blocked {{ $user->blocked }}</span>
	<span>Created {{ $user->created_at }}</span>
	<span>Updated {{ $user->updated_at }}</span>

	<p><a href="{{ URL::route('users.edit', $user->id) }}">edit</a></p>

@stop
