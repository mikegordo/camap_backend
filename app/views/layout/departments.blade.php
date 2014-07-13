@extends('layout.layout')

@section('wrap')
<div class="content">
	@yield('content')
</div>
@stop


@section('menu')
<a href="{{ URL::route('departments.index') }}">index</a>
<a href="{{ URL::route('departments.create') }}">add</a>
@stop
