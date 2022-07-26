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

    public function Search(){
        $ani_example = new Animal(['nom' => "test"]);
        $reflect = new ReflectionClass($ani_example);
        $props   = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PRIVATE);
        $props_name = [];
        foreach ($props as $prop){
            array_push($props_name, $prop->getName());
        }
        $serchView = new View('Search');
        $serchView->generer(["aniField" => $props_name]);
    }



}