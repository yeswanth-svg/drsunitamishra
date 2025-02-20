<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Tags:')); ?> <?php echo e(' '.$tag_name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
<?php echo e(ucfirst($tag_name)); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="blog-content-area padding-120 ">
    <div class="container margin-bottom-120">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <?php if(count($all_blogs) < 1): ?>
                        <div class="col-lg-12">
                            <div class="alert alert-danger">
                                <?php echo e(__('Nothing found')); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(count($all_blogs) < 1): ?>
                            <div class="col-lg-12">
                                <div class="alert alert-warning alert-block col-md-12">
                                    <strong><div class="error-message"><span><?php echo e(__('No Post Available In :').' '.$tag_name.__('Tag')); ?></span></div></strong>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php $__currentLoopData = $all_blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="blog-classic-item-01 margin-bottom-60">
                            <div class="thumbnail">
                                <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                <div class="news-date">
                                    <h5 class="title"><?php echo e(date('d',strtotime($data->created_at))); ?></h5>
                                    <span><?php echo e(date('M',strtotime($data->created_at))); ?></span>
                                </div>
                            </div>
                            <div class="content">
                                <ul class="post-meta">
                                    <li><i class="far fa-user"></i> <?php echo e(($data->author) ?? __("Anonymous")); ?></li>
                                    <li><i class="far fa-calendar-alt"></i> <?php echo e($data->created_at->diffForHumans()); ?></li>
                                </ul>
                                <h4 class="title"><a href="<?php echo e(route('frontend.blog.single',['slug' => $data->slug,'id' => $data->blog_id])); ?>"><?php echo e($data->title); ?>

                                </a></h4>
                                <p><?php echo \Str::words(strip_tags($data->content),52,''); ?></p>
                                <div class="btn-wrapper">
                                    <a href="<?php echo e(route('frontend.blog.single',['slug' => $data->slug, 'id' => $data->blog_id])); ?>" class="boxed-btn"><?php echo e(__('Read More')); ?></a>
                                </div>
                            </div>
                        </div> 
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="col-lg-12">
                    <nav class="pagination-wrapper" aria-label="Page navigation ">
                       <?php echo e($all_blogs->links()); ?>

                    </nav>
                </div>
            </div>
            <div class="col-lg-4 mb-5">
                <div class="widget-area">
                    <?php echo $__env->make('frontend.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/pages/blog-tags.blade.php ENDPATH**/ ?>