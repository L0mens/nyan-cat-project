<?php

require_once './controllers/MainController.php';
require_once './controllers/AnimalController.php';


$ctrl = new MainController();
$aniCtrl = new AnimalController();

if(isset($_GET['page'])){
    if($_GET['page'] == "add-animal"){
        $aniCtrl->displayAddAnimal();
    }
    else if($_GET['page'] == "edit-animal"){

    }
    else if($_GET['page'] == "del-animal"){

    }
    else if($_GET['page'] == "search"){

    }
    else if($_GET['page'] == "add-proprietaire"){

    }
    else{
        $ctrl->Index();
    }
}
else{
    $ctrl->Index();
}


