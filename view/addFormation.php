<?php
function saveFormation($libellef)
{
  global $db;
  $sql = "INSERT INTO formation(idformation,libellef) VALUES(null,'$libellef')";
  return $db->exec($sql);
}
?>
<?php
$msg = "";
$ok = 0;
if (isset($_POST["valider"])) {
  $libellef = $_POST["nomFormation"];
  $ok = saveFormation($libellef);
}
?>

<?php
$matieres = getMatiere();
// var_dump($matiere);
?>

<h2 class="display-4 mb-3">Formulaire d'ajout d'une Formation</h2>
<?php
if (isset($ok)) {
  if ($ok == 1)
    $msg = "<h3 class='alert alert-success'>Formation ajouté avec succès!</h3>";
  else
    $msg = "<h3 class='alert alert-danger'>Formation non ajouté! Veuillez contacter l'administrateur(77 777 77 77)</h3>";
  echo $msg;
}
?>
<form class="form-row text-center" method="POST">
  <div class="col-md-12 mb-3">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">Nom Formation</span>
      </div>
      <input type="text" class="form-control" name="nomFormation" required>
    </div>
  </div>
  <div style="margin-left:500px" class="mt-3">
    <input type="submit" class="btn btn-outline-dark" value="Enregistrer" name="valider">
  </div>
  </div>
</form>