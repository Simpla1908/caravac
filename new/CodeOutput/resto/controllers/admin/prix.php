
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        prix.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		prix
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/prix.php');
	
	class prix_controller {
	public $prix_model;
	
	public function __construct()  
    {  
        $this->prix_model = new prix_model();
    } 
	
	public function invoke_prix()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->prix_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->prix_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=prix&do=viewall');
	}else{
	$result = $this->prix_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/prix/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->prix_model->SelectAll();
	include(APP_FOLDER.'/views/admin/prix/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->prix_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/prix/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->prix_model->AutoSearch(trim($qstring),10,'module_id');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=prix&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->module_id.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/prix/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('module_id')==''){
	json_error('The field module id cannot be empty!');
	}
	elseif (post('souscription')==''){
	json_error('The field souscription cannot be empty!');
	}
	elseif (post('prix_user')==''){
	json_error('The field prix user cannot be empty!');
	}
	elseif (post('prix_par_user')==''){
	json_error('The field prix par user cannot be empty!');
	}
	else{
	$this->prix_model->Insert(post('module_id'),post('souscription'),post('prix_user'),post('prix_par_user'));
	json_send(''.H_ADMIN.'&view=prix&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->prix_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/prix/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('module_id')==''){
	json_error('The field module id cannot be empty!');
	}
	elseif (post('souscription')==''){
	json_error('The field souscription cannot be empty!');
	}
	elseif (post('prix_user')==''){
	json_error('The field prix user cannot be empty!');
	}
	elseif (post('prix_par_user')==''){
	json_error('The field prix par user cannot be empty!');
	}
	else{
	$this->prix_model->Update(post('module_id'),post('souscription'),post('prix_user'),post('prix_par_user'),post('id'));
	json_send(''.H_ADMIN.'&view=prix&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->prix_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/prix/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->prix_model->TruncateTable(''.H_ADMIN.'&view=prix&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/prix/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->prix_model->Delete(get('id'),''.H_ADMIN.'&view=prix&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->prix_model->Delete(get('id'),''.H_ADMIN.'&view=prix&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=prix&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	