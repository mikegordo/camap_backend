@extends('layout.layout')

@section('wrap')
<div class="content">
	@yield('content')
</div>
@stop

@section('menu')
	<a href="{{ URL::route('users.index') }}">index</a>
	<a href="{{ URL::route('users.create') }}">add</a>
@stop
