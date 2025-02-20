<div class="eco-friendly-area padding-top-180 padding-bottom-227">
    <div class="bg-img-01 bg-blue" <?php echo render_background_image_markup_by_attachment_id(get_static_option('home_page_full_width_service_section_'.$home_variant_number.'_bg_img')); ?>></div>
    <div class="bg-img-02 home" <?php echo render_background_image_markup_by_attachment_id(get_static_option('home_page_full_width_service_section_'.$home_variant_number.'_bg_img_right')); ?>></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="eco-content">
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
            <div class="col-lg-4">
                <div class="we-available">
                    <p><?php echo e(get_static_option('home_page_full_width_service_section_'.$user_select_lang_slug.'_support_description')); ?></p>
                    <div class="available-item">
                        <div class="icon">
                            <i class="<?php echo e(get_static_option('home_page_full_width_service_section_support_icon')); ?>"></i>
                        </div>
                        <div class="content">
                            <span><?php echo e(get_static_option('home_page_full_width_service_section_'.$user_select_lang_slug.'_support_title')); ?></span>
                            <p><?php echo e(get_static_option('home_page_full_width_service_section_'.$user_select_lang_slug.'_support_details')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/full-width-service/full-width-service-variant-01.blade.php ENDPATH**/ ?>