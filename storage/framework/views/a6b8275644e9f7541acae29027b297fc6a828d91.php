<script>
    (function (){
        "use strict";
        $(document).on('click', '#login_btn', function (e) {
        e.preventDefault();
        var formContainer = $(this).parent().parent();
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

    })(jQuery)
</script><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/ajax-form/ajax-login-form-js.blade.php ENDPATH**/ ?>