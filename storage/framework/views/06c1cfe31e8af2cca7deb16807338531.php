<?php $__env->startSection('content'); ?>
     <!-- Start Content -->
     <div class="container-fluid py-0 py-md-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <form id="filterForm">
                        <!-- دکمه فیلتر فقط در موبایل -->
                        <div class="d-md-none mb-3">
                            <button type="button" class="btn btn-outline-dark" id="toggleFiltersBtn">
                                فیلترها
                            </button>
                        </div>

                        <!-- باکس فیلترها: قابل مشاهده در دسکتاپ و قابل باز شدن در موبایل -->
                        <div id="filterCollapse" class="collapse d-md-flex flex-wrap align-items-center">
    <!-- مرتب‌سازی -->
    <div class="dropdown me-2 mb-2">
        <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
            مرتب‌سازی
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" data-name="sort" data-value="newest">جدیدترین</a></li>
            <li><a class="dropdown-item" href="#" data-name="sort" data-value="discounted">پرتخفیف ترین</a></li>
            <li><a class="dropdown-item" href="#" data-name="sort" data-value="price_asc">ارزان‌ترین</a></li>
            <li><a class="dropdown-item" href="#" data-name="sort" data-value="price_desc">گران‌ترین</a></li>
        </ul>
        <input type="hidden" name="sort" value="newest">
    </div>

    <!-- دسته‌بندی -->
    <div class="dropdown me-2 mb-2">
        <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
            دسته‌بندی
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" data-name="category" data-value="">همه دسته‌بندی‌ها</a></li>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a class="dropdown-item" href="#" data-name="category" data-value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <input type="hidden" name="category">
    </div>

    <!-- سایز -->
    <div class="dropdown me-2 mb-2">
        <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
            سایز
        </button>
        <ul class="dropdown-menu p-3" style="min-width: 250px; max-height: 200px; overflow-y: auto;">
            <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <input type="checkbox" name="size[]" value="<?php echo e($size->id); ?>">
                    <label for="size-<?php echo e($size->id); ?>"><?php echo e($size->name); ?></label>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>

    <!-- رنگ -->
    <div class="dropdown me-2 mb-2">
        <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
            رنگ
        </button>
        <ul class="dropdown-menu p-3" style="min-width: 250px; max-height: 200px; overflow-y: auto;">
            <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <input type="checkbox" name="color[]" value="<?php echo e($color->id); ?>">
                    <label for="color-<?php echo e($color->id); ?>">
                        <div class="showColor" style="background-color: <?php echo e($color->code); ?>"></div>
                        <?php echo e($color->name); ?>

                    </label>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>

    <!-- قیمت -->
    <div class="dropdown me-2 mb-2" style="position: relative;">
        <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
            قیمت
        </button>
        <div class="dropdown-menu p-3" style="min-width: 250px;">
            <div class="mb-2">
                <label for="minPrice" class="form-label">حداقل قیمت:</label>
                <input type="number" class="form-control" name="price_min" id="price_min" placeholder="مثلاً 100000">
            </div>
            <div class="mb-2">
                <label for="maxPrice" class="form-label">حداکثر قیمت:</label>
                <input type="number" class="form-control" name="price_max" id="price_max" placeholder="مثلاً 500000">
            </div>
        </div>
    </div>

    <!-- فقط موجودها -->
    <div class="me-2 mb-2">
        <input type="checkbox" id="in_stock" name="in_stock" value="1">
        <label for="in_stock">فقط موجودها</label>
    </div>
    
    <div class="me-2 mb-2">
        <input type="text" name="search" id="search" value="<?php echo e(request('search')); ?>" class="form-control" placeholder="جستجو..." />
    </div>
</div>


</form>


                    <div id="loading" style="display: none; text-align: center; margin: 20px 0;">
                        <div class="spinner-border text-success" role="status" style="width: 4rem; height: 4rem;">
                            <span class="sr-only">در حال بارگذاری...</span>
                        </div>
                    </div>
                    <div class="row" id="product-container">
                        <?php echo $__env->make('Home.partials.products', ['products' => $products], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
     </div>


<?php $__env->startSection('js'); ?>

<script>
$(document).ready(function () {
    // برای تغییر dropdown (دسته‌بندی، سایز، رنگ و ...)
    $('.dropdown-item').click(function(e) {
        let href = $(this).attr('href');
    if (!href || href === '#') {
        e.preventDefault();
        let name = $(this).data('name');
        let value = $(this).data('value');

        $('input[name="' + name + '"]').val(value);
        triggerFilter();
    }
    });

    // تغییر فیلترها و ارسال درخواست AJAX
    $('#filterForm select, #filterForm input').on('change', function() {
        triggerFilter();
    });

    // ارسال فیلترها با AJAX
    function triggerFilter() {
        let formData = $('#filterForm').serialize();

        $.ajax({
            url: "<?php echo e(route('Home.shop')); ?>",
            type: "GET",
            data: formData,
            beforeSend: function() {
                $('#product-container').hide();
                $('#loading').show();
            },
            success: function (data) {
                $('#loading').hide();
                $('#product-container').show();
                $('#product-container').html(data);

                // بروزرسانی URL
                let newUrl = "<?php echo e(route('Home.shop')); ?>" + '?' + formData;
                window.history.pushState({path: newUrl}, '', newUrl);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
});
    </script>
    
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.favorite-btn', function (e) {
            e.preventDefault();
            let button = $(this);
            let productId = button.data('product-id');
            let icon = button.find('i');

            $.post("<?php echo e(route('Home.favorite.toggle')); ?>", {
                product_id: productId
            })
            .done(function (response) {
                button.toggleClass('active');
                if (button.hasClass('active')) {
                    icon.removeClass('fa-regular').addClass('fa-solid');
                } else {
                    icon.removeClass('fa-solid').addClass('fa-regular');
                }
            })
            .fail(function (xhr) {
    if (xhr.status === 401) {
        Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "ابتدا وارد حساب کاربری خود شوید.",
                    showConfirmButton: false,
                    timer: 1000
                });
    } else {
        alert("خطایی رخ داد.");
    }
});

        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('toggleFiltersBtn');
        const filtersSection = document.getElementById('filterCollapse');

        // وقتی روی دکمه فیلتر کلیک می‌شود، وضعیت نمایش فیلترها تغییر می‌کند
        toggleBtn.addEventListener('click', function () {
            const collapseInstance = new bootstrap.Collapse(filtersSection, {
                toggle: true
            });
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('Home.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zayShop\resources\views/Home/shop.blade.php ENDPATH**/ ?>