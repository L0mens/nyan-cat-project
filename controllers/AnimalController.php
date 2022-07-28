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

    public function AddAnimal(array $aniData) : void {
        $manager = new AnimalManager();
        $ani = new Animal($aniData);
        $ani = $manager->createAnimal($ani);

        $message = new Message("L'animal ID ".$ani->getIdAnimal()." du nom de " . $ani->getNom() . " a été créé", "green lighten-2", "Création");
        if(empty($ani->getIdAnimal())) {
            $message->setMessage("Une erreur est survenue lors de la création de l'animal");
            $message->setTitle("Erreur création");
            $message->setColor("red lighten-2");
        }
        $addAniView = new View('AddAnimal');
        $addAniView->generer(["message" => $message]);
    }

    public function EditAnimal() : void {
        $addAniView = new View('AddAnimal');
        $addAniView->generer([]);
    }

    public function DeleteAnimal() : void {
        $manager = new AnimalManager();
        $listAnimals = $manager->getAll();
        $firstAni = $manager->getByID(1);
        $other = $manager->getByID(10);
        $message = "Animal suppr";

        $indexView = new View('Index');
        $indexView->generer(['nomAnimalerie' => "NyanCat", "listAnimals" => $listAnimals, "first" => $firstAni, "other" => $other, "message" => $message]);
    }
}