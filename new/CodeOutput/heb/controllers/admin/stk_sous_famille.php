
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        stk_sous_famille.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		stk_sous_famille
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/stk_sous_famille.php');
	
	class stk_sous_famille_controller {
	public $stk_sous_famille_model;
	
	public function __construct()  
    {  
        $this->stk_sous_famille_model = new stk_sous_famille_model();
    } 
	
	public function invoke_stk_sous_famille()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->stk_sous_famille_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->stk_sous_famille_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=stk_sous_famille&do=viewall');
	}else{
	$result = $this->stk_sous_famille_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/stk_sous_famille/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->stk_sous_famille_model->SelectAll();
	include(APP_FOLDER.'/views/admin/stk_sous_famille/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->stk_sous_famille_model->SelectOne(get('id_s_fam'));
	include(APP_FOLDER.'/views/admin/stk_sous_famille/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->stk_sous_famille_model->AutoSearch(trim($qstring),10,'des');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=stk_sous_famille&id_s_fam='.$srow->id_s_fam.'&do=details"><li class="list-group-item">'. $srow->des.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/stk_sous_famille/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('des')==''){
	json_error('The field des cannot be empty!');
	}
	elseif (post('famille')==''){
	json_error('The field famille cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->stk_sous_famille_model->Insert(post('des'),post('famille'),post('hotel_id'));
	json_send(''.H_ADMIN.'&view=stk_sous_famille&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->stk_sous_famille_model->SelectOne(get('id_s_fam'));
	include(APP_FOLDER.'/views/admin/stk_sous_famille/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_s_fam')==''){
	json_error('The field id_s_fam cannot be empty!');
	}
	elseif (post('des')==''){
	json_error('The field des cannot be empty!');
	}
	elseif (post('famille')==''){
	json_error('The field famille cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->stk_sous_famille_model->Update(post('des'),post('famille'),post('hotel_id'),post('id_s_fam'));
	json_send(''.H_ADMIN.'&view=stk_sous_famille&id_s_fam='.post('id_s_fam').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->stk_sous_famille_model->SelectOne(get('id_s_fam'));
	include(APP_FOLDER.'/views/admin/stk_sous_famille/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->stk_sous_famille_model->TruncateTable(''.H_ADMIN.'&view=stk_sous_famille&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/stk_sous_famille/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_s_fam') and $dfile==''){
	$del = $this->stk_sous_famille_model->Delete(get('id_s_fam'),''.H_ADMIN.'&view=stk_sous_famille&do=viewall&msg=delete');
	}
	elseif(get('id_s_fam') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->stk_sous_famille_model->Delete(get('id_s_fam'),''.H_ADMIN.'&view=stk_sous_famille&do=viewall&msg=delete');
	}
	elseif(get('id_s_fam') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=stk_sous_famille&id_s_fam='.get('id_s_fam').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	