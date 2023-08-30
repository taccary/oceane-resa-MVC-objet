<?php

/**
 * Retourne la liste des ports
 *
 * @return array
 */
function getPorts() : array{
    $resultat = array();

    try {
        $cnx = getPDO();
        $req = $cnx->prepare("SELECT * FROM port");
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
 * Retourne le port dont l'id est passé en paramètre
 *
 * @param integer $id
 * @return array
 */
function getPortById(int $id) : array{
    try {
        $cnx = getPDO();
        $req = $cnx->prepare("SELECT nom FROM port WHERE id=:id");
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

    echo "getPorts() : \n";
    print_r(getPorts());

    echo "getPortById(1) : \n"; 
    print_r(getPortById(1));

}
?>