
<?php $__env->startSection('site-title'); ?>
    <?php echo e(get_static_option('blog_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(get_static_option('blog_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
<meta name="description" content="<?php echo e(get_static_option('blog_page_'.$user_select_lang_slug.'_meta_description')); ?>">
<meta name="tags" content="<?php echo e(get_static_option('blog_page_'.$user_select_lang_slug.'_meta_tags')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-content our-attoryney padding-top-120 padding-bottom-10">
    <div class="container margin-bottom-120">
        <div class="row">
            <?php if(count($all_blogs) < 1): ?>
                <div class="col-lg-8">
                    <div class="alert alert-warning alert-block col-md-12">
                        <strong><div class="error-message"><span><?php echo e(__('No posts available')); ?></span></div></strong>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-lg-8">
                <?php $__currentLoopData = $all_blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="blog-classic-item-01 margin-bottom-60">
                            <div class="thumbnail">
                                <?php echo render_image_markup_by_attachment_id(optional($data->lang_front)->image); ?>

                                <div class="news-date">
                                    <h5 class="title"><?php echo e(date('d',strtotime(optional($data->lang_front)->created_at))); ?></h5>
                                    <span><?php echo e(date('M',strtotime(optional($data->lang_front)->created_at))); ?></span>
                                </div>
                            </div>
                            <div class="content">
                                <ul class="post-meta">
                                    <li><i class="far fa-user"></i> <?php echo e((optional($data->lang_front)->author) ?? __("Anonymous")); ?></li>
                                    <li><i class="far fa-calendar-alt"></i> <?php echo e(optional(optional($data->lang_front)->created_at)->diffForHumans()); ?></li>
                                </ul>
                                <h4 class="title"><a href="<?php echo e(route('frontend.blog.single',['slug' => optional($data->lang_front)->slug ?? 'x', 'id' => $data->id])); ?>"><?php echo e(optional($data->lang_front)->title); ?>

                                </a></h4>
                                
                                <div class="btn-wrapper">
                                    <a href="<?php echo e(route('frontend.blog.single',['slug' => optional($data->lang_front)->slug ?? 'x', 'id' => $data->id])); ?>" class="boxed-btn"><?php echo e(__('Read More')); ?></a>
                                </div>
                            </div>
                        </div> 
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="blog-pagination desktop-center">
                        <?php echo e($all_blogs->links()); ?>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="widget-area">
                    <?php echo $__env->make('frontend.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/pages/blog.blade.php ENDPATH**/ ?>