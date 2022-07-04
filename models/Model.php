<?php
declare(strict_types=1);

class Model {
    private $db;

    protected function execRequest(string $sql, array $params = null){
        return null;
    }
    private function getDB() {
        if ($this->db == null) {
          // Création de la connexion
          $this->db = new PDO('',
            'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        return $this->db;
    }
    
}