<?php

require_once 'Animal.php';
require_once 'Model.php';

class AnimalManager extends Model {

    public function getAll() : array {
        $sql = "SELECT * FROM animal";
        $datas = $this->execRequest($sql);
        $aniArr = [];
        foreach ($datas as $data){
            array_push($aniArr, new Animal($data));
        }
        return $aniArr;

    }
}