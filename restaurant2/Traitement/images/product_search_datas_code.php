<?php
session_start();
include '../bdd/connexion.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include '../../FUNCTION/hebergement.php';
$json = array();
$json['message'] = ''; 
$json['s'] =False; 

$motif=strtolower(trim($_GET['motif']));

//$json['nompos'] = ''; 
//if($ml==''){
//   $json['message'] = 'vide'; 
//}elseif($libelle==''){
//    $json['message'] = 'Veuillez entrer le nom du sous-site'; 
//}elseif($taux==''){
//    $json['message'] = 'Veuillez entrer le taux du sous-site'; 
//}elseif($remise==''){
//    $json['message'] = 'Veuillez entrer la remise'; 
//}
//else{

$idprod = 0;
$designation = '';
$prix = 0;
$repas = 0;
    
$requete = $bdd->prepare("SELECT prod.idprod,prod.designation,prod.qte_min,prod.repas,prod.monnaie,p.id_prix,p.prix_vente
    FROM stk_produit AS prod, t_prix_produit AS p
    WHERE prod.idprod=p.produit_id AND prod.code=:code AND p.sousresto_id=:sousresto_id");
$requete->BindParam(':code',$motif);
$requete->BindParam(':sousresto_id',$_SESSION['id_sousresto']);
$requete->execute();
$produits = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($produits as $prod): 
    $idprod = $prod->idprod;
    $designation = $prod->designation;
    $monnaie = $prod->monnaie;
    $prix = montant_equivalent_bdd($monnaie,$m_affiche,$tauxdollar, $prod->prix_vente);
    $repas = $prod->repas;
endforeach;
    
$json['s'] =True; 
 $_SESSION['idprod'] = $idprod;
 $_SESSION['designation'] = $designation;
 $_SESSION['prix']=$prix ;
 $_SESSION['repas']=$repas ;
 
$json['idprod'] =$idprod;
$json['designation'] =$designation;
$json['prix'] =$prix;
$json['repas'] =$repas;

$json['message'] = 'succes'; 

//}
echo json_encode($json);


