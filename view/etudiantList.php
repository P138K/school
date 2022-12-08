<?php
if (!isset($_SESSION["acces"])) {
    header("location: ?page=connexion");
    die();
}
?>
<?php
    function getEtudiants(){
        global $db;
        $sql="select * FROM etudiant e, formation f
        WHERE e.idformation=f.idformation
        ORDER BY nom";
        // $result = $db->query($sql);
        // $data = $result->fetchAll();
        return $db->query($sql)->fetchAll(2);
    }
?>
<?php
    $etudiants = getEtudiants();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Etudiants</title>
</head>
<body>
    <h2>LES Etudiant</h2>
    <a href="?page=addUser" class="btn btn-outline-success">Ajout d'un etudiant</a>
    <table class="table table-bordered table-striped text-center mt-3">
        <tr class="table-warning">
            <th>Nom</th>
            <th>Prenom</th>
            <th>Telephone</th>
            <th>Email</th>
            <th>Formation</th>
            <th colspan="2">Action</th>
        </tr>
        <?php foreach ($etudiants as $e) { ?>
        <tr class="table-success">
            <td><?= strtoupper($e["nom"]) ?></td>
            <td><?= ucwords($e["prenom"]) ?></td>
            <td><?= $e["telephone"] ?></td>
            <td><?= $e["email"] ?></td>
            <td><?= $e["libellef"] ?></td>
            <td>
                <a href="?page=deleteEtudiant&id=<?=$e['matricule']?>" class="btn btn-outline-danger  btn-small">Supprimer</a>
            </td>
            <td>
                <a href="?page=noteEtudiantList&id=<?=$e['matricule']?>" class="btn btn-outline-warning  btn-small">Notes</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>