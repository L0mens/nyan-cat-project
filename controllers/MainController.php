<?php

require_once 'views/View.php';
require_once 'models/AnimalManager.php';
require_once 'models/Animal.php';

class MainController{

    public function __construct(){

    }

    public function Index() : void {
        $manager = new AnimalManager();
        $listAnimals = $manager->getAll();
        $firstAni = $manager->getByID(1);
        $other = $manager->getByID(10);

        $indexView = new View('Index');
        $indexView->generer(['nomAnimalerie' => "NyanCat", "listAnimals" => $listAnimals, "first" => $firstAni, "other" => $other]);

    }



}