@extends('Home.master')
@section('content')
     <!-- Start Content -->
     <div class="container-fluid py-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="row" id="product-container">
                        <div class="d-flex justify-content-center align-items-center mt-3 mb-3">
                            <div class="text-center w-75 btn-success  p-2 rounded">علاقه‌مندی‌ها</div>&nbsp;&nbsp;&nbsp;
                            <a href="{{ route('Home.shop') }}" class="btn btn-success p-2 w-25">بازگشت
                            {{-- <button class="btn btn-success p-2 w-25">بازگشت</button> --}}
                        </a>
                        </div>
                        @php
                        $favoriteProducts = $products->filter(function ($product) use ($favorites) {
                            return $favorites->contains('product_id', $product->id);
                        });
                    @endphp

                    @if ($favoriteProducts->count() > 0)
                        @foreach ($favoriteProducts as $product)

                        <div class="col-6 col-md-4">
                            <div class="card mb-4 product-wap rounded-0">
                                {{-- دکمه علاقه‌مندی‌ها --}}
                                <button title="افزودن به علاقه‌مندی‌ها" class="btn favorite-btn text-white btn-heart shadow-none" data-product-id="{{ $product->id }}">
                                    @if ($favorites->contains('product_id', $product->id))
                                        <i class="fa-solid fa-heart"></i>
                                    @else
                                        <i class="fa-regular fa-heart"></i>
                                    @endif
                                </button>

                                {{-- لینک به صفحه محصول --}}
                                <a href="{{ route('Home.shop_single', ['slug'=>$product->slug]) }}"  rel="noopener noreferrer">
                                    <div class="card rounded-0">
                                        <div class="product-image-wrapper">
                                            @if($product->discount > 0)
                                                <div class="discount-badge">
                                                    %{{ intval($product->discount) }}
                                                </div>
                                            @endif

                                            @foreach ($product->images as $image)
                                                @if ($image->product_id == $product->id)
                                                    <img class="card-img rounded-0 img-fluid" src="{{ asset('images/product/' . $image->image) }}">
                                                    @break
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </a>

                                <div class="card-body">
                                    <a href="{{ route('Home.shop_single', ['slug'=>$product->slug]) }}"  class="h3 text-decoration-none">{{$product->name}}</a>

                                    @php
                                        $prices = 0;
                                        $discountedPrice = $product->price;
                                        if($product->discount > 0) {
                                            $discountedPrice = $product->price * (1 - $product->discount / 100); // محاسبه قیمت بعد از تخفیف
                                        }
                                    @endphp

                                    @foreach ($product->variants as $variant)
                                        @if ($product->id == $variant->product_id)
                                            @php
                                                $prices += $variant->stock;
                                            @endphp
                                        @endif
                                    @endforeach

                                    {{-- بررسی موجود بودن کالا --}}
                                    @if ($prices == 0)
                                        <p class="text-start mb-0 fw-bold" style="font-size: 18px;color: red">ناموجود</p>
                                    @else
                                        {{-- نمایش قیمت تخفیف خورده --}}
                                        <p class="text-start mb-0 fw-bold" style="font-size: 18px;">
                                            @if($product->discount > 0)
                                                <span style="text-decoration: line-through; color: grey;"> {{ number_format($product->price, 0) }}</span>
                                                <span class="text-success">
                                                     {{ number_format($discountedPrice, 0) }}تومان
                                                </span>
                                            @else
                                                <span> {{ number_format($product->price, 0) }}تومان</span>
                                            @endif
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
@endforeach
@else
    <div class="alert alert-warning text-center w-100">
        محصولی یافت نشد
    </div>
@endif



                    </div>
                </div>
            </div>
        </div>
     </div>


@section('js')

    {{-- دکمه علاقه مندی ها --}}
    <script>
       $(document).on('click', '.favorite-btn', function (e) {
    e.preventDefault();

    let button = $(this);
    let productId = button.data('product-id');
    let icon = button.find('i');

    $.ajax({
        url: "{{route('Home.favorite.toggle')}}", // این آدرس رو باید طبق route خودت تنظیم کنی
        type: 'POST',
        data: {
            product_id: productId,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            // تغییر کلاس آیکون
            if (response.favorited) {
                icon.removeClass('fa-regular').addClass('fa-solid');
            } else {
                icon.removeClass('fa-solid').addClass('fa-regular');
            }
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});

    </script>



@endsection

@endsection




