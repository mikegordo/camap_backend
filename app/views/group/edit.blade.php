@extends('layout.groups')

@section('content')

	<h3>Редактировать группу</h3>

	{{ Form::model($group, [
		'route'        => ['groups.update', $group->id],
		'autocomplete' => 'off',
		'method'       => 'put'
		]) }}

	@if ($errors->any())
		{{ implode('', $errors->all('<div class="error">:message</div>')) }}
	@endif

	{{ Form::hidden('id'); }}

	<div class="item">
		{{ Form::label('id', 'Id'); }}
		{{ Form::text('id', null, array('readonly' => 'readonly')); }}
	</div>

	<div class="item">
		{{ Form::label('name', 'Name'); }}
		{{ Form::text('name'); }}
	</div>

	<div class="item">
		{{ Form::submit('Update'); }}
		{{ link_to_route('groups.index', 'Cancel', null, array('class' => 'cancel')) }}
	</div>

	@if (Session::has('message'))
	<div class="alert">
		<p>{{ Session::get('message') }}</p>
	</div>
	@endif

	{{ Form::close() }}

	{{ Form::model($group, [
		'route'        => ['groups.destroy', $group->id],
		'autocomplete' => 'off',
		'method'       => 'delete'
		]) }}
	{{ Form::submit('Delete'); }}
	{{ Form::close() }}

@stop
