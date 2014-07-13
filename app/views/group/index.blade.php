@extends('layout.groups')

@section('content')

	<h3>Группы</h3>

	@if (Session::has('error'))
	<div class="error">
		<p>{{ Session::get('error') }}</p>
	</div>
	@endif

	<p>
		Здесь у нас список всех групп работников
	</p>

	<?php
	var_dump($groups);
	?>

@stop
