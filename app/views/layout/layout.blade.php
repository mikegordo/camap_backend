<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Camap</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
	<link href='http://fonts.googleapis.com/css?family=Ubuntu+Mono:400,700&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>

<!--	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>-->
<!--	<script src="{{ asset('js/script.js') }}"></script>-->
</head>
<body>

<div class="header">
	<a href="{{ URL::route('users.index') }}">users</a>
	<a href="{{ URL::route('departments.index') }}">departments</a>
	<a href="{{ URL::route('groups.index') }}">groups</a>
	<a href="{{ URL::route('specialties.index') }}">specialties</a>
	<a href="{{ URL::route('employees.index') }}">employees</a>
	<a href="{{ URL::route('logout') }}">logout</a>
</div>

<div class="menu">

	@yield('menu')

</div>

<div class="wrap">

	@yield('wrap')

</div>

</body>
</html>