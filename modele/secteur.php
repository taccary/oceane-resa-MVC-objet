<?php
class Secteur {
    private int $id;
    private string $nom;
    
    public function __construct($id, $nom) {
        $this->id = $id;
        $this->nom = $nom;
    }
    
    public function getId() : int {
        return $this->id;
    }

    public function getNom() : string{
        return $this->nom;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setNom(string $nom): void {
        $this->nom = $nom;
    }
}

?>