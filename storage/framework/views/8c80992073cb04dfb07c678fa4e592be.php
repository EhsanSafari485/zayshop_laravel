<?php $__env->startSection('content'); ?>
<div id="content" class="main-content">


    <div class="container">

        <div class="row">
        <div id="flFormsGrid" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>ثپت محصول</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="<?php echo e(route('Panel.product.update',$product->id)); ?>" id="productForm" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-row mb-4">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">نام</label>
                            <input type="name" class="form-control" value="<?php echo e($product->name); ?>" name="name" id="inputEmail4" placeholder="نام  محصول">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail3">قیمت</label>
                            <input type="number" class="form-control" value="<?php echo e($product->price); ?>" name="price" id="inputEmail3" placeholder="قیمت را وارد کنید">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmai20">میزان تخفیف</label>
                            <input type="number" min="0" max="100" step="0.1" class="form-control" value="<?php echo e($product->discount); ?>" name="discount" id="inputEmai20" placeholder="مقدار تخفیف را وارد کنید">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail3">برند</label>
                            <input type="name" class="form-control" value="<?php echo e($product->brand); ?>" name="brand" id="inputEmail3" placeholder="برند محصول">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">slug</label>
                            <input type="slug" class="form-control" value="<?php echo e($product->slug); ?>" name="slug" id="inputEmail4" placeholder="مثال:lebas-mardane">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">دسته بندی</label>
                            <select id="inputState" name="category_id" class="form-control">
                                <?php $__currentLoopData = $Categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($category->id==$product->category_id): ?>
                                <option value="<?php echo e($category->id); ?>" selected><?php echo e($category->name); ?></option>
                                <?php else: ?>
                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">توضیحات</label>
                            <textarea class="form-control" name="description"><?php echo e($product->description); ?></textarea>
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

<?php $__env->startSection('jssrc'); ?>
<script type="text/javascript" src="<?php echo e(asset('vendor/jsvalidation/js/jsvalidation.js')); ?>"></script>
<?php echo JsValidator::formRequest('App\Http\Requests\product\productEditRequest', '#productForm'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Panel.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zayShop\resources\views/Panel/product/edit.blade.php ENDPATH**/ ?>