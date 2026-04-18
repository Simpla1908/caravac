
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        cptclasses.php
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		cptclasses
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/cptclasses.php');
	
	class cptclasses_controller {
	public $cptclasses_model;
	
	public function __construct()  
    {  
        $this->cptclasses_model = new cptclasses_model();
    } 
	
	public function invoke_cptclasses()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->cptclasses_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->cptclasses_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=cptclasses&do=viewall');
	}else{
	$result = $this->cptclasses_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/cptclasses/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->cptclasses_model->SelectAll();
	include(APP_FOLDER.'/views/admin/cptclasses/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->cptclasses_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/cptclasses/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->cptclasses_model->AutoSearch(trim($qstring),10,'libelle');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=cptclasses&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->libelle.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/cptclasses/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('libelle')==''){
	json_error('The field libelle cannot be empty!');
	}
	elseif (post('libelle2')==''){
	json_error('The field libelle2 cannot be empty!');
	}
	elseif (post('numero')==''){
	json_error('The field numero cannot be empty!');
	}
	elseif (post('etat')==''){
	json_error('The field etat cannot be empty!');
	}
	else{
	$this->cptclasses_model->Insert(post('libelle'),post('libelle2'),post('numero'),post('etat'));
	json_send(''.H_ADMIN.'&view=cptclasses&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->cptclasses_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/cptclasses/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('libelle')==''){
	json_error('The field libelle cannot be empty!');
	}
	elseif (post('libelle2')==''){
	json_error('The field libelle2 cannot be empty!');
	}
	elseif (post('numero')==''){
	json_error('The field numero cannot be empty!');
	}
	elseif (post('etat')==''){
	json_error('The field etat cannot be empty!');
	}
	else{
	$this->cptclasses_model->Update(post('libelle'),post('libelle2'),post('numero'),post('etat'),post('id'));
	json_send(''.H_ADMIN.'&view=cptclasses&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->cptclasses_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/cptclasses/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->cptclasses_model->TruncateTable(''.H_ADMIN.'&view=cptclasses&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/cptclasses/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->cptclasses_model->Delete(get('id'),''.H_ADMIN.'&view=cptclasses&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->cptclasses_model->Delete(get('id'),''.H_ADMIN.'&view=cptclasses&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=cptclasses&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	