<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:700);

		body {
			margin:0;
			font-family:'Lato', sans-serif;
			text-align:center;
			color: #999;
		}

		.welcome {
			width: 500px;
			height: 200px;
			position: absolute;
			left: 40%;
			top: 25%;
			margin-left: -150px;
			margin-top: -100px;
		}

		a, a:visited {
			text-decoration:none;
		}

		h1 {
			font-size: 32px;
			margin: 16px 0 0 0;
		}

		.item span {
			margin-right: 20px;
		}



	</style>
</head>
<body>
	<div class="welcome">

		<h1>So, the map should be here.</h1>
		<br>

		<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d48355.22636843431!2d-73.96189534934148!3d40.7575894238258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2s!4v1405244129132" width="400" height="300" frameborder="0" style="border:0"></iframe>

		<h1>Yo ho ho, You have arrived.</h1>

		<h3>You've received <?php echo count($employees) ?> employees together with this page:</h3>

		@foreach ($employees as $item)
		<div class="item">
			<span>{{ $item->id }}</span>
			<span>{{ $item->fullName() }}</span>
			<span>{{ $item->department->name }}</span>
			<span>{{ $item->group->name }}</span>
		</div>
		@endforeach

		<p>If you want something else, go to HomeController</p>

		<p>
		<?php
			echo "Environment: " . App::environment();
		?>
		</p>

		<p><a href="/admin">Admin</a></p>

	</div>
</body>
</html>
