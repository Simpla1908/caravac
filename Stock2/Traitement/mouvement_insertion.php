<?php
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
include '../Traitement/verif_numbon_mvt.php';
include('../../FUNCTION/stock.php');
//Fusion horaire
date_default_timezone_set('Europe/Paris');
$json=array();
/*if (TRUE) {*/
// Insertion dans la table t_motif
//    $numbon = trim($_POST['numbon'], ' ');
    $article = $_POST['article'];
    $date_heure_bon= trim($_POST['date_heure_bon'], ' ');
    $quantite= trim($_POST['quantite'], ' ');
    $type= $_POST['type'];
     
    $msg = 'vide';
    //Formalisation du numbon sortie  
        $requete = $bdd->prepare("SELECT COUNT(*) AS lignes FROM stk__mouvement  WHERE  hotel_id=:hotel_id");
        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
        $requete->execute();
        $operations = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($operations as $op) {
            $lignes = $op->lignes;
        }
        if ($lignes == 0) {
            $indice_bs = 1;
        }
        else {
            $requete = $bdd->prepare("SELECT indice_bs FROM stk__mouvement WHERE  hotel_id=:hotel_id ORDER BY idmvt  DESC LIMIT 1");
            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
            $requete->execute();
            $operations = $requete->fetchAll(PDO::FETCH_OBJ);
            foreach ($operations as $op) {
                $indice_bs = $op->indice_bs;
            }
        }
    //Fin de formalisation du numbon sortie 
    
    if (empty($article) || empty($date_heure_bon) || empty($quantite)) {
        $json['message_vide']=$msg;
    }
    else {
        if ($type=="appro"){
                $numbon = trim($_POST['numbon'], ' ');
        if (empty($numbon )) {
        
              $json['message_vide']=$msg;
       } else {  
           // $verif_nb = verif_numbon_mvt($numbon);
         //if ( $verif_nb == 0) {
            $qte_sortie=0; 
            $motif="entree";
                /* Conversion date  */
            $transpostion_sortie = explode('/', $date_heure_bon);
            $jrsor = $transpostion_sortie[0];
            $moisor = $transpostion_sortie[1];
            $annee1sor = $transpostion_sortie[2];
            $transpostion_sortie1 = explode(' ', $annee1sor);
            $anneesor = $transpostion_sortie1[0];
            $heuresor = $transpostion_sortie1[1];
            $date_heure_bon = $anneesor . '/' . $moisor . '/' . $jrsor . ' ' . $heuresor;
            $date_bon = $anneesor . '-' . $moisor . '-' . $jrsor;
            
            /* Fin Conversion */
            $requete = $bdd->prepare("INSERT stk__mouvement (type,num_bon,qte_entree,qte_sortie,dte_appro,
                                                           dte_appro_heure,produit_id,user_id,hotel_id,motif)
                                         VALUES(:type,:num_bon,:qte_entree,:qte_sortie,:dte_appro
                                                ,:dte_appro_heure,:produit_id,:user_id,:hotel_id,:motif)");

            $requete->BindParam(':type',$type);
            $requete->BindParam(':num_bon', $numbon);
            $requete->BindParam(':qte_entree', $quantite);
            $requete->BindParam(':qte_sortie',$qte_sortie);
            $requete->BindParam(':dte_appro', $date_bon);
            $requete->BindParam(':dte_appro_heure',$date_heure_bon);
            $requete->BindParam(':produit_id', $article);
            $requete->BindParam(':user_id', $_SESSION['id_user']);
            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
            $requete->BindParam(':motif', $motif);

            $requete->execute();
            
            $idmvt = $bdd->lastInsertId();
            $requete = $bdd->prepare("UPDATE stk__mouvement SET indice_bs =:indice_bs WHERE idmvt=:idmvt");
            $requete->BindParam(':indice_bs', $indice_bs);
            $requete->BindParam(':idmvt', $idmvt);
            $requete->execute();
            
            $statut=1;
            $requete = $bdd->prepare("UPDATE stk_produit SET statut =:statut WHERE idprod=:idprod");
            $requete->BindParam(':statut',$statut);
            $requete->BindParam(':idprod',$article);
            $requete->execute();
            
            //  Insertion stk_report entree
                $qoprod=  getQinitialProduit($bdd, $article);
                $data=array();
                $data['qte_initial_save']=$qoprod+$quantite;
                $data['dte_report']=$date_bon;
                $data['dte_report_time']=$date_heure_bon;
                $data['produit_id']=$article;
                $data['idmvt']=$idmvt;
                $data['id_hotel']=$_SESSION['id_hotel'];
                $action='insert';
                reportStock($bdd, $data, $action);
                setQuantiteProduit($bdd,$article,$quantite,'+');
                $json['message_succes'] = 'succes';
        // }
       //  else {
//$json['message_erreur'] = 'erreur';
//$json['nb_value'] =$numbon;
//
//    }
              }
        
         }
        else {
            //  Sortie 
            $qte_entree=0;
            $motif="sortie";
            $depot=$_POST['depot'];
            //  Selection de la quantité totale d'un produit
            $prod_qte_total=getQuantiteProduit($bdd,$article);
             //Fin Selection de la quantité totale d'un produit
            $type = "sortie";
            /* Conversion date  */
            $transpostion_sortie = explode('/', $date_heure_bon);
            $jrsor = $transpostion_sortie[0];
            $moisor = $transpostion_sortie[1];
            $annee1sor = $transpostion_sortie[2];
            $transpostion_sortie1 = explode(' ', $annee1sor);
            $anneesor = $transpostion_sortie1[0];
            $heuresor = $transpostion_sortie1[1];
            $date_heure_bon = $anneesor . '/' . $moisor . '/' . $jrsor . ' ' . $heuresor;
            $date_bon = $anneesor . '-' . $moisor . '-' . $jrsor;
            /* Fin Conversion */
            
            if($quantite<=$prod_qte_total){
                
                $requete = $bdd->prepare("INSERT stk__mouvement (type,num_bon,qte_entree,qte_sortie,dte_appro,
                                                           dte_appro_heure,depot,produit_id,user_id,hotel_id,motif)
                                         VALUES(:type,:num_bon,:qte_entree,:qte_sortie,:dte_appro
                                                ,:dte_appro_heure,:depot,:produit_id,:user_id,:hotel_id,:motif)");

                $requete->BindParam(':type', $type);
                $requete->BindParam(':num_bon', $numbon);
                $requete->BindParam(':qte_entree', $qte_entree);
                $requete->BindParam(':qte_sortie', $quantite);
                $requete->BindParam(':dte_appro', $date_bon);
                $requete->BindParam(':dte_appro_heure', $date_heure_bon);
                $requete->BindParam(':depot',$depot);
                $requete->BindParam(':produit_id', $article);
                $requete->BindParam(':user_id', $_SESSION['id_user']);
                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                $requete->BindParam(':motif', $motif);
                $requete->execute();
                
                $idmvt = $bdd->lastInsertId();
                $numBon = 'BS/' . $date_bon . '/' . str_pad($indice_bs, 4, "0", STR_PAD_LEFT); //001;
                $indice_bs = $indice_bs + 1;
                $requete = $bdd->prepare("UPDATE stk__mouvement SET num_bon =:numBon,indice_bs =:indice_bs WHERE idmvt=:idmvt");
                $requete->BindParam(':numBon',$numBon);
                $requete->BindParam(':indice_bs',$indice_bs);
                $requete->BindParam(':idmvt',$idmvt);
                $requete->execute();
                
                $statut = 1;
                $requete = $bdd->prepare("UPDATE stk_produit SET statut =:statut WHERE idprod=:idprod");
                $requete->BindParam(':statut', $statut);
                $requete->BindParam(':idprod', $article);
                $requete->execute();
                
                //  Insertion stk_report
                $qoprod=  getQinitialProduit($bdd, $article);
                $data=array();
                $data['qte_initial_save']=$qoprod-$quantite;
                $data['dte_report']=$date_bon;
                $data['dte_report_time']=$date_heure_bon;
                $data['produit_id']=$article;
                $data['idmvt']=$idmvt;
                $data['id_hotel']=$_SESSION['id_hotel'];
                $action='insert';
                reportStock($bdd, $data, $action);
                setQuantiteProduit($bdd,$article,$quantite,'-');

                $json['message_succes'] = 'succes';
            }  else {
                 $json['prod_qte_total']=$prod_qte_total;
                 $json['message_prod_qte_total']='depassement';
            }
        }
    }
        
 /*
} else {
    echo "Le champ désignation n'existe pas!";
}*/

echo json_encode($json);
