<div class="header-style-01">
    <?php if(get_static_option('home_page_topbar_section_status')): ?><!--topbar-area -->
        <?php echo $__env->make('frontend.partials.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php if(get_static_option('home_page_infobar_section_status')): ?> <!--infobar-area -->
        <?php echo $__env->make('frontend.partials.infobar.infobar-variant-home-'.$home_variant_number, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php if(get_static_option('home_page_navbar_section_status')): ?> <!--navbar-area -->
        <?php echo $__env->make('frontend.partials.navbar.navbar-variant-home-'.$home_variant_number, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
</div>
<?php if(get_static_option('home_page_header_slider_section_status')): ?>
    <div class="header-slider-one">
        <?php $__currentLoopData = $heaer_sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="header-area style-01 header-bg-02" <?php echo render_background_image_markup_by_attachment_id($data->image); ?>>
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="header-inner-02">
                            <!-- header inner -->
                            <div class="content">
                                <div class="icon">
                                    <i class="<?php echo e($data->icon); ?>"></i>
                                </div>
                                <span class="subtitle"><?php echo e($data->subtitle_ext); ?></span>
                                <h1 class="title"><?php echo e($data->title_ext); ?></h1>
                                <p><?php echo e($data->details); ?></p>
                            </div>
                        </div>
                        <!-- //.header inner -->
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
<?php if(get_static_option('home_page_keyfeature_section_status')): ?>
    <?php echo $__env->make('frontend.partials.keyfeature.keyfeature-variant-01', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php if(get_static_option('home_page_why_choose_us_section_status')): ?>
    <?php echo $__env->make('frontend.partials.why-choose-us-variant.why-choose-us-variant-'.get_static_option('why_choose_us_home_'.$home_variant_number.'_variant'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php if(get_static_option('home_page_full_width_service_section_status')): ?>
    <?php echo $__env->make('frontend.partials.full-width-service.full-width-service-variant-02', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php if(get_static_option('home_page_testimonial_section_status')): ?>
    <?php echo $__env->make('frontend.partials.testimonial.testimonial-variant-02', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php if(get_static_option('home_page_latest_team_member_section_status')): ?>
    <?php echo $__env->make('frontend.partials.team-member-area', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php if(get_static_option('home_page_price_plan_section_status')): ?>
    <?php echo $__env->make('frontend.partials.price-plan-area', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php if(get_static_option('home_page_latest_blog_section_status')): ?>
    <?php echo $__env->make('frontend.partials.blog-latest-area', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php if(get_static_option('home_page_call_to_action_section_status')): ?>
    <?php echo $__env->make('frontend.partials.call-to-action-area', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/home-pages/home-02.blade.php ENDPATH**/ ?>