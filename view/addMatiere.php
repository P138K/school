<?php
    function getFormations(){
        global $db;
        $sql = "
            SELECT *
            FROM formation
            ORDER BY libellef
        ";
        return $db->query($sql)->fetchAll(2);
    }
    function saveMatiere($idformation, $codem, $libellem){
        global $db;
        $sql="INSERT INTO matiere(idmatiere,idformation,codem,libellem) VALUES(null,'$idformation','$codem','$libellem')";
        return $db->exec($sql);
    }
?>
<?php
    $formations=getFormations();
    $msg="";
    $ok=0;
    if(isset($_POST["valider"])){
        $codem = $_POST["codeMatiere"];
        $libellem = $_POST["nomMatiere"];
        $idformation = $_POST["idformation"];
        $ok= saveMatiere($idformation, $codem, $libellem);
    }
?>
<h2 class="display-4 mb-3">Formulaire d'ajout d'une matière</h2>
<?php 
    if(isset($ok)){
        if($ok==1)
            $msg="<h3 class='alert alert-success'>Matière ajouté avec succès!</h3>";
        else
            $msg="<h3 class='alert alert-danger'>Matière non ajouté! Veuillez contacter l'administrateur(77 777 77 77)</h3>";
        echo $msg;
    }
?>
<form class="form-row text-center" method="POST">
    <div class="col-md-12 mb-3">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">code Matière</span>
        </div>
        <input type="text" class="form-control" name="codeMatiere" required>
      </div>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Nom Matière</span>
        </div>
        <input type="text" class="form-control" name="nomMatiere" required>
      </div>
      <div class="col-md-12 mb-3">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Formations</span>
        </div>
        <select class="custom-select" name="idformation">
        <option>-- Selectionnez une formation --</option>
        <?php foreach($formations as $f){ ?>
            <option value="<?= $f['idformation'] ?>"><?= $f['libellef'] ?></option>
        <?php } ?>
        </select>
      </div>
    </div>
    </div>
    
    <div style="margin-left:500px" class="mt-3">
        <input type="submit" class="btn btn-outline-dark" value="Enregistrer" name="valider">
    </div>
  </div>
</form>