<?php
function getFormation()
{
    global $db;
    $sql = "
            SELECT *
            FROM formation f, etudiant e
            WHERE f.idformation = e.idformation
            ORDER BY libellef
        ";
    return $db->query($sql)->fetchAll(2);
}
function getEtudiantbyId($id)
{
    global $db;
    $sql = "
            SELECT *
            From etudiant e, formation f
            WHERE e.idformation = f.idformation and e.matricule={$id}
        ";
    return $db->query($sql)->fetch(PDO::FETCH_ASSOC);
}
function updateEtudiant($matricule, $nom, $prenom, $telephone, $email, $idformation)
{
    global $db;
    $sql = "
            UPDATE medecin
            SET nom = '$nom',
                prenom='$prenom',
                telephone='$telephone',
                address='$email',
                idformation='$idformation'
            WHERE matricule={$matricule}
        ";
    return $db->exec($sql);
}
?>
<?php
$msg = "";
$id = $_SESSION["matricule"];
$formation = getFormation();
$etudiant = getEtudiantbyId($id);
$ok = 0;
if (isset($_POST["modifier"])) {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $telephone = $_POST["telephone"];
    $email = $_POST["email"];
    $idformation = $_POST["idformation"];
    $ok = updateEtudiant($matricule, $nom, $prenom, $telephone, $email, $idformation);
    if ($ok == 1) {
        echo '<div class="alert alert-success" role="alert"><a href="?page=deconnexion" class="alert-link">se déconnecter</a> pour voir la nouvelle modification.</div>';
        //$msg="<h3 class='alert alert-success'>Modification Effectuée!</h3>";
        //echo $msg;
    }
}
?>
<?php
function updateMdpEtu($matricule, $nmdp)
{
    global $db;
    $sql = "
            UPDATE etudiant
            SET pssword = '$nmdp'
            WHERE matricule={$matricule}
        ";
    return $db->exec($sql);
}
?>
<?php
$msg = "";
$id = $_SESSION["matricule"];
$medecin = getEtudiantbyId($id);
$ok = 0;
if (isset($_POST["valider"])) {
    $amdp = htmlspecialchars($_POST["amdp"]);
    $nmdp = $_POST["nmdp"];
    $cmdp = $_POST["cmdp"];
    $amdp = hash("sha256", $amdp);
    $nmdp = hash("sha256", $nmdp);
    $cmdp = hash("sha256", $cmdp);
    if ($_SESSION["pssword"] === $amdp) {
        if (strlen($nmdp)>=8) {
            if ($nmdp === $cmdp) {
                $ok = updateMdpEtu($id, $nmdp);
                if ($ok == 1) {
                    $msg = "<h3 class='alert alert-success'>Modification Effectuée!</h3>";
                    echo $msg;
                }
            } else {
                echo "Nouveau mot de passe incorrect";
            }
        } else {
            echo "minimum 8 caractères!";
        }
    } else {
        echo "Ancien mot de passe incorrect";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profil</title>
</head>

<body>
    <div class="text-primary">
        <h3 class="text-center">MODIFIER PROFIL</h3>
    </div>
    <form action="" method="POST">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-3" src="assets/img/medecinH.jpg"><span class="font-weight-bold"><?php echo 'Dr ' . $_SESSION["nom"] . '' ?></span><span class="text-black-50"><?php echo $_SESSION["email"]; ?></span></div>
            </div>
            <div class="col-md-5 border-right">
                <div class="row mt-5">
                    <div class="col-md-6"><label class="labels">
                            <div class="text-primary">NOM:</div>
                        </label><input type="text" class="form-control" placeholder="" value="<?php echo $_SESSION["nom"]; ?>" name="nom" required></div>
                    <div class="col-md-6"><label class="labels">
                            <div class="text-primary">PRENOM:</div>
                        </label><input type="text" class="form-control" placeholder="" value="<?php echo $_SESSION["prenom"]; ?>" name="prenom" required></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">
                            <div class="text-primary">TELEPHONE:</div>
                        </label><input type="text" class="form-control" placeholder="" value="<?php echo $_SESSION["telephone"]; ?>" name="telephone" required></div>
                    <div class="col-md-12"><label class="labels">
                            <div class="text-primary">EMAIL:</div>
                        </label><input type="text" class="form-control" placeholder="" value="<?php echo $_SESSION["email"]; ?>" name="email" required></div>
                    <div class="col-md-12"><label class="labels">
                            <div class="text-primary">FORMATION</div>
                        </label>
                        <select class="custom-select" name="idformation">
                            <option>-- Selectionnez une Formation --</option>
                            <?php foreach ($formation as $f) { ?>
                                <?php $selected = ($etudiant["idformation"] == $f["idformation"]) ? "felected" : ""; ?>
                                <option <?= $selected ?> value="<?= $f['idformation'] ?>"><?= $f['libellef'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="mt-5 text-center"><input type="submit" class="btn btn-primary profile-button" value="Sauvegarder" name="modifier"></div>
            </div>
            <div class="col-md-4 mt-5">
                <p>Changer Mot de passe</p>
                <input type="password" id="Password" class="form-control mb-4" placeholder="ancien mot de passe" name=amdp>
                <input type="password" id="Password" class="form-control mb-4" placeholder="nouveau mot de passe" name=nmdp>
                <input type="password" id="Password" class="form-control mb-4" placeholder="confirmation mot de passe" name=cmdp>
                <div class="mt-5 text-center"><input type="submit" class="btn btn-primary profile-button" value="Enregistrer" name="valider"></div>
            </div>
        </div>
    </form>
</body>

</html>