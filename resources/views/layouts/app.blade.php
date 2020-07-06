<!DOCTYPE html>
<html>
	<head>
		<title>Uptime Monitor</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	</head>

	<body>
		<div class="container">
			<header class="site-header">
				<div class="header-title">
					<a href="{{ route('viewSites') }}">Uptime Monitor</a>
				</div>

				<nav class="header-nav">
					<a href="{{ route('viewSites') }}" class="button">All sites</a>
					<a href="{{ route('createSite') }}" class="button">Add site</a>

					<form method="POST" action="{{ route('refresh') }}">
						@csrf

						<button type="submit" class="button">Check all sites</button>
					</form>
				</nav>
			</header>

			<main class="content">
				<x-notification/>

				@yield('content')
			</main>
		</div>
	</body>
</html>
