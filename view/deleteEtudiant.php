<?php
    if($_SESSION["prenom"]!="papyto"){
        echo '<script>alert("Non Autorisé")</script>';
        header("location: ?page=etudiantList");
       // die();
    }
?>
<?php
    function deleteEtudiant($id){
        global $db;
        $sql = "
            DELETE FROM etudiant
            WHERE matricule={$id}
        ";
        return $db -> exec($sql);
    };
?>
<?php
    $msg="";
    $ok=deleteEtudiant($_GET['id']);
    if($ok==1){
        header("location: ?page=etudiantList");
    }else{
        header("location: ?page=404");
    }
?>