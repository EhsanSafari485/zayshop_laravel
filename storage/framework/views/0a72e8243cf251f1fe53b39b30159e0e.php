<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'id',
    'title',
    'activePattern' => '',
    'items' => [],
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'id',
    'title',
    'activePattern' => '',
    'items' => [],
]); ?>
<?php foreach (array_filter(([
    'id',
    'title',
    'activePattern' => '',
    'items' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $isActive = request()->is($activePattern);
?>

<li class="menu">
    <a href="#<?php echo e($id); ?>" data-toggle="collapse"
       aria-expanded="<?php echo e($isActive ? 'true' : 'false'); ?>"
       class="dropdown-toggle">
        <div>
            <?php echo e($icon ?? ''); ?>

            <span><?php echo e($title); ?></span>
        </div>
        <div>
            <svg class="feather feather-chevron-right <?php echo e($isActive ? 'rotate-icon' : ''); ?>"
                 width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round"
                 stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
        </div>
    </a>
    <ul class="collapse submenu list-unstyled <?php echo e($isActive ? 'show' : ''); ?>" id="<?php echo e($id); ?>" data-parent="#accordionExample">
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="<?php echo e(request()->routeIs($item['route']) ? 'active' : ''); ?>">
                <a href="<?php echo e(route($item['route'])); ?>"><?php echo e($item['label']); ?></a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</li>
<?php /**PATH C:\xampp\htdocs\zayShop\resources\views/components/sidebar/menu-item.blade.php ENDPATH**/ ?>