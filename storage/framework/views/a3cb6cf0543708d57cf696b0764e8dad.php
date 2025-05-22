<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Bootstrap Forms | CORK الگوی مدیریتی تمام ریسپانسیو </title>
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('PanelAsset/assets/img/favicon.ico')); ?> "/>
    <link href="<?php echo e(asset('PanelAsset/assets/css/loader.css')); ?> " rel="stylesheet" type="text/css" />
    <script src="<?php echo e(asset('PanelAsset/assets/js/loader.js')); ?> "></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?php echo e(asset('PanelAsset/bootstrap/css/bootstrap.min.css')); ?> " rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('PanelAsset/assets/css/plugins.css')); ?> " rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo e(asset('PanelAsset/assets/css/custom.css')); ?>">
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="<?php echo e(asset('PanelAsset/assets/css/scrollspyNav.css')); ?> " rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('PanelAsset/assets/css/forms/theme-checkbox-radio.css')); ?> ">
    <link href="<?php echo e(asset('PanelAsset/plugins/jquery-ui/jquery-ui.min.css')); ?> " rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('PanelAsset/assets/css/apps/contacts.css')); ?> " rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="<?php echo e(asset('PanelAsset/assets/css/users/user-profile.css')); ?> " rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('PanelAsset/plugins/dropify/dropify.min.css')); ?> ">
    <link href="<?php echo e(asset('PanelAsset/assets/css/users/account-setting.css')); ?> " rel="stylesheet" type="text/css" />
    
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="<?php echo e(asset('PanelAsset/plugins/apex/apexcharts.css')); ?> " rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('PanelAsset/assets/css/widgets/modules-widgets.css')); ?> ">
</head>
<body data-spy="scroll" data-target="#navSection" data-offset="100">
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->
    <!--  BEGIN NAVBAR  -->
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">

            <ul class="navbar-item theme-brand flex-row  text-center">
                <li class="nav-item theme-logo">
                    <a href="<?php echo e(route('Panel.index')); ?>">
                        <img src="<?php echo e(asset('PanelAsset/assets/img/90x90.jpg')); ?> " class="navbar-logo" alt="logo">
                    </a>
                </li>
                <li class="nav-item theme-text">
                    <a href="<?php echo e(route('Panel.index')); ?>" class="nav-link"> کورک </a>
                </li>
            </ul>
            <ul class="navbar-item flex-row ml-md-auto">

                <li class="nav-item dropdown message-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="messageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    </a>
                    <div class="dropdown-menu p-0 position-absolute" aria-labelledby="messageDropdown">
                        <div class="">
                            <a class="dropdown-item">
                                <div class="">

                                    <div class="media">
                                        <div class="user-img">
                                            <img class="usr-img rounded-circle" src="assets/img/90x90.jpg" alt="profile">
                                        </div>
                                        <div class="media-body">
                                            <div class="">
                                                <h5 class="usr-name">محسن رضایی</h5>
                                                <p class="msg-title">بروزرسانی اکانت</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </a>
                            <a class="dropdown-item">
                                <div class="">

                                    <div class="media">
                                        <div class="user-img">
                                            <img class="usr-img rounded-circle" src="assets/img/90x90.jpg" alt="profile">
                                        </div>
                                        <div class="media-body">
                                            <div class="">
                                                <h5 class="usr-name">هومن شکیبا</h5>
                                                <p class="msg-title">پیام شما</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </a>
                            <a class="dropdown-item">
                                <div class="">

                                    <div class="media">
                                        <div class="user-img">
                                            <img class="usr-img rounded-circle" src="assets/img/90x90.jpg" alt="profile">
                                        </div>
                                        <div class="media-body">
                                            <div class="">
                                                <h5 class="usr-name">زهرا جوان</h5>
                                                <p class="msg-title">اکانت شما بروز شد</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </a>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown notification-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span class="badge badge-success"></span>
                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="notificationDropdown">
                        <div class="notification-scroll">

                            <div class="dropdown-item">
                                <div class="media">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                    <div class="media-body">
                                        <div class="notification-para"><span class="user-name">زهرا طباطبایی</span> عکس شما را دوست دارد. </div>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-item">
                                <div class="media">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg>
                                    <div class="media-body">
                                        <div class="notification-para"><span class="user-name">رضا جوان </span> پست شما را به اشتراک گذاشت</div>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-item">
                                <div class="media">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line></svg>
                                    <div class="media-body">
                                        <div class="notification-para"><span class="user-name">محمدرضا پر </span> از شما در اظهار نظر نام برد.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown user-profile-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        
                        <p>کابین شخصی</p>
                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="">
                            <div class="dropdown-item">
                                <a href="<?php echo e(route('Panel.account.index')); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>حساب کاربری</a>
                            </div>
                            <div class="dropdown-item">
                                <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path></svg> صندوق ورودی</a>
                            </div>
                            <div class="dropdown-item">
                                <a onclick="confirmLogout()"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> خروج</a>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">

            <nav id="sidebar">
                <div class="shadow-bottom"></div>

                <ul class="list-unstyled menu-categories" id="accordionExample">
                        <li class="menu">
                            <a href="<?php echo e(route('Home.index')); ?>" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                    <span>صفحه اصلی</span>
                                </div>
                            </a>
                        </li>
                    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'master','admin')): ?>

                    <?php if (isset($component)) { $__componentOriginalae3d549817efd838cc46a54970da6fc7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalae3d549817efd838cc46a54970da6fc7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.menu-item','data' => ['id' => 'dashbordMenu','title' => 'داشبورد','activePattern' => 'Panel*','items' => [
                        ['label' => 'تجزیه و تحلیل', 'route' => 'Panel.index'],
                        ['label' => 'سفارش ها', 'route' => 'Panel.orders.index'],
                    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('sidebar.menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'dashbordMenu','title' => 'داشبورد','active-pattern' => 'Panel*','items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                        ['label' => 'تجزیه و تحلیل', 'route' => 'Panel.index'],
                        ['label' => 'سفارش ها', 'route' => 'Panel.orders.index'],
                    ])]); ?>
                     <?php $__env->slot('icon', null, []); ?> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pie-chart"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg>
                    <?php $__env->endSlot(); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalae3d549817efd838cc46a54970da6fc7)): ?>
<?php $attributes = $__attributesOriginalae3d549817efd838cc46a54970da6fc7; ?>
<?php unset($__attributesOriginalae3d549817efd838cc46a54970da6fc7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalae3d549817efd838cc46a54970da6fc7)): ?>
<?php $component = $__componentOriginalae3d549817efd838cc46a54970da6fc7; ?>
<?php unset($__componentOriginalae3d549817efd838cc46a54970da6fc7); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalae3d549817efd838cc46a54970da6fc7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalae3d549817efd838cc46a54970da6fc7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.menu-item','data' => ['id' => 'productMenu','title' => 'محصول‌ها','activePattern' => 'Panel/product*','items' => [
                        ['label' => 'لیست محصولات', 'route' => 'Panel.product.index'],
                        ['label' => 'ایجاد محصول جدید', 'route' => 'Panel.product.create'],
                    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('sidebar.menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'productMenu','title' => 'محصول‌ها','active-pattern' => 'Panel/product*','items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                        ['label' => 'لیست محصولات', 'route' => 'Panel.product.index'],
                        ['label' => 'ایجاد محصول جدید', 'route' => 'Panel.product.create'],
                    ])]); ?>
                     <?php $__env->slot('icon', null, []); ?> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-box">
                       <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                       <polyline points="3.27 6.96 12 12.01 20.73 6.96" />
                       <line x1="12" y1="22.08" x2="12" y2="12" />
                   </svg>
                    <?php $__env->endSlot(); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalae3d549817efd838cc46a54970da6fc7)): ?>
<?php $attributes = $__attributesOriginalae3d549817efd838cc46a54970da6fc7; ?>
<?php unset($__attributesOriginalae3d549817efd838cc46a54970da6fc7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalae3d549817efd838cc46a54970da6fc7)): ?>
<?php $component = $__componentOriginalae3d549817efd838cc46a54970da6fc7; ?>
<?php unset($__componentOriginalae3d549817efd838cc46a54970da6fc7); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginalae3d549817efd838cc46a54970da6fc7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalae3d549817efd838cc46a54970da6fc7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.menu-item','data' => ['id' => 'categoryMenu','title' => 'دسته‌بندی‌ها','activePattern' => 'Panel/category*','items' => [
                    ['label' => 'لیست دسته‌بندی‌ها', 'route' => 'Panel.category.index'],
                    ['label' => 'ایجاد دسته جدید', 'route' => 'Panel.category.create'],
                ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('sidebar.menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'categoryMenu','title' => 'دسته‌بندی‌ها','active-pattern' => 'Panel/category*','items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                    ['label' => 'لیست دسته‌بندی‌ها', 'route' => 'Panel.category.index'],
                    ['label' => 'ایجاد دسته جدید', 'route' => 'Panel.category.create'],
                ])]); ?>
                 <?php $__env->slot('icon', null, []); ?> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-tag">
                   <path d="M20.59 13.41L12 4.83 4.41 12.41a2 2 0 0 0 0 2.83l7.59 7.59a2 2 0 0 0 2.83 0l7.59-7.59a2 2 0 0 0 0-2.83z" />
                   <line x1="7" y1="7" x2="7.01" y2="7" />
               </svg>

             <?php $__env->endSlot(); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalae3d549817efd838cc46a54970da6fc7)): ?>
<?php $attributes = $__attributesOriginalae3d549817efd838cc46a54970da6fc7; ?>
<?php unset($__attributesOriginalae3d549817efd838cc46a54970da6fc7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalae3d549817efd838cc46a54970da6fc7)): ?>
<?php $component = $__componentOriginalae3d549817efd838cc46a54970da6fc7; ?>
<?php unset($__componentOriginalae3d549817efd838cc46a54970da6fc7); ?>
<?php endif; ?>



            <?php if (isset($component)) { $__componentOriginalae3d549817efd838cc46a54970da6fc7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalae3d549817efd838cc46a54970da6fc7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.menu-item','data' => ['id' => 'sliderMenu','title' => 'اسلایدها','activePattern' => 'Panel/Sliders*','items' => [
                ['label' => 'لیست اسلایدها', 'route' => 'Panel.Sliders.index'],
                ['label' => 'ایجاد اسلاید جدید', 'route' => 'Panel.Sliders.create'],
            ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('sidebar.menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'sliderMenu','title' => 'اسلایدها','active-pattern' => 'Panel/Sliders*','items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                ['label' => 'لیست اسلایدها', 'route' => 'Panel.Sliders.index'],
                ['label' => 'ایجاد اسلاید جدید', 'route' => 'Panel.Sliders.create'],
            ])]); ?>
             <?php $__env->slot('icon', null, []); ?> 
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-image">
               <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
               <circle cx="8.5" cy="8.5" r="1.5" />
               <polyline points="21 15 16 10 5 21" />
           </svg>

             <?php $__env->endSlot(); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalae3d549817efd838cc46a54970da6fc7)): ?>
<?php $attributes = $__attributesOriginalae3d549817efd838cc46a54970da6fc7; ?>
<?php unset($__attributesOriginalae3d549817efd838cc46a54970da6fc7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalae3d549817efd838cc46a54970da6fc7)): ?>
<?php $component = $__componentOriginalae3d549817efd838cc46a54970da6fc7; ?>
<?php unset($__componentOriginalae3d549817efd838cc46a54970da6fc7); ?>
<?php endif; ?>
        <?php endif; ?>

        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'master')): ?>

        <?php if (isset($component)) { $__componentOriginalae3d549817efd838cc46a54970da6fc7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalae3d549817efd838cc46a54970da6fc7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.menu-item','data' => ['id' => 'userMenu','title' => 'کاربران','activePattern' => 'Panel/users*','items' => [
            ['label' => 'لیست کاربران', 'route' => 'Panel.users.index'],
            ['label' => 'ایجاد کاربر جدید', 'route' => 'Panel.users.create'],
        ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('sidebar.menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'userMenu','title' => 'کاربران','active-pattern' => 'Panel/users*','items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
            ['label' => 'لیست کاربران', 'route' => 'Panel.users.index'],
            ['label' => 'ایجاد کاربر جدید', 'route' => 'Panel.users.create'],
        ])]); ?>
         <?php $__env->slot('icon', null, []); ?> 
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-users">
           <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
           <circle cx="9" cy="7" r="4" />
           <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
           <path d="M16 3.13a4 4 0 0 1 0 7.75" />
       </svg>
        <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalae3d549817efd838cc46a54970da6fc7)): ?>
<?php $attributes = $__attributesOriginalae3d549817efd838cc46a54970da6fc7; ?>
<?php unset($__attributesOriginalae3d549817efd838cc46a54970da6fc7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalae3d549817efd838cc46a54970da6fc7)): ?>
<?php $component = $__componentOriginalae3d549817efd838cc46a54970da6fc7; ?>
<?php unset($__componentOriginalae3d549817efd838cc46a54970da6fc7); ?>
<?php endif; ?>
    <?php endif; ?>
    <li class="menu">
        <a href="<?php echo e(route('Panel.account.index')); ?>" aria-expanded="false" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-3-3.87" />
                    <path d="M4 21v-2a4 4 0 0 1 3-3.87" />
                    <circle cx="12" cy="7" r="4" />
                  </svg>
                <span>حساب کاربری</span>
            </div>
        </a>
    </li>
                    <form action="<?php echo e(route('logout')); ?>" id="logout-form" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                    <li class="menu">
                        <a href="#" aria-expanded="false" onclick="confirmLogout()" class="dropdown-toggle">
                            <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                <span>خروج از حساب کاربری</span>
                            </div>
                        </a>
                    </li>
                </ul>

            </nav>

        </div>
        <!--  END SIDEBAR  -->
            <?php echo $__env->yieldContent('content'); ?>


    </div>










    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>
    <script src="<?php echo e(asset('PanelAsset/assets/js/libs/jquery-3.1.1.min.js')); ?> "></script>
    <script src="<?php echo e(asset('PanelAsset/bootstrap/js/popper.min.js')); ?> "></script>
    <script src="<?php echo e(asset('PanelAsset/bootstrap/js/bootstrap.min.js')); ?> "></script>
    <script src="<?php echo e(asset('PanelAsset/plugins/perfect-scrollbar/perfect-scrollbar.min.js')); ?> "></script>
    <script src="<?php echo e(asset('PanelAsset/assets/js/app.js')); ?> "></script>
    <script>
        feather.replace();
    </script>

    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="<?php echo e(asset('PanelAsset/plugins/highlight/highlight.pack.js')); ?> "></script>
    <script src="<?php echo e(asset('PanelAsset/assets/js/custom.js')); ?> "></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="<?php echo e(asset('PanelAsset/assets/js/scrollspyNav.js')); ?> "></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="<?php echo e(asset('PanelAsset/plugins/jquery-ui/jquery-ui.min.js')); ?> "></script>
    <script src="<?php echo e(asset('PanelAsset/assets/js/apps/contact.js')); ?> "></script>
    <script src="<?php echo e(asset('PanelAsset/plugins/dropify/dropify.min.js')); ?> "></script>
    <script src="<?php echo e(asset('PanelAsset/plugins/blockui/jquery.blockUI.min.js')); ?> "></script>
    <script src="<?php echo e(asset('PanelAsset/assets/js/users/account-settings.js')); ?> "></script>
    <script src="<?php echo e(asset('PanelAsset/plugins/apex/apexcharts.min.js')); ?> "></script>
    <script src="<?php echo e(asset('PanelAsset/assets/js/widgets/modules-widgets.js')); ?> "></script>
    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'آیا مطمئن هستید؟',
                text: "می‌خواهید از حساب خارج شوید؟",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: "#d33",
                background: '#1e1e2f',
                color: '#f1f1f1',
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
    <?php echo $__env->yieldContent('jssrc'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\zayShop\resources\views/Panel/master.blade.php ENDPATH**/ ?>