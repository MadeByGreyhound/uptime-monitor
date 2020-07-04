@extends('layouts.app')

@section('content')
	<h1>All Sites</h1>

	@if($sites)
		<div class="site-list">
			@foreach($sites as $site)
				<article class="site">
					<div class="site-status {{ 'up' === $site->uptime_status ? 'up' : 'down' }}">
						<span class="visually-hidden">{{ 'up' === $site->uptime_status ? 'Up' : 'Down' }}</span>

						@if('up' === $site->uptime_status)
							<svg viewBox="0 0 352 288"><path d="M27.314 164.686c-6.249-6.248-16.38-6.248-22.628 0-6.248 6.249-6.248 16.38 0 22.628l96 96c6.545 6.544 17.26 6.187 23.355-.778l224-256c5.82-6.65 5.145-16.758-1.505-22.577-6.65-5.82-16.758-5.145-22.577 1.505L111.22 248.594l-83.907-83.908z"/></svg>
						@else
							<svg viewBox="0 0 256 256"><path d="M251.314 228.686l-224-224c-6.249-6.248-16.38-6.248-22.628 0-6.248 6.249-6.248 16.38 0 22.628l224 224c6.249 6.248 16.38 6.248 22.628 0 6.248-6.249 6.248-16.38 0-22.628z"/><path d="M228.686 4.686l-224 224c-6.248 6.249-6.248 16.38 0 22.628 6.249 6.248 16.38 6.248 22.628 0l224-224c6.248-6.249 6.248-16.38 0-22.628-6.249-6.248-16.38-6.248-22.628 0z"/></svg>
						@endif
					</div>

					<div class="site-url">
						<a href="{{ $site->url }}">{{ $site->url }}</a>
					</div>

					<div class="site-actions">
						<a href="#" class="button disable">Disable</a>
						<a href="#" class="button edit">Edit</a>
						<a href="#" class="button delete">Delete</a>
					</div>
				</article>
			@endforeach
		</div>
	@endif

	<div class="actions">
		<a href="{{ route('addSite') }}" class="button">Add Site</a>
	</div>
@endsection
