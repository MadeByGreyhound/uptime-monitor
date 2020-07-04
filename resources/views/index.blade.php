@extends('layouts.app')

@section('content')
	<h1>All Sites</h1>

	@if($sites)
		<div class="site-list">
			@foreach($sites as $site)
				<article class="site">
					<div class="site-status {{ str_replace(' ', '-', $site->uptime_status) }}">
						<span class="visually-hidden">{{ ucfirst($site->uptime_status) }}</span>

						@switch($site->uptime_status)
							@case('up')
								<span title="Site is up"><svg viewBox="0 0 352 288"><path d="M27.314 164.686c-6.249-6.248-16.38-6.248-22.628 0-6.248 6.249-6.248 16.38 0 22.628l96 96c6.545 6.544 17.26 6.187 23.355-.778l224-256c5.82-6.65 5.145-16.758-1.505-22.577-6.65-5.82-16.758-5.145-22.577 1.505L111.22 248.594l-83.907-83.908z"/></svg></span>
							@break

							@case('down')
								<span title="Site is down"><svg viewBox="0 0 256 256"><path d="M251.314 228.686l-224-224c-6.249-6.248-16.38-6.248-22.628 0-6.248 6.249-6.248 16.38 0 22.628l224 224c6.249 6.248 16.38 6.248 22.628 0 6.248-6.249 6.248-16.38 0-22.628z"/><path d="M228.686 4.686l-224 224c-6.248 6.249-6.248 16.38 0 22.628 6.249 6.248 16.38 6.248 22.628 0l224-224c6.248-6.249 6.248-16.38 0-22.628-6.249-6.248-16.38-6.248-22.628 0z"/></svg></span>
							@break

							@case('not yet checked')
								<span title="Site has not yet been checked"><svg viewBox="0 0 320 32"><path d="M304 0H16C7.163 0 0 7.163 0 16s7.163 16 16 16h288c8.837 0 16-7.163 16-16s-7.163-16-16-16z"/></svg></span>
							@break
						@endswitch
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
		<a href="{{ route('createSite') }}" class="button">Add Site</a>
	</div>
@endsection
