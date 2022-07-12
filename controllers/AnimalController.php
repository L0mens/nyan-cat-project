<?php
require_once 'views/View.php';
require_once 'models/AnimalManager.php';
require_once 'models/Animal.php';

class AnimalController {

    public function displayAddAnimal() : void {
        $addAniView = new View('AddAnimal');
        $addAniView->generer([]);
    }

    public function displayEditAnimal() : void {
        $addAniView = new View('EditAnimal');
        $addAniView->generer([]);
    }

    public function displayDeleteAnimal() : void {
        $addAniView = new View('DelAnimal');
        $addAniView->generer([]);
    }
}