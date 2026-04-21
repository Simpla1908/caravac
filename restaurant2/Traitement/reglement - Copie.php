<?php
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
session_start();
include '../bdd/connexion.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include '../../FUNCTION/hebergement.php';
include '../../FUNCTION/stock.php';
include '../../FUNCTION/restaurant.php';
include './Panier.php';
$_SESSION['lastload'] = time();
$json = array();
$json['succes'] = False;
$monnaie = getsymbole_local();
$taux_op = $_SESSION['taux_resto'];
$do = $_GET['do'];
$hr_1 = '00:00:00';
$hr_2 = '05:00:00';
$hr_operation = date('H:i:s');
$nomcaisse = $_SESSION['nom_user'] . ' ' . $_SESSION['prenom_user'];
$mode2 = 3;
global $appear_state;
 $appear_state=0;

//RECUPERATION PRIX ACHAT DES PRODUITS CONTENUS DANS LE PANIER
$articlesPa = array();
$produts_ids_panier = array_values($_SESSION['panier']['id_article']);

$requete = $bdd->prepare("SELECT * FROM stk_produit WHERE idprod IN (" . implode(',', $produts_ids_panier) . ")");
$requete->execute();
$articles = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($articles as $prod) {
    $articlesPa[$prod->idprod] =  montant_equivalent_bdd($prod->monnaie, getsymbole_local(), $tauxdollar, $prod->pa);
};

if ($do == 'payer1' || $do == 'payer2') {
    $id_sousresto = $_GET['id_sousresto'];
    $solde = GetCaffOfDayResto($bdd);
     $taux_op = $_SESSION['taux_resto'];
    $panier = new Panier();
    $num_cmd = 0;
    $id_client = $_POST['id_client'];
    $nom_client = $_POST['nom_client'];
    $type_client = $_POST['type_client'];
    $montantusd = $_POST['montantusd'];
    $montantcdf = $_POST['montantcdf'];
    $nbrcouvert = $_GET['nbrcouvert'];

    if ($montantusd == '') {
        $montantusd = 0;
    }
    if ($montantcdf == '') {
        $montantcdf = 0;
    }

    $montantsaisi = $montantcdf + $montantusd * $taux_op;
 
    $mont_ttc1 = $_POST['montant_tot'];
    $mont_ttc = $mont_ttc1;
    $mont_ht1 =  ht($mont_ttc, $tva, $_SESSION['panier']['remise']);
    $mont_ht = $mont_ht1;
    $montant_remise = $_SESSION['panier']['mont_remise'];
    $montant_tva = $_SESSION['panier']['mont_tva'];
    $lib_mode = $_POST['lib_mode'];
    $totrendu = $_POST['totrendu'];
    /* 
   A suivre plus tard
    $rendu_usd = $_POST['rendu_usd'];
    $rendu_cdf = $_POST['rendu_cdf'];
   
    if ($rendu_usd == '') {
        $rendu_usd = 0;
    }
    if ($rendu_cdf == '') {
        $rendu_cdf = 0;
    }
    $rendusaisi = $rendu_usd * $taux_op + $rendu_cdf; */

    $rendu_usd = 0;
    $rendu_cdf = 0;
    $rendusaisi = 0;

    if ($montantsaisi > $mont_ttc) {
        $rendu_usd = $montantsaisi - $mont_ttc;
    }

    $bool_mode_oc = 0;
    if ($id_client == '') {
        if ($lib_mode == 'Credit') {
            $bool_mode_oc = 1;
            $mode2 = 2;
        } else {
            $type_cl = 'occasionnel';
            $requete = $bdd->prepare("SELECT * FROM  t_client AS cl WHERE cl.id_hotel=:hotel_id AND cl.type=:type_cl");
            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
            $requete->BindParam(':type_cl', $type_cl);
            $requete->execute();
            $client_occasionnel = $requete->fetchAll(PDO::FETCH_OBJ);
            foreach ($client_occasionnel as $cl) {
                $id_client = $cl->id_client;
            }
        }
    }



    if ($montantusd == '' && $montantcdf == '') {
        $json['message'] = 'Veuillez saisir montant payé';
    } elseif ($bool_mode_oc == 1) {
        $json['message'] = "Mode Credit ne concerne pas client occasionnel";
    } else if ((arrondir($montantsaisi) < arrondir($mont_ttc)) && $lib_mode == 'Cash') {
        $json['message'] = 'La somme de deux montants saisis ' . afficheMontant3($_SESSION['m_affiche'], $montantsaisi).' doit être égale à ' . afficheMontant3($_SESSION['m_affiche'], $mont_ttc).' Taux '.$tauxdollar;
    }
    /* else if ((arrondir($rendusaisi) != arrondir($totrendu)) && $lib_mode == 'Cash') {
        $totrendu = montant_equivalent_bdd($monnaie, $_SESSION['m_affiche'], $taux_op, $totrendu);
        $json['message'] = 'La somme de deux montants rendus doit être égale à ' . afficheMontant2($_SESSION['m_affiche'], $totrendu);
    } */ elseif (($type_client == 'occasionnel' && $lib_mode == 'Credit')) {
        $json['message'] = "Pas ce mode de paiement pour client occasionnel";
    } elseif (($type_client != 'client' && $lib_mode == 'Credit')) {
        $json['message'] = "Pas ce mode de paiement pour table";
    }
    /* elseif ($rendu_usd >  arrondir($solde['usd'])) {
        $json['message'] = "Veuillez ajouter un fonds de caisse de " . afficheMontant2(getsymbole_devise(), $rendu_usd - $solde['usd']) . ' avant de faire ce rendu!';
        $boolfc_usd = true;
    } 
    elseif ($rendu_cdf > arrondir($solde['cdf'])) {
        $json['message'] = "Veuillez ajouter un fonds de caisse de " . afficheMontant2(getsymbole_local(), $rendu_cdf - $solde['cdf']) . ' avant de faire ce rendu!';
        $json['succes'] = False;
        $boolfc_cdf = true;
    }  */ else {
        //echo 'paiement';
        $mode = $_POST['modepaiement'];
        $lib_mode = $_POST['lib_mode'];
        $justification = $_POST['justification'];
        $res_ch_id = $_POST['res_ch_id'];
        $mont_commande = $panier->montant_panier();
        $id_res = trim($_POST['id_res']);
        $montant_tot_af = $_POST['montant_tot_af'];
        $rendu = 0;
        $type_heb = 'restaurant';
        $dte = date('Y-m-d');
        $date_h_com = date('Y-m-d H:i:s');
        //Ajustement pour des ventes tardives
        if ($hr_operation >= $hr_1 && $hr_operation <= $hr_2) {
            $dte = ReduiceDaysToDate($dte, 1);
            $date_h_com = $dte;
        }
        $etat = '2'; //payé
        $_SESSION['date_edition'] = $dte;
        $_SESSION['date_edition2'] = $date_h_com;
        $rendu = $montantsaisi - $mont_ttc;
        if ($lib_mode == 'Credit') {

            $etat = '2'; //non payé
            $mode2 = 2;
        } elseif ($lib_mode == 'Don') {
            $montantusd = 0;
            $montantcdf = $mont_ttc;
            $etat = '1'; //payé
            $rendu = 0;
            $rendu_usd = 0;
            $rendu_cdf = 0;
            $mode2 = 0;
        } elseif ($lib_mode == 'Cash') {
            $mode2 = 1;
        }
        $libelle = 'restaurant';
        $type = $libelle;
        if ($do == 'payer1') {
            $num_cmd = getnumerotation($_SESSION['id_hotel'], $libelle, $bdd);
            $num_cmd_format = format_numero($num_cmd);
            if ($id_res == 0) {
                $res_ch_id = NULL;
                $requete = $bdd->prepare("INSERT INTO t_reservation (id_client,num_reserv,type,dte,monnaie,id_hotel,statut_res)
			            VALUES(:id_client,:num_reserv,:type,:dte,:monnaie,:id_hotel,:statut_res)");
                $requete->BindParam(':id_client', $id_client);
                $requete->BindParam(':num_reserv', $num_cmd_format);
                $requete->BindParam(':type', $libelle);
                $requete->BindParam(':dte', $dte);
                $requete->BindParam(':monnaie', $monnaie);
                $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
                $requete->BindParam(':statut_res', $libelle);
                $requete->execute();
                $id_res = $bdd->lastInsertId();
            }
            /* Insertion dans t_facture */

            $requete = $bdd->prepare("INSERT INTO t_facture (type,num_fact,id_res,taux,taux_prix,tva,monnaie,date_edition,id_client,id_user,id_hotel,id_sousresto,company_id,mont_tva,remise,mont_ttc_remise,mont_ttc,res_ch_id,etat,mode,dte_time,montant_total,nbrcouvert,nomcaisse,mode2)
                                        VALUES(:type,:num_fact,:id_res,:taux,:taux_prix,:tva,:monnaie,:date_edition,:id_client,:id_user,:id_hotel,:id_sousresto,:company_id,:mont_tva,:remise,:mont_ttc_remise,:mont_ttc,:res_ch_id,:etat,:mode,:dte_time,:montant_total,:nbrcouvert,:nomcaisse,:mode2)");
            $requete->BindParam(':type', $type);
            $requete->BindParam(':num_fact', $num_cmd_format);
            $requete->BindParam(':id_res', $id_res);
            $requete->BindParam(':taux', $taux_op);
            $requete->BindParam(':taux_prix', $tauxdollar);
            $requete->BindParam(':tva', $tva);
            $requete->BindParam(':monnaie', $m_affiche);
            $requete->BindParam(':date_edition', $dte);
            $requete->BindParam(':id_client', $id_client);
            $requete->BindParam(':id_user', $_SESSION['id_user']);
            $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
            $requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
            $requete->BindParam(':company_id', $_SESSION['company_id']);
            $requete->BindParam(':mont_tva', $montant_tva);
            $requete->BindParam(':remise', $montant_remise);
            $requete->BindParam(':mont_ttc_remise', $_SESSION['panier']['remise']);
            $requete->BindParam(':mont_ttc', $mont_ttc);
            $requete->BindParam(':res_ch_id', $res_ch_id);
            $requete->BindParam(':etat', $etat);
            $requete->BindParam(':mode', $lib_mode);
            $requete->BindParam(':dte_time', $date_h_com);
            $requete->BindParam(':montant_total', $mont_ht);
            $requete->BindParam(':nbrcouvert', $nbrcouvert);
            $requete->BindParam(':nomcaisse', $nomcaisse);
            $requete->BindParam(':mode2', $mode2);
            $requete->execute();
            $id_fact = $bdd->lastInsertId();
            $num_cmd += 1;
            setnumerotation($_SESSION['id_hotel'], $libelle, $num_cmd, $bdd);
            /* Fin d'Insertion dans t_facture */
            /* Insertion dans lignes_commandes */
            $nbArticles = count($_SESSION['panier']['id_article']);
            for ($i = 0; $i <= $nbArticles - 1; $i++) {
                $produit_id = $_SESSION['panier']['id_article'][$i];
                $repas = $_SESSION['panier']['repas'][$i];
                $quantite = $_SESSION['panier']['qte'][$i];
                $qteoffert = $_SESSION['panier']['qteoffert'][$i];
                if ($_SESSION['panier']['offre'][$i] == 1) {
                    $quantite = 0;
                }
                $prix = $_SESSION['panier']['prix'][$i];
                $prixremise = $prix - $prix * $_SESSION['panier']['remise'] / 100;
                // $pa = $_SESSION['panier']['pa'][$i];
                $pa = $articlesPa[$produit_id];
                $prix2 = $_SESSION['panier']['prix2'][$i];
                $accomp = $_SESSION['panier']['description'][$i];;
                $requete = $bdd->prepare("INSERT INTO  lignes_commandes (qte,prix,dte,commande_id,produit_id,hotel_id,repas,accomp,pa,prix2,qteoffert,prixremise)
				     VALUES(:qte,:prix,:dte,:commande_id,:produit_id,:hotel_id,:repas,:accomp,:pa,:prix2,:qteoffert,:prixremise)");
                $requete->BindParam(':qte', $quantite);
                $requete->BindParam(':prix', $prix);
                $requete->BindParam(':dte', $dte);
                $requete->BindParam(':commande_id', $id_fact);
                $requete->BindParam(':produit_id', $produit_id);
                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                $requete->BindParam(':repas', $repas);
                $requete->BindParam(':accomp', $accomp);
                $requete->BindParam(':pa', $pa);
                $requete->BindParam(':prix2', $prix2);
                $requete->BindParam(':qteoffert', $qteoffert);
                $requete->BindParam(':prixremise', $prixremise);
                $requete->execute();
            }
            /* Fin Insertion lignes_commandes */
        } elseif ($do == 'payer2') {
            $syn = 0;
            $id_fact = $_GET['idfactcl'];
            if ($res_ch_id == '') {
                $res_ch_id = NULL;
            }
            //UPDATE t_client
            $en_attente = 0;
            $user_attente = NULL;
            $nbrcouverttable = NULL;
            $requete = $bdd->prepare("UPDATE t_client  SET en_attente=:en_attente,user_attente=:user_attente,nbrcouvert=:nbrcouvert WHERE id_client=:client_id");
            $requete->BindParam(':en_attente', $en_attente);
            $requete->BindParam(':user_attente', $user_attente);
            $requete->BindParam(':nbrcouvert', $nbrcouverttable);
            $requete->BindParam(':client_id', $id_client);
            $requete->execute();
            /* Update dans t_facture */
            $requete = $bdd->prepare("UPDATE t_facture  SET etat=:etat,etat_cmd='0',mont_ttc=:mont_ttc,
                                        mode=:mode,taux=:taux,taux_prix=:taux_prix,id_client=:id_client,
                                        montant_total=:montant_total,mont_tva=:mont_tva,remise=:remise,mont_ttc_remise=:mont_ttc_remise,date_edition=:date_edition
                                        ,res_ch_id=:res_ch_id,nbrcouvert=:nbrcouvert,nomcaisse=:nomcaisse,mode2=:mode2,syn=:syn,appear_state=:appear_state
                                        WHERE id_fact=:id_fact");
            $requete->BindParam(':etat', $etat);
            $requete->BindParam(':mont_ttc', $mont_ttc);
            $requete->BindParam(':mode', $lib_mode);
            $requete->BindParam(':taux', $taux_op);
            $requete->BindParam(':taux_prix', $tauxdollar);
            //$requete->BindParam(':tva', $tva);
            $requete->BindParam(':id_client', $id_client);
            $requete->BindParam(':montant_total', $mont_ht);
            $requete->BindParam(':mont_tva', $montant_tva);
            $requete->BindParam(':remise', $montant_remise);
            $requete->BindParam(':mont_ttc_remise', $_SESSION['panier']['remise']);
            $requete->BindParam(':date_edition', $dte);
            $requete->BindParam(':res_ch_id', $res_ch_id);
            $requete->BindParam(':nbrcouvert', $nbrcouvert);
            $requete->BindParam(':nomcaisse', $nomcaisse);
            $requete->BindParam(':id_fact', $id_fact);
            $requete->BindParam(':mode2', $mode2);
            $requete->BindParam(':syn', $syn);
            $requete->BindParam(':appear_state', $appear_state);
            $requete->execute();
            /* Fin Update dans t_facture */
            // suppression de tous les produits
            $requete = $bdd->prepare("DELETE FROM  lignes_commandes WHERE commande_id=:id");
            $requete->BindParam(':id', $id_fact);
            $requete->execute();
            /* Insertion dans lignes_commandes */
            $nbArticles = count($_SESSION['panier']['id_article']);
            for ($i = 0; $i <= $nbArticles - 1; $i++) {
                $produit_id = $_SESSION['panier']['id_article'][$i];
                $repas = $_SESSION['panier']['repas'][$i];
                $quantite = $_SESSION['panier']['qte'][$i];
                $qteoffert = $_SESSION['panier']['qteoffert'][$i];
                if ($_SESSION['panier']['offre'][$i] == 1) {
                    $quantite = 0;
                }
                $prix = $_SESSION['panier']['prix'][$i];
                $prixremise = $prix - $prix * $_SESSION['panier']['remise'] / 100;
                // $pa = $_SESSION['panier']['pa'][$i];
                $pa = $articlesPa[$produit_id];
                $prix2 = $_SESSION['panier']['prix2'][$i];
                $accomp = $_SESSION['panier']['description'][$i];

                $requete = $bdd->prepare("INSERT INTO  lignes_commandes (qte,prix,dte,commande_id,produit_id,hotel_id,repas,accomp,pa,prix2,qteoffert,prixremise)
				     VALUES(:qte,:prix,:dte,:commande_id,:produit_id,:hotel_id,:repas,:accomp,:pa,:prix2,:qteoffert,:prixremise)");
                $requete->BindParam(':qte', $quantite);
                $requete->BindParam(':prix', $prix);
                $requete->BindParam(':dte', $dte);
                $requete->BindParam(':commande_id', $id_fact);
                $requete->BindParam(':produit_id', $produit_id);
                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                $requete->BindParam(':repas', $repas);
                $requete->BindParam(':accomp', $accomp);
                $requete->BindParam(':pa', $pa);
                $requete->BindParam(':prix2', $prix2);
                $requete->BindParam(':qteoffert', $qteoffert);
                $requete->BindParam(':prixremise', $prixremise);
                $requete->execute();
            }
            /* Fin Insertion lignes_commandes */
        }
        /* Insertion dans t_reglement */
        $libeR = 'restoR';
        $rejete = 1;
        $num_cmd = getnumerotation($_SESSION['id_hotel'], $libeR, $bdd);
        $numero = str_pad($num_cmd, 5, "0", STR_PAD_LEFT);
        $requete = $bdd->prepare("INSERT INTO  t_reglement (numero,id_fact,date_regl,dte,id_user,id_hotel,rejete)
                                    VALUES(:numero,:id_fact,:date_regl,:dte,:id_user,:id_hotel,:rejete)");
        $requete->BindParam(':numero', $numero);
        $requete->BindParam(':id_fact', $id_fact);
        $requete->BindParam(':date_regl', $date_h_com);
        $requete->BindParam(':dte', $dte);
        $requete->BindParam(':id_user', $_SESSION['id_user']);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->BindParam(':rejete', $rejete);
        $requete->execute();
        $regl_id = $bdd->lastInsertId();
        $num_cmd += 1;
        setnumerotation($_SESSION['id_hotel'], $libeR, $num_cmd, $bdd);
        /* Fin d'Insertion dans t_reglement */
        /* Insertion dans paiement */
        /*  if ($lib_mode == 'Credit') {
            $mode = 2;
        } */
        $requete = $bdd->prepare("INSERT INTO  paiement (montant,montantusd,montantcdf,taux,rendu,remise,justification,id_mode_regl,regl_id,site_id,company_id,rendu_usd,rendu_cdf,id_sousresto)
                                VALUES(:montant,:montantusd,:montantcdf,:taux,:rendu,:remise,:justification,:id_mode_regl,:regl_id,:id_hotel,:company_id,:rendu_usd,:rendu_cdf,:id_sousresto)");
        $requete->BindParam(':montant', $montantsaisi);
        $requete->BindParam(':montantusd', $montantusd);
        $requete->BindParam(':montantcdf', $montantcdf);
        $requete->BindParam(':rendu', $rendu);
        $requete->BindParam(':taux', $taux_op);
        $requete->BindParam(':remise', $montant_remise);
        $requete->BindParam(':justification', $justification);
        $requete->BindParam(':id_mode_regl', $mode);
        $requete->BindParam(':regl_id', $regl_id);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
        $requete->BindParam(':company_id', $_SESSION['company_id']);
        $requete->BindParam(':rendu_usd', $rendu_usd);
        $requete->BindParam(':rendu_cdf', $rendu_cdf);
        $requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
        $requete->execute();
        $paie_id = $bdd->lastInsertId();
        /* Fin d'Insertion paiement */
        changeStatutTable($id_client, 'libre', $bdd);
        /* Fin Insertion */
        $_SESSION['mode_fact'] = $lib_mode;
        $_SESSION['nom_client'] = $nom_client;
        $_SESSION['totrendu'] = montant_equivalent_bdd($monnaie, $_SESSION['m_affiche'], $taux_op, $totrendu);
        $_SESSION['rendu_cdf'] = $rendu_cdf;
        $_SESSION['rendu_usd'] = $rendu_usd;
        $_SESSION['montantsaisi'] = $montantsaisi;
        $_SESSION['id_fact'] = $id_fact;
        //Sortie stock
        if ($id_sousresto == '') {
            $id_sousresto = $_SESSION['depot_id'];
        }
        MvtOut2($id_sousresto, $bdd);
        $json['num_commande'] = $id_fact;
        $json['succes'] = True;
        $json['message'] = 'Cette opération vient de se réaliser avec succès!';
        $_SESSION['panier1'] = $_SESSION['panier'];
        $_SESSION['cptpanier'] = 0;
        $panier->vider_panier();
    }
    echo json_encode($json);
} elseif ($do == 'rendu') {
    $json['boolrendu'] = False;
    $rendu_usd = 0;
    $rendu_cdf = 0;
    $totrendu = 0;
    $montantusd = $_POST['montantusd'];
    $montantcdf = $_POST['montantcdf'];
    if ($montantusd == '') {
        $montantusd = 0;
    }
    if ($montantcdf == '') {
        $montantcdf = 0;
    }
    $montantsaisi = $montantusd * $taux_op + $montantcdf;
    $mont_ttc1 = $_POST['montant_tot'];

    $mont_ttc = montant_equivalent_bdd($_SESSION['m_affiche'], $monnaie, $taux_op, $mont_ttc1);
    $mont_ttc2 = montant_equivalent_bdd($_SESSION['m_affiche'], getsymbole_devise(), $taux_op, $mont_ttc1);
    if ($montantsaisi > $mont_ttc) {
        $totrendu = $montantsaisi - $mont_ttc;
        $rendudata = RenduRetour($montantusd, $montantcdf, $totrendu, $taux_op);
        $rendu_cdf = $rendudata['r_cdf'];
        $rendu_usd = $rendudata['r_usd'];
        $json['boolrendu'] = True;
    }
    $json['rendu_usd'] = arrondir($rendu_usd);
    $json['rendu_cdf'] = arrondir($rendu_cdf);
    $json['totrendu'] = $totrendu;
    $json['succes'] = True;

    echo json_encode($json);
} elseif ($do == 'rendu2') {
    $rendu_usd = $_POST['rendu_usd'];
    $rendu_cdf = $_POST['rendu_cdf'];
    $rd = $_GET['rd'];

    if ($rd == '1') {
        $rendu_usd = 0;
    } elseif ($rd == '2') {
        $rendu_cdf = 0;
    }
    $montantsaisi = $rendu_usd * $taux_op + $rendu_cdf;
    $mont_ttc1 = $_POST['totrendu'];
    $mont_ttc = montant_equivalent_bdd($_SESSION['m_affiche'], $monnaie, $taux_op, $mont_ttc1);
    $mont_ttc2 = montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $taux_op, $mont_ttc1);
    if ($montantsaisi <= $mont_ttc) {
        $val2 = $mont_ttc - $rendu_cdf;
        $valusd = montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $taux_op, $val2);
        $rendu_usd = $valusd;
        $json['succes'] = True;
    } else {
        $mont_ttc = montant_equivalent_bdd($_SESSION['m_affiche'], $monnaie, $taux_op, $mont_ttc);
        $json['message'] = 'La somme de deux montants rendus doit être égale à ' . afficheMontant($_SESSION['m_affiche'], $mont_ttc2);
        $rendu_usd = '';
        $rendu_cdf = '';
    }

    $json['rendu_usd'] = arrondir($rendu_usd);
    $json['rendu_cdf'] = arrondir($rendu_cdf);
    echo json_encode($json);
}
