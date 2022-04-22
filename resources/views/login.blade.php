@extends('layouts.body')

@section('template')
	<div class="container login">
		<header class="site-header">
			<div class="header-title">
				Uptime Monitor
			</div>
		</header>

		<main class="content">
			<h1>Login</h1>

			<x-notification/>

			<form class="login-form" action="{{ route('login') }}" method="POST">
				<div class="field">
					<label for="login">Username or email</label>
					<input id="login" name="login" type="text" value="{{ old('login') }}" required autocomplete="username">
				</div>

				<div class="field">
					<label for="password">Password</label>
					<input id="password" name="password" type="password" required>
				</div>

				<div class="field">
					@csrf
					<button type="submit">Login</button>
				</div>
			</form>
		</main>
	</div>
@endsection
