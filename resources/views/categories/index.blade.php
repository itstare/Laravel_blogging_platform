@extends('layouts.app')

@section('content')

@foreach($categories as $category)

<div class="container">
<h2><a href="{{ route('categories.view', $category->slug) }}">{{ $category->name }}</a></h2>
</div>
@endforeach


@endsection