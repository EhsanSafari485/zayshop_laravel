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
                        <h4>ثپت محصول</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route('Panel.product.update',$product->id) }}" id="productForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row mb-4">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">نام</label>
                            <input type="name" class="form-control" value="{{$product->name}}" name="name" id="inputEmail4" placeholder="نام  محصول">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail3">قیمت</label>
                            <input type="number" class="form-control" value="{{$product->price}}" name="price" id="inputEmail3" placeholder="قیمت را وارد کنید">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmai20">میزان تخفیف</label>
                            <input type="number" min="0" max="100" step="0.1" class="form-control" value="{{$product->discount}}" name="discount" id="inputEmai20" placeholder="مقدار تخفیف را وارد کنید">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail3">برند</label>
                            <input type="name" class="form-control" value="{{$product->brand}}" name="brand" id="inputEmail3" placeholder="برند محصول">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">slug</label>
                            <input type="slug" class="form-control" value="{{$product->slug}}" name="slug" id="inputEmail4" placeholder="مثال:lebas-mardane">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">دسته بندی</label>
                            <select id="inputState" name="category_id" class="form-control">
                                @foreach ($Categories as $category)
                                @if ($category->id==$product->category_id)
                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                @else
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">توضیحات</label>
                            <textarea class="form-control" name="description">{{$product->description}}</textarea>
                        </div>
                    </div>
                  <button type="submit" class="btn btn-primary mt-3">ثپت</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

</div>

@section('jssrc')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\product\productEditRequest', '#productForm'); !!}
@endsection
@endsection
