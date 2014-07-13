@extends('layout.specialties')

@section('content')

	<h3>Специальность</h3>

	<p>Просмотр специальности</p>

	<span>ID {{ $specialty->id }}</span>
	<span>Name {{ $specialty->name }}</span>
	<span>Created {{ $specialty->created_at }}</span>
	<span>Updated {{ $specialty->updated_at }}</span>
	<span>Employees {{ $specialty->employees->count() }}</span>

	<p><a href="{{ URL::route('specialties.edit', $specialty->id) }}">edit</a></p>


@stop
