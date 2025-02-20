<div class="contact-area bg-image padding-top-110 padding-bottom-120" <?php echo render_background_image_markup_by_attachment_id(get_static_option('home_page_quote_bg_image')); ?>>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="contact-img bg-image">
                    <?php echo render_image_markup_by_attachment_id(get_static_option('home_page_quote_support_image')); ?>

                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="request-page-form-wrap">
                    <div class="section-title bg-image" <?php echo render_background_image_markup_by_attachment_id(get_static_option('home_page_quote_bg_texture')); ?>>
                        <h4 class="title"><?php echo e(get_static_option('home_page_quote_section_'.$user_select_lang_slug.'_title')); ?></h4>
                        <p><?php echo e(get_static_option('home_page_quote_section_'.$user_select_lang_slug.'_details')); ?></p>
                        
                    </div>
                    <?php echo $__env->make('frontend.partials.quote-form.quote-form-render', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/quote-area.blade.php ENDPATH**/ ?>