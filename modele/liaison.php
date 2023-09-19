<?php
class Liaison {
    private int $code;
    private Secteur $secteur; // référence vers un objet secteur
    private float $distance;
    private Port $portDepart; // référence vers un objet port
    private Port $portArrivee; // référence vers un objet port
    
    public function __construct(int $code, Secteur $secteur, float $distance, Port $portDepart, Port $portArrivee) 
    {
        $this->code = $code;
        $this->secteur = $secteur;
        $this->distance = $distance;
        $this->portDepart = $portDepart;
        $this->portArrivee = $portArrivee;
    }

    public function getCode() : int {
        return $this->code;
    }

    public function getSecteur() : Secteur{
        return $this->secteur;
    }

    public function getDistance() : float{
        return $this->distance;
    }

    public function getportDepart() : Port{
        return $this->portDepart;
    }

    public function getportArrivee() : Port{
        return $this->portArrivee;
    }

    public function setCode(int $code): void {
        $this->code = $code;
    }

    public function setSecteur(Secteur $secteur): void {
        $this->secteur = $secteur;
    }

    public function setDistance(float $distance): void {
        $this->distance = $distance;
    }

    public function setportDepart(Port $portDepart): void {
        $this->portDepart = $portDepart;
    }

    public function setportArrivee(Port $portArrivee): void {
        $this->portArrivee = $portArrivee;
    }
}
?>