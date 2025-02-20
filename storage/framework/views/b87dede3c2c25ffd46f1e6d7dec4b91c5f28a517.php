<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
    $statistics = [
        ['title' => 'Total Admin','value' => $total_admin, 'icon' => 'user-secret'],
        ['title' => 'Total User','value' => $total_user, 'icon' => 'user'],
        ['title' => 'Total Blogs','value' => $blog_count, 'icon' => 'blog'],
        ['title' => 'Total Key Feature','value' => $total_key_features, 'icon' => 'key'],
        ['title' => 'Total Testimonial','value' => $total_testimonial, 'icon' => 'comments'],
        ['title' => 'Total Price Plan','value' => $total_price_plan,'icon' => 'tags'],
        ['title' => 'Total Products Order','value' => $total_product_order, 'icon' => 'shopping-cart'],
        ['title' => 'Total Appointments','value' => $total_appointment, 'icon' => 'calendar-check'],
        ['title' => 'Total Services','value' => $total_services, 'icon' => 'headset'],
    ];
?>
    <div class="main-content-inner">
        <div class="row">
            <!-- seo fact area start -->
            <div class="col-lg-12">
                <div class="row">
                    <?php $__currentLoopData = $statistics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 mt-5 mb-3">
                        <div class="card card-hover">
                            <div class="dash-box text-white">
                                <h1 class="dash-icon">
                                    <i class="fas fa-<?php echo e($data['icon']); ?> mb-1 font-16"></i>
                                </h1>
                                <div class="dash-content">
                                    <h5 class="mb-0 mt-1"><?php echo e($data['value']); ?></h5>
                                    <small class="font-light"><?php echo e(__($data['title'])); ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card margin-top-40">
                    <div class="smart-card">
                        <h4 class="title"><?php echo e(__('Recent Product Order')); ?></h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th><?php echo e(__('Order ID')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                    <th><?php echo e(__('Payment Gateway')); ?></th>
                                    <th><?php echo e(__('Payment Status')); ?></th>
                                    <th><?php echo e(__('Date')); ?></th>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $product_recent_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>#<?php echo e($data->id); ?></td>
                                            <td><?php echo e(amount_with_currency_symbol($data->total)); ?></td>
                                            <td><?php echo e(str_replace('_',' ',$data->payment_gateway)); ?></td>
                                            <td>
                                                <?php $pay_status = $data->payment_status; ?>
                                                <?php if($pay_status == 'complete'): ?>
                                                    <span class="alert alert-success"><?php echo e($pay_status); ?></span>
                                                <?php elseif($pay_status == 'pending'): ?>
                                                    <span class="alert alert-warning"><?php echo e($pay_status); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e(date_format($data->created_at,'d M Y h:i:s')); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card margin-top-40">
                    <div class="smart-card">
                        <h4 class="title"><?php echo e(__('Recent Package Order')); ?></h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <th><?php echo e(__('Order ID')); ?></th>
                                <th><?php echo e(__('Package Name')); ?></th>
                                <th><?php echo e(__('Payment Status')); ?></th>
                                <th><?php echo e(__('Date')); ?></th>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $package_recent_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>#<?php echo e($data->id); ?></td>
                                        <td><?php echo e($data->package_name); ?></td>
                                        <td>
                                            <?php $pay_status = $data->payment_status; ?>
                                            <?php if($pay_status == 'complete'): ?>
                                                <span class="alert alert-success"><?php echo e($pay_status); ?></span>
                                            <?php elseif($pay_status == 'pending'): ?>
                                                <span class="alert alert-warning"><?php echo e($pay_status); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(date_format($data->created_at,'d M Y h:i:s')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/backend/admin-home.blade.php ENDPATH**/ ?>