@extends('layout.security')

@section('content')

{{ Form::open(array('route' => 'login.post', 'class' => 'login_form')) }}

<h3>Authentication required</h3>

@if ($errors->any())
{{ implode('', $errors->all('<div class="error">:message</div>')) }}
@endif


<div class="item">
	{{ Form::label('email', 'E-Mail Address'); }}
	{{ Form::text('email'); }}
</div>

<div class="item">
	{{ Form::label('password', 'Password'); }}
	{{ Form::password('password'); }}
</div>

<div class="item">
	{{ Form::submit('Sign in'); }}
	{{ link_to_route('base', 'Cancel',null, array('class' => 'cancel')) }}
</div>

@if (Session::has('message'))
<div class="alert">
	<p>{{ Session::get('message') }}</p>
</div>
@endif

{{ Form::close() }}

@stop