<?php
require_once 'views/View.php';
require_once 'models/AnimalManager.php';
require_once 'models/Animal.php';

class AnimalController {

    public function displayAddAnimal(){
        $addAniView = new View('AddAnimal');
        $addAniView->generer([]);
    }
}