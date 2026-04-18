
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_motif.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_motif
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_motif.php');
	
	class t_motif_controller {
	public $t_motif_model;
	
	public function __construct()  
    {  
        $this->t_motif_model = new t_motif_model();
    } 
	
	public function invoke_t_motif()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_motif_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_motif_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_motif&do=viewall');
	}else{
	$result = $this->t_motif_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_motif/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_motif_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_motif/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_motif_model->SelectOne(get('idmotif'));
	include(APP_FOLDER.'/views/admin/t_motif/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_motif_model->AutoSearch(trim($qstring),10,'designation');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_motif&idmotif='.$srow->idmotif.'&do=details"><li class="list-group-item">'. $srow->designation.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_motif/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('designation')==''){
	json_error('The field designation cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	elseif (post('type_id')==''){
	json_error('The field type id cannot be empty!');
	}
	else{
	$this->t_motif_model->Insert(post('designation'),post('hotel_id'),post('type_id'));
	json_send(''.H_ADMIN.'&view=t_motif&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_motif_model->SelectOne(get('idmotif'));
	include(APP_FOLDER.'/views/admin/t_motif/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('idmotif')==''){
	json_error('The field idmotif cannot be empty!');
	}
	elseif (post('designation')==''){
	json_error('The field designation cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	elseif (post('type_id')==''){
	json_error('The field type id cannot be empty!');
	}
	else{
	$this->t_motif_model->Update(post('designation'),post('hotel_id'),post('type_id'),post('idmotif'));
	json_send(''.H_ADMIN.'&view=t_motif&idmotif='.post('idmotif').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_motif_model->SelectOne(get('idmotif'));
	include(APP_FOLDER.'/views/admin/t_motif/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_motif_model->TruncateTable(''.H_ADMIN.'&view=t_motif&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_motif/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('idmotif') and $dfile==''){
	$del = $this->t_motif_model->Delete(get('idmotif'),''.H_ADMIN.'&view=t_motif&do=viewall&msg=delete');
	}
	elseif(get('idmotif') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_motif_model->Delete(get('idmotif'),''.H_ADMIN.'&view=t_motif&do=viewall&msg=delete');
	}
	elseif(get('idmotif') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_motif&idmotif='.get('idmotif').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	