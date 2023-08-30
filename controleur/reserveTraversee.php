<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}

$numTraversee = $_POST['traversee'];
$titre = "Reservation sur la traversée ". $numTraversee;
$infosTraversee = getTraverseeById($numTraversee);

$tarifs = getTarifsPeriode($infosTraversee['idPeriode']);

// appel du script de vue qui permet de gerer l'affichage des donnees
include "$racine/vue/header.php";
include "$racine/vue/vueReserveTraversee.php";
include "$racine/vue/footer.php";

?>