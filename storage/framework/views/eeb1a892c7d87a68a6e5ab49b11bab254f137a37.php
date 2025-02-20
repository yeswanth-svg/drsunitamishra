
<?php $__env->startSection('site-title'); ?>
    <?php echo e(optional($blog_post->lang_front)->meta_title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(optional($blog_post->lang_front)->title); ?>   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
<meta name="title" content="<?php echo e(optional($blog_post->lang_front)->meta_title); ?>">
<meta name="tags" content="<?php echo e(optional($blog_post->lang_front)->meta_tags); ?> ">
<meta name="description" content="<?php echo e(optional($blog_post->lang_front)->meta_description); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('og-meta'); ?>
<meta name="og:title" content="<?php echo e(optional($blog_post->lang_front)->og_meta_title); ?>">
<meta name="og:description" content="<?php echo e(optional($blog_post->lang_front)->og_meta_description); ?>">
<?php echo render_og_meta_image_by_attachment_id(optional($blog_post->lang_front)->og_meta_image); ?>

<meta name="og:tags" content=" <?php echo e(optional($blog_post->lang_front)->meta_tags); ?>">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
        <!-- Blog Details Area -->
        <div class="page-content our-attoryney padding-bottom-20 padding-top-120">
            <div class="container margin-bottom-120">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog-details-item">
                            <div class="thumb margin-bottom-20">
                                <?php $post_img = null; ?>
                                <?php echo render_image_markup_by_attachment_id(optional($blog_post->lang_front)->image); ?>

                                <div class="news-date">
                                    <h5 class="title"><?php echo e(date('d',strtotime(optional($blog_post->lang_front)->created_at))); ?></h5>
                                    <span><?php echo e(date('M',strtotime(optional($blog_post->lang_front)->created_at))); ?></span>
                                </div>
                            </div>
                            <div class="blog-details-item-header">
                                <ul class="post-meta">
                                    <li><i class="far fa-user"></i> <?php echo e((optional($blog_post->lang_front)->author) ?? __("Anonymous")); ?></li>
                                    <li><i class="far fa-calendar-alt"></i> <?php echo e(optional(optional($blog_post->lang_front)->created_at)->diffForHumans()); ?></li>
                                </ul>
                            </div>
                            <h2 class="title"><?php echo e(Purifier::clean(optional($blog_post->lang_front)->title)); ?></h2>
                           <p><?php echo \Mews\Purifier\Facades\Purifier::clean(optional($blog_post->lang_front)->content); ?></p>
                        </div>
                        <div class="blog-details-footer">
                            <div class="left">
                                <ul class="tags">
                                    <li class="title"><?php echo e(__('Tags: ')); ?></li>
                                    <?php
                                        $all_tags = explode(',',optional($blog_post->lang_front)->tags);
                                    ?>
                                    <?php $__currentLoopData = $all_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php 
                                        $slug = Str::slug($tag);
                                        ?> 
                                        <?php if(!empty($slug)): ?>
                                            <li><a href="<?php echo e(route('frontend.blog.tags.page',['name' => $slug])); ?>"><?php echo e($tag); ?></a></li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <div class="right">
                                <div class="social-link style-02">
                                     <ul>
                                        <li class="title"><i class="fas fa-share-alt"></i><?php echo e(__('Share:')); ?></li>
                                     <?php echo \Mews\Purifier\Facades\Purifier::clean(single_post_share(route('frontend.blog.single',['id' => $blog_post->id, 'any' => Str::slug(optional($blog_post->lang_front)->title ?? 'x','-')]),optional($blog_post->lang_front)->title,$post_img)); ?>

                                    </ul>  
                                </div>
                            </div>
                        </div>
                        <div class="comments-area">
                            <div id="disqus_thread"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-5">
                        <div class="widget-area">
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        var disqus_config = function () {
        this.page.url = "<?php echo e(route('frontend.blog.single',['id' => $blog_post->id, 'any' => Str::slug(strip_tags(Purifier::clean($blog_post->title)),'-')])); ?>";
        this.page.identifier = "<?php echo e($blog_post->id); ?>";
        };

        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = "https://<?php echo e(get_static_option('site_disqus_key')); ?>.disqus.com/embed.js";
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript><?php echo e(__('Please enable JavaScript to view the')); ?> <a href="https://disqus.com/?ref_noscript"><?php echo e(__('comments powered by Disqus.')); ?></a></noscript>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/pages/blog-single.blade.php ENDPATH**/ ?>