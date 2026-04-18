<?php
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
        $id_hotel=107;
        $requete = $bdd->prepare("SELECT * FROM stk__mouvement  WHERE  hotel_id=:hotel_id");
        $requete->BindParam(':hotel_id', $id_hotel);
        $requete->execute();
        $operations = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($operations as $op) {
            $idmvt = $op->idmvt;
            $type = $op->type;
            $qte_entree = $op->qte_entree;
            $qte_sortie = $op->qte_sortie;
            $dte_appro = $op->dte_appro;
            $dte_appro_heure = $op->dte_appro_heure;
            $produit_id= $op->produit_id;
        //recherche produit_id dans stk_report
        $requete = $bdd->prepare("SELECT id,qte_initial_save FROM stk_report  WHERE  produit_id=:produit_id AND  hotel_id=:hotel_id ORDER BY  id DESC LIMIT 1");
        $requete->BindParam(':produit_id', $produit_id);
        $requete->BindParam(':hotel_id', $id_hotel);
        $requete->execute();
        $operations = $requete->fetchAll(PDO::FETCH_OBJ);
        $id_last_qte=0;
         $qte_initial_save=0;
        foreach ($operations as $op){
            $id_last_qte = $op->id;
              $qte_initial_save=$op->qte_initial_save;

        }
        if($id_last_qte!=0){
        if($type=='appro'){
            $qte=$qte_initial_save+$qte_entree;
            }
            else{
           $qte=$qte_initial_save-$qte_sortie;
    
            }
              $requete = $bdd->prepare("INSERT stk_report (qte_initial_save,dte_report,dte_report_time,produit_id,idmvt,hotel_id)
                                         VALUES(:qte_initial_save,:dte_report,:dte_report_time,:produit_id,:idmvt,:hotel_id)");

                $requete->BindParam(':qte_initial_save', $qte);
                $requete->BindParam(':dte_report', $dte_appro);
                $requete->BindParam(':dte_report_time', $dte_appro_heure);
                $requete->BindParam(':produit_id', $produit_id);
                $requete->BindParam(':idmvt', $idmvt);
                $requete->BindParam(':hotel_id', $id_hotel);
                $requete->execute();

        }
        else{
            if($type=='appro'){
            $qte=$qte_entree;
            }
            else{
           $qte=$qte_sortie;
    
            }
              $requete = $bdd->prepare("INSERT stk_report (qte_initial_save,dte_report,dte_report_time,produit_id,idmvt,hotel_id)
                                         VALUES(:qte_initial_save,:dte_report,:dte_report_time,:produit_id,:idmvt,:hotel_id)");

                $requete->BindParam(':qte_initial_save', $qte);
                $requete->BindParam(':dte_report', $dte_appro);
                $requete->BindParam(':dte_report_time', $dte_appro_heure);
                $requete->BindParam(':produit_id', $produit_id);
                $requete->BindParam(':idmvt', $idmvt);
                $requete->BindParam(':hotel_id', $id_hotel);
                $requete->execute();

        }



}









