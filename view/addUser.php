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
    function saveEtudiant($prenom,$nom,$telephone,$email,$password,$idformation){
      global $db;
      $sql="INSERT INTO etudiant(matricule,nom,prenom,telephone,email,pssword,idformation) VALUES(null,'$nom','$prenom','$telephone','$email','$password',$idformation)";
      return $db->exec($sql);
  }
?>
<?php
    $formations=getFormations();
    $msg="";
    $ok=0;
    $idRole = 1;
    if(isset($_POST["valider"])){
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $telephone = $_POST["telephone"];
        $email = $_POST["email"];
        $password = $_POST["pssword"];
        $idformation = $_POST["idformation"];
        $password = hash("sha256", $password);
        $ok= saveEtudiant($nom,$prenom,$telephone,$email,$password,$idformation);
    }
?>
<h2 class="display-4 mb-3">Formulaire d'ajout d'un etudiant</h2>
<?php 
    if(isset($ok)){
        if($ok==1)
            $msg="<h3 class='alert alert-success'>Etudiant ajouté avec succès!</h3>";
        else
        $msg="<h3 class='alert alert-danger'>Etudiant non ajouté! Veuillez contacter l'administrateur(77 777 77 77)</h3>";
        echo $msg;
    }
?>

<form class="form-row text-center" method="POST">
    <div class="col-md-12 mb-3">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Nom</span>
        </div>
        <input type="text" class="form-control" name="nom" required>
      </div>
    </div>
    <div class="col-md-12 mb-3">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Prenom</span>
        </div>
        <input type="text" class="form-control" name="prenom" required>
      </div>
    </div>
    <div class="col-md-12 mb-3">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Telephone</span>
        </div>
        <input type="text" class="form-control" name="telephone" required>
      </div>
    </div>
    <div class="col-md-12 mb-3">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Email</span>
        </div>
        <input type="email" class="form-control" name="email" required>
      </div>
    </div>
    <div class="col-md-12 mb-3">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Mot de passe</span>
        </div>
        <input type="password" class="form-control" name="pssword" required>
      </div>
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
    <div style="margin-left:500px" class="mt-3">
        <input type="submit" class="btn btn-outline-primary btn-small" value="Enregistrer" name="valider">
    </div>
  </div>
</form>