<?php

/**
 * Retourne la liste des secteurs
 *
 * @return array
 */
function getSecteurs() : array{
    $resultat = array();

    try {
        $cnx = getPDO();
        $req = $cnx->prepare("SELECT * FROM secteur");
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
 * Retourne le secteur dont l'id est passé en paramètre
 *
 * @param integer $id
 * @return array
 */
function getSecteurById(int $id) : array {

    try {
        $cnx = getPDO();
        $req = $cnx->prepare("SELECT * FROM secteur WHERE id=:id");
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

    echo "getSecteurs() : \n";
    print_r(getSecteurs());

    echo "getSecteurById(1) : \n";
    print_r(getSecteurById(1));

}
?>