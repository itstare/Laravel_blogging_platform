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

Author: <a href="{{ route('users.show', $blog->user->name) }}">{{ $blog->user->name }}</a> | Posted: {{ $blog->created_at->diffForHumans() }}

@endif
</div>
<br><hr><br>
@endforeach
</div>

@endsection