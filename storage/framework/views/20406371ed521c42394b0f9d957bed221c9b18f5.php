<div class="header-bottom-area padding-bottom-90">
    <div class="container">
        <div class="header-bottom-wrapper m-top-02">
            <div class="row">
                <div class="col-lg-6">
                    <div class="provide-content">
                        <div class="section-title desktop-right">
                            <h2 class="title"><?php echo e(get_static_option('home_page_keyfeatures_section_'.$user_select_lang_slug.'_title')); ?></h2>
                            <div class="btn-wrapper">
                                <a href="<?php echo e(get_static_option('home_page_keyfeatures_section_'.$user_select_lang_slug.'_btn_url')); ?>" class="boxed-btn"><?php echo e(get_static_option('home_page_keyfeatures_section_'.$user_select_lang_slug.'_btn_text')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="row">
                        <?php $__currentLoopData = $all_key_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($key<2): ?>
                        <div class="col-lg-12 col-md-6">
                            <div class="provide-single-item style-0<?php echo e($key++); ?> margin-bottom-30">
                                <div class="icon">
                                    <i class="<?php echo e($data->icon); ?>"></i>
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
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php $__currentLoopData = $all_key_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($key == '2'): ?>
                <div class="col-lg-3 col-md-6">
                    <div class="provide-single-item style-02 margin-top-90 margin-bottom-30">
                        <div class="icon">
                            <i class="<?php echo e($data->icon); ?>"></i>
                        </div>
                        <div class="content">
                            <h4 class="title"><?php echo e($data->subtitle); ?></h4>
                            <p><?php echo e($data->title); ?></p>
                            <ul>
                                <?php $__currentLoopData = explode("\n",$data->features); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(($key) < get_static_option('home_page_'.$home_variant_number.'_key_feature_number')): ?>
                                    <li><i class="fas fa-check"></i> <?php echo e($item); ?></li> 
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/keyfeature/keyfeature-variant-01.blade.php ENDPATH**/ ?>