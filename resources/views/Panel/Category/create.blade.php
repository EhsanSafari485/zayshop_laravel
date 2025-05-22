@extends('Panel.master')
@section('content')
<div id="content" class="main-content">


    <div class="container">

        <div class="row">
        <div id="flFormsGrid" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>ثپت دسته بندی</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route('Panel.category.store') }}" id="CategoryForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row mb-6">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">نام</label>
                            <input type="name" class="form-control" name="name" id="inputEmail4" placeholder="نام دسته بندی را وارد کنید ">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">تصویر</label>
                            <input type="file" class="form-control" name="image" id="inputPassword4">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail3">slug</label>
                            <input type="slug" class="form-control" name="slug" id="inputEmail3" placeholder="مثال:lebas-mardane">
                        </div>
                    </div>
                  <button type="submit" class="btn btn-primary mt-3">ورود</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

</div>

@section('jssrc')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\category\categoryRequest', '#CategoryForm'); !!}
@endsection
@endsection
