<?php
/*PDO::FETCH_ASSOC = 2
PDO::FETCH_NUM = 3 */
/*
getPatients() est une fonction qui retourne les patients(etat1) par ordre alphabetique sur le nom
*/
    function getPatients(){
        global $db;
        $sql="select * FROM patient p, maladie m 
        WHERE p.idMaladie=m.idMaladie and p.etat=1 
        ORDER BY nomPat";
        // $result = $db->query($sql);
        // $data = $result->fetchAll();
        return $db->query($sql)->fetchAll(2);
    }
/*
savePatients() est une fonction qui reçoit les informations d'un patient et les sauvegardes dans la table patient de la BD
*/
    function savePatient($nom,$prenom,$telephone,$adresse,$idMaladie){
        global $db;
        $sql="INSERT INTO patient(idPat,nomPat,prenomPat,telephonePat,adressePat,idMaladie) VALUES(null,'$nom','$prenom','$telephone','$adresse',$idMaladie)";
        return $db->exec($sql);
    }
/*
getPatientId() est une fonction qui retourne les informations d'un patient via son id
*/
    function getPatientbyId($id){
        global $db;
        $sql = "
            SELECT *
            From patient p, maladie m
            WHERE p.idMaladie = m.idMaladie and p.etat=1 and idPat={$id}
        ";
        return $db -> query($sql)->fetch(PDO::FETCH_ASSOC);
    }
/*
updatePatient() est une fonction qui permet de modifier les informations d'un patient via son id
*/
function updatePatient($id,$nom,$prenom,$telephone,$adresse,$idMaladie){
    global $db;
    $sql = "
        UPDATE patient
        SET nomPat = '$nom',
            prenomPat='$prenom',
            telephonePat='$telephone',
            adressePat='$adresse',
            idMaladie='$idMaladie'
        WHERE idPat={$id}
    ";
    return $db -> exec($sql);
}
/*
deletePatient() est une fonction qui permet de supprimer les informations d'un patient via son id
*/
function deletePatient($id){
    global $db;
    $sql = "
        DELETE FROM patient
        WHERE idPat={$id}
    ";
    return $db -> exec($sql);
};
?>