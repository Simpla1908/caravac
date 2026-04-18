
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        stk__mouvement.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		stk__mouvement
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/stk__mouvement.php');
	
	class stk__mouvement_controller {
	public $stk__mouvement_model;
	
	public function __construct()  
    {  
        $this->stk__mouvement_model = new stk__mouvement_model();
    } 
	
	public function invoke_stk__mouvement()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->stk__mouvement_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->stk__mouvement_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=stk__mouvement&do=viewall');
	}else{
	$result = $this->stk__mouvement_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/stk__mouvement/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->stk__mouvement_model->SelectAll();
	include(APP_FOLDER.'/views/admin/stk__mouvement/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->stk__mouvement_model->SelectOne(get('idmvt'));
	include(APP_FOLDER.'/views/admin/stk__mouvement/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->stk__mouvement_model->AutoSearch(trim($qstring),10,'indice_bs');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=stk__mouvement&idmvt='.$srow->idmvt.'&do=details"><li class="list-group-item">'. $srow->indice_bs.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/stk__mouvement/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('indice_bs')==''){
	json_error('The field indice bs cannot be empty!');
	}
	elseif (post('type')==''){
	json_error('The field type cannot be empty!');
	}
	elseif (post('motif')==''){
	json_error('The field motif cannot be empty!');
	}
	elseif (post('num_bon')==''){
	json_error('The field num bon cannot be empty!');
	}
	elseif (post('qte_entree')==''){
	json_error('The field qte entree cannot be empty!');
	}
	elseif (post('qte_sortie')==''){
	json_error('The field qte sortie cannot be empty!');
	}
	elseif (post('dte_appro')==''){
	json_error('The field dte appro cannot be empty!');
	}
	elseif (post('dte_appro_heure')==''){
	json_error('The field dte appro heure cannot be empty!');
	}
	elseif (post('depot')==''){
	json_error('The field depot cannot be empty!');
	}
	elseif (post('produit_id')==''){
	json_error('The field produit id cannot be empty!');
	}
	elseif (post('user_id')==''){
	json_error('The field user id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->stk__mouvement_model->Insert(post('indice_bs'),post('type'),post('motif'),post('num_bon'),post('qte_entree'),post('qte_sortie'),post('dte_appro'),post('dte_appro_heure'),post('depot'),post('produit_id'),post('user_id'),post('hotel_id'));
	json_send(''.H_ADMIN.'&view=stk__mouvement&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->stk__mouvement_model->SelectOne(get('idmvt'));
	include(APP_FOLDER.'/views/admin/stk__mouvement/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('idmvt')==''){
	json_error('The field idmvt cannot be empty!');
	}
	elseif (post('indice_bs')==''){
	json_error('The field indice bs cannot be empty!');
	}
	elseif (post('type')==''){
	json_error('The field type cannot be empty!');
	}
	elseif (post('motif')==''){
	json_error('The field motif cannot be empty!');
	}
	elseif (post('num_bon')==''){
	json_error('The field num bon cannot be empty!');
	}
	elseif (post('qte_entree')==''){
	json_error('The field qte entree cannot be empty!');
	}
	elseif (post('qte_sortie')==''){
	json_error('The field qte sortie cannot be empty!');
	}
	elseif (post('dte_appro')==''){
	json_error('The field dte appro cannot be empty!');
	}
	elseif (post('dte_appro_heure')==''){
	json_error('The field dte appro heure cannot be empty!');
	}
	elseif (post('depot')==''){
	json_error('The field depot cannot be empty!');
	}
	elseif (post('produit_id')==''){
	json_error('The field produit id cannot be empty!');
	}
	elseif (post('user_id')==''){
	json_error('The field user id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->stk__mouvement_model->Update(post('indice_bs'),post('type'),post('motif'),post('num_bon'),post('qte_entree'),post('qte_sortie'),post('dte_appro'),post('dte_appro_heure'),post('depot'),post('produit_id'),post('user_id'),post('hotel_id'),post('idmvt'));
	json_send(''.H_ADMIN.'&view=stk__mouvement&idmvt='.post('idmvt').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->stk__mouvement_model->SelectOne(get('idmvt'));
	include(APP_FOLDER.'/views/admin/stk__mouvement/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->stk__mouvement_model->TruncateTable(''.H_ADMIN.'&view=stk__mouvement&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/stk__mouvement/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('idmvt') and $dfile==''){
	$del = $this->stk__mouvement_model->Delete(get('idmvt'),''.H_ADMIN.'&view=stk__mouvement&do=viewall&msg=delete');
	}
	elseif(get('idmvt') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->stk__mouvement_model->Delete(get('idmvt'),''.H_ADMIN.'&view=stk__mouvement&do=viewall&msg=delete');
	}
	elseif(get('idmvt') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=stk__mouvement&idmvt='.get('idmvt').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	