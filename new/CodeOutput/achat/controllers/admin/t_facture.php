
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
include(APP_FOLDER . '/models/objects/t_client.php');
include(APP_FOLDER . '/models/objects/stk_produit.php');
include(APP_FOLDER . '/models/objects/lignes_commandes.php');
include(APP_FOLDER . '/models/objects/compteur.php');

class t_facture_controller {

    public $t_facture_model;

    public function __construct() {
        $this->t_facture_model = new t_facture_model();
    }

    public function invoke_t_facture() {
        $fournisseurobj = new t_client_model();
        $produitobj = new stk_produit_model();
        $ligne_cmd_obj = new lignes_commandes_model();
        $compteurobj= new compteur_model();
        
        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall') {
            if (PAGINATION_TYPE == 'Normal') {
                $result = $this->t_facture_model->SelectAll(RECORD_PER_PAGE);
                //Accept get url  e.g (index.php?id=1&cat=2...)
                $paging = pagination($this->t_facture_model->CountRow(), RECORD_PER_PAGE, '' . H_ADMIN . '&view=t_facture&do=viewall');
            } else {
                $result = $this->t_facture_model->SelectAll();
            }
            include(APP_FOLDER . '/views/admin/t_facture/View.php');
        }

        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'view_bon_cmd') {
            //Declaration session pour impression
            $_SESSION['rows_bc'] = array();
            $_SESSION['rows_bc']['i'] = array();
            $_SESSION['rows_bc']['Bon_cmd'] = array();
            $_SESSION['rows_bc']['Description'] = array();
            $_SESSION['rows_bc']['date'] = array();
            $_SESSION['rows_bc']['fsse'] = array();
            $_SESSION['rows_bc']['Total'] = array();
            $_SESSION['rows_bc']['Devise'] = array();
            $_SESSION['rows_bc']['Statut'] = array();
            //Fin Declaration session
            $result = $this->t_facture_model->SelectAllBesoins($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/t_facture/View_bon_cmd.php');
        }
        
        if (get('do') == 'view_commande') {
            //Declaration session pour impression
            $_SESSION['rows_bc'] = array();
            $_SESSION['rows_bc']['i'] = array();
            $_SESSION['rows_bc']['Bon_cmd'] = array();
            $_SESSION['rows_bc']['Description'] = array();
            $_SESSION['rows_bc']['date'] = array();
            $_SESSION['rows_bc']['fsse'] = array();
            $_SESSION['rows_bc']['Total'] = array();
            $_SESSION['rows_bc']['Devise'] = array();
            $_SESSION['rows_bc']['Statut'] = array();
            //Fin Declaration session
            $dte1=$dte2=date('Y-m-d');
            $result = $this->t_facture_model->SelectAllCommandes($_SESSION['idsite'],$dte1,$dte2);
            include(APP_FOLDER . '/views/admin/t_facture/View_commande.php');
        }

        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            $result = $this->t_facture_model->SelectAll();
            include(APP_FOLDER . '/views/admin/t_facture/Export.php');
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
            include(APP_FOLDER . '/views/admin/t_facture/Add.php');
        }

        //ADD BON CMD //////////////////////////////////////////////////
        elseif (get('do') == 'add_bon_cmd') {
            $fournisseurs = $fournisseurobj->SelectAll_ach($_SESSION['idsite']);
            $produits = $produitobj->SelectAllProduit($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/t_facture/Add_bon_cmd.php');
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
                } else {
                    json_error('The field fact1 cannot be empty!');
                    $this->t_facture_model->Insert(post('num_fact'), post('type'), post('i_souscription'), post('etat'), post('etat_cmd'), post('date_echeance_old'), post('date_edition'), post('dte_blocage'), post('date_echeance'), post('date_desactivation'), post('montant_total'), post('mont_tva'), post('mont_ttc'), post('mont_ttc_remise'), post('taux'), post('taux_prix'), post('tva'), post('monnaie'), post('remise'), post('majoration'), post('justification'), post('id_res'), post('res_ch_id'), post('modulecompagny'), post('id_hotel'), post('company_id'), post('id_user'), post('id_client'), post('fact1'));
                    json_send('' . H_ADMIN . '&view=t_facture&do=viewall&msg=add');
                    json_success('Process Completed');
                }
            }
        }
        
        
        elseif (get('do') == 'add_besoins') {
            if ($_POST) {
            $json = array();
            $json['s'] = false;
            $json['message'] = '';
            $json['facture_id'] = '';
            
                //form validation
                if (post('founisseur_id') == '') {
                    $json['message'] =json_error2('Veuillez choisir le fournisseur!');
                } elseif (post('device') == '') {
                    $json['message'] =json_error2('Veuillez choisir la devise!');
                } elseif (post('description') == '') {
                    $json['message'] =json_error2('Veuillez saisir la description!');
                } elseif (post('date_cmd') == '') {
                    $json['message'] =json_error2('Veuillez remplir ce champ vide!');
                } 
                else {
                
                    $type="achat";
                    $user_id=post('id_user');
                    $monnaie=post('device');
                    $dte=dateToformatBdd(post('date_cmd'));
                    $site_id=$_SESSION['idsite'];
                    
                    if(post('commande')==1){
                        $statut_bon="approuve";
                        $founisseur_id=post('founisseur_id');
                        //GET REFERENCE
                        $lib_bon_cmd=NUM_BON_COMMANDE;
                        $num_cmd = $compteurobj->getnumerotation($site_id,$lib_bon_cmd);
                        $num_cmd_format = format_numero($num_cmd);  
                        $numBonCmd=$num_cmd_format;
                        $num_commande=$numBonCmd;
                        //MAJ REFERENCE
                        $num_cmd+=1;
                        $compteurobj->Update($lib_bon_cmd, $num_cmd, $site_id);
                        $numBonCmd='';
                        $first=1;
                        $commande_id = $this->t_facture_model->InsertBesoins($numBonCmd,$num_commande,$type,$first,$dte,$_SESSION['montant'],$_SESSION['montant'],$_SESSION['Paie_taux'],post('device'),post('description'),post('id_hotel'),post('company_id'),post('id_user'),post('founisseur_id'),$statut_bon);
                        
                        //LIVRAISON PRECOSE
                        $bdd = HDB::hus();
                        $num=1;
                        $query = $bdd->prepare("INSERT ach_livraison (numBon_cmd,bcommande_id,fournisseur_id,hotel_id)
                                                VALUES(:numBon_cmd,:bcommande_id,:fournisseur_id,:hotel_id)");
                        $query->BindParam(':numBon_cmd', $num);
                        $query->BindParam(':bcommande_id', $commande_id);
                        $query->BindParam(':fournisseur_id',$founisseur_id);
                        $query->BindParam(':hotel_id', $site_id);
                        $query->execute();
                        $id_livraison= $bdd->lastInsertId();
                        
                        $nbArticles = count($_SESSION['commande']['produit_id']);
                        for ($i = 0; $i <= $nbArticles - 1; $i++) {
                            $produit_id=$_SESSION['commande']['produit_id'][$i];
                            $designation=$_SESSION['commande']['designation'][$i];
                            $qte_dispo=$_SESSION['commande']['qte_dispo'][$i];
                            $prix_unit=$_SESSION['commande']['prix_unit'][$i];

                            $ligne_cmd_obj->InsertLigneCmd($qte_dispo,$prix_unit,$monnaie,$dte,$commande_id,$produit_id,$user_id,$_SESSION['idsite']);
                        
                            $query = $bdd->prepare("INSERT ach_produits_livres (quantite,produit_id,livraison_id,hotel_id)
                                                VALUES(:quantite,:produit_id,:livraison_id,:hotel_id)");
                            $query->BindParam(':quantite', $qte_dispo);
                            $query->BindParam(':produit_id', $produit_id);
                            $query->BindParam(':livraison_id', $id_livraison);
                            $query->BindParam(':hotel_id', $site_id);
                            $query->execute();
                        }

                        json_send('' . H_ADMIN . '&view=t_facture&do=view_commande&msg=add');
                        json_success('Process Completed');
                        
                    } else {
                        $statut_bon="envoye";
                        
                        //GET REFERENCE
                        $lib_bon_cmd=NUM_ETAT_BESOIN;
                        $num_cmd = $compteurobj->getnumerotation($site_id,$lib_bon_cmd);
                        $num_cmd_format = format_numero($num_cmd);  
                        $numBonCmd=$num_cmd_format;
                        //MAJ REFERENCE
                        $num_cmd+=1;
                        $compteurobj->Update($lib_bon_cmd, $num_cmd, $site_id);
                        $first=1;
                        $num_commande='';
                        $commande_id = $this->t_facture_model->InsertBesoins($numBonCmd,$num_commande,$type,$first,$dte,$_SESSION['montant'],$_SESSION['montant'],$_SESSION['Paie_taux'],post('device'),post('description'),post('id_hotel'),post('company_id'),post('id_user'),post('founisseur_id'),$statut_bon);
                    
                        $nbArticles = count($_SESSION['commande']['produit_id']);
                        for ($i = 0; $i <= $nbArticles - 1; $i++) {
                            $produit_id=$_SESSION['commande']['produit_id'][$i];
                            $designation=$_SESSION['commande']['designation'][$i];
                            $qte_dispo=$_SESSION['commande']['qte_dispo'][$i];
                            $prix_unit=$_SESSION['commande']['prix_unit'][$i];

                            $ligne_cmd_obj->InsertLigneCmd($qte_dispo,$prix_unit,$monnaie,$dte,$commande_id,$produit_id,$user_id,$_SESSION['idsite']);
                        }

                            $json['facture_id'] =$commande_id;
                            $json['s'] = true;
                        
                    }
              
                }
           echo json_encode($json);

            }

        }
        elseif (get('do') == 'supprimerprev') {
           $id_art=get('idart');
            if (!in_array($id_art,$_SESSION['artsup']['id_art'])) {
            array_push($_SESSION['artsup']['id_art'], $id_art);               
            }
             }
        elseif (get('do') == 'cmdprod') {
            $json = array();
            $json['s'] = false;
            $json['message'] = '';
            $json['TblArt'] = '';
            $nbArticles=-1;
            $action = get('action');
            if($action=='ajouter'){
          
                if (post('produit_id') == '') {
                    $json['message'] = json_error2("Veuillez choisir l'artcile!");
                } elseif (post('qte_dispo') == '') {
                    $json['message'] = json_error2('Veuillez saisir la quantité!');
                } elseif (post('prix_unit') == '') {
                    $json['message'] = json_error2('Veuillez saisi le prix unitaire!');
                } else {
                    $produit_id = post('produit_id');
                    $designation = post('designation');
                    $qte_dispo = post('qte_dispo');
                    $prix_unit = post('prix_unit');
                    $unite = post('unite');
                    //on ajoute le produit
                    $positionProduit = array_search($produit_id, $_SESSION['commande']['produit_id']);
                    if ($positionProduit !== false) {
                      $_SESSION['commande']['qte_dispo'][$positionProduit] = $qte_dispo;
                      $_SESSION['commande']['prix_unit'][$positionProduit] = $prix_unit;
                      $_SESSION['commande']['sous_tot'][$positionProduit] = $prix_unit * $qte_dispo;
                    } else {
                        //Sinon on ajoute le produit
                        array_push($_SESSION['commande']['produit_id'], $produit_id);
                        array_push($_SESSION['commande']['designation'], $designation);
                        array_push($_SESSION['commande']['qte_dispo'], $qte_dispo);
                        array_push($_SESSION['commande']['prix_unit'], $prix_unit);
                        array_push($_SESSION['commande']['sous_tot'], $prix_unit * $qte_dispo);
                        array_push($_SESSION['commande']['unite'],$unite);
                    }

                    $nbArticles= $_SESSION['nbArticles'] = count($_SESSION['commande']['produit_id']);
                    $json['s'] = true;

                }

            }  elseif ($action=='supprimer') {      
                $_SESSION['commandet'] = array();
                $_SESSION['commandet']['produit_id'] = array();
                $_SESSION['commandet']['designation'] = array();
                $_SESSION['commandet']['qte_dispo'] = array();
                $_SESSION['commandet']['prix_unit'] = array();
                $_SESSION['commandet']['sous_tot'] = array();
                $_SESSION['commandet']['unite'] = array();

                $nb_articles = count($_SESSION['commande']['produit_id']);
                    /* Transfert du panier dans le panier temporaire */
                    for ($i = 0; $i < $nb_articles; $i++) {
                        /* On transfère tout sauf l'article à supprimer */
                        if (!in_array($_SESSION['commande']['produit_id'][$i],$_SESSION['artsup']['id_art'])) {
                            array_push($_SESSION['commandet']['produit_id'], $_SESSION['commande']['produit_id'][$i]);
                            array_push($_SESSION['commandet']['designation'], $_SESSION['commande']['designation'][$i]);
                            array_push($_SESSION['commandet']['qte_dispo'], $_SESSION['commande']['qte_dispo'][$i]);
                            array_push($_SESSION['commandet']['prix_unit'], $_SESSION['commande']['prix_unit'][$i]);
                            array_push($_SESSION['commandet']['sous_tot'], $_SESSION['commande']['prix_unit'][$i] * $_SESSION['commande']['qte_dispo'][$i]);
                            array_push($_SESSION['commandet']['unite'],$_SESSION['commande']['unite'][$i]);
                        }
                    }
                    /* Le transfert est terminé, on ré-initialise le panier */
                    $_SESSION['commande'] = array();
                    $_SESSION['commande']['produit_id'] = array();
                    $_SESSION['commande']['designation'] = array();
                    $_SESSION['commande']['qte_dispo'] = array();
                    $_SESSION['commande']['prix_unit'] = array();
                    $_SESSION['commande']['sous_tot'] = array();
                    $_SESSION['commande']['unite'] = array();
                    $nb_articles = count($_SESSION['commandet']['produit_id']);
                    /* Transfert du panier dans le panier temporaire */
                    for ($i = 0; $i < $nb_articles; $i++) {
                        /* On transfère tout sauf l'article à supprimer */
                            array_push($_SESSION['commande']['produit_id'], $_SESSION['commandet']['produit_id'][$i]);
                            array_push($_SESSION['commande']['designation'], $_SESSION['commandet']['designation'][$i]);
                            array_push($_SESSION['commande']['qte_dispo'], $_SESSION['commandet']['qte_dispo'][$i]);
                            array_push($_SESSION['commande']['prix_unit'], $_SESSION['commandet']['prix_unit'][$i]);
                            array_push($_SESSION['commande']['sous_tot'], $_SESSION['commandet']['sous_tot'][$i]);
                            array_push($_SESSION['commande']['unite'],$_SESSION['commandet']['unite'][$i]);
                                            }

                    /* Option : on peut maintenant supprimer notre panier temporaire: */
                $nbArticles= $_SESSION['nbArticles'] = count($_SESSION['commande']['produit_id']);

            }  else {
                //$action='modifier'
                $produit_id = post('produit_id');
                $qte = post('qte');
                //Si le panier éxiste
                //Si la quantité est positive on modifie sinon on supprime l'article
                if ($qte > 0) {
                    //Recharche du produit dans le panier
                    $positionProduit = array_search($produit_id, $_SESSION['commande']['produit_id']);

                    if ($positionProduit !== false) {
                        $_SESSION['commande']['qte_dispo'][$positionProduit] = $qte;
            //            array_push($_SESSION['fiche']['qte'], $_POST['qte']);
                    }
                }
                $nbArticles = $_SESSION['nbArticles'] = count($_SESSION['commande']['produit_id']);

            }
            
            
            echo json_encode($json);   
        }
        elseif (get('do') == 'majtabprodcmd') {
         include(APP_FOLDER . '/views/admin/t_facture/tableau_produit_cmd.php');   
        }
        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $_SESSION['commande'] = array();
            $_SESSION['commande']['produit_id'] = array();
            $_SESSION['commande']['designation'] = array();
            $_SESSION['commande']['qte_dispo'] = array();
            $_SESSION['commande']['prix_unit'] = array();
            $_SESSION['commande']['sous_tot'] = array();
            
            $fournisseurs = $fournisseurobj->SelectAll_ach($_SESSION['idsite']);
            $rows = $this->t_facture_model->SelectOneBesoin(get('id_fact'));
            $lignes_cmd = $ligne_cmd_obj->SelectOneBesoinLignecmd(get('id_fact'));
            
            foreach ($lignes_cmd as $r) {
            array_push($_SESSION['commande']['produit_id'], $r->id);
            array_push($_SESSION['commande']['designation'], $r->designation);
            array_push($_SESSION['commande']['qte_dispo'], $r->qte);
            array_push($_SESSION['commande']['prix_unit'], $r->prix);
            array_push($_SESSION['commande']['sous_tot'], $r->qte * $r->prix);
            }                 
            $nbArticles = count($_SESSION['commande']['produit_id']);
            
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
            $rows = $this->t_facture_model->SelectOne(get('id_fact'));
            include(APP_FOLDER . '/views/admin/t_facture/Details.php');
        }
        elseif (get('do') == 'details_besoins') {
            $rows = $this->t_facture_model->SelectOneBesoin(get('id_fact'));
            $lignes_cmd = $ligne_cmd_obj->SelectOneBesoinLignecmd(get('id_fact'));
            include(APP_FOLDER . '/views/admin/t_facture/Details_besoins.php');
        }
        
        elseif (get('do') == 'details_commande') {
            $rows = $this->t_facture_model->SelectOneBesoin(get('id_fact'));
            $lignes_cmd = $ligne_cmd_obj->SelectOneBesoinLignecmd(get('id_fact'));
            include(APP_FOLDER . '/views/admin/t_facture/Details_commande.php');
        }
        elseif (get('do') == 'update_commande') {
            $_SESSION['modepaiementachat']='cash';
            $_SESSION['commande'] = array();
            $_SESSION['commande']['produit_id'] = array();
            $_SESSION['commande']['designation'] = array();
            $_SESSION['commande']['qte_dispo'] = array();
            $_SESSION['commande']['prix_unit'] = array();
            $_SESSION['commande']['sous_tot'] = array();
            $id_fact=get('id_fact');
            $rows = $this->t_facture_model->SelectOneBesoin(get('id_fact'));
            $lignes_cmd = $ligne_cmd_obj->SelectOneBesoinLignecmd(get('id_fact'));
            
            foreach ($lignes_cmd as $r) {
                array_push($_SESSION['commande']['produit_id'],$r->id);
                array_push($_SESSION['commande']['designation'], $r->designation);
                array_push($_SESSION['commande']['qte_dispo'], $r->qte);
                array_push($_SESSION['commande']['prix_unit'], $r->prix);
                array_push($_SESSION['commande']['sous_tot'], $r->qte * $r->prix);
            }                 
            $nbArticles = count($_SESSION['commande']['produit_id']);
            include(APP_FOLDER . '/views/admin/t_facture/update_commande.php');
        }
        elseif (get('do') == 'produits_update') {
            $produit_id = post('produit_id');
            $designation = post('designation');
            $quantite = post('qte');
            $prix_unit = post('prix');
            
            $positionProduit = array_search($produit_id, $_SESSION['commande']['produit_id']);
            if ($positionProduit !== false) {
              $_SESSION['commande']['produit_id'][$positionProduit] = $produit_id;
              $_SESSION['commande']['designation'][$positionProduit] = $designation;
              $_SESSION['commande']['qte_dispo'][$positionProduit] = $quantite;
              $_SESSION['commande']['prix_unit'][$positionProduit] = $prix_unit;
              $_SESSION['commande']['sous_tot'][$positionProduit] = $prix_unit * $quantite;
            }
            $nbArticles = count($_SESSION['commande']['produit_id']);
            
            $requete = HDB::hus()->prepare("UPDATE lignes_commandes SET qte=:qte,prix=:prix WHERE id=:id");
            $requete->BindParam(':qte', $quantite);
            $requete->BindParam(':prix', $prix_unit );
            $requete->BindParam(':id', $produit_id);
            $requete->execute();
            
            include(APP_FOLDER . '/views/admin/t_facture/produits_update.php');
        }
        elseif (get('do') == 'modif_commande') {
            $nbArticles = count($_SESSION['commande']['produit_id']);
            for ($i = 0; $i <= $nbArticles - 1; $i++) {
                
                $produit_id = $_SESSION['commande']['produit_id'];
                $quantite = $_SESSION['commande']['qte_dispo'];
                $prix_unit = $_SESSION['commande']['prix_unit'];
                var_dump($quantite);
                $ligne_cmd_obj->UpdateQtePrix($quantite,$prix_unit,$produit_id);
                var_dump($ligne_cmd_obj);
            }
            include(APP_FOLDER . '/views/admin/t_facture/update_commande.php');
//            $rows = $this->t_facture_model->SelectOneBesoin(get('id_fact'));
//            $lignes_cmd = $ligne_cmd_obj->SelectOneBesoinLignecmd(get('id_fact'));
//            include(APP_FOLDER . '/views/admin/t_facture/Details_commande.php');
        }
        elseif (get('do') == 'approuve_commande') {
            $facture_id=get('id_fact');
            $mode=$_SESSION['modepaiementachat'];
            $statut='approuve';
            $site_id=$_SESSION['idsite'];
            $mont_ttc=$_SESSION['montant'];
            //GET REFERENCE
            $lib_bon_cmd=NUM_BON_COMMANDE;
            $num_cmd = $compteurobj->getnumerotation($site_id,$lib_bon_cmd);
            $num_cmd_format = format_numero($num_cmd);  
            $num_commande=$num_cmd_format;
            //MAJ REFERENCE
            $num_cmd+=1;
            $compteurobj->Update($lib_bon_cmd, $num_cmd, $site_id);
            
            $this->t_facture_model->UpdateStatut($mont_ttc,$mode,$statut,$num_commande,$facture_id);
            $rows = $this->t_facture_model->SelectOneBesoin(get('id_fact'));
            $lignes_cmd = $ligne_cmd_obj->SelectOneBesoinLignecmd(get('id_fact'));
            
            //LIVRAISON PRECOSE
            $bdd = HDB::hus();
            $num=1;
            $query = $bdd->prepare("INSERT ach_livraison (numBon_cmd,bcommande_id,fournisseur_id,hotel_id)
                                    VALUES(:numBon_cmd,:bcommande_id,:fournisseur_id,:hotel_id)");
            $query->BindParam(':numBon_cmd', $num);
            $query->BindParam(':bcommande_id', $facture_id);
            $query->BindParam(':fournisseur_id', $rows->id_client);
            $query->BindParam(':hotel_id', $site_id);
            $query->execute();
            $id_livraison= $bdd->lastInsertId();
            
            foreach ($lignes_cmd as $r) {
                $query = $bdd->prepare("INSERT ach_produits_livres (quantite,produit_id,livraison_id,hotel_id)
                                        VALUES(:quantite,:produit_id,:livraison_id,:hotel_id)");
                $query->BindParam(':quantite', $r->qte);
                $query->BindParam(':produit_id', $r->produit_id);
                $query->BindParam(':livraison_id', $id_livraison);
                $query->BindParam(':hotel_id', $site_id);
                $query->execute();
            }
            include(APP_FOLDER . '/views/admin/t_facture/Details_commande.php');
        }
        elseif (get('do') == 'rejete_commande') {
            $facture_id=get('id_fact');
            $statut='rejete';
            $this->t_facture_model->UpdateStatut1($statut, $facture_id);
            $rows = $this->t_facture_model->SelectOneBesoin(get('id_fact'));
            $lignes_cmd = $ligne_cmd_obj->SelectOneBesoinLignecmd(get('id_fact'));
            include(APP_FOLDER . '/views/admin/t_facture/Details_commande.php');
        }
        elseif (get('do') == 'retablir_commande') {
            $facture_id=get('id_fact');
            $statut='envoye';
            $this->t_facture_model->UpdateStatut1($statut, $facture_id);
            $rows = $this->t_facture_model->SelectOneBesoin(get('id_fact'));
            $lignes_cmd = $ligne_cmd_obj->SelectOneBesoinLignecmd(get('id_fact'));
            include(APP_FOLDER . '/views/admin/t_facture/Details_commande.php');
        }
        elseif (get('do') == 'demande') {
            $facture_id=get('id_fact');
            $statut='attente';
            $this->t_facture_model->UpdateStatut1($statut, $facture_id);
            $result = $this->t_facture_model->SelectAllBesoins($_SESSION['idsite']);
            $_SESSION['id_hotel']=$_SESSION['idsite'];
            include(APP_FOLDER . '/views/admin/t_facture/View_commande.php');
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
                $del = $this->t_facture_model->Delete(get('id_fact'), '' . H_ADMIN . '&view=t_facture&do=view_bon_cmd&msg=delete');
            } elseif (get('id_fact') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->t_facture_model->Delete(get('id_fact'), '' . H_ADMIN . '&view=t_facture&do=view_bon_cmd&msg=delete');
            } elseif (get('id_fact') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=t_facture&id_fact=' . get('id_fact') . '&do=update&msg=delete');
            }
        }
        
        
        
        //verification dates
        elseif (get('do') == 'verifdates') {
            $json = array();
            $json['s'] = false;
            $json['message'] = '';
            if (post('datedebut') == '' || post('datefin') == '') {
                $json['message'] = json_error2('Veuillez remplir tous les champs');
            } else {
                $json['s'] = true;
            }
            echo json_encode($json);
        }
        // fin verification dates
        
        elseif (get('do') == 'filtre') {
                //Declaration session pour impression
                $_SESSION['rows_bc'] = array();
                $_SESSION['rows_bc']['i'] = array();
                $_SESSION['rows_bc']['Bon_cmd'] = array();
                $_SESSION['rows_bc']['Description'] = array();
                $_SESSION['rows_bc']['date'] = array();
                $_SESSION['rows_bc']['fsse'] = array();
                $_SESSION['rows_bc']['Total'] = array();
                $_SESSION['rows_bc']['Devise'] = array();
                $_SESSION['rows_bc']['Statut'] = array();
                //Fin Declaration session
                $datedebut = dateToformatBdd(post('datedebut'));
                $datefin = dateToformatBdd(post('datefin'));
                $_SESSION['datedebut']=$datedebut;
                $_SESSION['datefin']=$datefin;
                $result = $this->t_facture_model->SelectAllCommandes($_SESSION['idsite'],$datedebut,$datefin);
                $json['s'] = true;
                include(APP_FOLDER . '/views/admin/t_facture/dataviewbc.php');
                
        }elseif (get('do') == 'filtre_besoin') {
                //Declaration session pour impression
                $_SESSION['rows_bc'] = array();
                $_SESSION['rows_bc']['i'] = array();
                $_SESSION['rows_bc']['Bon_cmd'] = array();
                $_SESSION['rows_bc']['Description'] = array();
                $_SESSION['rows_bc']['date'] = array();
                $_SESSION['rows_bc']['fsse'] = array();
                $_SESSION['rows_bc']['Total'] = array();
                $_SESSION['rows_bc']['Devise'] = array();
                $_SESSION['rows_bc']['Statut'] = array();
                //Fin Declaration session
                $datedebut = dateToformatBdd(post('datedebut'));
                $datefin = dateToformatBdd(post('datefin'));
                
                $_SESSION['datedebut']=$datedebut;
                $_SESSION['datefin']=$datefin;
                
                $sql = 'SELECT a.id_fact,a.num_fact,a.date_edition,a.monnaie,a.justification,a.id_hotel,a.company_id,a.id_user,a.id_client,a.statut_bon,
                        b.id_client,b.nom_entreprise, c.commande_id,SUM(c.prix * c.qte) AS tot_cmd
                        FROM  t_facture AS a, t_client AS b, lignes_commandes AS c
                        WHERE a.id_client=b.id_client
                        AND a.id_fact=c.commande_id 
                        AND a.type="achat"
                        AND a.date_edition BETWEEN :datedebut AND :datefin AND a.id_hotel=:id
                        GROUP BY a.id_fact
                        ORDER BY a.num_fact';
                $requete = HDB::hus()->prepare($sql);
                $requete->BindParam(':datedebut', $datedebut);
                $requete->BindParam(':datefin', $datefin);
                $requete->BindParam(':id', $_SESSION['idsite']);
                $requete->execute();
                $result = $requete->fetchAll(PDO::FETCH_OBJ);
                $json['s'] = true;
                
                include(APP_FOLDER . '/views/admin/t_facture/datavieweb.php');
        }
        elseif (get('do') == 'modepaiement') {
            $modepaiement=get('modepaiement');
            $_SESSION['modepaiementachat']=$modepaiement;
        }elseif(get('do')=='delprodcom' || get('do')=='delprodcomajx'){
            $_SESSION['commande'] = array();
            $_SESSION['commande']['produit_id'] = array();
            $_SESSION['commande']['designation'] = array();
            $_SESSION['commande']['qte_dispo'] = array();
            $_SESSION['commande']['prix_unit'] = array();
            $_SESSION['commande']['sous_tot'] = array();
            $idlig=get('idlig');
            Dellignecom($idlig);
            if(get('do')=='delprodcomajx'){
             $lignes_cmd = $ligne_cmd_obj->SelectOneBesoinLignecmd(get('id_fact'));
            foreach ($lignes_cmd as $r) {
                array_push($_SESSION['commande']['produit_id'],$r->id);
                array_push($_SESSION['commande']['designation'], $r->designation);
                array_push($_SESSION['commande']['qte_dispo'], $r->qte);
                array_push($_SESSION['commande']['prix_unit'], $r->prix);
                array_push($_SESSION['commande']['sous_tot'], $r->qte * $r->prix);
            }                 
            $nbArticles = count($_SESSION['commande']['produit_id']);
            include(APP_FOLDER . '/views/admin/t_facture/produits_update.php');   
            }
        }
    }

//end invoke
}

//end class
?>
	