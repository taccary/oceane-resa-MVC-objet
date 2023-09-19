<?php
class Port 
{
    private string $nomCourt;
    private string $nom;
    
    public function __construct(string $nomCourt, string $nom) {
        $this->nomCourt = $nomCourt;
        $this->nom = $nom;
    }
    
    public function getNomCourt() : string {
        return $this->nomCourt;
    }

    public function getNom() : string {
        return $this->nom;
    }

    public function setNomCourt(string $nomCourt): void {
        $this->nomCourt = $nomCourt;
    }

    public function setNom(string $nom): void {
        $this->nom = $nom;
    }
}
?>