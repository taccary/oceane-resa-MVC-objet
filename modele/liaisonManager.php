<?php
require_once("modele/Manager.php");
require_once("modele/Liaison.php");
require_once("modele/PortManager.php");
require_once("modele/SecteurManager.php");

class LiaisonManager extends Manager
{
    /**
     * instancie et renvoie un objet liaison correspondant au code passé en paramètre.
     *
     * @param [type] $id
     * @return Liaison
     */
    public function get($id) : Liaison
    {
        $portManager = new PortManager(); // Création d'un manager de port
        $secteurManager = new SecteurManager(); // Création d'un manager de secteur
        $q = $this->getPDO()->query('SELECT * FROM liaison WHERE id = '.(int) $id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        $portDepart = $portManager->get($donnees['portDepart']) ;
        $portArrivee = $portManager->get($donnees['portArrivee']) ;
        $secteur = $secteurManager->get($donnees['codeSecteur']) ;

        return new Liaison($donnees['code'], $secteur, $donnees['distance'], $portDepart, $portArrivee);
    }

    /**
     * Retourne la liste des liaisons sous forme d'un tableau d'objets Liaison instanciés.
     *
     * @return array
     */
    public function getList() : array
    {
        $portManager = new PortManager(); // Création d'un  manager de port
        $secteurManager = new SecteurManager(); // Création d'un manager de secteur
        $secteurs = $secteurManager->getList();  //  collection secteurs
        $ports = $portManager->getList(); //  collection ports

        $liaisons = [];
        $q = $this->getPDO()->query('SELECT * FROM liaison ORDER BY codeSecteur');

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $portDepart = $ports[$donnees['portDepart']] ; // on va cherche l'objet port dans la collection à la clé $donnees['idPortDepart']
            $portArrivee = $ports[$donnees['portArrivee']] ;
            $secteur = $secteurs[$donnees['codeSecteur']] ;
            $liaisons[$donnees['code']] = new Liaison($donnees['code'], $secteur, $donnees['distance'], $portDepart, $portArrivee);
        }

        return $liaisons;
    }


}
?>