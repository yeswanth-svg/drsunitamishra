<div class="info-bar">
    <div class="info-bar-bottom bg-white style-02">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="info-bar-inner">
                        <div class="left-content-area">
                            <div class="logo-wrapper">
                                <a href="<?php echo e(route('homepage')); ?>" class="logo">
                                    <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>

                                </a>
                            </div>
                        </div>
                        <div class="right-content-area style-01">
                            <div class="info-bottom-right">
                                <ul class="info-items-03">
                                    <?php $__currentLoopData = $all_right_section_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($user_select_lang_slug == $item->lang): ?>
                                        <li class="info-bar-item">
                                            <div class="icon">
                                                <i class="<?php echo e($item->icon); ?>"></i>
                                            </div>
                                            <div class="content">
                                                <span class="title"><?php echo e($item->title); ?>

                                            </span>
                                                <p class="details"><?php echo e($item->details); ?></p>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/infobar/infobar-variant-home-04.blade.php ENDPATH**/ ?>