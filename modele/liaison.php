<?php
class Liaison {
    private int $code;
    private Secteur $secteur; // référence vers un objet secteur
    private float $distance;
    private Port $portDepart; // référence vers un objet port
    private Port $portArrivee; // référence vers un objet port
    
    public function __construct(int $unCode, Secteur $unSecteur, float $uneDistance, Port $unPortDepart, Port $unPortArrivee) 
    {
        $this->code = $unCode;
        $this->secteur = $unSecteur;
        $this->distance = $uneDistance;
        $this->portDepart = $unPortDepart;
        $this->portArrivee = $unPortArrivee;
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

    public function setCode(int $unCode): void {
        $this->code = $unCode;
    }

    public function setSecteur(Secteur $unSecteur): void {
        $this->secteur = $unSecteur;
    }

    public function setDistance(float $uneDistance): void {
        $this->distance = $uneDistance;
    }

    public function setportDepart(Port $unPortDepart): void {
        $this->portDepart = $unPortDepart;
    }

    public function setportArrivee(Port $unPortArrivee): void {
        $this->portArrivee = $unPortArrivee;
    }
}
?>