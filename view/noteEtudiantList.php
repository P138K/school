<?php
if (!isset($_SESSION["acces"])) {
    header("location: ?page=connexion");
    die();
}
?>


<?php
function getNote($id)
{
    global $db;
    $sql = "SELECT distinct libellem, notee
            FROM note n, matiere m
            WHERE n.idmatiere = m.idmatiere AND n.matricule={$id}
            ORDER BY notee
        ";
    return $db->query($sql)->fetchAll(2);
}
?>
<?php
function getEtudiantByid($id)
{
    global $db;
    $sql = "SELECT prenom, nom
        FROM etudiant e
        WHERE e.matricule={$id}
    ";
    return $db->query($sql)->fetchAll();
}
?>

<?php
$etudiant = GetEtudiantByid($_GET['id']);
$notes = getNote($_GET['id']);
// var_dump($matiere);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Notes</title>
</head>

<body>
    <h2 class="text-center text-primary">Notes de <?php echo($etudiant[0]["prenom"]); ?></h2>
    <table class="table table-bordered table-striped text-center mt-3">
        <tr class="table-primary">
            <th>Matières</th>
            <th colspan="2">Notes</th>
        </tr>

        <?php foreach ($notes as $nt) { ?>
            <tr class="table-success">
                <td><?= $nt["libellem"] ?></td>
                <td>
                    <?= $nt["notee"] ?></td>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>