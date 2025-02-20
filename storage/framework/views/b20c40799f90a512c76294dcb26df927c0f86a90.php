<div class="eco-friendly-area bg-blue bg-image" <?php echo render_background_image_markup_by_attachment_id(get_static_option('home_page_full_width_service_section_'.$home_variant_number.'_bg_img')); ?>>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="eco-content padding-top-110 padding-bottom-110">
                    <div class="section-title white">
                        <div class="icon">
                            <i class="<?php echo e(get_static_option('site_heading_icon')); ?>"></i>
                            <span class="line-three"></span>
                            <span class="line-four"></span>
                        </div>
                        <h3 class="title"><?php echo e(get_static_option('home_page_full_width_service_section_'.$user_select_lang_slug.'_title')); ?></h3>
                        <p><?php echo e(get_static_option('home_page_full_width_service_section_'.$user_select_lang_slug.'_description')); ?></p>
                    </div>
                    <div class="content">
                        <ul>
                            <?php $__currentLoopData = explode("\n",get_static_option('home_page_full_width_service_section_'.$user_select_lang_slug.'_features')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><i class="fas fa-check"></i> <?php echo e($item); ?></li> 
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="eco-friendly-img bg-image" <?php echo render_background_image_markup_by_attachment_id(get_static_option('home_page_full_width_service_section_'.$home_variant_number.'_bg_img_right')); ?>>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/full-width-service/full-width-service-variant-02.blade.php ENDPATH**/ ?>