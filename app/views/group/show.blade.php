@extends('layout.groups')

@section('content')

	<h3>Группа</h3>

	<p>Просмотр группы работников</p>

	<span>ID {{ $group->id }}</span>
	<span>Name {{ $group->name }}</span>
	<span>Created {{ $group->created_at }}</span>
	<span>Updated {{ $group->updated_at }}</span>
	<span>Employees {{ $group->employees->count() }}</span>

	<p><a href="{{ URL::route('groups.edit', $group->id) }}">edit</a></p>


@stop
