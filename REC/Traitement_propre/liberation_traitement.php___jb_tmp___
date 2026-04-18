<?php

// Initialisation de la session
session_start();
$json = array();
require '../../bdd/connexion.php';
include '../Amelioration/caisse/caisse_heberge_solde_liberation.php';
$m_aff = $_POST['m_aff'];
$montantUSD = $_POST['montantUSD'];
$montantFC = $_POST['montantFC'];
//$montantUSD = 0;
//$montantFC = 0;
//echo '$caisse_montantUSD_solde'.$caisse_montantUSD_solde;
//echo '$caisse_montantFC_solde'.$caisse_montantFC_solde;
if ($montantUSD <= $caisse_montantUSD_solde && $montantFC <= $caisse_montantFC_solde) {
    $liberation = 1;
    $mont_remboursable = $_POST['mont_remboursable'];
    if ($mont_remboursable < 0) {
        include '../Amelioration/reglage/recuperer_valeurs_reglages.php';
        $mont_remboursable1 = abs($mont_remboursable);
        //expression $mont_remboursable1 en fonction de USD
        if ($m_aff=='USD') {
            $mont_remboursable1=$mont_remboursable1;
        }else{
            $mont_remboursable1=round($mont_remboursable1 / $tauxdollar);
        }
        //fin
        $montantFC_conv_usd = round($montantFC / $tauxdollar);
        $mont_paye_usd = $montantUSD + $montantFC_conv_usd;
        if ($mont_paye_usd == $mont_remboursable1) {
            $dte_s=$_POST['date_lib'];
            $hr_sortie=time();
            $dte_sortie =$dte_s. ' ' . $hr_sortie;
            $operation_caisse = 'sortie';
            include '../../souscription/select_data_motif.php';
            include '../Amelioration/caisse/caisse_sortie.php';
            $liberation = 2;
        } else {
            $liberation = 3;
        }
    }
    if ($liberation == 1 || $liberation == 2) {
        if (isset($_POST['date_lib']) && isset($_POST['id_client']) && isset($_POST['num_res']) && isset($_POST['id_ch'])
        ) {

            $dte_s=$_POST['date_lib'];
            $hr_sortie=time();
            $dte_sortie =$dte_s. ' ' . $hr_sortie;
            $dtelib=date('Y-m-d');
            $dtelib_heur=date('Y-m-d H:i:s');
            $heure_lib = $hr_sortie;
            $num_res = $_POST['num_res'];
            $fact = $_POST['fact'];
            $id_ch = $_POST['id_ch'];
            $id_client = $_POST['id_client'];
            $id_hotel = $_SESSION['id_hotel'];
            $id_user = $_SESSION['id_user'];

            $requete = $bdd->prepare("INSERT INTO t_liberation (date_lib,heure_lib,id_ch,id_client,id_hotel,id_res,id_reser_cham,id_user,dte_lib)
			                    VALUES(:date_lib,:heure_lib,:id_ch,:id_client,:id_hotel,:id_res,:id_reser_cham,:id_user,:dte_lib)");

            $requete->BindParam(':date_lib',$dtelib_heur);
            $requete->BindParam(':heure_lib', $heure_lib);
            $requete->BindParam(':id_ch', $id_ch);
            $requete->BindParam(':id_client', $id_client);
            $requete->BindParam(':id_hotel', $id_hotel);
            $requete->BindParam(':id_res', $num_res);
            $requete->BindParam(':id_reser_cham',$fact);
            $requete->BindParam(':id_user', $id_user);
            $requete->BindParam(':dte_lib', $dtelib);
            $requete->execute();

            /* t_reserve chambre */
            $requete = $bdd->prepare("UPDATE t_reserve_chambre SET statut =:statut,date_lib=:date_lib WHERE idreserv=:idreserv AND idchambre=:idchambre ");
            $statut = 'libre';
            $requete->BindParam(':statut', $statut);
            $requete->BindParam(':date_lib', $dte_s);
            $requete->BindParam(':idreserv', $num_res);
            $requete->BindParam(':idchambre', $id_ch);
            $requete->execute();
            /* Fin t_reserve chambre */

            /* Changement de statut de reservation */
            $requete = $bdd->prepare("UPDATE t_reservation  SET statut_sorti =:statut_sorti
	                             WHERE id_client=:id_client AND id_res=:id_res ");

            $statut_sorti = 'sorti';
            $requete->BindParam(':id_client', $id_client);
            $requete->BindParam(':id_res', $num_res);
            $requete->BindParam(':statut_sorti', $statut_sorti);
            $requete->execute();
            /* Fin Changement de statut de reservation */

            /* Mise à jour capacite chambre */
            $requete = $bdd->prepare("SELECT capacite_init FROM  t_chambre AS c WHERE c.id_ch=:idchambre");
            $requete->BindParam(':idchambre', $id_ch);
            $requete->execute();
            $capacite_value = $requete->fetchAll(PDO::FETCH_OBJ);
            foreach ($capacite_value as $ca) {
                $capacite_init = $ca->capacite_init;
            }

            $requete = $bdd->prepare("UPDATE t_chambre  SET capacite =:capacite WHERE id_ch=:idchambre");
            $requete->BindParam(':capacite', $capacite_init);
            $requete->BindParam(':idchambre', $id_ch);
            $requete->execute();
            /* Mise à jour des commandes */
            $requete_resto = $bdd->prepare("SELECT b.id_res
            FROM t_reservation AS b, t_facture AS c
            WHERE b.id_res=c.id_res
            AND b.id_hotel=:id_hotel 
            AND b.type='commande' 
            AND b.etat_credit='credit'
            AND b.id_client=:client_id ");
            $requete_resto->BindParam(':id_hotel', $_SESSION['id_hotel']);
            $requete_resto->BindParam(':client_id',$id_client);
            $requete_resto->execute();
            $restaurant = $requete_resto->fetchAll(PDO::FETCH_OBJ);
            foreach ($restaurant as $resto) {
                $id_ress = $resto->id_res;
                $requete = $bdd->prepare("UPDATE t_reservation  SET etat_credit =:etat_credit WHERE id_res=:id_res");
                $etat_credit='sortie';
                $requete->BindParam(':etat_credit', $etat_credit);
                $requete->BindParam(':id_res', $id_ress);
                $requete->execute();
            }

//    echo"la libération s'est effectuée avec succès!";
            $json['message'] = 'succes';
        }
    } else {
//     echo"Vérifier les montants saisis!";
        $json['message'] = 'montantIncorrect';
    }
} else if ($montantUSD > $caisse_montantUSD_solde || $montantFC > $caisse_montantFC_solde) {
    $json['message'] = 'montantIncorrect1';
    $json['caisse_montantUSD_solde'] = $caisse_montantUSD_solde;
    $json['caisse_montantFC_solde'] = $caisse_montantFC_solde;
}
echo json_encode($json);
?>
