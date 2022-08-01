<?php
require_once 'views/View.php';
require_once 'models/AnimalManager.php';
require_once 'models/Animal.php';
require_once 'helpers/Message.php';

class AnimalController {

    private MainController $mainCtrl;

    public function __construct(){
        $this->mainCtrl = new MainController();
    }

    public function displayAddAnimal(?string $message = null) : void {
        $mes = null;
        if($message)
            $mes = new Message($message, "red lighten-2", "Erreur");
        $addAniView = new View('AddAnimal');
        $addAniView->generer(["message" => $mes]);
    }

    public function addAnimal(array $aniData) : void {
        $manager = new AnimalManager();
        $ani = new Animal($aniData);
        $ani = $manager->createAnimal($ani);

        $message = new Message("L'animal ID ".$ani->getIdAnimal()." du nom de " . $ani->getNom() . " a été créé", Message::MESSAGE_COLOR_SUCCESS, "Création");
        if(empty($ani->getIdAnimal())) {
            $message->setMessage("Une erreur est survenue lors de la création de l'animal");
            $message->setTitle("Erreur création");
            $message->setColor(Message::MESSAGE_COLOR_ERROR);
        }
        $this->mainCtrl->index($message);
    }

    public function displayEditAnimal(int $idAnimal) : void {
        $manager = new AnimalManager();
        $animal = $manager->getByID($idAnimal);
        $message = null;
        if(empty($animal)) {
            $message = new Message("L'animal ID ".$idAnimal." n'a pas été trouvé", Message::MESSAGE_COLOR_ERROR, "Erreur");
        }

        $view = new View('AddAnimal');
        $view->generer(["animal" => $animal, "message" => $message]);
    }

    public function editAnimal(array $dataAnimal){
        $manager = new AnimalManager();
        $animal = new Animal($dataAnimal);
        $count = $manager->editAnimal($animal);
        if($count > 0)
            $message = new Message("Animal ID ".$animal->getIdAnimal()." modifié", Message::MESSAGE_COLOR_SUCCESS, "Modification");
        else
            $message = new Message("La modification à rencontré un problème", Message::MESSAGE_COLOR_ERROR, "Modification");

        $this->mainCtrl->index($message);
    }

    public function deleteAnimalAndIndex(int $idAnimal = -1) : void {
        $manager = new AnimalManager();

        if($idAnimal > -1){
            $count = $manager->deleteAnimal($idAnimal);
            if($count > 0)
                $message = new Message("Animal supprimé", Message::MESSAGE_COLOR_SUCCESS, "Suppression");
            else
                $message = new Message("La suppression à rencontré un problème", Message::MESSAGE_COLOR_ERROR, "Suppression");
        }
        else{
            $message = new Message("ID de l'animal non fourni", Message::MESSAGE_COLOR_ERROR, "Suppression");
        }

        $this->mainCtrl->index($message);
    }
}