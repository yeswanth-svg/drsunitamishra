<section class="creative-team-area <?php if(in_array(\Route::current()->getName(),['homepage','homepage.demo'])): ?> padding-top-110 <?php endif; ?> padding-bottom-85 <?php if($home_variant_number == '02'): ?> bg-image bg-liteblue <?php endif; ?>" <?php if($home_variant_number == '02'): ?> <?php echo render_background_image_markup_by_attachment_id(get_static_option('home_page_team_section_bg')); ?> <?php endif; ?>>
    <div class="container">
        <div class="row justify-content-center padding-bottom-45">
            <div class="col-lg-8">
                <div class="section-title desktop-center">
                    <div class="icon">
                        <span class="line-one"></span>
                        <span class="line-two"></span>
                        <i class="<?php echo e(get_static_option('site_heading_icon')); ?>"></i>
                        <span class="line-three"></span>
                        <span class="line-four"></span>
                    </div>
                    <h2 class="title"><?php echo e(get_static_option('home_page_team_section_'.$user_select_lang_slug.'_title')); ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $all_team_members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3  col-sm-6">
                <div class="appointment-single-item">
                    <div class="thumb"
                            <?php echo render_background_image_markup_by_attachment_id($data->image,'','grid'); ?>

                    >
                        <div class="cat">
                            <a href="<?php echo e(route('frontend.appointment.category',['id' => $data->categories_id,'any' => Str::slug($data->category_front->name ?? __("Uncategorized"))])); ?>"><?php echo e(optional($data->category_front)->name ?? __("Uncategorized")); ?></a>
                        </div>
                    </div>
                    <div class="content">
                        <div class="top-part">
                            <?php if(!empty(optional($data->lang_front)->designation)): ?>
                                <span class="designation"><?php echo e(optional($data->lang_front)->designation); ?></span>
                            <?php endif; ?>
                            <?php if(count($data->reviews) > 0): ?>
                                <div class="rating-wrap">
                                    <div class="ratings">
                                        <span class="hide-rating"></span>
                                        <span class="show-rating" style="width: <?php echo e(get_appointment_ratings_avg_by_id($data->id) / 5 * 100); ?>%"></span>
                                    </div>
                                    <p><span class="total-ratings">(<?php echo e(count($data->reviews)); ?>)</span></p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo e(route('frontend.appointment.single',['slug' => optional($data->lang_front)->slug, 'id' => $data->id])); ?>"><h4 class="title"><?php echo e(optional($data->lang_front)->title); ?></h4></a>
                        <?php if(!empty(optional($data->lang_front)->location)): ?>
                            <span class="location"><i class="fas fa-map-marker-alt"></i><?php echo e(optional($data->lang_front)->location); ?></span>
                        <?php endif; ?>

                        <p><?php echo e(Str::words(strip_tags(optional($data->lang_front)->short_description),10)); ?></p>
                        <div class="btn-wrapper">
                            <a href="<?php echo e(route('frontend.appointment.single',['slug' => optional($data->lang_front)->slug ?? 'x', 'id' => $data->id])); ?>" class="boxed-btn"><?php echo e(get_static_option('appointment_page_'.$user_select_lang_slug.'_booking_button_text')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/team-member-area.blade.php ENDPATH**/ ?>