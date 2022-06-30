<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="public/css/main.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $titre ?></title>
</head>

<body>
<header>
    <!-- Menu -->
    <nav>
    <a href="index.php" id="logo" class="flex-child">
        <img src="https://c.tenor.com/b5KaSeHWOtUAAAAC/nyan-cat-rainbow-cat.gif" alt="nyan cat gif">
    </a>
    <a href="index.php?page=add-animal" id="nav-add-animal" class="flex-child nav-hover">
        Ajouter un animal
    </a>
    <a href="index.php?page=add-propio" id="nav-add-propio" class="flex-child nav-hover">
        Ajouter un proprio
    </a>
    <a href="index.php?page=search" id="nav-search" class="flex-child nav-hover">
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