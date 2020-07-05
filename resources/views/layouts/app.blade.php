<!DOCTYPE html>
<html>
	<head>
		<title>Uptime Monitor</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	</head>

	<body>
		<div class="container">
			<header>
				<div class="site-title">
					Uptime Monitor
				</div>
			</header>

			<main class="content">
				<x-notification/>

				@yield('content')
			</main>
		</div>
	</body>
</html>
