<section class="cleaning-company-area bg-liteblue padding-top-110 padding-bottom-85">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-55">
                    <div class="icon">
                        <span class="line-one"></span>
                        <span class="line-two"></span>
                        <i class="flaticon-paint-brush"></i>
                        <span class="line-three"></span>
                        <span class="line-four"></span>
                    </div>
                    <h3 class="title"><?php echo e(get_static_option('home_page_why_choose_us_section_'.$user_select_lang_slug.'_title')); ?></h3>
                    <p><?php echo e(get_static_option('home_page_why_choose_us_section_'.$user_select_lang_slug.'_description')); ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $all_why_choose_us; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="cleaning-single-item margin-bottom-30">
                    <div class="thumb">
                        <?php echo render_image_markup_by_attachment_id($data->image); ?>

                    </div>
                    <div class="icon">
                        <i class="<?php echo e($data->icon); ?>"></i>
                    </div>
                    <div class="content">
                        <h4 class="title"><a href="<?php echo e(route('frontend.services.single',[$data->lang_front->slug ?? 'x',$data->id])); ?>"><?php echo e(optional($data->lang_front)->title); ?></a></h4>
                        <p><?php echo e(optional($data->lang_front)->excerpt); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/why-choose-us-variant/why-choose-us-variant-02.blade.php ENDPATH**/ ?>