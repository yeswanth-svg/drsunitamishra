<?php echo $__env->make('frontend.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="header-style-01">
    <?php if(get_static_option('home_page_topbar_section_status')): ?><!--topbar-area -->
        <?php echo $__env->make('frontend.partials.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php if($home_variant_number != '03'): ?>
        <?php if(get_static_option('home_page_infobar_section_status')): ?> <!--infobar-area -->
            <?php echo $__env->make('frontend.partials.infobar.infobar-variant-home-'.$home_variant_number, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>
    <?php if(get_static_option('home_page_navbar_section_status')): ?> <!--navbar-area -->
        <?php echo $__env->make('frontend.partials.navbar.navbar-variant-home-'.$home_variant_number, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
</div>
    <!-- Breadcrumb Area -->
    <div class="breadcrumb-area" <?php echo render_background_image_markup_by_attachment_id(get_static_option('site_breadcrumb_img')); ?>>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <p><?php echo $__env->yieldContent('page-title'); ?></p>
                        <h2 class="page-title"><?php echo $__env->yieldContent('page-title'); ?></h2>
                        <ul class="page-list">
                            <li><a href="<?php echo e(url('/')); ?>"><?php echo e(__("Home")); ?></a></li>
                            <?php
                            $pages_list = ['blog','service','product','appointment','contact','about'];
                            ?>
                            <?php $__currentLoopData = $pages_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(request()->is(get_static_option($page.'_page_slug').'/*')): ?>
                                <li><a href="<?php echo e(url('/').'/'.get_static_option($page.'_page_slug')); ?>"><?php echo e(get_static_option($page.'_page_' . $user_select_lang_slug . '_name')); ?></a></li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo $__env->yieldContent('page-title'); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php echo $__env->yieldContent('content'); ?>
<?php echo $__env->make('frontend.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/frontend-page-master.blade.php ENDPATH**/ ?>