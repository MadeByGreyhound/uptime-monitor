@extends('layouts.app')

@section('content')
	<div class="container">
		<form method="POST" action="{{ route($site->exists ? 'updateSite' : 'storeSite', $site->id) }}">
			@csrf

			<div class="field">
				<label for="url">Site URL</label>
				<input type="url" id="url" name="url" maxlength="1000" required value="{{ old('url', $site->url) }}">

				@error('url')
				<p class="error">{{ $errors->first('url') }}</p>
				@enderror
			</div>

			<div class="field">
				<div class="field split">
					<a href="{{ route('viewSites') }}" class="button"><x-icon icon="back" />Back to site list</a>

					<button type="submit" class="primary">
						@if( $site->exists )
							<x-icon icon="save" />Save site
						@else
							<x-icon icon="add" />Add site
						@endif
					</button>
				</div>

			</div>
		</form>
	</div>
@endsection
