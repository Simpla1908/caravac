
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_caisse.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_caisse
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_caisse.php');
	
	class t_caisse_controller {
	public $t_caisse_model;
	
	public function __construct()  
    {  
        $this->t_caisse_model = new t_caisse_model();
    } 
	
	public function invoke_t_caisse()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_caisse_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_caisse_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_caisse&do=viewall');
	}else{
	$result = $this->t_caisse_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_caisse/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_caisse_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_caisse/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_caisse_model->SelectOne(get('idcaisse'));
	include(APP_FOLDER.'/views/admin/t_caisse/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_caisse_model->AutoSearch(trim($qstring),10,'libelle');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_caisse&idcaisse='.$srow->idcaisse.'&do=details"><li class="list-group-item">'. $srow->libelle.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_caisse/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('libelle')==''){
	json_error('The field libelle cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->t_caisse_model->Insert(post('libelle'),post('hotel_id'));
	json_send(''.H_ADMIN.'&view=t_caisse&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_caisse_model->SelectOne(get('idcaisse'));
	include(APP_FOLDER.'/views/admin/t_caisse/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('idcaisse')==''){
	json_error('The field idcaisse cannot be empty!');
	}
	elseif (post('libelle')==''){
	json_error('The field libelle cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->t_caisse_model->Update(post('libelle'),post('hotel_id'),post('idcaisse'));
	json_send(''.H_ADMIN.'&view=t_caisse&idcaisse='.post('idcaisse').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_caisse_model->SelectOne(get('idcaisse'));
	include(APP_FOLDER.'/views/admin/t_caisse/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_caisse_model->TruncateTable(''.H_ADMIN.'&view=t_caisse&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_caisse/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('idcaisse') and $dfile==''){
	$del = $this->t_caisse_model->Delete(get('idcaisse'),''.H_ADMIN.'&view=t_caisse&do=viewall&msg=delete');
	}
	elseif(get('idcaisse') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_caisse_model->Delete(get('idcaisse'),''.H_ADMIN.'&view=t_caisse&do=viewall&msg=delete');
	}
	elseif(get('idcaisse') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_caisse&idcaisse='.get('idcaisse').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	