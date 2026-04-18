<?php
include('../bdd/connexion.php');
$json = array();
$json['del'] = 'false';
$id = $_GET['id'];
/* $nb = 0;
$bool = 0;
$requete = $bdd->prepare("SELECT COUNT(*) AS nb_lg FROM stk_produit WHERE famille_id=:sfamilleid");
$requete->BindParam(':sfamilleid', $id);
$requete->execute();
$operations = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($operations as $op) :
    $nb = $op->nb_lg;
endforeach;
if ($nb > 0) $bool = 1;

if ($bool == 0) {
    $json['del'] = 'true';
    $requete = $bdd->prepare("DELETE FROM  stk_sous_famille WHERE id_s_fam=:id");
    $requete->BindParam(':id', $id);
    $requete->execute();
} */

$json['del'] = 'true';
$pseudo_supp=1;
$requete = $bdd->prepare("UPDATE stk_sous_famille  SET pseudo_supp =:pseudo_supp WHERE id_s_fam=:id");
$requete->BindParam(':pseudo_supp',$pseudo_supp);
$requete->BindParam(':id',$id);
$requete->execute();
echo json_encode($json);
