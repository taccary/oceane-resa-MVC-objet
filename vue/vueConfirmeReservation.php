<?php
?>

<h1><?= $titre ?></h1>
<div class="row">

    Liaison <?= $infosTraversee['portDepart'] ?> – <?= $infosTraversee['portArrivee'] ?> <br/>
    Traversée n°<?= $infosTraversee['num'] ?> le <?= $infosTraversee['date'] ?> à <?= $infosTraversee['heure'] ?> <br/>

    <h2>Recapitulatif de votre réservation</h2>
    Réservation enregistrée sous le n° <?= $idReservation ?> <br/>
    Informations : <?= $nom ?> <?= $adresse ?> <?= $codePostal ?> <?= $ville ?><br/>
    <ul>
    <?php 
        $prixTotal = 0;
        foreach ($details as $detail) { ?>
        <li><?= $detail['libelleTypeBillet'] ?> : <?= $detail['quantité'] ?> à <?= $detail['tarif'] ?> euros soit <?= $detail['quantité'] * $detail['tarif'] ?> euros </li>
    <?php 
        $prixTotal += $detail['quantité'] * $detail['tarif'];
    } ?>
    </ul>


    Montant total à régler : <?= $prixTotal ?> euros </br>
    [Voir les modalités de paiement]

</div>