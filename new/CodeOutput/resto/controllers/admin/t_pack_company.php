
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_pack_company.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_pack_company
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_pack_company.php');
	
	class t_pack_company_controller {
	public $t_pack_company_model;
	
	public function __construct()  
    {  
        $this->t_pack_company_model = new t_pack_company_model();
    } 
	
	public function invoke_t_pack_company()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_pack_company_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_pack_company_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_pack_company&do=viewall');
	}else{
	$result = $this->t_pack_company_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_pack_company/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_pack_company_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_pack_company/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_pack_company_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/t_pack_company/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_pack_company_model->AutoSearch(trim($qstring),10,'pack_id');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_pack_company&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->pack_id.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_pack_company/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('pack_id')==''){
	json_error('The field pack id cannot be empty!');
	}
	elseif (post('company_id')==''){
	json_error('The field company id cannot be empty!');
	}
	elseif (post('etat')==''){
	json_error('The field etat cannot be empty!');
	}
	else{
	$this->t_pack_company_model->Insert(post('pack_id'),post('company_id'),post('etat'));
	json_send(''.H_ADMIN.'&view=t_pack_company&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_pack_company_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/t_pack_company/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('pack_id')==''){
	json_error('The field pack id cannot be empty!');
	}
	elseif (post('company_id')==''){
	json_error('The field company id cannot be empty!');
	}
	elseif (post('etat')==''){
	json_error('The field etat cannot be empty!');
	}
	else{
	$this->t_pack_company_model->Update(post('pack_id'),post('company_id'),post('etat'),post('id'));
	json_send(''.H_ADMIN.'&view=t_pack_company&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_pack_company_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/t_pack_company/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_pack_company_model->TruncateTable(''.H_ADMIN.'&view=t_pack_company&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_pack_company/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->t_pack_company_model->Delete(get('id'),''.H_ADMIN.'&view=t_pack_company&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_pack_company_model->Delete(get('id'),''.H_ADMIN.'&view=t_pack_company&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_pack_company&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	