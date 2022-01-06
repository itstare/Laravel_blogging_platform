@extends('layouts.app')

@section('content')

<div class="container-fluid">
	<div class="jumbotron">
		<h1>Manage Users</h1>
	</div>

	<div class="col-md-12">
		<div class="row">
		@foreach($users as $user)
		<div class="col-md-4">

		<form method="post" action="{{ route('users.update', $user->id) }}">
			{{ method_field('patch') }}
			<div class="form-group">
				<input class="form-control" type="text" name="name" value="{{ $user->name }}" disabled>
			</div>

			<div class="form-group">
				@if($user->role->id === 1)
				<select name="role_id" class="form-control">
					<option selected>{{ $user->role->name }}</option>
					<option value="1">Admin</option>
					<option value="2">Author</option>
					<option value="3">Subscriber</option>
				</select>
				@else
				<select name="role_id" class="form-control">
					<option selected>{{ $user->role->name }}</option>
					<option value="2">Author</option>
					<option value="3">Subscriber</option>
				</select>
				@endif
			</div>

			<div class="form-group">
				<input type="email" name="email" class="form-control" value="{{ $user->email }}" disabled>
			</div>

			<div class="form-group">
				<input name="date" class="form-control" value="{{ $user->created_at->diffForHumans() }}" disabled>
			</div>

			<button type="submit" class="btn btn-primary btn-sm pull-left col-md-12">Update</button>
			{{ csrf_field() }}
		</form>

		<form action="{{ route('users.destroy', $user) }}" method="post">
			{{ method_field('delete') }}
			<button type="submit" class="btn btn-danger btn-sm pull-left mt-1 col-md-12">Delete</button>
			{{ csrf_field() }}
		</form>
       </div>
		@endforeach
	</div>
	</div>
</div>


@endsection