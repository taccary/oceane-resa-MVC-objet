<?php

/**
 * getTraverseesByLiaisonAndDate : Retourne l'ensemble des traversées pour une liaison et une date données
 *
 * @param integer $idLiaison
 * @param string $date
 * @return array
 */
function getTraverseesByLiaisonAndDate(int $idLiaison, string $date) : array {
    $resultat = array();
    try {
        $cnx = getPDO();
        $req = $cnx->prepare("SELECT * FROM traversee T JOIN bateau B ON B.id=T.idBateau
        where codeLiaison=:idLiaison
        AND date=:date
        ORDER BY heure");
        $req->bindValue(':idLiaison', $idLiaison, PDO::PARAM_INT);
        $req->bindValue(':date', $date, PDO::PARAM_STR);
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
 * getPlacesTraverseesByLiaisonAndDate : Retourne l'ensemble des traversées pour une liaison et une date données avec le nb de places totales pour chaque categorie dans ce bateau
 * retourne un tableau associatif de la forme [numTraversee][lettreCategorie] = nbPlacesMax
 * 
 * @param [type] $idLiaison
 * @param [type] $date
 * @return array
 */
function getPlacesTraverseesByLiaisonAndDate(int $idLiaison, string $date) : array {
    
    $resultat = array();
    try {
        $cnx = getPDO();
        $req = $cnx->prepare("SELECT num, idBateau FROM traversee T where codeLiaison=:idLiaison AND date=:date");
        $req->bindValue(':idLiaison', $idLiaison, PDO::PARAM_INT);
        $req->bindValue(':date', $date, PDO::PARAM_STR);
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $req2 = $cnx->prepare("SELECT * FROM contenance_bateau where idBateau=:id");
            $req2->bindValue(':id', $ligne['idBateau'], PDO::PARAM_INT);
            $req2->execute();              
            $ligne2 = $req2->fetch(PDO::FETCH_ASSOC);
            while ($ligne2) {

                $resultat[$ligne['num']][$ligne2['lettreCategorie']] = intval($ligne2['capaciteMax']);                   
                $ligne2 = $req2->fetch(PDO::FETCH_ASSOC);
            }
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

/**
 * getPlacesReservesTraversees : Compte le nb de place reservées dans detail_reservation pour chaque traversée et categorie
 * retourne un tableau associatif de la forme [numTraversee][lettreCategorie] = nbPlacesReservees
 *
 * @return array
 */
function getPlacesReservesTraversees() : array {
    $resultat = array();
    try {
        
        // code à écrire

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}


if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog principal de test
    header('Content-Type:text/plain');

    echo "getTraverseesByLiaisonAndDate(1, '2020-01-01') : \n";
    print_r(getTraverseesByLiaisonAndDate(1, '2020-01-01'));

    echo "getPlacesTraverseesByLiaisonAndDate(1, '2020-01-01') : \n";
    print_r(getPlacesTraverseesByLiaisonAndDate(1, '2020-01-01'));

    echo "getPlacesReservesTraversees() : \n";
    print_r(getPlacesReservesTraversees());

}
?>