
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
include_once (APP_FOLDER . '/models/objects/t_client.php');
include_once (APP_FOLDER . '/models/objects/facconditionpaie.php');
include_once(APP_FOLDER . '/models/objects/t_hotel.php');
include_once(APP_FOLDER . '/models/objects/stk_produit.php');
include_once(APP_FOLDER . '/models/objects/Panier.php');
include_once(APP_FOLDER . '/models/objects/compteur.php');
include_once(APP_FOLDER . '/models/objects/lignes_commandes.php');

class t_facture_controller {

    public $t_facture_model;

    public function __construct() {
        $this->t_facture_model = new t_facture_model();
    }

    public function invoke_t_facture() {
        $clientobj = new t_client_model();
        $condpaiementobj = new facconditionpaie_model();
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
            $f=get('f');
            $libellefact='Liste des factures normales';
            if($f=='0'){
                $libellefact='Liste des factures proforma';
            }
            $type='facturation';
            $dte1=date('Y-m-d');
            $dte2=date('Y-m-d');
            $result = $this->t_facture_model->All($_SESSION['idsite'],$type,$dte1,$dte2);
            $montantFactures=totalMontantPayeFactureAll();
            include(APP_FOLDER . '/views/admin/t_facture/View.php');
        }


        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            $result = $this->t_facture_model->SelectAll();
            include(APP_FOLDER . '/views/admin/t_facture/Export.php');
        }
        //Filtrage liste des factures
        elseif (get('do') == 'allbydte') {
            $f=post('f');
            $libellefact='Liste des factures normales';
            if($f=='0'){
                $libellefact='Liste des factures proforma';
            }
            $type='facturation';
            $dte1=dateToformatBdd(post('datedebut'));
            $dte2=dateToformatBdd(post('datefin'));
            $result = $this->t_facture_model->All($_SESSION['idsite'],$type,$dte1,$dte2);
            $montantFactures=totalMontantPayeFactureAll();
            include(APP_FOLDER . '/views/admin/t_facture/datalignesfact.php');
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
                echo' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=t_facture&id_fact=' . $srow->id_fact . '&do=details"><li class="list-group-item">' . $srow->num_fact . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        }


        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            $etatfact=get('f');
            if($etatfact==1){
              $typefact='normale' ; 
              $libcptfact = NUMFACT;
            }else {
              $typefact='proforma' ;
              $libcptfact = NUMPROFORMA;
            }
            $idsite = $_SESSION['idsite'];
            $panier->initialiser();
            $clients = $clientobj->SelectAll($idsite);
            $condpaiements = $condpaiementobj->SelectAll($idsite);
            $site = $siteobj->Infos2($idsite);
            $articles = $produitobj->SelectAllBySite($idsite);
            $num_cmd = $compteurobj->getnumerotation($idsite, $libcptfact);
            $num_cmd_format = format_numero($num_cmd);
            $prefixefact =$_SESSION['prefsanct'];
            $numfact = $prefixefact . $num_cmd_format;
//            $ville_hotel=$site->ville_hotel;
//            $logo=$site->logo;
//            $adresse_c=$site->adrcomp;
//            $email_compagny=$site->mail_company;
//            $telephone=$site->phone;
//            $idnat=$site->idnat;
//            $rccm=$site->rccm;
            include(APP_FOLDER . '/views/admin/t_facture/Add.php');
        } elseif (get('do') == 'addpan') {
            // Ajouter produit dans le panier 
            //$depot_id=get('source_id');
            $select['id'] = get('idprod');
            $select['qte'] = get('qte');
            $select['nom'] = get('nameprod');
            $select['prix'] = get('prix');
            $tva = get('tva');
            $select['monttva'] = CalculMontTva($select['prix'],$tva);
            //$op=get('op');
            if (IsNombre($select['qte'])) {
                //$qtedispo=GetProdQteDispoByDepot($select['id'],$depot_id);
                //if ($select['qte'] <= $qtedispo){
                //$select['unite'] = get('unite');
                $panier->ajouterFact($select);
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
        elseif (get('do') == 'enregfact'){
            $id_hotel = post('id_hotel');
            //Numerotation facture
            $etat =post('etatfact');
            if($etat=='0'){
                $libcptfact = NUMPROFORMA;
            }else {
               $libcptfact = NUMFACT; 
            }
            $num_cmd = $compteurobj->getnumerotation($id_hotel,$libcptfact);
            $num_cmd_format = format_numero($num_cmd);
            $prefixefact =post('prefixefact');
            $numfact = $prefixefact . $num_cmd_format;
            $id_client = post('id_client');
            $type = 'facturation';
            $taux = $_SESSION['Paie_taux'];
            $tva = 16;
            $monnaie = $_SESSION['Paie_affiche'];
            $remise = $majoration = 0;
            $justification = post('description');
            $company_id = $_SESSION['company_id'];
            $id_user = $_SESSION['id_user'];
            $dte_edit = dateToformatBdd(post('dte_edit'));
            $dte_ech = dateToformatBdd(post('dte_ech'));
            $nbArticles = count($_SESSION['panier']['id_article']);
            $totfacttva=$panier->tot_fact_tva();
            //CAS DE NOUVEAU CLIENT
            if ($id_client == '0') {
           $id_client=$clientobj->InsertFacturation(post('nomsct'),post('nomclt'),post('sexeclt'),post('adr'),post('eml'),post('tel'),post('typeclt'),post('id_hotel'));
            }
          $facture_id=$this->t_facture_model->InsertFact(post('numfact'),$type,$etat,$dte_edit,$dte_ech,$totfacttva,post('tva'),post('ttc'),post('ttc'),$taux,$tva,$monnaie,$remise,$majoration,$justification,$id_hotel,$company_id,$id_user,$id_client);
            //INSERT LIGNES FACTURE
            for ($i = 0; $i <= $nbArticles - 1; $i++){
                $quantite = $_SESSION['panier']['qte'][$i];
                $produit_id = $_SESSION['panier']['id_article'][$i];
                $prix = $_SESSION['panier']['prix'][$i];
                $mont_tva= $_SESSION['panier']['monttva'][$i];
                $lignes_commandesobj->InsertFact($quantite,$prix,$mont_tva,$facture_id,$produit_id,$id_hotel);
            }
            //MAJ NUMEROTATION COMPTEUR
            $num_cmd+=1;
            $compteurobj->Update($libcptfact, $num_cmd,$id_hotel);
            $panier->initialiser();
            $json['facture_id'] =$facture_id ;
            $json['message'] ="Cette facture vient d'être enregistrée avec succès!";
            $json['s'] =TRUE;
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
                }else{
                    $this->t_facture_model->Update(post('num_fact'), post('type'), post('i_souscription'), post('etat'), post('etat_cmd'), post('date_echeance_old'), post('date_edition'), post('dte_blocage'), post('date_echeance'), post('date_desactivation'), post('montant_total'), post('mont_tva'), post('mont_ttc'), post('mont_ttc_remise'), post('taux'), post('taux_prix'), post('tva'), post('monnaie'), post('remise'), post('majoration'), post('justification'), post('id_res'), post('res_ch_id'), post('modulecompagny'), post('id_hotel'), post('company_id'), post('id_user'), post('id_client'), post('fact1'), post('id_fact'));
                    json_send('' . H_ADMIN . '&view=t_facture&id_fact=' . post('id_fact') . '&do=details&msg=update');
                    json_success('Process Completed');
                }
            }
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $idsite = $_SESSION['idsite'];
            $id_fact=get('id_fact');
            $rows = $this->t_facture_model->SelectOne($id_fact);
            
            $nomcl=$rows->nom_client;
            $societe=$rows->designation;
            $emailcl=$rows->email_client;
            $tel=$rows->telephone_client;
            $adr=$rows->adresse_provenance_client;
            $numfact =$rows->num_fact;
            $dte_edit=dateAffiche($rows->date_edition);
            $etatfact=$rows->etat;
            if($etatfact=='1'){
              $typefact='normale';  
            }else{
               $typefact='proforma';   
            }
            
            $dte_ech=dateAffiche($rows->date_echeance);
            $justification=$rows->justification ;
            $ht=$rows->montant_total;
            $monttvax=$rows->mont_tva;
            $ttc=$rows->mont_ttc_remise;
            $monnaie_fact=$rows->monnaie;
            $taux=getTauxFacture2($monnaie_fact,$_SESSION['Paie_taux'],$rows->taux);
            $ht = montant_equivalent_bdd($monnaie_fact,$_SESSION['Paie_affiche'],$taux,$ht);
            $monttvax = montant_equivalent_bdd($monnaie_fact,$_SESSION['Paie_affiche'],$taux,$monttvax);
            $ttc = montant_equivalent_bdd($monnaie_fact,$_SESSION['Paie_affiche'],$taux,$ttc);
            $panier->initialiser();
            $site = $siteobj->Infos2($idsite);
            $logo=$site->logo;
            $mail=$site->mail;
            $phone=$site->phone;
            $adrcomp=$site->adrcomp;
            $nomcomp=$site->nomcomp;
            $idnat=$site->idnat;
            $rccm=$site->rccm;
            $result=$this->t_facture_model->lignesAllBySite($id_fact);
            foreach ($result as $rows){
                $select['id'] =$rows->produit_id;
                $select['qte'] =$rows->qte;
                $select['nom'] =$rows->designation;
                $select['prix'] =$rows->prix;
                $select['monttva']=$rows->mont_tva; 
                $panier->ajouterFact($select);
            }
            $nbArticles = count($_SESSION['panier']['id_article']);
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
        }elseif (get('do') == 'exonerertva'){
            $panier->Exonerer_tva();
            $nbArticles = count($_SESSION['panier']['id_article']);
            include(APP_FOLDER . '/views/admin/t_facture/lignesfact.php');
        }elseif (get('do') == 'appliktva'){
            $panier->Appliquer_tva();
            $nbArticles = count($_SESSION['panier']['id_article']);
            include(APP_FOLDER . '/views/admin/t_facture/lignesfact.php');
        }
        elseif (get('do') == 'sendmail'){
            include './libraries/mpdf60/mpdf.php';
            include './libraries/PHPMailer/class.phpmailer.php';
             $idsite = $_SESSION['idsite'];
            $id_fact=get('id_fact');
            $rows = $this->t_facture_model->SelectOne($id_fact);
            
            $nomcl=$rows->nom_client;
            $societe=$rows->designation;
            $emailcl=$rows->email_client;
            $tel=$rows->telephone_client;
            $adr=$rows->adresse_provenance_client;
            $numfact =$rows->num_fact;
            $dte_edit=dateAffiche($rows->date_edition);
            $etatfact=$rows->etat;
            if($etatfact=='1'){
              $typefact='normale';  
            }else{
               $typefact='proforma';   
            }
            
            $dte_ech=dateAffiche($rows->date_echeance);
            $justification=$rows->justification ;
            $ht=$rows->montant_total;
            $monttvax=$rows->mont_tva;
            $ttc=$rows->mont_ttc_remise;
            $monnaie_fact=$rows->monnaie;
            $taux=getTauxFacture2($monnaie_fact,$_SESSION['Paie_taux'],$rows->taux);
            $ht = montant_equivalent_bdd($monnaie_fact,$_SESSION['Paie_affiche'],$taux,$ht);
            $monttvax = montant_equivalent_bdd($monnaie_fact,$_SESSION['Paie_affiche'],$taux,$monttvax);
            $ttc = montant_equivalent_bdd($monnaie_fact,$_SESSION['Paie_affiche'],$taux,$ttc);
            $panier->initialiser();
            $site = $siteobj->Infos2($idsite);
            $logo=$site->logo;
            $mail=$site->mail;
            $phone=$site->phone;
            $adrcomp=$site->adrcomp;
            $nomcomp=$site->nomcomp;
            $idnat=$site->idnat;
            $rccm=$site->rccm;
            $result=$this->t_facture_model->lignesAllBySite($id_fact);
            foreach ($result as $rows){
                $select['id'] =$rows->produit_id;
                $select['qte'] =$rows->qte;
                $select['nom'] =$rows->designation;
                $select['prix'] =$rows->prix;
                $select['monttva']=$rows->mont_tva; 
                $panier->ajouterFact($select);
            }
            $nbArticles = count($_SESSION['panier']['id_article']);
            include(APP_FOLDER . '/views/admin/impression/facturation_fact.php');
            $body = ob_get_clean();
            $body = iconv("UTF-8", "UTF-8//IGNORE", $body);
            $mpdf = new mPDF('c', 'A4', '', '', 7, 7, 8, 5, 0, 0);
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->WriteHTML($body);
            $mailobj = new PHPMailer();
            $fichier= $mpdf->Output("Facture.pdf", "S");
            $bool=EmailSendFichier($_SESSION['nomexp'],$_SESSION['mailexp'],$nomcl,$adr,$_SESSION['sujetmail'],$_SESSION['msgmail'],$fichier,$mailobj);
            if($bool){
                $json['message'] ="Cette facture vient d'être envoyée avec succès!"; 
            }else{
               $json['message'] ="Cette facture n'est pas envoyée!";  
            }
            $json['s'] =TRUE;
            echo json_encode($json);
        }
    }

//end invoke
}

//end class
?>
	