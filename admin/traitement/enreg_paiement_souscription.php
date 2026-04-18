<?php

include '../../bdd/connexion.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
$json = array();
$json['message'] ='';
$mont_regl=0;
if (!empty($_POST['id']) && !empty($_POST['mode_rglmt']) && !empty($_POST['montant_paye']) && !empty($_POST['mont_tot'])) {
    if (is_numeric($_POST['montant_paye']) && is_numeric($_POST['montant_paye'])) {
        $id_fact=$_POST['id_fact'];
        $montant_paye=$_POST['montant_paye'];
        $mont_tot=$_POST['mont_tot'];
        $montant_fac=$_POST['montant_fac'];
        $requete = $bdd->prepare("SELECT SUM(montant_dollar) AS mont_rglt FROM  t_reglement WHERE id_fact=:id_fact");
        $requete->BindParam(':id_fact', $id_fact);
        $requete->execute();
        $reglement_by_facture = $requete->fetchAll(PDO::FETCH_OBJ);
        if (count($reglement_by_facture) >= 0) {
            foreach ($reglement_by_facture as $r) {
                $mont_regl = $r->mont_rglt;
            }
        } else {
            $mont_regl = 0;
        }
        if($montant_paye + $mont_regl <= $montant_fac){
             /* Insertion dans t_reglement */
                $requete = $bdd->prepare("INSERT INTO  t_reglement (montant_dollar,id_mode_regl,date_regl,dte,id_fact)
                VALUES(:montant_dollar,:id_mode_regl,:date_regl,:dte,:id_fact)");
                /* monnaie Mis pour les besoins de la cause */
                $requete->BindParam(':montant_dollar',$montant_paye);
                $requete->BindParam(':id_mode_regl', $_POST['mode_rglmt']);
                $dte_souscription_h = date('Y-m-d H:i:s', time() + 3600);
                $requete->BindParam(':date_regl', $dte_souscription_h);
                $dte_souscription = date('Y-m-d');
                $requete->BindParam(':dte', $dte_souscription);
                $requete->BindParam(':id_fact', $id_fact);
                $requete->execute();
                /* Fin Insertion dans t_reglement */
                
                $requete = $bdd->prepare("SELECT SUM(montant_dollar) AS mont_rglt FROM  t_reglement WHERE id_fact=:id_fact");
                $requete->BindParam(':id_fact', $id_fact);
                $requete->execute();
                $reglement_by_facture = $requete->fetchAll(PDO::FETCH_OBJ);
                foreach ($reglement_by_facture as $r) {
                    $mont_regl1 =$r->mont_rglt;
                }
                $json['mont_regl']=round( $montant_fac - $mont_regl1,2);
                
                /* Activation Company */
                if(round($montant_paye + $mont_regl,2)==round($montant_fac,2)){
                    $etat ='Payé';
                }  else {
                    $etat ='Ouverte';
                }
                $requete = $bdd->prepare("UPDATE t_facture SET etat=:etat WHERE id_fact=:id_fact");
                $requete->BindParam(':etat', $etat);
                $requete->BindParam(':id_fact',$id_fact);
                $requete->execute();
            /* Fin Activation Company */
        }  else {
             $json['message'] ="Vérifier le montant saisi!";
        }
        
    } else {
       $json['message'] = "Veuiller saisir une valeur numérique!";
    }
} else {
    $json['message'] = "Veuiller remplir le champ!";
}
echo json_encode($json);   
