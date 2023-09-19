<?php
class Port 
{
    private $nomCourt;
    private $nom;
    
    public function __construct($nomCourt, $nom) {
        $this->nomCourt = $nomCourt;
        $this->nom = $nom;
    }
    
    public function getNomCourt() : string {
        return $this->nomCourt;
    }

    public function getNom() : string {
        return $this->nom;
    }

    public function setNomCourt($nomCourt): void {
        $this->nomCourt = $nomCourt;
    }

    public function setNom($nom): void {
        $this->nom = $nom;
    }
}
?>