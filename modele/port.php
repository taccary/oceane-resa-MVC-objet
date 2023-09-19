<?php
class Port 
{
    private string $nomCourt;
    private string $nom;
    
    public function __construct(string $unNomCourt, string $unNom) {
        $this->nomCourt = $unNomCourt;
        $this->nom = $unNom;
    }
    
    public function getNomCourt() : string {
        return $this->nomCourt;
    }

    public function getNom() : string {
        return $this->nom;
    }

    public function setNomCourt(string $unNomCourt): void {
        $this->nomCourt = $unNomCourt;
    }

    public function setNom(string $unNom): void {
        $this->nom = $unNom;
    }
}
?>