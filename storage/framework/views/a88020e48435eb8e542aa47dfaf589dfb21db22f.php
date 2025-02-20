<div class="header-bottom-area padding-bottom-120 padding-top-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading-top-content margin-bottom-35">
                    <div class="section-title">
                        <h2 class="title"><?php echo e(get_static_option('home_page_keyfeatures_section_'.$user_select_lang_slug.'_title')); ?></h2>
                        <p><?php echo e(get_static_option('home_page_keyfeatures_section_'.$user_select_lang_slug.'_description')); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="provide-single-list">
                    <?php $__currentLoopData = $all_key_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="provide-single-item style-0<?php echo e($key%2); ?>">
                        <div class="icon">
                            <i class="flaticon-vacuum"></i>
                        </div>
                        <div class="content">
                            <h4 class="title"><?php echo e($data->subtitle); ?></h4>
                            <p><?php echo e($data->title); ?></p>
                            <ul>
                                <?php $__currentLoopData = explode("\n",$data->features); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(($key) < get_static_option('home_page_'.$home_variant_number.'_key_feature_number')): ?>
                                <li><i class="fas fa-check"></i> <?php echo e($item); ?></li> 
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/keyfeature/keyfeature-variant-03.blade.php ENDPATH**/ ?>