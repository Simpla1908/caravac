
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_motif_type.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_motif_type
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_motif_type.php');
	
	class t_motif_type_controller {
	public $t_motif_type_model;
	
	public function __construct()  
    {  
        $this->t_motif_type_model = new t_motif_type_model();
    } 
	
	public function invoke_t_motif_type()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_motif_type_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_motif_type_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_motif_type&do=viewall');
	}else{
	$result = $this->t_motif_type_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_motif_type/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_motif_type_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_motif_type/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_motif_type_model->SelectOne(get('idmotiftype'));
	include(APP_FOLDER.'/views/admin/t_motif_type/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_motif_type_model->AutoSearch(trim($qstring),10,'type');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_motif_type&idmotiftype='.$srow->idmotiftype.'&do=details"><li class="list-group-item">'. $srow->type.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_motif_type/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('type')==''){
	json_error('The field type cannot be empty!');
	}
	elseif (post('visible')==''){
	json_error('The field visible cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->t_motif_type_model->Insert(post('type'),post('visible'),post('hotel_id'));
	json_send(''.H_ADMIN.'&view=t_motif_type&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_motif_type_model->SelectOne(get('idmotiftype'));
	include(APP_FOLDER.'/views/admin/t_motif_type/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('idmotiftype')==''){
	json_error('The field idmotiftype cannot be empty!');
	}
	elseif (post('type')==''){
	json_error('The field type cannot be empty!');
	}
	elseif (post('visible')==''){
	json_error('The field visible cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->t_motif_type_model->Update(post('type'),post('visible'),post('hotel_id'),post('idmotiftype'));
	json_send(''.H_ADMIN.'&view=t_motif_type&idmotiftype='.post('idmotiftype').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_motif_type_model->SelectOne(get('idmotiftype'));
	include(APP_FOLDER.'/views/admin/t_motif_type/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_motif_type_model->TruncateTable(''.H_ADMIN.'&view=t_motif_type&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_motif_type/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('idmotiftype') and $dfile==''){
	$del = $this->t_motif_type_model->Delete(get('idmotiftype'),''.H_ADMIN.'&view=t_motif_type&do=viewall&msg=delete');
	}
	elseif(get('idmotiftype') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_motif_type_model->Delete(get('idmotiftype'),''.H_ADMIN.'&view=t_motif_type&do=viewall&msg=delete');
	}
	elseif(get('idmotiftype') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_motif_type&idmotiftype='.get('idmotiftype').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	