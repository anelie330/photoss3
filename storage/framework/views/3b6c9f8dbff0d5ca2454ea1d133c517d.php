
<?php $__env->startSection("content"); ?>        
<?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div id ="photos">
    <h3><?php echo e($p->titre); ?></h3>
    <img class="photo" src ="<?php echo e($p->url); ?>" alt ="<?php echo e($p->titre); ?>" />
    <h3><?php echo e($p->tags); ?></h3>

    <script>
        document.querySelectorAll('.photos').forEach(function(img) {
        img.addEventListener('click', function() {
        img.classList.toggle('zoomed');
    });
});
    </script>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lolad\git\photoss3\resources\views/album.blade.php ENDPATH**/ ?>