<?php $__env->startSection('style'); ?>
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.summernote.css','data' => []]); ?>
<?php $component->withName('summernote.css'); ?>
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
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/bootstrap-tagsinput.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/nice-select.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Edit Services')); ?>

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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <h4 class="header-title"><?php echo e(__('Edit Service')); ?></h4>
                            <a href="<?php echo e(route('admin.services')); ?>" class="btn btn-info"><?php echo e(__('All Services')); ?></a>
                        </div>
                        <form action="<?php echo e(route('admin.services.update')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo e($service->id); ?>">
                            <ul class="nav nav-tabs" role="tablist">
                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?php if($loop->first): ?> active <?php endif; ?>"  data-toggle="tab" href="#slider_tab_<?php echo e($lang->slug); ?>" role="tab" aria-controls="home" aria-selected="true"><?php echo e($lang->name); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="tab-content margin-top-40" >
                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="tab-pane fade <?php if($loop->first): ?> show active <?php endif; ?>" id="slider_tab_<?php echo e($lang->slug); ?>" role="tabpanel" >
                                        <?php $__currentLoopData = $service->lang_all->where('lang',$lang->slug); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="form-group">
                                                <label for="title"><?php echo e(__('Title')); ?></label>
                                                <input type="text" class="form-control" name="title[<?php echo e($lang->slug); ?>]" value="<?php echo e($item->title); ?>" placeholder="<?php echo e(__('Title')); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo e(__('Description')); ?></label>
                                                <input type="hidden" name="description[<?php echo e($lang->slug); ?>]" value="<?php echo e($item->description); ?>">
                                                <div class="summernote" data-content="<?php echo e($item->description); ?>"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="excerpt"><?php echo e(__('Excerpt')); ?></label>
                                                <textarea name="excerpt[<?php echo e($lang->slug); ?>]" cols="30" rows="5" class="form-control"><?php echo e($item->excerpt); ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="slug"><?php echo e(__('Slug')); ?></label>
                                                <input type="text" class="form-control" name="slug[<?php echo e($lang->slug); ?>]" value="<?php echo e($item->slug); ?>" placeholder="<?php echo e(__('Slug')); ?>">
                                            </div>  
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="meta_title"><?php echo e(__('Meta Title')); ?></label>
                                                    <input type="text" name="meta_title[<?php echo e($lang->slug); ?>]" value="<?php echo e($item->meta_title); ?>" class="form-control" >
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="og_meta_title"><?php echo e(__('OG Meta Title')); ?></label>
                                                    <input type="text" name="og_meta_title[<?php echo e($lang->slug); ?>]" value="<?php echo e($item->og_meta_title); ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="meta_description"><?php echo e(__('Meta Description')); ?></label>
                                                    <textarea name="meta_description[<?php echo e($lang->slug); ?>]" class="form-control" rows="5" id="meta_description"><?php echo e($item->meta_description); ?></textarea>
                                                </div>
                                                
                                                <div class="form-group col-md-6">
                                                    <label for="og_meta_description"><?php echo e(__('OG Meta Description')); ?></label>
                                                    <textarea name="og_meta_description[<?php echo e($lang->slug); ?>]" class="form-control" rows="5" id="og_meta_description"><?php echo e($item->og_meta_description); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="meta_tags"><?php echo e(__('Meta Tags')); ?></label>
                                                    <input type="text" name="meta_tags[<?php echo e($lang->slug); ?>]" class="form-control" data-role="tagsinput"
                                                        id="meta_tags" value="<?php echo e($item->meta_tags); ?>" >
                                                </div>
                                                <div class="form-group col-md-6 col-lg-6">
                                                    <label for="og_meta_image[<?php echo e($lang->slug); ?>]"><?php echo e(__('OG Meta Image')); ?></label>
                                                    <div class="media-upload-btn-wrapper">
                                                        <div class="img-wrap">
                                                            <?php
                                                                $image = get_attachment_image_by_id($item->og_meta_image,null,true);
                                                                $image_btn_label = 'Upload Image';
                                                            ?>
                                                            <?php if(!empty($image)): ?>
                                                                <div class="attachment-preview">
                                                                    <div class="thumbnail">
                                                                        <div class="centered">
                                                                            <img class="avatar user-thumb" src="<?php echo e($image['img_url']); ?>" alt="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php  $image_btn_label = 'Change Image'; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                        <input type="hidden" id="og_meta_image[<?php echo e($lang->slug); ?>]" name="og_meta_image[<?php echo e($lang->slug); ?>]" value="<?php echo e($item->og_meta_image); ?>">
                                                        <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                            <?php echo e(__($image_btn_label)); ?>

                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <label for="category"><?php echo e(__('Category')); ?></label>
                                <select name="categories_id" id="category" class="form-control">
                                    <option value=""><?php echo e(__('Select Category')); ?></option>
                                    <?php $__currentLoopData = $service_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php if($service->categories_id == $data->id): ?> selected <?php endif; ?> value="<?php echo e($data->id); ?>"><?php echo e(purify_html(optional($data->lang)->name)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_icon_type"><?php echo e(__('Icon Type')); ?></label>
                                <select name="icon_type" class="form-control" id="edit_icon_type">
                                    <option <?php if($service->icon_type == 'icon'): ?> selected <?php endif; ?> value="icon"><?php echo e(__("Font Icon")); ?></option>
                                    <option <?php if($service->icon_type == 'image'): ?> selected <?php endif; ?> value="image"><?php echo e(__("Image Icon")); ?></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="icon" class="d-block icon-view"><?php echo e(__('Icon')); ?></label>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-info btn-lg iconpicker-component">
                                        <i class="<?php echo e($service->icon); ?>"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-info btn-lg dropdown-toggle"
                                            data-selected="<?php echo e($service->icon); ?>" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only"><?php echo e(__('Toggle Dropdown')); ?></span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control"  id="icon" value="<?php echo e($service->icon); ?>" name="icon">
                            </div>
                            <div class="form-group">
                                <label for="img_icon"><?php echo e(__('Image Icon')); ?></label>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        <?php
                                            $service_section_img = get_attachment_image_by_id($service->img_icon,null,true);
                                            $image_btn_label = __('Upload Image Icon');
                                        ?>
                                        <?php if(!empty($service_section_img)): ?>
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="<?php echo e($service_section_img['img_url']); ?>" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $image_btn_label = __('Update Image Icon');
                                            ?>
                                        <?php endif; ?>
                                    </div>
                                    <input type="hidden" id="img_icon" name="img_icon" value="<?php echo e($service->img_icon); ?>">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                        <?php echo e($image_btn_label); ?>

                                    </button>
                                </div>
                                <small class="form-text text-muted"><?php echo e(__('60 x 60 pixels (recommended)')); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="price_plan"><?php echo e(__('Price Plans')); ?></label>
                                <select name="price_plan[]" multiple class="form-control nice-select wide">
                                    <?php
                                        $select_plan = !empty($service->price_plan) ? unserialize($service->price_plan) : [];
                                    ?>
                                    <?php $__currentLoopData = $price_plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($data->id); ?>" <?php if(is_array($select_plan) && in_array($data->id,$select_plan)): ?> selected <?php endif; ?>><?php echo e(purify_html(optional($data->lang)->title)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sr_order"><?php echo e(__('Order')); ?></label>
                                <input type="number" class="form-control"  id="sr_order"  name="sr_order" value="<?php echo e($service->sr_order); ?>">
                                <span class="info-text"><?php echo e(__('if you set order for it, all service will show in frontend as a per this order')); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="image"><?php echo e(__('Image')); ?></label>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        <?php
                                            $service_section_img = get_attachment_image_by_id($service->image,null,true);
                                            $image_btn_label = __('Upload Image');
                                        ?>
                                        <?php if(!empty($service_section_img)): ?>
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="<?php echo e($service_section_img['img_url']); ?>" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                $image_btn_label = __('Update Image');
                                            ?>
                                        <?php endif; ?>
                                    </div>
                                    <input type="hidden" name="image" value="<?php echo e($service->image); ?>">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Service Image')); ?>" data-modaltitle="<?php echo e(__('Upload Service Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                        <?php echo e($image_btn_label); ?>

                                    </button>
                                </div>
                                <small class="form-text text-muted"><?php echo e(__('1920 x 1280 pixels (recommended)')); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="status"><?php echo e(__('Status')); ?></label>
                                <select name="status" id="status" class="form-control">
                                    <option <?php if($service->status == 'publish'): ?> selected <?php endif; ?> value="publish"><?php echo e(__('Publish')); ?></option>
                                    <option <?php if($service->status == 'draft'): ?> selected <?php endif; ?> value="draft"><?php echo e(__('Draft')); ?></option>
                                </select>
                            </div>
                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Service')); ?></button>
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
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.summernote.js','data' => []]); ?>
<?php $component->withName('summernote.js'); ?>
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
    <script src="<?php echo e(asset('assets/backend/js/bootstrap-tagsinput.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/jquery.nice-select.min.js')); ?>"></script>
    <script>
        (function ($){
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
            if($('.nice-select').length > 0){
                $('.nice-select').niceSelect();
            }
            $(document).on('change','select[name="icon_type"]',function (e){
                e.preventDefault();
                var iconType = $(this).val();
                iconTypeFieldVal(iconType);
            });
            defaultIconType();

            function defaultIconType(){
                var iconType = $('select[name="icon_type"]').val();
                iconTypeFieldVal(iconType);
            }

            function iconTypeFieldVal(iconType){
                if (iconType == 'icon'){
                    $('input[name="img_icon"]').parent().parent().hide();
                    $('input[name="icon"]').parent().show();
                }else if(iconType == 'image'){
                    $('input[name="icon"]').parent().hide();
                    $('input[name="img_icon"]').parent().parent().show();
                }
            }
            $('.icp-dd').iconpicker();
            $('.icp-dd').on('iconpickerSelected', function (e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
            });

        });
    })(jQuery)
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/backend/pages/service/edit-service.blade.php ENDPATH**/ ?>