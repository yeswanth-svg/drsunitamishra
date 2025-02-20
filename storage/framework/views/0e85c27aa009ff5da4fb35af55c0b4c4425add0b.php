<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Login')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Login')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="login-page-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 margin-top-80 margin-bottom-120">
                <div class="login-form-wrapper contact-form">
                    <h3 class="text-center title margin-bottom-30"><?php echo e(__('Login To Your Account')); ?></h3>
                    <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('backend.partials.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <form action="<?php echo e(route('user.login')); ?>" method="post" enctype="multipart/form-data" class="contact-page-form style-01" id="login_form_order_page">
                        <?php echo csrf_field(); ?>
                        <div class="error-wrap"></div>
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" placeholder="<?php echo e(__('Username')); ?>">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="<?php echo e(__('Password')); ?>">
                        </div>
                       
                        <div class="form-group btn-wrapper">
                            <a href="#" class="boxed-btn btn-block" id="login_btn" type="submit"><span><?php echo e(__('Login')); ?></span></a>
                        </div>
                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" name="remember" class="custom-control-input" id="remember">
                                    <label class="custom-control-label" for="remember"><?php echo e(__('Remember Me')); ?></label>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <a class="d-block" href="<?php echo e(route('user.register')); ?>"><?php echo e(__('Create New account?')); ?></a>
                                <a href="<?php echo e(route('user.forget.password')); ?>"><?php echo e(__('Forgot Password?')); ?></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
    (function($){
    "use strict";
    $(document).on('click', '#login_btn', function (e) {
        e.preventDefault();
        var formContainer = $('#login_form_order_page');
        var el = $(this);
        var username = formContainer.find('input[name="username"]').val();
        var password = formContainer.find('input[name="password"]').val();
        var remember = formContainer.find('input[name="remember"]').val();
        el.html('<i class="fas fa-spinner fa-spin mr-1"></i> <?php echo e(__("Please Wait")); ?>');
        $.ajax({
            type: 'post',
            url: "<?php echo e(route('user.ajax.login')); ?>",
            data: {
                _token: "<?php echo e(csrf_token()); ?>",
                username : username,
                password : password,
                remember : remember,
            },
            success: function (data){
                if(data.status == 'invalid'){
                    el.text('<?php echo e(__("Login")); ?>')
                    formContainer.find('.error-wrap').html('<div class="alert alert-danger list-none">'+data.msg+'</div>');
                }else{
                    formContainer.find('.error-wrap').html('');
                    el.text('<?php echo e(__("Login Success.. Redirecting ..")); ?>');
                    location.reload();
                }
            },
            error: function (data){
                var response = data.responseJSON.errors;
                formContainer.find('.error-wrap').html('<ul class="alert alert-danger list-none"></ul>');
                $.each(response,function (value,index){
                    formContainer.find('.error-wrap ul').append('<li>'+index+'</li>');
                });
                el.text('<?php echo e(__("Login")); ?>');
            }
        });
    });
            
    })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/user/login.blade.php ENDPATH**/ ?>