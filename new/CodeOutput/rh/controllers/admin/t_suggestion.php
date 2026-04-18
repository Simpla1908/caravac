
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_suggestion.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_suggestion
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_suggestion.php');
	
	class t_suggestion_controller {
	public $t_suggestion_model;
	
	public function __construct()  
    {  
        $this->t_suggestion_model = new t_suggestion_model();
    } 
	
	public function invoke_t_suggestion()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_suggestion_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_suggestion_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_suggestion&do=viewall');
	}else{
	$result = $this->t_suggestion_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_suggestion/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_suggestion_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_suggestion/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_suggestion_model->SelectOne(get('id_sug'));
	include(APP_FOLDER.'/views/admin/t_suggestion/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_suggestion_model->AutoSearch(trim($qstring),10,'datesug');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_suggestion&id_sug='.$srow->id_sug.'&do=details"><li class="list-group-item">'. $srow->datesug.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_suggestion/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('textsug')==''){
	json_error('The field textsug cannot be empty!');
	}
	elseif (post('datesug')==''){
	json_error('The field datesug cannot be empty!');
	}
	elseif (post('statut')==''){
	json_error('The field statut cannot be empty!');
	}
	elseif (post('chambre_id')==''){
	json_error('The field chambre id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	elseif (post('id_util')==''){
	json_error('The field id util cannot be empty!');
	}
	else{
	$this->t_suggestion_model->Insert(post('textsug'),post('datesug'),post('statut'),post('chambre_id'),post('hotel_id'),post('id_util'));
	json_send(''.H_ADMIN.'&view=t_suggestion&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_suggestion_model->SelectOne(get('id_sug'));
	include(APP_FOLDER.'/views/admin/t_suggestion/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_sug')==''){
	json_error('The field id_sug cannot be empty!');
	}
	elseif (post('textsug')==''){
	json_error('The field textsug cannot be empty!');
	}
	elseif (post('datesug')==''){
	json_error('The field datesug cannot be empty!');
	}
	elseif (post('statut')==''){
	json_error('The field statut cannot be empty!');
	}
	elseif (post('chambre_id')==''){
	json_error('The field chambre id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	elseif (post('id_util')==''){
	json_error('The field id util cannot be empty!');
	}
	else{
	$this->t_suggestion_model->Update(post('textsug'),post('datesug'),post('statut'),post('chambre_id'),post('hotel_id'),post('id_util'),post('id_sug'));
	json_send(''.H_ADMIN.'&view=t_suggestion&id_sug='.post('id_sug').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_suggestion_model->SelectOne(get('id_sug'));
	include(APP_FOLDER.'/views/admin/t_suggestion/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_suggestion_model->TruncateTable(''.H_ADMIN.'&view=t_suggestion&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_suggestion/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_sug') and $dfile==''){
	$del = $this->t_suggestion_model->Delete(get('id_sug'),''.H_ADMIN.'&view=t_suggestion&do=viewall&msg=delete');
	}
	elseif(get('id_sug') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_suggestion_model->Delete(get('id_sug'),''.H_ADMIN.'&view=t_suggestion&do=viewall&msg=delete');
	}
	elseif(get('id_sug') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_suggestion&id_sug='.get('id_sug').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	