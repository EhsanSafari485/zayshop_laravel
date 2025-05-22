@extends('Home.master')

@section('content')
<h1>{{ $blog->title }}</h1>
<p>دسته: {{ $blog->category->name }}</p>
<p>بازدید: {{ $blog->views }}</p>
<p>منتشر شده در: {{ \Hekmatinasser\Verta\Verta::instance($blog->published_at)->format('%d %B %Y') }}</p>

@if($blog->cover_image)
    <img src="{{ asset('images/coverBlog/' . $blog->cover_image) }}" alt="{{ $blog->title }}" style="max-width:300px">
@endif

<div>{!! nl2br(e($blog->content)) !!}</div>
@endsection
