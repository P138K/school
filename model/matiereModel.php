<?php
    function getMatiere(){
        global $db;
        $sql = "SELECT *
            FROM matiere
            ORDER BY libellem
        ";
        return $db->query($sql)->fetchAll(2);
    }
