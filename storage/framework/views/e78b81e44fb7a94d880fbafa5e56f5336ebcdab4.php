<div class="price-plan-area <?php echo e(($home_variant_number == '04')? 'bg-white':'bg-blue'); ?> padding-top-110 padding-bottom-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title <?php echo e(($home_variant_number == '04')? '':'white'); ?>  extra desktop-center margin-bottom-55">
                    <div class="icon">
                        <span class="line-one"></span>
                        <span class="line-two"></span>
                        <i class="<?php echo e(get_static_option('site_heading_icon')); ?>"></i>
                        <span class="line-three"></span>
                        <span class="line-four"></span>
                    </div>
                    <h3 class="title"><?php echo e(get_static_option('home_page_price_plan_section_'.$user_select_lang_slug.'_title')); ?></h3>
                    <p><?php echo e(get_static_option('home_page_price_plan_section_'.$user_select_lang_slug.'_description')); ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $all_price_plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-6">
                <div class="single-price-plan-01 <?php echo e(($key == 1)? 'active' : ''); ?>">
                    <div class="price-header">
                        <div class="img-icon">
                            <?php echo render_image_markup_by_attachment_id($data->image); ?>

                        </div>
                        <h4 class="title"><?php echo e(optional($data->lang_front)->title); ?></h4>
                    </div>
                    <div class="price-body">
                        <ul>
                            <?php $__currentLoopData = explode("\n",optional($data->lang_front)->features); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><i class="fa fa-check success"></i> <?php echo e($item); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <div class="price-wrap">
                        <?php echo custom_amount_with_currency_symbol($data->price); ?> <span class="sign"><?php echo e($data->type); ?></span>
                    </div>
                    <div class="price-footer">
                        <div class="btn-wrapper">
                            <a href="<?php echo e(($data->btn_url)?? route('frontend.plan.order',['id' => $data->id])); ?>" class="boxed-btn"><?php echo e(optional($data->lang_front)->btn_text); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/price-plan-area.blade.php ENDPATH**/ ?>