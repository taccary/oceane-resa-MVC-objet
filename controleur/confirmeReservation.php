<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
$titre = "Erreur lors de la réservation";
$vue = "echec de réservation";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nom = $_POST['nom'];
  $adresse = $_POST['adresse'];
  $codePostal = $_POST['codePostal'];
  $ville = $_POST['ville'];
  $traversee = $_POST['traversee'];
  $places = $_POST['places'];
  $infosTraversee = getTraverseeById($traversee);
  // Faire quelque chose avec les données récupérées...
  $idReservation = getIdDerniereReservation() + 1;
  if (setReservation($idReservation, $nom, $adresse, $codePostal, $ville, $traversee, $places)){
    $titre = "Reservation confirmée";
    $details = getDetailsReservation($idReservation);
    $vue = "$racine/vue/vueConfirmeReservation.php";
  } 
}


$titre = "Reservation confirmée";
// appel du script de vue qui permet de gerer l'affichage des donnees
include "$racine/vue/header.php";
include $vue;
include "$racine/vue/footer.php";

?>