<?php
class Secteur {
    private int $id;
    private string $nom;
    
    public function __construct($unId, $unNom) {
        $this->id = $unId;
        $this->nom = $unNom;
    }
    
    public function getId() : int {
        return $this->id;
    }

    public function getNom() : string{
        return $this->nom;
    }

    public function setId(int $unId): void {
        $this->id = $unId;
    }

    public function setNom(string $unNom): void {
        $this->nom = $unNom;
    }
}

?>