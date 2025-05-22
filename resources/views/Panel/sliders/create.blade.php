@extends('Panel.master')
@section('content')
<div id="content" class="main-content">
    <div class="container">

        <div class="container">

<div class="row">
    <div id="flFormsGrid" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>ثپت اسلاید</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route('Panel.Sliders.store') }}" id="sliderForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row mb-4">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">url</label>
                            <input type="url" class="form-control" name="url" id="inputEmail4" placeholder="url را وارد کنید ">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">تصویر</label>
                            <input type="file" class="form-control" name="image" id="inputPassword4">
                        </div>
                    </div>
                    <div class="form-row mb-4">
                        <div class="form-group col-md-4">
                            <label for="inputState">نوع اسلاید</label>
                            <select id="inputState" name="role" class="form-control">
                                <option value="0" selected>اسلاید متحرک</option>
                                <option value="1">اسلاید ثابت 1</option>
                                <option value="2">اسلاید ثابت 2</option>
                            </select>
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
</div>

@section('jssrc')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\sliders\requestSlider', '#sliderForm'); !!}
@endsection
@endsection
