<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Header Settings')); ?>

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
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.datatable.css','data' => []]); ?>
<?php $component->withName('datatable.css'); ?>
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
        <div class="col-lg-6 mt-t">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title"><?php echo e(__('All Header Slider')); ?></h4>
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
                        <?php $__currentLoopData = $all_header_slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if($a == 0): ?> active <?php endif; ?>"  data-toggle="tab" href="#slider_tab_<?php echo e($key); ?>" role="tab" aria-controls="home" aria-selected="true"><?php echo e(get_language_by_slug($key)); ?></a>
                        </li>
                            <?php $a++; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <div class="tab-content margin-top-40" id="myTabContent">
                        <?php $b=0; ?>
                        <?php $__currentLoopData = $all_header_slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="tab-pane fade <?php if($b == 0): ?> show active <?php endif; ?>" id="slider_tab_<?php echo e($key); ?>" role="tabpanel" >
                           <div class="table-wrap table-responsive">
                               <table class="table table-default">
                                   <thead>
                                   <th class="no-sort">
                                       <div class="mark-all-checkbox">
                                           <input type="checkbox" class="all-checkbox">
                                       </div>
                                   </th>
                                   <th><?php echo e(__('ID')); ?></th>
                                   <th><?php echo e(__('Image')); ?></th>
                                   <th><?php echo e(__('Title')); ?></th>
                                   <th><?php echo e(__('Action')); ?></th>
                                   </thead>
                                   <tbody>
                                   <?php $__currentLoopData = $slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <tr>
                                           <td><?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
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
<?php endif; ?></td>
                                           <td><?php echo e($data->id); ?></td>
                                           <td><?php $img = get_attachment_image_by_id($data->image,null,true); ?>
                                            <?php if(!empty($img)): ?>
                                                <div class="attachment-preview">
                                                    <div class="thumbnail">
                                                        <div class="centered">
                                                            <img class="avatar user-thumb" src="<?php echo e($img['img_url']); ?>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php  $img_url = $img['img_url']; ?>
                                            <?php endif; ?>
                                           </td>
                                           <td><?php echo e(($home_page_variant_number == '02')? $data->title_ext : $data->title); ?></td>
                                           <td>
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.delete-popover','data' => ['url' => route('admin.home.header.delete',$data->id)]]); ?>
<?php $component->withName('delete-popover'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.home.header.delete',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                <a href="#"
                                                    data-toggle="modal"
                                                    data-target="#header_slider_item_edit_modal"
                                                    class="btn btn-lg btn-primary btn-sm mb-3 mr-1 header_slider_edit_btn"
                                                    data-id="<?php echo e($data->id); ?>"
                                                    data-title="<?php echo e($data->title); ?>"
                                                    data-subtitle="<?php echo e($data->subtitle); ?>"
                                                    data-title_ext="<?php echo e($data->title_ext); ?>"
                                                    data-subtitle_ext="<?php echo e($data->subtitle_ext); ?>"
                                                    data-details="<?php echo e($data->details); ?>"
                                                    data-btn_text="<?php echo e($data->btn_text); ?>"
                                                    data-btn_url="<?php echo e($data->btn_url); ?>"
                                                    data-support_title="<?php echo e($data->support_title); ?>"
                                                    data-support_details="<?php echo e($data->support_details); ?>"
                                                    data-icon="<?php echo e($data->icon); ?>"
                                                    data-btn_status="<?php echo e($data->btn_status); ?>"
                                                    data-imageid="<?php echo e($data->image); ?>"
                                                    data-image="<?php echo e($img_url); ?>"
                                                    data-lang="<?php echo e($data->lang); ?>">
                                                    <i class="ti-pencil"></i>
                                                </a>
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
        <div class="col-lg-6 mt-t">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title"><?php echo e(__('New Header Slider')); ?></h4>
                    <form action="<?php echo e(route('admin.home.header')); ?>" method="post" enctype="multipart/form-data"><?php echo csrf_field(); ?>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.add-language','data' => []]); ?>
<?php $component->withName('add-language'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        
                        <?php if($home_page_variant_number == '02'): ?>
                        <div class="form-group">
                            <label for="title_ext"><?php echo e(__('Title')); ?></label>
                            <input type="text" class="form-control"  id="title_ext"  name="title_ext" placeholder="<?php echo e(__('Title')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="subtitle_ext"><?php echo e(__('Sub Title')); ?></label>
                            <input type="text" class="form-control"  id="subtitle_ext"  name="subtitle_ext" placeholder="<?php echo e(__('Sub Title')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="details"><?php echo e(__('Details')); ?></label>
                            <input type="text" class="form-control"  id="details"  name="details" placeholder="<?php echo e(__('Details')); ?>">
                        </div>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.add-icon','data' => ['name' => 'icon','id' => 'icon','title' => __('Icon')]]); ?>
<?php $component->withName('add-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('icon'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('icon'),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Icon'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <?php else: ?>
                        <div class="form-group">
                            <label for="title"><?php echo e(__('Title')); ?></label>
                            <input type="text" class="form-control"  id="title"  name="title" placeholder="<?php echo e(__('Title')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="subtitle"><?php echo e(__('Sub Title')); ?></label>
                            <input type="text" class="form-control"  id="subtitle"  name="subtitle" placeholder="<?php echo e(__('Sub Title')); ?>">
                        </div>
                        <?php endif; ?>
                        <?php if($home_page_variant_number != '02'): ?>
                        <div class="form-group">
                            <label for="support_title"><?php echo e(__('Support Title')); ?></label>
                            <input type="text" class="form-control"  id="support_title"  name="support_title" placeholder="<?php echo e(__('Support Title')); ?>">
                        </div>
                        <div class="form-group">
                            <label for="support_details"><?php echo e(__('Support Details')); ?></label>
                            <input type="text" class="form-control"  id="support_details"  name="support_details" placeholder="<?php echo e(__('Support Details')); ?>">
                        </div>
                        <?php endif; ?>
                        <?php if(in_array($home_page_variant_number,['01','03'])): ?>
                        <div class="form-group">
                            <label for="btn_status"><?php echo e(__('Button Show/Hide')); ?></label>
                            <label class="switch">
                                <input type="checkbox" name="btn_status" id="btn_status">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="row">
                            <div class="form-group  col-md-6">
                                <label for="btn_text"><?php echo e(__('Button Text')); ?></label>
                                <input type="text" class="form-control"  id="btn_text"  name="btn_text" placeholder="<?php echo e(__('Button Text')); ?>">
                            </div>
                            <div class="form-group  col-md-6">
                                <label for="btn_url"><?php echo e(__('Button URL')); ?></label>
                                <input type="text" class="form-control"  id="btn_url"  name="btn_url" placeholder="<?php echo e(__('Button URL')); ?>">
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="image"><?php echo e(__('Image')); ?></label>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.image','data' => ['id' => 'image','name' => 'image','value' => 'image']]); ?>
<?php $component->withName('image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('image'),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('image'),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('image')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            <small class="form-text text-danger"><?php echo e(__('* jpg,jpeg,png')); ?></small>
                        </div>
                        <button type="submit" id="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Submit')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="header_slider_item_edit_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo e(__('Edit Header Slider Item')); ?></h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <form action="<?php echo e(route('admin.home.header.update')); ?>" id="header_slider_edit_modal_form"  method="post" enctype="multipart/form-data"><?php echo csrf_field(); ?>
                <div class="modal-body">
                    <input type="hidden" name="id" id="header_slider_id" value="">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.edit-language','data' => []]); ?>
<?php $component->withName('edit-language'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    <?php if($home_page_variant_number == '02'): ?>
                    <div class="form-group">
                        <label for="title_ext"><?php echo e(__('Title')); ?></label>
                        <input type="text" class="form-control"  id="edit_title_ext"  name="title_ext" placeholder="<?php echo e(__('Title')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="subtitle_ext"><?php echo e(__('Sub Title')); ?></label>
                        <input type="text" class="form-control"  id="edit_subtitle_ext"  name="subtitle_ext" placeholder="<?php echo e(__('Sub Title')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="details"><?php echo e(__('Details')); ?></label>
                        <input type="text" class="form-control"  id="edit_details"  name="details" placeholder="<?php echo e(__('Details')); ?>">
                    </div>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.add-icon','data' => ['name' => 'icon','id' => 'edit_icon','title' => __('Icon')]]); ?>
<?php $component->withName('add-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('icon'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('edit_icon'),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Icon'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    <?php else: ?>
                    <div class="form-group">
                        <label for="title"><?php echo e(__('Title')); ?></label>
                        <input type="text" class="form-control"  id="edit_title"  name="title" placeholder="<?php echo e(__('Title')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="subtitle"><?php echo e(__('Sub Title')); ?></label>
                        <input type="text" class="form-control"  id="edit_subtitle"  name="subtitle" placeholder="<?php echo e(__('Sub Title')); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if($home_page_variant_number != '02'): ?>
                    <div class="form-group">
                        <label for="support_title"><?php echo e(__('Support Title')); ?></label>
                        <input type="text" class="form-control"  id="edit_support_title"  name="support_title" placeholder="<?php echo e(__('Support Title')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="support_details"><?php echo e(__('Support Details')); ?></label>
                        <input type="text" class="form-control"  id="edit_support_details"  name="support_details" placeholder="<?php echo e(__('Support Details')); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if(in_array($home_page_variant_number,['01','03'])): ?>
                    <div class="form-group">
                        <label for="btn_status"><?php echo e(__('Button Show/Hide')); ?></label>
                        <label class="switch">
                            <input type="checkbox" name="btn_status" id="edit_btn_status">
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="row">
                        <div class="form-group  col-md-6">
                            <label for="btn_text"><?php echo e(__('Button Text')); ?></label>
                            <input type="text" class="form-control"  id="edit_btn_text"  name="btn_text" placeholder="<?php echo e(__('Button Text')); ?>">
                        </div>
                        <div class="form-group  col-md-6">
                            <label for="btn_url"><?php echo e(__('Button URL')); ?></label>
                            <input type="text" class="form-control"  id="edit_btn_url"  name="btn_url" placeholder="<?php echo e(__('Button URL')); ?>">
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="image"><?php echo e(__('Image')); ?></label>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.image','data' => ['id' => 'image','name' => 'image','value' => 'image']]); ?>
<?php $component->withName('image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('image'),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('image'),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('image')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        <small class="form-text text-danger"><?php echo e(__('* jpg,jpeg,png')); ?></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                    <button type="submit" id="save" class="btn btn-primary"><?php echo e(__('Save Changes')); ?></button>
                </div>
            </form>
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
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.datatable.js','data' => []]); ?>
<?php $component->withName('datatable.js'); ?>
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
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.btn.save','data' => []]); ?>
<?php $component->withName('btn.save'); ?>
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
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.btn.submit','data' => []]); ?>
<?php $component->withName('btn.submit'); ?>
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
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.bulk-action-js','data' => ['url' => route('admin.home.header.bulk.action')]]); ?>
<?php $component->withName('bulk-action-js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.home.header.bulk.action'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        $(document).on('click','.header_slider_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var imageid = el.data('imageid');
                var image = el.data('image');
                var action = el.data('action');
                var form = $('#header_slider_edit_modal_form');
                form.attr('action',action);
                form.find('#header_slider_id').val(id);
                form.find('#edit_title').val(el.data('title'));
                form.find('#edit_subtitle').val(el.data('subtitle'));
                form.find('#edit_title_ext').val(el.data('title_ext'));
                form.find('#edit_subtitle_ext').val(el.data('subtitle_ext'));
                form.find('#edit_details').val(el.data('details'));
                form.find('#edit_btn_text').val(el.data('btn_text'));
                form.find('#edit_btn_url').val(el.data('btn_url'));
                form.find('#edit_btn_status').val(el.data('btn_status'));
                form.find('#edit_icon').val(el.data('icon'));
                form.find('#edit_support_title').val(el.data('support_title'));
                form.find('#edit_support_details').val(el.data('support_details'));
                form.find('#edit_language option[value='+el.data("lang")+']').attr('selected',true);
                form.find('.icp-dd').attr('data-selected',el.data('icon'));
                form.find('.iconpicker-component i').attr('class',el.data('icon'));
                if(imageid != ''){
                    form.find('.media-upload-btn-wrapper .img-wrap').html('<div class="attachment-preview"><div class="thumbnail"><div class="centered"><img class="avatar user-thumb" src="'+image+'" > </div></div></div>');
                    form.find('.media-upload-btn-wrapper input').val(imageid);
                    form.find('.media-upload-btn-wrapper .media_upload_form_btn').text('Change Image');
                }
                if(el.data('btn_status') == 'on'){
                    $('#edit_btn_status').prop('checked',true);
                }else{
                    $('#edit_btn_status').prop('checked',false);
                }
            });
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

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/backend/pages/home-page-manage/header.blade.php ENDPATH**/ ?>