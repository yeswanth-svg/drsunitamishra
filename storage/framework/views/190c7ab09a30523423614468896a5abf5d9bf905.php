<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/dropzone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/nice-select.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Why Choose Us Section')); ?>

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
                        <h4 class="header-title"><?php echo e(__('Why Choose Us Area Settings')); ?></h4>
                        <form action="<?php echo e(route('admin.home.why.choose.us')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a class="nav-item nav-link <?php if($key == 0): ?> active <?php endif; ?>" id="nav-home-tab" data-toggle="tab" href="#nav-home-<?php echo e($lang->slug); ?>" role="tab" aria-controls="nav-home" aria-selected="true"><?php echo e($lang->name); ?></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </nav>
                            <div class="row">
                                <div class="col-lg-8 col-md-6">
                                    <div class="tab-content margin-top-30" id="nav-tabContent">
                                        <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="tab-pane fade <?php if($key == 0): ?> show active <?php endif; ?>" id="nav-home-<?php echo e($lang->slug); ?>" role="tabpanel" aria-labelledby="nav-home-tab">
                                                <div class="form-group">
                                                    <label for="home_page_why_choose_us_section_<?php echo e($lang->slug); ?>_title"><?php echo e(__('Title')); ?></label>
                                                    <input type="text" name="home_page_why_choose_us_section_<?php echo e($lang->slug); ?>_title" value="<?php echo e(get_static_option('home_page_why_choose_us_section_'.$lang->slug.'_title')); ?>" class="form-control" id="home_page_<?php echo e($lang->slug); ?>_why_choose_us_section_title">
                                                </div>
                                                <div class="form-group">
                                                    <label for="home_page_why_choose_us_section_<?php echo e($lang->slug); ?>_description"><?php echo e(__('Description')); ?></label>
                                                    <textarea name="home_page_why_choose_us_section_<?php echo e($lang->slug); ?>_description" class="form-control" ><?php echo e(get_static_option('home_page_why_choose_us_section_'.$lang->slug.'_description')); ?></textarea>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="price_plan"><?php echo e(__('Select Services to Display')); ?></label>
                                        <select name="why_choose_us_selected_services[]" multiple class="form-control nice-select wide">
                                            <?php
                                                $selected_service = !empty(get_static_option('why_choose_us_selected_services')) ? unserialize(get_static_option('why_choose_us_selected_services')) : [];
                                            ?>
                                            <?php $__currentLoopData = $all_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($data->id); ?>" <?php if(is_array($selected_service) && in_array($data->id,$selected_service)): ?> selected <?php endif; ?>><?php echo e(optional($data->lang)->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <?php if(in_array(get_static_option('why_choose_us_home_'.$home_page_variant_number.'_variant'),['03','04'])): ?>
                                <div class="bg-image-check col-lg-4 col-md-6 mt-4">
                                    <div class="form-group">
                                        <label for="home_page_<?php echo e($home_page_variant_number); ?>_why_choose_us_bg"><?php echo e(__('Background Image')); ?></label>
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap">
                                                <?php
                                                    $image = get_attachment_image_by_id(get_static_option('home_page_'.$home_page_variant_number.'_why_choose_us_bg'),null,true);
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
                                            <input type="hidden" id="home_page_<?php echo e($home_page_variant_number); ?>_why_choose_us_bg" name="home_page_<?php echo e($home_page_variant_number); ?>_why_choose_us_bg" value="<?php echo e(get_static_option('home_page_'.$home_page_variant_number.'_why_choose_us_bg')); ?>">
                                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Image')); ?>" data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                                <?php echo e(__($image_btn_label)); ?>

                                            </button>
                                        </div>
                                        <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png.')); ?></small>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control"  id="why_choose_us_variant" value="<?php echo e(get_static_option('why_choose_us_home_'.$home_page_variant_number.'_variant')); ?>" name="why_choose_us_home_<?php echo e($home_page_variant_number); ?>_variant">
                            </div>
                            <label for="why_choose_us_variant"><?php echo e(__('Choose Why Choose Us Variant :')); ?></label>
                            <div class="row">
                                <?php for($i = 1; $i < 5; $i++): ?>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="img-select selected">
                                            <div class="img-wrap">
                                                <img src="<?php echo e(asset('assets/frontend/why-choose-us-variant/why-choose-us-0'.$i.'.png')); ?>" data-why_choose_us_id="0<?php echo e($i); ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                            
                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Settings')); ?></button>
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
    <script src="<?php echo e(asset('assets/backend/js/jquery.nice-select.min.js')); ?>"></script>
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
                if($('.nice-select').length > 0){
                $('.nice-select').niceSelect();
                }
                var imgSelect = $('.img-select');
                var id = $('#why_choose_us_variant').val();
                imgSelect.removeClass('selected');
                $('img[data-why_choose_us_id="'+id+'"]').parent().parent().addClass('selected');
                $(document).on('click','.img-select img',function (e) {
                    e.preventDefault();
                    imgSelect.removeClass('selected');
                    $(this).parent().parent().addClass('selected').siblings();
                    $('#why_choose_us_variant').val($(this).data('why_choose_us_id'));
                })
            })
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/backend/pages/home-page-manage/why-choose-us-settings.blade.php ENDPATH**/ ?>