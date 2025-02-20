<div class="header-bottom-area bg-blue-03 bg-image padding-bottom-80" <?php echo render_background_image_markup_by_attachment_id(get_static_option('home_page_keyfeatures_section_'.$home_variant_number.'_bg_img')); ?>>
    <div class="container">
        <div class="header-bottom-wrapper m-top bg-white">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content-wrapper">
                        <div class="left-content bg-blue">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <?php $__currentLoopData = $all_key_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if($key == 0): ?> active <?php endif; ?> service-item-list show" id="<?php echo e(\Str::slug($data->subtitle)); ?>-tab" data-toggle="tab" href="#<?php echo e(\Str::slug($data->subtitle)); ?>" role="tab" aria-controls="<?php echo e(\Str::slug($data->subtitle)); ?>" aria-selected="true">
                                        <div class="service-icon style-01">
                                            <i class="<?php echo e($data->icon); ?>"></i>
                                        </div>
                                        <div class="service-title">
                                            <h4 class="title"><?php echo e($data->subtitle); ?></h4>
                                        </div>
                                    </a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <div class="right-content">
                            <div class="tab-content" id="myTabContent">
                                <?php $__currentLoopData = $all_key_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tab-pane fade <?php if($key == 0): ?> active show <?php endif; ?>" id="<?php echo e(\Str::slug($data->subtitle)); ?>" role="tabpanel" aria-labelledby="<?php echo e(\Str::slug($data->subtitle)); ?>-tab">
                                    <div class="description-tab-content">
                                        <div class="text-content-tab">
                                            <div class="section-title">
                                                <span class="subtitle"><?php echo e($data->subtitle); ?></span>
                                                <h3 class="title"><?php echo e($data->title); ?></h3>
                                                <p><?php echo $data->description; ?></p> 
                                            </div>
                                            <div class="content">
                                                <ul>
                                                    <div class="row">
                                                        <?php $__currentLoopData = explode("\n",$data->features); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="col-md-6">
                                                            <li><i class="fas fa-check"></i> <?php echo e($item); ?></li> 
                                                        </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="serivce-bg" <?php echo render_background_image_markup_by_attachment_id($data->image); ?>></div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/keyfeature/keyfeature-variant-04.blade.php ENDPATH**/ ?>