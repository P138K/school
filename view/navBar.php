<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <a class="navbar-brand" href="?page=accueil">UVS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="?page=etudiantList">Etudiants<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=formationList">Formations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=matiereList">Matieres</a>
            </li>
        </ul>
        <ul class="navbar-nav mr-5">
            <li class="nav-item dropdown">
                <?php
                    if(!isset($_SESSION["acces"])){
                        echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Anonyme</a>';
                    }else{
                        echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dr '.$_SESSION["nom"].' '.$_SESSION["prenom"].'</a>';
                    }
                ?>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                            if(!isset($_SESSION["acces"])){
                               echo '<a class="nav-link" href="?page=connexion">Se Connecter</a>';
                            }else{
                                //echo '<a class="nav-link" href="?page=medecinList">Medecins</a>';
                                echo '<a class="nav-link" href="?page=profil">Profil</a>';
                                echo '<a class="nav-link" href="?page=deconnexion">Déconnecter</a>';
                            }
                    ?>
                    
                    
                </div>
            </li>
        </ul>

    </div>
</nav>