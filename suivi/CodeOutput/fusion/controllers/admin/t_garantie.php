
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_garantie.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_garantie
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_garantie.php');
	
	class t_garantie_controller {
	public $t_garantie_model;
	
	public function __construct()  
    {  
        $this->t_garantie_model = new t_garantie_model();
    } 
	
	public function invoke_t_garantie()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_garantie_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_garantie_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_garantie&do=viewall');
	}else{
	$result = $this->t_garantie_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_garantie/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_garantie_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_garantie/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_garantie_model->SelectOne(get('idgaran'));
	include(APP_FOLDER.'/views/admin/t_garantie/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_garantie_model->AutoSearch(trim($qstring),10,'montantcdf');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_garantie&idgaran='.$srow->idgaran.'&do=details"><li class="list-group-item">'. $srow->montantcdf.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_garantie/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('montantcdf')==''){
	json_error('The field montantcdf cannot be empty!');
	}
	elseif (post('montantusd')==''){
	json_error('The field montantusd cannot be empty!');
	}
	elseif (post('taux')==''){
	json_error('The field taux cannot be empty!');
	}
	elseif (post('dategaran')==''){
	json_error('The field dategaran cannot be empty!');
	}
	elseif (post('reserv_id')==''){
	json_error('The field reserv id cannot be empty!');
	}
	else{
	$this->t_garantie_model->Insert(post('montantcdf'),post('montantusd'),post('taux'),post('dategaran'),post('reserv_id'));
	json_send(''.H_ADMIN.'&view=t_garantie&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_garantie_model->SelectOne(get('idgaran'));
	include(APP_FOLDER.'/views/admin/t_garantie/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('idgaran')==''){
	json_error('The field idgaran cannot be empty!');
	}
	elseif (post('montantcdf')==''){
	json_error('The field montantcdf cannot be empty!');
	}
	elseif (post('montantusd')==''){
	json_error('The field montantusd cannot be empty!');
	}
	elseif (post('taux')==''){
	json_error('The field taux cannot be empty!');
	}
	elseif (post('dategaran')==''){
	json_error('The field dategaran cannot be empty!');
	}
	elseif (post('reserv_id')==''){
	json_error('The field reserv id cannot be empty!');
	}
	else{
	$this->t_garantie_model->Update(post('montantcdf'),post('montantusd'),post('taux'),post('dategaran'),post('reserv_id'),post('idgaran'));
	json_send(''.H_ADMIN.'&view=t_garantie&idgaran='.post('idgaran').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_garantie_model->SelectOne(get('idgaran'));
	include(APP_FOLDER.'/views/admin/t_garantie/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_garantie_model->TruncateTable(''.H_ADMIN.'&view=t_garantie&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_garantie/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('idgaran') and $dfile==''){
	$del = $this->t_garantie_model->Delete(get('idgaran'),''.H_ADMIN.'&view=t_garantie&do=viewall&msg=delete');
	}
	elseif(get('idgaran') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_garantie_model->Delete(get('idgaran'),''.H_ADMIN.'&view=t_garantie&do=viewall&msg=delete');
	}
	elseif(get('idgaran') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_garantie&idgaran='.get('idgaran').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	