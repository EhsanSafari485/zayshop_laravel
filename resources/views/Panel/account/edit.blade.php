@extends('Panel.master')
@section('content')
@if(session('welcome'))
<script>
    Swal.fire({
        icon: 'wa',
        title: '{{ session("welcome") }}',
        background: '#1e1e2f',
        color: '#f1f1f1',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'تایید',
    });
</script>
@endif
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form id="contact" class="section contact" action="{{ route('Panel.account.update',$id) }}" method="POST">
                                        @csrf
                                        <div class="info">
                                            <h5 class="">مخاطب</h5>
                                            <div class="row">
                                                <div class="col-md-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="name">نام</label>
                                                                <input type="text" class="form-control mb-4" name="name" value="{{$user->name}}" id="name" placeholder="نام خود را اینجا وارد کنید"  >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="email">ایمیل</label>
                                                                <input type="text" class="form-control mb-4" name="email" value="{{$user->email}}" id="email" placeholder="ایمیلتان را در اینجا بنویسید" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="phone">موبایل</label>
                                                                <input type="text" class="form-control mb-4" name="phone" value="{{$user->phone??null}}" id="phone" placeholder="شماره موبایل خود را اینجا وارد نمایید">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="password">رمز عبور جدید</label>
                                                                <input type="password" class="form-control mb-4" name="password" id="password" placeholder="در صورت تغیر، رمز عبور جدید را وارد کنید">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="address">آدرس</label>
                                                                <input type="text" class="form-control mb-4" name="address" value="{{$user->address??null}}" id="address" placeholder="25مثال:اصفهان/میدان نقش جهان/خیابان هویزه/پلاک">
                                                            </div>
                                                        </div>
                                                        <input type="hidden" id="current_password_input" name="current_password">
                                                        <div class="as-footer-container pl-3">
                                                            <button type="button" id="submit-btn" class="btn btn-primary">ذخیره</button>
                                                            <button id="multiple-messages" onclick="history.back()" class="btn btn-dark">بازگشت</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @section('jssrc')
        <script>
            $('#submit-btn').click(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'رمز عبور فعلی را وارد کنید',
                    input: 'password',
                    inputPlaceholder: 'رمز عبور فعلی',
                    inputAttributes: {
                        autocapitalize: 'off',
                        autocorrect: 'off'
                    },
                    background: '#1e1e2f',
                    color: '#f1f1f1',
                    confirmButtonColor: '#3085d6',
                    showCancelButton: true,
                    confirmButtonText: 'تایید',
                    cancelButtonText: 'لغو',
                    preConfirm: (password) => {
                        if (!password) {
                            Swal.showValidationMessage('رمز عبور الزامی است');
                        }
                        return password;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#current_password_input').val(result.value);

                        var formData = $('#contact').serialize();

                        $.ajax({
                            url: $('#contact').attr('action'),
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'موفق!',
                                    background: '#1e1e2f',
                                    color: '#f1f1f1',
                                    confirmButtonColor: '#3085d6',
                                    text: response.message,
                                }).then(() => {
                                    window.location.href = response.redirect;
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'خطا',
                                    background: '#1e1e2f',
                                    color: '#f1f1f1',
                                    confirmButtonColor: '#3085d6',
                                    text: xhr.responseJSON.message || 'خطایی رخ داده است',
                                });
                            }
                        });
                    }
                });
            });
        </script>
        @endsection

@endsection

