<form action="<?php echo e($action); ?>" method="post" style="display: inline-block">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="item_id" value="<?php echo e($id); ?>">
    <button type="submit" title="clone this to new draft" class="btn btn-xs btn-secondary btn-sm mb-3 mr-1"><i class="far fa-copy"></i></button>
</form><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/components/clone-icon.blade.php ENDPATH**/ ?>