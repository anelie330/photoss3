
<?php $__env->startSection("content"); ?>

<h2>Créer un nouvel album</h2>

<form class="ajout" action="/ajoutAlbum" method="POST">
    <?php echo csrf_field(); ?>

    <label for="titre">Titre de l’album :</label>
    <input type="text" id="titre" name="titre" required>

    <br><br>

    <input type="submit" value="Créer"/>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lolad\git\photoss3\resources\views/ajoutAlbum.blade.php ENDPATH**/ ?>