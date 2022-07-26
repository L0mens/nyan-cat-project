<?php

require_once './controllers/MainController.php';
require_once './controllers/AnimalController.php';
require_once './controllers/ProprietaireController.php';


$ctrl = new MainController();
$aniCtrl = new AnimalController();
$proprioCtrl = new ProprietaireController();

if(isset($_GET['action'])){
    if($_GET['action'] == "add-animal"){
        $aniCtrl->displayAddAnimal();
    }
    else if($_GET['action'] == "edit-animal"){
        $aniCtrl->EditAnimal();
    }
    else if($_GET['action'] == "del-animal"){
        $aniCtrl->DeleteAnimal();
    }
    else if($_GET['action'] == "search"){
        $ctrl->Search();
    }
    else if($_GET['action'] == "add-proprietaire"){
        $proprioCtrl->displayAddProprietaire();
    }
    else{
        $ctrl->Index();
    }
}
else{
    $ctrl->Index();
}


