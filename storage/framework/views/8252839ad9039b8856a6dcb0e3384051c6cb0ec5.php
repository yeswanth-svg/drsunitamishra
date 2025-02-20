<div class="eco-friendly-area margin-top-120 margin-bottom-120">
    <div class="container">
        <div class="eco-friendly-area-wrapper padding-top-60 padding-bottom-60">
            <div class="bg-img-02 about" <?php echo render_background_image_markup_by_attachment_id(get_static_option('about_page_full_width_service_section_bg_img_right')); ?>></div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="eco-content bg-white style-01">
                        <div class="section-title">
                            <div class="icon">
                                <i class="<?php echo e(get_static_option('site_heading_icon')); ?>"></i>
                                <span class="line-three"></span>
                                <span class="line-four"></span>
                            </div>
                            <h3 class="title"><?php echo e(get_static_option('about_page_full_width_service_section_'.$user_select_lang_slug.'_title')); ?></h3>
                            <p><?php echo e(get_static_option('about_page_full_width_service_section_'.$user_select_lang_slug.'_description')); ?></p>
                        </div>
                        <div class="content style-01">
                            <ul>
                                <?php $__currentLoopData = explode("\n",get_static_option('about_page_full_width_service_section_'.$user_select_lang_slug.'_features')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><i class="fas fa-check"></i> <?php echo e($item); ?></li> 
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="available-item style-01">
                                <div class="icon">
                                    <i class="<?php echo e(get_static_option('about_page_full_width_service_section_support_icon')); ?>"></i>
                                </div>
                                <div class="content">
                                    <span><?php echo e(get_static_option('about_page_full_width_service_section_'.$user_select_lang_slug.'_support_title')); ?></span>
                                    <p><?php echo e(get_static_option('about_page_full_width_service_section_'.$user_select_lang_slug.'_support_details')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/full-width-service/full-width-service-variant-04.blade.php ENDPATH**/ ?>