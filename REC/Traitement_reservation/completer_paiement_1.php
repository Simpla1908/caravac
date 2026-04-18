<?php

// Initialisation de la session
session_start();
require '../../bdd/connexion.php';
include '../Amelioration/reglage/recuperer_valeurs_reglages.php';
if (empty($_POST['mode']) && (empty($_POST['montantUSD']) || empty($_POST['montantFC']))) {
    echo 1;
} else {
    if (isset($_POST['mode']) && isset($_POST['montantUSD']) && isset($_POST['montantFC']) && isset($_POST['reste']) && isset($_POST['num_fact']) && isset($_POST['id_fact']) && isset($_POST['id_res']) && isset($_POST['id_client'])) {

        $monnaie = 3;
        $mode = $_POST['mode'];
        $montantUSD = $_POST['montantUSD'];
        $montantFC = $_POST['montantFC'];
        $justif = $_POST['justif'];
//    $reservation=$_POST['reservation'];
        $reste_heb_resto = $_POST['reste'];
        $num_fact = $_POST['num_fact'];
        $id_fact = $_POST['id_fact'];
//        $id_ch = $_POST['id_ch'];
        $id_client = $_POST['id_client'];
        $id_res = $_POST['id_res'];
        $montant_ttc_fc_usd = $montantFC / $tauxdollar;
        $mont_ttc_usd = $montantUSD + $montant_ttc_fc_usd;
        if ($mont_ttc_usd>=1&&$mont_ttc_usd <= $reste_heb_resto) {
            $dte_regl = date('Y-m-d H:i:s', time() + 7200);
            $reste = $reste_heb_resto-$mont_ttc_usd;
//Insertion pour l'hebergement
            $requete = $bdd->prepare("INSERT INTO  t_reglement (montant_fc,montant_dollar,reste,id_mode_regl,date_regl,id_fact,id_monnaie,id_user,id_hotel)
        VALUES(:montant_fc,:montant_dollar,:reste,:id_mode_regl,:date_regl,:id_fact,:id_monnaie,:id_user,:id_hotel)");

            $requete->BindParam(':montant_fc', $montantFC);
            $requete->BindParam(':montant_dollar', $montantUSD);
            $requete->BindParam(':reste', $reste);
            $requete->BindParam(':id_mode_regl', $mode);
            $requete->BindParam(':date_regl', $dte_regl);
            $requete->BindParam(':id_fact', $id_fact);
            $requete->BindParam(':id_monnaie', $monnaie);
            $requete->BindParam(':id_user', $_SESSION['id_user']);
            $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
            $requete->execute();
            
//requette pour avoir nombre de chambre
            $requete_nbr_ch = $bdd->prepare("SELECT nbr_ch FROM t_reservation WHERE id_res=:id_res");
            $requete_nbr_ch->BindParam(':id_res', $id_res);
            $requete_nbr_ch->execute();
            $tuple_nbr_ch = $requete_nbr_ch->fetchAll(PDO::FETCH_OBJ);
            foreach ($tuple_nbr_ch as $n) {
                $nbr_ch = $n->nbr_ch;
            }
            
            $mont_ttc_usd=$mont_ttc_usd/$nbr_ch;
//        $requete_id_ch = $bdd->prepare("SELECT idchambre FROM t_reserve_chambre WHERE idreserv=:id_res");
//            $requete_id_ch->BindParam(':id_res', $id_res);
//            $requete_id_ch->execute();
//            $tuple_id_ch = $requete_id_ch->fetchAll(PDO::FETCH_OBJ);
//            foreach ($tuple_id_ch as $id) {
//                $id_ch = $id->idchambre;
//           
//            $statut = 'reserve';
//            $requete = $bdd->prepare("UPDATE t_reserve_chambre  SET mont_paye_heb=mont_paye_heb+:mont_paye_heb WHERE idreserv=:idreserv AND idchambre=:idchambre AND (statut='occupe' OR statut='reserve')");
//
//            $requete->BindParam(':idreserv', $id_res);
//            $requete->BindParam(':idchambre', $id_ch);
//            $requete->BindParam(':mont_paye_heb', $mont_ttc_usd);
//            $requete->execute();

// }          
            //Insertion montant par chambre
            $requete = $bdd->prepare("UPDATE t_reservation  SET mont_par_chambre=mont_par_chambre+:mont_par_chambre WHERE idreserv=:idreserv");
            $requete->BindParam(':mont_par_chambre',$mont_ttc_usd);
            $requete->BindParam(':idreserv', $id_res);
            $requete->execute();
          echo 3;
                
             } else {
            echo 2;
        }
           
       
    }
}
