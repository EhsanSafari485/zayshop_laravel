@extends('Panel.master')
@section('content')
<div id="content" class="main-content">
    <div class="container">

        <div class="container">

<div class="row">
    <div id="flFormsGrid" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>ویرایش کاربر</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route('Panel.users.update',$id) }}" id="userForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row mb-4">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">نام</label>
                            <input type="name" class="form-control" value="{{$user->name}}" name="name" id="inputEmail4" placeholder="نام کاربر را وارد کنید ">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail5">ایمیل</label>
                            <input type="email" class="form-control" value="{{$user->email}}" name="email" id="inputEmail5" placeholder="ایمیل کاربر را وارد کنید ">
                        </div>
                    </div>
                    <div class="form-row mb-4">
                        <div class="form-group col-md-6">
                            <label for="inputEmail6">رمز عبور</label>
                            <input type="password" class="form-control" name="password" id="inputEmail6" placeholder="رمز جدید را اینجا وارد کنید">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputState">نوع کاربر</label>
                            <select id="inputState" name="role" class="form-control">
                                @php
                                    $roles = ['user', 'admin', 'writer', 'master'];
                                @endphp
                                @foreach($roles as $role)
                                    <option value="{{ $role }}" {{ $user->role == $role ? 'selected' : '' }}>{{ $role }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                  <button type="submit" class="btn btn-primary mt-3">ثپت</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

@section('jssrc')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\auth\editUserRequest', '#userForm'); !!}
@endsection
@endsection
