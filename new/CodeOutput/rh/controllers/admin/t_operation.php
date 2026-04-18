
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_operation.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_operation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_operation.php');
	
	class t_operation_controller {
	public $t_operation_model;
	
	public function __construct()  
    {  
        $this->t_operation_model = new t_operation_model();
    } 
	
	public function invoke_t_operation()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_operation_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_operation_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_operation&do=viewall');
	}else{
	$result = $this->t_operation_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_operation/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_operation_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_operation/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_operation_model->SelectOne(get('idoperation'));
	include(APP_FOLDER.'/views/admin/t_operation/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_operation_model->AutoSearch(trim($qstring),10,'type');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_operation&idoperation='.$srow->idoperation.'&do=details"><li class="list-group-item">'. $srow->type.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_operation/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('type')==''){
	json_error('The field type cannot be empty!');
	}
	elseif (post('libelle')==''){
	json_error('The field libelle cannot be empty!');
	}
	elseif (post('date_bon')==''){
	json_error('The field date bon cannot be empty!');
	}
	elseif (post('date_heure_bon')==''){
	json_error('The field date heure bon cannot be empty!');
	}
	elseif (post('beneficiaire')==''){
	json_error('The field beneficiaire cannot be empty!');
	}
	elseif (post('provenance')==''){
	json_error('The field provenance cannot be empty!');
	}
	elseif (post('montantFC')==''){
	json_error('The field montantFC cannot be empty!');
	}
	elseif (post('montantUSD')==''){
	json_error('The field montantUSD cannot be empty!');
	}
	elseif (post('numBon')==''){
	json_error('The field numBon cannot be empty!');
	}
	elseif (post('indice_be')==''){
	json_error('The field indice be cannot be empty!');
	}
	elseif (post('indice_bs')==''){
	json_error('The field indice bs cannot be empty!');
	}
	elseif (post('numBordereau')==''){
	json_error('The field numBordereau cannot be empty!');
	}
	elseif (post('mode_operation')==''){
	json_error('The field mode operation cannot be empty!');
	}
	elseif (post('session_id')==''){
	json_error('The field session id cannot be empty!');
	}
	elseif (post('motif_id')==''){
	json_error('The field motif id cannot be empty!');
	}
	elseif (post('user_vers')==''){
	json_error('The field user vers cannot be empty!');
	}
	elseif (post('user_id')==''){
	json_error('The field user id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->t_operation_model->Insert(post('type'),post('libelle'),post('date_bon'),post('date_heure_bon'),post('beneficiaire'),post('provenance'),post('montantFC'),post('montantUSD'),post('numBon'),post('indice_be'),post('indice_bs'),post('numBordereau'),post('mode_operation'),post('session_id'),post('motif_id'),post('user_vers'),post('user_id'),post('hotel_id'));
	json_send(''.H_ADMIN.'&view=t_operation&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_operation_model->SelectOne(get('idoperation'));
	include(APP_FOLDER.'/views/admin/t_operation/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('idoperation')==''){
	json_error('The field idoperation cannot be empty!');
	}
	elseif (post('type')==''){
	json_error('The field type cannot be empty!');
	}
	elseif (post('libelle')==''){
	json_error('The field libelle cannot be empty!');
	}
	elseif (post('date_bon')==''){
	json_error('The field date bon cannot be empty!');
	}
	elseif (post('date_heure_bon')==''){
	json_error('The field date heure bon cannot be empty!');
	}
	elseif (post('beneficiaire')==''){
	json_error('The field beneficiaire cannot be empty!');
	}
	elseif (post('provenance')==''){
	json_error('The field provenance cannot be empty!');
	}
	elseif (post('montantFC')==''){
	json_error('The field montantFC cannot be empty!');
	}
	elseif (post('montantUSD')==''){
	json_error('The field montantUSD cannot be empty!');
	}
	elseif (post('numBon')==''){
	json_error('The field numBon cannot be empty!');
	}
	elseif (post('indice_be')==''){
	json_error('The field indice be cannot be empty!');
	}
	elseif (post('indice_bs')==''){
	json_error('The field indice bs cannot be empty!');
	}
	elseif (post('numBordereau')==''){
	json_error('The field numBordereau cannot be empty!');
	}
	elseif (post('mode_operation')==''){
	json_error('The field mode operation cannot be empty!');
	}
	elseif (post('session_id')==''){
	json_error('The field session id cannot be empty!');
	}
	elseif (post('motif_id')==''){
	json_error('The field motif id cannot be empty!');
	}
	elseif (post('user_vers')==''){
	json_error('The field user vers cannot be empty!');
	}
	elseif (post('user_id')==''){
	json_error('The field user id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->t_operation_model->Update(post('type'),post('libelle'),post('date_bon'),post('date_heure_bon'),post('beneficiaire'),post('provenance'),post('montantFC'),post('montantUSD'),post('numBon'),post('indice_be'),post('indice_bs'),post('numBordereau'),post('mode_operation'),post('session_id'),post('motif_id'),post('user_vers'),post('user_id'),post('hotel_id'),post('idoperation'));
	json_send(''.H_ADMIN.'&view=t_operation&idoperation='.post('idoperation').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_operation_model->SelectOne(get('idoperation'));
	include(APP_FOLDER.'/views/admin/t_operation/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_operation_model->TruncateTable(''.H_ADMIN.'&view=t_operation&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_operation/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('idoperation') and $dfile==''){
	$del = $this->t_operation_model->Delete(get('idoperation'),''.H_ADMIN.'&view=t_operation&do=viewall&msg=delete');
	}
	elseif(get('idoperation') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_operation_model->Delete(get('idoperation'),''.H_ADMIN.'&view=t_operation&do=viewall&msg=delete');
	}
	elseif(get('idoperation') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_operation&idoperation='.get('idoperation').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	