<?php
$requete = 'SELECT montantFC,montantUSD,type 
FROM  t_operation
WHERE hotel_id=:site_id AND psedo=0';
$query = $bdd->prepare($requete);
$query->BindParam(':site_id',$_SESSION['id_hotel']);
try {
$query->execute();
$result=$query->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
die($e->getMessage());
}
$SoldeCDF=0;
$SoldeUSD=0;
foreach ($result as $rows) {
if($rows->type=='entree'){
    $SoldeCDF=$SoldeCDF+$rows->montantFC;
    $SoldeUSD=$SoldeUSD+$rows->montantUSD;

}else{
    $SoldeCDF=$SoldeCDF-$rows->montantFC;
    $SoldeUSD=$SoldeUSD-$rows->montantUSD;

   
  }
}
$solde_caisse_fc_normal=$SoldeCDF;
$solde_caisse_usd_normal=$SoldeUSD;





