<!DOCTYPE html>
<html>
	<head>
		<title>{{ "{$title} - " }}Uptime Monitor</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
		
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
		<link rel="manifest" href="/site.webmanifest">
		<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#8cd999">
		<meta name="apple-mobile-web-app-title" content="Uptime Monitor">
		<meta name="application-name" content="Uptime Monitor">
		<meta name="msapplication-TileColor" content="#8cd999">
		<meta name="theme-color" content="#8cd999">
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

					@if($has_sites)
						<form method="POST" action="{{ route('refresh') }}">
							@csrf

							<button type="submit" class="button">Check all sites</button>
						</form>
					@endif
				</nav>
			</header>

			<main class="content">
				<x-notification/>

				@yield('content')
			</main>
		</div>
	</body>
</html>
