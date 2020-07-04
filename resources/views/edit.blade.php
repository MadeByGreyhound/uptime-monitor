@extends('layouts.app')

@section('content')
	<h1>{{ $site->exists ? 'Edit site' : 'Add site' }}</h1>

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
			<button type="submit">{{ $site->exists ? 'Save site' : 'Add site' }}</button>
		</div>
	</form>
@endsection
