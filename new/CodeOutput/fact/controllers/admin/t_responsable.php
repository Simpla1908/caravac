
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_responsable.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_responsable
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_responsable.php');
	
	class t_responsable_controller {
	public $t_responsable_model;
	
	public function __construct()  
    {  
        $this->t_responsable_model = new t_responsable_model();
    } 
	
	public function invoke_t_responsable()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_responsable_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_responsable_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_responsable&do=viewall');
	}else{
	$result = $this->t_responsable_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_responsable/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_responsable_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_responsable/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_responsable_model->SelectOne(get('id_respo'));
	include(APP_FOLDER.'/views/admin/t_responsable/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_responsable_model->AutoSearch(trim($qstring),10,'nom_respo');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_responsable&id_respo='.$srow->id_respo.'&do=details"><li class="list-group-item">'. $srow->nom_respo.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_responsable/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('nom_respo')==''){
	json_error('The field nom respo cannot be empty!');
	}
	elseif (post('telephone_respo')==''){
	json_error('The field telephone respo cannot be empty!');
	}
	elseif (post('adresse_respo')==''){
	json_error('The field adresse respo cannot be empty!');
	}
	elseif (post('entreprise')==''){
	json_error('The field entreprise cannot be empty!');
	}
	elseif (post('filtre')==''){
	json_error('The field filtre cannot be empty!');
	}
	elseif (post('company_id')==''){
	json_error('The field company id cannot be empty!');
	}
	else{
	$this->t_responsable_model->Insert(post('nom_respo'),post('telephone_respo'),post('adresse_respo'),post('entreprise'),post('filtre'),post('company_id'));
	json_send(''.H_ADMIN.'&view=t_responsable&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_responsable_model->SelectOne(get('id_respo'));
	include(APP_FOLDER.'/views/admin/t_responsable/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_respo')==''){
	json_error('The field id_respo cannot be empty!');
	}
	elseif (post('nom_respo')==''){
	json_error('The field nom respo cannot be empty!');
	}
	elseif (post('telephone_respo')==''){
	json_error('The field telephone respo cannot be empty!');
	}
	elseif (post('adresse_respo')==''){
	json_error('The field adresse respo cannot be empty!');
	}
	elseif (post('entreprise')==''){
	json_error('The field entreprise cannot be empty!');
	}
	elseif (post('filtre')==''){
	json_error('The field filtre cannot be empty!');
	}
	elseif (post('company_id')==''){
	json_error('The field company id cannot be empty!');
	}
	else{
	$this->t_responsable_model->Update(post('nom_respo'),post('telephone_respo'),post('adresse_respo'),post('entreprise'),post('filtre'),post('company_id'),post('id_respo'));
	json_send(''.H_ADMIN.'&view=t_responsable&id_respo='.post('id_respo').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_responsable_model->SelectOne(get('id_respo'));
	include(APP_FOLDER.'/views/admin/t_responsable/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_responsable_model->TruncateTable(''.H_ADMIN.'&view=t_responsable&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_responsable/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_respo') and $dfile==''){
	$del = $this->t_responsable_model->Delete(get('id_respo'),''.H_ADMIN.'&view=t_responsable&do=viewall&msg=delete');
	}
	elseif(get('id_respo') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_responsable_model->Delete(get('id_respo'),''.H_ADMIN.'&view=t_responsable&do=viewall&msg=delete');
	}
	elseif(get('id_respo') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_responsable&id_respo='.get('id_respo').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	