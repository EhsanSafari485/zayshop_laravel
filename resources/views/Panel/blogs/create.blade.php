@extends('Panel.master')

@section('content')


<div id="content" class="main-content">


    <div class="container-fluid px-4">

        <div class="row mt-5">
        <div id="flFormsGrid" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>ساخت بلاگ جدید</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
<form action="{{ route('Panel.blogs.store') }}" method="POST" id="blogForm" enctype="multipart/form-data" class="w-100">
    @csrf

    <div class="row">
        <div class="form-group col-md-6">
            <label>عنوان:</label>
            <input type="text" id="title" class="form-control " name="title" value="{{ old('title') }}">
        </div>

        <div class="form-group col-md-6">
            <label>دسته‌بندی:</label>
            <select class="form-control" id="category" name="category_id">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
    <div class="form-group col-md-6">
        <label>عکس کاور:</label>
        <input class="form-control" id="image" type="file" name="cover_image" >
    </div>
    <div class="form-group col-md-6">
        <label>slug:</label>
        <input class="form-control" id="slug" type="slug" name="slug" value="{{ old('slug') }}">
    </div>
    </div>
    <div class="form-group">
        <label>متن:</label>
    <textarea name="content" id="summernote">{{ old('content') }}</textarea><br>

    </div>

    <button type="submit" class="btn btn-primary mt-3">ارسال</button>
</form>

            </div>
        </div>
    </div>
</div>
</div>

</div>

@section('jssrc')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\blog\blogRequest', '#blogForm'); !!}
{{-- Summernote CSS --}}
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

{{-- Summernote JS --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

<script>
$(document).ready(function() {
  $('#summernote').summernote({
    placeholder: 'محتوای مقاله را وارد کنید...',
    tabsize: 2,
    height: 400,
    lang: 'fa-IR',
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
      ['fontname', ['fontname']],
      ['fontsize', ['fontsize']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['height', ['height']],
      ['table', ['table']],
      ['insert', ['link', 'picture', 'video', 'hr']],
      ['view', ['fullscreen', 'codeview', 'help']]
    ],
    callbacks: {
      onImageUpload: function(files) {
        let data = new FormData();
        data.append('file', files[0]);
        data.append('_token', '{{ csrf_token() }}');  // توجه: در Blade باید این مقدار رندر شود

        $.ajax({
          url: '{{ route("Panel.blogs.upload_image") }}',       // مسیر آپلود عکس در لاراول
          method: 'POST',
          data: data,
          contentType: false,
          processData: false,
          success: function(response) {
            if (response.success) {
              $('#summernote').summernote('insertImage', response.url);
            } else {
              alert('آپلود تصویر با خطا مواجه شد');
            }
          },
          error: function() {
            alert('خطا در ارسال درخواست آپلود تصویر');
          }
        });
      }
    }
  });
});

  
</script>

@endsection

@endsection





