@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="container-fluid">
		<div class="jumbotron">
			<h1>Contact page</h1>
		</div>

		<div class="col-sm-8 offset-md-2">
			
			<form method="post" action="{{ route('contact.send') }}">
				@include('partials.error-message')
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" class="form-control" value="{{ old('name') }}">
				</div>

				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="email" class="form-control" value="{{ old('email') }}">
				</div>

				<div class="form-group">
					<label for="subject">Subject</label>
					<input type="text" name="subject" class="form-control" value="{{ old('subject') }}">
				</div>

				<div class="form-group">
					<label for="mail_message">Message</label>
					<textarea name="mail_message" class="form-control my-editor">{{ old('mail_message') }}</textarea>

					<div>
						<button class="btn btn-primary mt-1" type="submit">Send</button>
					</div>
				</div>
				{{ csrf_field() }}	

			</form>
		</div>
	</div>
</div>

@endsection