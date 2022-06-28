<?php

require_once 'views/View.php';

class MainController{

    public function __construct(){

    }

    public function Index() : void {
        $indexView = new View('Index');
        $indexView->generer(['nomAnimalerie' => "NyanCat"]);

    }

}