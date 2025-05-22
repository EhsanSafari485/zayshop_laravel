<?php $__env->startSection('content'); ?>


<div id="content" class="main-content">


    <div class="container-fluid px-4">

        <div class="row mt-5">
        <div id="flFormsGrid" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>ساخت بلاگ جدید</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
<?php if($errors->any()): ?>
    <div>
        <ul style="color: red">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?php echo e(route('Panel.blogs.store')); ?>" method="POST" enctype="multipart/form-data" class="w-100">
    <?php echo csrf_field(); ?>

    <div class="row">
        <div class="form-group col-md-6">
            <label>عنوان:</label>
            <input type="text" class="form-control" name="title" value="<?php echo e(old('title')); ?>" required>
        </div>

        <div class="form-group col-md-6">
            <label>دسته‌بندی:</label>
            <select class="form-control" name="category_id" required>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label>عکس کاور:</label>
        <input class="form-control" type="file" name="cover_image">
    </div>

    <div class="form-group">
        <label>متن:</label>
        <textarea name="content" id="editor" rows="10" required><?php echo e(old('content')); ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary mt-3">ارسال</button>
</form>

            </div>
        </div>
    </div>
</div>
</div>

</div>
<style>

.ck-editor__editable_inline {
    background-color: #1b2e4b !important;
    font-size: 16px !important;
    font-family: Tahoma, sans-serif !important;
}
</style>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('jssrc'); ?>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
            uploadUrl: "<?php echo e(route('Panel.blogs.upload')); ?>?_token=<?php echo e(csrf_token()); ?>"
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Panel.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zayShop\resources\views/Panel/blogs/create.blade.php ENDPATH**/ ?>