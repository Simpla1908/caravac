<?php

//Paiement FC
//Test monnaie1
if ($libele_monnaie == 'CDF') {
    $_SESSION['monnaie'] = $monnaie;
    if (!empty($_POST['mode'])) {

        $tauxdollar = $tauxdollar;
        // Montant nuité, montant total en fonction de la monnaie affichage prédéfinie
        if ($m_affiche == 'USD') {
            $montant_nuite_fc = $_SESSION['montant_nuite'] * $tauxdollar;
            $mont_total_fc = $_SESSION['total'] * $tauxdollar;

            /* a traiter majoration et remise */
            $montant_nuite_res_remise = round($montant_nuite_fc * $remise / 100, 2);
            $montant_nuite_res_maj = round($montant_nuite_fc * $majoration / 100, 2);
            $montant_nuite_res = $montant_nuite_fc + $montant_nuite_res_maj - $montant_nuite_res_remise;

            $mont_total_res_remise = round($mont_total_fc * $remise / 100, 2);
            $mont_total_res_maj = round($mont_total_fc * $majoration / 100, 2);
            $mont_total_res = $mont_total_fc + $mont_total_res_maj - $mont_total_res_remise;

            $montant_nuite_fc_remise = round($montant_nuite_fc * $remise / 100, 2);
            $montant_maj_nuite_fc = round($montant_nuite_fc * $majoration / 100, 2);

            $mont_fac_total_fc_remise = round($mont_total_fc * $remise / 100, 2);
            $mont_fac_total_fc_maj = round($mont_total_fc * $majoration / 100, 2);

            $montant_nuite_fc = $montant_nuite_fc + $montant_maj_nuite_fc - $montant_nuite_fc_remise;
            $mont_fac_total_fc = $mont_total_fc + $mont_fac_total_fc_maj - $mont_fac_total_fc_remise;
            $_SESSION['total'] = $mont_fac_total_fc;
            /* Fin traiter majoration et remise */

        } else {
            $montant_nuite_fc = $_SESSION['montant_nuite'];
            $mont_total_fc = $_SESSION['total'];

            /* a traiter majoration et remise */
            $montant_nuite_res_remise = round($montant_nuite_fc * $remise / 100, 2);
            $montant_nuite_res_maj = round($montant_nuite_fc * $majoration / 100, 2);
            $montant_nuite_res = $montant_nuite_fc + $montant_nuite_res_maj - $montant_nuite_res_remise;

            $mont_total_res_remise = round($mont_total_fc * $remise / 100, 2);
            $mont_total_res_maj = round($mont_total_fc * $majoration / 100, 2);
            $mont_total_res = $mont_total_fc + $mont_total_res_maj - $mont_total_res_remise;

            $montant_nuite_fc_remise = round($montant_nuite_fc * $remise / 100, 2);
            $montant_maj_nuite_fc = round($montant_nuite_fc * $majoration / 100, 2);

            $mont_fac_total_fc_remise = round($mont_total_fc * $remise / 100, 2);
            $mont_fac_total_fc_maj = round($mont_total_fc * $majoration / 100, 2);

            $montant_nuite_fc = $montant_nuite_fc + $montant_maj_nuite_fc - $montant_nuite_fc_remise;
            $mont_fac_total_fc = $mont_total_fc + $mont_fac_total_fc_maj - $mont_fac_total_fc_remise;
            $_SESSION['total'] = $mont_fac_total_fc;
            /* Fin traiter majoration et remise */
        }

        //Verification du montant avec le net à payer
        if (($montant > 0) && ($montant >= $montant_nuite_fc && $montant <= $mont_fac_total_fc)) {

            /* Inssertion dans la table t_reservation */
            $statut_res = 'operationnel';
            /* Conversion date d'arrive */
            $transpostion = explode('/', $_SESSION['date_arrive']);
            $jrar = $transpostion[0];
            $moisar = $transpostion[1];
            $annee1ar = $transpostion[2];
            $transpostion1 = explode(' ', $annee1ar);
            $anneear = $transpostion1[0];
            $heurear = $transpostion1[1] . ':00';
            $dte_arrive = $anneear . '-' . $moisar . '-' . $jrar . ' ' . $heurear;
            $dte_a = $anneear . '-' . $moisar . '-' . $jrar;
            /* Fin Conversion date d'arrive */

            /* Conversion date de sortie */
            $transpostion_sortie = explode('/', $_SESSION['date_sorti']);
            $jrsor = $transpostion_sortie[0];
            $moisor = $transpostion_sortie[1];
            $annee1sor = $transpostion_sortie[2];
            $transpostion_sortie1 = explode(' ', $annee1sor);
            $anneesor = $transpostion_sortie1[0];
            $heuresor = $transpostion_sortie1[1] . ':00';
            $dte_sortie = $anneesor . '-' . $moisor . '-' . $jrsor . ' ' . $heuresor;
            $dte_s = $anneesor . '-' . $moisor . '-' . $jrsor;

            /* Fin Conversion date d'arrive */

            $date_res = date('Y-m-d H:i:s');
            $type = 'reservation';
            $_SESSION['type'] = $type;
            // $num=1;
            $message = 1;
            if ($hebergement == 2) {
                $type = 'occupation';
                $_SESSION['type'] = $type;
                $statut_res = ' ';
                $statut_occ = 'loge';
                $message = 2;
            }
            $requete = $bdd->prepare("INSERT INTO t_reservation (date_res,date_occ,date_lib,statut_res,statut_occ,id_client,type,id_hotel,dte_a,dte_s,tva,remise,taux,majoration,mont_nuite,mont_total_res,mont_par_chambre,nbr_ch,monnaie)
			                    VALUES(:date_res,:date_occ,:date_lib,:statut_res,:statut_occ,:id_client,:type,:id_hotel,:dte_a,:dte_s,:tva,:remise,:taux,:majoration,:mont_nuite,:mont_total_res,:mont_par_chambre,:nbr_ch,:monnaie)");

            $equivalent = $montant - $montant_nuite_res;
            $nbrechambre = count($_SESSION['panier']);
            $mont_par_chambre = $equivalent / $nbrechambre;

            $requete->BindParam(':date_res', $date_res);
            $requete->BindParam(':date_occ', $dte_arrive);
            $requete->BindParam(':date_lib', $dte_sortie);
            $requete->BindParam(':statut_res', $statut_res);
            $requete->BindParam(':statut_occ', $statut_occ);
            $requete->BindParam(':id_client', $_SESSION['id_client']);
            $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
            $requete->BindParam(':type', $type);
            $requete->BindParam(':dte_a', $dte_a);
            $requete->BindParam(':dte_s', $dte_s);
            $requete->BindParam(':tva', $tva);
            $requete->BindParam(':remise', $remise);
            $requete->BindParam(':taux', $tauxdollar);
            $requete->BindParam(':majoration', $majoration);
            $requete->BindParam(':mont_nuite', $montant_nuite_res);
            $requete->BindParam(':mont_total_res', $mont_total_res);
            $requete->BindParam(':mont_par_chambre', $mont_par_chambre);
            $requete->BindParam(':nbr_ch', $nbrechambre);
            $requete->BindParam(':monnaie', $libele_monnaie);
            $requete->execute();
            //Modification de num_res dans la bdd
            $id_res = $bdd->lastInsertId();
            if ($hebergement == 2) {

                $num_reserv = 'O/' . str_pad($num_com, 5, "0", STR_PAD_LEFT); //00001;
            } else {
                $num_reserv = 'R/' . str_pad($num_com, 5, "0", STR_PAD_LEFT);
            }//00001;
            $num_com = $num_com + 1;
            $requete = $bdd->prepare("UPDATE t_reservation  SET num_reserv =:num_reserv, num_com =:num_com WHERE id_res=:id_res");
            $requete->BindParam(':id_res', $id_res);
            $requete->BindParam(':num_reserv', $num_reserv);
            $requete->BindParam(':num_com', $num_com);
            $requete->execute();

            /* Fin Insertion dans la table t_reservation */

            /* Insertion dans t_reserve_chambre */

            foreach ($ids as $idch) {

                $requete = $bdd->prepare("SELECT capacite,num_ch,tarif_ch,monnaie FROM  t_chambre AS c WHERE c.id_ch=:idchambre");
                $requete->BindParam(':idchambre', $idch);
                $requete->execute();
                $capacite_value = $requete->fetchAll(PDO::FETCH_OBJ);
                foreach ($capacite_value as $ca) {
                    $capacite = $ca->capacite;
                    $num_ch = $ca->num_ch;
                    $tarif_ch = $ca->tarif_ch;
                    $monnaie_ch = $ca->monnaie;
                }
                //Tarif en fonction de la monnaie
                if ($monnaie_ch == 'USD') {
                    $tarif_ch_fc = $tarif_ch * $tauxdollar;
                } else {
                    $tarif_ch_fc = $tarif_ch;
                }
                //Fin Tarif en fonction de la monnaie
                $mont_paye_heb = $tarif_ch_fc * $_SESSION['nbre_jr'];
                if ($montant >= $mont_paye_heb) {
                    $montant = $montant - $mont_paye_heb;
                } else {
                    $mont_paye_heb = abs($montant);
                }

                $requete = $bdd->prepare("INSERT INTO t_reserve_chambre (idreserv,idchambre,id_client,id_accomp,statut,occupe,annule,est_responsable,mont_paye_heb,monnaie,date_occ,date_lib)
							VALUES(:idreserv,:idchambre,:id_client,:id_accomp,:statut,:occupe,:annule,:est_respo,:mont_paye_heb,:monnaie,:date_occ,:date_lib)");
                $statut = 'reserve';
                $annule = '';
                if ($hebergement == 2) {
                    $statut = 'occupe';
                    $occupe = 'occupe';
                    $est_respo = 'oui';
                    $annule = '';
                    $capacite = $capacite - 1;

                }
                $requete->BindParam(':idreserv', $id_res);
                $requete->BindParam(':idchambre', $idch);
                $requete->BindParam(':id_client', $_SESSION['id_client']);
                $requete->BindParam(':id_accomp', $_SESSION['id_accomp']);
                $requete->BindParam(':statut', $statut);
                $requete->BindParam(':occupe', $occupe);
                $requete->BindParam(':annule', $annule);
                $requete->BindParam(':est_respo', $est_respo);
                $requete->BindParam(':mont_paye_heb', $mont_paye_heb);
                $requete->BindParam(':monnaie', $libele_monnaie);
                $requete->BindParam(':date_occ', $dte_a);
                $requete->BindParam(':date_lib', $dte_s);
                $requete->execute();
                $res_ch_id = $bdd->lastInsertId();
                /* Insertion dans t_facture */
                $montot_fac_ch = $tarif_ch_fc * $_SESSION['nbre_jr'];
                $requete = $bdd->prepare("INSERT INTO  t_facture (montant_total,remise,majoration,justification,id_res,res_ch_id,id_user,monnaie,date_edition)
			                    VALUES(:montant_total,:remise,:majoration,:justification,:id_res,:res_ch_id,:id_user,:monnaie,:date_edition)");


                $requete->BindParam(':montant_total', $montot_fac_ch);
                $requete->BindParam(':remise', $remise);
                $requete->BindParam(':majoration', $majoration);
                $requete->BindParam(':justification', $justif);
                $requete->BindParam(':id_res', $id_res);
                $requete->BindParam(':res_ch_id', $res_ch_id);
                $requete->BindParam(':id_user', $_SESSION['id_user']);
                $requete->BindParam(':monnaie', $libele_monnaie);
                $date_edition = date('Y-m-d');
                $requete->BindParam(':date_edition', $date_edition);
                $requete->execute();

                /* Fin d'Insertion dans t_facture */

                //Modification de num_fact dans la bdd
                $id_fact = $bdd->lastInsertId();
                $num_fact = 'Fac/' . str_pad($id_fact, 5, "0", STR_PAD_LEFT); //00001;
                $_SESSION['num_fact'] = $num_fact;
                $requete = $bdd->prepare("UPDATE t_facture  SET num_fact =:num_fact WHERE id_fact=:id_fact");
                $requete->BindParam(':id_fact', $id_fact);
                $requete->BindParam(':num_fact', $num_fact);
                $requete->execute();
                // Fin Modification de num_fact dans la bdd

                /* Insertion dans t_reglement */

                $requete = $bdd->prepare("INSERT INTO  t_reglement (montant_fc,id_mode_regl,date_regl,id_fact,id_monnaie,id_user,id_hotel)
			                    VALUES(:montant_paye,:id_mode_regl,:date_regl,:id_fact,:id_monnaie,:id_user,:id_hotel)");
                $dte_regl = date('Y-m-d H:i:s');
                $reste = $montot_fac_ch - $mont_paye_heb;
                $_SESSION['reste'] = $reste;
                if ($libele_mode == 'Credit') {
                    $mont_paye_heb = 0;
                }
                $requete->BindParam(':montant_paye', $mont_paye_heb);
                $requete->BindParam(':id_mode_regl', $mode);
                $requete->BindParam(':date_regl', $dte_regl);
                $requete->BindParam(':id_fact', $id_fact);
                $requete->BindParam(':id_monnaie', $monnaie);
                $requete->BindParam(':id_user', $_SESSION['id_user']);
                $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
                $requete->execute();
                /* Fin d'Insertion dans t_facture */

            }
            echo $message;
            /* Fin d'Insertion dans t_reserve_chambre */

            /* Fin de l'insertion reservation */
        } else {
            //echo $_SESSION['montant_nuite'];
            echo 'Le montant saisi doit etre inférieur ou égal au montant total de la facture  '.$mont_fac_total_fc.' '.$m_affiche;
        }
        // Fin de la  verification du montant avec le net à payer
    } else {
        echo "Vous avez oublié d'entrer un montant ou  un mode de paiement. ";
    }
} //Paiement dollar
else if ($libele_monnaie == 'USD' && $reservation = 'mutiple') {
    $_SESSION['monnaie'] = $monnaie;

    if ((!empty($_POST['montantUSD']) && !empty($mode)&&$libele_mode=='Cash')||($libele_mode=='Credit'|| $libele_mode == 'Don')) {
        if ($libele_mode=='Cash'){
            $montant =$_POST['montantUSD'];
        }else{
            $montant = $montantUSD;
        }
        $_SESSION['montant_paye'] = $montant;

        // Montant nuité, montant total en fonction de la monnaie affichage prédéfinie
        if ($m_affiche == 'CDF') {
            $montant_nuite_fc = $_SESSION['montant_nuite'] / $tauxdollar;
            $mont_total_fc = $_SESSION['total'] / $tauxdollar;

            /* a traiter majoration et remise */
            $montant_nuite_res_remise = round($montant_nuite_fc * $remise / 100, 2);
            $montant_nuite_res_maj = round($montant_nuite_fc * $majoration / 100, 2);
            $montant_nuite_res = $montant_nuite_fc + $montant_nuite_res_maj - $montant_nuite_res_remise;

            $mont_total_res_remise = round($mont_total_fc * $remise / 100, 2);
            $mont_total_res_maj = round($mont_total_fc * $majoration / 100, 2);
            $mont_total_res = $mont_total_fc + $mont_total_res_maj - $mont_total_res_remise;

            $montant_nuite_fc_remise = round($montant_nuite_fc * $remise / 100, 2);
            $montant_maj_nuite_fc = round($montant_nuite_fc * $majoration / 100, 2);

            $mont_fac_total_fc_remise = round($mont_total_fc * $remise / 100, 2);
            $mont_fac_total_fc_maj = round($mont_total_fc * $majoration / 100, 2);

            $montant_nuite_fc = $montant_nuite_fc + $montant_maj_nuite_fc - $montant_nuite_fc_remise;
            $mont_fac_total_fc = $mont_total_fc + $mont_fac_total_fc_maj - $mont_fac_total_fc_remise;
            $_SESSION['total'] = $mont_fac_total_fc;
            /* Fin traiter majoration et remise */

        } else {
            $montant_nuite_fc = $_SESSION['montant_nuite'];
            $mont_total_fc = $_SESSION['total'];

            /* a traiter majoration et remise */
            $montant_nuite_res_remise = round($montant_nuite_fc * $remise / 100, 2);
            $montant_nuite_res_maj = round($montant_nuite_fc * $majoration / 100, 2);
            $montant_nuite_res = $montant_nuite_fc + $montant_nuite_res_maj - $montant_nuite_res_remise;

            $mont_total_res_remise = round($mont_total_fc * $remise / 100, 2);
            $mont_total_res_maj = round($mont_total_fc * $majoration / 100, 2);
            $mont_total_res = $mont_total_fc + $mont_total_res_maj - $mont_total_res_remise;

            $montant_nuite_fc_remise = round($montant_nuite_fc * $remise / 100, 2);
            $montant_maj_nuite_fc = round($montant_nuite_fc * $majoration / 100, 2);

            $mont_fac_total_fc_remise = round($mont_total_fc * $remise / 100, 2);
            $mont_fac_total_fc_maj = round($mont_total_fc * $majoration / 100, 2);

            $montant_nuite_fc = $montant_nuite_fc + $montant_maj_nuite_fc - $montant_nuite_fc_remise;
            $mont_fac_total_fc = $mont_total_fc + $mont_fac_total_fc_maj - $mont_fac_total_fc_remise;
            $_SESSION['total'] = $mont_fac_total_fc;
            /* Fin traiter majoration et remise */
        }


        //Verification du montant avec le net à payer
        if (($montant > 0) && ($montant >= $montant_nuite_fc && $montant <= $mont_fac_total_fc)) {

            /* Inssertion dans la table t_reservation */
            $statut_res = 'operationnel';

            /* Conversion date d'arrive */
            $transpostion = explode('/', $_SESSION['date_arrive']);
            $jrar = $transpostion[0];
            $moisar = $transpostion[1];
            $annee1ar = $transpostion[2];
            $transpostion1 = explode(' ', $annee1ar);
            $anneear = $transpostion1[0];
            $heurear = $transpostion1[1] . ':00';
            $dte_arrive = $anneear . '-' . $moisar . '-' . $jrar . ' ' . $heurear;
            $dte_a = $anneear . '-' . $moisar . '-' . $jrar;
            /* Fin Conversion date d'arrive */

            /* Conversion date de sortie */
            $transpostion_sortie = explode('/', $_SESSION['date_sorti']);
            $jrsor = $transpostion_sortie[0];
            $moisor = $transpostion_sortie[1];
            $annee1sor = $transpostion_sortie[2];
            $transpostion_sortie1 = explode(' ', $annee1sor);
            $anneesor = $transpostion_sortie1[0];
            $heuresor = $transpostion_sortie1[1] . ':00';
            $dte_sortie = $anneesor . '-' . $moisor . '-' . $jrsor . ' ' . $heuresor;
            $dte_s = $anneesor . '-' . $moisor . '-' . $jrsor;

            /* Fin Conversion date d'arrive */
            $date_res = date('Y-m-d H:i:s');
            $type = 'reservation';
            $_SESSION['type'] = $type;
            // $num=1;
            $message = 1;
            if ($hebergement == 2) {
                $type = 'occupation';
                $_SESSION['type'] = $type;
                $statut_res = ' ';
                $statut_occ = 'loge';
                $message = 2;
            }
            $requete = $bdd->prepare("INSERT INTO t_reservation (date_res,date_occ,date_lib,statut_res,statut_occ,id_client,type,id_hotel,dte_a,dte_s,tva,remise,taux,majoration,mont_nuite,mont_total_res,mont_par_chambre,nbr_ch,monnaie)
			                    VALUES(:date_res,:date_occ,:date_lib,:statut_res,:statut_occ,:id_client,:type,:id_hotel,:dte_a,:dte_s,:tva,:remise,:taux,:majoration,:mont_nuite,:mont_total_res,:mont_par_chambre,:nbr_ch,:monnaie)");

            $equivalent = $montant - $montant_nuite_res;
            $nbrechambre = count($_SESSION['panier']);
            $mont_par_chambre = $equivalent / $nbrechambre;

            $requete->BindParam(':date_res', $date_res);
            $requete->BindParam(':date_occ', $dte_arrive);
            $requete->BindParam(':date_lib', $dte_sortie);
            $requete->BindParam(':statut_res', $statut_res);
            $requete->BindParam(':statut_occ', $statut_occ);
            $requete->BindParam(':id_client', $_SESSION['id_client']);
            $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
            $requete->BindParam(':type', $type);
            $requete->BindParam(':dte_a', $dte_a);
            $requete->BindParam(':dte_s', $dte_s);
            $requete->BindParam(':tva', $tva);
            $requete->BindParam(':remise', $remise);
            $requete->BindParam(':taux', $tauxdollar);
            $requete->BindParam(':majoration', $majoration);
            $requete->BindParam(':mont_nuite', $montant_nuite_res);
            $requete->BindParam(':mont_total_res', $mont_total_res);
            $requete->BindParam(':mont_par_chambre', $mont_par_chambre);
            $requete->BindParam(':nbr_ch', $nbrechambre);
            $requete->BindParam(':monnaie', $libele_monnaie);
            $requete->execute();
            //Modification de num_res dans la bdd
            $id_res = $bdd->lastInsertId();
            if ($hebergement == 2) {

                $num_reserv = 'O/' . str_pad($num_com, 5, "0", STR_PAD_LEFT); //00001;
            } else {
                $num_reserv = 'R/' . str_pad($num_com, 5, "0", STR_PAD_LEFT);
            }//00001;

            $num_com = $num_com + 1;
            $requete = $bdd->prepare("UPDATE t_reservation  SET num_reserv =:num_reserv, num_com =:num_com WHERE id_res=:id_res");
            $requete->BindParam(':id_res', $id_res);
            $requete->BindParam(':num_reserv', $num_reserv);
            $requete->BindParam(':num_com', $num_com);
            $requete->execute();
            /*  //Modification de num_res dans la bdd
              $id_res = $bdd->lastInsertId();
              if ($hebergement == 2) {

                  $num_reserv = 'O/' . str_pad($id_res, 5, "0", STR_PAD_LEFT); //00001;
              } else {
                  $num_reserv = 'R/' . str_pad($id_res, 5, "0", STR_PAD_LEFT);
              }//00001;

              $requete = $bdd->prepare("UPDATE t_reservation  SET num_reserv =:num_reserv WHERE id_res=:id_res");
              $requete->BindParam(':id_res', $id_res);
              $requete->BindParam(':num_reserv', $num_reserv);
              $requete->execute();
              // Fin Modification de num_res dans la bdd*/

            /* Fin Insertion dans la table t_reservation */

            /* Insertion dans t_reserve_chambre */

            foreach ($ids as $idch) {

                $requete = $bdd->prepare("SELECT capacite,num_ch,tarif_ch,monnaie FROM  t_chambre AS c WHERE c.id_ch=:idchambre");
                $requete->BindParam(':idchambre', $idch);
                $requete->execute();
                $capacite_value = $requete->fetchAll(PDO::FETCH_OBJ);
                foreach ($capacite_value as $ca) {
                    $capacite = $ca->capacite;
                    $num_ch = $ca->num_ch;
                    $tarif_ch = $ca->tarif_ch;
                    $monnaie_ch = $ca->monnaie;
                }
                //Tarif en fonction de la monnaie
                if ($monnaie_ch == 'CDF') {
                    $tarif_ch_fc = $tarif_ch / $tauxdollar;
                } else {
                    $tarif_ch_fc = $tarif_ch;
                }
                //Fin Tarif en fonction de la monnaie
                $mont_paye_heb = $tarif_ch_fc * $_SESSION['nbre_jr'];
                if ($montant >= $mont_paye_heb) {
                    $montant = $montant - $mont_paye_heb;
                } else {
                    $mont_paye_heb = abs($montant);
                }

                $requete = $bdd->prepare("INSERT INTO t_reserve_chambre (idreserv,idchambre,id_client,id_accomp,statut,occupe,annule,est_responsable,mont_paye_heb,monnaie,date_occ,date_lib)
							VALUES(:idreserv,:idchambre,:id_client,:id_accomp,:statut,:occupe,:annule,:est_respo,:mont_paye_heb,:monnaie,:date_occ,:date_lib)");
                $statut = 'reserve';
                $annule = '';
                if ($hebergement == 2) {
                    $statut = 'occupe';
                    $occupe = 'occupe';
                    $est_respo = 'oui';
                    $annule = '';
                    $capacite = $capacite - 1;

                }
                $requete->BindParam(':idreserv', $id_res);
                $requete->BindParam(':idchambre', $idch);
                $requete->BindParam(':id_client', $_SESSION['id_client']);
                $requete->BindParam(':id_accomp', $_SESSION['id_accomp']);
                $requete->BindParam(':statut', $statut);
                $requete->BindParam(':occupe', $occupe);
                $requete->BindParam(':annule', $annule);
                $requete->BindParam(':est_respo', $est_respo);
                $requete->BindParam(':mont_paye_heb', $mont_paye_heb);
                $requete->BindParam(':monnaie', $libele_monnaie);
                $requete->BindParam(':date_occ', $dte_a);
                $requete->BindParam(':date_lib', $dte_s);
                $requete->execute();
                $res_ch_id = $bdd->lastInsertId();
                /* Mise à jour capacite chambre */
                $requete = $bdd->prepare("UPDATE t_chambre  SET capacite =:capacite WHERE id_ch=:idchambre");
                $requete->BindParam(':capacite', $capacite);
                $requete->BindParam(':idchambre', $idch);
                $requete->execute();
                $requete = $bdd->prepare("UPDATE t_chambre  SET occupe='oui',libre='non' WHERE id_ch=:idchambre");
                $requete->BindParam(':idchambre', $idch);
                $requete->execute();

                /* Fin d'Insertion dans t_reserve_chambre */

                /* Insertion dans t_facture */

                $montot_fac_ch = $tarif_ch_fc * $_SESSION['nbre_jr'];
                $requete = $bdd->prepare("INSERT INTO  t_facture (montant_total,remise,majoration,justification,id_res,res_ch_id,id_user,monnaie,date_edition)
			                    VALUES(:montant_total,:remise,:majoration,:justification,:id_res,:res_ch_id,:id_user,:monnaie,:date_edition)");


                $requete->BindParam(':montant_total', $montot_fac_ch);
                $requete->BindParam(':remise', $remise);
                $requete->BindParam(':majoration', $majoration);
                $requete->BindParam(':justification', $justif);
                $requete->BindParam(':id_res', $id_res);
                $requete->BindParam(':res_ch_id', $res_ch_id);
                $requete->BindParam(':id_user', $_SESSION['id_user']);
                $requete->BindParam(':monnaie', $libele_monnaie);
                $date_edition = date('Y-m-d');
                $requete->BindParam(':date_edition', $date_edition);
                $requete->execute();

                /* Fin d'Insertion dans t_facture */

                //Modification de num_fact dans la bdd
                $id_fact = $bdd->lastInsertId();
                $num_fact = 'Fac/' . str_pad($id_fact, 5, "0", STR_PAD_LEFT); //00001;
                $_SESSION['num_fact'] = $num_fact;
                $requete = $bdd->prepare("UPDATE t_facture  SET num_fact =:num_fact WHERE id_fact=:id_fact");
                $requete->BindParam(':id_fact', $id_fact);
                $requete->BindParam(':num_fact', $num_fact);
                $requete->execute();
                // Fin Modification de num_fact dans la bdd

                /* Insertion dans t_reglement */


                $requete = $bdd->prepare("INSERT INTO  t_reglement (montant_dollar,id_mode_regl,date_regl,id_fact,id_monnaie,id_user,id_hotel)
			                    VALUES(:montant_paye,:id_mode_regl,:date_regl,:id_fact,:id_monnaie,:id_user,:id_hotel)");
                $dte_regl = date('Y-m-d H:i:s');
                $reste = $montot_fac_ch - $mont_paye_heb;
                $_SESSION['reste'] = $reste;
                if ($libele_mode == 'Credit') {
                    $mont_paye_heb = 0;
                }
                $requete->BindParam(':montant_paye', $mont_paye_heb);
                $requete->BindParam(':id_mode_regl', $mode);
                $requete->BindParam(':date_regl', $dte_regl);
                $requete->BindParam(':id_fact', $id_fact);
                $requete->BindParam(':id_monnaie', $monnaie);
                $requete->BindParam(':id_user', $_SESSION['id_user']);
                $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
                $requete->execute();

                /* Fin d'Insertion dans t_facture */
            }
            echo $message;


            /* Fin de l'insertion reservation */
        } else {
            $m_affiche='USD';
            echo 'Le montant saisi doit etre inférieur ou égal au montant total de la facture  '.$mont_fac_total_fc.' '.$m_affiche;
        }
        // Fin de la  verification du montant avec le net à payer
    } else {
        echo "Vous avez oublié d'entrer un montant ou  un mode de paiement. ";
    }
}
else {
    // Paiement en deux monnaies
    if (!empty($montantUSD) && !empty($montantFC)) {

        $tauxdollar = $tauxdollar;

        // Montant nuité, montant total en fonction de la monnaie affichage prédéfinie
        if ($m_affiche == 'CDF') {
            $montant_nuite_fc = $_SESSION['montant_nuite'] / $tauxdollar;
            $mont_total_fc = $_SESSION['total'] / $tauxdollar;

            /* a traiter majoration et remise */
            $montant_nuite_res_remise = round($montant_nuite_fc * $remise / 100, 2);
            $montant_nuite_res_maj = round($montant_nuite_fc * $majoration / 100, 2);
            $montant_nuite_res = $montant_nuite_fc + $montant_nuite_res_maj - $montant_nuite_res_remise;

            $mont_total_res_remise = round($mont_total_fc * $remise / 100, 2);
            $mont_total_res_maj = round($mont_total_fc * $majoration / 100, 2);
            $mont_total_res = $mont_total_fc + $mont_total_res_maj - $mont_total_res_remise;

            $montant_nuite_fc_remise = round($montant_nuite_fc * $remise / 100, 2);
            $montant_maj_nuite_fc = round($montant_nuite_fc * $majoration / 100, 2);

            $mont_fac_total_fc_remise = round($mont_total_fc * $remise / 100, 2);
            $mont_fac_total_fc_maj = round($mont_total_fc * $majoration / 100, 2);

            $montant_nuite_fc = $montant_nuite_fc + $montant_maj_nuite_fc - $montant_nuite_fc_remise;
            $mont_fac_total_fc = $mont_total_fc + $mont_fac_total_fc_maj - $mont_fac_total_fc_remise;
            $_SESSION['total'] = $mont_fac_total_fc;
            /* Fin traiter majoration et remise */

        } else {
            $montant_nuite_fc = $_SESSION['montant_nuite'];
            $mont_total_fc = $_SESSION['total'];

            /* a traiter majoration et remise */
            $montant_nuite_res_remise = round($montant_nuite_fc * $remise / 100, 2);
            $montant_nuite_res_maj = round($montant_nuite_fc * $majoration / 100, 2);
            $montant_nuite_res = $montant_nuite_fc + $montant_nuite_res_maj - $montant_nuite_res_remise;

            $mont_total_res_remise = round($mont_total_fc * $remise / 100, 2);
            $mont_total_res_maj = round($mont_total_fc * $majoration / 100, 2);
            $mont_total_res = $mont_total_fc + $mont_total_res_maj - $mont_total_res_remise;

            $montant_nuite_fc_remise = round($montant_nuite_fc * $remise / 100, 2);
            $montant_maj_nuite_fc = round($montant_nuite_fc * $majoration / 100, 2);

            $mont_fac_total_fc_remise = round($mont_total_fc * $remise / 100, 2);
            $mont_fac_total_fc_maj = round($mont_total_fc * $majoration / 100, 2);

            $montant_nuite_fc = $montant_nuite_fc + $montant_maj_nuite_fc - $montant_nuite_fc_remise;
            $mont_fac_total_fc = $mont_total_fc + $mont_fac_total_fc_maj - $mont_fac_total_fc_remise;
            $_SESSION['total'] = $mont_fac_total_fc;
            /* Fin traiter majoration et remise */
        }


        $mont_fc_usd = round($montantFC / $tauxdollar, 2);
        $mont_paye = $montantUSD + $mont_fc_usd;
        $_SESSION['montant_paye'] = $mont_paye;
        if (($montantUSD > 0 && $montantFC > 0) && (($mont_paye >= $montant_nuite_fc) && ($mont_paye <= $mont_fac_total_fc))) {

            /* Inssertion dans la table t_reservation */
            $statut_res = 'operationnel';

            /* Conversion date d'arrive */
            $transpostion = explode('/', $_SESSION['date_arrive']);
            $jrar = $transpostion[0];
            $moisar = $transpostion[1];
            $annee1ar = $transpostion[2];
            $transpostion1 = explode(' ', $annee1ar);
            $anneear = $transpostion1[0];
            $heurear = $transpostion1[1] . ':00';
            $dte_arrive = $anneear . '-' . $moisar . '-' . $jrar . ' ' . $heurear;
            $dte_a = $anneear . '-' . $moisar . '-' . $jrar;
            /* Fin Conversion date d'arrive */

            /* Conversion date de sortie */
            $transpostion_sortie = explode('/', $_SESSION['date_sorti']);
            $jrsor = $transpostion_sortie[0];
            $moisor = $transpostion_sortie[1];
            $annee1sor = $transpostion_sortie[2];
            $transpostion_sortie1 = explode(' ', $annee1sor);
            $anneesor = $transpostion_sortie1[0];
            $heuresor = $transpostion_sortie1[1] . ':00';
            $dte_sortie = $anneesor . '-' . $moisor . '-' . $jrsor . ' ' . $heuresor;
            $dte_s = $anneesor . '-' . $moisor . '-' . $jrsor;

            /* Fin Conversion date d'arrive */

            $date_res = date('Y-m-d H:i:s');
            $type = 'reservation';
            $_SESSION['type'] = $type;
            // $num=1;

            $message = 1;
            if ($hebergement == 2) {
                $type = 'occupation';
                $_SESSION['type'] = $type;
                $statut_res = ' ';
                $statut_occ = 'loge';
                $message = 2;
            }
            $requete = $bdd->prepare("INSERT INTO t_reservation (date_res,date_occ,date_lib,statut_res,statut_occ,id_client,type,id_hotel,dte_a,dte_s,tva,remise,taux,majoration,mont_nuite,mont_total_res,mont_par_chambre,nbr_ch,monnaie)
			                    VALUES(:date_res,:date_occ,:date_lib,:statut_res,:statut_occ,:id_client,:type,:id_hotel,:dte_a,:dte_s,:tva,:remise,:taux,:majoration,:mont_nuite,:mont_total_res,:mont_par_chambre,:nbr_ch,:monnaie)");

            $equivalent = $montant - $montant_nuite_res;
            $nbrechambre = count($_SESSION['panier']);
            $mont_par_chambre = $equivalent / $nbrechambre;

            $requete->BindParam(':date_res', $date_res);
            $requete->BindParam(':date_occ', $dte_arrive);
            $requete->BindParam(':date_lib', $dte_sortie);
            $requete->BindParam(':statut_res', $statut_res);
            $requete->BindParam(':statut_occ', $statut_occ);
            $requete->BindParam(':id_client', $_SESSION['id_client']);
            $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
            $requete->BindParam(':type', $type);
            $requete->BindParam(':dte_a', $dte_a);
            $requete->BindParam(':dte_s', $dte_s);
            $requete->BindParam(':tva', $tva);
            $requete->BindParam(':remise', $remise);
            $requete->BindParam(':taux', $tauxdollar);
            $requete->BindParam(':majoration', $majoration);
            $requete->BindParam(':mont_nuite', $montant_nuite_res);
            $requete->BindParam(':mont_total_res', $mont_total_res);
            $requete->BindParam(':mont_par_chambre', $mont_par_chambre);
            $requete->BindParam(':nbr_ch', $nbrechambre);
            $requete->BindParam(':monnaie', $libele_monnaie);
            $requete->execute();
            //Modification de num_res dans la bdd
            $id_res = $bdd->lastInsertId();
            if ($hebergement == 2) {

                $num_reserv = 'O/' . str_pad($num_com, 5, "0", STR_PAD_LEFT); //00001;
            } else {
                $num_reserv = 'R/' . str_pad($num_com, 5, "0", STR_PAD_LEFT);
            }//00001;

            $num_com = $num_com + 1;
            $requete = $bdd->prepare("UPDATE t_reservation  SET num_reserv =:num_reserv, num_com =:num_com WHERE id_res=:id_res");
            $requete->BindParam(':id_res', $id_res);
            $requete->BindParam(':num_reserv', $num_reserv);
            $requete->BindParam(':num_com', $num_com);
            $requete->execute();
            // Fin Modification de num_res dans la bdd
            /* //Modification de num_res dans la bdd
             $id_res = $bdd->lastInsertId();
             if ($hebergement == 2) {

                 $num_reserv = 'O/' . str_pad($id_res, 5, "0", STR_PAD_LEFT); //00001;
             } else {
                 $num_reserv = 'R/' . str_pad($id_res, 5, "0", STR_PAD_LEFT);
             }//00001;

             $requete = $bdd->prepare("UPDATE t_reservation  SET num_reserv =:num_reserv WHERE id_res=:id_res");
             $requete->BindParam(':id_res', $id_res);
             $requete->BindParam(':num_reserv', $num_reserv);
             $requete->execute();
             // Fin Modification de num_res dans la bdd*/

            /* Fin Insertion dans la table t_reservation */

            /* Insertion dans t_reserve_chambre */

            $montantFC_dolar = $montantFC / $tauxdollar;

            foreach ($ids as $idch) {

                $requete = $bdd->prepare("SELECT capacite,num_ch,tarif_ch,monnaie FROM  t_chambre AS c WHERE c.id_ch=:idchambre");
                $requete->BindParam(':idchambre', $idch);
                $requete->execute();
                $capacite_value = $requete->fetchAll(PDO::FETCH_OBJ);
                foreach ($capacite_value as $ca) {
                    $capacite = $ca->capacite;
                    $num_ch = $ca->num_ch;
                    $tarif_ch = $ca->tarif_ch;
                    $monnaie_ch = $ca->monnaie;
                }
                //Tarif en fonction de la monnaie
                if ($monnaie_ch == 'CDF') {
                    $tarif_ch_fc = $tarif_ch / $tauxdollar;
                } else {
                    $tarif_ch_fc = $tarif_ch;
                }
                //Fin Tarif en fonction de la monnaie
                $mont_paye_heb = $tarif_ch_fc * $_SESSION['nbre_jr'];

                if ($montantUSD >= $mont_paye_heb) {
                    $montantUSD = $montantUSD - $mont_paye_heb;
                    $montantUSD_paye = $mont_paye_heb;
                    $montantFC_paye = 0;

                } else {
                    $montantUSD_test = $montantFC_dolar + $montantUSD;
                    if ($montantUSD_test >= $mont_paye_heb) {
                        $montantUSD_paye = $montantUSD;

                        $montant_reste_heb = $mont_paye_heb - $montantUSD;
                        $montantFC_paye = $montant_reste_heb * $tauxdollar;

                        $montantFC_dolar = $montantFC_dolar - $montant_reste_heb;
                        $montantUSD = 0;

                    } else {
                        $montantUSD_paye = 0;
                        $montantFC_paye = $montantUSD_test * $tauxdollar;
                    }
                }
                $requete = $bdd->prepare("INSERT INTO t_reserve_chambre (idreserv,idchambre,id_client,id_accomp,statut,occupe,annule,est_responsable,mont_paye_heb,monnaie,date_occ,date_lib)
							VALUES(:idreserv,:idchambre,:id_client,:id_accomp,:statut,:occupe,:annule,:est_respo,:mont_paye_heb,:monnaie,:date_occ,:date_lib)");
                $statut = 'reserve';
                $annule = '';
                if ($hebergement == 2) {
                    $statut = 'occupe';
                    $occupe = 'occupe';
                    $est_respo = 'oui';
                    $annule = '';
                    $capacite = $capacite - 1;

                }
                $requete->BindParam(':idreserv', $id_res);
                $requete->BindParam(':idchambre', $idch);
                $requete->BindParam(':id_client', $_SESSION['id_client']);
                $requete->BindParam(':id_accomp', $_SESSION['id_accomp']);
                $requete->BindParam(':statut', $statut);
                $requete->BindParam(':occupe', $occupe);
                $requete->BindParam(':annule', $annule);
                $requete->BindParam(':est_respo', $est_respo);
                $requete->BindParam(':mont_paye_heb', $mont_paye_heb);
                $requete->BindParam(':monnaie', $libele_monnaie);
                $requete->BindParam(':date_occ', $dte_a);
                $requete->BindParam(':date_lib', $dte_s);
                $requete->execute();
                $res_ch_id = $bdd->lastInsertId();

                /* Fin d'Insertion dans t_reserve_chambre */

                /* Insertion dans t_facture */

                $montot_fac_ch = $tarif_ch_fc * $_SESSION['nbre_jr'];
                $requete = $bdd->prepare("INSERT INTO  t_facture (montant_total,remise,majoration,justification,id_res,res_ch_id,id_user,monnaie,date_edition)
			                    VALUES(:montant_total,:remise,:majoration,:justification,:id_res,:res_ch_id,:id_user,:monnaie,:date_edition)");


                $requete->BindParam(':montant_total', $montot_fac_ch);
                $requete->BindParam(':remise', $remise);
                $requete->BindParam(':majoration', $majoration);
                $requete->BindParam(':justification', $justif);
                $requete->BindParam(':id_res', $id_res);
                $requete->BindParam(':res_ch_id', $res_ch_id);
                $requete->BindParam(':id_user', $_SESSION['id_user']);
                $requete->BindParam(':monnaie', $libele_monnaie);
                $date_edition = date('Y-m-d');
                $requete->BindParam(':date_edition', $date_edition);
                $requete->execute();

                /* Fin d'Insertion dans t_facture */

                //Modification de num_fact dans la bdd
                $id_fact = $bdd->lastInsertId();
                $num_fact = 'Fac/' . str_pad($id_fact, 5, "0", STR_PAD_LEFT); //00001;
                $_SESSION['num_fact'] = $num_fact;
                $requete = $bdd->prepare("UPDATE t_facture  SET num_fact =:num_fact WHERE id_fact=:id_fact");
                $requete->BindParam(':id_fact', $id_fact);
                $requete->BindParam(':num_fact', $num_fact);
                $requete->execute();
                // Fin Modification de num_fact dans la bdd

                /* Insertion dans t_reglement */


                $requete = $bdd->prepare("INSERT INTO  t_reglement (montant_fc,montant_dollar,reste,id_mode_regl,date_regl,id_fact,id_monnaie,id_user,id_hotel)
			                    VALUES(:montant_fc,:montant_dollar,:reste,:id_mode_regl,:date_regl,:id_fact,:id_monnaie,:id_user,:id_hotel)");
                $dte_regl = date('Y-m-d H:i:s');
                $reste = $mont_fac_total_fc - $mont_paye;
                $_SESSION['reste'] = $reste;
                if ($libele_mode == 'Credit') {
                    $montantFC_paye = 0;
                    $montantUSD_paye = 0;
                }
                $requete->BindParam(':montant_fc', $montantFC_paye);
                $requete->BindParam(':montant_dollar', $montantUSD_paye);
                $requete->BindParam(':reste', $reste);
                $requete->BindParam(':id_mode_regl', $mode);
                $requete->BindParam(':date_regl', $dte_regl);
                $requete->BindParam(':id_fact', $id_fact);
                $requete->BindParam(':id_monnaie', $monnaie);
                $requete->BindParam(':id_user', $_SESSION['id_user']);
                $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
                $requete->execute();

                /* Fin d'Insertion dans t_facture */
            }

            echo $message;
            /* Fin de l'insertion reservation */
        } else {
            echo "Veuillez verifier les deux montants en USD et CDF! ";
        }
    } else {

        echo "Veuillez entrer les deux montants en USD et CDF! ";
    }
}
