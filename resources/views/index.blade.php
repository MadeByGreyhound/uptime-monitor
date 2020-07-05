@extends('layouts.app')

@section('content')
	<h1>All Sites</h1>

	@if($sites)
		<div class="site-list">
			@foreach($sites as $site)
				<article class="site">
					<div class="site-status {{ str_replace(' ', '-', $site->uptime_status) }}">
						<span class="visually-hidden">{{ ucfirst($site->uptime_status) }}</span>

						@if($site->uptime_check_enabled)
							@switch($site->uptime_status)
								@case('up')
									<span title="Site is up" class="status up"><svg viewBox="0 0 352 288"><path d="M27.314 164.686c-6.249-6.248-16.38-6.248-22.628 0-6.248 6.249-6.248 16.38 0 22.628l96 96c6.545 6.544 17.26 6.187 23.355-.778l224-256c5.82-6.65 5.145-16.758-1.505-22.577-6.65-5.82-16.758-5.145-22.577 1.505L111.22 248.594l-83.907-83.908z"/></svg></span>
								@break

								@case('down')
									<span title="Site is down" class="status down"><svg viewBox="0 0 256 256"><path d="M251.314 228.686l-224-224c-6.249-6.248-16.38-6.248-22.628 0-6.248 6.249-6.248 16.38 0 22.628l224 224c6.249 6.248 16.38 6.248 22.628 0 6.248-6.249 6.248-16.38 0-22.628z"/><path d="M228.686 4.686l-224 224c-6.248 6.249-6.248 16.38 0 22.628 6.249 6.248 16.38 6.248 22.628 0l224-224c6.248-6.249 6.248-16.38 0-22.628-6.249-6.248-16.38-6.248-22.628 0z"/></svg></span>
								@break
							@endswitch
						@endif
					</div>

					<div class="site-url">
						<a href="{{ $site->url }}">{{ $site->url }}</a>
					</div>

					<div class="site-actions">
						<form method="POST" action="{{ route('toggleSite', $site->id) }}">
							@csrf

							<button type="submit" class="button toggle">{{ $site->uptime_check_enabled ? 'Disable' : 'Enable' }}</button>
						</form>

						<a href="{{ route('editSite', $site->id) }}" class="button edit">Edit</a>

						<form method="POST" action="{{ route('destroySite', $site->id) }}">
							@csrf
							@method('DELETE')

							<button type="submit" class="button delete">Delete</button>
						</form>
					</div>
				</article>
			@endforeach
		</div>
	@endif

	<div class="actions">
		<a href="{{ route('createSite') }}" class="button">Add Site</a>
	</div>
@endsection
