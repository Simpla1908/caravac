<?php
include('../bdd/connexion.php');
$json = array();
$json['del'] = 'false';
$id = $_GET['id'];
/* $nb = 0;
$bool = 0;
$requete = $bdd->prepare("SELECT COUNT(*) AS nb_lg FROM stk_sous_famille WHERE famille=:famille");
$requete->BindParam(':famille', $id);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($operations as $op) :
    $nb = $op->nb_lg;
endforeach;
if ($nb > 0) $bool = 1;

if ($bool == 0) {
    $json['del'] = 'true';
    $requete = $bdd->prepare("DELETE FROM  stk_famille WHERE idfamille=:id");
    $requete->BindParam(':id', $id);
    $requete->execute();
} */

$pseudo_supp=1;
$requete = $bdd->prepare("UPDATE stk_famille  SET pseudo_supp =:pseudo_supp WHERE idfamille=:id");
$requete->BindParam(':pseudo_supp',$pseudo_supp);
$requete->BindParam(':id',$id);
$requete->execute();
$json['del'] = 'true';
echo json_encode($json);