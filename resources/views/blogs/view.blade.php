@extends('layouts.app')

@include('partials.meta_dynamic')

@section('content')

	<div class="container-fluid">
		<article>
		<div class="jumbotron">

			<div class="col-md-12">
				@if($blog->featured_image)

				<img src="/images/featured_images/{{ $blog->featured_image ? $blog->featured_image : '' }}" alt="{{ str_limit($blog->title, 50) }}" class="img-responsive featured-image">

				@endif
			</div>

		  <div class="col-md-12">
			<h1>{{ $blog->title }}</h1>
		  </div>

		  @if(Auth::user())
		  @if(Auth::user()->role_id === 1 || Auth::user()->role_id === 2 && $blog->user_id === Auth::user()->id)
         <div class="col-md-12">
		  <div class="btn-group">

			<a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-primary btn-xs pull-left btn-margin-right">Edit</a>

			<form action="{{ route('blogs.delete', $blog->id) }}" method="post">
				{{ method_field('delete') }}
				<button type="submit" class="btn btn-danger btn-xs pull-left">Delete</button>
				{{ csrf_field() }}
			</form>
		</div>
	</div>

        @endif
        @endif

</div>

		<div class="col-md-12">
			{!! $blog->body !!}
			@if($blog->user)

			Author: <a href="{{ route('users.show', $blog->user->name) }}">{{ $blog->user->name }}</a> | Posted: {{ $blog->created_at->diffForHumans() }}

			@endif
			<hr>
			<strong>Categories: </strong>
			@foreach($blog->category as $category)

			<span><a href="{{ route('categories.view', $category->slug) }}">{{ $category->name }}</a></span>

			@endforeach
		</div>
	</article>
	<hr>

	<aside>
		
        <div id="disqus_thread"></div>
<script>
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://localhost-g4cgpol4ne.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>

	</aside>
	</div>

@endsection
