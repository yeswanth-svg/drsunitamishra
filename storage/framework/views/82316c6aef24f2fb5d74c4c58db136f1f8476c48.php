<div class="form-group">
    <label for="<?php echo e($name); ?>" class="d-block"> <?php echo e($title); ?> </label>
    <div class="btn-group <?php echo e($id); ?>">
        <button type="button" class="btn btn-info bt-xl iconpicker-component">
            <i class="<?php echo e((isset($value))? get_static_option($value) : (($setval)??'fas fa-phone')); ?>"></i>
        </button>
        <button type="button" class="icp icp-dd btn bt-xl btn-info dropdown-toggle"
                data-selected="<?php echo e((isset($value))? get_static_option($value) : (($setval)??'fas fa-phone')); ?>" data-toggle="dropdown">
            <span class="caret"></span>
            <span class="sr-only"><?php echo e(__("Toggle Dropdown")); ?></span>
        </button>
        <div class="dropdown-menu"></div>
    </div>
    <input type="hidden" class="form-control"  id="<?php echo e($id); ?>" name="<?php echo e($name); ?>" value="<?php echo e((isset($value))? get_static_option($value) : (($setval)??'fas fa-phone')); ?>">
</div>
<?php /**PATH /home/drsunitamishra.com/public_html/resources/views/components/add-icon.blade.php ENDPATH**/ ?>