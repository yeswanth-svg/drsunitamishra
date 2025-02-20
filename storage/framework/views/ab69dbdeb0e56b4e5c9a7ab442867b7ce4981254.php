<div class="form-group">
    <label for="lang"><?php echo e(__('Languages')); ?></label>
    <select name="lang" id="language" class="form-control">
        <?php $__currentLoopData = get_all_language(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($lang->slug); ?>"><?php echo e($lang->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/components/add-language.blade.php ENDPATH**/ ?>