<section class="why-choose-use-area padding-bottom-80">
    <div class="container">
        <div class="why-choose-use-area-wrapper m-top">
            <div class="row">
                <?php $__currentLoopData = $all_why_choose_us; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="choose-single-item margin-bottom-30 bg-image">
                        <div class="icon bg-image" style="background-image: url(assets/frontend/important/choose/01.png);">
                            <i class="<?php echo e($data->icon); ?>"></i>
                        </div>
                        <div class="content">
                            <a href="#">
                                <h4 class="title"><a href="<?php echo e(route('frontend.services.single',[optional($data->lang_front)->slug ?? 'x',$data->id])); ?>"><?php echo e(optional($data->lang_front)->title); ?></a></h4>
                                <span class="subtitle"><?php echo e(optional($data->category_front)->name); ?></span>
                            </a>
                            <p><?php echo e(optional($data->lang_front)->excerpt); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/why-choose-us-variant/why-choose-us-variant-05.blade.php ENDPATH**/ ?>