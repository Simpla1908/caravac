<?php
// Initialisation de la session
session_start();
require '../../bdd/connexion.php';
require '../../FUNCTION/hebergement.php';
include '../Amelioration/reglage/recuperer_valeurs_reglages.php';
//include '../Amelioration/reglage/recuperer_idmonnaie.php';
//inclure fichier enregistrement client ou mise a jours client
include 'req_client_insert_maj.php';
$json = array();
$json['value'] = '0';
$json['message'] = '';
$tarif_ch = 0;
if (count($_SESSION['panier']) == 0) {
    $json['message'] = "Vous avez oublié de sélectionner une(des) chambre(s).";
} else {
    if (isset($_POST['mode']) && isset($_POST['remise']) && isset($_POST['hebergement'])
    ) {
        $monnaie_fact=getsymbole_local();
        $hebergement = $_POST['hebergement'];
        $company_id = $_SESSION['company_id'];
        $id_hotel = $_SESSION['id_hotel'];
        $id_user = $_SESSION['id_user'];
        $checkout = $temps_sortie;
        $id_client = $_SESSION['id_client'];
        $dte = $_SESSION['date_r'];
        $dte_a = $_SESSION['date_a'];
        $dte_s = $_SESSION['date_s'];
        $type = 'hebergement';
        $type_heb = '';
        $statut_res = 'hebergement';
        $etat ='operationnel'; //Etat=effectué
        if ($hebergement == 2) {
            $statut = 'occupe';
            $id_accomp = $_SESSION['id_accomp'];
            $nom_accomp = $_SESSION['nom_accomp'];
            $type_heb = 'occupation';
        }else{
            $statut = 'reserve';
            $id_accomp = NULL;
            $nom_accomp = '';
            $type_heb = 'reservation';
        }
        $libele_mode = $_POST['libele_mode'];
        $montantusd = $_POST['montantusd'];
        $montantcdf = $_POST['montantcdf'];
        $mode = $_POST['mode'];
        $justification = $_POST['justif'];
        $remise = $_POST['remise'];
        $valremise=$remise;
        $montant_nuite = $_SESSION['montant_nuite'];
        //application remise & tva
        $montant_tva =$_SESSION['montant_tva'];
        $montant_remise =$_SESSION['montant_rem'];
        $montant_total =$_SESSION['ttc'];
        if($m_affiche==getsymbole_devise()){
            $montant_nuite=$montant_nuite*$tauxdollar;
        }
        $val_garantie=$montantcdf+$montantusd*$tauxdollar;
        $montant=$montantcdf+$montantusd*$tauxdollar;
        $rendu=0; 
        //fin
        //Reservation
        if ($mode == 0) {
            $json['message'] = "Vous avez oublié de sélectionner le mode de paiement";
            //echo "Vous avez oublié de sélectionner le mode de paiement ";
        }
        else {
            //codification
            if (arrondir($montant)>= arrondir($montant_nuite) || $libele_mode == 'Credit'){
               $id_monnaie=Null;
               // include 'numerotation_reservation.php';
                $libelle1='HEBF';
                $num_cmd = getnumerotation($_SESSION['id_hotel'], $libelle1, $bdd);
                $num_fact = str_pad($num_cmd,5,"0", STR_PAD_LEFT);
                $mont_total_res=montant_equivalent_bdd($m_affiche,getsymbole_local(), $tauxdollar,$montant_total);
                $montant=montant_equivalent_bdd($m_affiche,$monnaie_fact, $tauxdollar, $montant);
                $montant_remise=montant_equivalent_bdd($m_affiche,getsymbole_local(),$tauxdollar,$montant_remise);
                $montant_tva=montant_equivalent_bdd($m_affiche,getsymbole_local(),$tauxdollar,$montant_tva);
                $montant_remise_paie=$montant_remise;
                if ($libele_mode == 'Credit') {
                    $montant = 0;
                    $montantcdf=0;
                    $montantusd=0;
                    $garantiecdf =0;
                    $garantieusd=0;
                    $montant_remise_paie=0;
                }
                $null_garan=0;
                $requete = $bdd->prepare("INSERT INTO t_reservation (id_client,type,dte,dte_a,dte_s,garantie,monnaie,id_hotel,etat,statut_res,mont_total_res,mont_nuite,etat_credit)
			                          VALUES(:id_client,:type,:dte,:dte_a,:dte_s,:garantie,:monnaie,:id_hotel,:etat,:statut_res,:mont_total_res,:mont_nuite,:etat_credit)");

                $requete->BindParam(':id_client', $id_client);
                $requete->BindParam(':type', $type_heb);
                $requete->BindParam(':dte', $dte);
                $requete->BindParam(':dte_a', $dte_a);
                $requete->BindParam(':dte_s', $dte_s);
                $requete->BindParam(':garantie',$val_garantie);
                $requete->BindParam(':monnaie', $m_affiche);
                $requete->BindParam(':id_hotel', $id_hotel);
                $requete->BindParam(':etat', $etat);
                $requete->BindParam(':statut_res', $statut_res);
                $requete->BindParam(':mont_total_res',$mont_total_res);
                $requete->BindParam(':mont_nuite',$montant);
                $requete->BindParam(':etat_credit',$libele_mode);
                $requete->execute();
                //Modification de num_res dans la bdd
                $id_res = $bdd->lastInsertId();
                $json['id_res'] = $id_res;
                $num_reserv = $num_fact;
                $requete = $bdd->prepare("UPDATE t_reservation  SET num_reserv =:num_reserv WHERE id_res=:id_res");
                $requete->BindParam(':id_res', $id_res);
                $requete->BindParam(':num_reserv', $num_reserv);
                $requete->execute();
                //Fin Modification de num_res dans la bdd
                /* Insertion dans t_facture */
                $requete = $bdd->prepare("INSERT INTO  t_facture (type,num_fact,id_res,taux,tva,monnaie,date_edition,id_client,id_user,id_hotel,company_id,mont_tva,remise,mont_ttc_remise)
			                    VALUES(:type,:num_fact,:id_res,:taux,:tva,:monnaie,:date_edition,:id_client,:id_user,:id_hotel,:company_id,:mont_tva,:remise,:mont_ttc_remise)");
                $requete->BindParam(':type', $type);
                $requete->BindParam(':num_fact', $num_fact);
                $requete->BindParam(':id_res', $id_res);
                $requete->BindParam(':taux', $tauxdollar);
                $requete->BindParam(':tva', $tva);
                $requete->BindParam(':monnaie',$m_affiche);
                $requete->BindParam(':date_edition', $dte);
                $requete->BindParam(':id_client', $id_client);
                $requete->BindParam(':id_user', $id_user);
                $requete->BindParam(':id_hotel', $id_hotel);
                $requete->BindParam(':company_id', $company_id);
                $requete->BindParam(':mont_tva',$montant_tva);
                $requete->BindParam(':remise',$montant_remise);
                $requete->BindParam(':mont_ttc_remise',$valremise);
                $requete->execute();
                $id_fact = $bdd->lastInsertId();
                $num_cmd+=1;
                setnumerotation($_SESSION['id_hotel'], $libelle1, $num_cmd, $bdd);
                /* Fin d'Insertion dans t_facture */
                /* Insertion dans t_reserve_chambre */
                    $nbArticles = count($_SESSION['panier']['id']);
                    for ($i = 0; $i <= $nbArticles - 1; $i++) {
                        $tarif_ch = $_SESSION['panier']['prix'][$i];
                        $monnaie = $_SESSION['panier']['monnaie'][$i];
                        $num_ch= $_SESSION['panier']['nom'][$i];
                        $idch=$_SESSION['panier']['id'][$i];
                    $tarif_ch = montant_equivalent_bdd($monnaie,getsymbole_local(), $tauxdollar, $tarif_ch);
                    $requete = $bdd->prepare("INSERT INTO t_reserve_chambre (idreserv,idfact,idchambre,id_client,id_accomp,statut,date_occ,date_lib,tarif_ch,nom_accomp,checkout,checkin,id_hotel,monnaie)
					     VALUES(:idreserv,:idfact,:idchambre,:id_client,:id_accomp,:statut,:date_occ,:date_lib,:tarif_ch,:nom_accomp,:checkout,:checkin,:id_hotel,:monnaie)");
                    $requete->BindParam(':idreserv', $id_res);
                    $requete->BindParam(':idfact', $id_fact);
                    $requete->BindParam(':idchambre', $idch);
                    $requete->BindParam(':id_client', $id_client);
                    $requete->BindParam(':id_accomp', $id_accomp);
                    $requete->BindParam(':statut', $statut);
                    $requete->BindParam(':date_occ', $dte_a);
                    $requete->BindParam(':date_lib', $dte_s);
                    $requete->BindParam(':tarif_ch', $tarif_ch);
                    $requete->BindParam(':nom_accomp', $nom_accomp);
                    $requete->BindParam(':checkout', $checkout);
                    $requete->BindParam(':checkin', $checkin);
                    $requete->BindParam(':id_hotel',$id_hotel);
                    $requete->BindParam(':monnaie',$monnaie_fact);
                    $requete->execute();
                    if ($hebergement == 2) {
                        $idresch = $bdd->lastInsertId();
                        $requete = $bdd->prepare("INSERT INTO  t_chambre_histo (idres_ch,idchambre,statut,date_occ,date_lib,tarif_ch,monnaie)
                        SELECT id,idchambre,'occupe',date_occ,date_lib,tarif_ch,monnaie
                        FROM t_reserve_chambre
                        WHERE id=:id_reserv_chx");
                        $requete->BindParam(':id_reserv_chx', $idresch);
                        $requete->execute();
                        //maj dans table t_reservation
                        $etat='execute';
                        $requete = $bdd->prepare("UPDATE  t_reservation SET etat=:etat WHERE id_res=:id_res");
                        $requete->BindParam(':etat', $etat);
                        $requete->BindParam(':id_res',$id_res);
                        $requete->execute();
                    }
                    /* Insertion dans t_histo_heberge */
                    $requete = $bdd->prepare("INSERT INTO t_histo_heberge (idreserv,idfact,idchambre,statut,date_occ,date_lib,tarif_ch,id_hotel,monnaie)
					     VALUES(:idreserv,:idfact,:idchambre,:statut,:date_occ,:date_lib,:tarif_ch,:id_hotel,:monnaie)");
                    $requete->BindParam(':idreserv', $id_res);
                    $requete->BindParam(':idfact', $id_fact);
                    $requete->BindParam(':idchambre', $idch);
                    $requete->BindParam(':statut', $statut);
                    $requete->BindParam(':date_occ', $dte_a);
                    $requete->BindParam(':date_lib', $dte_s);
                    $requete->BindParam(':tarif_ch', $tarif_ch);
                    $requete->BindParam(':id_hotel',$id_hotel);
                    $requete->BindParam(':monnaie',$monnaie_fact);
                    $requete->execute();
                    /* FIN Insertion dans t_heberge_histo */
                }
                /* Fin d'Insertion dans t_reserve_chambre */
                /* Insertion dans t_reglement */
                $dtereglhr=date("Y-m-d H:i:s");
                $libelle1='HEBR';
                $num_cmd = getnumerotation($_SESSION['id_hotel'], $libelle1, $bdd);
                $num_fact = str_pad($num_cmd,5,"0", STR_PAD_LEFT);
                $requete = $bdd->prepare("INSERT INTO  t_reglement (numero,id_fact,date_regl,dte,id_user,id_hotel)
                                    VALUES(:numero,:id_fact,:date_regl,:dte,:id_user,:id_hotel)");
                $requete->BindParam(':numero', $num_fact);
                $requete->BindParam(':id_fact', $id_fact);
                $requete->BindParam(':date_regl',$dtereglhr);
                $requete->BindParam(':dte', $dte);
                $requete->BindParam(':id_user', $id_user);
                $requete->BindParam(':id_hotel', $id_hotel);
                $requete->execute();
                $regl_id = $bdd->lastInsertId();
                $num_cmd+=1;
                setnumerotation($_SESSION['id_hotel'], $libelle1, $num_cmd, $bdd);
                /* Fin d'Insertion dans t_reglement */
                /* Insertion dans paiement */
                $requete = $bdd->prepare("INSERT INTO  paiement (montant,montantusd,montantcdf,taux,rendu,remise,justification,id_mode_regl,id_monnaie,regl_id,site_id,company_id)
                                    VALUES(:montant,:montantusd,:montantcdf,:taux,:rendu,:remise,:justification,:id_mode_regl,:id_monnaie,:regl_id,:id_hotel,:company_id)");
                $requete->BindParam(':montant', $montant);
                $requete->BindParam(':montantusd', $montantusd);
                $requete->BindParam(':montantcdf', $montantcdf);
                $requete->BindParam(':taux', $tauxdollar);
                $requete->BindParam(':rendu',$rendu);
                $requete->BindParam(':remise',$montant_remise_paie);
                $requete->BindParam(':justification', $justification);
                $requete->BindParam(':id_mode_regl', $mode);
                $requete->BindParam(':id_monnaie', $id_monnaie);
                $requete->BindParam(':regl_id', $regl_id);
                $requete->BindParam(':id_hotel', $id_hotel);
                $requete->BindParam(':company_id', $company_id);
                $requete->execute();
                /* Fin d'Insertion paiement */
                 /* Insertion dans versement */
                   if ($libele_mode == 'Cash'){
                    $type_vers='hergement';
                    $motif='hergement';
                    $monaie_vers=$m_affiche;
                    $paie_id=$bdd->lastInsertId();
                        insertmontantVersement($id_user,$dte,$montantcdf,$montantusd,$monaie_vers,$type_vers,$tauxdollar,$motif,$paie_id,$id_hotel,$bdd);
                       }
                /* Fin Insertion*/
                  $json['hebergement']=$hebergement;
                 $json['succes']=True;
                if ($hebergement == 1) {
                    //echo '1';
                    $json['message'] = "La réservation est effectuée avec succès";
                } else if ($hebergement == 2) {
                    //echo '2';
                    $json['message'] = "L'occupation est effectuée avec succès.";
                }
                
            } else {
                //echo "Veuillez entrer un montant supérieur ou égal au montant nuité ";
                $json['message'] = "Veuillez entrer un montant supérieur ou égal au montant nuité";
            }
        }
        //fin codification
    }
}
echo json_encode($json);
?>
