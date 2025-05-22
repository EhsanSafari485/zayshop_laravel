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
                                        <a href="{{ route('Panel.users.create') }}" id="btn-add-contact" style="display: inline-block;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-image">
                                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                <path d="M21 15l-5-5L5 21"></path>
                                            </svg>
                                        </a>

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
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">نام</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">ایمیل</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">سمت</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">عملیات</h4>
                                        </div>
                                    </div>
                                </div>
                                    @foreach ($users as $user)

                                <div class="items" id="user-{{ $user->id }}">
                                    <div class="item-content">
                                        <div class="user-email">
                                            <p class="info-title">نام:</p>
                                            <p class="usr-email-addr">{{$user->name}}</p>
                                        </div>
                                        <div class="user-location">
                                            <p class="info-title">ایمیل: </p>
                                            <p class="usr-location">{{$user->email}}</p>
                                        </div>
                                        <div class="user-location">
                                            <p class="info-title">سمت: </p>
                                            <p class="usr-location">{{$user->role}}</p>
                                        </div>
                                        <div class="action-btn">
                                            <a href="{{ route('Panel.users.edit', ['id'=>$user->id]) }}">
                                                <button type="button" class="custom-edit-btn" style="background: none; border: none; cursor: pointer;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="white" stroke-width="2"stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2">
                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                    </svg>
                                                </button>
                                            </a>

                                                <button type="button"
                                                data-id="{{ $user->id }}"
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
    $('.custom-delete-btn').click(function () {
        let id = $(this).data('id');

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
                // ارسال درخواست DELETE با AJAX
                $.ajax({
                    url: '/Panel/users/index/' + id,  // URL روت حذف
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"  // ارسال CSRF Token برای امنیت
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                            title: 'حذف شد!',
                            text: 'کاربر با موفقیت حذف شد.',
                            icon: 'success',
                            background: '#1e1e2f',  // رنگ پس‌زمینه سبز
                            color: '#fff',          // رنگ متن سفید
                            confirmButtonColor: '#007bff',  // رنگ دکمه تایید
                            confirmButtonText: 'باشه'
                        });
                            // حذف عنصر از صفحه بدون بارگذاری مجدد
                            $('#user-' + id).remove();  // حذف اسلایدر از DOM
                        } else {
                            Swal.fire(
                                'خطا!',
                                'خطایی در حذف کاربر پیش آمد.',
                                'error'
                            );
                        }
                    },
                    error: function () {
                        Swal.fire(
                            'خطا!',
                            'خطایی در ارسال درخواست پیش آمد.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
</script>
@endsection
@endsection
