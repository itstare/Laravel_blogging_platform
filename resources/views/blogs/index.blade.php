@extends('layouts.app')

@include('partials.meta_static')

@section('content')

<div class="container">

	@if(Session::has('blog_created'))
	  <div class="alert alert-success">
	  	{{ Session::get('blog_created') }}
	  	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  </div>
	@endif

	@if(Session::has('contact_sent'))
	  <div class="alert alert-success">
	  	{{ Session::get('contact_sent') }}
	  	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  </div>
	@endif

	<div class="search">
		<form method="get" action="{{ route('blogs') }}" role="search">
			<div class="input-group">
				<input type="text" name="term" class="form-control" placeholder="Search blogs" id="term">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary"><span>Search</span></button>
				</span>
			</div>
			<br>
		</form>
	</div>

@foreach ($blogs as $blog)
<div class="col-md-8 offset-md-2 text-center">
<h2><a href="{{ route('blogs.view', $blog->slug) }}">{{$blog->title}}</a></h2>

<div class="col-md-12">
	@if($blog->featured_image)

		<img src="/images/featured_images/{{ $blog->featured_image ? $blog->featured_image : '' }}" alt="{{ str_limit($blog->title, 50) }}" class="img-responsive featured-image" style="width:300px;height: auto;">

	@endif
</div>

<div class="lead">{!! str_limit($blog->body, 200) !!}</div>

@if($blog->user)

<i class="bi bi-person"></i> Author: <a href="{{ route('users.show', $blog->user->name) }}">{{ $blog->user->name }}</a> | <i class="bi bi-calendar3"></i> Posted: {{ $blog->created_at->diffForHumans() }} @if($blog->category->count())| <i class="bi bi-bookmarks"></i> Categories: @foreach($blog->category as $category)<a href="{{ route('categories.view', $category->slug) }}">{{ $category->name }}</a> @endforeach @endif

@endif
</div>
<br><hr><br>
@endforeach

<div class="text-center">
	{!! $blogs->links() !!}
</div>
</div>

@endsection