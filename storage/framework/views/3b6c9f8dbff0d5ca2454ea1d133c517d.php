
<?php $__env->startSection("content"); ?>
<h2>Filtrer :</h2>
<form class="filter" action="/<?php echo e($album->id); ?>/filter" method="get">
    <label for="tag_id">Tags :</label>
    <select id="tag_id" name="tag_id">
        <option value="">Aucun tag sélectionné</option>
        <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($tag->id); ?>" <?php if(request()->get('tag_id') == $tag->id): ?> selected <?php endif; ?>>
                <?php echo e($tag->nom); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    <label for="trier">Trier par :</label>
    <select id="trier" name="trier">
        <option value="">Aucun</option>
        <option value="titre" <?php if(request()->get('trier') == 'titre'): ?> selected <?php endif; ?>>Titre</option>
        <option value="note" <?php if(request()->get('trier') == 'note'): ?> selected <?php endif; ?>>Note</option>
    </select>

    <label for="search">Titre :</label>
    <input type="text" id="search" name="search" value="<?php echo e(request()->get('search')); ?>" placeholder="Rechercher" />

    <input type="submit" value="Appliquer" />
</form>


<section class="photo-section">
<?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="photos-album">
        <h3><?php echo e($p->titre); ?></h3>
        <img class="photo"
        src="<?php echo e(str_starts_with($p->url, 'http') ? $p->url : asset('storage/' . $p->url)); ?>"
        alt="<?php echo e($p->titre); ?>">

        <h3><?php echo e($p->tags); ?></h3>
        <h3>
        <?php
        $note = $p->note ?? 0;
        ?>

        <?php for($i = 1; $i <= 5; $i++): ?>
            <?php if($i <= $note): ?>
                <span id="etoile-jaune">&#9733;</span>
            <?php else: ?>
                <span id="etoile-grise">&#9733;</span>
            <?php endif; ?>
        <?php endfor; ?>
        </h3>

        <form class="delete-form" action="/photos/<?php echo e($p->id); ?>" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer cette photo ?')">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button id="delete" type="submit">
                <i class="fa-solid fa-trash-can"></i>
            </button>
        </form>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</section>

<button><a href="/ajout">Ajouter des photos</a></button>
<button><a href="/<?php echo e($album->id); ?>/editAlbum">Modifier l'album</a></button>

<script>
document.querySelectorAll('.photo').forEach(function(img) {
  img.addEventListener('click', function() {

    const overlay = document.createElement('div');
    overlay.classList.add('overlay');

    const zoomedImg = document.createElement('img');
    zoomedImg.src = img.src;
    zoomedImg.alt = img.alt;

    overlay.appendChild(zoomedImg);
    document.body.appendChild(overlay);

    overlay.addEventListener('click', function() {
      overlay.remove();
    });
  });
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\lolad\git\photoss3\resources\views/album.blade.php ENDPATH**/ ?>