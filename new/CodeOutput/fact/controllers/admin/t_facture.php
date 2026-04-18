
<?php

/*
 * =======================================================================
 * FILE NAME:        t_facture.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_facture
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/t_facture.php');
include_once(APP_FOLDER . '/models/objects/t_client.php');
include_once(APP_FOLDER . '/models/objects/facconditionpaie.php');
include_once(APP_FOLDER . '/models/objects/t_hotel.php');
include_once(APP_FOLDER . '/models/objects/stk_produit.php');
include_once(APP_FOLDER . '/models/objects/Panier.php');
include_once(APP_FOLDER . '/models/objects/compteur.php');
include_once(APP_FOLDER . '/models/objects/lignes_commandes.php');
include_once(APP_FOLDER . '/models/objects/t_mode_reglement.php');

class t_facture_controller
{

    public $t_facture_model;

    public function __construct()
    {
        $this->t_facture_model = new t_facture_model();
    }

    public function invoke_t_facture()
    {
        $clientobj = new t_client_model();
        $condpaiementobj = new facconditionpaie_model();
        $ot_mode_reglement = new t_mode_reglement_model();
        $siteobj = new t_hotel_model();
        $produitobj = new stk_produit_model();
        $panier = new Panier();
        $compteurobj = new compteur_model();
        $lignes_commandesobj = new lignes_commandes_model();
        $json = array();
        $json['s'] = False;
        $json['message'] = '';
        $json['tva'] = 0;
        $json['ht'] = 0;
        $json['ttc'] = 0;
        $idsite = $_SESSION['idsite'];
        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall') {
            $f = get('f');
            $libellefact = 'Liste des factures normales';
            if ($f == '0') {
                $libellefact = 'Liste des factures proforma';
            }
            $type = 'facturation';
            $dte1 = date('Y-m-d');
            $dte2 = date('Y-m-d');
            $result = $this->t_facture_model->All($_SESSION['idsite'], $type, $dte1, $dte2);
            $montantFactures = totalMontantPayeFactureAll();
            include(APP_FOLDER . '/views/admin/t_facture/View.php');
        }

        if (get('do') == 'recurente') {
            $bdd = HDB::hus();
            $f = get('f');
            $libellefact = 'Liste des factures recurentes';
            $type = 'facturation';
            $dte1 = date('Y-m-d');
            $dte2 = date('Y-m-d');
            //            $a="ppp";
            $result = $this->t_facture_model->AllrecurenteInsert($_SESSION['idsite'], $type, $bdd);
            //            $result = $this->t_facture_model->Allrecurente($_SESSION['idsite'],$type,$dte1,$dte2);
            $montantFactures = totalMontantPayeFactureAllrec($bdd);
            foreach ($result as $rows) {
                $date_recurente = $rows->date_echeance_old;
                $id_hotel = $rows->id_hotel;
                $verif = VerifFactGen($date_recurente, $type, $id_hotel, $bdd);
                if ($verif == 0) {
                    if (date('Y-m-d') == $date_recurente) {
                        //                        $a="pp123p";
                        /* Insertion dans t_facture */
                        $etat = 1;
                        $libcptfact = NUMFACT;
                        $num_cmd = $compteurobj->getnumerotationrec($id_hotel, $libcptfact, $bdd);
                        $num_cmd_format = format_numero($num_cmd);
                        $prefixefact = "FAC/";
                        $numfact = $prefixefact . $num_cmd_format;
                        $id_client = $rows->id_client;
                        $dte_edit = date('Y-m-d');
                        $dte_ech = date('Y-m-d');
                        //Facture recurente
                        $fact_recurente = 1;

                        $nbrejour = $rows->etat_sousresto;
                        //Generation de la date par rapport au nbre de jour
                        $dategeneration = strtotime($date_recurente);
                        $dte_genfact = date('Y-m-d', strtotime('+' . $nbrejour . 'days', $dategeneration));

                        $type = 'facturation';
                        $taux = $rows->taux;
                        $tva = $rows->tva;
                        $monnaie = $rows->monnaie;
                        $mont_ttc = $rows->mont_ttc;
                        $mont_ttc_remise = $rows->mont_ttc_remise;
                        $remise = $majoration = 0;
                        $mont_tva = $rows->mont_tva;
                        $justification = $rows->justification;
                        $company_id = $rows->company_id;
                        $id_user = $rows->id_user;
                        $monttotal_ht = $rows->montant_total;
                        $mode = $rows->montant_total;

                        $this->t_facture_model->InsertFactrecurente($numfact, $type, $etat, $fact_recurente, $nbrejour, $dte_genfact, $dte_edit, $dte_ech, $monttotal_ht, $mont_tva, $mont_ttc, $mont_ttc_remise, $taux, $tva, $monnaie, $remise, $majoration, $justification, $id_hotel, $company_id, $id_user, $id_client, $mode, $bdd);

                        //MAJ NUMEROTATION COMPTEUR
                        $num_cmd += 1;
                        $compteurobj->Update($libcptfact, $num_cmd, $id_hotel);
                        $result = $this->t_facture_model->Allrecurente($_SESSION['idsite'], $type, $dte1, $dte2, $bdd);
                        $montantFactures = totalMontantPayeFactureAllrec($bdd);
                    } else {
                        $result = $this->t_facture_model->Allrecurente($_SESSION['idsite'], $type, $dte1, $dte2, $bdd);
                        $montantFactures = totalMontantPayeFactureAllrec($bdd);
                    }
                }
            }
            include(APP_FOLDER . '/views/admin/t_facture/Recurentes.php');
            //            $json['s'] =TRUE;
            //            echo json_encode($json);

        }

        if (get('do') == 'recurenteaff') {
            //            $bdd = HDB::hus();
            $f = get('f');
            $libellefact = 'Liste des factures recurentes';
            $type = 'facturation';
            $dte1 = date('Y-m-d');
            $dte2 = date('Y-m-d');
            $result = $this->t_facture_model->Allrecurente($_SESSION['idsite'], $type, $dte1, $dte2);
            $montantFactures = totalMontantPayeFactureAll();

            include(APP_FOLDER . '/views/admin/t_facture/Recurentes.php');
        }



        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            $result = $this->t_facture_model->SelectAll();
            include(APP_FOLDER . '/views/admin/t_facture/Export.php');
        }
        //Filtrage liste des factures
        elseif (get('do') == 'allbydte') {
            $f = post('f');
            $libellefact = 'Liste des factures normales';
            if ($f == '0') {
                $libellefact = 'Liste des factures proforma';
            }
            $type = 'facturation';
            $dte1 = dateToformatBdd(post('datedebut'));
            $dte2 = dateToformatBdd(post('datefin'));
            $_SESSION['datedebut_fact'] = post('datedebut');
            $_SESSION['datefin_fact'] = post('datefin');
            $result = $this->t_facture_model->All($_SESSION['idsite'], $type, $dte1, $dte2);
            $montantFactures = totalMontantPayeFactureAll();
            include(APP_FOLDER . '/views/admin/t_facture/datalignesfact.php');
        } elseif (get('do') == 'allbydte5') {
            $f = post('f');
            $libellefact = 'Liste des factures normales';
            if ($f == '0') {
                $libellefact = 'Liste des factures proforma';
            }
            $type = 'facturation';
            $dte1 = dateToformatBdd(post('datedebut'));
            $dte2 = dateToformatBdd(post('datefin'));
            $_SESSION['datedebut_fact'] = post('datedebut');
            $_SESSION['datefin_fact'] = post('datefin');
            $result = $this->t_facture_model->All($_SESSION['idsite'], $type, $dte1, $dte2);
            $montantFactures = totalMontantPayeFactureAll();
            include(APP_FOLDER . '/views/admin/t_facture/datalignesfactall.php');
        } elseif (get('do') == 'allbydte1') {
            $f = post('f');
            $libellefact = 'Liste des factures normales';
            if ($f == '0') {
                $libellefact = 'Liste des factures proforma';
            }
            $type = 'facturation';
            $dte1 = dateToformatBdd(post('datedebut'));
            $dte2 = dateToformatBdd(post('datefin'));
            $_SESSION['datedebut_fact'] = post('datedebut');
            $_SESSION['datefin_fact'] = post('datefin');
            $result = $this->t_facture_model->All($_SESSION['idsite'], $type, $dte1, $dte2);
            $montantFactures = totalMontantPayeFactureAll();
            include(APP_FOLDER . '/views/admin/t_facture/datalignesfactacredit.php');
        } elseif (get('do') == 'allbydte2') {
            $f = post('f');
            $libellefact = 'Liste des factures normales';
            if ($f == '0') {
                $libellefact = 'Liste des factures proforma';
            }
            $type = 'facturation';
            $dte1 = dateToformatBdd(post('datedebut'));
            $dte2 = dateToformatBdd(post('datefin'));
            $_SESSION['datedebut_fact'] = post('datedebut');
            $_SESSION['datefin_fact'] = post('datefin');
            $result = $this->t_facture_model->All($_SESSION['idsite'], $type, $dte1, $dte2);
            $montantFactures = totalMontantPayeFactureAll();
            include(APP_FOLDER . '/views/admin/t_facture/datalignesfactacompte.php');
        } elseif (get('do') == 'allbydte3') {
            $f = post('f');
            $libellefact = 'Liste des factures normales';
            if ($f == '0') {
                $libellefact = 'Liste des factures proforma';
            }
            $type = 'facturation';
            $dte1 = dateToformatBdd(post('datedebut'));
            $dte2 = dateToformatBdd(post('datefin'));
            $_SESSION['datedebut_fact'] = post('datedebut');
            $_SESSION['datefin_fact'] = post('datefin');
            $result = $this->t_facture_model->Allrecurente($_SESSION['idsite'], $type, $dte1, $dte2);
            $montantFactures = totalMontantPayeFactureAll();
            include(APP_FOLDER . '/views/admin/t_facture/datalignesfact_recurente.php');
        } elseif (get('do') == 'allbydte3') {
            $f = post('f');
            $libellefact = 'Liste des factures normales';
            if ($f == '0') {
                $libellefact = 'Liste des factures proforma';
            }
            $type = 'facturation';
            $dte1 = dateToformatBdd(post('datedebut'));
            $dte2 = dateToformatBdd(post('datefin'));
            $_SESSION['datedebut_fact'] = post('datedebut');
            $_SESSION['datefin_fact'] = post('datefin');
            $result = $this->t_facture_model->Allrecurente($_SESSION['idsite'], $type, $dte1, $dte2);
            $montantFactures = totalMontantPayeFactureAll();
            include(APP_FOLDER . '/views/admin/t_facture/datalignesfact_recurente.php');
        } elseif (get('do') == 'allbydte4') {

            $f = post('f');
            $libellefact = 'Liste des factures normales';
            if ($f == '0') {
                $libellefact = 'Liste des factures proforma';
            }

            $type = 'facturation';
            $dte1 = dateToformatBdd(post('datedebut'));
            $dte2 = dateToformatBdd(post('datefin'));
            $_SESSION['datedebut_fact'] = post('datedebut');
            $_SESSION['datefin_fact'] = post('datefin');
            $result = $this->t_facture_model->All($_SESSION['idsite'], $type, $dte1, $dte2);
            $montantFactures = totalMontantPayeFactureAll();
            include(APP_FOLDER . '/views/admin/t_facture/datalignesfact_proformat.php');
        }
        //Calcul de la date d'echeance
        elseif (get('do') == 'verifcond') {
            $dte_edition = get('dte_edition');
            $nbrjr = get('nbrjr');
            $dte_ech = CalculDateEcheance($dte_edition, $nbrjr);
            $json['message'] = dateAffiche($dte_ech);
            $json['s'] = True;
            echo json_encode($json);
        }
        //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->t_facture_model->SelectOne(get('id_fact'));
            include(APP_FOLDER . '/views/admin/t_facture/Export2.php');
        }
        //SEARCH SUGGEST ////////////////////////////////////////////////////	
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->t_facture_model->AutoSearch(trim($qstring), 10, 'num_fact');
                echo ' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=t_facture&id_fact=' . $srow->id_fact . '&do=details"><li class="list-group-item">' . $srow->num_fact . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        }


        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            $etatfact = get('f');
            if ($etatfact == 1) {
                $typefact = 'normale';
                $libcptfact = NUMFACT;
            } else {
                $typefact = 'proforma';
                $libcptfact = NUMPROFORMA;
            }
            $idsite = $_SESSION['idsite'];
            $sousresto_id = 123;
            $panier->initialiser();
            $clients = $clientobj->SelectAll($idsite);
            $condpaiements = $condpaiementobj->SelectAll($idsite);
            $result2 = $ot_mode_reglement->SelectAllMode();
            $site = $siteobj->Infos2($idsite);
            $articles = ProdAndServ($sousresto_id, $idsite);
            $num_cmd = $compteurobj->getnumerotation($idsite, $libcptfact);
            $num_cmd_format = format_numero($num_cmd);
            $prefixefact = $_SESSION['prefconge'];
            $numfact = $prefixefact . $num_cmd_format;
            //            $ville_hotel=$site->ville_hotel;
            //            $logo=$site->logo;
            //            $adresse_c=$site->adrcomp;
            //            $email_compagny=$site->mail_company;
            //            $telephone=$site->phone;
            //            $idnat=$site->idnat;
            //            $rccm=$site->rccm;
            //var_dump($articles);
            include(APP_FOLDER . '/views/admin/t_facture/Add.php');
        } elseif (get('do') == 'addpan') {
            // Ajouter produit dans le panier 
            //$depot_id=get('source_id');
            $select['id'] = get('idprod');
            $select['qte'] = get('qte');
            $select['nom'] = trim(get('nameprod'));
            $select['prix'] = arrondir(get('prix'));
            $tva = get('tva');
            $select['monttva'] = CalculMontTva($select['prix'], $tva);
            //$op=get('op');
            if (IsNombre($select['qte'])) {
                //$qtedispo=GetProdQteDispoByDepot($select['id'],$depot_id);
                //if ($select['qte'] <= $qtedispo){
                //$select['unite'] = get('unite');
                $panier->ajouterFact($select);
                $ttc = $panier->montant_panier();
                $mont_tva = $panier->montant_panier_tva();
                $totmont_prodtva = $panier->total_montantprod_panier_tva();
                $ht = $ttc - $mont_tva;
                $json['tva'] = $panier->montant_panier_tva();
                $json['totprodtva'] = $totmont_prodtva;
                $json['ht'] = $ht;
                $json['ttc'] = $ttc;
                $json['tvaf'] = afficheMontant($_SESSION['Paie_affiche'], $mont_tva);
                $json['htf'] = afficheMontant($_SESSION['Paie_affiche'], $ht);
                $json['ttcf'] = afficheMontant($_SESSION['Paie_affiche'], $ttc);
                $json['s'] = TRUE;
                //}else{
                // $json['message'] = 'La quantité saisie de ce produit dans la source doit être inferieure ou égale à ' . $qtedispo;
                //} 
            } else {
                $json['s'] = FALSE;
                $json['message'] = 'La quantité saisie doit être un nombre positif';
            }
            echo json_encode($json);
        } elseif (get('do') == 'modifqte') {
            //Modification qte produit  panier 
            $select['id'] = get('idprod');
            $select['qte'] = get('qte');
            $panier->modifierQTeArticle($select);
            $nbArticles = count($_SESSION['panier']['id_article']);
            include(APP_FOLDER . '/views/admin/t_facture/lignesfact.php');
        } elseif (get('do') == 'modifprix') {
            //Modification prix produit  panier 
            $select['id'] = get('idprod');
            $select['prix'] = arrondir(get('prix'));
            $panier->modifierPrixArticle($select);
            $nbArticles = count($_SESSION['panier']['id_article']);
            include(APP_FOLDER . '/views/admin/t_facture/lignesfact.php');
        } elseif (get('do') == 'modiflib') {
            //Modification lib produit  panier 
            $select['id'] = get('idprod');
            $select['nom'] = get('lib');
            $panier->modifierLibArticle($select);
            $nbArticles = count($_SESSION['panier']['id_article']);
            include(APP_FOLDER . '/views/admin/t_facture/lignesfact.php');
        } elseif (get('do') == 'majtot') {
            //MAJ de totaux de la facture  
            $ttc = $panier->montant_panier();
            $mont_tva = $panier->montant_panier_tva();
            $ht = $ttc - $mont_tva;
            $json['tva'] = $panier->montant_panier_tva();
            $json['ht'] = $ht;
            $json['ttc'] = $ttc;
            $json['tvaf'] = afficheMontant($_SESSION['Paie_affiche'], $mont_tva);
            $json['htf'] = afficheMontant($_SESSION['Paie_affiche'], $ht);
            $json['ttcf'] = afficheMontant($_SESSION['Paie_affiche'], $ttc);
            $json['s'] = TRUE;
            echo json_encode($json);
        } elseif (get('do') == 'majremise') {
            //MAJ de totaux de la facture  
            $remise_mont = get('remise_mont');
            $ttc = $panier->montant_panier() - $remise_mont;
            $mont_tva = $panier->montant_panier_tva();
            $ht = $ttc - $mont_tva + $remise_mont;
            $remise_pour = ($remise_mont * 100) / $ht;
            $json['ttc'] = $ttc;
            $json['remise_pour'] = arrondir($remise_pour);
            $json['remise_mont'] = arrondir($remise_mont);
            $json['ttcf'] = afficheMontant($_SESSION['Paie_affiche'], $ttc);
            $json['s'] = TRUE;
            echo json_encode($json);
        } elseif (get('do') == 'supprodpan') {
            // Supprimer produit dans le panier           
            $select['id'] = get('idprod');
            $panier->delete_articleFact($select);
            $nbArticles = count($_SESSION['panier']['id_article']);
            //            if($nbArticles>=1){
            include(APP_FOLDER . '/views/admin/t_facture/lignesfact.php');
            //            }
        } elseif (get('do') == 'majlistprodstk') {
            // Liste produit stock panier          
            $nbArticles = count($_SESSION['panier']['id_article']);
            if ($nbArticles >= 1) {
                include(APP_FOLDER . '/views/admin/t_facture/lignesfact.php');
            }
        }
        //ENREGISTRER FACTURE FACTURATION //////////////////////////////////////////////////
        elseif (get('do') == 'enregfact') {
            $bdd = HDB::hus();
            $_SESSION['datas_exist'] = 0;
            $_SESSION['montant_total'] = 0;
            $_SESSION['montant_paye'] = 0;
            $_SESSION['montant_a_paye'] = 0;
            if (post('id_client') < 0 || (post('ttc') == 0)) {
                $json['message'] = 'Veuillez completer les informations de la facture svp!';
                $json['s'] = FALSE;
            } else {
                $id_hotel = post('id_hotel');
                //Numerotation facture
                $etat = post('etatfact');
                if ($etat == '0') {
                    $libcptfact = NUMPROFORMA;
                    $fact_recurente = 0;
                } else {
                    $libcptfact = NUMFACT;
                    //Facture recurente
                    $fact_recurente = 0;
                }
                $num_cmd = $compteurobj->getnumerotation($id_hotel, $libcptfact);
                $num_cmd_format = format_numero($num_cmd);
                $prefixefact = post('prefixefact');
                $numfact = $prefixefact . $num_cmd_format;
                $id_client = post('id_client');
                $dte_edit = dateToformatBdd(post('dte_edit'));
                $dte_ech = dateToformatBdd(post('dte_ech'));
                //Facture recurente
                //$fact_recurente =post('fact_recurente');
                if ($fact_recurente == 0) {
                    $nbrejour = 0;
                    $dte_genfact = $dte_edit;
                } else {
                    $nbrejour = post('nbrejr');
                    //Generation de la date par rapport au nbre de jour
                    $dategeneration = strtotime($dte_edit);
                    $dte_genfact = date('Y-m-d', strtotime('+' . $nbrejour . 'days', $dategeneration));
                }
                $type = 'facturation';
                $taux = $_SESSION['Paie_taux'];
                $tva = $_SESSION['tva'];
                $monnaie = 'CDF';
                $montant_fact = montant_equivalent_bdd($_SESSION['Paie_affiche'], $monnaie, $taux, post('ttc'));
                $remise = $majoration = 0;
                $mont_tva = montant_equivalent_bdd($_SESSION['Paie_affiche'], $monnaie, $taux, post('tva'));
                $justification = post('description');
                $company_id = $_SESSION['company_id'];
                $id_user = $_SESSION['id_user'];

                $nbArticles = count($_SESSION['panier']['id_article']);
                $totfacttva = $panier->tot_fact_tva();
                $monttotal_ht = montant_equivalent_bdd($_SESSION['Paie_affiche'], $monnaie, $taux, $totfacttva);
                //CAS DE NOUVEAU CLIENT
                if ($id_client == '0') {
                    $id_client = $clientobj->InsertFacturation(post('nomclt'), post('nomsct'), post('sexeclt'), post('adr'), post('eml'), post('tel'), post('typeclt'), post('id_hotel'), post('compte2'));
                    $numberincre = $_SESSION['numberincreaccountnumber'];
                    $numberincre += 1;
                    $libelle = "compteclient";
                    setnumerotation($_SESSION['id_hotel'], $libelle, $numberincre, $bdd);
                }
                $mode = post('modepaiement');
                $compte1 = post('compte1');
                $compte2 = post('compte2');
                $nom_client = post('customer');
                $remise_pour = post('remise_pour');
                $remise_mont = montant_equivalent_bdd($_SESSION['Paie_affiche'], $monnaie, $taux, post('remise_mont2'));
                $facture_id = $this->t_facture_model->InsertFact(post('numfact'), $type, $etat, $fact_recurente, $nbrejour, $dte_genfact, $dte_edit, $dte_ech, $monttotal_ht, $mont_tva, $remise_mont, $montant_fact, $taux, $tva, $monnaie, $remise_pour, $majoration, $justification, $id_hotel, $company_id, $id_user, $id_client, $mode, $compte1, $compte2);
                //INSERT LIGNES FACTURE
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                    $quantite = $_SESSION['panier']['qte'][$i];
                    $produit_id = $_SESSION['panier']['id_article'][$i];
                    $prix = $_SESSION['panier']['prix'][$i];
                    $mont_tva = $_SESSION['panier']['monttva'][$i];
                    $lib = $_SESSION['panier']['nom'][$i];
                    $lignes_commandesobj->InsertFact($quantite, $prix, $mont_tva, $facture_id, $produit_id, $id_hotel, $lib);
                }
                //MAJ NUMEROTATION COMPTEUR
                $num_cmd += 1;
                $compteurobj->Update($libcptfact, $num_cmd, $id_hotel);
                $panier->initialiser();
                //COMPTA
                // $module_id = 23;
                // $site_id = $_SESSION['id_hotel'];
                // ConfLinkMod($module_id, $site_id, $bdd);
                // if ($_SESSION['ConfLinkMod_lie'] == 1) {
                //     $mont_ttc = post('ttc');
                //     $tva = $_SESSION['tva'];
                //     $lib_mode = $mode;
                //     $numero = $numfact;
                //     $montantusd = $mont_ttc;
                //     $montantcdf = 0;
                //     $montantsaisi = $mont_ttc;
                //     $m_affiche = $_SESSION['Paie_affiche'];
                //     $taux_op = $taux;
                //     $account = $compte1 . $compte2;
                //     CreateAcountForCustomer($compte1, $compte2, $account, $nom_client, $site_id, $bdd);
                //     $reference = $numero;
                //     $montantusd = $montantusd;
                //     $montantcdf = $montantcdf;
                //     $montantsaisi = $montantsaisi;
                //     $devise = $m_affiche;
                //     $tauxop = $taux_op;
                //     $libelle = '';
                //     $beneficiaire = $nom_client;
                //     $site_id = $_SESSION['id_hotel'];
                //     $user_id = $_SESSION['id_user'];
                //     $ttc = $mont_ttc;
                //     $type_rendu = 'oui';
                //     $dte = date('Y-m-d');
                //     $dtetime = date('Y-m-d H:i:s');
                //     $mont_tva = ($ttc * $tva) / 100;
                //     $ht = $ttc - $mont_tva;
                //     //echo "lib_mode  " . $lib_mode;
                //     // echo "ttc  " . $ttc;
                //     // echo "montantusd  " . $montantusd;
                //     // echo "montantcdf  " . $montantcdf;
                //     // echo "devise  " . $devise;

                //     if ($lib_mode == 'Cash') {
                //         COMPTA_VENTE_CASH_RESTO($type_rendu, $reference, $dte, $dtetime, $montantusd, $montantcdf, $montantsaisi, $ht, $tva, $ttc, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd);
                //     } elseif ($lib_mode == 'Credit') {
                //         COMPTA_VENTE_CREDIT_RESTO($type_rendu, $reference, $dte, $dtetime, $montantusd, $montantcdf, $montantsaisi, $ht, $tva, $ttc, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd);
                //         if ($montantusd > 0 || $montantcdf > 0) {
                //             COMPTA_PAIE_RESTO($reference, $montantusd, $montantcdf, $montantsaisi, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd, $ttc);
                //         }
                //     }
                //     // elseif ($lib_mode == 'Don') {
                //     //ici on mettra la fonction compta pour le mode Don  
                //     // }

                // }

                //COMPTA
                $json['facture_id'] = $facture_id;
                $json['mode_paie'] = $mode;
                $json['message'] = "Cette facture vient d'être enregistrée avec succès!";
                $json['s'] = TRUE;
            }
            echo json_encode($json);
        }
        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            if ($_POST) {
                //form validation
                if (post('num_fact') == '') {
                    json_error('The field num fact cannot be empty!');
                } elseif (post('type') == '') {
                    json_error('The field type cannot be empty!');
                } elseif (post('i_souscription') == '') {
                    json_error('The field i souscription cannot be empty!');
                } elseif (post('etat') == '') {
                    json_error('The field etat cannot be empty!');
                } elseif (post('etat_cmd') == '') {
                    json_error('The field etat cmd cannot be empty!');
                } elseif (post('date_echeance_old') == '') {
                    json_error('The field date echeance old cannot be empty!');
                } elseif (post('date_edition') == '') {
                    json_error('The field date edition cannot be empty!');
                } elseif (post('dte_blocage') == '') {
                    json_error('The field dte blocage cannot be empty!');
                } elseif (post('date_echeance') == '') {
                    json_error('The field date echeance cannot be empty!');
                } elseif (post('date_desactivation') == '') {
                    json_error('The field date desactivation cannot be empty!');
                } elseif (post('montant_total') == '') {
                    json_error('The field montant total cannot be empty!');
                } elseif (post('mont_tva') == '') {
                    json_error('The field mont tva cannot be empty!');
                } elseif (post('mont_ttc') == '') {
                    json_error('The field mont ttc cannot be empty!');
                } elseif (post('mont_ttc_remise') == '') {
                    json_error('The field mont ttc remise cannot be empty!');
                } elseif (post('taux') == '') {
                    json_error('The field taux cannot be empty!');
                } elseif (post('taux_prix') == '') {
                    json_error('The field taux prix cannot be empty!');
                } elseif (post('tva') == '') {
                    json_error('The field tva cannot be empty!');
                } elseif (post('monnaie') == '') {
                    json_error('The field monnaie cannot be empty!');
                } elseif (post('remise') == '') {
                    json_error('The field remise cannot be empty!');
                } elseif (post('majoration') == '') {
                    json_error('The field majoration cannot be empty!');
                } elseif (post('justification') == '') {
                    json_error('The field justification cannot be empty!');
                } elseif (post('id_res') == '') {
                    json_error('The field id res cannot be empty!');
                } elseif (post('res_ch_id') == '') {
                    json_error('The field res ch id cannot be empty!');
                } elseif (post('modulecompagny') == '') {
                    json_error('The field modulecompagny cannot be empty!');
                } elseif (post('id_hotel') == '') {
                    json_error('The field id hotel cannot be empty!');
                } elseif (post('company_id') == '') {
                    json_error('The field company id cannot be empty!');
                } elseif (post('id_user') == '') {
                    json_error('The field id user cannot be empty!');
                } elseif (post('id_client') == '') {
                    json_error('The field id client cannot be empty!');
                } elseif (post('fact1') == '') {
                    json_error('The field fact1 cannot be empty!');
                } else {
                    $this->t_facture_model->Insert(post('num_fact'), post('type'), post('i_souscription'), post('etat'), post('etat_cmd'), post('date_echeance_old'), post('date_edition'), post('dte_blocage'), post('date_echeance'), post('date_desactivation'), post('montant_total'), post('mont_tva'), post('mont_ttc'), post('mont_ttc_remise'), post('taux'), post('taux_prix'), post('tva'), post('monnaie'), post('remise'), post('majoration'), post('justification'), post('id_res'), post('res_ch_id'), post('modulecompagny'), post('id_hotel'), post('company_id'), post('id_user'), post('id_client'), post('fact1'));
                    json_send('' . H_ADMIN . '&view=t_facture&do=viewall&msg=add');
                    json_success('Process Completed');
                }
            }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $rows = $this->t_facture_model->SelectOne(get('id_fact'));
            include(APP_FOLDER . '/views/admin/t_facture/Update.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('id_fact') == '') {
                    json_error('The field id_fact cannot be empty!');
                } elseif (post('num_fact') == '') {
                    json_error('The field num fact cannot be empty!');
                } elseif (post('type') == '') {
                    json_error('The field type cannot be empty!');
                } elseif (post('i_souscription') == '') {
                    json_error('The field i souscription cannot be empty!');
                } elseif (post('etat') == '') {
                    json_error('The field etat cannot be empty!');
                } elseif (post('etat_cmd') == '') {
                    json_error('The field etat cmd cannot be empty!');
                } elseif (post('date_echeance_old') == '') {
                    json_error('The field date echeance old cannot be empty!');
                } elseif (post('date_edition') == '') {
                    json_error('The field date edition cannot be empty!');
                } elseif (post('dte_blocage') == '') {
                    json_error('The field dte blocage cannot be empty!');
                } elseif (post('date_echeance') == '') {
                    json_error('The field date echeance cannot be empty!');
                } elseif (post('date_desactivation') == '') {
                    json_error('The field date desactivation cannot be empty!');
                } elseif (post('montant_total') == '') {
                    json_error('The field montant total cannot be empty!');
                } elseif (post('mont_tva') == '') {
                    json_error('The field mont tva cannot be empty!');
                } elseif (post('mont_ttc') == '') {
                    json_error('The field mont ttc cannot be empty!');
                } elseif (post('mont_ttc_remise') == '') {
                    json_error('The field mont ttc remise cannot be empty!');
                } elseif (post('taux') == '') {
                    json_error('The field taux cannot be empty!');
                } elseif (post('taux_prix') == '') {
                    json_error('The field taux prix cannot be empty!');
                } elseif (post('tva') == '') {
                    json_error('The field tva cannot be empty!');
                } elseif (post('monnaie') == '') {
                    json_error('The field monnaie cannot be empty!');
                } elseif (post('remise') == '') {
                    json_error('The field remise cannot be empty!');
                } elseif (post('majoration') == '') {
                    json_error('The field majoration cannot be empty!');
                } elseif (post('justification') == '') {
                    json_error('The field justification cannot be empty!');
                } elseif (post('id_res') == '') {
                    json_error('The field id res cannot be empty!');
                } elseif (post('res_ch_id') == '') {
                    json_error('The field res ch id cannot be empty!');
                } elseif (post('modulecompagny') == '') {
                    json_error('The field modulecompagny cannot be empty!');
                } elseif (post('id_hotel') == '') {
                    json_error('The field id hotel cannot be empty!');
                } elseif (post('company_id') == '') {
                    json_error('The field company id cannot be empty!');
                } elseif (post('id_user') == '') {
                    json_error('The field id user cannot be empty!');
                } elseif (post('id_client') == '') {
                    json_error('The field id client cannot be empty!');
                } elseif (post('fact1') == '') {
                    json_error('The field fact1 cannot be empty!');
                } else {
                    $this->t_facture_model->Update(post('num_fact'), post('type'), post('i_souscription'), post('etat'), post('etat_cmd'), post('date_echeance_old'), post('date_edition'), post('dte_blocage'), post('date_echeance'), post('date_desactivation'), post('montant_total'), post('mont_tva'), post('mont_ttc'), post('mont_ttc_remise'), post('taux'), post('taux_prix'), post('tva'), post('monnaie'), post('remise'), post('majoration'), post('justification'), post('id_res'), post('res_ch_id'), post('modulecompagny'), post('id_hotel'), post('company_id'), post('id_user'), post('id_client'), post('fact1'), post('id_fact'));
                    json_send('' . H_ADMIN . '&view=t_facture&id_fact=' . post('id_fact') . '&do=details&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $idsite = $_SESSION['idsite'];
            $id_fact = get('id_fact');
            $modepaie = get('mode');

            if (isset($_GET['msg'])) {
                $msg = 1;
            } else {
                $msg = 0;
            }

            $rows = $this->t_facture_model->SelectOne($id_fact);

            $nomcl = $rows->nom_client;
            $societe = $rows->designation;
            $emailcl = $rows->email_client;
            $tel = $rows->telephone_client;
            $adr = $rows->adresse_provenance_client;
            $numfact = $rows->num_fact;
            $mode = $rows->mode;
            $dte_edit = dateAffiche($rows->date_edition);
            $etatfact = $rows->etat;
            if ($etatfact == '1') {
                $typefact = 'normale';
            } else {
                $typefact = 'proforma';
            }
            $dte_ech = dateAffiche($rows->date_echeance);
            $justification = $rows->justification;
            $ht = $rows->montant_total;
            $monttvax = $rows->mont_tva;
            $ttc = $rows->mont_ttc_remise;
            $remise = $rows->remise;
            $montremise = $rows->mont_ttc;
            $monnaie_fact = $rows->monnaie;
            $taux = getTauxFacture2($monnaie_fact, $_SESSION['Paie_taux'], $rows->taux);
            $ht = montant_equivalent_bdd($monnaie_fact, $_SESSION['Paie_affiche'], $taux, $ht);
            $monttvax = montant_equivalent_bdd($monnaie_fact, $_SESSION['Paie_affiche'], $taux, $monttvax);
            $ttc = montant_equivalent_bdd($monnaie_fact, $_SESSION['Paie_affiche'], $taux, $ttc);
            $montremise = montant_equivalent_bdd($monnaie_fact, $_SESSION['Paie_affiche'], $taux, $montremise);
            $panier->initialiser();
            $site = $siteobj->Infos2($idsite);
            $logo = $site->logo;
            $mail = $site->mail;
            $phone = $site->phone;
            $adrcomp = $site->adrcomp;
            $nomcomp = $site->nomcomp;
            $idnat = $site->idnat;
            $rccm = $site->rccm;
            $result = $this->t_facture_model->lignesAllBySite($id_fact);
            foreach ($result as $rows) {
                $select['id'] = $rows->produit_id;
                $select['qte'] = $rows->qte;
                $select['nom'] = $rows->designation;
                $select['prix'] = $rows->prix;
                $select['monttva'] = $rows->mont_tva;
                $panier->ajouterFact($select);
            }
            $nbArticles = count($_SESSION['panier']['id_article']);


            $dte = date('Y-m-d');
            $sql = "SELECT a.id_fact,a.num_fact,b.id_regl,b.numero,b.dte,c.montant,c.montantusd,c.montantcdf,c.taux,d.id_mode_regl,d.lib,e.id_client,e.nom_client
         FROM t_facture AS a, t_reglement AS b, paiement AS c,t_mode_reglement AS d, t_client AS e
         WHERE  a.id_fact=b.id_fact
               AND b.id_regl=c.regl_id
               AND c.id_mode_regl=d.id_mode_regl
               AND e.id_client=a.id_client
               AND a.type='facturation'
               AND b.dte=:dte AND a.id_fact=:id_fact
               AND a.id_hotel=:id_hotel
               ORDER BY e.nom_client,a.num_fact,b.numero ASC";
            $requete = HDB::hus()->prepare($sql);
            $requete->BindParam(':dte', $dte);
            $requete->BindParam(':id_fact', $id_fact);
            $requete->BindParam(':id_hotel', $_SESSION['idsite']);
            $requete->execute();
            $resultpaie = $requete->fetchAll(PDO::FETCH_OBJ);
            $cash1 = 0;
            $credit1 = 0;
            $acompte1 = 0;
            foreach ($resultpaie as $rows) {
                $montant = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $rows->taux, $rows->montant);
                if ($rows->lib == 'Cash') {
                    $cash1 += $montant;
                } else if ($rows->lib == 'Credit') {
                    $credit1 += $montant;
                } else {
                    $acompte1 += $montant;
                }
            }
            $mont_paie = arrondir($cash1 + $credit1 + $acompte1);
            include(APP_FOLDER . '/views/admin/t_facture/Details.php');
        }

        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->t_facture_model->TruncateTable('' . H_ADMIN . '&view=t_facture&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/t_facture/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            $dfile = get('dfile');
            if (get('id_fact') and $dfile == '') {
                $del = $this->t_facture_model->Delete(get('id_fact'), '' . H_ADMIN . '&view=t_facture&do=viewall&msg=delete');
            } elseif (get('id_fact') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->t_facture_model->Delete(get('id_fact'), '' . H_ADMIN . '&view=t_facture&do=viewall&msg=delete');
            } elseif (get('id_fact') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=t_facture&id_fact=' . get('id_fact') . '&do=update&msg=delete');
            }
        } elseif (get('do') == 'exonerertva') {
            $panier->Exonerer_tva();
            $nbArticles = count($_SESSION['panier']['id_article']);
            include(APP_FOLDER . '/views/admin/t_facture/lignesfact.php');
        } elseif (get('do') == 'appliktva') {
            $panier->Appliquer_tva();
            $nbArticles = count($_SESSION['panier']['id_article']);
            include(APP_FOLDER . '/views/admin/t_facture/lignesfact.php');
        } elseif (get('do') == 'sendmail') {
            include './libraries/mpdf60/mpdf.php';
            include './libraries/PHPMailer/class.phpmailer.php';
            $idsite = $_SESSION['idsite'];
            $id_fact = get('id_fact');
            $rows = $this->t_facture_model->SelectOne($id_fact);

            $nomcl = $rows->nom_client;
            $societe = $rows->designation;
            $emailcl = $rows->email_client;
            $tel = $rows->telephone_client;
            $adr = $rows->adresse_provenance_client;
            $numfact = $rows->num_fact;
            $dte_edit = dateAffiche($rows->date_edition);
            $etatfact = $rows->etat;
            if ($etatfact == '1') {
                $typefact = 'normale';
            } else {
                $typefact = 'proforma';
            }

            $dte_ech = dateAffiche($rows->date_echeance);
            $justification = $rows->justification;
            $ht = $rows->montant_total;
            $monttvax = $rows->mont_tva;
            $ttc = $rows->mont_ttc_remise;
            $monnaie_fact = $rows->monnaie;
            //$taux=getTauxFacture2($monnaie_fact,$_SESSION['Paie_taux'],$rows->taux);
            $taux = 1600;
            $ht = montant_equivalent_bdd($monnaie_fact, $_SESSION['Paie_affiche'], $taux, $ht);
            $monttvax = montant_equivalent_bdd($monnaie_fact, $_SESSION['Paie_affiche'], $taux, $monttvax);
            $ttc = montant_equivalent_bdd($monnaie_fact, $_SESSION['Paie_affiche'], $taux, $ttc);
            $panier->initialiser();
            $site = $siteobj->Infos2($idsite);
            $logo = $site->logo;
            $mail = $site->mail;
            $phone = $site->phone;
            $adrcomp = $site->adrcomp;
            $nomcomp = $site->nomcomp;
            $idnat = $site->idnat;
            $rccm = $site->rccm;
            $result = $this->t_facture_model->lignesAllBySite($id_fact);
            foreach ($result as $rows) {
                $select['id'] = $rows->produit_id;
                $select['qte'] = $rows->qte;
                $select['nom'] = $rows->designation;
                $select['prix'] = $rows->prix;
                $select['monttva'] = $rows->mont_tva;
                $panier->ajouterFact($select);
            }
            $nbArticles = count($_SESSION['panier']['id_article']);
            include(APP_FOLDER . '/views/admin/impression/facturation_fact.php');
            $body = ob_get_clean();
            $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
            $mpdf = new mPDF('c', 'A4', '', '', 7, 7, 8, 5, 0, 0);
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->WriteHTML($body);
            $fichier = $mpdf->Output("Facture.pdf", "S");
            $mailobj = new PHPMailer();
            $bool = EmailSendFichier($_SESSION['nomexp'], $_SESSION['mailexp'], $nomcl, $emailcl, $_SESSION['sujetmail'], $_SESSION['msgmail'], $fichier, $mailobj);
            if ($bool) {
                $json['message'] = "Cette facture vient d'être envoyée avec succès!";
                //echo'ok';
            } else {
                $json['message'] = "Cette facture n'est pas envoyée!";
                //echo'no';
            }
            $json['s'] = TRUE;
            echo json_encode($json);
        } elseif (get('do') == 'ProcGenAccount') {
            $bdd = HDB::hus();
            $libelle = 'compteclient';
            $numberincre = getnumerotation($_SESSION['id_hotel'], $libelle, $bdd);
            $accountnumber = str_pad($numberincre, 4, "0", STR_PAD_LEFT);
            $_SESSION['numberincreaccountnumber'] = $numberincre;
            $_SESSION['accountnumber'] = $accountnumber;
            echo $accountnumber;
        }
    }

    //end invoke
}

//end class
?>
	