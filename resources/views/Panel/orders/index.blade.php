@extends('Panel.master')
@section('content')
@if (session('success'))
<script>
    Swal.fire({
  title: 'عملیات موفق!',
  text: '{{ session('success') }}',
  icon: 'success',
  background: '#1e1e2f',  // پس‌زمینه تیره
  color: '#f1f1f1',       // رنگ متن روشن
  confirmButtonColor: '#3085d6',  // رنگ دکمه
  confirmButtonText: 'باشه!',
});
</script>
@endif

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="row layout-spacing layout-top-spacing" id="cancel-row">
                    <div class="col-lg-12">
                        <div class="widget-content searchable-container list">

                            <div class="row">
                                <div class="col-xl-8 col-lg-7 col-md-7 col-sm-5 text-sm-right text-center layout-spacing align-self-center">
                                    <!-- Modal -->
                                    <div class="modal fade" id="addContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title">جزئیات سفارش</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body" id="product-detail-content">
                                            در حال بارگذاری اطلاعات...
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>

                            <div class="searchable-items list">
                                <div class="items items-header-section">
                                    <div class="item-content">
                                        <div class="user-email">
                                            <h4 style="margin-right: 0;">شماره سفارش</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">نام کاربر</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">تاریخ ثبت</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">تراکنش مالی</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">مبلغ کل</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">وضعیت پرداخت</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">وضعیت ارسال</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">عملیات</h4>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($orders as $order)

                                <div class="items" id="image-{{$order->id}}">
                                    <div class="item-content">
                                        <div class="user-email">
                                            <p class="usr-email-addr"></p>
                                            <p class="usr-email-addr">{{$order->id}}</p>
                                        </div>
                                        <div class="user-email">
                                            <p class="usr-email-addr" data-email="alan@mail.com">{{$order->user->name}}</p>
                                        </div>
                                        <div class="user-email">
                                            <p class="usr-email-addr" data-email="alan@mail.com">{{ \Morilog\Jalali\Jalalian::fromDateTime($order->paid_at)->format('%Y/%m/%d') }}</p>
                                        </div>
                                        <div class="user-email">
                                        <p class="usr-email-addr" data-email="alan@mail.com">{{$order->transaction_id}}</p>
                                        </div>
                                        <div class="user-email">
                                            @php
                                            $totalPrice=0;
                                            foreach ($order->items as $item) {
                                                $totalPrice+=$item->price * $item->quantity;
                                            }
                                            @endphp
                                        <p class="usr-email-addr" data-email="alan@mail.com">{{$totalPrice}}</p>
                                        </div>
                                        <div class="user-email">
                                            @php
                                            $statuses = [
                                                'paid' => ['label' => 'موفق', 'class' => 'text-success'],
                                                'pending' => ['label' => 'در انتظار', 'class' => 'text-warning'],
                                                'failed' => ['label' => 'ناموفق', 'class' => 'text-danger'],
                                            ];
                                            @endphp

                                            @php
                                                $statusData = $statuses[$order->status] ?? ['label' => 'نامشخص', 'class' => 'text-gray-600 bg-gray-100 px-2 py-1 rounded'];
                                            @endphp

                                            <p class="{{ $statusData['class'] }}">
                                                {{ $statusData['label'] }}
                                            </p>
                                        </div>
                                        <div class="user-email">
                                            @php
                                                $statuses = [
                                                    'pending' => ['label' => 'در انتظار ارسال', 'class' => 'text-warning'],
                                                    'shipped' => ['label' => 'ارسال شده', 'class' => 'text-success'],
                                                    'cancelled' => ['label' => 'لغو شده', 'class' => 'text-danger'],
                                                ];
                                            @endphp
                                            <select name="shipping_status" class="form-control status-select" data-order-id="{{ $order->id }}">
                                                @foreach ($statuses as $key => $status)
                                                    <option value="{{ $key }}" {{ $order->shipping_status == $key ? 'selected' : '' }}>
                                                        {{ $status['label'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="status-message mt-2" id="status-message-{{ $order->id }}"></div>
                                        </div>
                                        <div class="action-btn">
                                        <button data-id="{{$order->id}}" class="btn btn-info btn-show-details view-order" title="نمایش جزئیات">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                                 stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-eye">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </button>

                                     </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class=""> © کپی رایت</p>
                </div>
                <div class="footer-section f-section-2">
 <span class="copyright"> بومی سازی شده توسط : <a href="https://imanpa.ir/store/"> ایمان پاکروح </a> </span></div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->
        @section('jssrc')
<script>
    $(document).ready(function () {
    $('.status-select').on('change', function () {
        let select = $(this);
        let orderId = select.data('order-id');
        let status = select.val();

        $.ajax({
            url: '{{ route("Panel.orders.updateStatus", ":id") }}'.replace(':id', orderId),
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                shipping_status: status
            },
            success: function (response) {
                $('#status-message-' + orderId).html('<span class="text-success">وضعیت با موفقیت به‌روزرسانی شد.</span>');
            },
            error: function (xhr) {
                let errorMsg = 'خطا در به‌روزرسانی.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
                $('#status-message-' + orderId).html('<span class="text-danger">' + errorMsg + '</span>');
            }
        });
    });

$(document).on('click', '.view-order', function () {
    var id = $(this).data('id');
    $.ajax({
        url: '{{ route("Panel.orders.productOrder") }}',
        type: 'GET',
        data: { id: id },
        success: function (data) {
            $('#product-detail-content').html(data);
            $('#addContactModal').modal('show');
        },
        error: function () {
            $('#product-detail-content').html('<div class="alert alert-danger">خطا در بارگذاری اطلاعات سفارش.</div>');
        }
    });
});
    });
</script>
        @endsection
@endsection
