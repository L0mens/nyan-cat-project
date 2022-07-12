<?php

require_once 'views/View.php';
require_once 'models/AnimalManager.php';
require_once 'models/Animal.php';

class ProprietaireController{

    public function displayAddProprietaire() : void {
        $addAniView = new View('AddProprietaire');
        $addAniView->generer([]);
    }



}