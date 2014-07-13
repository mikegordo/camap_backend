@extends('layout.specialties')

@section('content')

	<h3>Специальности</h3>

	@if (Session::has('error'))
	<div class="error">
		<p>{{ Session::get('error') }}</p>
	</div>
	@endif

	<p>
		Здесь у нас список всех специальностей
	</p>

	<?php
	var_dump($specialties);
	?>

@stop
