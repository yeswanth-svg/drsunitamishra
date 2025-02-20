<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Navbar Settings')); ?>

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
                        <h4 class="header-title"><?php echo e(__('Navbar Settings')); ?></h4>
                        <form action="<?php echo e(route('admin.navbar.settings')); ?>" method="post" enctype="multipart/form-data"><?php echo csrf_field(); ?>
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
                            <div class="form-group margin-top-30">
                             <label for="navbar_button "><?php echo e(__('Button Visiblity')); ?></label>
                            <label class="switch">
                                <input type="checkbox" name="navbar_button" <?php if(!empty(get_static_option('navbar_button'))): ?> checked <?php endif; ?> id="navbar_button">
                                <span class="slider"></span>
                            </label>
                            </div>
                            <div class="tab-content " id="nav-tabContent">
                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="tab-pane fade <?php if($key == 0): ?> show active <?php endif; ?>" id="nav-home-<?php echo e($lang->slug); ?>" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <?php if($home_page_variant_number == '03'): ?>
                                            <div class="form-group">
                                                <label for="navbar_button_title_<?php echo e($lang->slug); ?>"><?php echo e(__('Title')); ?></label>
                                                <input type="title" name="navbar_button_title_<?php echo e($lang->slug); ?>" class="form-control" value="<?php echo e(get_static_option('navbar_button_title_'.$lang->slug)); ?>" id="navbar_button_title_<?php echo e($lang->slug); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="navbar_button_details_<?php echo e($lang->slug); ?>"><?php echo e(__('Details')); ?></label>
                                                <input type="details" name="navbar_button_details_<?php echo e($lang->slug); ?>" class="form-control" value="<?php echo e(get_static_option('navbar_button_details_'.$lang->slug)); ?>" id="navbar_button_details_<?php echo e($lang->slug); ?>">
                                            </div>
                                        <?php else: ?>
                                            <div class="form-group">
                                                <label for="navbar_button_text_<?php echo e($lang->slug); ?>"><?php echo e(__('Button Text')); ?></label>
                                                <input type="text" name="navbar_button_text_<?php echo e($lang->slug); ?>" class="form-control" value="<?php echo e(get_static_option('navbar_button_text_'.$lang->slug)); ?>" id="navbar_button_text_<?php echo e($lang->slug); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="navbar_button_url_<?php echo e($lang->slug); ?>"><?php echo e(__('Button URL')); ?></label>
                                                <input type="text" name="navbar_button_url_<?php echo e($lang->slug); ?>" class="form-control" value="<?php echo e(get_static_option('navbar_button_url_'.$lang->slug)); ?>" id="navbar_button_url_<?php echo e($lang->slug); ?>">
                                            </div>
                                        <?php endif; ?>
                                        
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <label for="icon" class="d-block"><?php echo e(__('Shopping Cart Icon')); ?></label>
                                <div class="btn-group icon">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="<?php echo e(get_static_option('shopping_cart_icon')); ?>"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                            data-selected="<?php echo e(get_static_option('shopping_cart_icon')); ?>" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only"><?php echo e(__("Toggle Dropdown")); ?></span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control"  id="icon" value="<?php echo e(get_static_option('shopping_cart_icon')); ?>" name="shopping_cart_icon">
                            </div>
                            <?php if($home_page_variant_number == '03'): ?>
                                <div class="form-group">
                                    <label for="icon" class="d-block"><?php echo e(__('Title Icon')); ?></label>
                                    <div class="btn-group icon">
                                        <button type="button" class="btn btn-primary iconpicker-component">
                                            <i class="<?php echo e(get_static_option('navbar_title_icon')); ?>"></i>
                                        </button>
                                        <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                                data-selected="<?php echo e(get_static_option('navbar_title_icon')); ?>" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only"><?php echo e(__("Toggle Dropdown")); ?></span>
                                        </button>
                                        <div class="dropdown-menu"></div>
                                    </div>
                                    <input type="hidden" class="form-control"  id="icon" value="<?php echo e(get_static_option('navbar_title_icon')); ?>" name="navbar_title_icon">
                                </div>
                            <?php else: ?>
                                <div class="form-group">
                                    <label for="icon" class="d-block"><?php echo e(__('Button Icon')); ?></label>
                                    <div class="btn-group icon">
                                        <button type="button" class="btn btn-primary iconpicker-component">
                                            <i class="<?php echo e(get_static_option('navbar_button_icon')); ?>"></i>
                                        </button>
                                        <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                                data-selected="<?php echo e(get_static_option('navbar_button_icon')); ?>" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only"><?php echo e(__("Toggle Dropdown")); ?></span>
                                        </button>
                                        <div class="dropdown-menu"></div>
                                    </div>
                                    <input type="hidden" class="form-control"  id="icon" value="<?php echo e(get_static_option('navbar_button_icon')); ?>" name="navbar_button_icon">
                                </div>
                            <?php endif; ?>
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
(function ($){
"use strict";
    $(document).ready(function () {
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
})(jQuery)
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/backend/pages/navbar-settings.blade.php ENDPATH**/ ?>