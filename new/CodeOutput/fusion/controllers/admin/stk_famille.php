
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        stk_famille.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		stk_famille
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/stk_famille.php');
	
	class stk_famille_controller {
	public $stk_famille_model;
	
	public function __construct()  
    {  
        $this->stk_famille_model = new stk_famille_model();
    } 
	
	public function invoke_stk_famille()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->stk_famille_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->stk_famille_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=stk_famille&do=viewall');
	}else{
	$result = $this->stk_famille_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/stk_famille/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->stk_famille_model->SelectAll();
	include(APP_FOLDER.'/views/admin/stk_famille/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->stk_famille_model->SelectOne(get('idfamille'));
	include(APP_FOLDER.'/views/admin/stk_famille/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->stk_famille_model->AutoSearch(trim($qstring),10,'designation');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=stk_famille&idfamille='.$srow->idfamille.'&do=details"><li class="list-group-item">'. $srow->designation.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/stk_famille/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('designation')==''){
	json_error('The field designation cannot be empty!');
	}
	elseif (post('plat')==''){
	json_error('The field plat cannot be empty!');
	}
	elseif (post('affichage')==''){
	json_error('The field affichage cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->stk_famille_model->Insert(post('designation'),post('plat'),post('affichage'),post('hotel_id'));
	json_send(''.H_ADMIN.'&view=stk_famille&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->stk_famille_model->SelectOne(get('idfamille'));
	include(APP_FOLDER.'/views/admin/stk_famille/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('idfamille')==''){
	json_error('The field idfamille cannot be empty!');
	}
	elseif (post('designation')==''){
	json_error('The field designation cannot be empty!');
	}
	elseif (post('plat')==''){
	json_error('The field plat cannot be empty!');
	}
	elseif (post('affichage')==''){
	json_error('The field affichage cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->stk_famille_model->Update(post('designation'),post('plat'),post('affichage'),post('hotel_id'),post('idfamille'));
	json_send(''.H_ADMIN.'&view=stk_famille&idfamille='.post('idfamille').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->stk_famille_model->SelectOne(get('idfamille'));
	include(APP_FOLDER.'/views/admin/stk_famille/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->stk_famille_model->TruncateTable(''.H_ADMIN.'&view=stk_famille&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/stk_famille/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('idfamille') and $dfile==''){
	$del = $this->stk_famille_model->Delete(get('idfamille'),''.H_ADMIN.'&view=stk_famille&do=viewall&msg=delete');
	}
	elseif(get('idfamille') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->stk_famille_model->Delete(get('idfamille'),''.H_ADMIN.'&view=stk_famille&do=viewall&msg=delete');
	}
	elseif(get('idfamille') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=stk_famille&idfamille='.get('idfamille').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	