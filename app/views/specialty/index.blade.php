@extends('layout.specialties')

@section('content')

	<h3>Специальности</h3>

	@if (Session::has('error'))
	<div class="error">
		<p>{{ Session::get('error') }}</p>
	</div>
	@endif

	<p>
		Здесь у нас список всех специальностей
	</p>

	@foreach ($specialties as $item)
	<div class="item">

		<span><a href="{{ URL::route('specialties.show', $item->id) }}">{{ $item->id }}</a></span>
		<span class="long"><a href="{{ URL::route('specialties.show', $item->id) }}">{{ $item->name }}</a></span>
		<span>@if ($item->created_at->format('U') > 0) {{ $item->created_at->format('Y-m-d H:i:s') }} @endif</span>

	</div>
	@endforeach

@stop
