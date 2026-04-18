<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../bdd/connexion.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
$boncommande_id=0;
if(isset($_GET['boncommande_id'])){
    $preparer=1;
    $boncommande_id=$_GET['boncommande_id'];
    
    $requete = $bdd->prepare("UPDATE t_facture  SET preparer=:preparer WHERE id_fact=:id_fact");
    $requete->BindParam(':preparer',$preparer);
    $requete->BindParam(':id_fact',$boncommande_id);
    $requete->execute();
    
}
?>
   
    