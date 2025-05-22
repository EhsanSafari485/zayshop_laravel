<div class="row">
    <div class=" show-order">
        <h4 class="text-center">اطلاعات خریدار</h4>
        @php
            $user=$order->user;
        @endphp
        <ul class="list-unstyled">
            <li class="mb-3 d-flex align-items-center">
                <i data-feather="mail" class="me-2"></i>
                <span class="fw-bold me-1">نام خریدار:</span>
                {{$user->name}}
            </li>
            <li class="mb-3 d-flex align-items-center">
                <i data-feather="map-pin" class="me-2"></i>
                <span class="fw-bold me-1">ایمیل:</span>
                {{$user->email}}
            </li>
            <li class="mb-3 d-flex align-items-center">
                <i data-feather="map-pin" class="me-2"></i>
                <span class="fw-bold me-1">آدرس:</span>
                {{$user->address}}
            </li>
            <li class="mb-3 d-flex align-items-center">
                <i data-feather="phone" class="me-2"></i>
                <span class="fw-bold me-1">تلفن:</span>
                {{$user->phone}}
            </li>
        </ul>
    </div>
    <hr>
    @php
        $i=1;
    @endphp
@foreach ($order->items as $item)
    <div class="show-order">
        <h4 class="text-center">سفارش شماره {{$i++}}</h4>
        <ul class="list-unstyled">
            <li class="mb-3 d-flex align-items-center">
                <i data-feather="user" class="me-2"></i>
                <span class="fw-bold me-1">نام محصول:</span>
                {{$item->variant->product->name}}
            </li>
            <li class="mb-3 d-flex align-items-center">
                <i data-feather="mail" class="me-2"></i>
                <span class="fw-bold me-1">رنگ:</span>
                {{$item->variant->color->name}}
            </li>
            <li class="mb-3 d-flex align-items-center">
                <i data-feather="mail" class="me-2"></i>
                <span class="fw-bold me-1">سایز:</span>
                {{$item->variant->size->name}}
            </li>
            <li class="mb-3 d-flex align-items-center">
                <i data-feather="mail" class="me-2"></i>
                <span class="fw-bold me-1">تعداد:</span>
                {{$item->quantity}}
            </li>
            <li class="mb-3 d-flex align-items-center">
                <i data-feather="mail" class="me-2"></i>
                <span class="fw-bold me-1">قیمت واحد:</span>
                {{$item->price}}
            </li>
            <li class="mb-3 d-flex align-items-center">
                <i data-feather="mail" class="me-2"></i>
                <span class="fw-bold me-1">قیمت کل:</span>
                @php
                    $totalPrice=$item->price * $item->quantity;
                @endphp
                {{$totalPrice}}
            </li>
        </ul>
    </div>
</div>
<hr>
@endforeach
