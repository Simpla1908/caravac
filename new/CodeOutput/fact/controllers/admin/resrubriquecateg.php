
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        resrubriquecateg.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resrubriquecateg
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/resrubriquecateg.php');
	
	class resrubriquecateg_controller {
	public $resrubriquecateg_model;
	
	public function __construct()  
    {  
        $this->resrubriquecateg_model = new resrubriquecateg_model();
    } 
	
	public function invoke_resrubriquecateg()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->resrubriquecateg_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->resrubriquecateg_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=resrubriquecateg&do=viewall');
	}else{
	$result = $this->resrubriquecateg_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/resrubriquecateg/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->resrubriquecateg_model->SelectAll();
	include(APP_FOLDER.'/views/admin/resrubriquecateg/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->resrubriquecateg_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/resrubriquecateg/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->resrubriquecateg_model->AutoSearch(trim($qstring),10,'rubrique_id');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=resrubriquecateg&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->rubrique_id.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/resrubriquecateg/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('rubrique_id')==''){
	json_error('The field rubrique id cannot be empty!');
	}
	elseif (post('categorie_id')==''){
	json_error('The field categorie id cannot be empty!');
	}
	elseif (post('salbase')==''){
	json_error('The field salbase cannot be empty!');
	}
	elseif (post('nbrenf')==''){
	json_error('The field nbrenf cannot be empty!');
	}
	elseif (post('salbrut')==''){
	json_error('The field salbrut cannot be empty!');
	}
	elseif (post('manuel')==''){
	json_error('The field manuel cannot be empty!');
	}
	elseif (post('pourcentage')==''){
	json_error('The field pourcentage cannot be empty!');
	}
	elseif (post('imposable')==''){
	json_error('The field imposable cannot be empty!');
	}
	elseif (post('valeur')==''){
	json_error('The field valeur cannot be empty!');
	}
	else{
	$this->resrubriquecateg_model->Insert(post('rubrique_id'),post('categorie_id'),post('salbase'),post('nbrenf'),post('salbrut'),post('manuel'),post('pourcentage'),post('imposable'),post('valeur'));
	json_send(''.H_ADMIN.'&view=resrubriquecateg&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->resrubriquecateg_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/resrubriquecateg/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('rubrique_id')==''){
	json_error('The field rubrique id cannot be empty!');
	}
	elseif (post('categorie_id')==''){
	json_error('The field categorie id cannot be empty!');
	}
	elseif (post('salbase')==''){
	json_error('The field salbase cannot be empty!');
	}
	elseif (post('nbrenf')==''){
	json_error('The field nbrenf cannot be empty!');
	}
	elseif (post('salbrut')==''){
	json_error('The field salbrut cannot be empty!');
	}
	elseif (post('manuel')==''){
	json_error('The field manuel cannot be empty!');
	}
	elseif (post('pourcentage')==''){
	json_error('The field pourcentage cannot be empty!');
	}
	elseif (post('imposable')==''){
	json_error('The field imposable cannot be empty!');
	}
	elseif (post('valeur')==''){
	json_error('The field valeur cannot be empty!');
	}
	else{
	$this->resrubriquecateg_model->Update(post('rubrique_id'),post('categorie_id'),post('salbase'),post('nbrenf'),post('salbrut'),post('manuel'),post('pourcentage'),post('imposable'),post('valeur'),post('id'));
	json_send(''.H_ADMIN.'&view=resrubriquecateg&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->resrubriquecateg_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/resrubriquecateg/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->resrubriquecateg_model->TruncateTable(''.H_ADMIN.'&view=resrubriquecateg&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/resrubriquecateg/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->resrubriquecateg_model->Delete(get('id'),''.H_ADMIN.'&view=resrubriquecateg&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->resrubriquecateg_model->Delete(get('id'),''.H_ADMIN.'&view=resrubriquecateg&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=resrubriquecateg&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	