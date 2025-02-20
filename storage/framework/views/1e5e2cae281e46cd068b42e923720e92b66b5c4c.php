<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Quote Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                       <div class="header-wrap d-flex justify-content-between margin-bottom-40">
                           <h4 class="header-title"><?php echo e(__('Quote Details')); ?></h4>
                           <a href="<?php echo e(route('admin.quote.manage.all')); ?>" class="btn btn-info"><?php echo e(__('All Quotes')); ?></a>
                       </div>
                        <div class="booking-details-info">
                            <ul>
                                <li><strong><?php echo e(__('ID')); ?></strong> : #<?php echo e($quote->id); ?></li>
                                <li><strong><?php echo e(__('Status')); ?></strong> : <?php echo e($quote->status); ?></li>
                                <?php
                                    $custom_fields = unserialize($quote->custom_fields,['class'=>false]) ?? [];
                                    $all_attachment = unserialize($quote->all_attachment,['class'=>false]) ?? [];
                                ?>
                                <?php if($custom_fields): ?>
                                <li><strong><?php echo e(__('Custom Fields')); ?></strong> :
                                    <ul>
                                        <?php $__currentLoopData = $custom_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(in_array($key,['captcha_token'])): ?>
                                                <?php continue; ?>
                                            <?php endif; ?>
                                            <li><string><?php echo e(str_replace(['_','-'],[' ',' '],$key)); ?></string> : <?php echo e(htmlspecialchars(strip_tags($item))); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                                <?php endif; ?>
                                <?php if($all_attachment): ?>)
                                    <li><strong><?php echo e(__('Attachments')); ?></strong> :
                                        <ul>
                                            <?php $__currentLoopData = $all_attachment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><string><?php echo e(str_replace(['_','-'],[' ',' '],$key)); ?></string> :
                                                    <a href="<?php echo e(asset($item)); ?>"><?php echo e($item); ?></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/backend/quote-manage/quote-manage-view.blade.php ENDPATH**/ ?>