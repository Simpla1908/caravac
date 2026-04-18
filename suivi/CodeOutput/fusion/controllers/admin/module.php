
<?php

/*
 * =======================================================================
 * FILE NAME:        module.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		module
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */

if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include(APP_FOLDER . '/models/objects/module.php');
include_once(APP_FOLDER . '/models/objects/Panier.php');
include_once(APP_FOLDER . '/models/objects/compteur.php');

class module_controller {

    public $module_model;

    public function __construct() {
        $this->module_model = new module_model();
    }

    public function invoke_module() {
        $panier = new Panier();
        $compteurobj = new compteur_model();
        //SELECT ALL //////////////////////////////////	
        if (get('do') == 'viewall') {
            if (PAGINATION_TYPE == 'Normal') {
                $result = $this->module_model->SelectAll(RECORD_PER_PAGE);
                //Accept get url  e.g (index.php?id=1&cat=2...)
                $paging = pagination($this->module_model->CountRow(), RECORD_PER_PAGE, '' . H_ADMIN . '&view=module&do=viewall');
            } else {
                $result = $this->module_model->SelectAll();
            }
            include(APP_FOLDER . '/views/admin/module/View.php');
        }if (get('do') == 'fusion'){
            $bdd = HDB::hus();
            $id = $_SESSION['company_id'];
            $niveau = 1;
            $date_bd1 = date('Y-m-d');
            $date_bd2 = date('Y-m-d');
            DetailsVenteGlobal($id, $date_bd1, $date_bd2, $niveau, $bdd);
            $nbre_rows = count($_SESSION['prod']['id']);
            $sites = SiteInfos($id, $bdd);
            $nbresite = count($sites['id']);
            include(APP_FOLDER . '/views/admin/suivi/vente.php');
        } elseif (get('do') == 'stock'){
            $bdd = HDB::hus();
            $id = $_SESSION['company_id'];
            $niveau = 1;
            $date_bd1 = date('Y-m-d');
            $date_bd2 = date('Y-m-d');
            $depots = ListPOSAll($id, $bdd);
            $nbresite = count($depots['depot_id']);
            $idsite = $_SESSION['default_site_id'];
            $description = $_SESSION['default_site_name'] . ' du ' . date('d/m/Y') . ' au ' . date('d/m/Y');
            $depot_id = $_SESSION['default_depot_id'];
            FicheStockBySite($idsite, $depot_id, $date_bd1, $date_bd2, $bdd);
            $articles = $_SESSION['articles'];
            $_SESSION['libelle_depot']=$_SESSION['default_site_name'];
            include(APP_FOLDER . '/views/admin/suivi/rg_fichestock.php');
        } elseif (get('do') == "stockajx"){
            $bdd = HDB::hus();
            $id = $_SESSION['company_id'];
            $default_site_name = post('nomsite');
            $d1 = post('dte1');
            $d2 = post('dte2');
            $date_bd1 = dateToformatBdd(post('dte1'));
            $date_bd2 = dateToformatBdd(post('dte2'));
            $description = $default_site_name . ' du ' . $d1 . ' au ' . $d2;
            $depot_id = post('site_id');
            $idsite = post('niveau');
            FicheStockBySite($idsite, $depot_id, $date_bd1, $date_bd2, $bdd);
            $articles = $_SESSION['articles'];
            $_SESSION['libelle_depot']=$default_site_name;
            include(APP_FOLDER . '/views/admin/suivi/rg_datafichestock.php');
        } elseif (get('do') == "venteajx") {
            $bdd = HDB::hus();
            $site_id = post('site_id');
            $niveau = post('niveau');
            $id = $_SESSION['company_id'];
            if ($site_id != 0) {
                $id = $site_id;
            }
            $dte1 = dateToformatBdd(post('dte1'));
            $dte2 = dateToformatBdd(post('dte2'));
            $dte1_af = dateAffiche($dte1);
            $dte2_af = dateAffiche($dte2);
            $description = ' du ' . $dte1_af . ' au ' . $dte2_af;
            DetailsVenteGlobal($id, $dte1, $dte2, $niveau, $bdd);
            $nbre_rows = count($_SESSION['prod']['id']);
            $sites = SiteInfos($id, $bdd);
            $nbresite = count($sites['id']);
            include(APP_FOLDER . '/views/admin/suivi/dataventeglobal.php');
        }elseif(get('do') == 'cdf'){
            $action='cdf';
            $bdd = HDB::hus();
            $id = $_SESSION['company_id'];
            $d1 =date('Y-m-d');
            $d2 =date('Y-m-d');
            $devise='CDF';
            $depots=ListPOSAll($id,$bdd);
            $sites=SiteExerciceBycompany($id,$bdd);
            $nbresite=count($depots['depot_id']);
            $site_id=$_SESSION['default_site_id'];
            $libelle='CDF';
            $description=$libelle.' du ' . date('d/m/Y') . ' au ' . date('d/m/Y');
            include(APP_FOLDER . '/views/admin/suivi/rg_tresorerie.php');
        }elseif(get('do') == 'cdfajx'){
            $bdd = HDB::hus();
            $site_id = post('site_id');
            $id = $_SESSION['company_id'];
            if ($site_id != 0) {
                $id = $site_id;
            }
            $nomsite=post('nomsite');
            $dte1 =post('dte1');
            $dte2 =post('dte2');
            $d1 = dateToformatBdd($dte1);
            $d2 = dateToformatBdd($dte2);
            $devise='CDF';
            $sites=SiteExerciceById($site_id,$bdd);
            $libelle='CDF';
            $description=$libelle.' du ' . date('d/m/Y') . ' au ' . date('d/m/Y');
            include(APP_FOLDER . '/views/admin/suivi/rg_datatresorerie.php');
        }elseif(get('do') == 'usdajx'){
            $bdd = HDB::hus();
            $site_id = post('site_id');
            $id = $_SESSION['company_id'];
            if ($site_id != 0) {
                $id = $site_id;
            }
            $nomsite=post('nomsite');
            $dte1 =post('dte1');
            $dte2 =post('dte2');
            $d1 = dateToformatBdd($dte1);
            $d2 = dateToformatBdd($dte2);
            $devise='USD';
            $sites=SiteExerciceById($site_id,$bdd);
            $libelle='USD';
            $description=$libelle.' du ' . date('d/m/Y') . ' au ' . date('d/m/Y');
            include(APP_FOLDER . '/views/admin/suivi/rg_datatresorerie.php');
        }
        elseif(get('do') == 'usd'){
            $bdd = HDB::hus();
            $action='usd';
            $id = $_SESSION['company_id'];
            $d1 =date('Y-m-d');
            $d2 =date('Y-m-d');
            $devise='USD';
            $depots=ListPOSAll($id,$bdd);
            $sites=SiteExerciceBycompany($id,$bdd);
            $nbresite=count($depots['depot_id']);
            $site_id=$_SESSION['default_site_id'];
            $libelle='USD';
            $description=$libelle.' du ' . date('d/m/Y') . ' au ' . date('d/m/Y');
            include(APP_FOLDER . '/views/admin/suivi/rg_tresorerie.php');
        }elseif(get('do')=='bc'){
            $bdd = HDB::hus();
            $id = $_SESSION['company_id'];
            $d1 =date('Y-m-d');
            $d2 =date('Y-m-d');
            $sites=GetSitesByCompany($id,$bdd);
            $result=GetBonsAchatByCompany($id,$d1,$d2,$bdd);
            $description='(' . date('d/m/Y') . ' au ' . date('d/m/Y').')';            $d1 =date('Y-m-d');
            $d2 =date('Y-m-d');
            include(APP_FOLDER . '/views/admin/suivi/rg_bc.php');
        }elseif(get('do')=='bcajx'){
            $bdd = HDB::hus();
            $site_id = post('site_id');
            $id = $_SESSION['company_id'];
            if ($site_id != 0) {
                $id = $site_id;
            }
            $nomsite=post('nomsite');
            $dte1 =post('dte1');
            $dte2 =post('dte2');
            $d1 = dateToformatBdd($dte1);
            $d2 = dateToformatBdd($dte2);
            $result=GetBonsAchatBySite($site_id,$d1,$d2,$bdd);
            $description =$nomsite. '(' . $dte1 . ' au ' . $dte2.')';
            $sites=GetSitesByCompany($id,$bdd);
            $description='(' . date('d/m/Y') . ' au ' . date('d/m/Y').')';
            include(APP_FOLDER . '/views/admin/suivi/rg_databc.php');
        }elseif(get('do')=='details_commande'){
            $bdd = HDB::hus();
            $id_fact=get('id_fact');
            $rows =SelectOneBesoin($id_fact,$bdd);
            $lignes_cmd =SelectOneBesoinLignecmd($id_fact,$bdd);
            include(APP_FOLDER. '/views/admin/suivi/Details_commande.php');
           
        }elseif(get('do')=='update_commande'){
            $bdd = HDB::hus();
            $id_fact=get('id_fact');
            $_SESSION['modepaiementachat']='cash';
            $_SESSION['commande'] = array();
            $_SESSION['commande']['produit_id'] = array();
            $_SESSION['commande']['designation'] = array();
            $_SESSION['commande']['qte_dispo'] = array();
            $_SESSION['commande']['prix_unit'] = array();
            $_SESSION['commande']['sous_tot'] = array();
            $id_fact=get('id_fact');
            $rows=SelectOneBesoin($id_fact,$bdd);
            $lignes_cmd=SelectOneBesoinLignecmd($id_fact,$bdd);
            foreach ($lignes_cmd as $r){
                array_push($_SESSION['commande']['produit_id'],$r->id);
                array_push($_SESSION['commande']['designation'], $r->designation);
                array_push($_SESSION['commande']['qte_dispo'], $r->qte);
                array_push($_SESSION['commande']['prix_unit'], $r->prix);
                array_push($_SESSION['commande']['sous_tot'], $r->qte*$r->prix);
            }                 
            $nbArticles = count($_SESSION['commande']['produit_id']);
            include(APP_FOLDER. '/views/admin/suivi/update_commande.php');
        }elseif(get('do')=='approuve_commande'){
            $bdd = HDB::hus();
            $facture_id=get('id_fact');
            $mode=$_SESSION['modepaiementachat'];
            $statut='attente';
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
            
            UpdateStatut($mont_ttc,$mode,$statut,$num_commande,$facture_id,$bdd);
            $rows =SelectOneBesoin(get('id_fact'),$bdd);
            $lignes_cmd =SelectOneBesoinLignecmd(get('id_fact'),$bdd);
            
            //LIVRAISON PRECOSE
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
            include(APP_FOLDER . '/views/admin/suivi/Details_commande.php');
            
        }elseif(get('do')=='rejete_commande'){
            $bdd = HDB::hus();
            $facture_id=get('id_fact');
            $statut='rejete';
            UpdateStatut1($statut,$facture_id,$bdd);
            $rows =SelectOneBesoin($facture_id,$bdd);
            $lignes_cmd =SelectOneBesoinLignecmd($facture_id,$bdd);
            include(APP_FOLDER . '/views/admin/suivi/Details_commande.php');
        }elseif (get('do') == 'produits_update') {
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
            
            include(APP_FOLDER . '/views/admin/suivi/produits_update.php');
        }elseif(get('do')=='delprodcom' || get('do')=='delprodcomajx'){
            $bdd = HDB::hus();
            $_SESSION['commande'] = array();
            $_SESSION['commande']['produit_id'] = array();
            $_SESSION['commande']['designation'] = array();
            $_SESSION['commande']['qte_dispo'] = array();
            $_SESSION['commande']['prix_unit'] = array();
            $_SESSION['commande']['sous_tot'] = array();
            $idlig=get('idlig');
            Dellignecom($idlig,$bdd);
            if(get('do')=='delprodcomajx'){
             $lignes_cmd =SelectOneBesoinLignecmd(get('id_fact'),$bdd);
            foreach($lignes_cmd as $r){
                array_push($_SESSION['commande']['produit_id'],$r->id);
                array_push($_SESSION['commande']['designation'], $r->designation);
                array_push($_SESSION['commande']['qte_dispo'], $r->qte);
                array_push($_SESSION['commande']['prix_unit'], $r->prix);
                array_push($_SESSION['commande']['sous_tot'], $r->qte * $r->prix);
            }                 
            $nbArticles = count($_SESSION['commande']['produit_id']);
            include(APP_FOLDER . '/views/admin/suivi/produits_update.php');   
            }
        }elseif(get('do')=='occupation'){
            $bdd = HDB::hus();
            $id = $_SESSION['company_id'];
            $datedebut =date('Y-m-d');
            $datefin=date('Y-m-d');
            $result =GetClientloges($datedebut,$datefin,$_SESSION['idsite'],$bdd); 
            $description='(' . date('d/m/Y') . ' au ' . date('d/m/Y').')';  
            include(APP_FOLDER . '/views/admin/suivi/rg_heb_occupations.php');
        }
        
    }

//end invoke
}

//end class
?>
	