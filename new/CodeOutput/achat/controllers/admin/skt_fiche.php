
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        skt_fiche.php
	* DATE CREATED:  	29-11-2018
	* FOR TABLE:  		skt_fiche
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/skt_fiche.php');
	
	class skt_fiche_controller {
	public $skt_fiche_model;
	
	public function __construct()  
    {  
        $this->skt_fiche_model = new skt_fiche_model();
    } 
	
	public function invoke_skt_fiche()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->skt_fiche_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->skt_fiche_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=skt_fiche&do=viewall');
	}else{
	$result = $this->skt_fiche_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/skt_fiche/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->skt_fiche_model->SelectAll();
	include(APP_FOLDER.'/views/admin/skt_fiche/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->skt_fiche_model->SelectOne(get('id_fiche'));
	include(APP_FOLDER.'/views/admin/skt_fiche/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->skt_fiche_model->AutoSearch(trim($qstring),10,'numero');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=skt_fiche&id_fiche='.$srow->id_fiche.'&do=details"><li class="list-group-item">'. $srow->numero.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/skt_fiche/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('numero')==''){
	json_error('The field numero cannot be empty!');
	}
	elseif (post('type')==''){
	json_error('The field type cannot be empty!');
	}
	elseif (post('motif')==''){
	json_error('The field motif cannot be empty!');
	}
	elseif (post('beneficiere')==''){
	json_error('The field beneficiere cannot be empty!');
	}
	elseif (post('nbrprod')==''){
	json_error('The field nbrprod cannot be empty!');
	}
	elseif (post('dte')==''){
	json_error('The field dte cannot be empty!');
	}
	elseif (post('dte_time')==''){
	json_error('The field dte time cannot be empty!');
	}
	elseif (post('approuve')==''){
	json_error('The field approuve cannot be empty!');
	}
	elseif (post('depot_id')==''){
	json_error('The field depot id cannot be empty!');
	}
	elseif (post('user_id')==''){
	json_error('The field user id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->skt_fiche_model->Insert(post('numero'),post('type'),post('motif'),post('beneficiere'),post('nbrprod'),post('dte'),post('dte_time'),post('approuve'),post('depot_id'),post('user_id'),post('hotel_id'));
	json_send(''.H_ADMIN.'&view=skt_fiche&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->skt_fiche_model->SelectOne(get('id_fiche'));
	include(APP_FOLDER.'/views/admin/skt_fiche/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_fiche')==''){
	json_error('The field id_fiche cannot be empty!');
	}
	elseif (post('numero')==''){
	json_error('The field numero cannot be empty!');
	}
	elseif (post('type')==''){
	json_error('The field type cannot be empty!');
	}
	elseif (post('motif')==''){
	json_error('The field motif cannot be empty!');
	}
	elseif (post('beneficiere')==''){
	json_error('The field beneficiere cannot be empty!');
	}
	elseif (post('nbrprod')==''){
	json_error('The field nbrprod cannot be empty!');
	}
	elseif (post('dte')==''){
	json_error('The field dte cannot be empty!');
	}
	elseif (post('dte_time')==''){
	json_error('The field dte time cannot be empty!');
	}
	elseif (post('approuve')==''){
	json_error('The field approuve cannot be empty!');
	}
	elseif (post('depot_id')==''){
	json_error('The field depot id cannot be empty!');
	}
	elseif (post('user_id')==''){
	json_error('The field user id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->skt_fiche_model->Update(post('numero'),post('type'),post('motif'),post('beneficiere'),post('nbrprod'),post('dte'),post('dte_time'),post('approuve'),post('depot_id'),post('user_id'),post('hotel_id'),post('id_fiche'));
	json_send(''.H_ADMIN.'&view=skt_fiche&id_fiche='.post('id_fiche').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->skt_fiche_model->SelectOne(get('id_fiche'));
	include(APP_FOLDER.'/views/admin/skt_fiche/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->skt_fiche_model->TruncateTable(''.H_ADMIN.'&view=skt_fiche&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/skt_fiche/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_fiche') and $dfile==''){
	$del = $this->skt_fiche_model->Delete(get('id_fiche'),''.H_ADMIN.'&view=skt_fiche&do=viewall&msg=delete');
	}
	elseif(get('id_fiche') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->skt_fiche_model->Delete(get('id_fiche'),''.H_ADMIN.'&view=skt_fiche&do=viewall&msg=delete');
	}
	elseif(get('id_fiche') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=skt_fiche&id_fiche='.get('id_fiche').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	