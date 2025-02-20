<div class="call-to-action-area bg-blue-03 bg-image" <?php echo render_background_image_markup_by_attachment_id(get_static_option('home_page_call_to_action_section_bg')); ?>>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-6">
                <div class="call-to-action-inner">
                    <h2 class="title"><?php echo e(get_static_option('home_page_call_to_action_section_'.$user_select_lang_slug.'_title')); ?></h2>
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="call-to-action-item">
                    <div class="icon">
                        <i class="<?php echo e(get_static_option('home_page_call_to_action_section_icon')); ?>"></i>
                    </div>
                    <div class="content">
                        <a href="<?php echo e(get_static_option('home_page_call_to_action_section_'.$user_select_lang_slug.'_support_details')); ?>" class="subtitle"><?php echo e(get_static_option('home_page_call_to_action_section_'.$user_select_lang_slug.'_support_title')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/call-to-action-area.blade.php ENDPATH**/ ?>