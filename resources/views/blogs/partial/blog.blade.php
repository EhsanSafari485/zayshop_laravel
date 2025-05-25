@if($blogs->count() > 0)
        @foreach($blogs as $blog)
            <div class="col-md-4">
                <div class="blog-card p-3">
                    @if($blog->cover_image)
                    <a href="{{ route('blogs.show', $blog->slug) }}" class="read-more">
                        <img src="{{ asset('images/coverBlog/' . $blog->cover_image) }}" alt="تصویر" class="rounded mb-3">
                        </a>
                    @endif
                    <div class="blog-title">{{ $blog->title }}</div>
                    <div class="blog-meta">
                     دسته: <a class="read-more" href="{{ route('blogs.index', ['category'=>$blog->category->id]) }}"> {{ $blog->category->name ?? 'بدون دسته' }}</a><br>
                        تاریخ: {{ \Morilog\Jalali\Jalalian::fromDateTime($blog->published_at)->format('%Y/%m/%d') }}
                    </div>
                    <a href="{{ route('blogs.show', $blog->slug) }}" class="read-more">مطالعه مقاله</a>
                </div>
            </div>
        @endforeach
@else
    <div class="alert alert-warning text-center w-100">
        مقاله ای یافت نشد
    </div>
@endif
<div class="row">
    <div class="col d-flex">
        <ul class="mt-4 d-flex justify-content-center">
            {{ $blogs->appends(request()->query())->links() }}
        </ul>
    </div>
</div>