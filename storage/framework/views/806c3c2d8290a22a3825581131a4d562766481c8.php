
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Latest Blog Settings')); ?>

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
                        <h4 class="header-title"><?php echo e(__('Latest Blog Area Settings')); ?></h4>
                        <form action="<?php echo e(route('admin.home.blog.latest')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo $__env->make('backend.partials.languages-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="tab-content margin-top-20" id="nav-tabContent">
                                <?php $__currentLoopData = $all_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tab-pane fade <?php if($key == 0): ?> show active <?php endif; ?>" id="nav-home-<?php echo e($lang->slug); ?>" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="form-group">
                                        <label for="home_page_latest_blog_section_<?php echo e($lang->slug); ?>_title"><?php echo e(__('Title')); ?></label>
                                        <input type="text" class="form-control" name="home_page_latest_blog_section_<?php echo e($lang->slug); ?>_title" value="<?php echo e(get_static_option('home_page_latest_blog_section_'.$lang->slug.'_title')); ?>" placeholder="<?php echo e(__('Title')); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_latest_blog_section_<?php echo e($lang->slug); ?>_subtitle"><?php echo e(__('Sub Title')); ?></label>
                                        <input type="text" class="form-control" name="home_page_latest_blog_section_<?php echo e($lang->slug); ?>_subtitle" value="<?php echo e(get_static_option('home_page_latest_blog_section_'.$lang->slug.'_subtitle')); ?>" placeholder="<?php echo e(__('Sub Title')); ?>">
                                    </div>
                                </div>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               <div class="form-group">
                                    <label for="home_page_latest_blog_section_display_item"><?php echo e(__('Number of Item Display')); ?></label>
                                    <input type="number" class="form-control" name="home_page_latest_blog_section_display_item" value="<?php echo e(get_static_option('home_page_latest_blog_section_display_item')); ?>" placeholder="<?php echo e(__('Number of Item Display')); ?>">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pr-4 pl-4"><?php echo e(__('Update Settings')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/backend/pages/home-page-manage/latest-blog-settings.blade.php ENDPATH**/ ?>