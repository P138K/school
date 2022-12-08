<?php
    function deleteMatiere($id){
        global $db;
        $sql = "
            DELETE FROM matiere
            WHERE idmatiere={$id}
        ";
        return $db -> exec($sql);
    };
?>
<?php
    $ok=deleteMatiere($_GET['id']);
    if($ok==1){
        header("location:?page=matiereList");
    }else{
        header("location:?page=404");
    }
?>