<?php if($products->count() > 0): ?>
<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<div class="col-6 col-md-4">
    <div class="card mb-4 product-wap rounded-0">
        
        <button title="افزودن به علاقه‌مندی‌ها" class="btn favorite-btn text-white btn-heart shadow-none" data-product-id="<?php echo e($product->id); ?>">
            <?php if($favorites->contains('product_id', $product->id)): ?>
                <i class="fa-solid fa-heart"></i>
            <?php else: ?>
                <i class="fa-regular fa-heart"></i>
            <?php endif; ?>
        </button>

        
        <a href="<?php echo e(route('Home.shop_single', ['slug'=>$product->slug])); ?>"  rel="noopener noreferrer">
            <div class="card rounded-0">
                <div class="product-image-wrapper">
                    <?php if($product->discount > 0): ?>
                        <div class="discount-badge">
                            %<?php echo e(intval($product->discount)); ?>

                        </div>
                    <?php endif; ?>
                    <?php
                        $image=$product->images->first();
                    ?>
                            <img class="card-img rounded-0 img-fluid" src="<?php echo e($image ? asset('images/product/'.$image->image) : asset('images/product/default.jpg')); ?>">
                </div>
            </div>
        </a>

        <div class="card-body">
            <a href="<?php echo e(route('Home.shop_single', ['slug'=>$product->slug])); ?>"  class="h3 text-decoration-none"><?php echo e($product->name); ?></a>

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

            
            <?php if($prices == 0): ?>
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
<?php else: ?>
    <div class="alert alert-warning text-center w-100">
        محصولی یافت نشد
    </div>
<?php endif; ?>
<div class="row">
    <div class="col d-flex">
        <ul class="pagination pagination-lg justify-content-end">
            <?php echo e($products->appends(request()->query())->links()); ?>

        </ul>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\zayShop\resources\views/Home/partials/products.blade.php ENDPATH**/ ?>