<?php
if (!isset($_SESSION["acces"])) {
    header("location: ?page=connexion");
    die();
}
?>
<?php
$matieres = getMatiere();
// var_dump($matiere);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Liste des Matières</title>
</head>

<body>
    <h2>LES MATIERES</h2>
    <a href="?page=addMatiere" class="btn btn-outline-success">Ajout d'une matiere</a>
    <table class="table table-bordered table-striped text-center mt-3">
        <tr class="table-warning">
            <th>Matiere</th>
            <th colspan="2">Action</th>
        </tr>
        <?php foreach ($matieres as $mt) { ?>
            <tr class="table-success">
                <td><?= $mt["libellem"] ?></td>
                <td>
                    <a href="?page=deleteMatiere&id=<?= $mt['idmatiere'] ?>" class="btn btn-outline-danger  btn-small">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>