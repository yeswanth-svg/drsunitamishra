
<?php $__env->startSection('site-title'); ?>
    <?php echo e(get_static_option('about_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(get_static_option('about_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
<meta name="description" content="<?php echo e(get_static_option('about_page_'.$user_select_lang_slug.'_meta_description')); ?>">
<meta name="tags" content="<?php echo e(get_static_option('about_page_'.$user_select_lang_slug.'_meta_tags')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(get_static_option('about_page_full_width_service_section_status')): ?><!--full-width-service-area -->
        <?php echo $__env->make('frontend.partials.full-width-service.full-width-service-variant-04', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php if(get_static_option('about_page_progress_bar_section_status')): ?>
        <?php echo $__env->make('frontend.partials.progress-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php if(get_static_option('about_page_why_choose_us_section_status')): ?>
        <?php echo $__env->make('frontend.partials.why-choose-us-variant.why-choose-us-variant-05', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php if(get_static_option('about_page_team_member_section_status')): ?>
        <?php echo $__env->make('frontend.partials.team-member-area', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php if(get_static_option('about_page_counterup_section_status')): ?>
        <?php echo $__env->make('frontend.partials.counterup-about-area', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/pages/about-us.blade.php ENDPATH**/ ?>