@extends('layouts.app')

@section('content')
	@if($monitors)
		<table>
			<thead>
				<tr>
					<th>URL</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>

			<tbody>
				@foreach($monitors as $site)
					<tr>
						<td>{{ $site->url }}</td>
						<td>{{ 'up' == $site->uptime_status ? 'Up' : 'Down' }}</td>
						<td>Edit / Delete</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif

	<a href="{{ route('addSite') }}">Add Site</a>
@endsection
