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
$hr_1 = '00:00:00';
$hr_2 = '05:00:00';
$hr_operation = date('H:i:s');
$nomcaisse = $_SESSION['nom_user'] . ' ' . $_SESSION['prenom_user'];
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
$_SESSION['cdf']=$_POST['montantcdf'];
$_SESSION['usd']=$_POST['montantusd'];
$nbrcouvert = $_GET['nbrcouvert'];
global $mont_pay_usd;
global $mont_pay_cdf;
$mont_pay_usd= $_POST['montantusd'];
$mont_pay_cdf= $_POST['montantcdf'];
$articlesPa = array();
//RECUPERATION PRIX ACHAT DES PRODUITS CONTENUS DANS LE PANIER

$produts_ids_panier = array_values($_SESSION['panier']['id_article']);

$requete = $bdd->prepare("SELECT * FROM stk_produit WHERE idprod IN (" . implode(',', $produts_ids_panier) . ")");
$requete->execute();
$articles = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($articles as $prod) {
    $articlesPa[$prod->idprod] =  montant_equivalent_bdd($prod->monnaie, getsymbole_local(), $tauxdollar, $prod->pa);
};
/*
     $syn = 0;
            $id_fact = $_GET['idfactcl'];
            if ($res_ch_id == '') {
                $res_ch_id = NULL;
            }
*/
if ($montantusd == '') {
    $montantusd = 0;
}
if ($montantcdf == '') {
    $montantcdf = 0;
}
if ($mont_pay_usd) {
    $mont_pay_cdf = 0;

}
if ($mont_pay_cdf) {
    $mont_pay_usd="0";
}

$montantsaisi = $montantusd + $montantcdf / $taux_op;
$amount_type= $mont_pay_usd +$mont_pay_cdf / $taux_op;
$_SESSION['montantsaisi'] = $montantsaisi;
$mont_ttc1 = $_POST['montant_tot'];
$mont_ttc = $mont_ttc1;
$mont_ht1 = ht($mont_ttc, $tva, $_SESSION['panier']['remise']);
$mont_ht = $mont_ht1;
//$montant_remise = $_SESSION['panier']['mont_remise'];
$montant_tva = $_SESSION['panier']['mont_tva'];
$lib_mode = $_POST['lib_mode'];
$totrendu = $_POST['totrendu'];
$rendu_usd = $_POST['rendu_usd'];
$rendu_cdf = $_POST['rendu_cdf'];
$_SESSION['panier_f'] = array();
$_SESSION['panier_f']['cpt'] = array();
$_SESSION['panier_f']['id_article'] = array();
$_SESSION['panier_f']['nom'] = array();
$_SESSION['panier_f']['qte'] = array();
$_SESSION['panier_f']['qteoffert'] = array();
$_SESSION['panier_f']['pa'] = array();
$_SESSION['panier_f']['prix'] = array();
$_SESSION['panier_f']['prix2'] = array();
$_SESSION['panier_f']['repas'] = array();
$_SESSION['panier_f']['offre'] = array();
$_SESSION['panier_f']['genre'] = array();
$_SESSION['panier_f']['description'] = array();
$_SESSION['panier_f']['fact_id'] = array();
$_SESSION['panier_f']['id_client'] = 0;
$_SESSION['panier_f']['remise'] = 0;
$_SESSION['panier_f']['mont_tva'] = 0;
$_SESSION['panier_f']['mont_ttc'] = 0;
$_SESSION['panier_f']['mont_ttc_remise'] = 0;
$_SESSION['panier_f']['verrouille'] = false;
$_SESSION['panier_f']['qi'] = array();
$_SESSION['panier_f']['qlimit'] = array();
$_SESSION['saveprod']['id'] = array();
$_SESSION['panier_f']['test'] = array();
$_SESSION['panier_f']['get_test'] = array();
$_SESSION['panier_f']['merge_table'] = array();
if ($rendu_usd == '') {
    $rendu_usd = 0;
}
if ($rendu_cdf == '') {
    $rendu_cdf = 0;
}
$rendusaisi = $rendu_usd * $taux_op + $rendu_cdf;
$bool_mode_oc = 0;
if ($id_client == '') {
    if ($lib_mode == 'Credit') {
        $bool_mode_oc = 1;
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
    $json['message'] = 'La somme de deux montants saisis doit être égale à ' . afficheMontant3($_SESSION['m_affiche'], $mont_ttc1);
} else if ((arrondir($rendusaisi) != arrondir($totrendu)) && $lib_mode == 'Cash') {
    $totrendu = montant_equivalent_bdd($monnaie, $_SESSION['m_affiche'], $taux_op, $totrendu);
    $json['message'] = 'La somme de deux montants rendus doit être égale à ' . afficheMontant2($_SESSION['m_affiche'], $totrendu);
} elseif (($type_client == 'occasionnel' && $lib_mode == 'Credit')) {
    $json['message'] = "Pas ce mode de paiement pour client occasionnel";
} elseif (($type_client == 'table' && $lib_mode == 'Credit')) {
    $json['message'] = "Pas ce mode de paiement pour table";
} elseif ($rendu_usd > arrondir($solde['usd'])) {
    $json['message'] = "Veuillez ajouter un fonds de caisse de " . afficheMontant2(getsymbole_devise(), $rendu_usd - $solde['usd']) . ' avant de faire ce rendu!';
    $boolfc_usd = true;
} elseif ($rendu_cdf > arrondir($solde['cdf'])) {
    $json['message'] = "Veuillez ajouter un fonds de caisse de " . afficheMontant2(getsymbole_local(), $rendu_cdf - $solde['cdf']) . ' avant de faire ce rendu!';
    $json['succes'] = False;
    $boolfc_cdf = true;
} else {
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
        //$montantsaisi = 0;
        // $montantusd = 0;
        //$montantcdf =0;
        $etat = '2'; //non payé
        // $rendu = 0;
        // $rendu_usd=0;
        // $rendu_cdf=0;
    } elseif ($lib_mode == 'Don') {
        //        $montantusd = 0;
        //        $montantcdf = $mont_ttc;
        $etat = '1'; //payé
        $rendu = 0;
        $rendu_usd = 0;
        $rendu_cdf = 0;
    }
    $libelle = 'restaurant';
    $type = $libelle;
    $id_fact_fus = $_GET['id_fact_fus'];
    $id_tbl_fus = $_GET['id_tbl_fus'];
    if ($res_ch_id == '') {
        $res_ch_id = NULL;
    }
    // check fusion
    //Paiement par bloc
    $montantusd_paie = $montantusd;
    $montantcdf_paie = $montantcdf;
    $requete = $bdd->prepare("SELECT * FROM fusion_factures WHERE id_fact_fus=:id_fact_fus");
    $requete->BindParam(':id_fact_fus', $id_fact_fus);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($operations as $op) {
        $id_fact = $op->id_fact;
        $type = 'restaurant';
        $facture = InfosCommmande($id_fact, $type, $bdd);
        $taux_fact = $facture->taux;
        $montant_fact = montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $taux_fact, $facture->mont_ttc);
        $montant_fact_cdf = $facture->mont_ttc;
        //ajustement important
        $mont_ttc = montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $taux_fact, $facture->mont_ttc);
        $montant_tva = montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $taux_fact, $facture->mont_tva);
        $montant_total = $mont_ttc - $montant_tva;
        //ajustement important
        /* Insertion dans t_reglement */
        if ($montantusd_paie >= $montant_fact) {
            $montantusd_paie = $montantusd_paie - $montant_fact;
            $montantusd = $montant_fact;
            $mont_pay_usd=$montant_fact;
            $montantcdf = 0;
            $mont_pay_cdf= 0;
        } elseif ($montantcdf_paie >= $montant_fact_cdf) {
            $montantcdf_paie = $montantcdf_paie - $montant_fact_cdf;
            $montantcdf = $montant_fact_cdf;
            $montantusd = 0;
            $mont_pay_usd=0;
        } elseif ($montantusd_paie < $montant_fact) {
        
            $montantusd = $montantusd_paie;
            $mont_pay_usd= $montantusd_paie;
            $montant_fact = $montant_fact - $montantusd_paie;
            $montant_fact_cdf = montant_equivalent_bdd(getsymbole_devise(), getsymbole_local(), $taux_fact, $montant_fact);
            if ($montantcdf_paie >= $montant_fact_cdf) {
                $montantcdf_paie = $montantcdf_paie - $montant_fact_cdf;
                $montantcdf = $montant_fact_cdf;
                $mont_pay_cdf= $montant_fact_cdf;
            }
        } elseif ($montantcdf_paie < $montant_fact_cdf) {
            $montantcdf = $montantcdf_paie;
            $mont_pay_cdf= $montantcdf_paie;
            $montant_fact_cdf = $montant_fact_cdf - $montantcdf_paie;
            $montant_fact = montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $taux_fact, $montant_fact_cdf);
            if ($montantusd_paie >= $montant_fact) {
                $montantusd_paie = $montantusd_paie - $montant_fact;
                $montantusd = $montant_fact;
                $mont_pay_usd= $montant_fact;
            }
        }
        $montantsaisi = $montantusd * $taux_op + $montantcdf;
        $amount_type= $mont_pay_usd * $taux_op +$mont_pay_cdf;
        $rejete = 1;
        $libeR = 'restoR';
        $num_cmd = getnumerotation($_SESSION['id_hotel'], $libeR, $bdd);
        $numero = str_pad($num_cmd, 5, "0", STR_PAD_LEFT);
        // Après filtrage, l'on supprime les lignes des commandes
        /*  $requete = $bdd->prepare("SELECT  p.idprod,l.*,p.designation,p.monnaie,p.repas FROM  lignes_commandes AS l,stk_produit As p WHERE l.produit_id=p.idprod AND l.commande_id=:cmd_id AND l.hotel_id=:hotel_id ORDER BY p.designation");
        $requete->BindParam(':cmd_id', $id_fact);
        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
        $requete->execute();
        $product_select = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($product_select as $r) {
            $qte = $r->qte;
            $prix = $r->prix;
            $prix2 = $r->prix2;
            $idprod = $r->idprod;
            $designation = $r->designation;
            $repas = $r->repas;
            $pa = $r->id;
            $qteoffert = $r->qteoffert;
            $des_plt = $r->accomp;
            $offre = 0;
            if ($prix2 > 0) {
                $offre = 1;
            }
        }
        array_push($_SESSION['panier_f']['id_article'], $idprod);
        array_push($_SESSION['panier_f']['nom'], $designation);
        array_push($_SESSION['panier_f']['qte'], $qte);
        array_push($_SESSION['panier_f']['prix'], $prix);
        array_push($_SESSION['panier_f']['repas'], $repas);
        array_push($_SESSION['panier_f']['pa'], $pa);
        array_push($_SESSION['panier_f']['fact_id'], $id_fact);
        array_push($_SESSION['panier_f']['prix2'], $prix2);
        array_push($_SESSION['panier_f']['qteoffert'], $qteoffert);
        array_push($_SESSION['panier_f']['description'], $des_plt);
        $nbArticles = count($_SESSION['panier_f']['id_article']);
        for ($i = 0; $i <= $nbArticles - 1; $i++) {
            $produit_id = $_SESSION['panier_f']['id_article'][$i];
            $prix = $_SESSION['panier_f']['prix'][$i];
            // $prixremise = $prix;
            $prixremise = $prix - $prix * $_SESSION['panier']['remise'] / 100;
            $requete = $bdd->prepare("UPDATE  lignes_commandes set  prixremise=:prixremise, pa=:pa, commande_id=:id_fusion where commande_id=:commande_id");
            $requete->BindParam(':commande_id', $_SESSION['panier_f']['fact_id'][$i]);

            $requete->BindParam(':pa', $pa);
            $requete->BindParam(':id_fusion',  $id_fact_fus);
            // $requete->BindParam(':prix2', $prix2);
            // $requete->BindParam(':qteoffert', $qteoffert);
            $requete->BindParam(':prixremise', $prixremise);
            $requete->execute();
            $json['succes'] = True;
            $json['product_select'] = $_SESSION['panier_f']['fact_id'];
            $repas = $_SESSION['panier_f']['repas'][$i];
            $quantite = $_SESSION['panier_f']['qte'][$i];
            $qteoffert = $_SESSION['panier_f']['qteoffert'][$i];
            $json['prix'] = $prix;
        }
 */
        $appear_value = 0;
        /*   $aq= $bdd->prepare("UPDATE t_facture SET appear_state=:a_s WHERE id_fact=:id_fact");
        $aq->BindParam(':a_s', $appear_value);
        $aq->execute();  */

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
        /*   if ($delete_command) {
            $nbArticles = count($_SESSION['panier']['id_article']);
            $json['get_test'] = $nbArticles;
            $json['succes'] = true;
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
        } */
    }
    $requete = $bdd->prepare("INSERT INTO  t_reglement (numero,id_fact,date_regl,dte,id_user,id_hotel,rejete)
    VALUES(:numero,:id_fact,:date_regl,:dte,:id_user,:id_hotel,:rejete)");
    $requete->BindParam(':numero', $numero);
    $requete->BindParam(':id_fact', $id_fact_fus);
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
    $montant_remise = 0;
    $justification = '';
    $requete = $bdd->prepare("INSERT INTO  paiement (montant,montantusd,montantcdf,taux,rendu,remise,justification,id_mode_regl,regl_id,site_id,company_id,rendu_usd,rendu_cdf,id_sousresto,resch_id)
VALUES(:montant,:montantusd,:montantcdf,:taux,:rendu,:remise,:justification,:id_mode_regl,:regl_id,:id_hotel,:company_id,:rendu_usd,:rendu_cdf,:id_sousresto,:resch_id)");
    $requete->BindParam(':montant',$amount_type );
    $requete->BindParam(':montantusd',$mont_pay_usd);
    $requete->BindParam(':montantcdf', $mont_pay_cdf);
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
    $requete->BindParam(':resch_id', $resch_id);
    $requete->execute();
    $paie_id = $bdd->lastInsertId();
    $_SESSION['update_bill'] =$paie_id;
    $etat_cmd = 0;
    //   $mode_fact = $lib_mode;
    $appear_state = 0;
    $requpdtfact = $bdd->prepare("UPDATE t_facture SET etat_cmd=:etat_cmd,montant_total=:montant_total,mont_ttc=:mont_ttc,appear_state=:a_s WHERE id_fact=:id_fact");
    $requpdtfact->BindParam(':etat_cmd', $etat_cmd);
    $requpdtfact->BindParam(':montant_total', $montant_total);
    $requpdtfact->BindParam(':mont_ttc', $mont_ttc);
    $requpdtfact->BindParam(':id_fact', $id_fact);
    $requpdtfact->BindParam(':a_s', $appear_state);
    $requpdtfact->execute();

    //Differentes MAJ
    $data = FusionIDs($id_tbl_fus, $bdd);
    $nbre = count($data['ids']);
    for ($i = 0; $i < $nbre; $i++) {
        $id_client = $data['ids'][$i];
        // $mode_fact = $lib_mode;
        $en_attente = 0;
        $user_attente = NULL;
        $nbrcouverttable = NULL;
        $pseudo_supp = 0;
        $requete = $bdd->prepare("UPDATE t_client  SET pseudo_supp=:pseudo_supp,en_attente=:en_attente,user_attente=:user_attente,nbrcouvert=:nbrcouvert WHERE id_client=:client_id");
        $requete->BindParam(':pseudo_supp', $pseudo_supp);
        $requete->BindParam(':en_attente', $en_attente);
        $requete->BindParam(':user_attente', $user_attente);
        $requete->BindParam(':nbrcouvert', $nbrcouverttable);
        //  $requete->BindParam(':mode', $mode_fact);
        $requete->BindParam(':client_id', $id_client);
        $requete->execute();
    }
    //Differentes MAJ
    //Pour la facture fusionnée
    $solde = 1;
    $merge = 1;
    $mode_fact = $lib_mode;
    $appear_state = 0;
    $requete = $bdd->prepare("UPDATE t_facture SET solde=:solde,nomcaisse=:nomcaisse, fusion=:fusion, mode=:mode  WHERE id_fact=:id_fact");
    $requete->BindParam(':solde', $solde);
    $requete->BindParam(':nomcaisse', $nomcaisse);
    $requete->BindParam(':fusion', $merge);
    $requete->BindParam(':id_fact', $id_fact_fus);
    $requete->BindParam(':mode', $mode_fact);
    /*  $requete->BindParam(':appear_state', $appear_state); */
    $requete->execute();
    //Pour la table fusionnée
    $en_attente = 0;
    $pseudo_supp = 0;
    $statut = 'libre';
    $fusion = 0;
    $requete = $bdd->prepare("UPDATE t_client  SET pseudo_supp=:pseudo_supp,en_attente=:en_attente, statut=:statut, fusion=:fusion WHERE id_client=:client_id");
    $requete->BindParam(':pseudo_supp', $pseudo_supp);
    $requete->BindParam(':en_attente', $en_attente);
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':client_id', $id_tbl_fus);
    $requete->BindParam(':fusion', $fusion);
    $requete->execute();
    //Paiement par bloc
    $_SESSION['mode_fact'] = $lib_mode;
    $_SESSION['totrendu'] = montant_equivalent_bdd($monnaie, $_SESSION['m_affiche'], $taux_op, $totrendu);
    $_SESSION['rendu_cdf'] = $rendu_cdf;
    $_SESSION['rendu_usd'] = $rendu_usd;
  //  $_SESSION['update_bill'] =$paie_id;
    $json['num_commande'] = $id_fact_fus;
    $json['succes'] = True;
    $json['message'] = 'Cette opération vient de se réaliser avec succès!';
    $_SESSION['panier1'] = $_SESSION['panier'];
    $_SESSION['cptpanier'] = 0;
    $panier->vider_panier();
}
echo json_encode($json);
