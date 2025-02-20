<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Contact Page Settings')); ?>

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
                        <h4 class="header-title"><?php echo e(__('Contact Page Settings')); ?></h4>
                        <form action="<?php echo e(route('admin.contact.page.settings')); ?>" method="post" enctype="multipart/form-data"><?php echo csrf_field(); ?>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.lang-nav','data' => []]); ?>
<?php $component->withName('lang-nav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tab-pane fade <?php if($key == 0): ?> show active <?php endif; ?>" id="nav-home-<?php echo e($lang->slug); ?>" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="form-group">
                                        <label for="home_page_contact_us_section_<?php echo e($lang->slug); ?>_title"><?php echo e(__('Title')); ?></label>
                                        <input type="text" name="home_page_contact_us_section_<?php echo e($lang->slug); ?>_title" class="form-control" placeholder="<?php echo e(__('Title')); ?>" value="<?php echo e(get_static_option('home_page_contact_us_section_'.$lang->slug.'_title')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_contact_us_section_<?php echo e($lang->slug); ?>_contact"><?php echo e(__('Contact No')); ?></label>
                                        <textarea class="form-control" name="home_page_contact_us_section_<?php echo e($lang->slug); ?>_contact" placeholder="<?php echo e(__('Contact No')); ?>" cols="5" rows="5"><?php echo e(get_static_option('home_page_contact_us_section_'.$lang->slug.'_contact')); ?></textarea>
                                        <small class="form-text text-muted"><?php echo e(__('Separate item by entering a new line.')); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_contact_us_section_<?php echo e($lang->slug); ?>_email"><?php echo e(__('Email')); ?></label>
                                        <textarea class="form-control" name="home_page_contact_us_section_<?php echo e($lang->slug); ?>_email" placeholder="<?php echo e(__('Email')); ?>" cols="5" rows="5"><?php echo e(get_static_option('home_page_contact_us_section_'.$lang->slug.'_email')); ?></textarea>
                                        <small class="form-text text-muted"><?php echo e(__('Separate item by entering a new line.')); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_contact_us_section_<?php echo e($lang->slug); ?>_address"><?php echo e(__('Address')); ?></label>
                                        <textarea class="form-control" name="home_page_contact_us_section_<?php echo e($lang->slug); ?>_address" placeholder="<?php echo e(__('Email')); ?>" cols="5" rows="5"><?php echo e(get_static_option('home_page_contact_us_section_'.$lang->slug.'_address')); ?></textarea>
                                        <small class="form-text text-muted"><?php echo e(__('Separate item by entering a new line.')); ?></small>
                                    </div>
                                </div>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <label for="contact_page_map_section_location"><?php echo e(__('Google Map Location')); ?></label>
                                <input type="text" name="contact_page_map_section_location" value="<?php echo e(get_static_option('contact_page_map_section_location')); ?>" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="contact_page_map_section_zoom"><?php echo e(__('Map Zoom')); ?></label>
                                <input type="text" name="contact_page_map_section_zoom" value="<?php echo e(get_static_option('contact_page_map_section_zoom')); ?>" class="form-control" >
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
<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/backend/pages/contact-page/contact-page-settings.blade.php ENDPATH**/ ?>