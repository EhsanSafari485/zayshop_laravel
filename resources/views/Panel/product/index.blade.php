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
                                <div class="col-xl-4 col-lg-5 col-md-5 col-sm-7 filtered-list-search layout-spacing align-self-center">
                                    <form class="form-inline my-2 my-lg-0">
                                        <div class="">

                                        </div>
                                    </form>
                                </div>

                                <div class="col-xl-8 col-lg-7 col-md-7 col-sm-5 text-sm-right text-center layout-spacing align-self-center">
                                    <div class="d-flex justify-content-sm-end justify-content-center">
                                        <a href="{{ route('Panel.product.create') }}" id="btn-add-contact" style="display: inline-block;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-plus">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                        </a>
                                        <!-- دکمه افزودن رنگ -->
                                        <a href="{{ route('Panel.product.colors.index') }}" id="btn-add-contact" style="display: inline-block;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-droplet">
                                                <path d="M12 2.69l6.16 6.16a7 7 0 1 1-12.32 0z"></path>
                                            </svg>
                                        </a>

                                        <!-- دکمه افزودن سایز -->
                                        <a href="{{ route('Panel.product.sizes.index') }}" id="btn-add-contact" class="btn-add-item" style="display: inline-block;">
                                            <span style="font-size: 14px; font-weight: bold;">سایز</span>
                                        </a>
                                        {{-- <a href="" class="btn-add-item" id="btn-add-contact" style="display: inline-block;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-sliders">
                                                <line x1="4" y1="21" x2="4" y2="14"></line>
                                                <line x1="4" y1="10" x2="4" y2="3"></line>
                                                <line x1="12" y1="21" x2="12" y2="12"></line>
                                                <line x1="12" y1="8" x2="12" y2="3"></line>
                                                <line x1="20" y1="21" x2="20" y2="16"></line>
                                                <line x1="20" y1="12" x2="20" y2="3"></line>
                                                <line x1="1" y1="14" x2="7" y2="14"></line>
                                                <line x1="9" y1="8" x2="15" y2="8"></line>
                                                <line x1="17" y1="16" x2="23" y2="16"></line>
                                            </svg>
                                        </a> --}}

                                            <div class="switch align-self-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list view-list active-view"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid view-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="searchable-items list">
                                <div class="items items-header-section">
                                    <div class="item-content">
                                        <div class="user-email">
                                            <h4 style="margin-right: 0;">نام محصول</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">قیمت</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">تخفیف</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">برند</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">slug</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">دسته بندی</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">عملیات</h4>
                                        </div>
                                    </div>
                                </div>
                                    @foreach ($products as $product)

                                <div class="items" id="category-{{ $product->id }}">
                                    <div class="item-content">
                                        <div class="user-email">
                                            <p class="info-title">نام محصول: </p>
                                            <p class="usr-email-addr" data-email="alan@mail.com">{{$product->name}}</p>
                                        </div>
                                        <div class="user-email">
                                            <p class="info-title">قیمت</p>
                                            <p class="usr-email-addr" data-email="alan@mail.com">{{ number_format($product->price, 0) }}</p>
                                        </div>
                                        <div class="user-email">
                                            <p class="info-title">تخفیف</p>
                                            <p class="usr-email-addr" data-email="alan@mail.com">{{ number_format($product->discount)}}</p>
                                        </div>
                                        <div class="user-email">
                                            <p class="info-title">برند</p>
                                            <p class="usr-email-addr" data-email="alan@mail.com">{{$product->brand}}</p>
                                        </div>
                                        <div class="user-email">
                                            <p class="info-title">slug</p>
                                            <p class="usr-email-addr" data-email="alan@mail.com">{{$product->slug}}</p>
                                        </div>
                                        <div class="user-email">
                                            <p class="info-title">دسته بندی</p>
                                            @foreach ($Categories as $Category)
                                            @if ($Category->id==$product->category_id)
                                            <p class="usr-email-addr" data-email="alan@mail.com">{{$Category->name}}</p>
                                            @endif
                                            @endforeach
                                        </div>
                                        <div class="action-btn">
                                            <a href="{{ route('Panel.product.edit',$product->id) }}">
                                                <button type="button" class="custom-edit-btn" style="background: none; border: none; cursor: pointer;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="white" stroke-width="2"stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2">
                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                    </svg>
                                                </button>
                                            </a>

                                                <button type="button"
                                                data-id="{{ $product->id }}"
                                                class="custom-delete-btn"
                                                style="background: none; border: none; cursor: pointer;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6L17.5 20H6.5L5 6h14z"></path>
                                                    <path d="M10 11v6"></path>
                                                    <path d="M14 11v6"></path>
                                                    <path d="M15 4V2H9v2"></path>
                                                </svg>
                                            </button>
                                            <a href="{{ route('Panel.product.product_image.index', $product->id) }}">
                                                <button type="button" class="custom-gallery-btn" style="background: none; border: none; cursor: pointer;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image">
                                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                        <path d="M21 15l-5-5L5 21"></path>
                                                    </svg>
                                                </button>
                                            </a>
                                            {{-- <a href="{{ route('Panel.product.attributes.index', $product->id) }}">
                                                <button type="button" class="custom-gallery-btn" style="background: none; border: none; cursor: pointer;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings">
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33h.09a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82v.09a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                                                    </svg>
                                                </button>
                                            </a> --}}
                                            <a href="{{ route('Panel.product.attribute.index',$product->id) }}">
                                                <button type="button" class="custom-gallery-btn" style="background: none; border: none; cursor: pointer;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip">
                                                        <path d="M21.44 11.05l-9.19 9.19a5 5 0 0 1-7.07-7.07l9.19-9.19a3.5 3.5 0 0 1 4.95 4.95L9.88 17.88a2 2 0 1 1-2.83-2.83l9.19-9.19"></path>
                                                    </svg>
                                                </button>
                                            </a>
                                            <a href="{{ route('Panel.product.product_variants.index',$product->id) }}"><button type="button" class="custom-gallery-btn" style="background: none; border: none; cursor: pointer;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="white"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-sliders">
                                               <line x1="4" y1="21" x2="4" y2="14"></line>
                                               <line x1="4" y1="10" x2="4" y2="3"></line>
                                               <line x1="12" y1="21" x2="12" y2="12"></line>
                                               <line x1="12" y1="8" x2="12" y2="3"></line>
                                               <line x1="20" y1="21" x2="20" y2="16"></line>
                                               <line x1="20" y1="12" x2="20" y2="3"></line>
                                               <line x1="1" y1="14" x2="7" y2="14"></line>
                                               <line x1="9" y1="8" x2="15" y2="8"></line>
                                               <line x1="17" y1="16" x2="23" y2="16"></line>
                                           </svg>
                                            </button></a>
                                        {{-- <a href="" class="btn-add-item" id="btn-add-contact" style="display: inline-block;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-sliders">
                                                <line x1="4" y1="21" x2="4" y2="14"></line>
                                                <line x1="4" y1="10" x2="4" y2="3"></line>
                                                <line x1="12" y1="21" x2="12" y2="12"></line>
                                                <line x1="12" y1="8" x2="12" y2="3"></line>
                                                <line x1="20" y1="21" x2="20" y2="16"></line>
                                                <line x1="20" y1="12" x2="20" y2="3"></line>
                                                <line x1="1" y1="14" x2="7" y2="14"></line>
                                                <line x1="9" y1="8" x2="15" y2="8"></line>
                                                <line x1="17" y1="16" x2="23" y2="16"></line>
                                            </svg>
                                        </a> --}}

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
@section('jssrc')
<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.custom-delete-btn').click(function () {
        let id = $(this).data('id');
        let deleteUrl = "/Panel/product/index/" + id;

        Swal.fire({
            title: "آیا مطمئن هستید؟",
            text: "این عملیات غیرقابل بازگشت است!",
            icon: "warning",
            showCancelButton: true,
            cancelButtonColor: "#d33",
            background: '#1e1e2f',
            color: '#f1f1f1',
            confirmButtonColor: '#3085d6',
            confirmButtonText: "بله، حذف کن!",
            cancelButtonText: "لغو"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: deleteUrl,
                    type: 'POST',
                    data: {
                        "_method": "DELETE"
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'حذف شد!',
                                text: 'دسته بندی با موفقیت حذف شد.',
                                icon: 'success',
                                background: '#1e1e2f',
                                color: '#fff',
                                confirmButtonColor: '#007bff',
                                confirmButtonText: 'باشه'
                            });
                            $('#category-' + id).remove();
                        } else {
                            Swal.fire('خطا!', 'خطایی در حذف دسته بندی پیش آمد.', 'error');
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
@endsection
@endsection
