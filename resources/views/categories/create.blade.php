@extends('layouts.app')

@section('content')

	<div class="container-fluid">
		<div class="jumbotron">
			<h1>Create a new category</h1>
		</div>

		<div class="col-md-12">

			@if(Session::has('category_created'))
	  			<div class="alert alert-success">
	  			{{ Session::get('category_created') }}
	  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  			</div>
			@endif

			<form action="{{ route('categories.store') }}" method="post">
				@include('partials.error-message')
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" class="form-control" value="{{ old('name') }}">
				</div>


				<button class="btn btn-primary" type="submit">Create</button>
				{{ csrf_field() }}
			</form>
		</div>
	</div>

@endsection