<?php $__env->startSection('content'); ?>
        <!--  END SIDEBAR  -->
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="dashboard-summary">
                    <div class="summary-box">
                        <h3>درآمد امروز</h3>
                        <p><?php echo e(number_format($stats->todayRevenue)); ?></p>
                    </div>
                    <div class="summary-box">
                        <h3>سفارش‌های امروز</h3>
                        <p><?php echo e($stats->todayOrders); ?></p>
                    </div>
                    <div class="summary-box">
                        <h3>سفارش‌های این هفته</h3>
                        <p><?php echo e($stats->weekOrders); ?></p>
                    </div>
                    <div class="summary-box">
                        <h3>آیتم‌های فروخته‌شده</h3>
                        <p><?php echo e($stats->soldItems); ?></p>
                    </div>
                    <div class="summary-box">
                        <h3>تعداد کاربران</h3>
                        <p><?php echo e($stats->users); ?></p>
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

                    

                </div>
                

                <div class="row sales">

                    

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget-three">
                            <div class="widget-heading">
                                <h5 class="">محبوب ترین رنگها</h5>
                            </div>
                            <div class="widget-content">
                                <?php $__currentLoopData = $stats->topColors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <div class="popularColor">
                                    <?php echo e($item->name); ?>

                                    <div class="showColor text-white" style="background-color: <?php echo e($item->code); ?>"></div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget-three">
                            <div class="widget-heading">
                                <h5 class="">محبوب ترین سایزها</h5>
                            </div>
                            <div class="widget-content">
                                <?php $__currentLoopData = $stats->topSizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <div class="popularColor">
                                    <?php echo e($item->name); ?>,
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>

                    

                </div>

                

                <div class="row sales">

                    <div class="col-xl-5 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                                <h5 class="">پرفروش ترین محصولات</h5>
                            </div>
                            <?php $__currentLoopData = $topProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="widget-content">
                                <div class="transactions-list">
                                    <a href="<?php echo e(route('Home.shop_single',$item->product_slug)); ?>">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-image">
                                                <div class="image">
                                                    <img class="m-1" height="45px" src="<?php echo e(asset('images/product/'.$item->product_image)); ?>" alt="">
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4><?php echo e($item->product_name); ?></h4>
                                            </div>

                                        </div>
                                        <div>
                                            <p><span>تعداد خرید<?php echo e($item->total_sales); ?></span></p>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <div class="col-xl-5 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                                <h5 class="">پرفروش ترین دسته بندی</h5>
                            </div>
                            <?php $__currentLoopData = $topCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="widget-content">
                                <div class="transactions-list">
                                    <a href="<?php echo e(route('Home.shop', ['category'=>$item->category_id])); ?>">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                                <div class="image">
                                                    <img class="m-1" height="45px" src="<?php echo e(asset('images/Category/'.$item->category_image)); ?>" alt="">
                                                </div>
                                            <div class="t-name">
                                                <h4><?php echo e($item->category_name); ?></h4>
                                            </div>

                                        </div>
                                        <div>
                                            <p><span>تعداد خرید<?php echo e($item->total_sales); ?></span></p>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <div class="col-xl-5 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                                <h5 class="">محبوب ها در علاقه مندی</h5>
                            </div>
                            <?php $__currentLoopData = $stats->topFavorites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="widget-content">
                                <div class="transactions-list">
                                    <a href="<?php echo e(route('Home.shop_single',$item->product->slug)); ?>">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                                <div class="image">
                                                    <img class="m-1" height="45px" src="<?php echo e(asset('images/product/'.$item->product->images->first()->image)); ?>" alt="">
                                                </div>
                                            <div class="t-name">
                                                <h4><?php echo e($item->product->name); ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                                <h5 class="">محبوب ها در سبد خرید</h5>
                            </div>
                            <?php $__currentLoopData = $stats->topCart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="widget-content">
                                <div class="transactions-list">
                                    <a href="<?php echo e(route('Home.shop_single',$item->variant->product->slug)); ?>">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                                <div class="image">
                                                    <img class="m-1" height="45px" src="<?php echo e(asset('images/product/'.$item->variant->product->images->first()->image)); ?>" alt="">
                                                </div>
                                            <div class="t-name">
                                                <h4><?php echo e($item->variant->product->name); ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                                <h5 class="">محصولات ناموجود</h5>
                            </div>
                            <?php $__currentLoopData = $stats->unavailable; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="widget-content">
                                <div class="transactions-list">
                                    <a href="<?php echo e(route('Home.shop_single',$item->product->slug)); ?>">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                                <div class="image">
                                                    <img class="m-1" height="45px" src="<?php echo e(asset('images/product/'.$item->product->images->first()->image)); ?>" alt="">
                                                </div>
                                            <div class="t-name">
                                                <h4><?php echo e($item->product->name); ?></h4>
                                            </div>
                                            <p><span>رنگ=<?php echo e($item->color->name); ?></span></p>
                                        </div>
                                            <p><span>سایز=<?php echo e($item->size->name); ?></span></p>
                                    </div>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    

                </div>

                

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

            <?php $__env->startSection('jssrc'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let salesChart;

function loadSalesChart(range = 'daily') {
    $.get('<?php echo e(route("Panel.analysis.chart")); ?>', { range }, function (res) {

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

            <?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('Panel.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zayShop\resources\views/Panel/analysis/analysis.blade.php ENDPATH**/ ?>