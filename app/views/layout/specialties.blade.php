@extends('layout.layout')

@section('wrap')
<div class="content">
	@yield('content')
</div>
@stop

@section('menu')
<a href="{{ URL::route('specialties.index') }}">index</a>
<a href="{{ URL::route('specialties.create') }}">add</a>
@stop
