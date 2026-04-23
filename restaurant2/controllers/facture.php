<?php
 $idsite=$_SESSION['id_hotel'];
 $dte = date('Y-m-d');
if ($do == 'liste') {
    $dte = date('Y-m-d');
    $dte1 = $dte2 = $dte;
    $hr_1 = '00:00:00';
    $hr_2 = '05:00:00';
    $hr_operation = date('H:i:s');
    //Ajustement pour des ventes tardives
    if ($hr_operation >= $hr_1 && $hr_operation <= $hr_2) {
        $dte = ReduiceDaysToDate($dte, 1);
        $dte2 = $dte1 = $dte;
    }
    if (in_array('VTCR', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) {
        $result = AllCommmandes($id_sousresto, $type, $dte1, $dte2, $bdd);
        $credits = AllCommmandesCredit($id_sousresto, $type, $dte1, $dte2, $bdd);
        $result_fusion = AllCommmandesFusion($id_sousresto, $type, $dte1, $dte2, $bdd);
    } elseif (in_array('VSPCER', $_SESSION['actions']['code_actions'])) {
        $result = AllCommmandesBYuser($id_sousresto, $type, $dte1, $dte2, $bdd);
        $credits = AllCommmandesCredit($id_sousresto, $type, $dte1, $dte2, $bdd);
        $result_fusion = AllCommmandesFusion($id_sousresto, $type, $dte1, $dte2, $bdd);
    }
    $_SESSION['dte1'] = $dte1;
    $_SESSION['dte2'] = $dte2;
    $liste_suppr = GetDeletes($idsite, $dte1, $dte2, $bdd);
    include($pathview . 'facture/liste.php');
} elseif ($do == 'listeajx') {

    $periode = $_POST['periode'];
    $id_sousresto = $_POST['sousresto_id'];
    /* Conversion periode */
    $transpostion_periode = explode(' ', $periode);
    $date1 = $transpostion_periode[0];
    $caractere = $transpostion_periode[1];
    $date2 = $transpostion_periode[2];
    /* Conversion date1 */
    $transpostion_date1 = explode('/', $date1);
    $jour = $transpostion_date1[0];
    $mois = $transpostion_date1[1];
    $annee = $transpostion_date1[2];
    $date_bd1 = $annee . '-' . $mois . '-' . $jour;
    /* Conversion date2 */
    $transpostion_date2 = explode('/', $date2);
    $jour2 = $transpostion_date2[0];
    $mois2 = $transpostion_date2[1];
    $annee2 = $transpostion_date2[2];
    $date_bd2 = $annee2 . '-' . $mois2 . '-' . $jour2;
    $idclient = $_POST['idclient'];
    $nomclient = $_GET['nomclient'];
    if (isset($_GET['credit'])) {
        $credit = $_GET['credit'];
    }
    if (in_array('VTCR', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) {
        if ($idclient > 0) {
            $result = AllCommmandesCustom($id_sousresto, $type, $date_bd1, $date_bd2, $idclient, $bdd);
            $credits = AllCommmandesCreditCustom($id_sousresto, $type, $date_bd1, $date_bd2, $idclient, $bdd);
            $result_fusion = AllCommmandesFusion($id_sousresto, $type, $date_bd1, $date_bd2, $bdd);
        } else {
            $result = AllCommmandes($id_sousresto, $type, $date_bd1, $date_bd2, $bdd);
            $credits = AllCommmandesCredit($id_sousresto, $type, $date_bd1, $date_bd2, $bdd);
            $result_fusion = AllCommmandesFusion($id_sousresto, $type, $date_bd1, $date_bd2, $bdd);
        }
    } elseif (in_array('VSPCER', $_SESSION['actions']['code_actions'])) {
        $result = AllCommmandesBYuser($id_sousresto, $type, $date_bd1, $date_bd2, $bdd);
        $credits = AllCommmandesCredit($id_sousresto, $type, $date_bd1, $date_bd2, $bdd);
        $result_fusion = AllCommmandesFusion($id_sousresto, $type, $date_bd1, $date_bd2, $bdd);
    }
    $_SESSION['dte1'] = $date_bd1;
    $_SESSION['dte2'] = $date_bd2;
    $liste_suppr = GetDeletes($idsite, $date_bd1, $date_bd2, $bdd);
    if (isset($_GET['credit'])) {
        include($pathview . 'facture/alldatafact2.php');
    } else {
        include($pathview . 'facture/alldatafact.php');
    }
} elseif ($do == 'details') {
    $id_fact = get1('id');
    $_SESSION['id_fact'] = $id_fact;
    $facture = InfosCommmande($id_fact, $type, $bdd);
    $id_fact = $facture->id_fact;
    $resch_id = $facture->res_ch_id;
    $annule = $facture->etat_cmd;
    $nom_client = $facture->nom_client;
    $telephone_client = $facture->telephone_client;
    $email_client = $facture->email_client;
    if (empty($nom_client)) {
        $nom_client = $facture->designation;
    }
    if ($nom_client == 'Occasionnel') {
        $nom_client = 'Client occasionnel';
    }
    $mode = $facture->mode;
    $date_edition = $facture->date_edition;
    $nomcaisse= $facture->nomcaisse;
    $serveur_name= $facture->serveur_name;
    $num_fact = $facture->num_fact;
    $taux_prix = $facture->taux_prix;
    $taux_op = $facture->taux;
    $nbrcouvert  = $facture->nbrcouvert;
    //    $mont_ttc =montant_equivalent_bdd($monnaie, $m_affiche,$taux_op,$facture->mont_ttc);;
    $mont_ttc = $facture->mont_ttc;
    $mode = $facture->mode;
    $mont_tot = montant_equivalent_bdd($monnaie, $m_affiche, $taux_op, $mont_ttc);
    $mont_tva = montant_equivalent_bdd($monnaie, $m_affiche, $taux_op, $facture->mont_tva);
    $mont_remise = montant_equivalent_bdd($monnaie, $m_affiche, $taux_op, $facture->remise);
    //$mont_remise = $facture->remise;
    // $ht = montant_equivalent_bdd($monnaie, $m_affiche, $taux_op, $facture->montant_total);
    $ht = $facture->montant_total;
    $p = TotPayeCommande2($id_fact, $bdd);
    $mont_paye = montant_equivalent_bdd('CDF', $m_affiche, $taux_op, $p['paye']);
    if ($mont_paye > $mont_ttc) {
        $mont_paye = $mont_ttc;
    }

    $rendu = montant_equivalent_bdd($monnaie, $m_affiche, $taux_op, $p['rendu']);
    $_SESSION['montantsaisi'] = $mont_paye;
    $_SESSION['totrendu'] = $rendu;
    $lignes = LignesCommmande($id_fact, $bdd);
    $paiements = HistoPaiementByFact($id_fact, $bdd);
    $_SESSION['paiements'] = $paiements;
    ReimprimerPOS($id_fact, $bdd);
    $tauxdollar = $_SESSION['tauxdollar'];
    $monnaie_local = getsymbole_local();
    $mont_tva = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier1']['mont_tva']);
    $total_fact = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier1']['mont_ht']);
    $mont_remise = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier1']['mont_remise']);
    $ttc = ttc($total_fact, $mont_tva, $mont_remise);
    $netapayer = montant_equivalent_bdd($monnaie_local, $m_affiche, $tauxdollar, $_SESSION['panier1']['netapayer']);
    $solde = round($netapayer - $mont_paye, 2);
    $m_eqvt = getsymbole_devise();
    if ($m_affiche == getsymbole_devise()) {
        $m_eqvt = getsymbole_local();
    }
    $solde_eqv = montant_equivalent_bdd($m_affiche, $m_eqvt, $taux_op, $solde);
    include($pathview . 'facture/details.php');
    
} elseif ($do == 'regler5') {
    //Paiemet credit
    $id_fact = $_POST['id_fact'];
    $resch_id = $_POST['resch_id'];
    if ($resch_id == '' || $resch_id == 0) {
        $resch_id = NULL;
    }
    $mode = $_POST['modepaiement'];
    $lib_mode = $_POST['lib_mode'];
    $montantusd = $_POST['montantusd'];
    $montantcdf = $_POST['montantcdf'];
    if ($montantusd == '') {
        $montantusd = 0;
    }
    if ($montantcdf == '') {
        $montantcdf = 0;
    }
    $totrendu = $_POST['totrendu'];
    $rendu_usd = $_POST['rendu_usd'];
    $rendu_cdf = $_POST['rendu_cdf'];
    $montantsaisi = $montantusd * $taux_op + $montantcdf;
    if ($rendu_usd == '') {
        $rendu_usd = 0;
    }
    if ($rendu_cdf == '') {
        $rendu_cdf = 0;
    }
    $rendusaisi = $rendu_usd * $taux_op + $rendu_cdf;
    $mont_ttc1 = $_POST['montant_tot'];
    $mont_ttc = montant_equivalent_bdd($_SESSION['m_affiche'], $monnaie, $taux_op, $mont_ttc1);
    // echo ' montantsaisi  :'.$montantsaisi;
    // echo ' mont_ttc  :'.$mont_ttc;
    // echo ' lib_mode  :'.$lib_mode;
    // echo ' taux_op  :'.$taux_op;


    if ((($montantusd == '' && $montantcdf == '') || ($montantsaisi == 0)) && $lib_mode == 'Cash') {
        $json['message'] = 'Veuillez saisir un montant payé';
    } elseif ($montantsaisi > $mont_ttc && $lib_mode == 'Cash') {
        $json['message'] = 'La somme de deux montants saisis doit être égale à ' . afficheMontant2($_SESSION['m_affiche'], $mont_ttc1);
    } elseif ((arrondir($rendusaisi) != arrondir($totrendu)) && $lib_mode == 'Cash') {
        $totrendu = montant_equivalent_bdd($monnaie, $_SESSION['m_affiche'], $taux_op, $totrendu);
        $json['message'] = 'La somme de deux montants rendus doit être égale à ' . afficheMontant2($_SESSION['m_affiche'], $totrendu);
    } else {
        //      echo 'paie';
        $_SESSION['totrendu'] = montant_equivalent_bdd($monnaie, $_SESSION['m_affiche'], $taux_op, $totrendu);
        $_SESSION['montantsaisi'] = montant_equivalent_bdd($monnaie, $_SESSION['m_affiche'], $taux_op, $montantsaisi);
        $dte = date('Y-m-d');
        $date_h_com = date('Y-m-d H:i:s');
        $rendu = $rendusaisi;
        if ($lib_mode == 'Don') {
            $montantsaisi = 0;
            $montantusd = 0;
            $montantcdf = $mont_ttc;
            $etat = '1'; //non payé
            $rendu = 0;
            $rendu_usd = 0;
            $rendu_cdf = 0;
        }
        /* Insertion dans t_reglement */
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
        $montant_remise = 0;
        $justification = '';
        $requete = $bdd->prepare("INSERT INTO  paiement (montant,montantusd,montantcdf,taux,rendu,remise,justification,id_mode_regl,regl_id,site_id,company_id,rendu_usd,rendu_cdf,id_sousresto,resch_id)
                            VALUES(:montant,:montantusd,:montantcdf,:taux,:rendu,:remise,:justification,:id_mode_regl,:regl_id,:id_hotel,:company_id,:rendu_usd,:rendu_cdf,:id_sousresto,:resch_id)");
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
        $requete->BindParam(':resch_id', $resch_id);
        $requete->execute();
        $paie_id = $bdd->lastInsertId();
        $facture = InfosCommmande($id_fact, $type, $bdd);
        $nom_client = $facture->nom_client;
        $num_fact = $facture->num_fact;
        if (empty($nom_client)) {
            $nom_client = $facture->designation;
        }
        $_SESSION['num_commande'] = $numero;
        $_SESSION['date_edition2'] = $date_h_com;
        $_SESSION['nom_client'] = $nom_client;
        $_SESSION['motif_rec'] = 'Facture N°' . $num_fact;
        $_SESSION['mode_fact'] = $lib_mode;
        $json['paie_id'] = $paie_id;
        $json['id_fact'] = $id_fact;
        $_SESSION['paie_id'] = $paie_id;
        $user = $_SESSION['nom_user'] . ' ' . $_SESSION['prenom_user'];
        $_SESSION['Agent'] = $user;
        $json['succes'] = True;
    }
    echo json_encode($json);
} elseif ($do == 'recu') {
    $id =  get1('id');
    $p = DetailsRecu($id, $bdd);
    $mode = $p->lib;
    $id_fact = $p->id_fact;
    $type = 'restaurant';
    $facture = InfosCommmande($id_fact, $type, $bdd);
    $id_fact = $facture->id_fact;
    $nom_client = $facture->nom_client;
    $telephone_client = $facture->telephone_client;
    $email_client = $facture->email_client;
    if (empty($nom_client)) {
        $nom_client = $r->designation;
    }
    if ($nom_client == 'Occasionnel') {
        $nom_client = 'Client occasionnel';
    }
    $num_fact = $facture->num_fact;
    $taux_op = $facture->taux;
    $numero = $p->numero;
    $user = $p->nom_user . ' ' . $p->prenom_user;
    $dte = $p->dte;
    $dte_h = $p->date_regl;
    $tx_paie = $p->taux;
    $lib_mode = $p->lib;
    $mont_paye1 = ($p->montantusd * $p->taux + $p->montantcdf);
    $rendu1 = ($p->rendu_usd * $p->taux + $p->rendu_cdf);
    $mont_paye = montant_equivalent_bdd($monnaie, $m_affiche, $taux_op, $mont_paye1);
    $rendu = montant_equivalent_bdd($monnaie, $m_affiche, $taux_op, $rendu1);
    $_SESSION['num_commande'] = $numero;
    $_SESSION['date_edition2'] = $dte_h;
    $_SESSION['date_edition3'] = $dte;
    $_SESSION['nom_client'] = $nom_client;
    $_SESSION['motif_rec'] = 'Facture N°' . $num_fact;
    $_SESSION['mode_fact'] = $lib_mode;
    $_SESSION['Agent'] = $user;
    $_SESSION['montantsaisi'] = $mont_paye;
    $_SESSION['totrendu'] = $rendu;
} elseif ($do == 'extcpte') {
    //Imprimer extrait de compte  
    $id_fact = get1('id');
    $type = 'restaurant';
    $facture = InfosCommmande($id_fact, $type, $bdd);
    $nom_client = $facture->nom_client;
    $mode = $facture->mode;
    $dte_h = $facture->dte_time;
    $date_edition = $facture->date_edition;
    if (empty($nom_client)) {
        $nom_client = $r->designation;
    }
    if ($nom_client == 'Occasionnel') {
        $nom_client = 'Client occasionnel';
    }
    $num_fact = $facture->num_fact;
    $taux_op = $facture->taux;
    $user = $_SESSION['nom_user'] . ' ' . $_SESSION['prenom_user'];
    $_SESSION['Agent'] = $user;
    $_SESSION['num_commande'] = $num_fact;
    $_SESSION['nom_client'] = $nom_client;
    $_SESSION['date_edition2'] = $dte_h;
    $_SESSION['mode_fact'] = $mode;
    $_SESSION['taux_fact'] = $taux_op;
} elseif ($do == 'annulerfusion') {
    $id_fact = get1('id');
    $requete = $bdd->prepare("DELETE FROM   t_facture WHERE id_fact=:id_fact");
    $requete->BindParam(':id_fact', $id_fact);
    $requete->execute();
    $periode = $_POST['periode'];
    $id_sousresto = $_POST['sousresto_id'];
    /* Conversion periode */
    $transpostion_periode = explode(' ', $periode);
    $date1 = $transpostion_periode[0];
    $caractere = $transpostion_periode[1];
    $date2 = $transpostion_periode[2];
    /* Conversion date1 */
    $transpostion_date1 = explode('/', $date1);
    $jour = $transpostion_date1[0];
    $mois = $transpostion_date1[1];
    $annee = $transpostion_date1[2];
    $date_bd1 = $annee . '-' . $mois . '-' . $jour;
    /* Conversion date2 */
    $transpostion_date2 = explode('/', $date2);
    $jour2 = $transpostion_date2[0];
    $mois2 = $transpostion_date2[1];
    $annee2 = $transpostion_date2[2];
    $date_bd2 = $annee2 . '-' . $mois2 . '-' . $jour2;

    if (in_array('VTCR', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) {
        $result = AllCommmandes($id_sousresto, $type, $date_bd1, $date_bd2, $bdd);
        $credits = AllCommmandesCredit($id_sousresto, $type, $date_bd1, $date_bd2, $bdd);
        $result_fusion = AllCommmandesFusion($id_sousresto, $type, $date_bd1, $date_bd2, $bdd);
    } elseif (in_array('VSPCER', $_SESSION['actions']['code_actions'])) {
        $result = AllCommmandesBYuser($id_sousresto, $type, $date_bd1, $date_bd2, $bdd);
        $credits = AllCommmandesCredit($id_sousresto, $type, $date_bd1, $date_bd2, $bdd);
        $result_fusion = AllCommmandesFusion($id_sousresto, $type, $date_bd1, $date_bd2, $bdd);
    }
    $_SESSION['dte1'] = $date_bd1;
    $_SESSION['dte2'] = $date_bd2;
    include($pathview . 'facture/alldatafact.php');
} elseif ($do == 'reglerfusion') {
    $json = array();
    $json['message'] = '';
    $json['succes'] = False;
    //Paiemet credit
    $id_fact_fus = $_POST['id_fact_f'];
    $resch_id = $_POST['resch_id_f'];
    if ($resch_id == '') {
        $resch_id = NULL;
    }
    $mode = $_POST['modepaiement_f'];
    $lib_mode = $_POST['lib_mode_f'];
    $montantusd = $_POST['montantusd_f'];
    $montantcdf = $_POST['montantcdf_f'];
    if ($montantusd == '') {
        $montantusd = 0;
    }
    if ($montantcdf == '') {
        $montantcdf = 0;
    }
    $totrendu = $_POST['totrendu_f'];
    $rendu_usd = $_POST['rendu_usd_f'];
    $rendu_cdf = $_POST['rendu_cdf_f'];
    $montantsaisi = $montantusd * $taux_op + $montantcdf;
    if ($rendu_usd == '') {
        $rendu_usd = 0;
    }

    if ($rendu_cdf == '') {
        $rendu_cdf = 0;
    }
    $rendusaisi = $rendu_usd * $taux_op + $rendu_cdf;
    $mont_ttc = $_POST['montant_tot_f'];
    $mont_ttc1 = $_POST['montant_tot_f_usd'];

    //    $mont_ttc_usd = montant_equivalent_bdd($_SESSION['m_affiche'], $monnaie, $taux_op, $mont_ttc);
    //    echo ' montantsaisi  :'.$montantsaisi;
    //    echo ' mont_ttc  :'.$mont_ttc;
    //    echo ' $lib_mode  :'.$lib_mode;

    if ((($montantusd == '' && $montantcdf == '') || ($montantsaisi == 0)) && $lib_mode == 'Cash') {
        $json['message'] = 'Veuillez saisir un montant payé';
    } elseif ($montantsaisi < $mont_ttc && $lib_mode == 'Cash') {
        $json['message'] = 'La somme de deux montants saisis doit être égale à ' . afficheMontant2($_SESSION['m_affiche'], $mont_ttc1);
    } elseif ((arrondir($rendusaisi) != arrondir($totrendu)) && $lib_mode == 'Cash') {
        $totrendu = montant_equivalent_bdd($monnaie, $_SESSION['m_affiche'], $taux_op, $totrendu);
        $json['message'] = 'La somme de deux montants rendus doit être égale à ' . afficheMontant2($_SESSION['m_affiche'], $totrendu);
    } else {
        //      echo 'paie';
        $_SESSION['totrendu'] = montant_equivalent_bdd($monnaie, $_SESSION['m_affiche'], $taux_op, $totrendu);
        $_SESSION['montantsaisi'] = montant_equivalent_bdd($monnaie, $_SESSION['m_affiche'], $taux_op, $montantsaisi);
        $dte = date('Y-m-d');
        $date_h_com = date('Y-m-d H:i:s');
        $rendu = $rendusaisi;
        if ($lib_mode == 'Don') {
            $montantsaisi = 0;
            $montantusd = 0;
            $montantcdf = $mont_ttc;
            $etat = '1'; //non payé
            $rendu = 0;
            $rendu_usd = 0;
            $rendu_cdf = 0;
        }
        $montantusd_paie = $montantusd;
        $montantcdf_paie = $montantcdf;
        //Paiement par bloc
        $requete = $bdd->prepare("SELECT * FROM fusion_factures WHERE id_fact_fus=:id_fact_fus");
        $requete->BindParam(':id_fact_fus', $id_fact_fus);
        $requete->execute();
        $operations = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($operations as $op) {
            $id_fact = $op->id_fact;
            $type = 'restaurant';
            $facture = InfosCommmande($id_fact, $type, $bdd);
            $taux_fact = $facture->taux;
            $montant_fact = $facture->mont_ttc;
            $montant_fact_cdf = montant_equivalent_bdd(getsymbole_devise(), getsymbole_local(), $taux_fact, $facture->mont_ttc);
            /* Insertion dans t_reglement */
            if ($montantusd_paie >= $montant_fact) {
                $montantusd_paie = $montantusd_paie - $montant_fact;
                $montantusd = $montant_fact;
                $montantcdf = 0;
            } elseif($montantcdf_paie >= $montant_fact_cdf) {
                $montantcdf_paie = $montantcdf_paie - $montant_fact_cdf;
                $montantcdf = $montant_fact_cdf;
                $montantusd = 0;
            } elseif ($montantusd_paie < $montant_fact) {
                $montantusd = $montantusd_paie;
                $montant_fact = $montant_fact - $montantusd_paie;
                $montant_fact_cdf = montant_equivalent_bdd(getsymbole_devise(), getsymbole_local(), $taux_fact, $montant_fact);
                if ($montantcdf_paie >= $montant_fact_cdf) {
                    $montantcdf_paie = $montantcdf_paie - $montant_fact_cdf;
                    $montantcdf = $montant_fact_cdf;
                }
            } elseif ($montantcdf_paie < $montant_fact_cdf) {
                $montantcdf = $montantcdf_paie;
                $montant_fact_cdf = $montant_fact_cdf - $montantcdf_paie;
                $montant_fact = montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $taux_fact, $montant_fact_cdf);
                if ($montantusd_paie >= $montant_fact) {
                    $montantusd_paie = $montantusd_paie - $montant_fact;
                    $montantusd = $montant_fact;
                }
            }
            $montantsaisi = $montantusd * $taux_op + $montantcdf;
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
            $montant_remise = 0;
            $justification = '';
            $requete = $bdd->prepare("INSERT INTO  paiement (montant,montantusd,montantcdf,taux,rendu,remise,justification,id_mode_regl,regl_id,site_id,company_id,rendu_usd,rendu_cdf,id_sousresto,resch_id)
                            VALUES(:montant,:montantusd,:montantcdf,:taux,:rendu,:remise,:justification,:id_mode_regl,:regl_id,:id_hotel,:company_id,:rendu_usd,:rendu_cdf,:id_sousresto,:resch_id)");
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
            $requete->BindParam(':resch_id', $resch_id);
            $requete->execute();
            $paie_id = $bdd->lastInsertId();
            $mode_fact = 'Cash';
            $requpdtfact = $bdd->prepare("UPDATE t_facture SET mode=:mode WHERE id_fact=:id_fact");
            $requpdtfact->BindParam(':mode', $mode_fact);
            $requpdtfact->BindParam(':id_fact', $id_fact);
            $requpdtfact->execute();
        }
        $solde = 1;
        $requete = $bdd->prepare("UPDATE t_facture SET solde=:solde  WHERE id_fact=:id_fact");
        $requete->BindParam(':solde', $solde);
        $requete->BindParam(':id_fact', $id_fact_fus);
        $requete->execute();
        
        $json['succes'] = True;
    }
    echo json_encode($json);
}elseif($do=='modepaieajx') {
    $periode = $_POST['periode'];
    $id_sousresto = $_POST['sousresto_id'];
    /* Conversion periode */
    $transpostion_periode = explode(' ', $periode);
    $date1 = $transpostion_periode[0];
    $caractere = $transpostion_periode[1];
    $date2 = $transpostion_periode[2];
    /* Conversion date1 */
    $transpostion_date1 = explode('/', $date1);
    $jour = $transpostion_date1[0];
    $mois = $transpostion_date1[1];
    $annee = $transpostion_date1[2];
    $date_bd1 = $annee . '-' . $mois . '-' . $jour;
    /* Conversion date2 */
    $transpostion_date2 = explode('/', $date2);
    $jour2 = $transpostion_date2[0];
    $mois2 = $transpostion_date2[1];
    $annee2 = $transpostion_date2[2];
    $date_bd2 = $annee2 . '-' . $mois2 . '-' . $jour2;

    $type='restaurant';
    
   $facts= getFacturesOfMobileMoney($id_sousresto, $type, $date_bd1, $date_bd2, $bdd);
   
   include($pathview . 'facture/mobileAllData.php');
} elseif ($do=='regler6') {
     //Paiemet credit global
     $dte = date('Y-m-d');
     $d=array();
     $d['numFacture'] =array();
     $d['numRecu'] =array();
     $d['montant'] =array();

     $pos_id=$_SESSION['id_sousresto'];
     $name_customer=$_POST['name_customer'];
     $mode = $_POST['modepaiement'];
     $solde = $_POST['montant_tot'];
     $soldecdf = $solde* $taux_op ;
     $client_id = $_POST['client_id'];
     $montantusd = $_POST['montantusd'];
     $montantcdf = $_POST['montantcdf'];
     $taux_op = $_POST['txoperation'];
    /*  $totrendu = $_POST['totrendu'];
     $rendu_usd = $_POST['rendu_usd'];
     $rendu_cdf = $_POST['rendu_cdf']; */
     $totrendu =0;
     $rendu_usd =0;
     $rendu_cdf =0;
     $rendu=0;
     $montantsaisi = $montantusd * $taux_op + $montantcdf;
     $montantsaisi_usd = $montantusd + $montantcdf/$taux_op;
     $json['succes'] = False;
     if ((($montantusd == '' && $montantcdf == '') || ($montantsaisi == 0))) {
         $json['message'] = 'Veuillez saisir un montant payé';
     }elseif($montantsaisi > $soldecdf ){
         $json['message'] = 'La somme de deux montants saisis doit être égale à ' . afficheMontant2($_SESSION['m_affiche'], $solde);
     }else{
 
         // Recuperation des dettes
         $requete = $bdd->prepare("SELECT a.id_client,a.num_fact,a.id_fact,a.mont_ttc AS debit,a.res_ch_id ,
         a.mont_ttc -SUM((d.montantusd-d.rendu_usd)+(d.montantcdf-d.rendu_cdf)/d.taux) AS credit
         FROM t_facture AS a,t_reglement AS c, paiement AS d
         WHERE a.id_fact=c.id_fact AND  c.id_regl=d.regl_id 
         AND mode='Credit'
         AND a.id_client=:id_client
         GROUP BY a.id_fact
         HAVING SUM((d.montantusd-d.rendu_usd)+(d.montantcdf-d.rendu_cdf)/d.taux) < a.mont_ttc");
         $requete->BindParam(':id_client', $client_id);
         $requete->execute();
         $result = $requete->fetchAll(PDO::FETCH_OBJ);
 
         foreach ($result as $p) {
             $credit= $p->credit;
             $id_fact=$p->id_fact;
             $resch_id=$p->res_ch_id;
             if(empty($resch_id)){
                $resch_id=NULL;
             }
             $num_fact=$p->num_fact;
             //on passe l'ecriture s'il y a une dette
                if($montantsaisi_usd>=$credit){
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
               $montant_remise = 0;
               $justification = '';
               $requete = $bdd->prepare("INSERT INTO  paiement (montant,montantusd,montantcdf,taux,rendu,remise,justification,id_mode_regl,regl_id,site_id,company_id,rendu_usd,rendu_cdf,id_sousresto,resch_id)
                                   VALUES(:montant,:montantusd,:montantcdf,:taux,:rendu,:remise,:justification,:id_mode_regl,:regl_id,:id_hotel,:company_id,:rendu_usd,:rendu_cdf,:id_sousresto,:resch_id)");
               $requete->BindParam(':montant', $montantsaisi);
               $requete->BindParam(':montantusd',$credit);
               $requete->BindParam(':montantcdf',$montant_remise);
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
  
               array_push($d['numFacture'],$num_fact);
               array_push($d['numRecu'],$numero);
               array_push($d['montant'],$credit);
               $montantsaisi_usd=$montantsaisi_usd-$credit;
   
               }else{
                      /* Insertion dans t_reglement */
              if($montantsaisi_usd>=0){
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
               $montant_remise = 0;
               $justification = '';
               $requete = $bdd->prepare("INSERT INTO  paiement (montant,montantusd,montantcdf,taux,rendu,remise,justification,id_mode_regl,regl_id,site_id,company_id,rendu_usd,rendu_cdf,id_sousresto,resch_id)
                                   VALUES(:montant,:montantusd,:montantcdf,:taux,:rendu,:remise,:justification,:id_mode_regl,:regl_id,:id_hotel,:company_id,:rendu_usd,:rendu_cdf,:id_sousresto,:resch_id)");
               $requete->BindParam(':montant', $montantsaisi);
               $requete->BindParam(':montantusd', $montantsaisi_usd);
               $requete->BindParam(':montantcdf',$montant_remise);
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
               $requete->BindParam(':id_sousresto',$pos_id);
               $requete->BindParam(':resch_id', $resch_id);
               $requete->execute();
               $paie_id = $bdd->lastInsertId();
  
               array_push($d['numFacture'],$num_fact);
               array_push($d['numRecu'],$numero);
               if($montantsaisi_usd<$credit){
                  array_push($d['montant'],$montantsaisi_usd);
                  $montantsaisi_usd=$montantsaisi_usd-$credit;
               }else{
                  array_push($d['montant'],$credit);
                  $montantsaisi_usd=$montantsaisi_usd-$credit;
               }
              
              }
               
   
           }
    
             
            
 
         }
 
         $_SESSION['recuGlobal'] = $d;
         $_SESSION['name_customer'] = $name_customer;
         $json['posid']= $pos_id; 
         $json['succes'] = True;  
     }
 
     echo json_encode($json);
}elseif ($do=='liste2') {
    $data = ExtraitDEcompteAll($_SESSION['id_hotel'], $bdd);
    include($pathview . 'extrait/datasextraitall.php');
}elseif ($do=='listpay') {
    $dte1=$dte2 = date('Y-m-d');
    $id_sousresto=$_SESSION['id_sousresto'];
    $caissier_id=0;
    $maffiche=$_SESSION['m_affiche'];
   $paiements=listOfPaiementsByUser($caissier_id,$id_sousresto,$dte1,$dte2,$bdd);
   //$paiements=listOfPaiements($id_sousresto,$dte1,$dte2,$bdd);
   $paimentsbymodes=getTotalPaymentsByModeUser($caissier_id,$id_sousresto,$dte1,$dte2,$maffiche,$bdd);
   $_SESSION['paiements']=$paiements;
    $_SESSION['paimentsbymodes']=$paimentsbymodes;
    $_SESSION['periodepaiement']=dateAffiche($dte1).' - '.dateAffiche($dte2);
    include($pathview . 'facture/paiementList.php');
}elseif ($do=='listpayajx') {
    $periode = $_POST['periode'];
    $id_sousresto = $_POST['sousresto_id'];
    $caissier_id= $_POST['caissier_id'];
    /* Conversion periode */
    $transpostion_periode = explode(' ', $periode);
    $date1 = $transpostion_periode[0];
    $caractere = $transpostion_periode[1];
    $date2 = $transpostion_periode[2];
    /* Conversion date1 */
    $transpostion_date1 = explode('/', $date1);
    $jour = $transpostion_date1[0];
    $mois = $transpostion_date1[1];
    $annee = $transpostion_date1[2];
    $date_bd1 = $annee . '-' . $mois . '-' . $jour;
    /* Conversion date2 */
    $transpostion_date2 = explode('/', $date2);
    $jour2 = $transpostion_date2[0];
    $mois2 = $transpostion_date2[1];
    $annee2 = $transpostion_date2[2];
    $date_bd2 = $annee2 . '-' . $mois2 . '-' . $jour2;
    $id_sousresto=$_SESSION['id_sousresto'];
    $maffiche=$_SESSION['m_affiche'];
   // $paiements=listOfPaiements($id_sousresto,$date_bd1,$date_bd2,$bdd);
   $paiements=listOfPaiementsByUser($caissier_id,$id_sousresto,$date_bd1,$date_bd2,$bdd);
    $paimentsbymodes=getTotalPaymentsByModeUser($caissier_id,$id_sousresto,$date_bd1,$date_bd2,$maffiche,$bdd);
    $_SESSION['paiements']=$paiements;
    $_SESSION['paimentsbymodes']=$paimentsbymodes;
    $_SESSION['periodepaiement']=dateAffiche($date_bd1).' - '.dateAffiche($date_bd2);
    include($pathview . 'facture/paiementListData.php');
}
