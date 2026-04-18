
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        compteur.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		compteur
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/compteur.php');
	
	class compteur_controller {
	public $compteur_model;
	
	public function __construct()  
    {  
        $this->compteur_model = new compteur_model();
    } 
	
	public function invoke_compteur()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->compteur_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->compteur_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=compteur&do=viewall');
	}else{
	$result = $this->compteur_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/compteur/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->compteur_model->SelectAll();
	include(APP_FOLDER.'/views/admin/compteur/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->compteur_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/compteur/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->compteur_model->AutoSearch(trim($qstring),10,'libelle');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=compteur&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->libelle.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/compteur/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('libelle')==''){
	json_error('The field libelle cannot be empty!');
	}
	elseif (post('numero')==''){
	json_error('The field numero cannot be empty!');
	}
	elseif (post('site_id')==''){
	json_error('The field site id cannot be empty!');
	}
	else{
	$this->compteur_model->Insert(post('libelle'),post('numero'),post('site_id'));
	json_send(''.H_ADMIN.'&view=compteur&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->compteur_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/compteur/Update.php');
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
	elseif (post('numero')==''){
	json_error('The field numero cannot be empty!');
	}
	elseif (post('site_id')==''){
	json_error('The field site id cannot be empty!');
	}
	else{
	$this->compteur_model->Update(post('libelle'),post('numero'),post('site_id'),post('id'));
	json_send(''.H_ADMIN.'&view=compteur&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->compteur_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/compteur/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->compteur_model->TruncateTable(''.H_ADMIN.'&view=compteur&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/compteur/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->compteur_model->Delete(get('id'),''.H_ADMIN.'&view=compteur&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->compteur_model->Delete(get('id'),''.H_ADMIN.'&view=compteur&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=compteur&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	