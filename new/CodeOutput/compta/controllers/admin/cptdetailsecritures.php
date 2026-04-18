
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        cptdetailsecritures.php
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		cptdetailsecritures
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/cptdetailsecritures.php');
	
	class cptdetailsecritures_controller {
	public $cptdetailsecritures_model;
	
	public function __construct()  
    {  
        $this->cptdetailsecritures_model = new cptdetailsecritures_model();
    } 
	
	public function invoke_cptdetailsecritures()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->cptdetailsecritures_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->cptdetailsecritures_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=cptdetailsecritures&do=viewall');
	}else{
	$result = $this->cptdetailsecritures_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/cptdetailsecritures/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->cptdetailsecritures_model->SelectAll();
	include(APP_FOLDER.'/views/admin/cptdetailsecritures/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->cptdetailsecritures_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/cptdetailsecritures/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->cptdetailsecritures_model->AutoSearch(trim($qstring),10,'compte_id');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=cptdetailsecritures&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->compte_id.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/cptdetailsecritures/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('compte_id')==''){
	json_error('The field compte id cannot be empty!');
	}
	elseif (post('debit')==''){
	json_error('The field debit cannot be empty!');
	}
	elseif (post('credit')==''){
	json_error('The field credit cannot be empty!');
	}
	elseif (post('libelle')==''){
	json_error('The field libelle cannot be empty!');
	}
	elseif (post('numdoc')==''){
	json_error('The field numdoc cannot be empty!');
	}
	elseif (post('ecriture_id')==''){
	json_error('The field ecriture id cannot be empty!');
	}
	elseif (post('site_id')==''){
	json_error('The field site id cannot be empty!');
	}
	else{
	$this->cptdetailsecritures_model->Insert(post('compte_id'),post('debit'),post('credit'),post('libelle'),post('numdoc'),post('ecriture_id'),post('site_id'));
	json_send(''.H_ADMIN.'&view=cptdetailsecritures&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->cptdetailsecritures_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/cptdetailsecritures/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('compte_id')==''){
	json_error('The field compte id cannot be empty!');
	}
	elseif (post('debit')==''){
	json_error('The field debit cannot be empty!');
	}
	elseif (post('credit')==''){
	json_error('The field credit cannot be empty!');
	}
	elseif (post('libelle')==''){
	json_error('The field libelle cannot be empty!');
	}
	elseif (post('numdoc')==''){
	json_error('The field numdoc cannot be empty!');
	}
	elseif (post('ecriture_id')==''){
	json_error('The field ecriture id cannot be empty!');
	}
	elseif (post('site_id')==''){
	json_error('The field site id cannot be empty!');
	}
	else{
	$this->cptdetailsecritures_model->Update(post('compte_id'),post('debit'),post('credit'),post('libelle'),post('numdoc'),post('ecriture_id'),post('site_id'),post('id'));
	json_send(''.H_ADMIN.'&view=cptdetailsecritures&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->cptdetailsecritures_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/cptdetailsecritures/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->cptdetailsecritures_model->TruncateTable(''.H_ADMIN.'&view=cptdetailsecritures&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/cptdetailsecritures/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->cptdetailsecritures_model->Delete(get('id'),''.H_ADMIN.'&view=cptdetailsecritures&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->cptdetailsecritures_model->Delete(get('id'),''.H_ADMIN.'&view=cptdetailsecritures&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=cptdetailsecritures&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	