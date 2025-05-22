@extends('Home.master')
@section('content')
    <!-- Open Content -->
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        @foreach ($product->images as $image)
                        <img class="card-img" src="{{ asset('images/product/'.$image->image) }}"  id="product-detail">
                        @break
                        @endforeach

                    </div>

                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach ($product->images as $image)
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="{{ asset('images/product/'.$image->image) }}" data-large="{{ asset('images/product/'.$image->image) }}">
                                </div>
                            @endforeach
                        </div>

                        <!-- دکمه‌های قبلی و بعدی -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>



                <!-- col end -->
                <div class="col-lg-7 mt-5" >
                    <div class="card">
                        <div class="card-body" id="card-body" data-product-id="{{$product->id}}">
                            <h1 class="h2">{{$product->name}}</h1>
                            @php
                            $discountedPrice =(int) $product->price;
                            if($product->discount > 0) {
                                $discountedPrice = $product->price * (1 - $product->discount / 100);
                            }
                        @endphp
                        @if($product->discount > 0)
                        <p class="h3 py-2" style="text-decoration: line-through; color: grey;"> {{ number_format($product->price, 0) }}<p>
                        <p class="text-success h3 py-2">{{ number_format($discountedPrice, 0) }}تومان</p>
                            @else
                            <p class="h3 py-2"> {{ number_format($discountedPrice, 0) }}تومان</p>
                            @endif
                            <ul class="list-inline padd-r-0">
                                <li class="list-inline-item">
                                    <h6>دسته بندی:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong>{{$product->category->name}}</strong></p>
                                </li>
                            </ul>

                            <h6>توضیحات:</h6>
                            <p>
                                {{$product->description}}
                            </p>
                            <h6>مشخصات:</h6>
                            <ul class="list-unstyled pb-3 padd-r-0">
                                @foreach ($product->attributes as $attribute)
                                <li>{{$attribute->attribute}}</li>
                                @endforeach
                            </ul>

                            <form action="{{ route('Home.cart.addToCart') }}" method="POST">
                                <input type="hidden" name="product-title" value="Activewear">
                                <div class="row">
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3 padd-r-0">
                                            <li class="list-inline-item">رنگ :
                                                <input type="hidden" name="product-color" id="product-color" value="C">
                                            </li>
                                            @php
                                            $printedSizes = [];
                                            @endphp
                                            @foreach ($product->variants as $variant)
                                            @if (!in_array($variant->color->name, $printedSizes))
                                            <li class="list-inline-item"><span class="btn @if ($variant->color->code==='#ffffff')
                                            text-black border border-dark
                                            @else
                                            text-white
                                            @endif  btn-color" data-color-id="{{ $variant->color_id }}" style="background-color: {{$variant->color->code}}">{{$variant->color->name}}</span></li>
                                            @php
                                            $printedSizes[] = $variant->color->name;
                                            @endphp
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3 padd-r-0">
                                            <li class="list-inline-item">سایز :
                                                <input type="hidden" name="product-size" id="product-size" value="S">
                                            </li>
                                            @php
                                            $printedSizes = [];
                                            @endphp
                                        @foreach ($product->variants as $variant)
                                        @if ($product->id==$variant->product_id)
                                            @if (!in_array($variant->size->name, $printedSizes))
                                                <li class="list-inline-item">
                                                    <span class="btn btn-success btn-size" data-size-id="{{ $variant->size_id }}">
                                                        {{ $variant->size->name }}
                                                    </span>
                                                </li>
                                                @php
                                                    $printedSizes[] = $variant->size->name;
                                                @endphp
                                            @endif
                                        @endif
                                        @endforeach

                                        </ul>
                                    </div>
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3 padd-r-0">
                                            <li class="list-inline-item text-right">
                                                تعداد
                                                <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                                            </li>
                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-minus">-</span></li>
                                            <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="availability-message" class="alert d-none mt-3" role="alert"></div>
                                <div id="total-price" class="mt-2 h4 text-success d-none"></div>
                                <div class="row pb-3">
                                    <div class="col d-grid">
                                        {{-- <button type="button" class="btn btn-success btn-lg" name="submit" value="buy">خرید</button> --}}
                                        {{-- <a href="" class="btn btn-success btn-lg">خرید</a> --}}


                                        <button type="button" id="btn-buy" class="btn btn-success btn-lg">خرید</button>
                                    </div>
                                    <div class="col d-grid">
                                        <button type="button" id="add-to-cart" data-product-id="{{$product->id}}" class="btn btn-success btn-lg" name="submit">افزودن به سبد خرید</button>
                                    </div>
                                </div>
                            </form>
                            <form id="buy-form" action="{{ route('purchase.direct') }}" method="post">
                                @csrf
                                <input type="hidden" name="variant_id" id="variant_id_input">
                                <input type="hidden" name="totalPrice" id="total_price_input" value="{{ $discountedPrice }}">
                                <input type="hidden" name="quantity" id="purchase_quantity" value="1">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Close Content -->



    <!-- End Article -->
    <section class="py-5">
        <div class="container">
            <div class="row text-left p-2 pb-3">
                <h4>محصولات مرتبط</h4>
            </div>

            <!--Start Carousel Wrapper-->
            <div class="product-bg">
                <div class="product">
            <div class="swiper ProductSwiper">
                <div class="swiper-wrapper">

                    @foreach ($products as $product)

                    <div class="col-6 col-md-4 m-3">
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
                                        $discountedPrice = $product->price * (1 - $product->discount / 100);
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
                                            <span> {{ number_format($discountedPrice, 0) }}تومان</span>
                                        @endif
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

                </div>
            </div>


        </div>
    </section>

@section('js')
@auth
<script>
    $(document).ready(function () {
    $('button[type=button]').prop('disabled', false);
    });
</script>
@else
<script>
    $(document).ready(function () {
    $('button[type=button]').prop('disabled', true);
    });
</script>
@endauth

<script>
let selectedColor = null;
let selectedSize = null;

$(document).ready(function () {
    let quantity = 1;
    let product_id=$('#card-body').data('product-id');



    // دکمه افزایش
    $('#btn-plus').on('click', function () {
        quantity++;
        $('#var-value').text(quantity);
        $('#product-quanity').val(quantity);
        checkAvailability();
    });

    // دکمه کاهش
    $('#btn-minus').on('click', function () {
        if (quantity > 1) {
            quantity--;
            $('#var-value').text(quantity);
            $('#product-quanity').val(quantity);
            checkAvailability();
        }
    });

    $('.btn-color').on('click', function () {
        selectedColor = $(this).data('color-id');
        checkAvailability();
    });

    $('.btn-size').on('click', function () {
        selectedSize = $(this).data('size-id');
        checkAvailability();
    });
//فانکشن موجودی
    function checkAvailability() {
        if (selectedColor && selectedSize) {
            $.ajax({
                url: '{{ route('Home.checkVariant') }}',
                method: 'POST',
                data: {
                    color_id: selectedColor,
                    size_id: selectedSize,
                    product_id:product_id,
                    quantity: quantity,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.available) {
                        $('#availability-message')
                            .removeClass('d-none alert-danger')
                            .addClass('alert-success')
                            .html('<i class="bi bi-check-circle-fill me-2 text-center"></i> محصول موجود است');
                        $('button[type=button]').prop('disabled', false);
                        const pricePerItem = response.price;
                        const total = pricePerItem * quantity;
                        $('#total-price')
                            .removeClass('d-none')
                            .text('جمع کل: ' + new Intl.NumberFormat().format(total) + ' تومان');
                            $('#variant_id').val(response.variant_id);
                            $('#purchase_quantity').val(quantity);
                    } else {
                        $('#availability-message')
                            .removeClass('d-none alert-success')
                            .addClass('alert-danger')
                            .html('<i class="bi bi-x-circle-fill me-2 text-center"></i> محصول موجود نیست یا تعداد کافی نمی باشد');
                        $('button[type=button]').prop('disabled', true);
                        $('#total-price').addClass('d-none').text('');
                        $('#variant_id').val('');
                    }
                }
            });
        }
    }

    // خرید مستقیم

    $('#btn-buy').on('click', function () {
    if (!selectedColor || !selectedSize) {
        Swal.fire({
                    icon: "error",
                    title: "لطفاً رنگ و سایز را انتخاب کنید.",
                    showConfirmButton: true,
                });
        return;
    }

    // ابتدا بررسی می‌کنیم که آیا variant وجود دارد یا نه
    $.ajax({
        url: '{{ route('Home.getVariantId') }}', // باید این مسیر رو در کنترلر درست کنی
        method: 'POST',
        data: {
            product_id: product_id,
            color_id: selectedColor,
            size_id: selectedSize,
            _token: '{{ csrf_token() }}'
        },
        success: function (response) {
            if (response.success) {

                $('#variant_id_input').val(response.variant_id);
                $('#purchase_quantity').val(quantity);

                // ارسال فرم
                $('#buy-form').submit();
            } else {
                Swal.fire({
                    icon: "error",
                    title: 'مشکلی در یافتن تنوع محصول رخ داد.',
                    showConfirmButton: true,
                });
            }
        }
    });
});

});

    // افزودن به سبد خرید
$('#add-to-cart').click(function() {
    if (!selectedColor || !selectedSize) {
        Swal.fire({
                    icon: "error",
                    title: "لطفاً رنگ و سایز را انتخاب کنید.",
                    showConfirmButton: true,
                });
        return;
    }

    var colorId = selectedColor;
    var sizeId = selectedSize;
    var quantity = $('#product-quanity').val();
    let productId = $(this).data('product-id');
    console.log(quantity);

    $.ajax({
        url: '{{ route("Home.cart.addToCart") }}',  // روت که به کنترلر مربوط می‌شود
        type: 'POST',
        data: {
            color_id: colorId,
            size_id: sizeId,
            quantity: quantity,
            product_id:productId,
            _token: $('meta[name="csrf-token"]').attr('content')  // توکن CSRF برای امنیت
        },
        success: function(response) {
                Swal.fire({
                    position: "top-end",
                    icon: response.success ? "success" : "error",
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1000
                });
        },
        error: function(xhr, status, error) {
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: xhr.responseJSON?.message || 'خطایی رخ داده است',
                    showConfirmButton: false,
                    timer: 1000
                });
        }
    });
});


    // نمایش عکس بزرگ
    $('.swiper-slide img').on('click', function () {
        let newSrc = $(this).data('large');
        $('#product-detail').fadeOut(200, function () {
            $(this).attr('src', newSrc).fadeIn(200);
        });
    });

</script>
<script>
    $('#carousel-related-product').slick({
        infinite: true,
        arrows: false,
        slidesToShow: 4,
        slidesToScroll: 3,
        dots: true,
        rtl:true,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 3
                }
            }
        ]
    });
</script>
    {{-- دکمه علاقه مندی ها --}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.favorite-btn', function (e) {
            e.preventDefault();
            let button = $(this);
            let productId = button.data('product-id');
            let icon = button.find('i');

            $.post("{{ route('Home.favorite.toggle') }}", {
                product_id: productId
            })
            .done(function (response) {
                button.toggleClass('active');
                if (button.hasClass('active')) {
                    icon.removeClass('fa-regular').addClass('fa-solid');
                } else {
                    icon.removeClass('fa-solid').addClass('fa-regular');
                }
            })
            .fail(function (xhr) {
    if (xhr.status === 401) {
        Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "ابتدا وارد حساب کاربری خود شوید.",
                    showConfirmButton: false,
                    timer: 1000
                });
        window.location.href = '/login'; // هدایت به صفحه لاگین
    } else {
        alert("خطایی رخ داد.");
    }
});

        });
    </script>
@endsection

@endsection


