<!DOCTYPE html>
<html lang="en">
<head>
	<title>ثپت نام</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{ asset('AuthAsset/images/icons/favicon.ico') }} "/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('AuthAsset/vendor/bootstrap/css/bootstrap.min.css') }} ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('AuthAsset/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }} ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('AuthAsset/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }} ">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;700&display=swap" rel="stylesheet">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('AuthAsset/vendor/animate/animate.css') }} ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('AuthAsset/vendor/css-hamburgers/hamburgers.min.css') }} ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('AuthAsset/vendor/animsition/css/animsition.min.css') }} ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('AuthAsset/vendor/select2/select2.min.css') }} ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('AuthAsset/vendor/daterangepicker/daterangepicker.css') }} ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('AuthAsset/css/util.css') }} ">
	<link rel="stylesheet" type="text/css" href="{{ asset('AuthAsset/css/main.css') }} ">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form action="{{ route('register') }}" class="login100-form" id="registerForm" method="POST">
                    @csrf
					<span class="login100-form-title p-b-43">
						برای ادامه ثپت نام کنید
					</span>


                    <div class="wrap-input100" >
						<input class="input100" type="text" name="name" placeholder="نام">
						<span class="focus-input100"></span>
					</div>


					<div class="wrap-input100" >
						<input class="input100" type="email" name="email" placeholder="ایمیل">
						<span class="focus-input100"></span>
					</div>


					<div class="wrap-input100" >
						<input class="input100" type="password" name="password" placeholder="رمز عبور">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div>
							<a href="{{ route('loginForm') }}" class="txt5">
								حساب کاربری دارم
							</a>
						</div>
					</div>


					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							ورود
						</button>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('{{asset('AuthAsset/images/bg-01.jpg')}} ');">
				</div>
			</div>
		</div>
	</div>





<!--===============================================================================================-->
	<script src="{{ asset('AuthAsset/vendor/jquery/jquery-3.2.1.min.js') }} "></script>
<!--===============================================================================================-->
	<script src="{{ asset('AuthAsset/vendor/animsition/js/animsition.min.js') }} "></script>
<!--===============================================================================================-->
	<script src="{{ asset('AuthAsset/vendor/bootstrap/js/popper.js') }} "></script>
	<script src="{{ asset('AuthAsset/vendor/bootstrap/js/bootstrap.min.js') }} "></script>
<!--===============================================================================================-->
	<script src="{{ asset('AuthAsset/vendor/select2/select2.min.js') }} "></script>
<!--===============================================================================================-->
	<script src="{{ asset('AuthAsset/vendor/daterangepicker/moment.min.js') }} "></script>
	<script src="{{ asset('AuthAsset/vendor/daterangepicker/daterangepicker.js') }} "></script>
<!--===============================================================================================-->
	<script src="{{ asset('AuthAsset/vendor/countdowntime/countdowntime.js') }} "></script>
<!--===============================================================================================-->
	<script src="{{ asset('AuthAsset/js/main.js') }} "></script>

<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\auth\registerRequest', '#registerForm'); !!}


</body>
</html>
