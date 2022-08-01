# nyan-cat-project

# PHP TP1 -  Mise en place du projet

Votre mission sera de développer une application Web PHP pour gérer une animalerie.
Vous devrez gérer les actions pour manager vos animaux ainsi que leurs propriétaires.
Pour ajouter de la structure au projet, nous allons travailler avec un design pattern : Le MVC (Model-View-Controller).
[Voir détails](https://fr.wikipedia.org/wiki/Modèle-vue-contrôleur)

Voici nos objectifs pour tout le projet : 

- [ ] Afficher la liste des animaux
- [ ] Ajouter des animaux à la BD
- [ ] Editer un animal
- [ ] Supprimer un animal
- [ ] Rechercher un animal particulier
- [ ] Gérer un modèle de propriétaire
- [ ] Avoir un design simple et fonctionnel
- [ ] Plein de bonus

## 1 - Mise en place de l'architecture des dossiers

Dans votre dossier de travail (Bureau, Dossier XAMP, ...) vous allez créer un premier fichier index.php
Il servira de point d'entrée de votre application. Nous allons ensuite créer quelques dossiers.

```html
📦 TonSuperProjet
┣ 📂controllers
┣ 📂models
┣ 📂public
┃ ┣ 📂css
┃ ┗ 📂img
┣ 📂views
┣ 📜index.php
```

## 2 - Gérer la partie V du MVC

**2.1 :** Pour gérer l'affichage de nos pages, nous allons créer une classe View dans le fichier views/View.php. (Cette notation implique de créer le fichier View.php dans le dossier views).
Voici le diagramme de notre classe

```mermaid
classDiagram
class View {
    -string $fichier
    -string $titre
    __construct(string $action)
    generer(array $donnees)
    -genererFichier(string $fichier, array $donnees)
}
```

**2.2 :** Implémenter les méthodes des View :

- Methode __construct

```php
public function __construct(string $action) {
  // Détermination du nom du fichier vue à partir de l'action
  $this->fichier = "views/vue" . $action . ".php";
  $this->titre = $action;
}
```

- Methode generer

```php
// Génère et affiche la vue
public function generer(array $donnees) {
  // Génération de la partie spécifique de la vue
  $contenu = $this->genererFichier($this->fichier, $donnees);
  // Génération du gabarit commun utilisant la partie spécifique
  $vue = $this->genererFichier('views/gabarit.php',
    array('titre' => $this->titre, 'contenu' => $contenu));
  // Renvoi de la vue au navigateur
  echo $vue;
}
```

- Methode genererFichier

```php
// Génère un fichier vue et renvoie le résultat produit
private function genererFichier(string $fichier, array $donnees) {
  if (file_exists($fichier)) {
    // Rend les éléments du tableau $donnees accessibles dans la vue
    // Voir la documentation de extract
    extract($donnees);
    // Démarrage de la temporisation de sortie
    ob_start();
    // Inclut le fichier vue
    // Son résultat est placé dans le tampon de sortie
    require $fichier;
    // Arrêt de la temporisation et renvoi du tampon de sortie
    return ob_get_clean();
  }
  else {
    throw new Exception("Fichier '$fichier' introuvable");
  }
}
```

Si vous avez des questions de compréhension, n'hésitez pas à vous référer aux commentaires et à en discuter avec votre prof.
Si vous analysez bien le code, il fait références à 2 types de fichiers.

- Les fichiers vue{qqchose}.php que nous verrons plus tard
- Le fichier gabarit.php que nous allons voir maintenant sur

**2.3 :** Le fichier gabarit sert à représenter tout ce qui est présent en permanence sur notre page (menu, pied de page, logo, ...). C'est celui-ci qui chargerait notre css, js et autres dépendances dans la balise head.

Pour commencer créer un fichier views/gabarit.php. Celui-ci aura accès grâce a la classe View à 2 variables :

- $titre -> Contient la valeur pour la balise title
- $contenu -> Contient tout le code de notre page

Je vais vous proposer un squelette pour votre gabarit. Il sera à compléter avec votre structure (menu par exemple), mais aussi avec les variables pour placer le contenu ou vous le désirer.
Vous pouvez faire votre propre gabarit si besoin.

```html
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
    
    </nav>
</header>
<!-- #contenu -->
<main id="contenu">

</main> 
<footer>

</footer>
</body>

</html>
```

Si vous êtes observateur, vous remarquerez une référence à un fichier css. Je vous recommande de le créé pour styliser votre page (📝 et oui le css compte dans la note).

Vous pourrez aussi voir comment afficher le contenu d'une variable vu que le titre est affiché dans la balise title. A vous d'afficher le contenu.

**2.4 :** Pour notre page d'accueil, nous allons faire simple. Du moins pour le moment, pour avoir une preuve que tout fonctionne
Créez le fichier views/vueIndex.php avec du code simple

```php
<h1>Bienvenue chez <?= $nomAnimalerie ?></h1>
```

Ce sera tout pour la vue pour le moment

## 3 - Gérer le controleur pour afficher la vue

Il est grand temps d'afficher quelque chose ! Mais pour cela, il nous faudra un chef d'orchestre ! Le contrôleur à la rescousse.

**3.1 :** Nous allons créer une classe MainController dans le fichier controllers/MainController.php
Pour le moment, il ne fera pas grands chose d'autre que construire notre vue. **N'oubliez pas de require_once votre classe View !!**

**3.2 :** Ajoutons une fonction Index qui aura pour but de générer notre vue.

```php
public function Index() : void {
    $indexView = new View('Index');
    $indexView->generer(['nomAnimalerie' => "NyanCat"]);
}
```

Prenez bien le temps de comprendre ce que fait cette fonction. Et surtout que les paramètres ne sont pas choisis au hazard ;)

**3.3 :** Pour finaliser notre contrôleur, nous devons nous reposer sur un autre composant (souvent dans l'ombre) => Le router.

Celui-ci sera EXTREMEMENT simple au début. Au fur et à mesure du développement de l'application, il faudra faire attention à ce que ce dernier reste le plus clean possible.

Cette fois, pas besoin de créer un fichier, nous allons utiliser notre index.php.
Pour tester que tout marche, il nous suffit d'instancier un MainController et d'en appeler sa méthode Index(). (⚠ require_once ⚠)

Si tout vas bien, votre page devrait s'afficher avec notre h1 !

## 4 : Fin du TP1 et bonus

À la fin, ton arborescence devrait ressembler à cela

```html
📦 TonSuperProjet
 ┣ 📂controllers
 ┃ ┗ 📜MainController.php
 ┣ 📂models
 ┣ 📂public
 ┃ ┣ 📂css
 ┃ ┃ ┗ 📜main.css
 ┃ ┗ 📂img
 ┣ 📂views
 ┃ ┣ 📜gabarit.php
 ┃ ┣ 📜View.php
 ┃ ┗ 📜vueIndex.php
 ┗ 📜index.php
```

En bonus : Commencez dès maintenant votre CSS en gérant un menu avec des boutons factice dans la balise nav de votre Gabarit !!

# PHP TP2 - Stocker et afficher les données

## Coté base de données

**1.1 :** Vous devriez avoir accès à une base de données MySQL (via grp ou bien XAMPP). Regardez la procédure pour accéder à votre outil PhPMyAdmin. Cela nous servira à administrer la base de données. (PhPMyAdmin n'est pas obligatoire, utiliser un autre moyen comme mysqm-cli, Datagrip ou bien MySQLWorkbench peut très bien fonctionner). Connectez vous à votre SGBD et selectionnez la bonne base de données. Nous sommes prêt à commencer!

**1.2 :** Nous allons, pour le moment, nous contenter d'une seule entité pour représenter nos animaux. Nous allons donc créer une table qui suit ce schéma :

```mermaid
erDiagram
ANIMAL {
        int idAnimal PK "AI"
        varchar nom "NOT NULL"
        int age
        varchar espece
        varchar cri
        varchar proprietaire
    }
```

Je vous invite à bien utiliser UTF-8 (utf8_general_ci par exemple) pour éviter les soucis d'accents. De plus, veillez à utiliser InnoDB comme moteur pour votre table. Nous pourrons en avoir besoin plus tard.

Essayez d'insérer un animal avec des données cohérentes que nous pourrons afficher plus tard sur notre page web.

## Coté code

**2.1 :** Il est temps de repasser sur notre projet PHP. Créez le fichier models/Model.php suivant ce schéma :

```mermaid
classDiagram
class Model {
    <<abstract>>
    -PDO db
    #execRequest(string $sql, array $params = null) PDOStatement
    -getDB() PDO
}
```

Il vous faudra coder la fonction getDB -> Cette fonction à pour but d'instancier un objet PDO avec les infos de connexion dans l'attribut $db s'il n'est pas null. Puis, elle retournera simplement l'attribut $db. N'hésitez à vous référer à votre cours et à la doc pour l'instance de PDO

Pour la fonction execRequest, celle-ci à pour objectif d'exécuter la requête $sql passée en paramètre. Elle pourra être préparée et exécutée avec les $params s'ils existent (👀 $params à une valeur par défaut). Notre fonction retournera le résultat de la fonction execute de PDO (qui est un PDOStatement).

Un peu d'aide => Voici un exemple de paramètre que notre fonction pourrait recevoir :

```php
$sql = 'select * from T_COMMENTAIRE where BIL_ID=?';
$commentaires = $this->executerRequete($sql, array($idBillet));
```

**2.2 :** Il est temps de créer notre entité avec son manager ! Voici le diagramme de nos classes models/Animal.php et models/AnimalManager.php

```mermaid
classDiagram
direction LR
class Animal{
    -?int $idAnimal
    -string $nom
    -?string $proprietaire
    -?string $espece
    -?string $cri
    -?int $age
}
class AnimalManager{
    getAll() Array~Animal~
    getByID(int $idAnimal) Animal
}
Model <|-- AnimalManager : hérite
Animal <.. AnimalManager : dépend
```

Comme les attributs de la classe Animal sont privés. Vous ajouterez les Getter & Setter associé.

```text
Si vous voulez implémenter l'Hydratation dès maintenant, ne vous genez pas ;) 
Cela sera demandé plus tard dans tous les cas.
```

Il vous faudra implémenter les méthodes getAll et getByID de la classe AnimalManager. Elles ont pour vocation d'utiliser la méthode execRequest pour récupérer les données de la BD et les transformer soit en array d'Animal soit juste en un Animal (getByID ne pouvant retourner évidemment qu'une valeur sinon null)

**2.3 :** Maintenant que nous avons toutes nos armes pour récupérer la donnée, il faut que le controllers les récupère pour les envoyer à la vue et enfin les afficher o/

Pour tester que tout marche, faite une instance du manager dans la fonction Index. Sauvegarder dans 3 variables différentes le retour des fonctions getAll(), getByID(idQuiExiste) et getByID(idQuiNexistePas).

Et pour finir passez les à votre vue Index généré et allez var_dump ces variables dans le fichier vueIndex.php.

Vous devriez avoir une liste, un animal, et null si tout s'est déroulé correctement (dans un format d'affichage moche au possible ;) ).

Code vueIndex.php

```php
<?php var_dump($listAnimals); ?>

<?php var_dump($first); ?>

<?php var_dump($other); ?>
```

Affichage Moche :

```text
object(Animal)#6 (6) { ["idAnimal":"Animal":private]=> int(1) ["nom":"Animal":private]=> string(6) "TheOne" ["proprietaire":"Animal":private]=> string(9) "Lui même" ["espece":"Animal":private]=> string(4) "Dieu" ["cri":"Animal":private]=> NULL ["age":"Animal":private]=> int(99999) } 
object(Animal)#5 (6) { ["idAnimal":"Animal":private]=> int(1) ["nom":"Animal":private]=> string(6) "TheOne" ["proprietaire":"Animal":private]=> string(9) "Lui même" ["espece":"Animal":private]=> string(4) "Dieu" ["cri":"Animal":private]=> NULL ["age":"Animal":private]=> int(99999) } 
NULL
```

## Coté design

**3.1 :**: Il est grand temps de rendre cet affichage un peu plus classe. Sur notre page Index, faite afficher un tableau HTML avec les données de nos animaux !

```text
Vous êtes libre d'utiliser une librairie pour le CSS ou de le coder vous même. 
```

**3.2 :** Nous allons préparer l'avenir de notre tableau. Pour cela, il faudra ajouter une colonne avec comme entête "Option". Nous pourrons alors pour chaque ligne, ajouté un lien représenté par soit un texte, une icône, un bouton, ... . Ces derniers permettront de modifier ou supprimer un animal !

### Exemple avec Materialize

![Example index](/doc/img/index-tp2-3-2.PNG)

Bien joué si vous êtes toujours en vie jusqu'ici :D

## Coté Bonus (Difficile)

Il y a de grande chance que vous ayez fait votre chaine de connexion à la base de données directement dans votre instance de PDO. Ce qui signifierai une faille de sécurité si votre code source se retrouvait exposé (par exemple sur github).

Je vous propose d'essayer de remédier à ce problème en externalisant ces infos dans un autre fichier qui pourrait être une classe Config par exemple.

Celle-ci pourrait charger les informations à l'aide d'un fichier de configuration .ini

Pour vous aiguiller, regarder la doc de la fonction parse_ini_file.

Voici un exemple de fichier dev.ini

```ini
;config dev
[DB]
dsn = 'mysql:host=localhost;dbname=yourdbname;charset=utf8';
user = 'user';
pass = 'password';
```

Ainsi, vous n'aurez qu'à gitignore votre dev.ini et mettre un dev_sample.ini avec des informations standard. L'utilisateur voulant utiliser votre projet n'aura qu'à mettre ses infos ici et renommer le fichier (Très utile pour le partage ou le déploiement)

# PHP TP3 -  Naviguer entre les pages moussaillons

Nous affichons notre page d'accueil ! Mais nous sommes encore bien statiques. Il est grand temps de pouvoir naviguer entre nos pages !

Petit point théorique : Nous pourrions naviguer entre des pages PHP genre index.php puis addAnimal.php etc etc. Ce n'est pas vraiment le comportement que nous voudrions. Voici le comportement voulu.

index.php -> regarder les parametres url (surtout pages par exemples) -> Suivant ce paramètre, on choisit la fonction du contrôleur qui correspond -> Celui génère la vue (avec accès au model si besoin).

Par exemple : index.php?action=updateAnimal&idAnimal=5 -> On voudra donc faire l'action updateAnimal avec comme info l'idAnimal 5 (qui nous permettrais de pré-remplir un formulaire).

## 1 - Ajouter des liens dans la page

**1.1 :** Vous allez devoir créer un menu avec des liens. (Vous avez peut être déjà commencé dans le TP1). Ces liens feront tous références à index.php. Il seront accompagné d'un paramètre que nous appelleront action.

```text
Votre menu devrait apparaitre sur toute les pages
```

Pour le moment, nous allons créer 4 liens :

- action = add-animal
- action = add-proprietaire
- action = search
- un lien vers index sans page pour retourner sur l'index

```text
Vous êtes libre du style CSS de votre menu,
mais celui-ci devrait avoir du sens
```

**1.2 :** Si vous vous souvenez, au TP 2, vous avez ajouté une colonne avec des actions à coté de vos animaux. Pour chaque lignes, vous ajouterez un lien (qui peut être un bouton, une icone, un texte, ...) avec les cibles suivante :

- action = edit-animal & idAnimal = *l'id de l'animal*
- action = del-animal & idAnimal = *l'id de l'animal*

N'hésitez pas à regarder plus haut l'url que j'ai proposé en exemple pour l'écrire correctement.

Normalement, si tout est correct, vos liens ramènes tous sur la page actuelle. Seul l'url devrait changer.

## Afficher différentes pages suivant l'url

**2.1 :**  Notre objectif, pour commencer, sera de créer des pages ultra simple juste pour attester que le changement fonctionne. Pour cela, travaillons dans notre dossier views.

Créez les différents fichier php qui correspondront aux vue suivantes :

- add-animal (vueAddAnimal.php)
- add-proprietaire (vueAddProprietaire.php)
- search

Ces fichiers ne contiendront qu'un H1 qui exprime leur nom (ce qui nous permettra de vérifier que nous sommes sur la bonne page).

**2.2 :** Il est temps de nous attaquer à l'aiguillage qui indiquera quelle fichier générer, le routeur ! Si vous vous souvenez, c'est notre fichier index.php qui nous sert de routeur. Et nous resteront comme cela pour le moment.

Actuellement, nous ne faisont que charger notre MainControlleur puis appeler sa méthode Index. Hors, ce comportement serait uniquement celui par défaut, c'est à dire sans infos sur la page demandé. En restant simple, avec une structure if/else, nous pouvons regarder la valeur dans la variable page ($_GET sera votre ami !) si elle existe évidemment ;).

Testez les différentes valeurs attendu (vous pouvez laisser les corps des if/else if vides) et appeler Index dans le else.

Si tout fonctionne, rien ne devrait changer.

**2.3 :** Il est temps d'ajouter un routage complet ! Prenons add-animal par exemple. Nous pouvons avoir un AnimalController qui gère tout ce qui traite des animaux directement.

Créez donc une fonction AddAnimal() dans le controleur. Celle-ci n'aura pour but que d'afficher notre page AddAnimal. N'hésitez pas à regarder comment générer la View dans la fonction Index de MainController.

Puis pour terminer, instanciez votre AnimalController dans index.php, puis appelez AddAnimal() dans le if correspondant.

Si vous cliquez sur votre lien d'ajout d'animal, cela devrait changer de page !

**2.4 :** Nous arrivons à nos fins ! Il est temps de faire la même chose pour les différentes pages. Search devrait utiliser le MainController vu qu'elle est générique. AddPropriétaire pourrait avoir son propre controlleur.

Si tout s'est bien passé, vous devriez pouvoir naviger dans votre site (n'oubliez pas d'avoir un moyen de revenir à l'index dans votre gabarit !!)

**2.5 :** Vous avez peut être remarqué, mais il y a des actions qui n'ont pas de pages. Celle-ci ont pour vocation une action (supprimer un animal par exemple) puis de rediriger vers une page (exemple : l'index). Il nous reste donc à gérer les actions update et delete.

Pour le moment, Delete ne fera que rediriger vers l'accueil. Petite différence cependant, quand la vue sera générée, elle prendra un paramètre en plus dans son Array de variable. Celle-ci s'appelelrais message et contiendrait un texte qui confirme la suppression.

Pour Update, elle redirigera sur la page d'ajout animal. Elle aura juste accès en données GET à l'ID de l'animal, ce qui permettra plus tard de faire la différence entre ajout & update dans le formulaire

## 3 : Construire nos pages

**3.1 :** Attaquons donc notre page d'ajout d'animal ! Celle-ci devrait contenir juste un formulaire nous permettant de créer un animal en base de données. A vous de jouer ! (Evidemment, à ce stade, le formulaire ne fera rien !).

```text
Comme toujours, un peu de CSS serait appréciable 
(Qui a dis évaluable :o ?)
```

**3.2 :** La page d'ajout du propriétaire est très similaire à celle d'un animal. Un simple formulaire. Mais comme nous n'avons pas encore défini de modèle, un simple champs texte pour son nom suffira ;).

**3.3 :** Il nous reste la page de recherche. Celle-ci sera composé d'un champs texte et d'un select qui permettra de choisir le champs sur lequel on fait la recherche. Le plus optimal serait d'avoir les options de ce select qui dépendent directement des propriétés de notre classe Animal. Comme cela, en cas de changement, nous n'aurions pas à changer notre code.

Si vous avez besoin d'un peu d'aide, voici un moyen d'optenir les propriétés d'une classe => [Manuel](https://www.php.net/manual/en/reflectionclass.getproperties.php)

```text
Ne focalisez pas tout votre temps dessus. Si cela vous paraît trop compliqué, mettez les champs en dur pour le moment et revenez y s'il vous reste du temps à la fin.
```

**3.4 :** Pour finir, petit nettoyage des var_dump qui traineraient sur votre site. Puis n'hésitez pas à travaillez un peu le design de vos pages/formulaires.

## 4 : Conclusion & Bonus

Nous devrions maintenant pouvoir naviguer entre toutes les pages de notre site. Afficher les différents formulaires (qui ne font rien). L'objectif du prochain TP sera justement de mettre en place le CRUD (Create Read Update Delete) de notre animal !

**Bonus :** Imaginons que nous voulions chercher sur plusieurs champs la même valeur (Oui un chat peut faire Miaou comme cri mais aussi s'appeler Miaou ^^), il faudrait rendre notre champs Select apte à avoir plusieurs selections.

# PHP TP4 : Gérons l'arche !

Il est grand temps de pouvoir créer, modifier et supprimer des animaux !

## 1 : Et ainsi l'animal est

**1.1 :** Retournons sur notre formulaire d'ajout d'animal. Il est temps de déterminer la methode et l'action dans notre balise form. Comme nous allons créer une donnnée, les recommandation du protocol HTTP tende vers POST. Cella permet d'utiliser la même route que l'affichage du formulaire. Nous n'aurons qu'à regarder si nous avons des données $_POST pour savoir si on doit gérer l'ajout.

```html
<form action="index.php?action=add-animal" method="post">
```

```text
Attention, le formulaire HTML ne peut gérer que les méthodes POST et GET.
```

Pour exploiter notre formulaire, chaque champs input devra posséder un attribut name. Sa valeur déterminera le nom de notre clé dans $_POST.

**1.2 :** Pour anticiper une erreur dans les données envoyé par le formulaire (donnée incorrect ou champ inexistant), nous allons préparer notre page à accueillir un message d'erreur.

Dans la fonction displayAddAnimal, il faut ajouter un paramètre optionnel (pour ne passer casser notre code déjà en place) de type ?string à valeur null par défaut.

Celui-ci sera passé à la fonction 'generer' avec une clé nommé "message" par exemple. Cela vous donnera accès à une variable $message dans votre vueAddAnimal. Si celle-ci existe, vous pourrez afficher la valeur de la variable en guise de message d'erreur.

```text
Comme d'habitude, évitez de juste echo votre message et faite du html/css
```

**1.3 :** Dans notre controleur Animal, nous allons créer une fonction addAnimal qui aura pour but de :

1. Prendre les infos d'un animal en entrée (Array ou multi variable)
2. Créer l'animal
    - Créer une fonction createAnimal(Animal) qui insert un animal en BD dans notre AnimalManager
    - Récupère l'ID fraichement crée pour l'ajouter à notre Animal passé en paramètre
    - Retourne l'Animal
3. Créer un message sur la réussite (ou non) de la création
4. Génerer une page Index avec le message

```text
Pour récupérer l'ID du dernier élement inséré en MySQL, 
je vous recommande de faire une 2ème requête avec SELECT LAST_INSERT_ID()
```

**1.4 :** Il est temps de retravailler notre routeur pour gérer les données $_POST envoyé par notre formulaire. N'hésitez pas à var_dump votre $_POST pour identifier comment celui-ci fonctionne.

Il est recommandé de créer un fonction qui retournera la clé dont on à besoin dans l'array passé en paramètre (ici $_POST). Celle-ci pourrait lever une exception si la clé n'est pas trouvé. Celle-ci levera une exception si la clé existe mais que le champs est vide si $canBeEmpty est à false

```php
function getParam(array $array, string $paramName, bool $canBeEmpty=true)
```

Il est temps d'implémenter l'algo qui permettra de choisir ce qu'on affiche :

```text
Si nous avons des données POST
  -> Récupérer toutes les clés nécessaires
  -> Si une exception est levée
    -> Afficher le formulaire avec un message 
  -> Sinon
    -> Envoyer les données au controleur
Sinon
  -> Afficher le formulaire
```

## 2 : Et maintenant l'animal changera ou ne sera point

**2.1 :** Si vous êtes un bon étudiant qui aime tester les choses pour vérifier que tout fonctionne, vous devriez avoir pléthore d'animaux dans votre BD qui s'appellent Test ou bien le prénom de votre voisin avec l'espèce singe. On va donc préparer la suprression pour clean up un peu tout cela.

```text
TODO : Implémenter schémas pour visualer la fonctionnalité
```

Niveau modèle, rien de compliquer, une méthode deleteAnimal(int $idAnimal) à implémenter dans le manager.

```text
Envie de savoir si la supression s'est bien passé ? Regardez du coté de PDOStatement::rowCount() pour vous aidez.
```

Niveau contrôleur, une méthode (soyons explicite) deleteAnimalAndIndex(int $idAnimal). Comme son nom l'indique, on supprime l'animal (coucou le manager) puis on génère une vue Index avec un message (Suppression réussie ou non).

```text
Si vous vous souvenez, cette fonction a déjà été créée au TP3 Q2.5. Elle aura peut être un nom différent. Ce n'est pas un problème, tant que vous restez cohérent dans votre programme (vous pouvez aussi la renommer dans tout votre projet !) 
```

Puis niveau routeur, vous devriez avoir créé le bouton supprimer qui doit avoir un lien de cette forme

```html
index.php?action=del-animal&idAnimal=1
```

A vous de jouer pour :

1. Traiter l'action
2. Récupérer l'id depuis l'url (*hint* Les infos de l'url sont passé par la méthode GET)
3. En cas d'erreur (l'url ne contient pas la donné par exemple), afficher l'index avec un message
4. Call votre super méthode du contrôleur.

```text
Il est fort possible que, à ce stade du TP, votre fonction index ne gère pas un message. Si tel est le cas, pour éviter de casser votre code, ajouter un paramètre optionnel à votre méthode index. Puis passez ce paramètre à la fonction 'generer'. 
```

**2.2 :** Marre de supprimer tout ces animaux tests ? Peut être qu'il est temps de voir pour Update notre donnée.

Cette fonction étant plus complexe, nous allons la couper en 2. Pour le moment, objectif afficher le formulaire add-animal rempli des infos de l'animal que l'on veut modifier.

Dans le routeur, le procédé se déroule comme la fonction de delete.

Dans le controleur, nous avons une méthode editAnimal. Nous allons la renommé en displayEditAnimal vu que celle-ci ne fera qu'afficher le formulaire rempli. elle aura besoin de l'id de l'animal en paramètre.

Il ne manquera plus qu'à récupérer l'animal, et générer une vue addAnimal avec l'animal en paramètre

C'est au niveau de la vue que cela devient plus complexe. En vérifiant si un animal a été fourni à la vue, pré remplissez chacun des champs avec sa valeur correspondante. Vous ajouterez un champs caché contenant l'ID qui n'existe pas. Vous pouvez aussi changer l'action du formulaire en edit-animal ainsi que le titre de la page.

```text
Vous le sentez venir, mais oui ! Nous allons faire le même procédé qu'add-animal. C'est en se basant sur la présence ou non de donnée POST que nous savons si nous devons afficher le formulaire ou bien faire l'action (ici update)
```

```text
Votre code html parsemé de PhP peut vite devenir illisible ! N'hésitez pas à utiliser l'outil de formatage de votre IDE et de bien indenter votre code !
```

**2.3 :** Maintenant que nous avons préparé le terrain, il est temps de faire l'update a proprement parler.

Pour ne pas trop compliquer la tache, nous allons update tous les champs d'un coup sans se soucis s'ils ont été modifié ou non (à l'exception de l'id bien évidemment).

Pour le Manager, une fonction editAnimal(Animal $animal) que se chargera de mettre à jour la base de donnée.

Pour le controleur, le process est similaire à ce qu'on à vu avant :

0. On crée notre méthode editAnimal(array $dataAnimal)
1. On crée notre animal
2. On l'envoi au manager qui fait l'Update
3. On génère un message en fonction du résultat
4. On génère notre vue Index avec le message

```text
Nous générons beaucoup de fois une page Index. 
Hors ce code existe déjà dans notre MainController. 
Il serait bon de s'en servir. 
N'hésitez pas à utiliser un paramètre de votre AnimalController que vous instanciez dans sa méthode __construct(). 
Vous pouvez ainsi disposer de ses méthodes et invoquer l'index.
```

Pour le routeur, après avoir vérifié que nous possedont bien des données POST, nous récupérons ce qui est nécessaire via getParam. Puis, on transmet sous forme d'array à notre controleur.

Et si tout se passe nickel nous devrions avoir un process fonctionnel

```mermaid
flowchart LR
  A(Click sur le bouton edit) --> B(Affiche un formulaire pré rempli) 
  B --> C(Modifie les données) 
  C --> D(Update dans la BD) 
  D --> E(Retour sur Index avec un message sur le statut de l'update)

```

## 3 : Recap

Nous avons déjà bien avancé à ce stade. Si tout est fonctionnel, bien codé (#RevoirSonModuleQualité), et avec une pointe de design qui permet de ressembler plus à un site web qu'à une expérientation d'un doctorant, vous pouvez espérer une très correct !

Il est temps de faire le point sur l'avancée. Au niveau de l'architecture du projet, cela devrait ressemblé à cela (Le bonus décrit après est inclu.).

```text
📦 TonSuperProjet
 ┣ 📂config
 ┃ ┣ 📜Config.php
 ┃ ┗ 📜dev.ini
 ┣ 📂controllers
 ┃ ┣ 📜AnimalController.php
 ┃ ┣ 📜MainController.php
 ┃ ┗ 📜ProprietaireController.php
 ┣ 📂helpers
 ┃ ┗ 📜Message.php
 ┣ 📂models
 ┃ ┣ 📜Animal.php
 ┃ ┣ 📜AnimalManager.php
 ┃ ┗ 📜Model.php
 ┣ 📂public
 ┃ ┣ 📂css
 ┃ ┃ ┗ 📜main.css
 ┃ ┗ 📂img
 ┣ 📂views
 ┃ ┣ 📜gabarit.php
 ┃ ┣ 📜message.php
 ┃ ┣ 📜View.php
 ┃ ┣ 📜vueAddAnimal.php
 ┃ ┣ 📜vueAddProprietaire.php
 ┃ ┣ 📜vueIndex.php
 ┃ ┗ 📜vueSearch.php
 ┗ 📜index.php
```

Evidemment, certains fichiers peuvent différer, comme les noms des fonctions/classes.

Faisons un recap de ce que l'on attends de notre application.

- [x] Afficher la liste des animaux
- [x] Ajouter des animaux à la BD
- [x] Editer un animal
- [x] Supprimer un animal
- [ ] Rechercher un animal particulier
- [ ] Gérer un modèle de propriétaire
- [x] Avoir un design simple et fonctionnel
- [ ] Plein de bonus

## 4 : Bonus

Il serait agréable de gérer nos messages de façons plus détaillé. Effectivement, nous envoyons un texte et ... puis c'est tout. Ajouter peut être un titre au message et changer sa couleur (via des classes CSS) suivant son contenu (Bleu pour les infos, Rouge pour les erreurs, Vert pour les succès).

Pour éviter la duplication de code, je vous invite à créer un fichier /views/message.php qui se chargera du template du message.

Il ne manquera plus des les inclures dans vos template de page à l'aide d'un simple pour

```php
<?php include('message.php') ?>
```

Si l'on veut pousser encore plus loins, au lieu de gérer plusieurs variable, il serait temps de créer une classe Message dans un dossier helpers par exemple ;)