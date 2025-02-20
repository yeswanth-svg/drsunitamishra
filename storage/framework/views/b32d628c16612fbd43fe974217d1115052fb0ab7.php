<div class="counterup-area <?php if($home_variant_number == '03'): ?> bg-image bg-blue-03" <?php echo render_background_image_markup_by_attachment_id(get_static_option('counterup_bg_img')); ?>> <?php elseif($home_variant_number == '04'): ?> bg-liteblue "> <?php else: ?> "> <?php endif; ?>
    <div class="container">
        <div class="counterup-wrapper <?php if($home_variant_number == '01'): ?>m-top bg-liteblue <?php endif; ?>">
            <div class="row">
                <?php $__currentLoopData = $all_counterups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-counterup-01 <?php if($home_variant_number == '03'): ?> style-01 <?php endif; ?>">
                            <div class="icon">
                                <i class="<?php echo e($data->icon); ?>"></i>
                            </div>
                            <div class="content">
                                <div class="count-wrap"><span class="count-num"><?php echo e($data->number); ?></span><?php echo e($data->extra_text); ?></div>
                                <h4 class="title"><?php echo e($data->title); ?></h4>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/counterup-area.blade.php ENDPATH**/ ?>