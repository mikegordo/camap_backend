@extends('layout.departments')

@section('content')

	<h3>Отдел</h3>

	<p>Просмотр отдела</p>

	<span>ID {{ $department->id }}</span>
	<span>Name {{ $department->name }}</span>
	<span>Created {{ $department->created_at }}</span>
	<span>Updated {{ $department->updated_at }}</span>
	<span>Employees {{ $department->employees->count() }}</span>

	<p><a href="{{ URL::route('departments.edit', $department->id) }}">edit</a></p>

@stop
