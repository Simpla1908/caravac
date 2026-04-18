
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_occupation.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_occupation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_occupation.php');
	
	class t_occupation_controller {
	public $t_occupation_model;
	
	public function __construct()  
    {  
        $this->t_occupation_model = new t_occupation_model();
    } 
	
	public function invoke_t_occupation()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_occupation_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_occupation_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_occupation&do=viewall');
	}else{
	$result = $this->t_occupation_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_occupation/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_occupation_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_occupation/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_occupation_model->SelectOne(get('id_occ'));
	include(APP_FOLDER.'/views/admin/t_occupation/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_occupation_model->AutoSearch(trim($qstring),10,'type_occ');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_occupation&id_occ='.$srow->id_occ.'&do=details"><li class="list-group-item">'. $srow->type_occ.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_occupation/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('type_occ')==''){
	json_error('The field type occ cannot be empty!');
	}
	elseif (post('date_occ')==''){
	json_error('The field date occ cannot be empty!');
	}
	elseif (post('heure_occ')==''){
	json_error('The field heure occ cannot be empty!');
	}
	elseif (post('id_ch')==''){
	json_error('The field id ch cannot be empty!');
	}
	elseif (post('id_client')==''){
	json_error('The field id client cannot be empty!');
	}
	else{
	$this->t_occupation_model->Insert(post('type_occ'),post('date_occ'),post('heure_occ'),post('id_ch'),post('id_client'));
	json_send(''.H_ADMIN.'&view=t_occupation&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_occupation_model->SelectOne(get('id_occ'));
	include(APP_FOLDER.'/views/admin/t_occupation/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_occ')==''){
	json_error('The field id_occ cannot be empty!');
	}
	elseif (post('type_occ')==''){
	json_error('The field type occ cannot be empty!');
	}
	elseif (post('date_occ')==''){
	json_error('The field date occ cannot be empty!');
	}
	elseif (post('heure_occ')==''){
	json_error('The field heure occ cannot be empty!');
	}
	elseif (post('id_ch')==''){
	json_error('The field id ch cannot be empty!');
	}
	elseif (post('id_client')==''){
	json_error('The field id client cannot be empty!');
	}
	else{
	$this->t_occupation_model->Update(post('type_occ'),post('date_occ'),post('heure_occ'),post('id_ch'),post('id_client'),post('id_occ'));
	json_send(''.H_ADMIN.'&view=t_occupation&id_occ='.post('id_occ').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_occupation_model->SelectOne(get('id_occ'));
	include(APP_FOLDER.'/views/admin/t_occupation/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_occupation_model->TruncateTable(''.H_ADMIN.'&view=t_occupation&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_occupation/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_occ') and $dfile==''){
	$del = $this->t_occupation_model->Delete(get('id_occ'),''.H_ADMIN.'&view=t_occupation&do=viewall&msg=delete');
	}
	elseif(get('id_occ') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_occupation_model->Delete(get('id_occ'),''.H_ADMIN.'&view=t_occupation&do=viewall&msg=delete');
	}
	elseif(get('id_occ') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_occupation&id_occ='.get('id_occ').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	