<?php

/**
 * getLiaisons : Retourne l'ensemble des liaisons avec les noms des ports de départ et d'arrivée
 *
 * @return array
 */
function getLiaisons() : array {
    //$resultat = array();
    try {
        $secteurs = getSecteurs();
        foreach ($secteurs as $secteur) {
            $resultat[$secteur['id']]['nom'] = $secteur['nom'];
            $resultat[$secteur['id']]['liaisons'] = array();
            $resultat[$secteur['id']]['liaisons'] = getLiaisonsBySecteurLignes($secteur['id']);
        }
        
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

/**
 * getLiaisonsBySecteur : Retourne l'ensemble des liaisons pour un secteur donné
 *
 * @param integer $idSecteur
 * @return array
 */
function getLiaisonsBySecteur(int $idSecteur) : array {
    //$resultat = array();
    try {
        $resultat[$idSecteur]['nom'] = getSecteurById($idSecteur)['nom'];
        $resultat[$idSecteur]['liaisons'] = getLiaisonsBySecteurLignes($idSecteur);

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

/**
 * getLiaisonsBySecteurLignes : Retourne l'ensemble des liaisons pour un secteur donné avec les noms des ports de départ et d'arrivée
 *
 * @param integer $idSecteur
 * @return array
 */
function getLiaisonsBySecteurLignes(int $idSecteur) : array {
    $resultat = array();
    try {
        $cnx = getPDO();
        $req = $cnx->prepare("SELECT L.code, L.distance, PD.nom as portDepart, PA.nom as portArrivee FROM liaison L 
        JOIN port PD on PD.nom_court=L.portDepart 
        JOIN port PA on PA.nom_court=L.portArrivee
        where L.codeSecteur=:idSecteur");
        $req->bindValue(':idSecteur', $idSecteur, PDO::PARAM_INT);
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

/**
 * getLiaisonsLignes : Retourne l'ensemble des liaisons avec les noms des ports de départ et d'arrivée
 *
 * @return array
 */
function getLiaisonsLignes() : array {
    $resultat = array();
    try {
        $cnx = getPDO();
        $req = $cnx->prepare("SELECT L.code, L.codeSecteur, L.distance, PD.nom as portDepart, PA.nom as portArrivee FROM liaison L 
        JOIN port PD on PD.nom_court=L.portDepart 
        JOIN port PA on PA.nom_court=L.portArrivee");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

/**
 * getLiaisonById : Retourne une liaison en fonction de son id
 *
 * @param integer $id
 * @return array
 */
function getLiaisonById(int $id) : array {
    try {
        $cnx = getPDO();
        $req = $cnx->prepare("SELECT L.code, S.nom, L.distance, PD.nom as portDepart, PA.nom as portArrivee FROM liaison L INNER JOIN secteur S on L.codeSecteur=S.id
        JOIN port PD on PD.nom_court=L.portDepart 
        JOIN port PA on PA.nom_court=L.portArrivee where L.code=:id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog principal de test
    header('Content-Type:text/plain');

    echo "getLiaisons() : \n";
    print_r(getLiaisons());

    echo "getLiaisonsBySecteur(3) \n";
    print_r(getLiaisonsBySecteur(3));

    echo "getLiaisonById(1) : \n";
    print_r(getLiaisonById(1));

    echo "getLiaisonsLignes() : \n";
    print_r(getLiaisonsLignes());

    echo "getLiaisonsBySecteurLignes(3) : \n";
    print_r(getLiaisonsBySecteurLignes(3));
}
?>