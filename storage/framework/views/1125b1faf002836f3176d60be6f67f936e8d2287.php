<div class="progress-bar-area bg-image padding-bottom-295 padding-top-120" <?php echo render_background_image_markup_by_attachment_id(get_static_option('about_page_progressbar_section_bg')); ?>>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-title margin-bottom-40">
                    <div class="icon">
                        <i class="<?php echo e(get_static_option('site_heading_icon')); ?>"></i>
                        <span class="line-three"></span>
                        <span class="line-four"></span>
                    </div>
                    <h3 class="title"><?php echo e(get_static_option('about_page_progressbar_section_'.$user_select_lang_slug.'_title')); ?></h3>
                </div>
            </div>
            <div class="col-lg-6">
                <input type="number" id="count" value="<?php echo e(count($all_progressbar)); ?>" hidden>
                <div class="progress-item-wrapper">
                    <?php $__currentLoopData = $all_progressbar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <input type="number" id="progress-val-<?php echo e($key); ?>" value="<?php echo e($data->progress); ?>" hidden>
                    <div class="progress-item">
                        <div class="single-progressbar">
                            <h4 class="subtitle"><?php echo e($data->title); ?></h4>
                            <div class="progress-<?php echo e($key); ?>"></div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->startSection('scripts'); ?>
<script>
        (function($) {
            'use strict';
            var count = $("#count").val()
            for (var i = 0; i < count; i++) {
                var val = $("#progress-val-"+i).val()
                $(".progress-"+i).rProgressbar({
                percentage: val,
                fillBackgroundColor: '#14b3e4'
                });
            }
           
    })(jQuery);
</script>
<?php $__env->stopSection(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/progress-bar.blade.php ENDPATH**/ ?>