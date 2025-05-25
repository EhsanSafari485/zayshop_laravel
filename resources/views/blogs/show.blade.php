@extends('Home.master')
@section('content')
<div class="container my-5">

    <!-- Blog Section -->
    <div class="blog-container">

        <h1 class="blog-title mb-3">{{ $blog->title }}</h1>

        <div class="blog-meta mb-4">
            <span>دسته: {{ $blog->category->name ?? 'بدون دسته' }}</span> |
            <span>نویسنده: {{ $blog->users->name ?? 'نامشخص' }}</span> |
            <span>تاریخ: {{ \Morilog\Jalali\Jalalian::fromDateTime($blog->published_at)->format('%Y/%m/%d') }}</span> |
            <span>تعداد بازدید: {{ $blog->views ?? 'نامشخص' }}</span>
        </div>

        @if($blog->cover_image)
        <div class="text-center mb-4">
            <img src="{{ asset('images/coverBlog/' . $blog->cover_image) }}" alt="تصویر مقاله" class="img-fluid rounded">
        </div>
        @endif

        <div class="blog-content">
            {!! $blog->content !!}
        </div>

    </div>
    
        <!-- فرم ثبت نظر -->
<form id="commentForm" method="POST" action="{{ route('blogs.postComment') }}">
    @csrf
    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
    <div class="mb-3">
        <label for="comment" class="form-label">متن نظر</label>
        <textarea name="comment" class="form-control" rows="4" required></textarea>
    </div>
    <button type="submit" class="btn btn-green">ارسال نظر</button>
</form>

<div class="comment-box">
    <h4 class="mb-4">دیدگاه‌ها</h4>

    <div class="mb-5" id="comment-list"></div>

    <button id="load-more" data-page="1" data-blog="{{ $blog->id }}" class="btn btn-secondary mt-3 d-none">
        نمایش بیشتر
    </button>
</div>



    <!-- Related Posts Section -->
    <div class="related-posts">
        <h4 class="mb-4">مقالات مرتبط</h4>

        <div class="row">
            @foreach($relatedBlogs as $related)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($related->cover_image)
                        <img src="{{ asset('images/coverBlog/' . $related->cover_image) }}" class="card-img-top" alt="تصویر مقاله">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $related->title }}</h5>
                        <a href="{{ route('blogs.show', $related->slug) }}" class="btn btn-sm btn-green mt-2">مشاهده</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
@section('js')
<script>
    $(document).ready(function () {
        let isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};

        $('#commentForm').on('submit', function (e) {
            e.preventDefault();

            if (!isAuthenticated) {
                Swal.fire({
                    icon: 'warning',
                    title: 'برای ثبت نظر باید وارد شوید',
                    text: 'لطفاً ابتدا وارد حساب کاربری خود شوید.',
                    showCancelButton: true,
                    confirmButtonText: 'ورود',
                    cancelButtonText: 'انصراف',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('login') }}";
                    }
                });
                return;
            }

            let form = $(this)[0];
            let formData = new FormData(form);

            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'نظر شما در صورت تایید ادمین ثبت می شود',
                            confirmButtonText: 'باشه',
                            confirmButtonColor: '#3085d6',
                        });

                        $('#commentForm')[0].reset(); // پاک کردن فرم
                    }
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطا',
                        text: 'مشکلی در ثبت نظر پیش آمده است!',
                    });
                }
            });
        });
    });

    $(document).ready(function () {
        let loading = false;

        function loadComments() {
            if (loading) return;

            loading = true;
            let $btn = $('#load-more');
            let page = parseInt($btn.data('page'));
            let blogId = $btn.data('blog');

            $.ajax({
                type: 'POST',
                url: '{{ route("blogs.loadComments") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    blog_id: blogId,
                    page: page
                },
                success: function (res) {
                    $('#comment-list').append(res.html);

                    if (res.has_more) {
                        $btn.data('page', page + 1);
                        $btn.removeClass('d-none');
                    } else {
                        $btn.hide();
                    }

                    loading = false;
                },
                error: function () {
                    alert('خطا در بارگذاری کامنت‌ها');
                    loading = false;
                }
            });
        }

        $('#load-more').on('click', function () {
            loadComments();
        });

        loadComments(); // اجرای اولیه
    });
</script>



</script>
@endsection

@endsection
