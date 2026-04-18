
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_liberation.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_liberation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_liberation.php');
	
	class t_liberation_controller {
	public $t_liberation_model;
	
	public function __construct()  
    {  
        $this->t_liberation_model = new t_liberation_model();
    } 
	
	public function invoke_t_liberation()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_liberation_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_liberation_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_liberation&do=viewall');
	}else{
	$result = $this->t_liberation_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_liberation/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_liberation_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_liberation/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_liberation_model->SelectOne(get('id_lib'));
	include(APP_FOLDER.'/views/admin/t_liberation/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_liberation_model->AutoSearch(trim($qstring),10,'date_lib');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_liberation&id_lib='.$srow->id_lib.'&do=details"><li class="list-group-item">'. $srow->date_lib.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_liberation/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('date_lib')==''){
	json_error('The field date lib cannot be empty!');
	}
	elseif (post('heure_lib')==''){
	json_error('The field heure lib cannot be empty!');
	}
	elseif (post('id_ch')==''){
	json_error('The field id ch cannot be empty!');
	}
	elseif (post('id_client')==''){
	json_error('The field id client cannot be empty!');
	}
	elseif (post('id_hotel')==''){
	json_error('The field id hotel cannot be empty!');
	}
	elseif (post('id_res')==''){
	json_error('The field id res cannot be empty!');
	}
	elseif (post('id_reser_cham')==''){
	json_error('The field id reser cham cannot be empty!');
	}
	elseif (post('id_user')==''){
	json_error('The field id user cannot be empty!');
	}
	elseif (post('dte_lib')==''){
	json_error('The field dte lib cannot be empty!');
	}
	else{
	$this->t_liberation_model->Insert(post('date_lib'),post('heure_lib'),post('id_ch'),post('id_client'),post('id_hotel'),post('id_res'),post('id_reser_cham'),post('id_user'),post('dte_lib'));
	json_send(''.H_ADMIN.'&view=t_liberation&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_liberation_model->SelectOne(get('id_lib'));
	include(APP_FOLDER.'/views/admin/t_liberation/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_lib')==''){
	json_error('The field id_lib cannot be empty!');
	}
	elseif (post('date_lib')==''){
	json_error('The field date lib cannot be empty!');
	}
	elseif (post('heure_lib')==''){
	json_error('The field heure lib cannot be empty!');
	}
	elseif (post('id_ch')==''){
	json_error('The field id ch cannot be empty!');
	}
	elseif (post('id_client')==''){
	json_error('The field id client cannot be empty!');
	}
	elseif (post('id_hotel')==''){
	json_error('The field id hotel cannot be empty!');
	}
	elseif (post('id_res')==''){
	json_error('The field id res cannot be empty!');
	}
	elseif (post('id_reser_cham')==''){
	json_error('The field id reser cham cannot be empty!');
	}
	elseif (post('id_user')==''){
	json_error('The field id user cannot be empty!');
	}
	elseif (post('dte_lib')==''){
	json_error('The field dte lib cannot be empty!');
	}
	else{
	$this->t_liberation_model->Update(post('date_lib'),post('heure_lib'),post('id_ch'),post('id_client'),post('id_hotel'),post('id_res'),post('id_reser_cham'),post('id_user'),post('dte_lib'),post('id_lib'));
	json_send(''.H_ADMIN.'&view=t_liberation&id_lib='.post('id_lib').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_liberation_model->SelectOne(get('id_lib'));
	include(APP_FOLDER.'/views/admin/t_liberation/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_liberation_model->TruncateTable(''.H_ADMIN.'&view=t_liberation&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_liberation/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_lib') and $dfile==''){
	$del = $this->t_liberation_model->Delete(get('id_lib'),''.H_ADMIN.'&view=t_liberation&do=viewall&msg=delete');
	}
	elseif(get('id_lib') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_liberation_model->Delete(get('id_lib'),''.H_ADMIN.'&view=t_liberation&do=viewall&msg=delete');
	}
	elseif(get('id_lib') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_liberation&id_lib='.get('id_lib').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	