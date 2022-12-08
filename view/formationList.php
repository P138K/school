<?php
if (!isset($_SESSION["acces"])) {
    header("location: ?page=connexion");
    die();
}
?>

<?php
    function getFormation(){
        global $db;
        $sql = "SELECT *
            FROM formation
            ORDER BY libellef
        ";
        return $db->query($sql)->fetchAll(2);
    }

?>
<?php
$formation = getFormation();
// var_dump($matiere);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Liste des Formations</title>
</head>

<body>
    <h2>LES FORMATIONS</h2>
    <a href="?page=addFormation" class="btn btn-outline-success">Ajout d'une formation</a>
    <table class="table table-bordered table-striped text-center mt-3">
        <tr class="table-warning">
            <th>Formation</th>
            <th colspan="2">Action</th>
        </tr>
        <?php foreach ($formation as $f) { ?>
            <tr class="table-success">
                <td><?= $f["libellef"] ?></td>
                <td>
                    <a href="?page=deleteFormation&id=<?= $f['idformation'] ?>" class="btn btn-outline-danger  btn-small">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>