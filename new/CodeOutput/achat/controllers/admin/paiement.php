
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        paiement.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		paiement
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/paiement.php');
        include(APP_FOLDER . '/models/objects/t_client.php');
        include(APP_FOLDER . '/models/objects/t_facture.php');
	
	class paiement_controller {
	public $paiement_model;
	
	public function __construct()  
    {  
        $this->paiement_model = new paiement_model();
    } 
	
	public function invoke_paiement()
	{
            $fournisseurobj = new t_client_model();
            $boncommandeobj = new t_facture_model();
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->paiement_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->paiement_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=paiement&do=viewall');
	}else{
	$result = $this->paiement_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/paiement/View.php');
	}
        if (get('do') == 'view_paiement') {
            
            $result = $this->paiement_model->SelectAllPaiement($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/paiement/View_paiement.php');
        }
        elseif (get('do') == 'demande') {
            $facture_id=get('id_fact');
            $statut='attente';
            $montant=get('solde');
            $boncommandeobj->UpdateStatut2($statut,$montant, $facture_id);
            $result = $this->paiement_model->SelectAllPaiement($_SESSION['idsite']);
            include(APP_FOLDER . '/views/admin/paiement/View_paiement.php');
        }
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->paiement_model->SelectAll();
	include(APP_FOLDER.'/views/admin/paiement/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->paiement_model->SelectOne(get('idpaie'));
	include(APP_FOLDER.'/views/admin/paiement/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->paiement_model->AutoSearch(trim($qstring),10,'montant');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=paiement&idpaie='.$srow->idpaie.'&do=details"><li class="list-group-item">'. $srow->montant.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/paiement/Add.php');
	}
	elseif(get('do')=='add_paie'){
            $fournisseurs = $fournisseurobj->SelectAll($_SESSION['idsite']);
            $bons = $boncommandeobj->SelectAllNum_bon($_SESSION['idsite']);
            include(APP_FOLDER.'/views/admin/paiement/Add_paie.php');
	}
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('montant')==''){
	json_error('The field montant cannot be empty!');
	}
	elseif (post('montantusd')==''){
	json_error('The field montantusd cannot be empty!');
	}
	elseif (post('montantcdf')==''){
	json_error('The field montantcdf cannot be empty!');
	}
	elseif (post('taux')==''){
	json_error('The field taux cannot be empty!');
	}
	elseif (post('rendu')==''){
	json_error('The field rendu cannot be empty!');
	}
	elseif (post('remise')==''){
	json_error('The field remise cannot be empty!');
	}
	elseif (post('justification')==''){
	json_error('The field justification cannot be empty!');
	}
	elseif (post('id_mode_regl')==''){
	json_error('The field id mode regl cannot be empty!');
	}
	elseif (post('id_monnaie')==''){
	json_error('The field id monnaie cannot be empty!');
	}
	elseif (post('regl_id')==''){
	json_error('The field regl id cannot be empty!');
	}
	elseif (post('site_id')==''){
	json_error('The field site id cannot be empty!');
	}
	elseif (post('company_id')==''){
	json_error('The field company id cannot be empty!');
	}
	else{
	$this->paiement_model->Insert(post('montant'),post('montantusd'),post('montantcdf'),post('taux'),post('rendu'),post('remise'),post('justification'),post('id_mode_regl'),post('id_monnaie'),post('regl_id'),post('site_id'),post('company_id'));
	json_send(''.H_ADMIN.'&view=paiement&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->paiement_model->SelectOne(get('idpaie'));
	include(APP_FOLDER.'/views/admin/paiement/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('idpaie')==''){
	json_error('The field idpaie cannot be empty!');
	}
	elseif (post('montant')==''){
	json_error('The field montant cannot be empty!');
	}
	elseif (post('montantusd')==''){
	json_error('The field montantusd cannot be empty!');
	}
	elseif (post('montantcdf')==''){
	json_error('The field montantcdf cannot be empty!');
	}
	elseif (post('taux')==''){
	json_error('The field taux cannot be empty!');
	}
	elseif (post('rendu')==''){
	json_error('The field rendu cannot be empty!');
	}
	elseif (post('remise')==''){
	json_error('The field remise cannot be empty!');
	}
	elseif (post('justification')==''){
	json_error('The field justification cannot be empty!');
	}
	elseif (post('id_mode_regl')==''){
	json_error('The field id mode regl cannot be empty!');
	}
	elseif (post('id_monnaie')==''){
	json_error('The field id monnaie cannot be empty!');
	}
	elseif (post('regl_id')==''){
	json_error('The field regl id cannot be empty!');
	}
	elseif (post('site_id')==''){
	json_error('The field site id cannot be empty!');
	}
	elseif (post('company_id')==''){
	json_error('The field company id cannot be empty!');
	}
	else{
	$this->paiement_model->Update(post('montant'),post('montantusd'),post('montantcdf'),post('taux'),post('rendu'),post('remise'),post('justification'),post('id_mode_regl'),post('id_monnaie'),post('regl_id'),post('site_id'),post('company_id'),post('idpaie'));
	json_send(''.H_ADMIN.'&view=paiement&idpaie='.post('idpaie').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->paiement_model->SelectOne(get('idpaie'));
	include(APP_FOLDER.'/views/admin/paiement/Details.php');
	}
        
        elseif(get('do')=='detailspaie'){
	$result = $this->paiement_model->SelectOnePaie(get('id_fact'));
	include(APP_FOLDER.'/views/admin/paiement/Details_paiement.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->paiement_model->TruncateTable(''.H_ADMIN.'&view=paiement&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/paiement/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('idpaie') and $dfile==''){
	$del = $this->paiement_model->Delete(get('idpaie'),''.H_ADMIN.'&view=paiement&do=viewall&msg=delete');
	}
	elseif(get('idpaie') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->paiement_model->Delete(get('idpaie'),''.H_ADMIN.'&view=paiement&do=viewall&msg=delete');
	}
	elseif(get('idpaie') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=paiement&idpaie='.get('idpaie').'&do=update&msg=delete');
	}
        //Extrait de compte 
        if (get('do') == 'extraitcompte') {
            $result = $ot_client->SELECTALLCLIENTSITE($_SESSION['id_hotel']);
            include(APP_FOLDER . '/views/admin/paiement/extraitcompte.php');
        } else if (get('do') == 'check') {
            $json = array();
            $json['s'] = false;
            $json['message'] = '';
            if (post('idclient') == '') {
                $json['message'] = json_error2('Veuillez sélectionner un client');
            } else if (post('datedebut') == '' || post('datefin') == '') {
                $json['message'] = json_error2('Veuillez remplir tous les champs');
            } else {


                $json['s'] = true;
            }
            echo json_encode($json);
        } elseif (get('do') == 'viewdatas') {
            $employe_id = post('employe_id');
            $idsite = $_SESSION['idsite'];
            include(APP_FOLDER . '/views/admin/paiement/datasextraitcompte.php');
        }
        //fin extrait de compte
	}
	}//end invoke
	}//end class
	?>
	