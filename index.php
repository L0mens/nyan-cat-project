<?php

require_once './controllers/MainController.php';
require_once './controllers/AnimalController.php';
require_once './controllers/ProprietaireController.php';


$ctrl = new MainController();
$aniCtrl = new AnimalController();
$proprioCtrl = new ProprietaireController();

/**
 * @throws Exception
 */
function getParam(array $array, string $paramName, bool $canBeEmpty=true)
{
    if (isset($array[$paramName])) {
        if(!$canBeEmpty && empty($array[$paramName]))
            throw new Exception("Paramètre '$paramName' vide");
        return $array[$paramName];
    } else
        throw new Exception("Paramètre '$paramName' absent");
}

if (isset($_GET['action'])) {
    if ($_GET['action'] == "add-animal") {

        if(empty($_POST)){
            $aniCtrl->displayAddAnimal();
        }
        else{
            try{
                $dataAnimal = [
                    "nom" => getParam($_POST, "animal-nom", false),
                    "proprietaire" => getParam($_POST, "animal-proprietaire"),
                    "espece" => getParam($_POST, "animal-espece"),
                    "cri" => getParam($_POST, "animal-cri"),
                    "age" => intval(getParam($_POST, "animal-age"))
                ];
                $aniCtrl->addAnimal($dataAnimal);
            }
            catch (Exception $e){
                $err = $e->getMessage(). "\n";
                $aniCtrl->displayAddAnimal($err);
            }


        }


    } else if ($_GET['action'] == "edit-animal") {
        $aniCtrl->EditAnimal();
    } else if ($_GET['action'] == "del-animal") {
        try{
            $idAni = getParam($_GET, "idAnimal");
            $aniCtrl->deleteAnimalAndIndex($idAni);
        }
        catch (Exception $e){
            $err = $e->getMessage(). "\n";
            $mess = new Message($err, Message::MESSAGE_COLOR_ERROR, "Erreur");
            $ctrl->index($mess);
        }
    } else if ($_GET['action'] == "search") {
        $ctrl->search();
    } else if ($_GET['action'] == "add-proprietaire") {
        $proprioCtrl->displayAddProprietaire();
    } else {
        $ctrl->index();
    }
} else {
    $ctrl->index();
}


