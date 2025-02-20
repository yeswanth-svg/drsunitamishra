<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Edit Appointment')); ?>

<?php $__env->stopSection(); ?>
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
<link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/bootstrap-datepicker.min.css')); ?>">
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
                            <h4 class="header-title"><?php echo e(__('Edit Appointment')); ?></h4>
                            <a href="<?php echo e(route('admin.appointment.all')); ?>" class="btn btn-info"><?php echo e(__('All Appointments')); ?></a>
                        </div>
                        <form action="<?php echo e(route('admin.appointment.update')); ?>" method="post" enctype="multipart/form-data"><?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo e($edit_items->id); ?>">
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
                                        <?php $__currentLoopData = $edit_items->lang_all->where('lang',$lang->slug); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="form-group">
                                                <label for="title"><?php echo e(__('Title')); ?></label>
                                                <input type="text" class="form-control" name="title[<?php echo e($lang->slug); ?>]" value="<?php echo e($item->title); ?>" placeholder="<?php echo e(__('Title')); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="designation"><?php echo e(__('Designation')); ?></label>
                                                <input type="text" class="form-control" name="designation[<?php echo e($lang->slug); ?>]" value="<?php echo e($item->designation); ?>" placeholder="<?php echo e(__('Designation')); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo e(__('Description')); ?></label>
                                                <input type="hidden" name="description[<?php echo e($lang->slug); ?>]" value="<?php echo e($item->description); ?>">
                                                <div class="summernote" data-content="<?php echo e($item->description); ?>"></div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 ">
                                                    <label for="location"><?php echo e(__('Location')); ?></label>
                                                    <input type="text" name="location[<?php echo e($lang->slug); ?>]"  value="<?php echo e($item->location); ?>" class="form-control">
                                                </div>
                                                <div class="form-group col-md-6 ">
                                                    <label for="slug"><?php echo e(__('Slug')); ?></label>
                                                    <input type="text" class="form-control" name="slug[<?php echo e($lang->slug); ?>]" value="<?php echo e($item->slug); ?>" placeholder="<?php echo e(__('Slug')); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="short_description"><?php echo e(__('Short Description')); ?></label>
                                                <textarea name="short_description[<?php echo e($lang->slug); ?>]" cols="30" rows="5" class="form-control"><?php echo e($item->short_description); ?></textarea>
                                            </div>
                                            <div class="iconbox-repeater-wrapper dynamic-repeater">
                                                <label for="additional_info" class="d-block"><?php echo e(__('Additional Info')); ?></label>
                                                <?php $__empty_1 = true; $__currentLoopData = $item->additional_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <div class="all-field-wrap">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="additional_info[<?php echo e($lang->slug); ?>][]"  value="<?php echo e($val); ?>">
                                                        </div>
                                                    <div class="action-wrap">
                                                        <span class="add"><i class="ti-plus"></i></span>
                                                        <span class="remove"><i class="ti-trash"></i></span>
                                                    </div>
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <div class="all-field-wrap">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="additional_info[<?php echo e($lang->slug); ?>][]"  placeholder="<?php echo e(__('Additional info')); ?>">
                                                        </div>
                                                        <div class="action-wrap">
                                                            <span class="add"><i class="ti-plus"></i></span>
                                                            <span class="remove"><i class="ti-trash"></i></span>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="iconbox-repeater-wrapper  dynamic-repeater">
                                                <label for="experience_info" class="d-block"><?php echo e(__('Experience Info')); ?></label>
                                                <?php $__empty_1 = true; $__currentLoopData = $item->experience_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <div class="all-field-wrap">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="experience_info[<?php echo e($lang->slug); ?>][]" value="<?php echo e($val); ?>">
                                                    </div>
                                                    <div class="action-wrap">
                                                        <span class="add"><i class="ti-plus"></i></span>
                                                        <span class="remove"><i class="ti-trash"></i></span>
                                                    </div>
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <div class="all-field-wrap">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="experience_info[<?php echo e($lang->slug); ?>][]" placeholder="<?php echo e(__('Experience Info')); ?>">
                                                        </div>
                                                        <div class="action-wrap">
                                                            <span class="add"><i class="ti-plus"></i></span>
                                                            <span class="remove"><i class="ti-trash"></i></span>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="iconbox-repeater-wrapper  dynamic-repeater">
                                                <label for="specialized_info" class="d-block"><?php echo e(__('Specialized Info')); ?></label>
                                                <?php $__empty_1 = true; $__currentLoopData = $item->specialized_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <div class="all-field-wrap">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="specialized_info[<?php echo e($lang->slug); ?>][]" value="<?php echo e($val); ?>">
                                                    </div>
                                                    <div class="action-wrap">
                                                        <span class="add"><i class="ti-plus"></i></span>
                                                        <span class="remove"><i class="ti-trash"></i></span>
                                                    </div>
                                                </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <div class="all-field-wrap">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="specialized_info[<?php echo e($lang->slug); ?>][]" placeholder="<?php echo e(__('Specialized Info')); ?>">
                                                        </div>
                                                        <div class="action-wrap">
                                                            <span class="add"><i class="ti-plus"></i></span>
                                                            <span class="remove"><i class="ti-trash"></i></span>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
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
                                <select name="categories_id" class="form-control" id="category">
                                    <option value=""><?php echo e(__("Select Category")); ?></option>
                                    <?php $__currentLoopData = $appointment_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php if($category->id == $edit_items->categories_id): ?> selected <?php endif; ?>  value="<?php echo e($category->id); ?>"><?php echo e(purify_html(optional($category->lang)->name)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="booking_time_ids"><?php echo e(__('Booking Time')); ?></label>
                                <input type="hidden" name="booking_time_ids" value="<?php echo e(implode(',',array_column($edit_items->booking_time_ids,'id'))); ?>">
                                <ul class="time_slot">
                                    <?php $__empty_1 = true; $__currentLoopData = $all_booking_time; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <li data-id="<?php echo e($data->id); ?>" <?php if(in_array($data->id,array_column($edit_items->booking_time_ids,'id'))): ?> class="selected" <?php endif; ?>><?php echo e(purify_html($data->time)); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <li><?php echo e(__('add appointment time first')); ?></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="form-group">
                                <label for="appointment_status"><strong><?php echo e(__('Available For Appointment')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" <?php if($edit_items->appointment_status === 'yes'): ?> checked <?php endif; ?> name="appointment_status">
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="max_appointment"><?php echo e(__('Max Appointment')); ?></label>
                                    <input type="number" name="max_appointment" class="form-control" value="<?php echo e($edit_items->max_appointment); ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="price"><?php echo e(__('Price')); ?></label>
                                    <input type="number" name="price" class="form-control" value="<?php echo e($edit_items->price); ?>">
                                </div>
                            </div>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.fields.image','data' => ['name' => 'image','id' => $edit_items->image,'title' => __('Image'),'dimentions' => '350 x 500']]); ?>
<?php $component->withName('fields.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('image'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($edit_items->image),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Image')),'dimentions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('350 x 500')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.fields.status','data' => ['name' => 'status','title' => __('Status'),'value' => $edit_items->status]]); ?>
<?php $component->withName('fields.status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('status'),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Status')),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($edit_items->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update')); ?></button>
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
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.repeater','data' => []]); ?>
<?php $component->withName('repeater'); ?>
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
            $(document).on('click','ul.time_slot li',function (e){
                e.preventDefault();
                //prent selector
                var parent = $(this).parent().parent();
                //append input field value by this id
                var ids = parent.find('input[name="booking_time_ids"]');
                var oldValue = ids.val()
                //assign new value =
                var id = $(this).data('id');
                if(oldValue != ''){
                    var oldValAr = oldValue.split(',');
                    if($(this).hasClass('selected')){
                        var oldValAr = oldValAr.filter(function (item){return item != id;});
                    }else{
                        oldValAr.push(id);
                    }
                    ids.val(oldValAr.toString());
                }else{
                    ids.val(id);
                }
                //add class for this li
                $(this).toggleClass('selected');
            });
        });
    })(jQuery)
    </script>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/backend/appointment/appointment-edit.blade.php ENDPATH**/ ?>