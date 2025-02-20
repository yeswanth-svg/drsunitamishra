<div class="info-bar">
    <div class="info-bar-bottom bg-white style-02">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="info-bar-inner">
                        <div class="left-content-area">
                            <div class="social-link style-01">
                                <ul>
                                    <?php $__currentLoopData = $all_social_icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e($item->url); ?>" target="_blank"><i class="<?php echo e($item->icon); ?>"></i></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                        <div class="right-content-area">
                            <div class="info-bottom-right">
                                <ul class="info-items-02 style-01">
                                    <li> 
                                        <h4 class="title"><?php echo e(get_static_option('home_page_infobar_section_'.$user_select_lang_slug.'_title')); ?></h4>
                                        <a href="<?php echo e(get_static_option('home_page_infobar_section_'.$user_select_lang_slug.'_url')); ?>"> <span class="number"><?php echo e(get_static_option('home_page_infobar_section_'.$user_select_lang_slug.'_details')); ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/infobar/infobar-variant-home-02.blade.php ENDPATH**/ ?>