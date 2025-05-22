<!DOCTYPE html>
<html lang="en">
<head>
	<title>احراز هویت</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?php echo e(asset('AuthAsset/images/icons/favicon.ico')); ?> "/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('AuthAsset/vendor/bootstrap/css/bootstrap.min.css')); ?> ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('AuthAsset/fonts/font-awesome-4.7.0/css/font-awesome.min.css')); ?> ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('AuthAsset/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')); ?> ">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;700&display=swap" rel="stylesheet">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('AuthAsset/vendor/animate/animate.css')); ?> ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('AuthAsset/vendor/css-hamburgers/hamburgers.min.css')); ?> ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('AuthAsset/vendor/animsition/css/animsition.min.css')); ?> ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('AuthAsset/vendor/select2/select2.min.css')); ?> ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('AuthAsset/vendor/daterangepicker/daterangepicker.css')); ?> ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('AuthAsset/css/util.css')); ?> ">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('AuthAsset/css/main.css')); ?> ">
<!--===============================================================================================-->
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>
<body style="background-color: #666666;" class="login-page">
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form" action="<?php echo e(route('login')); ?>" id="registerForm" method="POST">
                    <?php echo csrf_field(); ?>
					<span class="login100-form-title p-b-43">
						برای ادامه وارد شوید
					</span>


					<div class="wrap-input100" >
						<input class="input100" type="email" name="email" placeholder="ایمیل">
						<span class="focus-input100"></span>
					</div>


					<div class="wrap-input100" >
						<input class="input100" type="password" name="password" placeholder="رمز عبور">
						<span class="focus-input100"></span>
					</div>

                    <div id="login-error"></div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember">
							<label class="label-checkbox100" for="ckb1">
								مرا به خاطر بسپار
							</label>
						</div>

						<div>
							<a href="<?php echo e(route('registerForm')); ?>" class="txt5">
								حساب کاربری ندارم
							</a>
						</div>
					</div>
					<div class="container-login100-form-btn">
						<button type="submit" id="login-button" class="login100-form-btn">
							ورود
						</button>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('<?php echo e(asset('AuthAsset/images/bg-01.jpg')); ?> ');">
				</div>
			</div>
		</div>
	</div>





<!--===============================================================================================-->
	<script src="<?php echo e(asset('AuthAsset/vendor/jquery/jquery-3.2.1.min.js')); ?> "></script>
<!--===============================================================================================-->
	<script src="<?php echo e(asset('AuthAsset/vendor/animsition/js/animsition.min.js')); ?> "></script>
<!--===============================================================================================-->
	<script src="<?php echo e(asset('AuthAsset/vendor/bootstrap/js/popper.js')); ?> "></script>
	<script src="<?php echo e(asset('AuthAsset/vendor/bootstrap/js/bootstrap.min.js')); ?> "></script>
<!--===============================================================================================-->
	<script src="<?php echo e(asset('AuthAsset/vendor/select2/select2.min.js')); ?> "></script>
<!--===============================================================================================-->
	<script src="<?php echo e(asset('AuthAsset/vendor/daterangepicker/moment.min.js')); ?> "></script>
	<script src="<?php echo e(asset('AuthAsset/vendor/daterangepicker/daterangepicker.js')); ?> "></script>
<!--===============================================================================================-->
	<script src="<?php echo e(asset('AuthAsset/vendor/countdowntime/countdowntime.js')); ?> "></script>
<!--===============================================================================================-->
	<script src="<?php echo e(asset('AuthAsset/js/main.js')); ?> "></script>

<script type="text/javascript" src="<?php echo e(asset('vendor/jsvalidation/js/jsvalidation.js')); ?>"></script>
<?php echo JsValidator::formRequest('App\Http\Requests\auth\loginRequest', '#registerForm'); ?>


<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#registerForm').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let actionUrl = form.attr('action');
        let formData = form.serialize();

        $.ajax({
            type: 'POST',
            url: actionUrl,
            data: formData,
            xhrFields: {
            withCredentials: true
            },
            success: function (response) {
                    window.location.href = '/';
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    $('#login-error').addClass('alert alert-danger');
                    $('#login-error').text(xhr.responseJSON.message);
                } else if (xhr.status === 419) {
                    $('#login-error').addClass('alert alert-danger');
                    $('#login-error').text('توکن امنیتی منقضی شده است. لطفاً صفحه را رفرش کنید.');
                } else {
                    $('#login-error').addClass('alert alert-danger');
                    $('#login-error').text('خطایی رخ داده است.');
                }
            }
        });
    });
});


</script>



</body>
</html>
<?php /**PATH C:\xampp\htdocs\zayShop\resources\views/auth/login.blade.php ENDPATH**/ ?>