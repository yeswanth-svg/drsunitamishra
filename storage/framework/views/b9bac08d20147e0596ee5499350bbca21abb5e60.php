<?php if(session()->has('msg')): ?>
    <div class="alert alert-<?php echo e(session('type')); ?>">
        <?php echo Purifier::clean(session('msg')); ?>

    </div>
<?php endif; ?>
<?php /**PATH /home/drsunitamishra.com/public_html/resources/views/components/msg/success.blade.php ENDPATH**/ ?>