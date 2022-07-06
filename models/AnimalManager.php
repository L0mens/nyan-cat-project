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

    public function getByID(int $id) : ?Animal {
        $sql = "SELECT * FROM animal where idAnimal = ?";
        $datas = $this->execRequest($sql, [$id]);
        $ani = null;
        if($data = $datas->fetch()){
            $ani = new Animal($data);
        }
        return $ani;

    }
}