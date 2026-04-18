
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        details_chambre.php
	* DATE CREATED:  	25-11-2019
	* FOR TABLE:  		details_chambre
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/details_chambre.php');
	
	class details_chambre_controller {
	public $details_chambre_model;
	
	public function __construct()  
    {  
        $this->details_chambre_model = new details_chambre_model();
    } 
	
	public function invoke_details_chambre()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->details_chambre_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->details_chambre_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=details_chambre&do=viewall');
	}else{
	$result = $this->details_chambre_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/details_chambre/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->details_chambre_model->SelectAll();
	include(APP_FOLDER.'/views/admin/details_chambre/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->details_chambre_model->SelectOne(get('id_detail'));
	include(APP_FOLDER.'/views/admin/details_chambre/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->details_chambre_model->AutoSearch(trim($qstring),10,'icon');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=details_chambre&id_detail='.$srow->id_detail.'&do=details"><li class="list-group-item">'. $srow->icon.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/details_chambre/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('icon')==''){
	json_error('The field icon cannot be empty!');
	}
	elseif (post('designation')==''){
	json_error('The field designation cannot be empty!');
	}
	else{
	$this->details_chambre_model->Insert(post('icon'),post('designation'));
	json_send(''.H_ADMIN.'&view=details_chambre&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->details_chambre_model->SelectOne(get('id_detail'));
	include(APP_FOLDER.'/views/admin/details_chambre/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_detail')==''){
	json_error('The field id_detail cannot be empty!');
	}
	elseif (post('icon')==''){
	json_error('The field icon cannot be empty!');
	}
	elseif (post('designation')==''){
	json_error('The field designation cannot be empty!');
	}
	else{
	$this->details_chambre_model->Update(post('icon'),post('designation'),post('id_detail'));
	json_send(''.H_ADMIN.'&view=details_chambre&id_detail='.post('id_detail').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->details_chambre_model->SelectOne(get('id_detail'));
	include(APP_FOLDER.'/views/admin/details_chambre/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->details_chambre_model->TruncateTable(''.H_ADMIN.'&view=details_chambre&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/details_chambre/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_detail') and $dfile==''){
	$del = $this->details_chambre_model->Delete(get('id_detail'),''.H_ADMIN.'&view=details_chambre&do=viewall&msg=delete');
	}
	elseif(get('id_detail') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->details_chambre_model->Delete(get('id_detail'),''.H_ADMIN.'&view=details_chambre&do=viewall&msg=delete');
	}
	elseif(get('id_detail') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=details_chambre&id_detail='.get('id_detail').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	