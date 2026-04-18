
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_reglement.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_reglement
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_reglement.php');
	
	class t_reglement_controller {
	public $t_reglement_model;
	
	public function __construct()  
    {  
        $this->t_reglement_model = new t_reglement_model();
    } 
	
	public function invoke_t_reglement()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_reglement_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_reglement_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_reglement&do=viewall');
	}else{
	$result = $this->t_reglement_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_reglement/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_reglement_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_reglement/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_reglement_model->SelectOne(get('id_regl'));
	include(APP_FOLDER.'/views/admin/t_reglement/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_reglement_model->AutoSearch(trim($qstring),10,'numero');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_reglement&id_regl='.$srow->id_regl.'&do=details"><li class="list-group-item">'. $srow->numero.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_reglement/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('numero')==''){
	json_error('The field numero cannot be empty!');
	}
	elseif (post('montant_dollar')==''){
	json_error('The field montant dollar cannot be empty!');
	}
	elseif (post('montant_fc')==''){
	json_error('The field montant fc cannot be empty!');
	}
	elseif (post('reste')==''){
	json_error('The field reste cannot be empty!');
	}
	elseif (post('id_mode_regl')==''){
	json_error('The field id mode regl cannot be empty!');
	}
	elseif (post('date_regl')==''){
	json_error('The field date regl cannot be empty!');
	}
	elseif (post('dte')==''){
	json_error('The field dte cannot be empty!');
	}
	elseif (post('rejete')==''){
	json_error('The field rejete cannot be empty!');
	}
	elseif (post('id_fact')==''){
	json_error('The field id fact cannot be empty!');
	}
	elseif (post('id_monnaie')==''){
	json_error('The field id monnaie cannot be empty!');
	}
	elseif (post('id_user')==''){
	json_error('The field id user cannot be empty!');
	}
	elseif (post('id_hotel')==''){
	json_error('The field id hotel cannot be empty!');
	}
	else{
	$this->t_reglement_model->Insert(post('numero'),post('montant_dollar'),post('montant_fc'),post('reste'),post('id_mode_regl'),post('date_regl'),post('dte'),post('rejete'),post('id_fact'),post('id_monnaie'),post('id_user'),post('id_hotel'));
	json_send(''.H_ADMIN.'&view=t_reglement&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_reglement_model->SelectOne(get('id_regl'));
	include(APP_FOLDER.'/views/admin/t_reglement/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_regl')==''){
	json_error('The field id_regl cannot be empty!');
	}
	elseif (post('numero')==''){
	json_error('The field numero cannot be empty!');
	}
	elseif (post('montant_dollar')==''){
	json_error('The field montant dollar cannot be empty!');
	}
	elseif (post('montant_fc')==''){
	json_error('The field montant fc cannot be empty!');
	}
	elseif (post('reste')==''){
	json_error('The field reste cannot be empty!');
	}
	elseif (post('id_mode_regl')==''){
	json_error('The field id mode regl cannot be empty!');
	}
	elseif (post('date_regl')==''){
	json_error('The field date regl cannot be empty!');
	}
	elseif (post('dte')==''){
	json_error('The field dte cannot be empty!');
	}
	elseif (post('rejete')==''){
	json_error('The field rejete cannot be empty!');
	}
	elseif (post('id_fact')==''){
	json_error('The field id fact cannot be empty!');
	}
	elseif (post('id_monnaie')==''){
	json_error('The field id monnaie cannot be empty!');
	}
	elseif (post('id_user')==''){
	json_error('The field id user cannot be empty!');
	}
	elseif (post('id_hotel')==''){
	json_error('The field id hotel cannot be empty!');
	}
	else{
	$this->t_reglement_model->Update(post('numero'),post('montant_dollar'),post('montant_fc'),post('reste'),post('id_mode_regl'),post('date_regl'),post('dte'),post('rejete'),post('id_fact'),post('id_monnaie'),post('id_user'),post('id_hotel'),post('id_regl'));
	json_send(''.H_ADMIN.'&view=t_reglement&id_regl='.post('id_regl').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_reglement_model->SelectOne(get('id_regl'));
	include(APP_FOLDER.'/views/admin/t_reglement/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_reglement_model->TruncateTable(''.H_ADMIN.'&view=t_reglement&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_reglement/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_regl') and $dfile==''){
	$del = $this->t_reglement_model->Delete(get('id_regl'),''.H_ADMIN.'&view=t_reglement&do=viewall&msg=delete');
	}
	elseif(get('id_regl') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_reglement_model->Delete(get('id_regl'),''.H_ADMIN.'&view=t_reglement&do=viewall&msg=delete');
	}
	elseif(get('id_regl') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_reglement&id_regl='.get('id_regl').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	