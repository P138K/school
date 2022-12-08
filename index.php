<?php
    require_once "config/connexion.php";
    require_once "model/patientModel.php";
    require_once "model/matiereModel.php";
    session_start();
    
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hopital_App</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php
        require_once "view/navBar.php"; 
?>
<div class="mt-5 container jumbotron" align="center">
    <?php
        $page = isset($_GET["page"]) ? $_GET["page"] : "accueil";
        $page .=".php";
        $view = scandir("view");
        // var_dump($view);
        if(!in_array($page,$view))$page="404.php";
        require_once "view/".$page; 
    ?>
</div>

<script src="assets/js/jquery.js"></script>
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.js"></script>
</body>
</html>