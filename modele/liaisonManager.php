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
     * @param int $id
     * @return Liaison
     */
    public function get(int $id) : Liaison
    {
        $portManager = new PortManager(); // Création d'un manager de port
        $secteurManager = new SecteurManager(); // Création d'un manager de secteur

        $q = $this->getPDO()->query('SELECT * FROM liaison WHERE id = '.(int) $id); // requête SQL
        $donnees = $q->fetch(PDO::FETCH_ASSOC); // récupération du résultat de la requête SQL

        $portDepart = $portManager->get($donnees['portDepart']) ; // on va cherche l'objet port dans la collection à la clé $donnees['idPortDepart']
        $portArrivee = $portManager->get($donnees['portArrivee']) ; // on va cherche l'objet port dans la collection à la clé $donnees['idPortArrivee']
        $secteur = $secteurManager->get($donnees['codeSecteur']) ; // on va cherche l'objet secteur dans la collection à la clé $donnees['idSecteur']

        return new Liaison($donnees['code'], $secteur, $donnees['distance'], $portDepart, $portArrivee); // instanciation et renvoi de l'objet Liaison
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
        $secteurs = $secteurManager->getList(); // récupération de la collection des secteurs
        $ports = $portManager->getList(); //  récupération de la collection des ports

        $liaisons = []; // création du tableau qui va contenir les objets Liaison
        $q = $this->getPDO()->query('SELECT * FROM liaison ORDER BY codeSecteur'); // requête SQL

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) // construction des objets Liaison un par un
        {
            $portDepart = $ports[$donnees['portDepart']] ; // on va cherche l'objet port dans la collection à la clé $donnees['idPortDepart']
            $portArrivee = $ports[$donnees['portArrivee']] ; // on va cherche l'objet port dans la collection à la clé $donnees['idPortArrivee']
            $secteur = $secteurs[$donnees['codeSecteur']] ; // on va cherche l'objet secteur dans la collection à la clé $donnees['idSecteur']
            $liaisons[$donnees['code']] = new Liaison($donnees['code'], $secteur, $donnees['distance'], $portDepart, $portArrivee); // instanciation et ajout de l'objet Liaison dans le tableau
        }

        return $liaisons; // renvoi du tableau contenant les objets Liaison
    }

    public function getListBySecteur($secteur) : array
    // on passe la référence de l'objet secteur
    {
        $portManager = new PortManager(); // Création d'un manager de port
        $secteurManager = new SecteurManager(); // Création d'un manager de secteur  
        $ports = $portManager->getList(); // récupération de la collection des ports

        $liaisons = []; // création du tableau qui va contenir les objets Liaison
        $q = $this->getPDO()->query('SELECT * FROM liaison WHERE codeSecteur = '.(int) $secteur->getId()); // requête SQL

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $portDepart = $ports[$donnees['portDepart']] ; // on va cherche l'objet port dans la collection à la clé $donnees['idPortDepart']
            $portArrivee = $ports[$donnees['portArrivee']] ; // on va cherche l'objet port dans la collection à la clé $donnees['idPortArrivee']
            $liaisons[$donnees['code']] = new Liaison($donnees['code'], $secteur, $donnees['distance'], $portDepart, $portArrivee); // instanciation et ajout de l'objet Liaison dans le tableau
        }

        return $liaisons; // renvoi du tableau contenant les objets Liaison
    }


}
?>