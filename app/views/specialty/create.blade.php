@extends('layout.specialties')

@section('content')

	<h3>Новая специальность</h3>

	{{ Form::model($specialty, array('route' => array('specialties.store'), 'autocomplete' => 'off')) }}

	@if ($errors->any())
	{{ implode('', $errors->all('<div class="error">:message</div>')) }}
	@endif

	<div class="item">
		{{ Form::label('name', 'Name'); }}
		{{ Form::text('name'); }}
	</div>

	<div class="item">
		{{ Form::submit('Create'); }}
		{{ link_to_route('specialties.index', 'Cancel', null, array('class' => 'cancel')) }}
	</div>

	@if (Session::has('message'))
	<div class="alert">
		<p>{{ Session::get('message') }}</p>
	</div>
	@endif

	{{ Form::close() }}

@stop
