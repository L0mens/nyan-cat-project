<?php

require_once './controllers/MainController.php';
require_once './controllers/AnimalController.php';
require_once './controllers/ProprietaireController.php';


$ctrl = new MainController();
$aniCtrl = new AnimalController();
$proprioCtrl = new ProprietaireController();

if(isset($_GET['page'])){
    if($_GET['page'] == "add-animal"){
        $aniCtrl->displayAddAnimal();
    }
    else if($_GET['page'] == "edit-animal"){
        $aniCtrl->displayEditAnimal();
    }
    else if($_GET['page'] == "del-animal"){
        $aniCtrl->displayDeleteAnimal();
    }
    else if($_GET['page'] == "search"){
        $ctrl->displaySearchPage();
    }
    else if($_GET['page'] == "add-proprietaire"){
        $proprioCtrl->displayAddProprietaire();
    }
    else{
        $ctrl->Index();
    }
}
else{
    $ctrl->Index();
}


