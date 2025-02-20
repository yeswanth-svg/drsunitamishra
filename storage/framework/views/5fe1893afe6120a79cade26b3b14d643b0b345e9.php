<?php $__env->startSection('site-title'); ?>
    <?php echo e(optional($service_item->lang_front)->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(optional($service_item->lang_front)->title); ?>   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
<meta name="title" content="<?php echo e(optional($service_item->lang_front)->meta_title); ?>">
<meta name="tags" content="<?php echo e(optional($service_item->lang_front)->meta_tags); ?> ">
<meta name="description" content="<?php echo e(optional($service_item->lang_front)->meta_description); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('og-meta'); ?>
<meta name="og:title" content="<?php echo e(optional($service_item->lang_front)->og_meta_title); ?>">
<meta name="og:description" content="<?php echo e(optional($service_item->lang_front)->og_meta_description); ?>">
<?php echo render_og_meta_image_by_attachment_id(optional($service_item->lang_front)->og_meta_image); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-content our-attoryney padding-top-120 padding-bottom-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-details-item">
                    <div class="thumb padding-bottom-40">
                        <?php echo render_image_markup_by_attachment_id($service_item->image); ?>

                    </div>
                    <h2 class="title"><?php echo e(optional($service_item->lang_front)->title); ?></h2>
                    <p><?php echo optional($service_item->lang_front)->description; ?></p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="widget-nav-menu margin-bottom-30">
                    <ul>
                        <?php $__currentLoopData = $service_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(route('frontend.services.category', ['id' => $data->id , 'any' => Str::slug($data->lang_front->name ?? 'x')])); ?>" class="service-item-list <?php if($data->id == $service_item->categories_id): ?> active <?php endif; ?> style-<?php echo e(($key == '0')? '02' : '02'); ?>">
                                <div class="service-icon style-<?php echo e(($key == '0') ? '02' : '02'); ?>">
                                    <i class="<?php echo e($data->icon); ?>"></i>
                                </div>
                                <div class="service-title">
                                    <h4 class="title"><?php echo e(optional($data->lang_front)->name); ?></h4>
                                </div>
                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="widget-nav-contact">
                    <div class="contact-img bg-image">
                        <?php echo render_image_markup_by_attachment_id(get_static_option('service_page_banner')); ?>

                    </div>
                </div>
            </div>
        </div>
        <?php if(!empty($price_plan)): ?>
        <div class="price-plan-wrapper margin-top-80">
            <div class="row">
                <?php $__currentLoopData = $price_plan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6">
                    <div class="single-price-plan-01 active">
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
                            <?php echo custom_amount_with_currency_symbol($data->price); ?> <span class="sign"><?php echo e(optional($data->lang_front)->type); ?></span>
                        </div>
                        <div class="price-footer">
                            <div class="btn-wrapper">
                                <a href="<?php echo e(($data->btn_url) ?? route('frontend.plan.order',['id' => $data->id])); ?>" class="boxed-btn"><?php echo e(optional($data->lang_front)->btn_text); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/pages/service/service-single.blade.php ENDPATH**/ ?>