<section class="testimonial-area bg-image padding-top-110 padding-bottom-120">
    <div class="container">
        <div class="row justify-content-center padding-bottom-45">
            <div class="col-lg-8">
                <div class="section-title desktop-center">
                    <div class="icon">
                        <span class="line-one"></span>
                        <span class="line-two"></span>
                        <i class="<?php echo e(get_static_option('site_heading_icon')); ?>"></i>
                        <span class="line-three"></span>
                        <span class="line-four"></span>
                    </div>
                    <h2 class="title"><?php echo e(get_static_option('home_page_testimonial_section_'.$user_select_lang_slug.'_title')); ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="testimonial-carousel-area">
                    <div class="testimonial-carousel">
                        <?php $__currentLoopData = $all_testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="single-testimonial-item">
                            <div class="thumb bg-image" <?php echo render_background_image_markup_by_attachment_id($data->image); ?>></div>
                            <div class="content">
                                <div class="icon">
                                    <i class="flaticon-quote-left"></i>
                                </div>
                                <p class="description"><?php echo e($data->description); ?></p>
                                <div class="author-details">
                                    <div class="author-meta">
                                        <div class="ratings">
                                            <?php for($i=0; $i<$data->rating_star; $i++): ?>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <h4 class="title"> - <?php echo e($data->name); ?> 
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/testimonial/testimonial-variant-01.blade.php ENDPATH**/ ?>