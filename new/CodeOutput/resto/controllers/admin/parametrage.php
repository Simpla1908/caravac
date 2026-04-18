
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        parametrage.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		parametrage
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/parametrage.php');
	
	class parametrage_controller {
	public $parametrage_model;
	
	public function __construct()  
    {  
        $this->parametrage_model = new parametrage_model();
    } 
	
	public function invoke_parametrage()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->parametrage_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->parametrage_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=parametrage&do=viewall');
	}else{
	$result = $this->parametrage_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/parametrage/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->parametrage_model->SelectAll();
	include(APP_FOLDER.'/views/admin/parametrage/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->parametrage_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/parametrage/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->parametrage_model->AutoSearch(trim($qstring),10,'tva');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=parametrage&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->tva.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/parametrage/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('tva')==''){
	json_error('The field tva cannot be empty!');
	}
	elseif (post('taux')==''){
	json_error('The field taux cannot be empty!');
	}
	else{
	$this->parametrage_model->Insert(post('tva'),post('taux'));
	json_send(''.H_ADMIN.'&view=parametrage&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->parametrage_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/parametrage/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('tva')==''){
	json_error('The field tva cannot be empty!');
	}
	elseif (post('taux')==''){
	json_error('The field taux cannot be empty!');
	}
	else{
	$this->parametrage_model->Update(post('tva'),post('taux'),post('id'));
	json_send(''.H_ADMIN.'&view=parametrage&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->parametrage_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/parametrage/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->parametrage_model->TruncateTable(''.H_ADMIN.'&view=parametrage&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/parametrage/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->parametrage_model->Delete(get('id'),''.H_ADMIN.'&view=parametrage&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->parametrage_model->Delete(get('id'),''.H_ADMIN.'&view=parametrage&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=parametrage&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	