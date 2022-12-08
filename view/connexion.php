<?php
$msg="";
    if(isset($_POST["valider"])){
        $pseudo= htmlspecialchars($_POST["pseudo"]);
        $mdp= htmlspecialchars($_POST["mdp"]);
        if(!empty($pseudo) && !empty($mdp)){
            $control = $db->prepare("SELECT matricule, nom, prenom, email, telephone, pssword FROM etudiant WHERE email= ?");
            $control->execute(array($pseudo));
            $donnee = $control->fetch();
            $row = $control->rowCount();
            if($row == 1){
                if(filter_var($pseudo, FILTER_VALIDATE_EMAIL)){
                    $mdp = hash("sha256", $mdp);
                    if($donnee["pssword"] === $mdp){
                        $_SESSION["acces"] = "ok";
                        $_SESSION["matricule"] = $donnee["matricule"];
                        $_SESSION["nom"] = $donnee["nom"];
                        $_SESSION["prenom"] = $donnee["prenom"];
                        $_SESSION["email"] = $donnee["email"];
                        $_SESSION["telephone"] = $donnee["telephone"];
                        $_SESSION["pssword"] = $donnee["pssword"];
                        header("location: ?page=accueil");
                    }else{
                        $msg="<h3 class='alert alert-danger'>Erreur de Connexion</h3>";
                    }
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>connexion</title>
	<link rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css">
</head>
<body>
			<!-- Default form login -->
<form method="POST" class="text-center border grey border-light p-5">
    <?php echo $msg; ?>

    <p class="h4 mb-4">AUTHENTIFICATION</p>

    <!-- Email -->
    <input type="email" id="pseudo" class="form-control mb-4" placeholder="saisissez votre E-mail" name="pseudo" required>

    <!-- Password -->
    <input type="password" id="Password" class="form-control mb-4" placeholder="saisissez votre mot de passe" name=mdp required>

    <div class="d-flex justify-content-around">
        <div>
            <!-- Remember me -->
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
                <label class="custom-control-label" for="defaultLoginFormRemember">se rappeler de moi</label>
            </div>
        </div>
        <div>
            <!-- Forgot password -->
            <a href="">mot de passe oublié?</a>
        </div>
    </div>

    <!-- Sign in button -->
    <input class="btn btn-info btn-block my-4" type="submit" value="Se connecter" name="valider">

    <!-- Register -->
    <p>non inscrit?
        <a href="?page=addUser" class="btn btn-outline-success">créer un compte</a>
    </p>

</form>
<!-- Default form login -->

</body>
</html>