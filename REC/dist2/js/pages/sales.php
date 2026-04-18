<?php
// Initialisation de la session
session_start();
include('../../../../bdd/connexion.php');
$data=array();
$data['mois']=array();
$data['encours']=array();
$data['totMoisEncours']=0;
$data['totMoisPrec']=0;
$data['prec']=array();
$data['totCouvertMoisPrec']=0;
$data['totCouvertMoisEncours']=0;
$data['couvertencours']=array();
$data['couvertprec']=array();

$anneEncours=date("Y");
$anneprec= date("Y",strtotime("-1 year"));
$numMois=date('n');

$requete = $bdd->prepare("SELECT MONTH(a.date_edition) AS nummois,MONTHNAME(a.date_edition) AS mois,SUM((b.qte*b.prixremise)/a.taux_prix) AS mont
FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a,
stk_sous_famille AS d,stk_famille AS e,stk_familletype AS f
WHERE a.id_fact=b.commande_id 
AND b.produit_id= c.idprod
AND c.famille_id=d.id_s_fam
AND d.famille=e.idfamille
AND e.familletype_id=f.id
AND a.mode NOT IN ('DON')
AND YEAR(a.date_edition)=:annee
AND a.id_hotel  =:hotel_id 
GROUP BY MONTH(a.date_edition)");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':annee',$anneEncours);
$requete->execute();
$result = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($result as $r) {
    $mont=round($r->mont,2);
    array_push($data['mois'],$r->mois);
    array_push($data['encours'],$mont);

    if($numMois==$r->nummois){
        $data['totMoisEncours']=$mont;
    }elseif($numMois-1==$r->nummois){
        $data['totMoisPrec']=$mont;
    }

}

// Data vente annee precedente
$requete = $bdd->prepare("SELECT MONTH(a.date_edition) AS nummois,MONTHNAME(a.date_edition) AS mois,SUM((b.qte*b.prixremise)/a.taux_prix) AS mont
FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a,
stk_sous_famille AS d,stk_famille AS e,stk_familletype AS f
WHERE a.id_fact=b.commande_id 
AND b.produit_id= c.idprod
AND c.famille_id=d.id_s_fam
AND d.famille=e.idfamille
AND e.familletype_id=f.id
AND a.mode NOT IN ('Don')
AND YEAR(a.date_edition)=:annee
AND a.id_hotel  =:hotel_id 
GROUP BY MONTH(a.date_edition)");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':annee',$anneprec);

$requete->execute();
$result = $requete->fetchAll(PDO::FETCH_OBJ);

$dx=array();
foreach ($result as $r) {
    $mont=round($r->mont,2);
    $dx[$r->mois]=$mont;
}

$nbre = count($data['mois']);
for ($i = 0; $i <= $nbre - 1; $i++) {
    $mois=$data['mois'][$i];
    if (isset($dx[$mois])) {
        array_push($data['prec'],$data['mois']);
    }else{
        array_push($data['prec'],0);
    }
}

//Nombre des couverts annee en cours
$requete = $bdd->prepare("SELECT MONTH(a.date_edition) AS nummois, MONTHNAME(a.date_edition) AS mois,
                        SUM(a.nbrcouvert) AS nbrcouvert
                        FROM  t_facture AS a
                        WHERE a.id_hotel=:hotel_id
                        AND a.mode IS NOT NULL
                        AND YEAR(a.date_edition)=:annee
                        GROUP BY MONTH(a.date_edition)
                        ORDER BY a.date_edition");
$requete->BindParam(':hotel_id',$_SESSION['id_hotel']);
$requete->BindParam(':annee',$anneEncours);
$requete->execute();
$result = $requete->fetchAll(PDO::FETCH_OBJ);

$couvertEncours=array();
foreach ($result as $r) {
    $couvertEncours[$r->mois]=$r->nbrcouvert;
}
for ($i = 0; $i <= $nbre - 1; $i++) {
    $mois=$data['mois'][$i];
    if (isset($couvertEncours[$mois])) {
        array_push($data['couvertencours'],$couvertEncours[$mois]);
        $data['totCouvertMoisEncours']=$couvertEncours[$mois];
    }else{
        array_push($data['couvertencours'],0);
    }

    if($numMois-1==$r->nummois){
        $data['totCouvertMoisPrec']+=$couvertEncours[$mois];
    }
}
//Nombre des couverts annee precedente
$requete = $bdd->prepare("SELECT MONTH(a.date_edition) AS nummois, MONTHNAME(a.date_edition) AS mois,
                        SUM(a.nbrcouvert) AS nbrcouvert
                        FROM  t_facture AS a
                        WHERE a.id_hotel=:hotel_id
                        AND a.mode IS NOT NULL
                        AND YEAR(a.date_edition)=:annee
                        GROUP BY MONTH(a.date_edition)
                        ORDER BY a.date_edition");
$requete->BindParam(':hotel_id',$_SESSION['id_hotel']);
$requete->BindParam(':annee',$anneprec);
$requete->execute();
$result = $requete->fetchAll(PDO::FETCH_OBJ);

$couvertPrec=array();
foreach ($result as $r) {
    $couvertPrec[$r->mois]=$r->nbrcouvert;
}

for ($i = 0; $i <= $nbre - 1; $i++) {
    $mois=$data['mois'][$i];
    if (isset($couvertPrec[$mois])){
        array_push($data['couvertprec'],$couvertPrec[$mois]);
    }else{
        array_push($data['couvertprec'],0);
    }
}
echo json_encode($data);

?>