<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="public/css/main.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title><?= $titre ?></title>
</head>

<body>
<header>
    <!-- Menu -->
    <nav>
    <a href="index.php" id="logo" class="flex-child">
        <img src="https://c.tenor.com/b5KaSeHWOtUAAAAC/nyan-cat-rainbow-cat.gif" alt="nyan cat gif">
        <span id="header-title">NyanCat Animalerie</span>
    </a>
    <a href="index.php?action=add-animal" id="nav-add-animal" class="flex-child nav-hover">
        Ajouter un animal
    </a>
    <a href="index.php?action=add-proprietaire" id="nav-add-propio" class="flex-child nav-hover">
        Ajouter un proprio
    </a>
    <a href="index.php?action=search" id="nav-search" class="flex-child nav-hover">
        Recherche
    </a>
    </nav>
</header>
<main id="contenu">
    <?= $contenu ?>
</main> <!-- #contenu -->
<footer>
    Une animalerie colorée !
</footer>
</body>

</html>