<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.success','data' => []]); ?>
<?php $component->withName('msg.success'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.msg.error','data' => []]); ?>
<?php $component->withName('msg.error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<form action="<?php echo e(route('frontend.quote.message')); ?>" method="POST" class="request-page-form <?php echo e(($home_variant_number == '03')? 'style-01' : ''); ?>" enctype="multipart/form-data" id="quote_form"><?php echo csrf_field(); ?>
    <?php echo render_form_field_for_frontend(get_static_option('quote_page_form_fields')); ?>

    <input type="hidden" name="captcha_token" id="gcaptcha_token">
        <div class="form-group">
            <input type="submit" id="quote_submit_btn" value="<?php echo e(get_static_option('home_page_quote_section_'.$user_select_lang_slug.'_btn_text')); ?>" class="submit-btn">
        </div>
</form><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/quote-form/quote-form-render.blade.php ENDPATH**/ ?>