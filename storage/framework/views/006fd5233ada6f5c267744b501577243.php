    
    <?php $__env->startSection('content'); ?>
    <?php if(session('welcome')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: '<?php echo e(session("welcome")); ?>',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
    <?php endif; ?>

    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            $i=0;
        ?>
        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($slider->role==0): ?>
        <?php if($i==0): ?>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="<?php echo e($i); ?>" class="active"></li>
        <?php
                $i++;
            ?>
            <?php else: ?>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="<?php echo e($i); ?>"></li>
        <?php endif; ?>
        <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
        <div class="carousel-inner">
            <?php
                $i=0;
            ?>
            <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($slider->role==0): ?>

            <?php if($i==0): ?>
            <div class="carousel-item active">
                <?php
                    $i++;
                ?>
                <?php else: ?>
            <div class="carousel-item">
            <?php endif; ?>
            <a href="<?php echo e($slider->url); ?>" target="_blank">
                <div class="slider-image-wrapper">
                    <img class="slider-image" src="<?php echo e(asset('images/sliders/'.$slider->image)); ?>" alt="">
                </div>
            </a>
            </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
        </div>
        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a>
        </div>
    <!-- End Banner Hero -->


    <!-- Start Categories of The Month -->
        <div class="swiper categorySwiper">
            <div class="swiper-wrapper">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide text-center">
                <a class="a" href="<?php echo e(route('Home.shop', ['category'=>$category->id])); ?>">
                    <img src="<?php echo e(asset('images/Category/'.$category->image)); ?>" class="rounded-circle img-fluid border" style="width: 120px;">
                    <h5 class="mt-3 mb-3 title-category"><?php echo e($category->name); ?></h5>
                    
                </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

    <!-- End Categories of The Month -->
     <!-- baner 2 -->
<div class="img-slide0">
<a href="<?php echo e($slider1[0]->url??null); ?>" target="_blank" rel="noopener noreferrer">
<div>
        <img class="img-slide1" src="<?php echo e(asset('images/sliders/'.($slider1[0]->image??null))); ?>" alt="">
</div>
</a>
<div>
    <a href="<?php echo e($slider2[0]->url??null); ?>" target="_blank" rel="noopener noreferrer">
        <div>
            <img class="img-slide2 slide1" src="<?php echo e(asset('images/sliders/'.($slider2[0]->image??null))); ?>" alt="">
        </div>
    </a>
<a href="<?php echo e($slider2[1]->url??null); ?>" target="_blank" rel="noopener noreferrer">
    <div>
        <img class="img-slide2 slide2" src="<?php echo e(asset('images/sliders/'.($slider2[1]->image??null))); ?>" alt="">
    </div>
</a>
</div>
</div>
</div>

     <!-- end baner 2 -->

    <!-- Start Featured Product -->
<div>
    <div>
            

            <div class="title-product">
                    <p class="p-product">جدید ترین محصولات</p>
                    <a class="a-product" href="<?php echo e(route('Home.shop', ['sort' => 'newest'])); ?>" rel="noopener noreferrer">مشاهده همه</a>
            </div>
            <div class="product-bg">
                <div class="product">
            <div class="swiper ProductSwiper">
                <div class="swiper-wrapper">
                    <?php $__currentLoopData = $productsNew; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="swiper-slide margin-swiper text-center">
                        <div class="card product-card h-100 border-0 shadow">
                                                    
                        <button title="افزودن به علاقه‌مندی‌ها" class="btn favorite-btn text-white btn-heart shadow-none" data-product-id="<?php echo e($product->id); ?>">
                            <?php if($favorites->contains('product_id', $product->id)): ?>
                                <i class="fa-solid fa-heart"></i>
                            <?php else: ?>
                                <i class="fa-regular fa-heart"></i>
                            <?php endif; ?>
                        </button>
                        <a href="<?php echo e(route('Home.shop_single', ['slug'=>$product->slug])); ?>">
                        <?php if($product->discount > 0): ?>
                        <div class="discount-badge">
                            %<?php echo e(intval($product->discount)); ?>

                        </div>
                    <?php endif; ?>
                    <?php
                        $image=$product->images->first();
                    ?>
                            <div class="product-image-wrapper">
                            <img src="<?php echo e($image ? asset('images/product/'.$image->image) : asset('images/product/default.jpg')); ?>" class="card-img-top product-image" alt="">
                            </div>
                            </a>
                            <div class="card-body product-body">
                            <a href="<?php echo e(route('Home.shop_single', ['slug'=>$product->slug])); ?>">
                                <h5 class="card-title text-product product-title"><?php echo e($product->name); ?></h5>
                            </a>
                            <?php
                            $prices = 0;
                            $discountedPrice = $product->price;
                            if($product->discount > 0) {
                                $discountedPrice = $product->price * (1 - $product->discount / 100);
                            }
                        ?>

                        <?php $__currentLoopData = $product->variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($product->id == $variant->product_id): ?>
                                <?php
                                    $prices += $variant->stock;
                                ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($prices==0): ?>
                            <p class="text-start mb-0 fw-bold" style="font-size: 18px;color: red">ناموجود</p>
                            <?php else: ?>
                                
                                <p class="text-start mb-0 fw-bold" style="font-size: 18px;">
                                    <?php if($product->discount > 0): ?>
                                        <span style="text-decoration: line-through; color: grey;"> <?php echo e(number_format($product->price, 0)); ?></span>
                                        <span class="text-success">
                                             <?php echo e(number_format($discountedPrice, 0)); ?>تومان
                                        </span>
                                    <?php else: ?>
                                        <span> <?php echo e(number_format($product->price, 0)); ?>تومان</span>
                                    <?php endif; ?>
                                </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

                </div>
            </div>
            
            <div class="title-product">
                <p class="p-product">پر تخفیف ترین محصولات</p>
                <a class="a-product" href="<?php echo e(route('Home.shop', ['sort' => 'discounted'])); ?>" rel="noopener noreferrer">مشاهده همه</a>
        </div>
        <div class="product-bg">
            <div class="product">
        <div class="swiper ProductSwiper">
            <div class="swiper-wrapper">
                <?php $__currentLoopData = $productsDiscount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide margin-swiper text-center">
                    <div class="card product-card h-100 border-0 shadow">
                                                
                    <button title="افزودن به علاقه‌مندی‌ها" class="btn favorite-btn text-white btn-heart shadow-none" data-product-id="<?php echo e($product->id); ?>">
                        <?php if($favorites->contains('product_id', $product->id)): ?>
                            <i class="fa-solid fa-heart"></i>
                        <?php else: ?>
                            <i class="fa-regular fa-heart"></i>
                        <?php endif; ?>
                    </button>
                    <a href="<?php echo e(route('Home.shop_single', ['slug'=>$product->slug])); ?>">
                    <?php if($product->discount > 0): ?>
                    <div class="discount-badge">
                        %<?php echo e(intval($product->discount)); ?>

                    </div>
                <?php endif; ?>
                    <?php
                        $image=$product->images->first();
                    ?>
                            <div class="product-image-wrapper">
                            <img src="<?php echo e($image ? asset('images/product/'.$image->image) : asset('images/product/default.jpg')); ?>" class="card-img-top product-image" alt="">
                            </div>
                        </a>
                        <div class="card-body product-body">
                        <a href="<?php echo e(route('Home.shop_single', ['slug'=>$product->slug])); ?>">
                            <h5 class="card-title text-product product-title"><?php echo e($product->name); ?></h5>
                        </a>
                        <?php
                        $prices = 0;
                        $discountedPrice = $product->price;
                        if($product->discount > 0) {
                            $discountedPrice = $product->price * (1 - $product->discount / 100);
                        }
                    ?>

                    <?php $__currentLoopData = $product->variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($product->id == $variant->product_id): ?>
                            <?php
                                $prices += $variant->stock;
                            ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($prices==0): ?>
                        <p class="text-start mb-0 fw-bold" style="font-size: 18px;color: red">ناموجود</p>
                        <?php else: ?>
                            
                            <p class="text-start mb-0 fw-bold" style="font-size: 18px;">
                                <?php if($product->discount > 0): ?>
                                    <span style="text-decoration: line-through; color: grey;"> <?php echo e(number_format($product->price, 0)); ?></span>
                                    <span class="text-success">
                                         <?php echo e(number_format($discountedPrice, 0)); ?>تومان
                                    </span>
                                <?php else: ?>
                                    <span> <?php echo e(number_format($product->price, 0)); ?>تومان</span>
                                <?php endif; ?>
                            </p>                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

            </div>
        </div>
        </div>
        </div>
    </div>
    

        </div>

    <!-- End Featured Product -->
    <?php $__env->startSection('js'); ?>
            
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
    <?php $__env->stopSection(); ?>
    <?php $__env->stopSection(); ?>


<?php echo $__env->make('Home.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zayShop\resources\views/Home/index.blade.php ENDPATH**/ ?>