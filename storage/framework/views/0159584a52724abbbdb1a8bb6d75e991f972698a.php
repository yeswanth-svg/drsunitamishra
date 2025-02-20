
<?php $__env->startSection('page-title'); ?>
    <?php echo e(get_static_option('contact_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('site-title'); ?>
<?php echo e(get_static_option('contact_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e(get_static_option('contact_page_'.$user_select_lang_slug.'_meta_description')); ?>">
    <meta name="tags" content="<?php echo e(get_static_option('contact_page_'.$user_select_lang_slug.'_meta_tags')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(get_static_option('contact_page_contact_section_status')): ?><!-- Contact Area -->
        <div class="contact-inner-area padding-bottom-120 padding-top-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="content-area">
                            <div class="section-title padding-bottom-25">
                                <h4 class="title"><?php echo e(get_static_option('home_page_contact_us_section_'.$user_select_lang_slug.'_title')); ?> </h4>
                            </div>
                            <div class="single-contact-item">
                                <div class="icon">
                                    <i class="flaticon-phone"></i>
                                </div>
                                <div class="content">
                                    <span class="title"><?php echo e(__('Phone')); ?></span>
                                    <p class="details">
                                        <?php $__currentLoopData = explode("\n",get_static_option('home_page_contact_us_section_'.$user_select_lang_slug.'_contact')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e($item); ?><br>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="single-contact-item">
                                <div class="icon">
                                    <i class="flaticon-mail-2"></i>
                                </div>
                                <div class="content">
                                    <span class="title"><?php echo e(__('Mail US')); ?></span>
                                    <p class="details">
                                        <?php $__currentLoopData = explode("\n",get_static_option('home_page_contact_us_section_'.$user_select_lang_slug.'_email')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e($item); ?><br>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="single-contact-item">
                                <div class="icon">
                                    <i class="flaticon-pin"></i>
                                </div>
                                <div class="content">
                                    <span class="title"><?php echo e(__('Address')); ?>

                                </span>
                                <p class="details">
                                    <?php $__currentLoopData = explode("\n",get_static_option('home_page_contact_us_section_'.$user_select_lang_slug.'_address')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($item); ?><br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 offset-lg-1">
                        <div class="contact-form style-01">
                            <form action="<?php echo e(route('frontend.contact.message')); ?>" method="POST" class="contact-page-form style-01" id="contact_us_form">
                                <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                <?php echo csrf_field(); ?>
                                <div class="error-message margin-bottom-20"> </div>
                                    <?php echo render_form_field_for_frontend(get_static_option('contact_page_contact_form_fields')); ?>

                                <div class="btn-wrapper">
                                    <a href="#" class="boxed-btn btn-block" id="contact_us_submit_btn"><span><?php echo e(__('Submit Message')); ?></span></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if(get_static_option('contact_page_map_section_status')): ?><!-- Map Area -->
        <div class="map-area">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="contact_map">
                            <?php echo render_embed_google_map(get_static_option('contact_page_map_section_location'),get_static_option('contact_page_map_section_zoom')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <?php if(!empty(get_static_option('site_google_captcha_v3_site_key'))): ?>
        <script
                src="https://www.google.com/recaptcha/api.js?render=<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>"></script>
        <script>
            (function() {
                "use strict";

                grecaptcha.ready(function () {
                    grecaptcha.execute("<?php echo e(get_static_option('site_google_captcha_v3_site_key')); ?>", {action: 'homepage'}).then(function (token) {
                        document.getElementById('gcaptcha_token').value = token;
                    });
                });
            })();
        </script>
    <?php endif; ?>
    <script>
        (function($){
        "use strict";
        $(document).ready(function () {
            function removeTags(str) {
              if ((str===null) || (str==='')){
                   return false;
              }
              str = str.toString();
              return str.replace( /(<([^>]+)>)/ig, '');
           }
       
            $(document).on('click', '#contact_us_submit_btn', function (e) {
                e.preventDefault();
                var el = $(this);
                var myForm = document.getElementById('contact_us_form');
                var formData = new FormData(myForm);
                $.ajax({
                    type: "POST",
                    url: "<?php echo e(route('frontend.contact.message')); ?>",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        el.html('<i class="fas fa-spinner fa-spin mr-1"></i> <?php echo e(__("Submitting")); ?>');
                    },
                    success: function (data) {
                        var errMsgContainer = $('#contact_us_form').find('.error-message');
                        errMsgContainer.html('');
                        errMsgContainer.html('<div class="alert alert-'+data.type+'">'+removeTags(data.msg)+'</div>');
                        $('#contact_us_form').find('.form-control').val('');
                        el.text('<?php echo e(__("Submit")); ?>');
                    },
                    error: function (data) {
                        var error = data.responseJSON;
                        var errMsgContainer = $('#contact_us_form').find('.error-message');
                        errMsgContainer.html('<div class="alert alert-danger"></div>');
                        $.each(error.errors,function (index,value) {
                            errMsgContainer.find('.alert').append('<span>'+removeTags(value)+'</span>');
                        });
                        el.text('<?php echo e(__("Submit")); ?>');
                    }
                });
            });
        }); 
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/pages/contact-page.blade.php ENDPATH**/ ?>