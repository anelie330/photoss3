<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/style.css"/>
  <title>Memories 4Ever</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Oi&family=Playwrite+NO:wght@100..400&display=swap" rel="stylesheet">
</head>

<body>
<header>
    <div id="logo">
    <img src="/flora.png"/>
    <a href="/" class="logo">Memories 4EVer</a>
    </div>
    <nav id="nav">
        <a href="/">Albums</a>
        <a href="/ajout">Ajouter des photos</a>
    </nav>
</header>

<div class= "container">
<?php echo $__env->yieldContent("content"); ?>
</div>

<footer>
    <a href="/" class="logo">Memories 4EVer</a>
    <p>© 2025 Memories 4Ever</p>
</footer>

</body>
</html><?php /**PATH C:\Users\aneli\Documents\git\photoss3\resources\views/app.blade.php ENDPATH**/ ?>