<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../bdd/connexion.php';
include '../../FUNCTION/restaurant.php';
$json = array();
$id_client =$_GET['id_client'];
$data = FusionIDs($id_client,$bdd);
$requete = $bdd->prepare("DELETE FROM  t_client WHERE id_client=:id_client");
$requete->BindParam(':id_client', $id_client);
$requete->execute();
//Differentes MAJ
 $nbre = count($data['ids']);
 for ($i = 0; $i < $nbre; $i++) {
     $id_client2= $data['ids'][$i];
     $en_attente = 1;
     $pseudo_supp =0;
     $requete = $bdd->prepare("UPDATE t_client SET pseudo_supp=:pseudo_supp,en_attente=:en_attente WHERE id_client=:client_id");
     $requete->BindParam(':pseudo_supp', $pseudo_supp);
     $requete->BindParam(':en_attente', $en_attente);
     $requete->BindParam(':client_id', $id_client2);
     $requete->execute();
 }
 //Differentes MAJ
$json['succes'] = True;
echo json_encode($json);