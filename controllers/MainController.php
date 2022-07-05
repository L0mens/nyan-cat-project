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

        $indexView = new View('Index');
        $indexView->generer(['nomAnimalerie' => "NyanCat", "listAnimals" => $listAnimals]);

    }

}