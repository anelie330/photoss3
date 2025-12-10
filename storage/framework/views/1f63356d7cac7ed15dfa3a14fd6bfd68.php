

<?php $__env->startSection("content"); ?>        
<?php $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div id ="albums">
    <h3><a href ="/<?php echo e($a->id); ?>"><?php echo e($a->titre); ?> <?php echo e($a->creation); ?></a></h3>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aneli\Documents\git\photoss3\resources\views/index.blade.php ENDPATH**/ ?>