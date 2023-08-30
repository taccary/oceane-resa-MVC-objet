<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}

$numTraversee = $_POST['numTraversee'];
$titre = "Reservation sur la traversée ". $numTraversee;
// appel du script de vue qui permet de gerer l'affichage des donnees
include "$racine/vue/header.php";
include "$racine/vue/vueReseveTraversee.php";
include "$racine/vue/footer.php";

?>