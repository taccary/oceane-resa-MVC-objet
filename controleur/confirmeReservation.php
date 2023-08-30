<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nom = $_POST['nom'];
  $adresse = $_POST['adresse'];
  $codePostal = $_POST['codePostal'];
  $ville = $_POST['ville'];
  $traversee = $_POST['traversee'];
  $places = $_POST['places'];
  $numTraversee = $_POST['traversee'];
  $infosTraversee = getTraverseeById($numTraversee);
  // Faire quelque chose avec les données récupérées...
}


$titre = "Reservation confirmée";
// appel du script de vue qui permet de gerer l'affichage des donnees
include "$racine/vue/header.php";
include "$racine/vue/vueConfirmeReservation.php";
include "$racine/vue/footer.php";

?>