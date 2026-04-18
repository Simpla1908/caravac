
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        resemployefamille.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resemployefamille
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/resemployefamille.php');
	
	class resemployefamille_controller {
	public $resemployefamille_model;
	
	public function __construct()  
    {  
        $this->resemployefamille_model = new resemployefamille_model();
    } 
	
	public function invoke_resemployefamille()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->resemployefamille_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->resemployefamille_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=resemployefamille&do=viewall');
	}else{
	$result = $this->resemployefamille_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/resemployefamille/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->resemployefamille_model->SelectAll();
	include(APP_FOLDER.'/views/admin/resemployefamille/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->resemployefamille_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/resemployefamille/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->resemployefamille_model->AutoSearch(trim($qstring),10,'nom');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=resemployefamille&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->nom.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/resemployefamille/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('nom')==''){
	json_error('The field nom cannot be empty!');
	}
	elseif (post('datenais')==''){
	json_error('The field datenais cannot be empty!');
	}
	elseif (post('type')==''){
	json_error('The field type cannot be empty!');
	}
	elseif (post('employe_id')==''){
	json_error('The field employe id cannot be empty!');
	}
	else{
	$this->resemployefamille_model->Insert(post('nom'),post('datenais'),post('type'),post('employe_id'));
	json_send(''.H_ADMIN.'&view=resemployefamille&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->resemployefamille_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/resemployefamille/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('nom')==''){
	json_error('The field nom cannot be empty!');
	}
	elseif (post('datenais')==''){
	json_error('The field datenais cannot be empty!');
	}
	elseif (post('type')==''){
	json_error('The field type cannot be empty!');
	}
	elseif (post('employe_id')==''){
	json_error('The field employe id cannot be empty!');
	}
	else{
	$this->resemployefamille_model->Update(post('nom'),post('datenais'),post('type'),post('employe_id'),post('id'));
	json_send(''.H_ADMIN.'&view=resemployefamille&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->resemployefamille_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/resemployefamille/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->resemployefamille_model->TruncateTable(''.H_ADMIN.'&view=resemployefamille&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/resemployefamille/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->resemployefamille_model->Delete(get('id'),''.H_ADMIN.'&view=resemployefamille&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->resemployefamille_model->Delete(get('id'),''.H_ADMIN.'&view=resemployefamille&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=resemployefamille&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	