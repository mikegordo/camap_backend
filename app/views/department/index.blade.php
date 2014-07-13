@extends('layout.departments')

@section('content')

	<h3>Отделы</h3>

	@if (Session::has('error'))
	<div class="error">
		<p>{{ Session::get('error') }}</p>
	</div>
	@endif

	<p>
		Здесь у нас список всех отделов
	</p>

	<?php
	var_dump($departments);
	?>

@stop
