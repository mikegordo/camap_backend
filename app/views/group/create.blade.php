@extends('layout.groups')

@section('content')

	<h3>Новая группа</h3>

	{{ Form::model($group, array('route' => array('groups.store'), 'autocomplete' => 'off')) }}

	@if ($errors->any())
	{{ implode('', $errors->all('<div class="error">:message</div>')) }}
	@endif

	<div class="item">
		{{ Form::label('name', 'Name'); }}
		{{ Form::text('name'); }}
	</div>

	<div class="item">
		{{ Form::submit('Create'); }}
		{{ link_to_route('groups.index', 'Cancel', null, array('class' => 'cancel')) }}
	</div>

	@if (Session::has('message'))
	<div class="alert">
		<p>{{ Session::get('message') }}</p>
	</div>
	@endif

	{{ Form::close() }}

@stop
