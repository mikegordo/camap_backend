@extends('layout.users')

@section('content')

	<h3>Пользователи</h3>

	@if (Session::has('error'))
	<div class="error">
		<p>{{ Session::get('error') }}</p>
	</div>
	@endif

	<p>
		Здесь у нас список всех пользователей, кто может редактировать базу.
		Информацию о наборе полей сущности User можно получить из /app/database/migrations/
	</p>

	<?php
	var_dump($users);
	?>

@stop
