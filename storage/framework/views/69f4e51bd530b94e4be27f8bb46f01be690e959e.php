<div class="header-bottom-area padding-bottom-90">
    <div class="container">
        <div class="header-bottom-wrapper m-top-03">
            <div class="row">
                <?php $__currentLoopData = $all_key_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="provide-single-item style-03 margin-bottom-30">
                        <div class="icon style-0<?php echo e($key++); ?>">
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4">
                    <div class="request-page-form-wrap style-01">
                        <div class="section-title">
                            <h4 class="title"><?php echo e(get_static_option('home_page_keyfeatures_section_'.$user_select_lang_slug.'_quote_title')); ?></h4>
                            <p><?php echo e(get_static_option('home_page_keyfeatures_section_'.$user_select_lang_slug.'_quote_subtitle')); ?></p>
                        </div>
                        <?php echo $__env->make('frontend.partials.quote-form.quote-form-render', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/keyfeature/keyfeature-variant-02.blade.php ENDPATH**/ ?>