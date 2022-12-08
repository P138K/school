<?php
    function getFormation(){
        global $db;
        $sql = "SELECT *
            FROM formation
            ORDER BY libellef
        ";
        return $db->query($sql)->fetchAll(2);
    }
