<?php
// Initialisation de la session
    session_start();
    include('../bdd/connexion.php');
    $report_effectue_date=date('Y-m-d');
    $requete = $bdd->prepare("SELECT COUNT(*)AS nbre FROM stk_situation_report  WHERE report_effectue_date=:report_effectue_date");
    $requete->BindParam(':report_effectue_date', $report_effectue_date);
    $requete->execute();
    $situation_report = $requete->fetchAll(PDO::FETCH_OBJ);
    
    foreach($situation_report as $ap):
        $nbre= $ap->nbre;
    endforeach;
    
    if($nbre==0){
      $bdd->exec("call  calcul_qte_initial_produit()");
    }
echo $nbre;
    