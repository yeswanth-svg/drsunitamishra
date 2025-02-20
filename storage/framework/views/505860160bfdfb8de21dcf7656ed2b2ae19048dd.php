<section class="blog-area padding-top-110 padding-bottom-100 bg-liteblue">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-title-content margin-bottom-45">
                    <div class="section-title">
                        <div class="icon">
                            <i class="<?php echo e(get_static_option('site_heading_icon')); ?>"></i>
                            <span class="line-three"></span>
                            <span class="line-four"></span>
                        </div>
                        <h3 class="title"><?php echo e(get_static_option('home_page_latest_blog_section_'.$user_select_lang_slug.'_title')); ?></h3>
                    </div>
                    <div class="btn-wrapper">
                        <a href="<?php echo e(route('frontend.blog')); ?>" class="boxed-btn"><?php echo e(get_static_option('home_page_latest_blog_section_'.$user_select_lang_slug.'_subtitle')); ?></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $all_recent_blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-lg-4">
                <div class="single-blog-grid-01 margin-bottom-30">
                    <div class="thumb">
                        <?php echo render_image_markup_by_attachment_id(optional($data->blog_front)->image); ?>

                        <div class="news-date">
                            <h5 class="title"><?php echo e(date('d',strtotime(optional($data->blog_front)->created_at))); ?></h5>
                             <span><?php echo e(date('M',strtotime(optional($data->blog_front)->created_at))); ?></span>
                        </div>
                    </div>
                    <div class="content">
                        <ul class="post-meta">
                            <li><i class="far fa-user"></i> <?php echo e(optional($data->blog_front)->author ?? __("Anonymous")); ?></li>
                            <li><i class="far fa-calendar-alt"></i> <?php echo e(optional(optional($data->blog_front)->created_at)->diffForHumans()); ?></li>
                        </ul>
                        <h4 class="title"><a href="<?php echo e(route('frontend.blog.single',['slug' => optional($data->blog_front)->slug ?? 'x', 'id' => $data->id])); ?>"><?php echo e(optional($data->blog_front)->title); ?></a></h4>
                        <p><?php echo \Str::words(strip_tags(optional($data->blog_front)->content),20,''); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/blog-latest-area.blade.php ENDPATH**/ ?>