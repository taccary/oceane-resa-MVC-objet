<?php

/**
 * getTarifs : Retourne l'ensemble des tarifs pour toutes les periodes
 *
 * @return array
 */
function getTarifs() : array{
    $resultat = array();
    try {
        $cnx = getPDO();
        $req = $cnx->prepare("SELECT libelleCategorie as categorie, libelleTypeBillet as type, tarif, libellePeriode as periode FROM tarification t JOIN periode p ON t.idPeriode=p.idPeriode JOIN type_billet tb ON (t.idCategorie, t.idTypebillet) = (tb.idCategorie, tb.idTypebillet) JOIN categorie c ON t.idCategorie = c.idCategorie ORDER BY t.idCategorie, t.idTypebillet");

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
 * getTarifsPeriode : Retourne l'ensemble des tarifs pour une periode donnée
 *
 * @param string $idPeriode
 * @return array
 */
function getTarifsPeriode(string $idPeriode) : array {
    $resultat = array();
    try {
        $cnx = getPDO();
        $req = $cnx->prepare("SELECT libelleCategorie as categorie, libelleTypeBillet as type, t.idTypeBillet as idType, tarif, libellePeriode as periode FROM tarification t JOIN periode p ON t.idPeriode=p.idPeriode JOIN type_billet tb ON (t.idCategorie, t.idTypebillet) = (tb.idCategorie, tb.idTypebillet) JOIN categorie c ON t.idCategorie = c.idCategorie WHERE t.idPeriode=:idPeriode ORDER BY t.idCategorie, t.idTypebillet");
        $req->bindValue(':idPeriode', $idPeriode, PDO::PARAM_STR);
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
 * getPeriodes : Retourne l'ensemble des periodes
 *
 * @return array
 */
function getPeriodes() :array {
    $resultat = array();

    try {
        $cnx = getPDO();
        $req = $cnx->prepare("SELECT * FROM periode");
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
 * getCategories : Retourne l'ensemble des categories
 *
 * @return array
 */
function getCategories() :array {
    $resultat = array();

    try {
        $cnx = getPDO();
        $req = $cnx->prepare("SELECT * FROM categorie");
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
 * getTypesBillets : Retourne l'ensemble des types de billets avec leur categorie
 *
 * @return array
 */
function getTypesBillets() : array{
    //$resultat = array();

    try {
        $cnx = getPDO();
        $req = $cnx->prepare("SELECT * FROM type_billet JOIN categorie ON type_billet.idCategorie = categorie.idCategorie");
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


if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog principal de test
    header('Content-Type:text/plain');

    echo "getTarifs() : \n";
    print_r(getTarifs());

    echo "getTarifsPeriode('P1') : \n";
    print_r(getTarifsPeriode('P1'));

    echo "getPeriodes() : \n";
    print_r(getPeriodes());

    echo "getCategories() : \n";
    print_r(getCategories());

    echo "getTypesBillets() : \n";
    print_r(getTypesBillets());

}
?>