@extends('layouts.body')

@section('template')
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

				<a href="{{ route('logout') }}" class="button delete">Logout</a>
			</nav>
		</header>

		<main class="content">
			<x-notification/>

			@yield('content')
		</main>
	</div>
@endsection
