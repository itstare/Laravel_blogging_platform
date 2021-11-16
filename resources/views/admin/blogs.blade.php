@extends('layouts.app')

@section('content')

<div class="container-fluid">
	<div class="jumbotron">
		<h1>Manage blogs</h1>
	</div>

	<div class="row">
		<div class="col-md-6">
			<h3>Published</h3>
			<hr>

	        @foreach($publishedBlogs as $blog)

	        <h2><a href="{{ route('blogs.view', $blog->id) }}">{{ $blog->title }}</a></h2>
	        {!! str_limit($blog->body, 100) !!}

	        <form action="{{ route('blogs.update', $blog->id) }}" method="post">
	        	{{ method_field('patch') }}
	        	<input type="hidden" name="status" value="0">
	        	<button type="submit" class="btn btn-warning btn-sm">Save as draft</button>

	        	{{csrf_field()}}
	        </form>

	        @endforeach
	        	
       </div>

       <div class="col-md-6">
       	<h3>Drafts</h3>
       	<hr>

       	@foreach($draftBlogs as $blog)

       	<h2><a href="{{ route('blogs.view', $blog->id) }}">{{ $blog->title }}</a></h2>
	    {!! str_limit($blog->body, 100) !!}

	        <form action="{{ route('blogs.update', $blog->id) }}" method="post">
	        	{{ method_field('patch') }}
	        	<input type="hidden" name="status" value="1">
	        	<button type="submit" class="btn btn-success btn-sm">Publish blog</button>

	        	{{csrf_field()}}
	        </form>


       	@endforeach
       </div>

</div>
</div>

@endsection