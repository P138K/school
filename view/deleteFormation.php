<?php
    function deleteFormation($id){
        global $db;
        $sql = "
            DELETE FROM formation
            WHERE idformation={$id}
        ";
        return $db -> exec($sql);
    };
?>
<?php
    $ok=deleteFormation($_GET['id']);
    if($ok==1){
        header("location:?page=formationList");
    }else{
        header("location:?page=404");
    }
?>