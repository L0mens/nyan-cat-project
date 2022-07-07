<?php


class Animal{

    private int $idAnimal;
    private string $nom;
    private ?string $proprietaire;
    private ?string $espece;
    private ?string $cri;
    private ?int $age;

    /**
     * @return int
     */
    public function getIdAnimal(): int
    {
        return $this->idAnimal;
    }

    /**
     * @param int $idAnimal
     */
    public function setIdAnimal(int $idAnimal): void
    {
        $this->idAnimal = $idAnimal;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return ?string
     */
    public function getProprietaire(): ?string
    {
        return $this->proprietaire;
    }

    /**
     * @param ?string $proprietaire
     */
    public function setProprietaire(?string $proprietaire): void
    {
        $this->proprietaire = $proprietaire;
    }

    /**
     * @return ?string
     */
    public function getEspece(): ?string
    {
        return $this->espece;
    }

    /**
     * @param ?string $espece
     */
    public function setEspece(?string $espece): void
    {
        $this->espece = $espece;
    }

    /**
     * @return ?string
     */
    public function getCri(): ?string
    {
        return $this->cri;
    }

    /**
     * @param ?string $cri
     */
    public function setCri(?string $cri): void
    {
        $this->cri = $cri;
    }

    /**
     * @return ?int
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * @param ?int $age
     */
    public function setAge(?int $age): void
    {
        $this->age = $age;
    }

    public function __construct(array $data){
        $this->hydrate($data);
    }

    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
          // On récupère le nom du setter correspondant à l'attribut
          $method = 'set'.ucfirst($key);
              
          // Si le setter correspondant existe.
          if (method_exists($this, $method)) {
            // On appelle le setter
            $this->$method($value);
          }
        }
      }
}