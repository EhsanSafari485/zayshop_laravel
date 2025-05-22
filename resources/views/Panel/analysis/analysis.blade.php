@extends('Panel.master')
@section('content')
        <!--  END SIDEBAR  -->
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="dashboard-summary">
                    <div class="summary-box">
                        <h3>درآمد امروز</h3>
                        <p>{{ number_format($stats->todayRevenue) }}</p>
                    </div>
                    <div class="summary-box">
                        <h3>سفارش‌های امروز</h3>
                        <p>{{$stats->todayOrders}}</p>
                    </div>
                    <div class="summary-box">
                        <h3>سفارش‌های این هفته</h3>
                        <p>{{ $stats->weekOrders }}</p>
                    </div>
                    <div class="summary-box">
                        <h3>آیتم‌های فروخته‌شده</h3>
                        <p>{{$stats->soldItems}}</p>
                    </div>
                    <div class="summary-box">
                        <h3>تعداد کاربران</h3>
                        <p>{{$stats->users}}</p>
                    </div>
                </div>
                <div class="row sales layout-top-spacing">

                    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-chart-one">
                            <div class="widget-heading">
                                <h5>درآمد:<span class="totalPrice"></span></h5>
                                <ul class="tabs tab-pills">
                                    <li><a href="javascript:void(0);" class="tabmenu" style="background-color: darkslategray;" data-range="daily">روزانه</a></li>
                                    <li><a href="javascript:void(0);" class="tabmenu" data-range="weekly">هفتگی</a></li>
                                    <li><a href="javascript:void(0);" class="tabmenu" data-range="monthly">ماهانه</a></li>
                                </ul>
                            </div>

                            <div class="widget-content">
                                <div class="tabs tab-content">
                                    <div id="content_1" class="tabcontent">
                                        <canvas id="revenueMonthlyContainer" height="100"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-chart-two">
                            <div class="widget-heading">
                                <h5 class="">فروش بر اساس دسته بندی</h5>
                            </div>
                            <div class="widget-content">
                                <div id="chart-2" class=""></div>
                            </div>
                        </div>
                    </div> --}}

                </div>
                {{-- <div class="row analytics">

                    <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-chart-three">
                            <div class="widget-heading">
                                <div class="">
                                    <h5 class="">بازدید کنندگان بکتا</h5>
                                </div>

                                <div class="dropdown  custom-dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                        <a class="dropdown-item" href="javascript:void(0);">مشاهده</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                        <a class="dropdown-item" href="javascript:void(0);">دانلود</a>
                                    </div>
                                </div>
                            </div>

                            <div class="widget-content">
                                <div id="uniqueVisits"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-activity-three">

                            <div class="widget-heading">
                                <h5 class="">اطلاعیه ها</h5>
                            </div>

                            <div class="widget-content">

                                <div class="mt-container mx-auto">
                                    <div class="timeline-line">

                                        <div class="item-timeline timeline-new">
                                            <div class="t-dot">
                                                <div class="t-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>Logs</h5>
                                                    <span class="">27 فروردین 1399</span>
                                                </div>
                                                <p><span>بروزرسانی</span> گزارشات سرور</p>
                                                <div class="tags">
                                                    <div class="badge badge-primary">گزارشات</div>
                                                    <div class="badge badge-success">CPanel</div>
                                                    <div class="badge badge-warning">بروزرسانی</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="item-timeline timeline-new">
                                            <div class="t-dot">
                                                <div class="t-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>نامه</h5>
                                                    <span class="">16 فروردین 1399</span>
                                                </div>
                                                <p>ارسال نامه به <a href="javascript:void(0);">HR</a> و <a href="javascript:void(0);">ادمین</a></p>
                                                <div class="tags">
                                                    <div class="badge badge-primary">ادمین</div>
                                                    <div class="badge badge-success">HR</div>
                                                    <div class="badge badge-warning">نامه</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="item-timeline timeline-new">
                                            <div class="t-dot">
                                                <div class="t-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>کار تکمیل شد</h5>
                                                    <span class="">20 فروردین 1399</span>
                                                </div>
                                                <p>پشتیبان گیری <span>فایل EOD</span></p>
                                                <div class="tags">
                                                    <div class="badge badge-primary">پشتیبان گیری</div>
                                                    <div class="badge badge-success">EOD</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="item-timeline timeline-new">
                                            <div class="t-dot">
                                                <div class="t-warning"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>اسناد را جمع کنید</h5>
                                                    <span class="">22 فروردین 1399</span>
                                                </div>
                                                <p>اسناد جمع آوری شده از <a href="javascript:void(0);">سارا</a></p>
                                                <div class="tags">
                                                    <div class="badge badge-success">جمع کن</div>
                                                    <div class="badge badge-warning">اسناد</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="item-timeline timeline-new">
                                            <div class="t-dot">
                                                <div class="t-dark"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6" y2="6"></line><line x1="6" y1="18" x2="6" y2="18"></line></svg></div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>راه اندازی مجدد</h5>
                                                    <span class="">24 فروردین 1399</span>
                                                </div>
                                                <p>راه اندازی مجدد با موفقیت</p>
                                                <div class="tags">
                                                    <div class="badge badge-warning">راه اندازی مجدد</div>
                                                    <div class="badge badge-primary">سرور</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-one">
                            <div class="widget-heading">
                                <h6 class="">آمار</h6>
                            </div>
                            <div class="w-chart">
                                <div class="w-chart-section">
                                    <div class="w-detail">
                                        <p class="w-title">تعداد بازدیدها</p>
                                        <p class="w-stats">423,964</p>
                                    </div>
                                    <div class="w-chart-render-one">
                                        <div id="total-users"></div>
                                    </div>
                                </div>

                                <div class="w-chart-section">
                                    <div class="w-detail">
                                        <p class="w-title">بازدیدهای پرداخت شده</p>
                                        <p class="w-stats">7,929</p>
                                    </div>
                                    <div class="w-chart-render-one">
                                        <div id="paid-visits"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-account-invoice-two">
                            <div class="widget-content">
                                <div class="account-box">
                                    <div class="info">
                                        <h5 class="">پنل ویژه</h5>
                                        <p class="inv-balance">10000 تومان</p>
                                    </div>
                                    <div class="acc-action">
                                        <div class="">
                                            <a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></a>
                                            <a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg></a>
                                        </div>
                                        <a href="javascript:void(0);">ارتقا</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="w-content">
                                    <div class="w-info">
                                        <h6 class="value">45000 تومان</h6>
                                        <p class="">هزینه ها</p>
                                    </div>
                                    <div class="">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: 57%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="row sales">

                    {{-- <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget-two">
                            <div class="widget-content">
                                <div class="w-numeric-value">
                                    <div class="w-content">
                                        <span class="w-value">فروش روزانه</span>
                                        <span class="w-numeric-title">برای جزئیات بیشتر به ستون ها بروید.</span>
                                    </div>
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                    </div>
                                </div>
                                <div class="w-chart">
                                    <div id="daily-sales"></div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget-three">
                            <div class="widget-heading">
                                <h5 class="">محبوب ترین رنگها</h5>
                            </div>
                            <div class="widget-content">
                                @foreach ($stats->topColors as $item)

                                <div class="popularColor">
                                    {{$item->name}}
                                    <div class="showColor text-white" style="background-color: {{$item->code}}"></div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget-three">
                            <div class="widget-heading">
                                <h5 class="">محبوب ترین سایزها</h5>
                            </div>
                            <div class="widget-content">
                                @foreach ($stats->topSizes as $item)

                                <div class="popularColor">
                                    {{$item->name}},
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-xl-4 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget-one">
                            <div class="widget-content">
                                <div class="w-numeric-value">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                    </div>
                                    <div class="w-content">
                                        <span class="w-value">3,192</span>
                                        <span class="w-numeric-title">Total Orders</span>
                                    </div>
                                </div>
                                <div class="w-chart">
                                    <div id="total-orders"></div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>

                {{-- <div class="row analytics">

                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget-four">
                            <div class="widget-heading">
                                <h5 class="">بازدیدکنندگان بر اساس Browser</h5>
                            </div>
                            <div class="widget-content">
                                <div class="vistorsBrowser">
                                    <div class="browser-list">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chrome"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="21.17" y1="8" x2="12" y2="8"></line><line x1="3.95" y1="6.06" x2="8.54" y2="14"></line><line x1="10.88" y1="21.94" x2="15.46" y2="14"></line></svg>
                                        </div>
                                        <div class="w-browser-details">
                                            <div class="w-browser-info">
                                                <h6>Chrome</h6>
                                                <p class="browser-count">65%</p>
                                            </div>
                                            <div class="w-browser-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: 65%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="browser-list">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-compass"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
                                        </div>
                                        <div class="w-browser-details">

                                            <div class="w-browser-info">
                                                <h6>Safari</h6>
                                                <p class="browser-count">25%</p>
                                            </div>

                                            <div class="w-browser-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 35%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="browser-list">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                                        </div>
                                        <div class="w-browser-details">

                                            <div class="w-browser-info">
                                                <h6>دیگر</h6>
                                                <p class="browser-count">15%</p>
                                            </div>

                                            <div class="w-browser-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="row widget-statistic">

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="widget widget-one_hybrid widget-followers">
                                    <div class="widget-heading">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                        </div>
                                        <p class="w-value">31.6K</p>
                                        <h5 class="">دنبال کنندگان</h5>
                                    </div>
                                    <div class="widget-content">
                                        <div class="w-chart">
                                            <div id="hybrid_followers"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="widget widget-one_hybrid widget-referral">
                                    <div class="widget-heading">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                                        </div>
                                        <p class="w-value">1,900</p>
                                        <h5 class="">معرف</h5>
                                    </div>
                                    <div class="widget-content">
                                        <div class="w-chart">
                                            <div id="hybrid_followers1"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="widget widget-one_hybrid widget-engagement">
                                    <div class="widget-heading">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                        </div>
                                        <p class="w-value">18.2%</p>
                                        <h5 class="">برتری</h5>
                                    </div>
                                    <div class="widget-content">
                                        <div class="w-chart">
                                            <div id="hybrid_followers3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row analytics">

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-one">
                            <div class="widget-content">

                                <div class="media">
                                    <div class="w-img">
                                        <img src="assets/img/90x90.jpg" alt="avatar">
                                    </div>
                                    <div class="media-body">
                                        <h6>حمید لولایی</h6>
                                        <p class="meta-date-time">دوشنبه 20 مهر</p>
                                    </div>
                                </div>

                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد.</p>

                                <div class="w-action">
                                    <div class="card-like">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                                        <span>551 پسند</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-five">
                            <div class="widget-content">

                                <div class="header">
                                    <div class="header-body">
                                        <h6>وظایف در انتظار</h6>
                                        <p class="meta-date">خرداد 1399</p>
                                    </div>
                                    <div class="task-action">
                                        <div class="dropdown  custom-dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="pendingTask">
                                                <a class="dropdown-item" href="javascript:void(0);">اضافه کردن</a>
                                                <a class="dropdown-item" href="javascript:void(0);">بازدید</a>
                                                <a class="dropdown-item" href="javascript:void(0);">بروزرسانی</a>
                                                <a class="dropdown-item" href="javascript:void(0);">پاک کردن همه</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-content">
                                    <div class="">
                                        <p class="task-left">8</p>
                                        <p class="task-completed"><span>12 انجام شد</span></p>
                                        <p class="task-hight-priority"><span>3 وظیفه</span> با اولویت بالا</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-card-two">
                            <div class="widget-content">

                                <div class="media">
                                    <div class="w-img">
                                        <img src="assets/img/90x90.jpg" alt="avatar">
                                    </div>
                                    <div class="media-body">
                                        <h6>امیر رضایی - شیراز</h6>
                                        <p class="meta-date-time">طراح سایت</p>
                                    </div>
                                </div>

                                <div class="card-bottom-section">
                                    <h5>4 عضو در حال رفتن</h5>
                                    <div class="img-group">
                                        <img src="assets/img/90x90.jpg" alt="avatar">
                                        <img src="assets/img/90x90.jpg" alt="avatar">
                                        <img src="assets/img/90x90.jpg" alt="avatar">
                                        <img src="assets/img/90x90.jpg" alt="avatar">
                                    </div>
                                    <a href="javascript:void(0);" class="btn">دیدن جزئیات</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> --}}

                <div class="row sales">

                    <div class="col-xl-5 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                                <h5 class="">پرفروش ترین محصولات</h5>
                            </div>
                            @foreach ($topProducts as $item)
                            <div class="widget-content">
                                <div class="transactions-list">
                                    <a href="{{ route('Home.shop_single',$item->product_slug) }}">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-image">
                                                <div class="image">
                                                    <img class="m-1" height="45px" src="{{ asset('images/product/'.$item->product_image) }}" alt="">
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>{{$item->product_name}}</h4>
                                            </div>

                                        </div>
                                        <div>
                                            <p><span>تعداد خرید{{$item->total_sales}}</span></p>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-xl-5 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                                <h5 class="">پرفروش ترین دسته بندی</h5>
                            </div>
                            @foreach ($topCategories as $item)
                            <div class="widget-content">
                                <div class="transactions-list">
                                    <a href="{{ route('Home.shop', ['category'=>$item->category_id]) }}">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                                <div class="image">
                                                    <img class="m-1" height="45px" src="{{ asset('images/Category/'.$item->category_image) }}" alt="">
                                                </div>
                                            <div class="t-name">
                                                <h4>{{$item->category_name}}</h4>
                                            </div>

                                        </div>
                                        <div>
                                            <p><span>تعداد خرید{{$item->total_sales}}</span></p>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-xl-5 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                                <h5 class="">محبوب ها در علاقه مندی</h5>
                            </div>
                            @foreach ($stats->topFavorites as $item)
                            <div class="widget-content">
                                <div class="transactions-list">
                                    <a href="{{ route('Home.shop_single',$item->product->slug) }}">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                                <div class="image">
                                                    <img class="m-1" height="45px" src="{{ asset('images/product/'.$item->product->images->first()->image) }}" alt="">
                                                </div>
                                            <div class="t-name">
                                                <h4>{{$item->product->name}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                                <h5 class="">محبوب ها در سبد خرید</h5>
                            </div>
                            @foreach ($stats->topCart as $item)
                            <div class="widget-content">
                                <div class="transactions-list">
                                    <a href="{{ route('Home.shop_single',$item->variant->product->slug) }}">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                                <div class="image">
                                                    <img class="m-1" height="45px" src="{{ asset('images/product/'.$item->variant->product->images->first()->image) }}" alt="">
                                                </div>
                                            <div class="t-name">
                                                <h4>{{$item->variant->product->name}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                                <h5 class="">محصولات ناموجود</h5>
                            </div>
                            @foreach ($stats->unavailable as $item)
                            <div class="widget-content">
                                <div class="transactions-list">
                                    <a href="{{ route('Home.shop_single',$item->product->slug) }}">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                                <div class="image">
                                                    <img class="m-1" height="45px" src="{{ asset('images/product/'.$item->product->images->first()->image) }}" alt="">
                                                </div>
                                            <div class="t-name">
                                                <h4>{{$item->product->name}}</h4>
                                            </div>
                                            <p><span>رنگ={{$item->color->name}}</span></p>
                                        </div>
                                            <p><span>سایز={{$item->size->name}}</span></p>
                                    </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">

                        <div class="widget widget-account-invoice-one">

                            <div class="widget-heading">
                                <h5 class="">اطلاعات اکانت</h5>
                            </div>

                            <div class="widget-content">
                                <div class="invoice-box">

                                    <div class="acc-total-info">
                                        <h5>تعادل</h5>
                                        <p class="acc-amount">$470</p>
                                    </div>

                                    <div class="inv-detail">
                                        <div class="info-detail-1">
                                            <p>پنل ماهانه</p>
                                            <p>$ 199.0</p>
                                        </div>
                                        <div class="info-detail-2">
                                            <p>ایران</p>
                                            <p>$ 17.82</p>
                                        </div>
                                        <div class="info-detail-3 info-sub">
                                            <div class="info-detail">
                                                <p>هزینه های ماهانه</p>
                                                <p>$ -0.68</p>
                                            </div>
                                            <div class="info-detail-sub">
                                                <p>اشتراک سالانه ، Netflix</p>
                                                <p>$ 0</p>
                                            </div>
                                            <div class="info-detail-sub">
                                                <p>دیگر</p>
                                                <p>$ -0.68</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="inv-action">
                                        <a href="" class="btn btn-dark">خلاصه</a>
                                        <a href="" class="btn btn-danger">انتقال</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-two">

                            <div class="widget-heading">
                                <h5 class="">سفارشات اخیر</h5>
                            </div>

                            <div class="widget-content">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><div class="th-content">مشتری</div></th>
                                                <th><div class="th-content">محصول</div></th>
                                                <th><div class="th-content">صورتحساب</div></th>
                                                <th><div class="th-content th-heading">قیمت</div></th>
                                                <th><div class="th-content">وضعیت</div></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><div class="td-content customer-name"><img src="assets/img/90x90.jpg" alt="avatar">اندی کینگ</div></td>
                                                <td><div class="td-content product-brand">نایک اسپرت</div></td>
                                                <td><div class="td-content">#76894</div></td>
                                                <td><div class="td-content pricing"><span class="">88000 تومان</span></div></td>
                                                <td><div class="td-content"><span class="badge outline-badge-primary">حمل شده</span></div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="td-content customer-name"><img src="assets/img/90x90.jpg" alt="avatar">ایرین کالینز</div></td>
                                                <td><div class="td-content product-brand">بلندگو</div></td>
                                                <td><div class="td-content">#75844</div></td>
                                                <td><div class="td-content pricing"><span class="">840000 تومان</span></div></td>
                                                <td><div class="td-content"><span class="badge outline-badge-success">پرداخت شده</span></div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="td-content customer-name"><img src="assets/img/90x90.jpg" alt="avatar">لوری فاکس</div></td>
                                                <td><div class="td-content product-brand">دوربین</div></td>
                                                <td><div class="td-content">#66894</div></td>
                                                <td><div class="td-content pricing"><span class="">1260000 تومان</span></div></td>
                                                <td><div class="td-content"><span class="badge outline-badge-danger">در انتظار</span></div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="td-content customer-name"><img src="assets/img/90x90.jpg" alt="avatar">لوک عاج</div></td>
                                                <td><div class="td-content product-brand">هدفون</div></td>
                                                <td><div class="td-content">#46894</div></td>
                                                <td><div class="td-content pricing"><span class="">560000 تومان</span></div></td>
                                                <td><div class="td-content"><span class="badge outline-badge-success">پرداخت شده</span></div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="td-content customer-name"><img src="assets/img/90x90.jpg" alt="avatar">رایان کالینز</div></td>
                                                <td><div class="td-content product-brand">ورزش</div></td>
                                                <td><div class="td-content">#89891</div></td>
                                                <td><div class="td-content pricing"><span class="">108000 تومان</span></div></td>
                                                <td><div class="td-content"><span class="badge outline-badge-primary">حمل شده</span></div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="td-content customer-name"><img src="assets/img/90x90.jpg" alt="avatar">نیا هیلیر</div></td>
                                                <td><div class="td-content product-brand">عینک</div></td>
                                                <td><div class="td-content">#26974</div></td>
                                                <td><div class="td-content pricing"><span class="">1680000 تومان</span></div></td>
                                                <td><div class="td-content"><span class="badge outline-badge-primary">حمل شده</span></div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="td-content customer-name"><img src="assets/img/90x90.jpg" alt="avatar">سونیا شاو</div></td>
                                                <td><div class="td-content product-brand">ساعت</div></td>
                                                <td><div class="td-content">#76844</div></td>
                                                <td><div class="td-content pricing"><span class="">110000 تومان</span></div></td>
                                                <td><div class="td-content"><span class="badge outline-badge-success">پرداخت شده</span></div></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-three">

                            <div class="widget-heading">
                                <h5 class=""> محصول برتر فروش</h5>
                            </div>

                            <div class="widget-content">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><div class="th-content">محصول</div></th>
                                                <th><div class="th-content th-heading">قیمت</div></th>
                                                <th><div class="th-content th-heading">تخفیف</div></th>
                                                <th><div class="th-content">فروخته شده</div></th>
                                                <th><div class="th-content">منبع</div></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><div class="td-content product-name"><img src="assets/img/90x90.jpg" alt="product">بلندگو</div></td>
                                                <td><div class="td-content"><span class="pricing">860000 تومان</span></div></td>
                                                <td><div class="td-content"><span class="discount-pricing">10000 تومان</span></div></td>
                                                <td><div class="td-content">240</div></td>
                                                <td><div class="td-content"><a href="javascript:void(0);" class="">مستقیم</a></div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="td-content product-name"><img src="assets/img/90x90.jpg" alt="product">عینک</div></td>
                                                <td><div class="td-content"><span class="pricing">560000 تومان</span></div></td>
                                                <td><div class="td-content"><span class="discount-pricing">50000 تومان</span></div></td>
                                                <td><div class="td-content">190</div></td>
                                                <td><div class="td-content"><a href="javascript:void(0);" class="">گوگل</a></div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="td-content product-name"><img src="assets/img/90x90.jpg" alt="product">ساعت</div></td>
                                                <td><div class="td-content"><span class="pricing">88000 تومان</span></div></td>
                                                <td><div class="td-content"><span class="discount-pricing">20000 تومان</span></div></td>
                                                <td><div class="td-content">66</div></td>
                                                <td><div class="td-content"><a href="javascript:void(0);" class="">تبلیغات</a></div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="td-content product-name"><img src="assets/img/90x90.jpg" alt="product">لپتاپ</div></td>
                                                <td><div class="td-content"><span class="pricing">110000 تومان</span></div></td>
                                                <td><div class="td-content"><span class="discount-pricing">56000 تومان</span></div></td>
                                                <td><div class="td-content">35</div></td>
                                                <td><div class="td-content"><a href="javascript:void(0);" class="">ایمیل</a></div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="td-content product-name"><img src="assets/img/90x90.jpg" alt="product">دوربین</div></td>
                                                <td><div class="td-content"><span class="pricing">2500000 تومان</span></div></td>
                                                <td><div class="td-content"><span class="discount-pricing">120000 تومان</span></div></td>
                                                <td><div class="td-content">30</div></td>
                                                <td><div class="td-content"><a href="javascript:void(0);" class="">معرف</a></div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="td-content product-name"><img src="assets/img/90x90.jpg" alt="product">کفش</div></td>
                                                <td><div class="td-content"><span class="pricing">1180000 تومان</span></div></td>
                                                <td><div class="td-content"><span class="discount-pricing">460000 تومان</span></div></td>
                                                <td><div class="td-content">130</div></td>
                                                <td><div class="td-content"><a href="javascript:void(0);" class="">گوگل</a></div></td>
                                            </tr>
                                            <tr>
                                                <td><div class="td-content product-name"><img src="assets/img/90x90.jpg" alt="product">هدفون</div></td>
                                                <td><div class="td-content"><span class="pricing">1680000 تومان</span></div></td>
                                                <td><div class="td-content"><span class="discount-pricing">560000 تومان</span></div></td>
                                                <td><div class="td-content">170</div></td>
                                                <td><div class="td-content"><a href="javascript:void(0);" class="">Ads</a></div></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>

                {{-- <div class="row">
                    <div class="sales col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">

                        <div class="widget widget-activity-one">

                            <div class="widget-heading">
                                <h5 class=""> فعالیت های اخیر</h5>
                            </div>

                            <div class="widget-content">

                                <div class="activity-selector">
                                    <select class="form-control">
                                        <option>24 ساعت گذشته</option>
                                        <option>دیروز</option>
                                        <option>7 روز گذشته</option>
                                        <option>30 روز گذشته</option>
                                        <option>قدیمی تر</option>
                                    </select>
                                </div>

                                <div class="mt-container mx-auto">
                                    <div class="timeline-line">

                                        <div class="item-timeline timeline-new">
                                            <p class="t-time">همین حالا</p>
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p><span>بروز رسانی</span> گزارشات سرور</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline">
                                            <p class="t-time">2 دقیقه قبل</p>
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p>Send Mail to <a href="javascript:void(0);">HR</a> و <a href="javascript:void(0);">ادمین</a></p>
                                            </div>
                                        </div>

                                        <div class="item-timeline">
                                            <p class="t-time">14:00</p>
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p>Backup <span>Files EOD</span></p>
                                            </div>
                                        </div>

                                        <div class="item-timeline">
                                            <p class="t-time">16:00</p>
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p>اسناد جمع آوری شده از <a href="javascript:void(0);">سارا</a></p>
                                            </div>
                                        </div>

                                        <div class="item-timeline">
                                            <p class="t-time">16:00</p>
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p>راه اندازی مجدد با موفقیت</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline">
                                            <p class="t-time">17:00</p>
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p>تماس کنفرانسی با <a href="javascript:void(0);">مدیر بازاریابی</a>.</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="tm-action-btn">
                                    <button class="btn">دیدن همه <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="analytics col-xl-3 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-activity-two">

                            <div class="widget-heading">
                                <h5 class="">اطلاعیه ها</h5>
                            </div>

                            <div class="widget-content">

                                <div class="mt-container mx-auto">
                                    <div class="timeline-line">

                                        <div class="item-timeline timeline-new">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p><span>بروز رسانی</span> گزارشات سرور</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p>Send Mail to <a href="javascript:void(0);">HR</a> و <a href="javascript:void(0);">ادمین</a></p>
                                            </div>
                                        </div>

                                        <div class="item-timeline">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p>Backup <span>Files EOD</span></p>
                                            </div>
                                        </div>

                                        <div class="item-timeline">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p>اسناد جمع آوری شده از <a href="javascript:void(0);">سارا</a></p>
                                            </div>
                                        </div>

                                        <div class="item-timeline">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p>راه اندازی مجدد با موفقیت</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p>تماس کنفرانسی با <a href="javascript:void(0);">مدیر بازاریابی</a>.</p>
                                            </div>
                                        </div>

                                        <div class="item-timeline">
                                            <div class="t-dot" data-original-title="" title="">
                                            </div>
                                            <div class="t-text">
                                                <p>Collected files from <a href="javascript:void(0);">حمید</a>.</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="tm-action-btn">
                                    <button class="btn">View All</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class=""> © کپی رایت</p>
                </div>
                <div class="footer-section f-section-2">
 <span class="copyright"> بومی سازی شده توسط : <a href="https://imanpa.ir/store/"> ایمان پاکروح </a> </span>
</div>
            </div>
        </div>

            @section('jssrc')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let salesChart;

function loadSalesChart(range = 'daily') {
    $.get('{{ route("Panel.analysis.chart") }}', { range }, function (res) {

        const ctx = document.getElementById('revenueMonthlyContainer').getContext('2d');

        if (salesChart) {
            salesChart.destroy();
        }
        $('.totalPrice').text(res.totalPrice);
        salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: res.labels,
                datasets: [{
                    label: 'درآمد',
                    data: res.data,
                    backgroundColor: 'rgba(40,167,69,0.2)',
                    borderColor: 'rgba(40,167,69,1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    });
}

$('.tabmenu').on('click', function () {
    $('.tabmenu').css('background-color','#1b55e2');
    $(this).css('background-color','darkslategray');
    const range = $(this).data('range');
    loadSalesChart(range);
});

$(document).ready(function () {
    loadSalesChart('daily');
});
</script>

            @endsection
@endsection

