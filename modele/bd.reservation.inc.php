<?php

/**
 * getIdDerniereReservation : Retourne l'id de la dernière réservation
 *
 * @return integer
 */
function getIdDerniereReservation() : int {
    try {
        $cnx = getPDO();
        $req = $cnx->prepare("SELECT max(num) FROM reservation");
        $req->execute();
        $max_num = $req->fetchColumn();
        return $max_num;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}


/**
 * getDetailsReservation : Retourne les détails d'une réservation
 *
 * @param integer $idReservation
 * @return array
 */
function getDetailsReservation(int $idReservation) : array {
    $resultat = array();
    try {
        $cnx = getPDO();
        $req = $cnx->prepare("SELECT * FROM detail_reservation d JOIN type_billet t ON (d.numType, d.lettreCategorie) = (t.idTypeBillet, t.idCategorie) JOIN reservation r ON d.numReservation=r.num JOIN traversee tr ON tr.num = r.numTraversee JOIN tarification ta ON (ta.idCategorie,ta.idTypeBillet, ta.idPeriode) = (t.idCategorie, t.idTypeBillet, tr.idPeriode) WHERE numReservation=918147;:numResa");
        $req->bindValue(':numResa', $idReservation, PDO::PARAM_INT);
        $req->execute();
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

/**
 * setReservation : Ajoute une réservation avec ses détails en base de données
 *
 * @param integer $idReservation
 * @param string $nom
 * @param string $adresse
 * @param string $codePostal
 * @param string $ville
 * @param integer $traversee
 * @param array $places
 * @return boolean
 */
function setReservation(int $idReservation, string $nom, string $adresse, string $codePostal, string $ville, int $traversee, array $places) : bool {
    $resultat = false;
    try {
        $cnx = getPDO();
        $cnx->beginTransaction(); // début de la transaction, on encadre les requetes par une transaction pour être sur que toutes les requetes s'executent correctement ou aucune

        $req = $cnx->prepare("INSERT INTO reservation (num, nom, adr, cp, ville, numTraversee) VALUES (:num, :nom, :adresse, :cp, :ville, :numTraversee)");
        $req->bindValue(':num', $idReservation, PDO::PARAM_INT);
        $req->bindValue(':nom', $nom, PDO::PARAM_STR);
        $req->bindValue(':adresse', $adresse, PDO::PARAM_STR);
        $req->bindValue(':cp', $codePostal, PDO::PARAM_STR);
        $req->bindValue(':ville', $ville, PDO::PARAM_STR);
        $req->bindValue(':numTraversee', $traversee, PDO::PARAM_INT);
        $resultat += $req->execute();

        foreach ($places as $type=>$quantite) {
            if ($quantite > 0) {
                $place = explode('-', $type);
                $categorie = $place[0];
                $type = intval($place[1]);
                $req = $cnx->prepare("INSERT INTO detail_reservation (numReservation, numType, lettreCategorie, quantité) VALUES (:numResa, :numType, :categorie, :quantite)");
                $req->bindValue(':numResa', $idReservation, PDO::PARAM_INT);
                $req->bindValue(':numType', $type, PDO::PARAM_INT);
                $req->bindValue(':categorie', $categorie, PDO::PARAM_STR);
                $req->bindValue(':quantite', $quantite, PDO::PARAM_INT);
                $resultat += $req->execute();
            }  
        }

        $cnx->commit(); // validation de la transaction
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}






if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog principal de test
    header('Content-Type:text/plain');


}
?>