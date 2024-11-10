@extends('layouts.app')

@section('cta')
	@if($showUrl)
		<a href="{{ route('viewSites') }}" class="button secondary"><x-icon icon="back" />Return to sites</a>
	@else
		<a href="{{ route('viewLogs') }}" class="button secondary"><x-icon icon="back" />View all logs</a>
	@endif
@endsection

@section('content')
	@if($logs->isNotEmpty())
		<div class="log-list {{ $showUrl ? 'log-list--url' : 'log-list--no-url' }} table">
			@foreach($logs as $log)
				<article class="log">
					<div class="date">
						{{ $log->date->format( 'D jS M Y H:i' ) }}
					</div>

					@if($showUrl)
						<div class="monitor-url">
							<a href="{{ route('viewSiteLogs', ['site' => $log->monitor]) }}">{!! $log->monitor->getShortUrl() !!}</a>
						</div>
					@endif

					<div class="event">
						<div class="status {{ $log->event }}" aria-hidden="true">
							<x-icon :icon="$log->event" />
						</div>

						{{ $log->getMessage() }}
					</div>
				</article>
			@endforeach
		</div>
	@else
		<p class="empty">No events have been logged yet.</p>
	@endif
@endsection
