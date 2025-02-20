<section class="why-choose-use-area bg-image bg-blue padding-top-110 padding-bottom-90" <?php echo render_background_image_markup_by_attachment_id(get_static_option('home_page_04_why_choose_us_bg')); ?>>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-sm-12 col-12">
                <div class="section-title desktop-center white margin-bottom-55">
                    <div class="icon">
                        <span class="line-one"></span>
                        <span class="line-two"></span>
                        <i class="flaticon-paint-brush"></i>
                        <span class="line-three"></span>
                        <span class="line-four"></span>
                    </div>
                    <h2 class="title"><?php echo e(get_static_option('home_page_why_choose_us_section_'.$user_select_lang_slug.'_title')); ?></h2>
                    <p><?php echo e(get_static_option('home_page_why_choose_us_section_'.$user_select_lang_slug.'_description')); ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $all_why_choose_us; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="choose-single-item margin-bottom-30 bg-image">
                    <div class="icon bg-image" style="background-image: url(assets/frontend/important/choose/01.png);">
                        <i class="<?php echo e($data->icon); ?>"></i>
                    </div>
                    <div class="content">
                        <h4 class="title"><a href="<?php echo e(route('frontend.services.single',[optional($data->lang_front)->slug ?? 'x',$data->id])); ?>"><?php echo e(optional($data->lang_front)->title); ?></a></h4>
                        <span class="subtitle"><?php echo e(optional($data->category_front)->name); ?></span>
                        <p><?php echo e(optional($data->lang_front)->excerpt); ?></p> 
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/why-choose-us-variant/why-choose-us-variant-04.blade.php ENDPATH**/ ?>