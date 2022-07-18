<?php
require_once 'views/View.php';
require_once 'models/AnimalManager.php';
require_once 'models/Animal.php';

class AnimalController {

    public function displayAddAnimal() : void {
        $addAniView = new View('AddAnimal');
        $addAniView->generer([]);
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