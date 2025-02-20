<div class="topbar-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="topbar-inner">
                    <div class="left-contnet">
                        <ul class="info-items">
                            <?php $__currentLoopData = $all_topbar_infos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($user_select_lang_slug == $item->lang): ?>
                                    <li><i class="<?php echo e($item->icon); ?>"></i> <?php echo e($item->details); ?></li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <div class="right-contnet">
                        <ul class="info-items">
                            <?php if(auth()->check()): ?>
                                <?php $route = auth()->guest() == 'admin' ? route('admin.home') : route('user.home'); ?>
                                <li><a href="<?php echo e($route); ?>"><?php echo e(__('Dashboard')); ?></a> </li>
                                <li>/</li>
                                 <li>
                                    <a href="<?php echo e(route('user.logout')); ?>" onclick="event.preventDefault();
                                    jQuery('#userlogout-form-submit-btn').trigger('click');">
                                        <?php echo e(__('Logout')); ?>

                                    </a>
                                    <form id="userlogout-form" action="<?php echo e(route('user.logout')); ?>" method="POST"
                                        class="d-none">
                                        <?php echo csrf_field(); ?>
                                        <input type="submit" value="dd" id="userlogout-form-submit-btn" class="d- none">
                                    </form>
                                </li>
                            <?php else: ?>
                                <li><a href="<?php echo e(route('user.login')); ?>"><?php echo e(__('Login')); ?></a></li> 
                                <li>/</li>
                                <li><a href="<?php echo e(route('user.register')); ?>"><?php echo e(__('Register')); ?></a></li>
                            <?php endif; ?>
                            <?php if(!empty(get_static_option('language_select_option'))): ?>
                                <div class="language_dropdown" id="languages_selector">
                                    <div class="selected-language"><?php echo e(get_language_name_by_slug(get_user_lang())); ?> <i
                                            class="fas fa-caret-down"></i></div>
                                    <ul>
                                        <?php $__currentLoopData = $all_language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li data-value="<?php echo e($lang->slug); ?>"><?php echo e($lang->name); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/topbar.blade.php ENDPATH**/ ?>