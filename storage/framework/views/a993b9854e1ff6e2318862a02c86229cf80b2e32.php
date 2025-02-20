<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Section Manage')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <?php echo $__env->make('backend/partials/message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('backend/partials/error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('Home Page Section Manage')); ?></h4>
                        <form action="<?php echo e(route('admin.home.section.manage')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php
                            if($home_page_variant_number == '01')
                                $section_names = ['topbar','infobar','navbar','header_slider','keyfeature','why_choose_us','full_width_service','counterup','testimonial','quote','price_plan','latest_team_member','latest_blog'];
                            elseif($home_page_variant_number == '02')
                                $section_names = ['topbar','infobar','navbar','header_slider','keyfeature','why_choose_us','full_width_service','testimonial','latest_team_member','price_plan','latest_blog','call_to_action'];
                            elseif($home_page_variant_number == '03')
                                $section_names = ['topbar','navbar','header_slider','keyfeature','why_choose_us','counterup','testimonial','call_us','price_plan','latest_team_member','latest_blog'];
                            elseif($home_page_variant_number == '04')
                                $section_names = ['topbar','infobar','navbar','header_slider','keyfeature','full_width_service','why_choose_us','counterup','price_plan','testimonial','latest_team_member','latest_blog'];
                            ?>
                            <div class="row">
                                <?php $__currentLoopData = $section_names; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="home_page_<?php echo e($section_name); ?>_section_status"><strong><?php echo e(__(Str::ucfirst(str_replace('_',' ',$section_name)).' Section Show/Hide')); ?></strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_<?php echo e($section_name); ?>_section_status"  <?php if(!empty(get_static_option('home_page_'.$section_name.'_section_status'))): ?> checked <?php endif; ?> id="home_page_<?php echo e($section_name); ?>_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Settings')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        (function($){
        "use strict";
        $(document).ready(function () {
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.btn.update','data' => []]); ?>
<?php $component->withName('btn.update'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/backend/pages/section-manage.blade.php ENDPATH**/ ?>