<!doctype html>
<html lang="fa">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>سبد خرید</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('cartAsset/style.css') }}">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

<div class="container cart_section">
    <div class="cart_title text-center">سبد خرید شما</div>
    @php
        $prics=0;
    @endphp
    @foreach ($cartItems as $cartItem)
    @php
        $variant = $cartItem->variant ?? null;
        $product = $variant->product ?? null;
    @endphp

    @if ($variant && $product)
    <div class="cart_list" id="cart-{{$cartItem->id}}">
      <ul class="list-unstyled m-0">

            <li class="cart_item">
                <div class="cart_item_image">
                    <img src="{{ asset('images/product/' . ($product->images->first()->image ?? 'default.png')) }}" alt="Product Image">
                </div>
                <div class="cart_item_info">
                    <!-- سطر اول -->
                    <div class="cart_item_row">
                        <div class="cart_item_col">
                            <div class="cart_item_title">نام محصول</div>
                            <div class="cart_item_text">{{ $product->name }}</div>
                        </div>
                        <div class="cart_item_col">
                            <div class="cart_item_title">رنگ</div>
                            <div class="cart_item_text text-white text-center" style="border-radius: 8px; background-color: {{$variant->color->code}}">{{ $variant->color->name ?? '-' }}</div>
                        </div>
                        <div class="cart_item_col">
                            <div class="cart_item_title">سایز</div>
                            <div class="cart_item_text">{{ $variant->size->name ?? '-' }}</div>
                        </div>
                        <div class="cart_item_col">
                            <div class="cart_item_title">تعداد</div>
                            <div class="cart_item_text">{{ $cartItem->quantity }}</div>
                        </div>
                    </div>

                    <!-- سطر دوم -->
                    @php
                    $discountedPrice =(int) $product->price;
                    if($product->discount > 0) {
                        $discountedPrice = $product->price * (1 - $product->discount / 100);
                    }
                @endphp
                    <div class="cart_item_row text-right">
                        <div class="cart_item_col">
                            <div class="cart_item_title">قیمت واحد</div>
                            <div id="priceA" class="cart_item_text">{{ number_format($discountedPrice) }} تومان</div>
                        </div>
                        <div class="cart_item_col">
                            <div class="cart_item_title">قیمت کل</div>
                            @php
                            $prics += $discountedPrice * $cartItem->quantity;
                            @endphp
                            <div id="priceB" class="cart_item_text">{{ number_format($discountedPrice * $cartItem->quantity) }} تومان</div>
                        </div>
                        <div class="cart_item_col cart_item_buttons" style="flex: 1 1 100%; text-align: center;">
                                <form id="buy-form" action="{{ route('purchase.direct') }}" method="post">
                                @csrf
                                <input type="hidden" name="variant_id" id="variant_id_input" value="{{$variant->id}}">
                                <input type="hidden" name="totalPrice" id="total_price_input" value="{{ $discountedPrice }}">
                                <input type="hidden" name="quantity" id="purchase_quantity" value="{{ $cartItem->quantity }}">
                                <button class="btn-green" id="btn-buy">خرید</button>
                            </form>
                            <form action="{{ route('Home.cart.destroy',$cartItem->id) }}" method="post">
                                @csrf
                            @method('delete')
                                <button type="button" data-id="{{$cartItem->id}}" class="btnDelete" title="حذف محصول">حذف</button>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
      </ul>
    </div>
    @endif
    @endforeach

  <div class="order_total d-flex justify-content-between align-items-center">
    <div class="order_total_title">جمع کل سفارش</div>
    <div class="order_total_amount" id="totalPrice">{{number_format($prics)}} تومان</div>
  </div>

  <div class="cart_buttons">
    <button class="btn-green" onclick="history.back()">ادامه خرید</button>
    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <button class="btn-green" type="submit">تسویه حساب</button>
    </form>
  </div>
</div>
<script>
    $(document).ready(function () {
        total();
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
function total(){
    $.ajax({
        type: "GET",
        url: '{{ route("Home.cart.total") }}',
        success: function (response) {
            $('#totalPrice').text(response.total + ' تومان');
        },
        error: function () {
            console.error('خطا در دریافت جمع کل سبد خرید.');
        }
    });
}
$('.btnDelete').click(function () {
    let $btn = $(this);
    let id = $btn.data('id');
    let form = $btn.closest('form');
    let deleteUrl = form.attr('action');

    Swal.fire({
        title: "آیا مطمئن هستید؟",
        text: "این عملیات غیرقابل بازگشت است!",
        icon: "warning",
        showCancelButton: true,
        cancelButtonColor: "#d33",
        confirmButtonColor: '#3085d6',
        confirmButtonText: "بله، حذف کن!",
        cancelButtonText: "لغو"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: deleteUrl,
                type: 'POST',
                data: {
                    "_method": "DELETE",
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'حذف شد!',
                            text: 'محصول با موفقیت حذف شد.',
                            icon: 'success',
                            confirmButtonColor: '#007bff',
                            confirmButtonText: 'باشه'
                        });
                        $('#cart-' + id).remove();
                        total();
                    } else {
                        Swal.fire('خطا!', 'خطایی در حذف محصول پیش آمد.', 'error');
                    }
                },
                error: function () {
                    Swal.fire('خطا!', 'خطایی در ارسال درخواست پیش آمد.', 'error');
                }
            });
        }
    });
});
    });
</script>
</body>
</html>
