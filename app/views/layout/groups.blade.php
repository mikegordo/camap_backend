@extends('layout.layout')

@section('wrap')
<div class="content">
	@yield('content')
</div>
@stop

@section('menu')
<a href="{{ URL::route('groups.index') }}">index</a>
<a href="{{ URL::route('groups.create') }}">add</a>
@stop
