
<?php $__env->startSection("content"); ?>        

<form class="ajout"action="/ajout" method="post" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <label for="titre">Titre de la photo :</label>
    <input type="text" id="titre" name="titre" required /><br/><br/>
    
    <label for="album_id">Album :</label>
    <select id="album_id" name="album_id" required>
        <?php $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($a->id); ?>"><?php echo e($a->titre); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select><br/><br/>
    
    <label for="image">Image :</label>
    <input type="file" id="image" name="image" accept="image/*" required>

    <label for="tags">Tags :</label>
    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <label>
            <input type="checkbox" name="tag_id[]" value="<?php echo e($tag->id); ?>">
            <?php echo e($tag->nom); ?>

        </label>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <label for="note">Note :</label>
    <input type="number" id="note" name="note" min="0" max="5" />

<br><br>

    
    <input type="submit" value="Ajouter la photo" />
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lolad\git\photoss3\resources\views/ajout.blade.php ENDPATH**/ ?>