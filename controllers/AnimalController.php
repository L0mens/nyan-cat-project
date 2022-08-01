<?php
require_once 'views/View.php';
require_once 'models/AnimalManager.php';
require_once 'models/Animal.php';
require_once 'helpers/Message.php';

class AnimalController {



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
        $addAniView = new View('AddAnimal');
        $addAniView->generer(["message" => $message]);
    }

    public function EditAnimal() : void {
        $addAniView = new View('AddAnimal');
        $addAniView->generer([]);
    }

    public function deleteAnimalAndIndex(int $idAnimal = -1) : void {
        $manager = new AnimalManager();

        if($idAnimal > -1){
            var_dump($idAnimal);
            $count = $manager->deleteAnimal($idAnimal);
            if($count > 0)
                $message = new Message("Animal supprimé", Message::MESSAGE_COLOR_SUCCESS, "Suppression");
            else
                $message = new Message("La suppression à rencontré un problème", Message::MESSAGE_COLOR_ERROR, "Suppression");
        }
        else{
            $message = new Message("ID de l'animal non fourni", Message::MESSAGE_COLOR_ERROR, "Suppression");
        }

        $listAnimals = $manager->getAll();

        $indexView = new View('Index');
        $indexView->generer(['nomAnimalerie' => "NyanCat", "listAnimals" => $listAnimals, "message" => $message]);
    }
}