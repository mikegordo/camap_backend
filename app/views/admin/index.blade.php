@extends('layout.users')

@section('content')

	<h3>Пользователи</h3>

	@if (Session::has('error'))
	<div class="error">
		<p>{{ Session::get('error') }}</p>
	</div>
	@endif

	<p>
		Здесь у нас список всех пользователей, кто может редактировать базу.
	</p>

	@foreach ($users as $user)
		<div class="item">

			<span><a href="{{ URL::route('users.show', $user->id) }}">{{ $user->id }}</a></span>
			<span class="long"><a href="{{ URL::route('users.show', $user->id) }}">{{ $user->email }}</a></span>
			<span>{{ $user->name }}</span>
			<span>@if (!$user->blocked) Active @else Blocked @endif</span>
			<span>@if ($user->created_at->format('U') > 0) {{ $user->created_at->format('Y-m-d H:i:s') }} @endif</span>

		</div>

	@endforeach

@stop
