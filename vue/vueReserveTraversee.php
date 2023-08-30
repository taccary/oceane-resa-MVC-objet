
<h1><?= $titre ?></h1>
<div class="row">
  

Liaison <?= $infosTraversee['portDepart'] ?> – <?= $infosTraversee['portArrivee'] ?> <br/>
Traversée n°<?= $infosTraversee['num'] ?> le <?= $infosTraversee['date'] ?> à <?= $infosTraversee['heure'] ?> <br/>
Saisir les informations relatives à la réservation <br/>

<form method="POST" action="?action=confirmation">
  <div class="form-group">
    <label for="nom">Nom</label>
    <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
  </div>
  <div class="form-group">
    <label for="adresse">Adresse</label>
    <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" required>
  </div>
  <div class="form-group">
    <label for="codePostal">Code postal</label>
    <input type="text" class="form-control" id="codePostal" name="codePostal" placeholder="Code postal" required> 
  </div>

    <label for="ville">Ville</label>
    <input type="text" class="form-control" id="ville" name="ville" placeholder="Ville" required>
  </div>

  <h2>Choix des places</h2>
  <div class="form-group">
    <table>
      <thead>
        <tr>
          <th>Type de billet</th>
          <th>Tarif</th>
          <th>Nombre de places</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tarifs as $tarif) { ?>
          <tr>
            <td><?= $tarif['type'] ?></td>
            <td><?= $tarif['tarif'] ?></td>
            <td><input type="number" name="places[<?= $tarif['idCategorie'] ?>-<?= $tarif['idType'] ?>]" min="0"></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>


  <input type="hidden" name="traversee" value="<?= $numTraversee ?>">
  <button type="submit" class="btn btn-primary">Confirmer la réservation</button>
</form>

</div>