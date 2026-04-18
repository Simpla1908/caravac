
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_mode_reglement.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_mode_reglement
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_mode_reglement.php');
	
	class t_mode_reglement_controller {
	public $t_mode_reglement_model;
	
	public function __construct()  
    {  
        $this->t_mode_reglement_model = new t_mode_reglement_model();
    } 
	
	public function invoke_t_mode_reglement()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_mode_reglement_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_mode_reglement_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_mode_reglement&do=viewall');
	}else{
	$result = $this->t_mode_reglement_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_mode_reglement/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_mode_reglement_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_mode_reglement/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_mode_reglement_model->SelectOne(get('id_mode_regl'));
	include(APP_FOLDER.'/views/admin/t_mode_reglement/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_mode_reglement_model->AutoSearch(trim($qstring),10,'lib');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_mode_reglement&id_mode_regl='.$srow->id_mode_regl.'&do=details"><li class="list-group-item">'. $srow->lib.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_mode_reglement/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('lib')==''){
	json_error('The field lib cannot be empty!');
	}
	else{
	$this->t_mode_reglement_model->Insert(post('lib'));
	json_send(''.H_ADMIN.'&view=t_mode_reglement&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_mode_reglement_model->SelectOne(get('id_mode_regl'));
	include(APP_FOLDER.'/views/admin/t_mode_reglement/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_mode_regl')==''){
	json_error('The field id_mode_regl cannot be empty!');
	}
	elseif (post('lib')==''){
	json_error('The field lib cannot be empty!');
	}
	else{
	$this->t_mode_reglement_model->Update(post('lib'),post('id_mode_regl'));
	json_send(''.H_ADMIN.'&view=t_mode_reglement&id_mode_regl='.post('id_mode_regl').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_mode_reglement_model->SelectOne(get('id_mode_regl'));
	include(APP_FOLDER.'/views/admin/t_mode_reglement/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_mode_reglement_model->TruncateTable(''.H_ADMIN.'&view=t_mode_reglement&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_mode_reglement/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_mode_regl') and $dfile==''){
	$del = $this->t_mode_reglement_model->Delete(get('id_mode_regl'),''.H_ADMIN.'&view=t_mode_reglement&do=viewall&msg=delete');
	}
	elseif(get('id_mode_regl') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_mode_reglement_model->Delete(get('id_mode_regl'),''.H_ADMIN.'&view=t_mode_reglement&do=viewall&msg=delete');
	}
	elseif(get('id_mode_regl') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_mode_reglement&id_mode_regl='.get('id_mode_regl').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	