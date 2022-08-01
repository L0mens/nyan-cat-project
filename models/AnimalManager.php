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

    public function createAnimal(Animal $ani) : Animal {
        $sql = "INSERT INTO animal (nom,espece,cri,proprietaire,age) VALUES (?,?,?,?,?)";
        $sqlLastID = "SELECT LAST_INSERT_ID()";
        $this->execRequest($sql, [$ani->getNom(), $ani->getEspece(), $ani->getCri(), $ani->getProprietaire(), $ani->getAge()]);
        $getId = $this->execRequest($sqlLastID);
        if($id = $getId->fetch())
            $ani->setIdAnimal($id[0]);
        return $ani;
    }

    public function deleteAnimal(int $idAnimal) : int {
        $sql = "DELETE FROM animal where idAnimal = ?";
        $del = $this->execRequest($sql, [$idAnimal]);
        /* Return number of rows that were deleted */
        print("Return number of rows that were deleted:\n");
        $count = $del->rowCount();
        print("Deleted $count rows.\n");
        return $count;
    }
}