
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        connexion.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		connexion
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/connexion.php');
	
	class connexion_controller {
	public $connexion_model;
	
	public function __construct()  
    {  
        $this->connexion_model = new connexion_model();
    } 
	
	public function invoke_connexion()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->connexion_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->connexion_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=connexion&do=viewall');
	}else{
	$result = $this->connexion_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/connexion/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->connexion_model->SelectAll();
	include(APP_FOLDER.'/views/admin/connexion/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->connexion_model->SelectOne(get('id_con'));
	include(APP_FOLDER.'/views/admin/connexion/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->connexion_model->AutoSearch(trim($qstring),10,'date_con');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=connexion&id_con='.$srow->id_con.'&do=details"><li class="list-group-item">'. $srow->date_con.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/connexion/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('date_con')==''){
	json_error('The field date con cannot be empty!');
	}
	elseif (post('date_decon')==''){
	json_error('The field date decon cannot be empty!');
	}
	elseif (post('id_user')==''){
	json_error('The field id user cannot be empty!');
	}
	else{
	$this->connexion_model->Insert(post('date_con'),post('date_decon'),post('id_user'));
	json_send(''.H_ADMIN.'&view=connexion&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->connexion_model->SelectOne(get('id_con'));
	include(APP_FOLDER.'/views/admin/connexion/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_con')==''){
	json_error('The field id_con cannot be empty!');
	}
	elseif (post('date_con')==''){
	json_error('The field date con cannot be empty!');
	}
	elseif (post('date_decon')==''){
	json_error('The field date decon cannot be empty!');
	}
	elseif (post('id_user')==''){
	json_error('The field id user cannot be empty!');
	}
	else{
	$this->connexion_model->Update(post('date_con'),post('date_decon'),post('id_user'),post('id_con'));
	json_send(''.H_ADMIN.'&view=connexion&id_con='.post('id_con').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->connexion_model->SelectOne(get('id_con'));
	include(APP_FOLDER.'/views/admin/connexion/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->connexion_model->TruncateTable(''.H_ADMIN.'&view=connexion&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/connexion/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_con') and $dfile==''){
	$del = $this->connexion_model->Delete(get('id_con'),''.H_ADMIN.'&view=connexion&do=viewall&msg=delete');
	}
	elseif(get('id_con') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->connexion_model->Delete(get('id_con'),''.H_ADMIN.'&view=connexion&do=viewall&msg=delete');
	}
	elseif(get('id_con') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=connexion&id_con='.get('id_con').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	