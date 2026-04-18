
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        niveau_chambre.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		niveau_chambre
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/niveau_chambre.php');
	
	class niveau_chambre_controller {
	public $niveau_chambre_model;
	
	public function __construct()  
    {  
        $this->niveau_chambre_model = new niveau_chambre_model();
    } 
	
	public function invoke_niveau_chambre()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->niveau_chambre_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->niveau_chambre_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=niveau_chambre&do=viewall');
	}else{
	$result = $this->niveau_chambre_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/niveau_chambre/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->niveau_chambre_model->SelectAll();
	include(APP_FOLDER.'/views/admin/niveau_chambre/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->niveau_chambre_model->SelectOne(get('id_niv_cha'));
	include(APP_FOLDER.'/views/admin/niveau_chambre/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->niveau_chambre_model->AutoSearch(trim($qstring),10,'lib_niv_cha');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=niveau_chambre&id_niv_cha='.$srow->id_niv_cha.'&do=details"><li class="list-group-item">'. $srow->lib_niv_cha.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/niveau_chambre/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('lib_niv_cha')==''){
	json_error('The field lib niv cha cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->niveau_chambre_model->Insert(post('lib_niv_cha'),post('hotel_id'));
	json_send(''.H_ADMIN.'&view=niveau_chambre&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->niveau_chambre_model->SelectOne(get('id_niv_cha'));
	include(APP_FOLDER.'/views/admin/niveau_chambre/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_niv_cha')==''){
	json_error('The field id_niv_cha cannot be empty!');
	}
	elseif (post('lib_niv_cha')==''){
	json_error('The field lib niv cha cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->niveau_chambre_model->Update(post('lib_niv_cha'),post('hotel_id'),post('id_niv_cha'));
	json_send(''.H_ADMIN.'&view=niveau_chambre&id_niv_cha='.post('id_niv_cha').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->niveau_chambre_model->SelectOne(get('id_niv_cha'));
	include(APP_FOLDER.'/views/admin/niveau_chambre/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->niveau_chambre_model->TruncateTable(''.H_ADMIN.'&view=niveau_chambre&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/niveau_chambre/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_niv_cha') and $dfile==''){
	$del = $this->niveau_chambre_model->Delete(get('id_niv_cha'),''.H_ADMIN.'&view=niveau_chambre&do=viewall&msg=delete');
	}
	elseif(get('id_niv_cha') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->niveau_chambre_model->Delete(get('id_niv_cha'),''.H_ADMIN.'&view=niveau_chambre&do=viewall&msg=delete');
	}
	elseif(get('id_niv_cha') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=niveau_chambre&id_niv_cha='.get('id_niv_cha').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	