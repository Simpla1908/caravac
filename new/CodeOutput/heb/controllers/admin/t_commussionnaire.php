
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_commussionnaire.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_commussionnaire
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_commussionnaire.php');
	
	class t_commussionnaire_controller {
	public $t_commussionnaire_model;
	
	public function __construct()  
    {  
        $this->t_commussionnaire_model = new t_commussionnaire_model();
    } 
	
	public function invoke_t_commussionnaire()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_commussionnaire_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_commussionnaire_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_commussionnaire&do=viewall');
	}else{
	$result = $this->t_commussionnaire_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_commussionnaire/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_commussionnaire_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_commussionnaire/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_commussionnaire_model->SelectOne(get('id_com'));
	include(APP_FOLDER.'/views/admin/t_commussionnaire/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_commussionnaire_model->AutoSearch(trim($qstring),10,'nomcom');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_commussionnaire&id_com='.$srow->id_com.'&do=details"><li class="list-group-item">'. $srow->nomcom.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_commussionnaire/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('nomcom')==''){
	json_error('The field nomcom cannot be empty!');
	}
	elseif (post('sxcom')==''){
	json_error('The field sxcom cannot be empty!');
	}
	elseif (post('contact')==''){
	json_error('The field contact cannot be empty!');
	}
	elseif (post('adr')==''){
	json_error('The field adr cannot be empty!');
	}
	else{
	$this->t_commussionnaire_model->Insert(post('nomcom'),post('sxcom'),post('contact'),post('adr'));
	json_send(''.H_ADMIN.'&view=t_commussionnaire&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_commussionnaire_model->SelectOne(get('id_com'));
	include(APP_FOLDER.'/views/admin/t_commussionnaire/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_com')==''){
	json_error('The field id_com cannot be empty!');
	}
	elseif (post('nomcom')==''){
	json_error('The field nomcom cannot be empty!');
	}
	elseif (post('sxcom')==''){
	json_error('The field sxcom cannot be empty!');
	}
	elseif (post('contact')==''){
	json_error('The field contact cannot be empty!');
	}
	elseif (post('adr')==''){
	json_error('The field adr cannot be empty!');
	}
	else{
	$this->t_commussionnaire_model->Update(post('nomcom'),post('sxcom'),post('contact'),post('adr'),post('id_com'));
	json_send(''.H_ADMIN.'&view=t_commussionnaire&id_com='.post('id_com').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_commussionnaire_model->SelectOne(get('id_com'));
	include(APP_FOLDER.'/views/admin/t_commussionnaire/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_commussionnaire_model->TruncateTable(''.H_ADMIN.'&view=t_commussionnaire&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_commussionnaire/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_com') and $dfile==''){
	$del = $this->t_commussionnaire_model->Delete(get('id_com'),''.H_ADMIN.'&view=t_commussionnaire&do=viewall&msg=delete');
	}
	elseif(get('id_com') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_commussionnaire_model->Delete(get('id_com'),''.H_ADMIN.'&view=t_commussionnaire&do=viewall&msg=delete');
	}
	elseif(get('id_com') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_commussionnaire&id_com='.get('id_com').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	