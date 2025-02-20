<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/dropzone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('About Section')); ?>

<?php $__env->stopSection(); ?> 
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.success','data' => []]); ?>
<?php $component->withName('msg.success'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.error','data' => []]); ?>
<?php $component->withName('msg.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('About Us Section Settings')); ?></h4>
                        <form action="<?php echo e(route('admin.about.page.about')); ?>" method="post" enctype="multipart/form-data"><?php echo csrf_field(); ?>
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
                            <div class="tab-content margin-top-20" id="nav-tabContent">
                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tab-pane fade <?php if($key == 0): ?> show active <?php endif; ?>" id="nav-home-<?php echo e($lang->slug); ?>" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="form-group">
                                        <label for="about_page_full_width_service_section_<?php echo e($lang->slug); ?>_title"><?php echo e(__('Title')); ?></label>
                                        <input type="text" class="form-control" name="about_page_full_width_service_section_<?php echo e($lang->slug); ?>_title" value="<?php echo e(get_static_option('about_page_full_width_service_section_'.$lang->slug.'_title')); ?>" placeholder="<?php echo e(__('Title')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="about_page_full_width_service_section_<?php echo e($lang->slug); ?>_description"><?php echo e(__('Description')); ?></label>
                                        <textarea type="text" class="form-control" name="about_page_full_width_service_section_<?php echo e($lang->slug); ?>_description" rows="4" cols="10"><?php echo e(get_static_option('about_page_full_width_service_section_'.$lang->slug.'_description')); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="about_page_full_width_service_section_<?php echo e($lang->slug); ?>_features"><?php echo e(__('Features')); ?></label>
                                        <textarea class="form-control"  id="about_page_full_width_service_section_<?php echo e($lang->slug); ?>_features"  name="about_page_full_width_service_section_<?php echo e($lang->slug); ?>_features" placeholder="<?php echo e(__('Features')); ?>" cols="10" rows="5"><?php echo e(get_static_option('about_page_full_width_service_section_'.$lang->slug.'_features')); ?></textarea>
                                        <small class="form-text text-muted"><?php echo e(__('Separate feature by entering a new line.')); ?></small> 
                                    </div>
                                    <div class="form-group">
                                        <label for="about_page_full_width_service_section_<?php echo e($lang->slug); ?>_support_title"><?php echo e(__('Support Title')); ?></label>
                                        <input type="text" class="form-control" name="about_page_full_width_service_section_<?php echo e($lang->slug); ?>_support_title" value="<?php echo e(get_static_option('about_page_full_width_service_section_'.$lang->slug.'_support_title')); ?>" placeholder="<?php echo e(__('Support Title')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="about_page_full_width_service_section_<?php echo e($lang->slug); ?>_support_details"><?php echo e(__('Support Details')); ?></label>
                                        <input type="text" class="form-control" name="about_page_full_width_service_section_<?php echo e($lang->slug); ?>_support_details" value="<?php echo e(get_static_option('about_page_full_width_service_section_'.$lang->slug.'_support_details')); ?>" placeholder="<?php echo e(__('Support Details')); ?>">
                                    </div>
                                </div>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.add-icon','data' => ['name' => 'about_page_full_width_service_section_support_icon','id' => 'about_page_full_width_service_section_support_icon','value' => 'about_page_full_width_service_section_support_icon','title' => __('Support Icon')]]); ?>
<?php $component->withName('add-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('about_page_full_width_service_section_support_icon'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('about_page_full_width_service_section_support_icon'),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('about_page_full_width_service_section_support_icon'),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Support Icon'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="image"><?php echo e(__('Right Side Image')); ?></label>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.image','data' => ['id' => 'about_page_full_width_service_section_bg_img_right','name' => 'about_page_full_width_service_section_bg_img_right','value' => 'about_page_full_width_service_section_bg_img_right']]); ?>
<?php $component->withName('image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('about_page_full_width_service_section_bg_img_right'),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('about_page_full_width_service_section_bg_img_right'),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('about_page_full_width_service_section_bg_img_right')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                    <small class="form-text text-muted"><?php echo e(__('1050 x 850 pixels (recommended)')); ?></small>
                                </div>
                            </div>
                            <button type="submit" id="update" class="btn btn-primary pr-4 pl-4"><?php echo e(__('Update Settings')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('backend.partials.media-upload.media-upload-markup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.media-upload.media-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.icon-picker','data' => []]); ?>
<?php $component->withName('icon-picker'); ?>
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

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/backend/pages/about-page/about-section.blade.php ENDPATH**/ ?>