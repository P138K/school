<?php

    require_once "constantes.php";

    try {
        $db = new PDO("mysql:host=". HOST .";port=".PORT.";dbname=". DATABASE , USER, PASSWORD,
            array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
            )
        );
        // echo"Connexion réussi";
    }catch (PDOException $ex){
        die("Erreur de connexion à la base de données");
    }