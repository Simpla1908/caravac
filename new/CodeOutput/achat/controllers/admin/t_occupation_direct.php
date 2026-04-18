
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_occupation_direct.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_occupation_direct
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_occupation_direct.php');
	
	class t_occupation_direct_controller {
	public $t_occupation_direct_model;
	
	public function __construct()  
    {  
        $this->t_occupation_direct_model = new t_occupation_direct_model();
    } 
	
	public function invoke_t_occupation_direct()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_occupation_direct_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_occupation_direct_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_occupation_direct&do=viewall');
	}else{
	$result = $this->t_occupation_direct_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_occupation_direct/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_occupation_direct_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_occupation_direct/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_occupation_direct_model->SelectOne(get('id_occ_d'));
	include(APP_FOLDER.'/views/admin/t_occupation_direct/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_occupation_direct_model->AutoSearch(trim($qstring),10,'date_occ_d');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_occupation_direct&id_occ_d='.$srow->id_occ_d.'&do=details"><li class="list-group-item">'. $srow->date_occ_d.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_occupation_direct/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('date_occ_d')==''){
	json_error('The field date occ d cannot be empty!');
	}
	elseif (post('heure_occ_d')==''){
	json_error('The field heure occ d cannot be empty!');
	}
	elseif (post('id_ch')==''){
	json_error('The field id ch cannot be empty!');
	}
	elseif (post('id_client')==''){
	json_error('The field id client cannot be empty!');
	}
	else{
	$this->t_occupation_direct_model->Insert(post('date_occ_d'),post('heure_occ_d'),post('id_ch'),post('id_client'));
	json_send(''.H_ADMIN.'&view=t_occupation_direct&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_occupation_direct_model->SelectOne(get('id_occ_d'));
	include(APP_FOLDER.'/views/admin/t_occupation_direct/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_occ_d')==''){
	json_error('The field id_occ_d cannot be empty!');
	}
	elseif (post('date_occ_d')==''){
	json_error('The field date occ d cannot be empty!');
	}
	elseif (post('heure_occ_d')==''){
	json_error('The field heure occ d cannot be empty!');
	}
	elseif (post('id_ch')==''){
	json_error('The field id ch cannot be empty!');
	}
	elseif (post('id_client')==''){
	json_error('The field id client cannot be empty!');
	}
	else{
	$this->t_occupation_direct_model->Update(post('date_occ_d'),post('heure_occ_d'),post('id_ch'),post('id_client'),post('id_occ_d'));
	json_send(''.H_ADMIN.'&view=t_occupation_direct&id_occ_d='.post('id_occ_d').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_occupation_direct_model->SelectOne(get('id_occ_d'));
	include(APP_FOLDER.'/views/admin/t_occupation_direct/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_occupation_direct_model->TruncateTable(''.H_ADMIN.'&view=t_occupation_direct&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_occupation_direct/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_occ_d') and $dfile==''){
	$del = $this->t_occupation_direct_model->Delete(get('id_occ_d'),''.H_ADMIN.'&view=t_occupation_direct&do=viewall&msg=delete');
	}
	elseif(get('id_occ_d') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_occupation_direct_model->Delete(get('id_occ_d'),''.H_ADMIN.'&view=t_occupation_direct&do=viewall&msg=delete');
	}
	elseif(get('id_occ_d') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_occupation_direct&id_occ_d='.get('id_occ_d').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	