<?php
include '../../FUNCTION/hebergement.php';
if(isset($_GET['mont_commandeUSD_tot'])&&isset($_GET['mont_commandeUSD'])&&isset($_GET['mont_commande'])&&isset($_GET['tauxrendu'])&&isset($_GET['monnaieactu'])){
  $json = array();
   $mont_commandeUSD_tot=$_GET['mont_commandeUSD_tot'];
   $mont_commandeUSD=$_GET['mont_commandeUSD'];
   $mont_commande=$_GET['mont_commande'];
    $tauxrendu=$_GET['tauxrendu'];
    $monnaieactu=$_GET['monnaieactu'];
   $mont_converti=$mont_commandeUSD+$mont_commande/$tauxrendu;
    $mont_rendu=0;
   if ($mont_converti >= $mont_commandeUSD_tot) {
        $mont_rendu_usd = $mont_converti - $mont_commandeUSD_tot;
        $mont_rendu_cdf = $mont_rendu_usd * $tauxrendu;
       if($monnaieactu==getsymbole_devise()){
           $mont_rendu=$mont_rendu_usd;
       }else if($monnaieactu==getsymbole_local()){
           $mont_rendu=$mont_rendu_cdf;
       }

    }
    $json['mont_rendu'] = round($mont_rendu,2);
    echo json_encode($json);
}