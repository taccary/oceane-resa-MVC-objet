<?php

require_once("modele/Manager.php");
require_once("modele/Port.php");

class PortManager extends Manager
{
    /**
     * instancie et renvoie un objet port correspondant au nom court passé en paramètre.
     *
     * @param [type] $nomCourt
     * @return Port
     */
    public function get($unNomCourt) : Port
    {
        $req = $this->getPDO()->prepare("SELECT nom_court, nom FROM port WHERE nom_court = :nom");
        $req->bindValue(':nom', $unNomCourt, PDO::PARAM_STR);
        $req->execute();
        $donnees = $req->fetch(PDO::FETCH_ASSOC);
        return new Port($donnees['nom_court'], $donnees['nom']);
    }
  
    /**
     * Retourne la liste des ports sous forme d'un tableau d'objets Port instanciés.
     *
     * @return array
     */
    public function getList() : array
    {
        $ports = [];
        $req = $this->getPDO()->prepare("SELECT nom_court, nom FROM port ORDER BY nom");
        $req->execute();
        while ($donnees = $req->fetch(PDO::FETCH_ASSOC))
        {
            $ports[$donnees['nom_court']] = new Port($donnees['nom_court'], $donnees['nom']);
        }
        return $ports;
    }

}
