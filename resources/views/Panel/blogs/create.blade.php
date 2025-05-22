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
@if ($errors->any())
    <div>
        <ul style="color: red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('Panel.blogs.store') }}" method="POST" enctype="multipart/form-data" class="w-100">
    @csrf

    <div class="row">
        <div class="form-group col-md-6">
            <label>عنوان:</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
        </div>

        <div class="form-group col-md-6">
            <label>دسته‌بندی:</label>
            <select class="form-control" name="category_id" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label>عکس کاور:</label>
        <input class="form-control" type="file" name="cover_image">
    </div>

    <div class="form-group">
        <label>متن:</label>
        <textarea name="content" id="editor" rows="10" required>{{ old('content') }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary mt-3">ارسال</button>
</form>

            </div>
        </div>
    </div>
</div>
</div>

</div>
<style>

.ck-editor__editable_inline {
    background-color: #1b2e4b !important;
    font-size: 16px !important;
    font-family: Tahoma, sans-serif !important;
}
</style>



@endsection
@section('jssrc')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
            uploadUrl: "{{ route('Panel.blogs.upload') }}?_token={{ csrf_token() }}"
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>

@endsection
