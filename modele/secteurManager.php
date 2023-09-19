<?php
require_once("modele/Manager.php");
require_once("modele/Secteur.php");

class SecteurManager extends Manager
{
    /**
     * instancie et renvoie un objet secteur correspondant à l'id passé en paramètre.
     *
     * @param [type] $id
     * @return Secteur
     */
    public function get($id) : Secteur
    {
        $id = (int) $id;
        $q = $this->getPDO()->query('SELECT id, nom FROM secteur WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Secteur($donnees['id'], $donnees['nom']);
    }
  
    /**
     * Retourne la liste des secteurs sous forme d'un tableau d'objets Secteur instanciés.
     *
     * @return array
     */
    public function getList() : array 
    {
        $secteurs = [];
        $q = $this->getPDO()->query('SELECT id, nom FROM secteur ORDER BY nom');
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $secteurs[$donnees['id']] = new Secteur($donnees['id'], $donnees['nom']);
        }
        return $secteurs;
    }
}
?>
