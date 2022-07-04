<?php

declare(strict_types=1);

require_once 'Config.php';


abstract class Model
{
    private $db;

    protected function execRequest(string $sql, array $params = null)
    {
        if ($params == null) {
            $resultat = $this->getDB()->query($sql);    // exécution directe
        } else {
            $resultat = $this->getDB()->prepare($sql);  // requête préparée
            $resultat->execute($params);
        }
        return $resultat;
    }
    private function getDB()
    {
        if ($this->db == null) {
            // Création de la connexion

            $this->db = new PDO(Config::$dsn, Config::$user, Config::$pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        return $this->db;
    }
}
