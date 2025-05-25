    @extends('Home.master')
    @section('content')
    @if(session('welcome'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '{{ session("welcome") }}',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
    @endif

    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            @php
            $i=0;
        @endphp
        @foreach ($sliders as $slider)
        @if ($i==0)
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="{{$i}}" class="active"></li>
        @php
                $i++;
            @endphp
            @else
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="{{$i}}"></li>
        @endif
            @endforeach
        </ol>
        <div class="carousel-inner">
            @php
                $i=0;
            @endphp
            @foreach ($sliders as $slider)


            @if ($i==0)
            <div class="carousel-item active">
                @php
                    $i++;
                @endphp
                @else
            <div class="carousel-item">
            @endif
            <a href="{{$slider->url}}" target="_blank">
                <div class="slider-image-wrapper">
                    <img class="slider-image" src="{{ asset('images/sliders/'.$slider->image) }}" alt="">
                </div>
            </a>
            </div>

            @endforeach
        </div>
        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a>
        </div>
    <!-- End Banner Hero -->


    <!-- Start Categories of The Month -->
        <div class="swiper categorySwiper">
            <div class="swiper-wrapper">
                @foreach ($categories as $category)
                <div class="swiper-slide text-center">
                <a class="a" href="{{ route('Home.shop', ['category'=>$category->id]) }}">
                    <img src="{{ asset('images/Category/'.$category->image) }}" class="rounded-circle img-fluid border" style="width: 120px;">
                    <h5 class="mt-3 mb-3 title-category">{{$category->name}}</h5>
                    {{-- <a class="btn btn-success">برو فروشگاه</a> --}}
                </a>
                </div>
                @endforeach
            </div>
        </div>

    <!-- End Categories of The Month -->
     <!-- baner 2 -->
<div class="img-slide0">
<a href="{{$slider1[0]->url??null}}" target="_blank" rel="noopener noreferrer">
<div>
        <img class="img-slide1" src="{{ asset('images/sliders/'.($slider1[0]->image??null)) }}" alt="">
</div>
</a>
<div>
    <a href="{{$slider2[0]->url??null}}" target="_blank" rel="noopener noreferrer">
        <div>
            <img class="img-slide2 slide1" src="{{ asset('images/sliders/'.($slider2[0]->image??null)) }}" alt="">
        </div>
    </a>
<a href="{{$slider2[1]->url??null}}" target="_blank" rel="noopener noreferrer">
    <div>
        <img class="img-slide2 slide2" src="{{ asset('images/sliders/'.($slider2[1]->image??null)) }}" alt="">
    </div>
</a>
</div>
</div>
</div>

     <!-- end baner 2 -->

    <!-- Start Featured Product -->
<div>
    <div>
            {{--  جدید ترین محصولات --}}

            <div class="title-product">
                    <p class="p-product">جدید ترین محصولات</p>
                    <a class="a-product" href="{{ route('Home.shop', ['sort' => 'newest']) }}" rel="noopener noreferrer">مشاهده همه</a>
            </div>
            <div class="product-bg">
                <div class="product">
            <div class="swiper ProductSwiper">
                <div class="swiper-wrapper">
                    @foreach ($productsNew as $product)
                    <div class="swiper-slide margin-swiper text-center">
                        <div class="card product-card h-100 border-0 shadow">
                                                    {{-- دکمه علاقه‌مندی‌ها --}}
                        <button title="افزودن به علاقه‌مندی‌ها" class="btn favorite-btn text-white btn-heart shadow-none" data-product-id="{{ $product->id }}">
                            @if ($favorites->contains('product_id', $product->id))
                                <i class="fa-solid fa-heart"></i>
                            @else
                                <i class="fa-regular fa-heart"></i>
                            @endif
                        </button>
                        <a href="{{ route('Home.shop_single', ['slug'=>$product->slug]) }}">
                        @if($product->discount > 0)
                        <div class="discount-badge">
                            %{{ intval($product->discount) }}
                        </div>
                    @endif
                            @php
                                $image=$product->images->first();
                            @endphp
                            <div class="product-image-wrapper">
                            <img src="{{$image ? asset('images/product/' . $image->image) : asset('images/product/default.jpg') }}" class="card-img-top product-image" alt="">
                            </div>
                            </a>
                            <div class="card-body product-body">
                            <a href="{{ route('Home.shop_single', ['slug'=>$product->slug]) }}">
                                <h5 class="card-title text-product product-title">{{$product->name}}</h5>
                            </a>
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
                            @if ($prices==0)
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
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

                </div>
            </div>
            {{-- پر تخفیف ترین محصولات --}}
            <div class="title-product">
                <p class="p-product">پر تخفیف ترین محصولات</p>
                <a class="a-product" href="{{ route('Home.shop', ['sort' => 'discounted']) }}" rel="noopener noreferrer">مشاهده همه</a>
        </div>
        <div class="product-bg">
            <div class="product">
        <div class="swiper ProductSwiper">
            <div class="swiper-wrapper">
                @foreach ($productsDiscount as $product)
                <div class="swiper-slide margin-swiper text-center">
                    <div class="card product-card h-100 border-0 shadow">
                                                {{-- دکمه علاقه‌مندی‌ها --}}
                    <button title="افزودن به علاقه‌مندی‌ها" class="btn favorite-btn text-white btn-heart shadow-none" data-product-id="{{ $product->id }}">
                        @if ($favorites->contains('product_id', $product->id))
                            <i class="fa-solid fa-heart"></i>
                        @else
                            <i class="fa-regular fa-heart"></i>
                        @endif
                    </button>
                    <a href="{{ route('Home.shop_single', ['slug'=>$product->slug]) }}">
                    @if($product->discount > 0)
                    <div class="discount-badge">
                        %{{ intval($product->discount) }}
                    </div>
                @endif
                        @php
                            $image=$product->images->first();
                        @endphp
                        <div class="product-image-wrapper">
                        <img src="{{$image ? asset('images/product/' . $image->image) : asset('images/product/default.jpg') }}" class="card-img-top product-image" alt="">
                        </div>
                        </a>
                        <div class="card-body product-body">
                        <a href="{{ route('Home.shop_single', ['slug'=>$product->slug]) }}">
                            <h5 class="card-title text-product product-title">{{$product->name}}</h5>
                        </a>
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
                        @if ($prices==0)
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
                            </p>                            @endif
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
        </div>
    </div>
    {{-- <section>
    <h2>آخرین مقالات</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($latestPosts as $post)
            <a href="{{ route('blog.show', $post) }}" class="block border rounded-lg p-4 hover:bg-gray-50">
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="rounded mb-2">
                <h3 class="font-bold text-lg">{{ $post->title }}</h3>
                <p class="text-gray-600 text-sm mt-1">{{ Str::limit($post->summary, 100) }}</p>
            </a>
        @endforeach
    </div>
    <div class="mt-4 text-center">
        <a href="{{ route('blog.index') }}" class="text-blue-600 hover:underline">مشاهده همه مقالات</a>
    </div>
</section> --}}

        </div>

    <!-- End Featured Product -->
    @section('js')
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
    } else {
        alert("خطایی رخ داد.");
    }
});

        });
    </script>
    @endsection
    @endsection

