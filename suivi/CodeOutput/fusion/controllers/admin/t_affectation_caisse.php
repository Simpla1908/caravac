
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_affectation_caisse.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_affectation_caisse
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_affectation_caisse.php');
	
	class t_affectation_caisse_controller {
	public $t_affectation_caisse_model;
	
	public function __construct()  
    {  
        $this->t_affectation_caisse_model = new t_affectation_caisse_model();
    } 
	
	public function invoke_t_affectation_caisse()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_affectation_caisse_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_affectation_caisse_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_affectation_caisse&do=viewall');
	}else{
	$result = $this->t_affectation_caisse_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_affectation_caisse/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_affectation_caisse_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_affectation_caisse/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_affectation_caisse_model->SelectOne(get('id_affectation'));
	include(APP_FOLDER.'/views/admin/t_affectation_caisse/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_affectation_caisse_model->AutoSearch(trim($qstring),10,'id_user');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_affectation_caisse&id_affectation='.$srow->id_affectation.'&do=details"><li class="list-group-item">'. $srow->id_user.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_affectation_caisse/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('id_user')==''){
	json_error('The field id user cannot be empty!');
	}
	elseif (post('id_caisse')==''){
	json_error('The field id caisse cannot be empty!');
	}
	elseif (post('date_affect')==''){
	json_error('The field date affect cannot be empty!');
	}
	else{
	$this->t_affectation_caisse_model->Insert(post('id_user'),post('id_caisse'),post('date_affect'));
	json_send(''.H_ADMIN.'&view=t_affectation_caisse&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_affectation_caisse_model->SelectOne(get('id_affectation'));
	include(APP_FOLDER.'/views/admin/t_affectation_caisse/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_affectation')==''){
	json_error('The field id_affectation cannot be empty!');
	}
	elseif (post('id_user')==''){
	json_error('The field id user cannot be empty!');
	}
	elseif (post('id_caisse')==''){
	json_error('The field id caisse cannot be empty!');
	}
	elseif (post('date_affect')==''){
	json_error('The field date affect cannot be empty!');
	}
	else{
	$this->t_affectation_caisse_model->Update(post('id_user'),post('id_caisse'),post('date_affect'),post('id_affectation'));
	json_send(''.H_ADMIN.'&view=t_affectation_caisse&id_affectation='.post('id_affectation').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_affectation_caisse_model->SelectOne(get('id_affectation'));
	include(APP_FOLDER.'/views/admin/t_affectation_caisse/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_affectation_caisse_model->TruncateTable(''.H_ADMIN.'&view=t_affectation_caisse&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_affectation_caisse/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_affectation') and $dfile==''){
	$del = $this->t_affectation_caisse_model->Delete(get('id_affectation'),''.H_ADMIN.'&view=t_affectation_caisse&do=viewall&msg=delete');
	}
	elseif(get('id_affectation') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_affectation_caisse_model->Delete(get('id_affectation'),''.H_ADMIN.'&view=t_affectation_caisse&do=viewall&msg=delete');
	}
	elseif(get('id_affectation') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_affectation_caisse&id_affectation='.get('id_affectation').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	