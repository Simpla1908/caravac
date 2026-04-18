<?php
include('../bdd/connexion.php');
//include '../Traitement/verif_numbon_mvt_1.php';
include('../../FUNCTION/stock.php');
session_start();
$json = array();
$date_heure_bon = trim($_POST['date_heure_bon'], ' ');
$produit_id = trim($_POST['article'], ' ');
$quantite = trim($_POST['quantite'], ' ');
$quantite0 = trim($_POST['quantite0'], ' ');
$transpostion_sortie = explode('/', $date_heure_bon);
$jrsor = $transpostion_sortie[0];
$moisor = $transpostion_sortie[1];
$annee1sor = $transpostion_sortie[2];
$transpostion_sortie1 = explode(' ', $annee1sor);
$anneesor = $transpostion_sortie1[0];
$heuresor = $transpostion_sortie1[1];
$date_heure_bon = $anneesor . '-' . $moisor . '-' . $jrsor . ' ' . $heuresor;
$date_bon = $anneesor . '-' . $moisor . '-' . $jrsor;
$appro = $_POST['appro'];
$sortie = $_POST['sortie'];
$idmvt = $_POST['idmvt'];
$msg = 'vide';
if (empty($date_heure_bon) || empty($quantite)) {
    $json['message_vide'] = $msg;

} else {
    // mise a jour approvisionnement
    if ($appro == "appro") {
        $numbon = trim($_POST['numbon'], ' ');
        $numbon_ex = $_POST['numbon_ex'];
        if (empty($numbon)) {
            $json['message_vide'] = $msg;
        } else {
            // $verif_nb = verif_numbon_mvt_1($numbon,$numbon_ex);
//            $requete = $bdd->prepare("SELECT num_bon FROM  stk__mouvement WHERE num_bon<>:num_bon_ex AND hotel_id=:hotel_id");
//            $requete->BindParam(':num_bon_ex',$numbon_ex);
//            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
//          
//            $requete->execute();
//            $numbons = $requete->fetchAll(PDO::FETCH_OBJ);
//            $existe = 0;
//            foreach ($numbons as $n) {
//             echo 'la boucle';
//            echo $n->num_bon;
//           
//            if ($numbon==$n->num_bon) {
//            $existe = 1;
//            break;
//            }

//                                        }
////if ($verif_nb== 0) {
            //Update entrée
            $requete = $bdd->prepare("UPDATE stk__mouvement SET num_bon =:numbon,qte_entree=:quantite,produit_id=:produit_id,dte_appro=:date_bon,dte_appro_heure=:date_heure_bon WHERE idmvt=:idmvt");
            $requete->BindParam(':numbon', $numbon);
            $requete->BindParam(':quantite', $quantite);
            $requete->BindParam(':produit_id', $produit_id);
            $requete->BindParam(':date_bon', $date_bon);
            $requete->BindParam(':date_heure_bon', $date_heure_bon);
            $requete->BindParam(':idmvt', $idmvt);
            $requete->execute();
            //  Insertion stk_report entree
            $qoprod = getQinitialProduit($bdd, $produit_id);
            $data['qte_initial_save'] = $qoprod + $quantite;
            $data['idmvt'] = $idmvt;
            $action = 'update';
            reportStock($bdd, $data, $action);
            $json['message_succes'] = "succes";
// echo 'existe vaut:'.$verif_nb;                        
            //   }
            //  else if($verif_nb== 1) {

            //           $json['message_erreur'] = 'erreur';
            //          $json['nb_value'] =$numbon;
//echo 'existe vaut:'.$verif_nb;  


            // }
            MajValueQteDispo(1,$quantite0,$quantite,$produit_id,$bdd);
        }
    }
    else {
        $depot = $_POST['depot'];
        //Update sortie
        $requete = $bdd->prepare("UPDATE stk__mouvement SET qte_sortie=:quantite,produit_id=:produit_id,dte_appro=:date_bon,dte_appro_heure=:date_heure_bon,depot=:depot WHERE idmvt=:idmvt");
        $requete->BindParam(':quantite', $quantite);
        $requete->BindParam(':produit_id', $produit_id);
        $requete->BindParam(':date_heure_bon', $date_heure_bon);
        $requete->BindParam(':date_bon', $date_bon);
        $requete->BindParam(':idmvt', $idmvt);
        $requete->BindParam(':depot', $depot);
        $requete->execute();
        $_SESSION['operation_last_id'] = $idmvt;
        //  Insertion stk_report entree
        $qoprod = getQinitialProduit($bdd, $produit_id);
        $data['qte_initial_save'] = $qoprod - $quantite;
        $data['idmvt'] = $idmvt;
        $action = 'update';
        reportStock($bdd, $data, $action);
        $json['message_succes'] = "succes";
        //echo"L'enrégistrement s'est effectué avec succès!";
        MajValueQteDispo(0,$quantite0,$quantite,$produit_id,$bdd);

    }
}
echo json_encode($json);