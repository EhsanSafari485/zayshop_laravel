@extends('Home.master')

@section('content')
<h1>لیست بلاگ‌ها</h1>
@foreach($blogs as $blog)
    <div>
        <a href="{{ route('blogs.show', $blog->slug) }}">
            <h2>{{ $blog->title }}</h2>
        </a>
        <p>دسته: {{ $blog->category->name }}</p>
        <p>بازدید: {{ $blog->views }}</p>
        <p>منتشر شده در: {{ \Hekmatinasser\Verta\Verta::instance($blog->published_at)->format('%d %B %Y') }}</p>
    </div>
@endforeach

{{ $blogs->links() }}
@endsection
