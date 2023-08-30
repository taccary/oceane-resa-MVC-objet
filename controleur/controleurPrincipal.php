<?php
function controleurPrincipal($action) {
    $lesActions = array();
    $lesActions["defaut"] = "accueil.php";
    $lesActions["accueil"] = "accueil.php";
    $lesActions["liaisons"]= "afficheLiaisons.php";
    $lesActions["tarifs"]= "afficheTarifs.php";
    $lesActions["traversees"]= "afficheTraversees.php";
    $lesActions["reservation"]= "reserveTraversee.php";
    $lesActions["confirmation"]= "confirmeReservation.php";

    if (array_key_exists($action, $lesActions)) {
        return $lesActions[$action];
    } else {
        return $lesActions["defaut"];
    }
}
?>

