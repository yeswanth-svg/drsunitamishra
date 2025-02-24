<?php $__env->startSection('site-title'); ?>
    <?php echo e(get_static_option('appointment_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(get_static_option('appointment_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e(get_static_option('appointment_page_'.$user_select_lang_slug.'_meta_description')); ?>">
    <meta name="tags" content="<?php echo e(get_static_option('appointment_page_'.$user_select_lang_slug.'_meta_tags')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="appointment-content-area padding-top-120 padding-bottom-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="top-search-wrapper">
                        <div class="right-part">
                            <select name="category" class="form-control">
                                <option value=""><?php echo e(__("select category")); ?></option>
                                <?php $__currentLoopData = $category_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if($category->id == $cat_id): ?> selected <?php endif; ?> value="<?php echo e($category->id); ?>"><?php echo e(optional($category->lang_front)->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <select name="sorting" class="form-control">
                                <option <?php if($sort === 'latest'): ?> selected <?php endif; ?> value="latest"><?php echo e(__("Latest")); ?></option>
                                <option <?php if($sort === 'oldest'): ?> selected <?php endif; ?> value="oldest"><?php echo e(__("Oldest")); ?></option>
                                <option <?php if($sort === 'top_rated'): ?> selected <?php endif; ?> value="top_rated"><?php echo e(__("Best Rated")); ?></option>
                                <option <?php if($sort === 'low_price'): ?> selected <?php endif; ?> value="low_price"><?php echo e(__("Low Price")); ?></option>
                                <option <?php if($sort === 'high_price'): ?> selected <?php endif; ?> value="high_price"><?php echo e(__("High Price")); ?></option>
                            </select>
                        </div>
                        <div class="left-part">
                            <div class="search-wrapper">
                                <form method="get">
                                    <input type="hidden" name="cat" value="<?php echo e($cat_id); ?>">
                                    <input type="hidden" name="sort" value="<?php echo e($sort); ?>">
                                    <div class="form-group search-box">
                                        <input type="text" class="form-control" name="s" placeholder="<?php echo e(__('Search')); ?>" value="<?php echo e($search_term); ?>">
                                        <button class="boxed-btn"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php $__currentLoopData = $all_appointment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(optional($data->lang_front) != null): ?>
                    <div class="col-lg-4">
                        <div class="appointment-single-item">
                            <div class="thumb"
                            <?php echo render_background_image_markup_by_attachment_id($data->image,'','grid'); ?>

                                >
                                <div class="cat">
                                    <a href="<?php echo e(route('frontend.appointment.category',['id' => $data->categories_id,'any' => Str::slug($data->category_front->name ?? __("Uncategorized"))])); ?>"><?php echo e($data->category_front->name ?? __("Uncategorized")); ?></a>
                                </div>
                            </div>
                            <div class="content">
                               <div class="top-part">
                                   <?php if(!empty(optional($data->lang_front)->designation)): ?>
                                       <span class="designation"><?php echo e(optional($data->lang_front)->designation); ?></span>
                                   <?php endif; ?>
                                   <?php if(count($data->reviews) > 0): ?>
                                       <div class="rating-wrap">
                                           <div class="ratings">
                                               <span class="hide-rating"></span>
                                               <span class="show-rating" style="width: <?php echo e(get_appointment_ratings_avg_by_id($data->id) / 5 * 100); ?>%"></span>
                                           </div>
                                           <p><span class="total-ratings">(<?php echo e(count($data->reviews)); ?>)</span></p>
                                       </div>
                                   <?php endif; ?>
                               </div>
                                <a href="<?php echo e(route('frontend.appointment.single',['slug' => optional($data->lang_front)->slug ?? 'x', 'id' => $data->id])); ?>"><h4 class="title"><?php echo e(optional($data->lang_front)->title); ?></h4></a>
                                <?php if(!empty(optional($data->lang_front)->location)): ?>
                                    <span class="location"><i class="fas fa-map-marker-alt"></i><?php echo e(optional($data->lang_front)->location); ?></span>
                                <?php endif; ?>

                                <p><?php echo e(Str::words(strip_tags(optional($data->lang_front)->short_description),10)); ?></p>
                                <div class="btn-wrapper">
                                    <a href="<?php echo e(route('frontend.appointment.single',['slug' => optional($data->lang_front)->slug ?? 'x', 'id' => $data->id])); ?>" class="boxed-btn"><?php echo e(get_static_option('appointment_page_'.$user_select_lang_slug.'_booking_button_text')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $show = 1 ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                <?php if(!isset($show)): ?>        
                <div class="col-lg-12 text-center">
                    <div class="alert alert-warning"><?php echo e(__('nothing found')); ?> <strong><?php echo e($search_term); ?></strong></div>
                 </div>
                <?php endif; ?>        
                <div class="col-lg-12 text-center">
                    <nav class="pagination-wrapper " aria-label="Page navigation ">
                        <?php echo e($all_appointment->links()); ?>

                    </nav>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        (function($) {
            'use strict';
            $(document).on('change','select[name="sorting"]',function (e){
                e.preventDefault();
                $('input[name="sort"]').val($(this).val());
            })
            $(document).on('change','select[name="category"]',function (e){
                e.preventDefault();
                $('input[name="cat"]').val($(this).val());
            })
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/pages/appointment/appointment-all.blade.php ENDPATH**/ ?>