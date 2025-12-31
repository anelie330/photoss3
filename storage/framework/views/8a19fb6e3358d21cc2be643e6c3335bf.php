
<?php $__env->startSection("content"); ?>     

<h2>Modifier l'album</h2>
<form class="ajout" action="/<?php echo e($album->id); ?>/editAlbum" method="POST">
    <?php echo csrf_field(); ?>

    <label for="titre">Titre de l’album :</label>
    <input type="text" id="titre" name="titre" value="<?php echo e($album->titre); ?>" required>

    <br><br>

    <input type="submit" value="Enregistrer les modifications"/>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lolad\git\photoss3\resources\views/editAlbum.blade.php ENDPATH**/ ?>