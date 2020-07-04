@extends('layouts.app')

@section('content')
	<h1>Add Site</h1>

	<form method="POST" action="{{ route('storeSite') }}">
		@csrf

		<div class="field">
			<label for="url">Site URL</label>
			<input type="url" id="url" name="url" maxlength="1000" required>

			@error('url')
				<p class="error">{{ $errors->first('url') }}</p>
			@enderror
		</div>

		<div class="field">
			<button type="submit">Add site</button>
		</div>
	</form>
@endsection
