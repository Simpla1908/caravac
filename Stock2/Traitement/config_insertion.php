<?php
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
$json = array();
if (isset($_POST['monnaieInsert'])) {
// Insertion dans la table 
    $monnaieInsert = $_POST['monnaieInsert'];
    $monnaieInsert = trim($monnaieInsert,' ');
    $monnaieAffich= $_POST['monnaieAffich'];
    $taux= $_POST['taux'];
    $tva = $_POST['tva'];
    $remise= $_POST['remise'];
    $stock=$_POST['stock'];
    $json=array();
    if (empty($monnaieInsert)||empty($monnaieAffich)||empty($taux)) {
      $json['message_vide']="vide";
    }  else {
        
        $requete = $bdd->prepare("UPDATE t_reglage SET m_insert=:m_insert,m_affiche=:m_affiche,tauxdollar=:tauxdollar,tva=:tva,remise=:remise,stock=:stock  WHERE id_hotel=:id_hotel");
        $requete->BindParam(':m_insert', $monnaieInsert);
        $requete->BindParam(':m_affiche', $monnaieAffich);
        $requete->BindParam(':tauxdollar', $taux);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->BindParam(':tva',$tva); 
        $requete->BindParam(':remise',$remise);
        $requete->BindParam(':stock',$stock);
        $requete->execute();
       
//        echo"L'enrégistrement s'est effectué avec succès!";
       $json['message_succes']='succes';
        
  }      
    
} 
echo json_encode($json);