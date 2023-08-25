@extends('layouts.app')

@section('content')
	@if($sites->isNotEmpty())
		<div class="site-list">
			@foreach($sites as $site)
				<article class="site">
					<div class="site-status {{ $site->getUptimeStatusId() }}" aria-label="{{ $site->uptime_status }}">
						<x-icon :icon="$site->getUptimeStatusId()" />
					</div>

					<div class="site-url">
						<a href="{{ $site->url }}">
							<span class="short">{!! $site->getShortUrl() !!}</span>
							<span class="full">{!! $site->getFullUrl() !!}</span>
						</a>
					</div>

					<div class="site-actions">
						<a href="{{ route('editSite', $site->id) }}" class="button"><x-icon icon="edit" />Edit</a>

						<form method="POST" action="{{ route('destroySite', $site->id) }}">
							@csrf
							@method('DELETE')

							<button type="submit" class="button danger"><x-icon icon="delete" />Delete</button>
						</form>
					</div>
				</article>
			@endforeach
		</div>
	@else
		<p>You haven't added any sites yet.</p>
	@endif
@endsection
