<?php $__env->startSection('style'); ?>
    <?php echo $__env->make('backend.partials.datatable.style-enqueue', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('All Popups')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <?php echo $__env->make('backend/partials/message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('backend.partials.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrapp">
                            <h4 class="header-title"><?php echo e(__('All Popups')); ?>  </h4>
                            <div>
                                <a href="<?php echo e(route('admin.popup.builder.new')); ?>" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Add New Popup')); ?></a>
                            </div>
                        </div>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.bulk-action','data' => []]); ?>
<?php $component->withName('bulk-action'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <?php $a=0; ?>
                            <?php $__currentLoopData = $all_popup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $popup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if($a == 0): ?> active <?php endif; ?>"  data-toggle="tab" href="#slider_tab_<?php echo e($key); ?>" role="tab" aria-controls="home" aria-selected="true"><?php echo e(get_language_by_slug($key)); ?></a>
                                </li>
                                <?php $a++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            <?php $b=0; ?>
                            <?php $__currentLoopData = $all_popup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $popup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tab-pane fade <?php if($b == 0): ?> show active <?php endif; ?>" id="slider_tab_<?php echo e($key); ?>" role="tabpanel" >
                                    <div class="table-wrap table-responsive">
                                        <table class="table table-default" id="all_blog_table">
                                            <thead>
                                            <th class="no-sort">
                                                <div class="mark-all-checkbox">
                                                    <input type="checkbox" class="all-checkbox">
                                                </div>
                                            </th>
                                            <th><?php echo e(__('ID')); ?></th>
                                            <th><?php echo e(__('Name')); ?></th>
                                            <th><?php echo e(__('Type')); ?></th>
                                            <th><?php echo e(__('Created At')); ?></th>
                                            <th><?php echo e(__('Action')); ?></th>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $popup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.bulk-delete-checkbox','data' => ['id' => $data->id]]); ?>
<?php $component->withName('bulk-delete-checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->id)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                    </td>
                                                    <td><?php echo e($data->id); ?></td>
                                                    <td><?php echo e($data->name); ?></td>
                                                    <td><?php echo e(ucwords(str_replace('_',' ',$data->type))); ?></td>
                                                    <td><?php echo e(date("d - M - Y", strtotime($data->created_at))); ?></td>
                                                    <td>
                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.delete-popover','data' => ['url' => route('admin.popup.builder.delete',$data->id)]]); ?>
<?php $component->withName('delete-popover'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.popup.builder.delete',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.edit-icon','data' => ['url' => route('admin.popup.builder.edit',$data->id)]]); ?>
<?php $component->withName('edit-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.popup.builder.edit',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                        <a class="btn btn-info btn-xs mb-3 mr-1 show_modal_demo"
                                                           href="#"
                                                           data-type="<?php echo e($data->type); ?>"
                                                           data-title="<?php echo e($data->title); ?>"
                                                           data-description="<?php echo e($data->description); ?>"
                                                           data-only_image="<?php echo e($data->only_image); ?>"
                                                           <?php
                                                               $image_url = get_attachment_image_by_id($data->only_image,'full',false);
                                                               $image_url = !empty($image_url) ? $image_url['img_url'] : '';
                                                           ?>
                                                           data-imageurl="<?php echo e($image_url); ?>"
                                                           <?php
                                                               $bg_image_url = get_attachment_image_by_id($data->background_image,'full',false);
                                                               $bg_image_url = !empty($bg_image_url) ? $bg_image_url['img_url'] : '';
                                                           ?>
                                                           data-background_image="<?php echo e($bg_image_url); ?>"
                                                           data-button_text="<?php echo e($data->button_text); ?>"
                                                           data-button_link="<?php echo e($data->button_link); ?>"
                                                           data-btn_status="<?php echo e($data->btn_status); ?>"
                                                           data-offer_time_end="<?php echo e($data->offer_time_end); ?>"
                                                        >
                                                            <i class="ti-eye"></i>
                                                        </a>
                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.clone-icon','data' => ['action' => route('admin.popup.builder.clone',$data->id),'id' => $data->id]]); ?>
<?php $component->withName('clone-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.popup.builder.clone',$data->id)),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data->id)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php $b++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nx-popup-backdrop"></div>
    <div class="nx-popup-wrapper ">
        <div class="nx-modal-content-wrapper">
            <div class="nx-modal-inner-content-wrapper">
                <div class="nx-popup-close">&times;</div>
                <div class="nx-modal-content">
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo $__env->make('backend.partials.datatable.script-enqueue', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('backend.partials.bulk-action.script-enqueue', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="<?php echo e(asset('assets/common/js/countdown.jquery.js')); ?>"></script>
    <script>
        (function($){
        "use strict";
        $(document).ready(function() {
            function removeTags(str) {
              if ((str===null) || (str==='')){
                   return false;
              }
              str = str.toString();
              return str.replace( /(<([^>]+)>)/ig, '');
           }
   
            $(document).on('click','.show_modal_demo',function (e) {
                e.preventDefault();
                var el = $(this);
                var type = el.data('type');
                setTimeout(function () {
                    $('.nx-popup-backdrop').addClass('show');
                    $('.nx-popup-wrapper').addClass('show');
                });
                showPopupDemo(type,el);

            });
            function showPopupDemo(type,el){
                if(type == 'notice'){
                    $('.nx-popup-wrapper').addClass('notice-modal');
                    $('.nx-modal-content').html(' <div class="notice-modal-content-wrapper">\n' +
                        '<div class="right-side-content">\n' +
                        '<h4 class="title">'+removeTags(el.data('title'))+'</h4>\n' +
                        '<p>'+removeTags(el.data('description'))+'</p>\n' +
                        '</div>\n' +
                        '</div>');
                }else if(type == 'only_image'){
                    $('.nx-popup-wrapper').addClass('only-image-modal');
                    $('.nx-popup-wrapper.only-image-modal .nx-modal-inner-content-wrapper').css({
                        'background-image' : 'url('+el.data('imageurl')+')'
                    });
                }else if(type == 'promotion'){

                    $('.nx-popup-wrapper').addClass('promotion-modal');
                    $('.nx-popup-wrapper.promotion-modal .nx-modal-inner-content-wrapper').css({
                        'background-image' : 'url('+el.data('background_image')+')'
                    })
                    $('.nx-modal-content').html('<div class="promotional-modal-content-wrapper">\n' +
                        '<div class="left-content-warp">\n' +
                        '<img src="'+el.data('imageurl')+'" alt="">\n' +
                        '</div>\n' +
                        '<div class="right-content-warp">\n' +
                        '<div class="right-content-inner-wrap">\n' +
                        '<h4 class="title">'+removeTags(el.data('title'))+'</h4>\n' +
                        '<p>'+removeTags(el.data('description'))+'</p>\n' +
                        '</div>\n' +
                        '</div>\n' +
                        '</div>');

                    if(el.data('btn_status') == 'on'){
                        $('.promotional-modal-content-wrapper .right-content-warp .right-content-inner-wrap').append('<div class="btn-wrapper"><a href="'+removeTags(el.data('button_link'))+'" class="btn-boxed">'+removeTags(el.data('button_text'))+'</a></div>');
                    }

                }else{
                    $('.nx-popup-wrapper').addClass('discount-modal');
                    $('.nx-popup-wrapper.discount-modal .nx-modal-inner-content-wrapper').css({
                        'background-image' : 'url('+el.data('background_image')+')'
                    })
                    $('.nx-modal-content').html('<div class="discount-modal-content-wrapper">\n' +
                        '<div class="left-content-warp">\n' +
                        '<img src="'+el.data('imageurl')+'" alt="">\n' +
                        '</div>\n' +
                        '<div class="right-content-warp">\n' +
                        '<div class="right-content-inner-wrap">\n' +
                        '<h4 class="title">'+removeTags(el.data('title'))+'</h4>\n' +
                        '<p>'+removeTags(el.data('description'))+'</p>\n' +
                        '</div>\n' +
                        '</div>\n' +
                        '</div>');
                    if(el.data('offer_time_end')){
                        $('.discount-modal-content-wrapper .right-content-warp .right-content-inner-wrap').append('<div class="countdown-wrapper"><div id="countdown"></div></div>');
                    }
                    if(el.data('btn_status') == 'on'){
                        $('.discount-modal-content-wrapper .right-content-warp .right-content-inner-wrap').append('<div class="btn-wrapper"><a href="'+removeTags(el.data('button_link'))+'" class="btn-boxed">'+removeTags(el.data('button_text'))+'</a></div>');
                    }

                    var offerTime = el.data('offer_time_end');
                    var year = offerTime.substr(0,4);
                    var month = offerTime.substr(5,2);
                    var day = offerTime.substr(8,2);

                    $('#countdown').countdown({
                        year: year,
                        month: month,
                        day: day,
                        labels: true,
                        labelText: {
                            'days': "<?php echo e(__('days')); ?>",
                            'hours': "<?php echo e(__('hours')); ?>",
                            'minutes': "<?php echo e(__('min')); ?>",
                            'seconds': "<?php echo e(__('sec')); ?>",
                        }
                    });

                }
            }

            $(document).on('click','.nx-popup-close,.nx-popup-backdrop',function (e) {
                e.preventDefault();
                $('.nx-modal-inner-content-wrapper').removeAttr('style');
                $('.nx-modal-content').html('');
                $('.nx-popup-wrapper').removeClass('only-image-modal');
                $('.nx-popup-wrapper').removeClass('notice-modal');
                $('.nx-popup-backdrop').removeClass('show');
                $('.nx-popup-wrapper').removeClass('show');

            });
        } );      
        })(jQuery);

       
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/backend/general-settings/popup-all.blade.php ENDPATH**/ ?>