<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Key Features Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.css','data' => []]); ?>
<?php $component->withName('media.css'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
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
                        <h4 class="header-title"><?php echo e(__('Keyfeatures Area Settings')); ?></h4>
                        <form action="<?php echo e(route('admin.home.keyfeatures')); ?>" method="post" enctype="multipart/form-data"><?php echo csrf_field(); ?>
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
                                    <?php if(in_array($home_page_variant_number,['02','04'])): ?>
                                    <div class="form-group">
                                        <label for="home_page_keyfeatures_section_<?php echo e($lang->slug); ?>_title"><?php echo e(__('Title')); ?></label>
                                        <input type="text" class="form-control" name="home_page_keyfeatures_section_<?php echo e($lang->slug); ?>_title" value="<?php echo e(get_static_option('home_page_keyfeatures_section_'.$lang->slug.'_title')); ?>" placeholder="<?php echo e(__('Title')); ?>">
                                    </div>
                                    <?php endif; ?>
                                    <?php if($home_page_variant_number == '02'): ?>
                                    <div class="form-group">
                                        <label for="home_page_keyfeatures_section_<?php echo e($lang->slug); ?>_btn_text"><?php echo e(__('Button Text')); ?></label>
                                        <input type="text" class="form-control" name="home_page_keyfeatures_section_<?php echo e($lang->slug); ?>_btn_text" value="<?php echo e(get_static_option('home_page_keyfeatures_section_'.$lang->slug.'_btn_text')); ?>" placeholder="<?php echo e(__('Button Text')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_keyfeatures_section_<?php echo e($lang->slug); ?>_btn_url"><?php echo e(__('Button Url')); ?></label>
                                        <input type="text" class="form-control" name="home_page_keyfeatures_section_<?php echo e($lang->slug); ?>_btn_url" value="<?php echo e(get_static_option('home_page_keyfeatures_section_'.$lang->slug.'_btn_url')); ?>" placeholder="<?php echo e(__('Button Url')); ?>">
                                    </div>
                                    <?php endif; ?>
                                    <?php if($home_page_variant_number == '04'): ?>
                                    <div class="form-group">    
                                        <label for="home_page_keyfeatures_section_<?php echo e($lang->slug); ?>_description"><?php echo e(__('Description')); ?></label>
                                        <textarea type="text" class="form-control" name="home_page_keyfeatures_section_<?php echo e($lang->slug); ?>_description" value="<?php echo e(get_static_option('home_page_keyfeatures_section_'.$lang->slug.'_description')); ?>" rows="5" cols="10"><?php echo e(get_static_option('home_page_keyfeatures_section_'.$lang->slug.'_description')); ?></textarea>
                                    </div>
                                    <?php endif; ?>
                                    <?php if($home_page_variant_number == '03'): ?>
                                    <div class="form-group">
                                        <label for="home_page_keyfeatures_section_<?php echo e($lang->slug); ?>_quote_title"><?php echo e(__('Quote Title')); ?></label>
                                        <input type="text" class="form-control" name="home_page_keyfeatures_section_<?php echo e($lang->slug); ?>_quote_title" value="<?php echo e(get_static_option('home_page_keyfeatures_section_'.$lang->slug.'_quote_title')); ?>" placeholder="<?php echo e(__('Quote Title')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_keyfeatures_section_<?php echo e($lang->slug); ?>_quote_subtitle"><?php echo e(__('Quote Sub Title')); ?></label>
                                        <input type="text" class="form-control" name="home_page_keyfeatures_section_<?php echo e($lang->slug); ?>_quote_subtitle" value="<?php echo e(get_static_option('home_page_keyfeatures_section_'.$lang->slug.'_quote_subtitle')); ?>" placeholder="<?php echo e(__('Quote Sub Title')); ?>">
                                    </div>
                                    <?php endif; ?>
                                </div>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <label for="home_page_<?php echo e($home_page_variant_number); ?>_key_feature_item"><?php echo e(__('Display Number of Items')); ?></label>
                                <input type="number" name="home_page_<?php echo e($home_page_variant_number); ?>_key_feature_item" value="<?php echo e(get_static_option('home_page_'.$home_page_variant_number.'_key_feature_item')); ?>" class="form-control" id="home_page_<?php echo e($home_page_variant_number); ?>_key_feature_item">
                            </div>
                            <?php if(in_array($home_page_variant_number,['02','03','04'])): ?>
                            <div class="form-group">
                                <label for="home_page_<?php echo e($home_page_variant_number); ?>_key_feature_number"><?php echo e(__('Display Number of Features')); ?></label>
                                <input type="number" name="home_page_<?php echo e($home_page_variant_number); ?>_key_feature_number" value="<?php echo e(get_static_option('home_page_'.$home_page_variant_number.'_key_feature_number')); ?>" class="form-control" id="home_page_<?php echo e($home_page_variant_number); ?>_key_feature_number">
                            </div>
                            <?php endif; ?>
                            <?php if($home_page_variant_number == '01'): ?>
                            <div class="form-group">
                                <label for="image"><?php echo e(__('Background Image')); ?></label>
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.image','data' => ['id' => 'home_page_keyfeatures_section_'.$home_page_variant_number.'_bg_img','name' => 'home_page_keyfeatures_section_'.$home_page_variant_number.'_bg_img','value' => 'home_page_keyfeatures_section_'.$home_page_variant_number.'_bg_img']]); ?>
<?php $component->withName('image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('home_page_keyfeatures_section_'.$home_page_variant_number.'_bg_img'),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('home_page_keyfeatures_section_'.$home_page_variant_number.'_bg_img'),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('home_page_keyfeatures_section_'.$home_page_variant_number.'_bg_img')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                <small class="form-text text-danger"><?php echo e(__('* jpg,jpeg,png')); ?></small>
                            </div>
                            <?php endif; ?>
                            <button type="submit" id="update" class="btn btn-primary pr-4 pl-4"><?php echo e(__('Update Settings')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.markup','data' => []]); ?>
<?php $component->withName('media.markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.media.js','data' => []]); ?>
<?php $component->withName('media.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
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


<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/backend/pages/home-page-manage/key-features-settings.blade.php ENDPATH**/ ?>