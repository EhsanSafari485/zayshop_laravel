@if($products->count() > 0)
@foreach ($products as $product)

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
                            @php
                                $image=$product->images->first();
                            @endphp
                            <img class="card-img rounded-0 img-fluid" src="{{$image ? asset('images/product/' . $image->image) : asset('images/product/default.jpg') }}">

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
<div class="row">
    <div class="col d-flex">
        <ul class="pagination pagination-lg justify-content-end">
            {{ $products->appends(request()->query())->links() }}
        </ul>
    </div>
</div>
