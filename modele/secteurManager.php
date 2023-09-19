<?php
require_once("modele/Manager.php");
require_once("modele/Secteur.php");

class SecteurManager extends Manager
{
    /**
     * instancie et renvoie un objet secteur correspondant à l'id passé en paramètre.
     *
     * @param int $id
     * @return Secteur
     */
    public function get(int $unId) : Secteur
    {
        $req = $this->getPDO()->prepare("SELECT id, nom FROM secteur WHERE id = :id");
        $req->bindValue(':id', $unId, PDO::PARAM_INT);
        $req->execute();
        $donnees = $req->fetch(PDO::FETCH_ASSOC);
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
        $req = $this->getPDO()->prepare("SELECT id, nom FROM secteur ORDER BY nom");
        $req->execute();
        while ($donnees = $req->fetch(PDO::FETCH_ASSOC))
        {
            $secteurs[$donnees['id']] = new Secteur($donnees['id'], $donnees['nom']);
        }
        return $secteurs;
    }
}
?>
