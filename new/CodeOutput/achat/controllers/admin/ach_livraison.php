
<?php

/*
 * =======================================================================
 * FILE NAME:        ach_livraison.php
 * DATE CREATED:  	09-07-2018
 * FOR TABLE:  		ach_livraison
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/ach_livraison.php');
include(APP_FOLDER . '/models/objects/t_client.php');
include(APP_FOLDER . '/models/objects/t_facture.php');
include(APP_FOLDER . '/models/objects/compteur.php');
include(APP_FOLDER . '/models/objects/ach_produits_livres.php');
//include(APP_FOLDER . '/models/objects/stk__mouvement.php');
include(APP_FOLDER . '/models/objects/skt_fiche.php');
include(APP_FOLDER . '/models/objects/t_validation.php');

class ach_livraison_controller {

    public $ach_livraison_model;

    public function __construct() {
        $this->ach_livraison_model = new ach_livraison_model();
    }

    public function invoke_ach_livraison() {
        //Fusion horaire
        
        $fournisseurobj = new t_client_model();
        $boncommandeobj = new t_facture_model();
        $compteurobj = new compteur_model();
        $produits_livObj = new ach_produits_livres_model();
//        $mouvementObj = new stk__mouvement_model();
        $ficheObj = new skt_fiche_model();
        $validationObj = new t_validation_model();

        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall') {
            $result = $this->ach_livraison_model->SelectAll($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/ach_livraison/View.php');
        } elseif (get('do') == 'combo_numBon') {
            unset($_SESSION['boncmd']);
            $_SESSION['boncmd'] = array();
            $_SESSION['boncmd']['facture_id'] = array();
            $_SESSION['boncmd']['numerobom'] = array();
            $founisseur_id = get('founisseur_id');
            $bons = $boncommandeobj->SelectAllNumbon_Commande($founisseur_id);
             foreach ($bons as $rows) {
                    $facture_id = $rows->id_fact;
                    $monnaie_boncmd=$rows->monnaie;
                    $taux=$rows->taux;
                   $id_fact=$facture_id;
                    $mont_ttc=TotalBonCom($id_fact);
                    $montantboncmd = montant_equivalent_bdd($monnaie_boncmd,$monnaie_boncmd,$taux,$mont_ttc);
                    $montant_paye=totalMontantPaye($facture_id);
                    $montant_payer = montant_equivalent_bdd($monnaie_boncmd,$monnaie_boncmd,$taux,$montant_paye);
                    $solde=$montantboncmd - $montant_payer;
                    $mode_facture = $rows->mode;
                    if($mode_facture=='credit'){
                      $solde=0;  
                    }
                    if($solde==0){
                        $resultat = $this->ach_livraison_model->SelectProduitNumBon($facture_id);
                        foreach ($resultat as $res) {
                            $fact_id = $res->id_fact;
                            $numerobom = $res->num_cmd;
                            $qte = $res->quantite;
                            $qte_liv = $res->quantite_liv;
                            if($qte != $qte_liv){
                                if (!in_array($fact_id, $_SESSION['boncmd']['facture_id'])) {
                                    array_push($_SESSION['boncmd']['facture_id'], $fact_id);
                                    array_push($_SESSION['boncmd']['numerobom'], $numerobom);
                                }

                            }
                        }  
                    }
                    
                }
 
            unset($_SESSION['livraison']);
            $_SESSION['livraison'] = array();
            $_SESSION['livraison']['produit_id'] = array();
            $_SESSION['livraison']['designation'] = array();
            $_SESSION['livraison']['qte_attendue'] = array();
            $_SESSION['livraison']['qte_recue'] = array();
            $_SESSION['livraison']['observation'] = array();
            $_SESSION['livraison']['commande_id'] = array();
            $_SESSION['livraison']['qte_cmd'] = array();
            
            include(APP_FOLDER . '/views/admin/ach_livraison/Liste_num_bons.php');
            
        } elseif (get('do') == 'produits_view') {
            $boncommande_id = get('boncommande_id');
            $ps = $this->ach_livraison_model->SelectId_liv($boncommande_id);
            $nbre = 0;
            foreach ($ps as $rows1) {
                $nbre = count($rows1->id_liv);
            }
            if ($nbre == 0) {
                $produits = $boncommandeobj->SelectAllProduit_bon($boncommande_id);
            } else {
                $produits = $boncommandeobj->SelectAllProduit_bon2($boncommande_id);
            }

            $action = get('action');
            if ($action == 'ajouter') {
                foreach ($produits as $rows) {
                    if ($nbre == 0) {
                        $quantite_cmd = $rows->quantite;
                        $quantite_liv = 0;
                    } else {
                        $quantite_cmd = $rows->quantite;
                        $quantite_liv = $rows->quantite_liv;
                    }
                    $quantite_reste = $quantite_cmd - $quantite_liv;
                    
                    if ($quantite_reste !== 0) {
                        $commande_id = $rows->commande_id;
                        $produit_id = $rows->produit_id;
                        $designation = $rows->designation;
                        $qte_attendue = $quantite_reste;
                        $qte_recue =$qte_attendue;
                        $observation = '';

                        $positionProduit = array_search($produit_id, $_SESSION['livraison']['produit_id']);
                        if ($positionProduit !== false) {
                            
                        } else {
                            array_push($_SESSION['livraison']['commande_id'], $commande_id);
                            array_push($_SESSION['livraison']['produit_id'], $produit_id);
                            array_push($_SESSION['livraison']['designation'], $designation);
                            array_push($_SESSION['livraison']['qte_attendue'], $qte_attendue);
                            array_push($_SESSION['livraison']['qte_recue'], $qte_recue);
                            array_push($_SESSION['livraison']['observation'], $observation);
                            array_push($_SESSION['livraison']['qte_cmd'], $quantite_cmd);
                        }
                    }
                    $nbArticles = count($_SESSION['livraison']['produit_id']);
                }
            } elseif ($action == 'quantite') {
                $produit_id = post('produit_id');
                $qte = post('qte');
                //Si la quantité est positive on modifie sinon on supprime l'article
                if ($qte >= 0) {
                    //Recharche du produit dans le panier
                    $positionProduit = array_search($produit_id, $_SESSION['livraison']['produit_id']);

                    if ($positionProduit !== false) {
                        $_SESSION['livraison']['qte_recue'][$positionProduit] = $qte;
                    }
                }
                $nbArticles = count($_SESSION['livraison']['produit_id']);
            } elseif ($action == 'observation') {
                $produit_id = post('produit_id');
                $observation = post('observation');
                //Recharche du produit dans le panier
                $positionProduit = array_search($produit_id, $_SESSION['livraison']['produit_id']);

                if ($positionProduit !== false) {
                    $_SESSION['livraison']['observation'][$positionProduit] = $observation;
                }
                $nbArticles = count($_SESSION['livraison']['produit_id']);
            }

            include(APP_FOLDER . '/views/admin/ach_livraison/Produits_commandes.php');
        }


        //EXPORT ////////////////////////////////////////////////////	
        if (get('do') == 'export') {
            $result = $this->ach_livraison_model->SelectAll();
            include(APP_FOLDER . '/views/admin/ach_livraison/Export.php');
        }

        //Expeort2
        elseif (get('do') == 'export2') {
            $rows = $this->ach_livraison_model->SelectOne(get('id_liv'));
            include(APP_FOLDER . '/views/admin/ach_livraison/Export2.php');
        }
        //SEARCH SUGGEST ////////////////////////////////////////////////////	
        elseif (get('do') == 'autosearch') {
            $qstring = post('qstring');
            if (strlen($qstring) > 0) {
                $autosearch = $this->ach_livraison_model->AutoSearch(trim($qstring), 10, 'numBon_liv');
                echo' <div class=widget><ul class="list-group">';
                foreach ($autosearch as $srow) {
                    echo '<span class="searchheading"><a href="' . H_ADMIN . '&view=ach_livraison&id_liv=' . $srow->id_liv . '&do=details"><li class="list-group-item">' . $srow->numBon_liv . '</li></a>
	</span>';
                }
                echo '</ul></div>';
            }
        }


        //ADD //////////////////////////////////////////////////
        elseif (get('do') == 'add') {
            $fournisseurs = $fournisseurobj->SelectAll_ach($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/ach_livraison/Add.php');
        }

        //ADD PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'addpro') {
            if ($_POST) {
                //form validation
                if (post('numBon_liv') == '') {
                    json_error('The field numBon liv cannot be empty!');
                } elseif (post('numBon_cmd') == '') {
                    json_error('The field numBon cmd cannot be empty!');
                } elseif (post('bcommande_id') == '') {
                    json_error('The field bcommande id cannot be empty!');
                } elseif (post('fournisseur_id') == '') {
                    json_error('The field fournisseur id cannot be empty!');
                } elseif (post('user_id') == '') {
                    json_error('The field user id cannot be empty!');
                } else {
                    $this->ach_livraison_model->Insert(post('numBon_liv'), post('numBon_cmd'), post('bcommande_id'), post('fournisseur_id'), post('user_id'));
                    json_send('' . H_ADMIN . '&view=ach_livraison&do=viewall&msg=add');
                    json_success('Process Completed');
                }
            }
        } elseif (get('do') == 'addliv') {

            $json = array();
            
            $json['s'] = false;
            $json['message'] = '';
//            echo 'ooook';
//            if ($_POST) {
            //form validation
            if (post('liv_founisseur_id') == '') {
                $json['message'] = json_error('Le champs founisseur nest peux pas etre vide!');
            } elseif (post('boncommande_id') == '') {
                $json['message'] = json_error('Le champs numero bon de commande nest peux pas etre vide!');
            } else {
                $user_id = $_SESSION['id_user'];
                $site_id = $_SESSION['idsite'];
                $date = date('Y-m-d');
                $qte_sortie = 0;
                $motif = "entree";
                $type = 'appro';
                $numbon = 'BE' . rand();
                $date_heure = date('Y-m-d H:i:s');

                //GET REFERENCE
                $lib_bon_liv = NUM_BON_LIVRAISON;
                $num_liv = $compteurobj->getnumerotation($site_id, $lib_bon_liv);
                $num_liv_format = format_numero($num_liv);
                $numBonLiv = $num_liv_format;
                //MAJ REFERENCE
                $num_liv+=1;
                $compteurobj->Update($lib_bon_liv, $num_liv, $site_id);
                $first=1;
                $livraison_id = $this->ach_livraison_model->InsertLivraison($first,$numBonLiv, $date,$date_heure, post('boncommande_id'), post('liv_founisseur_id'), $user_id, $site_id);

                $nbArticles = count($_SESSION['livraison']['produit_id']);
                
                //Insertion dans la table fiche
                //GET REFERENCE
                $lib_bon_stk= NUM_BON_APPRO;
                $num_bon = $compteurobj->getnumerotation($site_id, $lib_bon_stk);
                $num_bon_format = format_numero($num_bon);
                $numBonStk = $num_bon_format;
                //MAJ REFERENCE
                $num_bon+=1;
                $compteurobj->Update($lib_bon_stk, $num_bon, $site_id);
                $depot_id = GetDepotCentral_id($site_id);
                $beneficiere='';
                $approuve=0;
                $motif_fiche='appro';
                $dte=date('Y-m-d');
                $dte_time=date('Y-m-d H:i:s');
                $fiche_id= $ficheObj->Insert($numBonStk,$type,$motif_fiche,$beneficiere,$nbArticles,$dte,$dte_time,$approuve,$depot_id,$user_id,$site_id);
                
                for ($i = 0; $i <= $nbArticles - 1; $i++) {
                    if ($_SESSION['livraison']['commande_id'][$i] == post('boncommande_id')) {
                        $produit_id = $_SESSION['livraison']['produit_id'][$i];
                        $designation = $_SESSION['livraison']['designation'][$i];
                        $qte_attendue = $_SESSION['livraison']['qte_attendue'][$i];
                        $qte_recue = $_SESSION['livraison']['qte_recue'][$i];
                        $observation = $_SESSION['livraison']['observation'][$i];
                        $qtecmd = $_SESSION['livraison']['qte_cmd'][$i];
                                                
                        $produits_livObj->InsertLigneLiv($qtecmd, $qte_attendue, $qte_recue, $observation, $produit_id, $livraison_id, $user_id, $site_id);
                        $qte_verif =0;
                        $motif_id=6;
                        $validationObj->Insert($qte_recue,$qte_verif,$motif_id,$produit_id,$fiche_id,$site_id);
                        

//                        $operations = $mouvementObj->SelectLignes($_SESSION['idsite']);
//                        foreach ($operations as $op) {
//                            $lignes = $op->lignes;
//                        }
//                        if ($lignes == 0) {
//                            $indice_bs = 1;
//                        } else {
//                            $operations1 = $mouvementObj->SelectIndice($_SESSION['idsite']);
//                            foreach ($operations1 as $op) {
//                                $indice_bs = $op->indice_bs;
//                            }
//                        }
//
//                        $idmvt = $mouvementObj->InsertMvt($indice_bs, $type, $motif, $numbon, $qte_recue, $qte_sortie, $date, $date_heure, $produit_id, $user_id, $site_id);
//                        $mouvementObj->UpdateIndice($indice_bs, $idmvt);
                    }
                }

                $json['message'] = json_success2("Opération effectuée avec succes");
                $json['s'] = true;
                unset($_SESSION['livraison']);
                $_SESSION['livraison'] = array();
                $_SESSION['livraison']['produit_id'] = array();
                $_SESSION['livraison']['designation'] = array();
                $_SESSION['livraison']['qte_attendue'] = array();
                $_SESSION['livraison']['qte_recue'] = array();
                $_SESSION['livraison']['observation'] = array();
                $_SESSION['livraison']['commande_id'] = array();
                $_SESSION['livraison']['qte_cmd'] = array();
//                    json_send('' . H_ADMIN . '&view=ach_livraison&do=viewall&msg=add');
//                    json_success('Process Completed');
//                    
//                    $result = $this->ach_livraison_model->SelectAll();	
//                    include(APP_FOLDER.'/views/admin/ach_livraison/View.php');
            }
            $_SESSION['first']=$first;
            $_SESSION['fournisseur']=post('fournisseur');
            $_SESSION['num_bon']=post('num_bon');
            $_SESSION['num_bon_liv']=$numBonLiv;
            $_SESSION['id_liv']=$livraison_id;
            echo json_encode($json);
//            }
        }

        //UPDATE //////////////////////////////////////////////////
        elseif (get('do') == 'update') {
            $rows = $this->ach_livraison_model->SelectOne(get('id_liv'));
            $fournisseurs = $fournisseurobj->SelectAll_ach($_SESSION['idsite']);
            $bons = $boncommandeobj->SelectAllNumbon_Cmd($rows->fournisseur_id);

            $_SESSION['livraison'] = array();
            $_SESSION['livraison']['produit_id'] = array();
            $_SESSION['livraison']['designation'] = array();
            $_SESSION['livraison']['qte_attendue'] = array();
            $_SESSION['livraison']['qte_recue'] = array();
            $_SESSION['livraison']['observation'] = array();
            $_SESSION['livraison']['commande_id'] = array();
            $_SESSION['livraison']['qte_cmd'] = array();

            $produits = $boncommandeobj->SelectAllProduit_bon3($rows->bcommande_id, get('id_liv'));
            foreach ($produits as $rows1) {
                $commande_id = $rows1->id_produit_liv;
                $produit_id = $rows1->produit_id;
                $designation = $rows1->designation;
                $qte_attendue = $rows1->quantite_cmd;
                $qte_recue = $rows1->quantite_liv;
                $observation = $rows1->observation;
                $qte_cmd = $rows1->quantite;

                array_push($_SESSION['livraison']['commande_id'], $commande_id);
                array_push($_SESSION['livraison']['produit_id'], $produit_id);
                array_push($_SESSION['livraison']['designation'], $designation);
                array_push($_SESSION['livraison']['qte_attendue'], $qte_attendue);
                array_push($_SESSION['livraison']['qte_recue'], $qte_recue);
                array_push($_SESSION['livraison']['observation'], $observation);
                array_push($_SESSION['livraison']['qte_cmd'], $qte_cmd);

                $nbArticles = count($_SESSION['livraison']['produit_id']);
            }

            include(APP_FOLDER . '/views/admin/ach_livraison/Update.php');
        }

        //UPDATE PROCESS //////////////////////////////////////////////////
        elseif (get('do') == 'updatepro') {
            if ($_POST) {
                //form validation
                if (post('id_liv') == '') {
                    json_error('The field id_liv cannot be empty!');
                } elseif (post('numBon_liv') == '') {
                    json_error('The field numBon liv cannot be empty!');
                }
//	elseif (post('numBon_cmd')==''){
//	json_error('The field numBon cmd cannot be empty!');
//	}
                elseif (post('bcommande_id') == '') {
                    json_error('The field bcommande id cannot be empty!');
                } elseif (post('fournisseur_id') == '') {
                    json_error('The field fournisseur id cannot be empty!');
                } elseif (post('user_id') == '') {
                    json_error('The field user id cannot be empty!');
                } else {
                    $user_id = $_SESSION['id_user'];
                    $this->ach_livraison_model->Update(post('numBon_liv'), post('numBon_cmd'), post('bcommande_id'), post('fournisseur_id'), post('user_id'), post('id_liv'));

                    $nbArticles = count($_SESSION['livraison']['produit_id']);
                    for ($i = 0; $i <= $nbArticles - 1; $i++) {
                        $produit_id = $_SESSION['livraison']['produit_id'][$i];
                        $designation = $_SESSION['livraison']['designation'][$i];
                        $qte_attendue = $_SESSION['livraison']['qte_attendue'][$i];
                        $qte_recue = $_SESSION['livraison']['qte_recue'][$i];
                        $observation = $_SESSION['livraison']['observation'][$i];
                        $qtecmd = $_SESSION['livraison']['qte_cmd'][$i];
                        $id = $_SESSION['livraison']['commande_id'][$i];

                        $produits_livObj->Update($qte_attendue, $qte_recue, $observation, $produit_id, post('id_liv'), $user_id, $id);

//                $operations = $mouvementObj->SelectLignes($_SESSION['idsite']);
//                foreach ($operations as $op) {
//                    $lignes = $op->lignes;
//                }
//                if ($lignes == 0) {
//                    $indice_bs = 1;
//                } else {
//                    $operations1 = $mouvementObj->SelectIndice($_SESSION['idsite']);
//                    foreach ($operations1 as $op) {
//                        $indice_bs = $op->indice_bs;
//                    }
//                }
//
//                $idmvt = $mouvementObj->InsertMvt($indice_bs, $type, $motif, $numbon, $qte_recue, $qte_sortie, $date, $date_heure, $produit_id, $user_id, $site_id);
//                $mouvementObj->UpdateIndice($indice_bs, $idmvt);
                    }

                    json_send('' . H_ADMIN . '&view=ach_livraison&id_liv=' . post('id_liv') . '&do=details&msg=update');
                    json_success('Process Completed');
                }
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
                $_SESSION['rows_livraison'] = array();
                $_SESSION['rows_livraison']['i'] = array();
                $_SESSION['rows_livraison']['num_liv'] = array();
                $_SESSION['rows_livraison']['num_cmd'] = array();
                $_SESSION['rows_livraison']['date'] = array();
                $_SESSION['rows_livraison']['fsse'] = array();
                $_SESSION['rows_livraison']['user'] = array();
                //Fin Declaration session
                $datedebut = dateToformatBdd(post('datedebut'));
                $datefin = dateToformatBdd(post('datefin'));
                
                $_SESSION['datedebut']=$datedebut;
                $_SESSION['datefin']=$datefin;
                
                $sql = "SELECT a.id_liv, a.numBon_liv, a.date, a.bcommande_id, a.fournisseur_id, b.num_fact, c.nom_entreprise, d.nom_user, d.prenom_user
                        FROM ach_livraison AS a, t_facture AS b, t_client AS c, t_utilisateur AS d
                        WHERE a.bcommande_id=b.id_fact
                        AND a.fournisseur_id=c.id_client 
                        AND a.user_id=d.id_user AND a.date BETWEEN :datedebut AND :datefin AND a.hotel_id=:id
                        ORDER BY a.date DESC";
                $requete = HDB::hus()->prepare($sql);
                $requete->BindParam(':datedebut', $datedebut);
                $requete->BindParam(':datefin', $datefin);
                $requete->BindParam(':id', $_SESSION['idsite']);
                $requete->execute();
                $result = $requete->fetchAll(PDO::FETCH_OBJ);
                $json['s'] = true;
                
                include(APP_FOLDER . '/views/admin/ach_livraison/dataviewliv.php');
        }

        //DETAILS //////////////////////////////////////////////
        elseif (get('do') == 'details') {
            $rows = $this->ach_livraison_model->SelectOneLiv(get('id_liv'));
            $result = $this->ach_livraison_model->SelectProduitLiv(get('id_liv'));
            include(APP_FOLDER . '/views/admin/ach_livraison/Details.php');
        } elseif (get('do') == 'fiche') {
            $rows = $this->ach_livraison_model->SelectOneLiv(get('id_liv'));
            $result_rows = $this->ach_livraison_model->SelectId_liv(get('bcommande_id'));

            include(APP_FOLDER . '/views/admin/ach_livraison/Fiche_livraison.php');
        }

        //TRUNCATE ///////////////////////////////////////////////
        elseif (get('do') == 'truncate') {
            $this->ach_livraison_model->TruncateTable('' . H_ADMIN . '&view=ach_livraison&do=viewall&msg=truncate');
            include(APP_FOLDER . '/views/admin/ach_livraison/View.php');
        }

        //DELETE /////////////////////////////////////////////////
        elseif (get('do') == 'delete') {
            $dfile = get('dfile');
            if (get('id_liv') and $dfile == '') {
                $del = $this->ach_livraison_model->Delete(get('id_liv'), '' . H_ADMIN . '&view=ach_livraison&do=viewall&msg=delete');
            } elseif (get('id_liv') and $dfile != '' and get('fdel') == '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                $del = $this->ach_livraison_model->Delete(get('id_liv'), '' . H_ADMIN . '&view=ach_livraison&do=viewall&msg=delete');
            } elseif (get('id_liv') and $dfile != '' and get('fdel') != '') {
                delete_files(UPLOAD_PATH . get('dfile'));
                delete_files(THUMB_PATH . get('dfile'));
                send_to('' . H_ADMIN . '&view=ach_livraison&id_liv=' . get('id_liv') . '&do=update&msg=delete');
            }
        }
    }

//end invoke
}

//end class
?>
	