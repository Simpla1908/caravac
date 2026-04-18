<?php
ini_set('display_errors',1);
if (!isset($_SESSION)) {
    session_start();
}
include('../../FUNCTION/hebergement_data.php');
//Connexion1
$user = 'ebutelociruserbd';
$pass = 'Mdpebutelo20';
$dsn = 'mysql:host=ebutelociruserbd.mysql.db;dbname=ebutelociruserbd';
try {
    $bdd1 = new PDO($dsn, $user, $pass);
    $bdd1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    echo 'con1 ok';
} catch (PDOException $e) {
    echo 'Echec1';
    print "Erreur ! : " . $e->getMessage() . "<br/>";
    die();
}
//Connexion2
$user = 'ebutelocirbp4265';
$pass = 'Mot2pa553';
$dsn = 'mysql:host=ebutelocirbp4265.mysql.db;dbname=ebutelocirbp4265';
try {
    $bdd = new PDO($dsn, $user, $pass);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    echo 'con2 ok';
} catch (PDOException $e) {
    echo 'Echec2';
    print "Erreur ! : " . $e->getMessage() . "<br/>";
    die();
}
//DONNEES DE BASE
$company_id = 102;
$id_hotel = 107;
$id_sousresto = 78;
$datedebut = '2019-03-01';
$datefin = '2019-03-31';
$regl_id2 = 0;
$idres_ch = 0;
$mode='';
//COMMMANDE
//$requete = $bdd1->prepare("SELECT  * FROM t_reservation WHERE id_res=1217 AND id_hotel=107");
$requete = $bdd1->prepare("SELECT  * FROM t_reservation "
        . "WHERE id_hotel=:id_hotel AND statut_res ='hebergement' AND dte BETWEEN :p_debut AND :p_fin");
$requete->BindParam(':id_hotel', $id_hotel);
$requete->BindParam(':p_debut', $datedebut);
$requete->BindParam(':p_fin', $datefin);
$requete->execute();
$result = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($result as $op) {
    $id_res = $op->id_res;
    $id_client = $op->id_client;
    $numfact = $op->num_reserv;
    $motif = $op->type;
    $fact1 = 0; //facture de la chambre libre
    if ($motif == 'occupation') {
        $fact1 = 2;
    } elseif ($motif == 'reservation') {
        $fact1 = 1;
    }
    $dte = $op->dte;
    $monnaie = $op->monnaie;
    $libelle = $op->statut_res;
    $dte_a = $op->dte_a;
    $dte_s = $op->dte_s;
    $statut = $op->etat;
    $mode = $op->etat_credit;
    $statut_res = $op->statut_res;
    $mont_total_res = $op->mont_total_res;
    $montantnuite = $op->mont_nuite;
    $idsite = $id_hotel;
    $requete = $bdd1->prepare("SELECT * FROM t_client WHERE id_client=:id_client");
    $requete->BindParam(':id_client', $id_client);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    $respo_id = $result->id_respo;
	if($respo_id==1){
		$respo_id =184;
	}
    $id_res2 = InsertReservation($id_client, $motif, $dte, $dte_a, $dte_s, $numfact, $monnaie, $idsite, $statut, $statut_res, $mont_total_res, $montantnuite, $mode, $respo_id, $bdd);
    echo'reservation heb ok '.$id_res2 ;
    //FACTURE
    $requete = $bdd1->prepare("SELECT * FROM t_facture WHERE id_hotel=:id_hotel AND id_res=:id_res");
    $requete->BindParam(':id_hotel',$id_hotel);
    $requete->BindParam(':id_res',$id_res);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $op) {
        $id_fact = $op->id_fact;
        if ($op->type=='hebergement') {
            $statut_res = $op->type;
            $numfact = $op->num_fact;
            $taux = $op->taux;
            $tva = $op->tva;
            $monnaie = $op->monnaie;
            $dte = $op->date_edition;
            $id_client = $op->id_client;
            $id_user = $op->id_user;
            $montant_tva = $op->mont_tva;
            $montant_remise = $op->remise;
            $tauxremise = $op->mont_ttc_remise;
            $mont_total_res = $op->mont_ttc;
            $etat = $op->etat;
            $libelle_mode = $mode;
            $date_h_com = $op->dte_time;
            $res_ch_id = $op->res_ch_id;
            $idsite = $id_hotel;
            $id_fact2 = InsertFactureHeb($statut_res, $numfact, $id_res2, $taux, $tva, $monnaie, $dte, $id_client, $id_user, $idsite, $company_id, $mont_total_res, $tauxremise, $libelle_mode, $fact1, $bdd);
            echo'fact'. $id_fact2;
            $requete = $bdd1->prepare("SELECT  * FROM t_reserve_chambre WHERE idfact=:idfact");
            $requete->BindParam(':idfact',$id_fact);
            $requete->execute();
            $result = $requete->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $op) {
                $idch = $op->idchambre;
                $statut1 = $op->statut;
                $produit_id = $op->produit_id;
                $dte_a = $op->date_occ;
                $dte_s = $op->date_lib;
				$quantite =NbJours($dte_a, $dte_s);
                $prix = $op->prix;
                $dte = $op->dte;
                $tarif_ch = $op->tarif_ch;
                $id_accomp = $op->id_accomp;
                $nom_accomp = $op->nom_accomp;
                $checkout = $op->checkout;
                $checkin = $op->checkin;
                $monnaie = $op->monnaie;
                $idres_ch = InsertReserveChambre($id_res2, $id_fact2, $idch, $id_client, $statut1, $dte_a, $dte_s, $tarif_ch, $id_accomp, $nom_accomp, $checkin, $checkout, $idsite, $monnaie, $bdd);
				$chhisto_id = InsertChambreHisto($idres_ch, $idch, $statut1, $dte_a, $dte_s, $tarif_ch, $monnaie,$quantite,$bdd);
                echo'LigneChambre ok '.$idres_ch;
            }
            $requete = $bdd1->prepare("SELECT * FROM t_reglement WHERE id_hotel=:id_hotel AND id_fact=:id_fact");
            $requete->BindParam(':id_hotel', $idsite);
            $requete->BindParam(':id_fact', $id_fact);
            $requete->execute();
            $result = $requete->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $op) {
                $regl_id = $op->id_regl;
                $num_recu = $op->numero;
                $date_h_com = $op->date_regl;
                $dte = $op->dte;
                $id_user = $op->id_user;
                $regl_id2 = InsertReglement($num_recu, $id_fact2, $date_h_com, $dte, $id_user, $idsite, $bdd);
                echo'Reglement heb ok';
                $requete = $bdd1->prepare("SELECT  * FROM paiement WHERE site_id=:id_hotel AND regl_id=:regl_id");
                $requete->BindParam(':id_hotel', $id_hotel);
                $requete->BindParam(':regl_id', $regl_id);
                $requete->execute();
                $result = $requete->fetchAll(PDO::FETCH_OBJ);
                $boolpaie = TRUE;
                foreach ($result as $op) {
                    $montusd = $op->montantusd;
                    $montcdf = $op->montantcdf;
                    $rendu = $op->rendu;
                    $taux_op = $op->taux;
                    $montant_remise = $op->remise;
                    $justification = $op->justification;
                    $rendu_usd = 0;
                    $rendu_cdf = 0;
                    $mode = $op->id_mode_regl;
                    $histch_id = NULL;
                    InsertPaiement($montusd, $montcdf, $taux, $rendu, $rendu_usd, $rendu_cdf, $montremise, $justification, $mode, $regl_id2, $idsite, $company_id, $histch_id, $idres_ch, $bdd);
                    echo'Paiement heb ok';
                    if ($boolpaie) {
                        $modefact = $mode;
                        $lib = '';
                        if ($modefact == 3) {
                            $lib = 'Credit';
                        } elseif ($modefact == 2) {
                            $lib = 'Cash';
                        } elseif ($modefact == 1) {
                            $lib = 'Don';
                        }
                        $requete = $bdd->prepare("UPDATE t_facture  SET mode=:mode WHERE id_fact=:id_fact");
                        $requete->BindParam(':mode', $lib);
                        $requete->BindParam(':id_fact', $id_fact2);
                        $requete->execute();
                        $boolpaie = FALSE;
                        echo'Maj mode ok';
                    }
                }
            }
        } else {
			$id_fact = $op->id_fact;
            $type = $op->type;
            $num_cmd_format = $op->num_fact;
            $id_res =$id_res2;
            $taux_op = $op->taux;
            $tauxdollar = $op->taux_prix;
            $tva = $op->tva;
            $m_affiche = $op->monnaie;
            $dte = $op->date_edition;
            $id_client = $op->id_client;
            $id_user = $op->id_user;
            $montant_tva = $op->mont_tva;
            $montant_remise = $op->remise;
            $remise = $op->mont_ttc_remise;
            $mont_ttc = $op->mont_ttc;
            $etat = $op->etat;
            $lib_mode = $op->mode;
            $date_h_com = $op->dte_time;
            $mont_ht = $op->montant_total;
            $mont_ht = ht($mont_ttc, $tva, $remise);
            $res_ch_id =$idres_ch;
            $requete = $bdd->prepare("INSERT INTO t_facture (type,num_fact,id_res,taux,taux_prix,tva,monnaie,date_edition,id_client,id_user,id_hotel,id_sousresto,company_id,mont_tva,remise,mont_ttc_remise,mont_ttc,res_ch_id,etat,mode,dte_time,montant_total)
                            VALUES(:type,:num_fact,:id_res,:taux,:taux_prix,:tva,:monnaie,:date_edition,:id_client,:id_user,:id_hotel,:id_sousresto,:company_id,:mont_tva,:remise,:mont_ttc_remise,:mont_ttc,:res_ch_id,:etat,:mode,:dte_time,:montant_total)");
            $requete->BindParam(':type', $type);
            $requete->BindParam(':num_fact', $num_cmd_format);
            $requete->BindParam(':id_res', $id_res2);
            $requete->BindParam(':taux', $taux_op);
            $requete->BindParam(':taux_prix', $tauxdollar);
            $requete->BindParam(':tva', $tva);
            $requete->BindParam(':monnaie', $m_affiche);
            $requete->BindParam(':date_edition', $dte);
            $requete->BindParam(':id_client', $id_client);
            $requete->BindParam(':id_user', $id_user);
            $requete->BindParam(':id_hotel', $id_hotel);
            $requete->BindParam(':id_sousresto', $id_sousresto);
            $requete->BindParam(':company_id', $company_id);
            $requete->BindParam(':mont_tva', $montant_tva);
            $requete->BindParam(':remise', $montant_remise);
            $requete->BindParam(':mont_ttc_remise', $remise);
            $requete->BindParam(':mont_ttc', $mont_ttc);
            $requete->BindParam(':res_ch_id', $res_ch_id);
            $requete->BindParam(':etat', $etat);
            $requete->BindParam(':mode', $lib_mode);
            $requete->BindParam(':dte_time', $date_h_com);
            $requete->BindParam(':montant_total', $mont_ht);
            $requete->execute();
            $id_fact2 = $bdd->lastInsertId();
            //LIGNE COMMANDE
            $requete = $bdd1->prepare("SELECT  * FROM lignes_commandes WHERE hotel_id=:id_hotel AND commande_id=:commande_id");
            $requete->BindParam(':id_hotel', $id_hotel);
            $requete->BindParam(':commande_id', $id_fact);
            $requete->execute();
            $result = $requete->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $op) {
                $repas = $op->repas;
                $quantite = $op->qte;
                $produit_id = $op->produit_id;
                $prix = $op->prix;
                $dte = $op->dte;
                $id_fact = $op->commande_id;
                $requete = $bdd->prepare("INSERT INTO  lignes_commandes (qte,prix,dte,commande_id,produit_id,hotel_id,repas,id_sousresto)
                                             VALUES(:qte,:prix,:dte,:commande_id,:produit_id,:hotel_id,:repas,:id_sousresto)");
                $requete->BindParam(':qte', $quantite);
                $requete->BindParam(':prix', $prix);
                $requete->BindParam(':dte', $dte);
                $requete->BindParam(':commande_id', $id_fact2);
                $requete->BindParam(':produit_id', $produit_id);
                $requete->BindParam(':hotel_id', $id_hotel);
                $requete->BindParam(':repas', $repas);
                $requete->BindParam(':id_sousresto', $id_sousresto);
                $requete->execute();
                echo'Ligne ok';
            }
            $requete = $bdd1->prepare("SELECT  * FROM t_reglement WHERE id_hotel=:id_hotel AND id_fact=:id_fact");
            $requete->BindParam(':id_hotel', $id_hotel);
            $requete->BindParam(':id_fact', $id_fact);
            $requete->execute();
            $result = $requete->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $op) {
                $regl_id = $op->id_regl;
                $numero = $op->numero;
                $id_fact = $op->id_fact;
                $date_h_com = $op->date_regl;
                $dte = $op->dte;
                $id_user = $op->id_user;
                $rejete = $op->rejete;
                $requete = $bdd->prepare("INSERT INTO  t_reglement (numero,id_fact,date_regl,dte,id_user,id_hotel,rejete)
          
                                 VALUES(:numero,:id_fact,:date_regl,:dte,:id_user,:id_hotel,:rejete)");

                $requete->BindParam(':numero', $numero);
                $requete->BindParam(':id_fact', $id_fact2);
                $requete->BindParam(':date_regl', $date_h_com);
                $requete->BindParam(':dte', $dte);
                $requete->BindParam(':id_user', $id_user);
                $requete->BindParam(':id_hotel', $id_hotel);
                $requete->BindParam(':rejete', $rejete);
                $requete->execute();
                $regl_id2 = $bdd->lastInsertId();
                echo'Reglement ok';
                //PAIEMENT
                $requete = $bdd1->prepare("SELECT  * FROM paiement WHERE site_id=:id_hotel AND regl_id=:regl_id");
                $requete->BindParam(':id_hotel', $id_hotel);
                $requete->BindParam(':regl_id', $regl_id);
                $requete->execute();
                $result = $requete->fetchAll(PDO::FETCH_OBJ);
                $boolpaie = TRUE;
                foreach ($result as $op) {
                    $montantsaisi = $op->montant;
                    $montantusd = $op->montantusd;
                    $montantcdf = $op->montantcdf;
                    $rendu = $op->rendu;
                    $taux_op = $op->taux;
                    $montant_remise = $op->remise;
                    $justification = $op->justification;
                    $rendu_usd = 0;
                    $rendu_cdf = 0;
                    $mode = $op->id_mode_regl;
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
                    $requete->BindParam(':regl_id', $regl_id2);
                    $requete->BindParam(':id_hotel', $id_hotel);
                    $requete->BindParam(':company_id', $company_id);
                    $requete->BindParam(':rendu_usd', $rendu_usd);
                    $requete->BindParam(':rendu_cdf', $rendu_cdf);
                    $requete->BindParam(':id_sousresto', $id_sousresto);
					$requete->BindParam(':resch_id', $res_ch_id);
                    $requete->execute();
                    echo'Paiement ok';
                    if ($boolpaie) {
                        $modefact = $mode;
                        $lib = '';
                        if ($modefact == 3) {
                            $lib = 'Credit';
                        } elseif ($modefact == 2) {
                            $lib = 'Cash';
                        } elseif ($modefact == 1) {
                            $lib = 'Don';
                        }
                        $requete = $bdd->prepare("UPDATE t_facture  SET mode=:mode WHERE id_fact=:id_fact");
                        $requete->BindParam(':mode', $lib);
                        $requete->BindParam(':id_fact', $id_fact2);
                        $requete->execute();
                        $boolpaie = FALSE;
                        echo'Maj mode ok';
                    }
                }
//FIN PAIEMENT
            }
        }
    }
}

























    