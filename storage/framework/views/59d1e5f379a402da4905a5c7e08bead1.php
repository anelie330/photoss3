

<?php $__env->startSection("content"); ?>
<h2>Filtrer / Trier :</h2>
<form action="/filter" method="get">
    <label for="search">Rechercher un titre :</label>
    <input type="text" id="search" name="search" value="<?php echo e(request()->get('search')); ?>" placeholder="Titre de l'album">

    <label for="trier">Trier par :</label>
    <select id="trier" name="trier">
        <option value="">--Sélectionner--</option>
        <option value="titre" <?php if(request()->get('trier') == 'titre'): ?> selected <?php endif; ?>>Titre</option>
        <option value="date" <?php if(request()->get('trier') == 'date'): ?> selected <?php endif; ?>>Date de création</option>
    </select>

    <input type="submit" value="Appliquer">
</form>        
<?php $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div id ="albums">
    <h3><a href ="/<?php echo e($a->id); ?>"><?php echo e($a->titre); ?> <?php echo e($a->creation); ?></a></h3>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lolad\git\photoss3\resources\views/index.blade.php ENDPATH**/ ?>