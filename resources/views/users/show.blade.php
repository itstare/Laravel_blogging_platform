@extends('layouts.app')

@section('content')
<div class="container">
	<h3>{{ $user->name }}'s blogs</h3>
	<p>Role: {{ $user->role->name }}</p>
	<hr>

	@foreach($user->blog as $blog)

        <h4><a href="{{ route('blogs.view', $blog->id) }}">{{ $blog->title }}</a></h4>

	@endforeach
</div>

@endsection