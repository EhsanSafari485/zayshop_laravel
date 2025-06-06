@extends('Panel.master')

@section('content')
<!-- BEGIN CONTENT AREA -->
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
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-spacing">
            <!-- Full Width Profile Content -->
            <div class="col-12 layout-top-spacing">
                <div class="user-profile layout-spacing">
                    <div class="widget-content widget-content-area p-4">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0">پروفایل کاربر</h4>
                            <a href="{{ route('Panel.account.edit', $user->id) }}" class="btn btn-primary">
                                ویرایش پروفایل
                            </a>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-3 d-flex align-items-center">
                                        <i data-feather="user" class="me-2"></i>
                                        <span class="fw-bold me-1">نام:</span>
                                        {{$user->name}}
                                    </li>
                                    <li class="mb-3 d-flex align-items-center">
                                        <i data-feather="mail" class="me-2"></i>
                                        <span class="fw-bold me-1">ایمیل:</span>
                                        {{$user->email}}
                                    </li>

                                </ul>
                            </div>

                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                <li class="mb-3 d-flex align-items-center">
                                    <i data-feather="map-pin" class="me-2"></i>
                                    <span class="fw-bold me-1">آدرس:</span>
                                    {{$user->address??'ثپت نشده'}}
                                </li>
                                <li class="mb-3 d-flex align-items-center">
                                    <i data-feather="phone" class="me-2"></i>
                                    <span class="fw-bold me-1">تلفن:</span>
                                    {{$user->phone??'ثپت نشده'}}
                                </li>
                            </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-wrapper">
        <div class="footer-section f-section-1">
            <p>© کپی‌رایت</p>
        </div>
        <div class="footer-section f-section-2">
            <span class="copyright">بومی‌سازی توسط: <a href="https://imanpa.ir/store/">ایمان پاکروح</a></span>
        </div>
    </div>
</div>
<!-- END CONTENT AREA -->
@endsection
