<?php $__env->startSection('page-title'); ?>
    <?php echo e(get_static_option('service_page_'.$user_select_lang_slug.'_name')); ?> <?php echo e(__('Category:')); ?> <?php echo e($category_name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(get_static_option('service_page_'.$user_select_lang_slug.'_name')); ?> <?php echo e(__('Category:')); ?> <?php echo e($category_name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="blog-content-area padding-100">
        <div class="container">
            <div class="row">
                <?php if(count($service_items) == '0'): ?>   
                    <div class="col-lg-12">
                        <div class="alert alert-danger"><?php echo e(__('No Post Available In This Category')); ?></div>
                    </div>
                <?php endif; ?>
                <?php $__currentLoopData = $service_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="cleaning-single-item margin-bottom-30">
                                <div class="thumb">
                                    <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                </div>
                                <div class="icon">
                                    <i class="<?php echo e($data->icon); ?>"></i>
                                </div>
                                <div class="content">
                                    <a href="<?php echo e(route('frontend.services.single',['slug'=>$data->lang->slug,'id'=>$data->id])); ?>"><h4 class="title"><?php echo e(optional($data->lang_front)->title); ?></h4></a>
                                    <a href="<?php echo e(route('frontend.services.single',['slug'=>$data->lang->slug,'id'=>$data->id])); ?>"><p><?php echo e(optional($data->lang_front)->excerpt); ?></p></a>
                                </div>
                            </div>
                        </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <nav class="pagination-wrapper" aria-label="Page navigation">
                    <?php echo e($service_items->links()); ?>

                </nav>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/pages/service/service-category.blade.php ENDPATH**/ ?>