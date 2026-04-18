<?php
session_start();
include('config/config.php');
include('language/eng.php');
include('libraries/functions.php');
include_once('libraries/class_dbcon.php');
include_once('libraries/upload_class.php');
include_once('libraries/system_users.php');
$_SESSION['idsite']=107;
    $requete = "SELECT  a.*,b.*
        FROM resemployes AS a,rescontrat AS b 
        WHERE a.id=b.employe_id
        AND a.id_hotel=:id_hotel
        AND b.typecontr='CDI'
        ORDER BY a.id ASC";
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':id_hotel',$_SESSION['idsite']);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    foreach ($result as $row) {
     $employe_id=$row->employe_id;
     $noms=$row->noms;
     $dteng=$row->dteng;
     $query = HDB::hus()->prepare("INSERT resemploye_eligibl(employe_id,noms_employe,dteengag,dte1,site_id)
                                         VALUES(:employe_id,:noms_employe,:dteengag,:dte1,:site_id)");

    $query->BindParam(':employe_id',$employe_id);
    $query->BindParam(':noms_employe',$noms);
    $query->BindParam(':dteengag', $dteng);
    $query->BindParam(':dte1', $dteng);
    $query->BindParam(':site_id',$_SESSION['idsite']);
    $query->execute(); 
    }
?>
	