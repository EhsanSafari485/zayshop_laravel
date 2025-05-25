<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <title>فروشگاه زی</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" href="{{ asset('HomeAsset/img/apple-icon.png') }} ">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('HomeAsset/img/apple-icon.png') }} ">

    <link rel="stylesheet" href="{{ asset('HomeAsset/css/bootstrap.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('HomeAsset/css/templatemo.css') }} ">
    <link rel="stylesheet" href="{{ asset('HomeAsset/css/custom.css') }} ">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="{{ asset('HomeAsset/css/fontawesome.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('HomeAsset/css/fonts.css') }} ">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!--

TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

-->
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow fixed-top">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="{{ route('Home.index') }}">
                زی
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('Home.index') }}">خانه</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('Home.shop') }}">فروشگاه</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('blogs.index') }}">بلاگ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('Home.about') }}">درباره</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="contact.html">تماس</a>
                        </li> --}}
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="جستجو ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>


                    <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                        <i class="fa fa-fw fa-search text-dark mr-2"></i>
                    </a>
                    <li class="nav-item dropdown">
                        @auth
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                <i class="fa fa-fw fa-user text-dark mr-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('Panel.index') }}">پنل کاربری</a></li>
                                <li>
                                    <form action="{{ route('logout') }}" id="logout-form" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <button class="dropdown-item" onclick="confirmLogout()">خروج</button>
                                </li>
                            </ul>


                        @else
                        <div class="d-flex">
                            <a class="nav-link" href="{{ route('loginForm') }}">
                                <i class="fa fa-fw fa-user text-dark mr-1"></i> ورود
                            </a>
                            <a class="nav-link" href="{{ route('registerForm') }}">
                                <i class="fa fa-fw fa-user-plus text-dark mr-1"></i> ثبت‌نام
                            </a>
                        </div>
                        @endauth
                    </li>
                    @auth
                    <a class="nav-icon position-relative text-decoration-none" href="{{ route('Home.cart.cart') }}">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        {{-- <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark left-0">7</span> --}}
                    </a>
                    <a class="nav-icon position-relative text-decoration-none" href="{{ route('Home.favorite.index') }}">
                        <i class="fa fa-heart" ></i>
                    </a>





                    @endauth

                </div>
            </div>

        </div>
    </nav>
    <!-- Close Header -->

<!-- Modal جستجو -->
<div class="modal fade" id="templatemo_search" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0">
            <div class="modal-body pt-3">
                <form action="{{ route('Home.shop') }}" method="GET">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" id="inputModalSearch" name="search" autocomplete="off" placeholder="جستجو ...">
                        <button type="submit"  class="input-group-text bg-success text-light">
                            <i class="fa fa-fw fa-search text-white"></i>
                        </button>
                    </div>
                </form>

                <!-- پیشنهادات -->
                <ul id="suggestions" class="list-group position-absolute w-100" style="z-index: 9999;"></ul>
            </div>
        </div>
    </div>
</div>


@yield('content')
    {{-- footer --}}
    <section class="why-choose-us py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">چرا خرید از ما؟</h2>
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <div class="p-4 shadow rounded bg-white h-100">
                        <i class="fas fa-shipping-fast fa-3x text-success mb-3"></i>
                        <h5 class="mb-2">ارسال سریع و مطمئن</h5>
                        <p>تحویل فوری در سراسر کشور با بسته‌بندی حرفه‌ای و ایمن.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="p-4 shadow rounded bg-white h-100">
                        <i class="fas fa-undo-alt fa-3x text-success mb-3"></i>
                        <h5 class="mb-2">ضمانت بازگشت وجه</h5>
                        <p>تا ۷ روز در صورت نارضایتی بدون دردسر کالا رو برگشت بدید.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="p-4 shadow rounded bg-white h-100">
                        <i class="fas fa-headset fa-3x text-success mb-3"></i>
                        <h5 class="mb-2">پشتیبانی ۲۴ ساعته</h5>
                        <p>هر زمان از شبانه‌روز با تیم پشتیبانی ما در ارتباط باشید.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start Brands -->
    <section class="bg-light py-5">
        <div class="container my-4">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">برندهای ما</h1>
                </div>
                <div class="col-lg-9 m-auto tempaltemo-carousel">
                    <div class="row d-flex flex-row">
                        <!--Controls-->
                        <div class="col-1 align-self-center">
                            <a class="h1" href="#multi-item-example" role="button" data-bs-slide="prev">
                                <i class="text-light fas fa-chevron-right"></i>
                            </a>
                        </div>
                        <!--End Controls-->

                        <!--Carousel Wrapper-->
                        <div class="col">
                            <div class="carousel slide carousel-multi-item pt-2 pt-md-0" id="multi-item-example" data-bs-ride="carousel">
                                <!--Slides-->
                                <div class="carousel-inner product-links-wap" role="listbox">

                                    <!--First slide-->
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="{{asset("HomeAsset/img/brand_01.png")}} " alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="{{asset("HomeAsset/img/brand_02.png")}} " alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="{{asset("HomeAsset/img/brand_03.png")}} " alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="{{asset("HomeAsset/img/brand_04.png")}} " alt="Brand Logo"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End First slide-->

                                    <!--Second slide-->
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="{{asset("HomeAsset/img/brand_01.png")}} " alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="{{asset("HomeAsset/img/brand_02.png")}} " alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="{{asset("HomeAsset/img/brand_03.png")}} " alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="{{asset("HomeAsset/img/brand_04.png")}} " alt="Brand Logo"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Second slide-->

                                    <!--Third slide-->
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="{{asset("HomeAsset/img/brand_01.png")}} " alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="{{asset("HomeAsset/img/brand_02.png")}} " alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="{{asset("HomeAsset/img/brand_03.png")}} " alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-3 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img" src="{{asset("HomeAsset/img/brand_04.png")}} " alt="Brand Logo"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Third slide-->

                                </div>
                                <!--End Slides-->
                            </div>
                        </div>
                        <!--End Carousel Wrapper-->

                        <!--Controls-->
                        <div class="col-1 align-self-center">
                            <a class="h1" href="#multi-item-example" role="button" data-bs-slide="next">
                                <i class="text-light fas fa-chevron-left"></i>
                            </a>
                        </div>
                        <!--End Controls-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Brands-->
    <!-- Start Footer -->

    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">فروشگاه زی</h2>
                    <ul class="list-unstyled text-light footer-link-list padd-r-0">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            تهران ، کریم خان
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:010-020-0340">021-020-0340</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="mailto:info@company.com">info@company.com</a>
                        </li>
                    </ul>
                    <div class="row text-light mb-4">
                        <div class="col-12 mb-3">
                            <div class="w-100 my-3 border-top border-light"></div>
                        </div>
                        <div class="col-auto me-auto">
                            <ul class="list-inline text-left footer-icons padd-r-0">
                                <li class="list-inline-item border border-light rounded-circle text-center">
                                    <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                                </li>
                                <li class="list-inline-item border border-light rounded-circle text-center">
                                    <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                                </li>
                                <li class="list-inline-item border border-light rounded-circle text-center">
                                    <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                                </li>
                                <li class="list-inline-item border border-light rounded-circle text-center">
                                    <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">محصولات</h2>
                    <ul class="list-unstyled text-light footer-link-list padd-r-0">
                        <li><a class="text-decoration-none" href="#">لاکچری</a></li>
                        <li><a class="text-decoration-none" href="#">لباس ورزشی</a></li>
                        <li><a class="text-decoration-none" href="#">کفش مردانه</a></li>
                        <li><a class="text-decoration-none" href="#">کفش زنانه</a></li>
                        <li><a class="text-decoration-none" href="#">لباس محبوب</a></li>
                        <li><a class="text-decoration-none" href="#">لوازم بدنسازی</a></li>
                        <li><a class="text-decoration-none" href="#">کفش ورزشی</a></li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">اطلاعات بیشتر</h2>
                    <ul class="list-unstyled text-light footer-link-list padd-r-0">
                        <li><a class="text-decoration-none" href="#">خانه</a></li>
                        <li><a class="text-decoration-none" href="#">درباره ما</a></li>
                        <li><a class="text-decoration-none" href="#">آدرس فروشگاه</a></li>
                        <li><a class="text-decoration-none" href="#">سوالات متداول</a></li>
                        <li><a class="text-decoration-none" href="#">تماس با ما</a></li>
                    </ul>
                </div>

            </div>


        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                           کلیه حقوق محفوظ است
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <!-- Start Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('HomeAsset/js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('HomeAsset/js/jquery-migrate-1.2.1.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // وقتی تایپ می‌کنیم
    $('#inputModalSearch').on('input', function () {
        let query = $(this).val().trim();

        if (query.length > 1) {
            $.ajax({
                url: '{{ route("Home.suggestions") }}',
                data: { q: query },
                success: function (data) {
                    let suggestionBox = $('#suggestions');
                    suggestionBox.empty();

                    if (data.length > 0) {
                        data.forEach(function (item) {
                            suggestionBox.append(`
                                <li class="mt-2 list-group-item d-flex align-items-center" data-url="/shop_single/${item.slug}">
                                    <img src="/images/product/${item.image}" class="me-2" style="width:40px;height:40px;object-fit:cover;border-radius:5px;">
                                    <div>
                                        <div>${item.name}</div>
                                        <small class="text-muted">${parseInt(item.price).toLocaleString()} تومان</small>
                                    </div>
                                </li>
                            `);
                        });
                    } else {
                        suggestionBox.append('<li class="list-group-item text-muted">موردی یافت نشد</li>');
                    }
                }
            });
        } else {
            $('#suggestions').empty();
        }
    });

    // کلیک روی آیتم‌های پیشنهاد
    $(document).on('click', '#suggestions li', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const targetUrl = $(this).data('url');
        if (targetUrl) {
            window.location.href = targetUrl;
        }
    });

    // خالی‌کردن لیست پیشنهادات هنگام کلیک بیرون
    $(document).on('click', function (e) {
        if (!$(e.target).closest('#inputModalSearch, #suggestions').length) {
            $('#suggestions').empty();
        }
    });

});
</script>
    <script src="{{ asset('HomeAsset/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('HomeAsset/js/templatemo.js') }}"></script>
    <script src="{{ asset('HomeAsset/js/custom.js') }}"></script>
    <script src="{{ asset('HomeAsset/assets/js/slick.min.js') }}"></script>
    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'آیا مطمئن هستید؟',
                text: "می‌خواهید از حساب خارج شوید؟",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: "#d33",
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'بله، خروج',
                cancelButtonText: 'لغو'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
    @yield('js')
    <!-- End Script -->
</body>

</html>
