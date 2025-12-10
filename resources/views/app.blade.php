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
  <link href="https://fonts.googleapis.com/css2?family=Spartan&display=swap" rel="stylesheet">
</head>

<body>
<header>
    <a href="/" class="logo">Memories 4EVer</a>
    <nav id="nav">
        <a href="/">Albums</a>
        <a href="/ajout">Ajouter des photos</a>
    </nav>
</header>

<div class= "container">
@yield("content")
</div>

<footer>
    <a href="/" class="logo">Memories 4EVer</a>
    <p>© 2025 Memories 4Ever</p>
</footer>

</body>
</html>