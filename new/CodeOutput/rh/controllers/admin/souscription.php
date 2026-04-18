
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        souscription.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		souscription
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/souscription.php');
	
	class souscription_controller {
	public $souscription_model;
	
	public function __construct()  
    {  
        $this->souscription_model = new souscription_model();
    } 
	
	public function invoke_souscription()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->souscription_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->souscription_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=souscription&do=viewall');
	}else{
	$result = $this->souscription_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/souscription/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->souscription_model->SelectAll();
	include(APP_FOLDER.'/views/admin/souscription/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->souscription_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/souscription/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->souscription_model->AutoSearch(trim($qstring),10,'compagny_id');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=souscription&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->compagny_id.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/souscription/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('compagny_id')==''){
	json_error('The field compagny id cannot be empty!');
	}
	elseif (post('libelle')==''){
	json_error('The field libelle cannot be empty!');
	}
	elseif (post('date_sous')==''){
	json_error('The field date sous cannot be empty!');
	}
	elseif (post('date_activ')==''){
	json_error('The field date activ cannot be empty!');
	}
	elseif (post('mode_paie')==''){
	json_error('The field mode paie cannot be empty!');
	}
	elseif (post('montant_tot_sous')==''){
	json_error('The field montant tot sous cannot be empty!');
	}
	else{
	$this->souscription_model->Insert(post('compagny_id'),post('libelle'),post('date_sous'),post('date_activ'),post('mode_paie'),post('montant_tot_sous'));
	json_send(''.H_ADMIN.'&view=souscription&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->souscription_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/souscription/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('compagny_id')==''){
	json_error('The field compagny id cannot be empty!');
	}
	elseif (post('libelle')==''){
	json_error('The field libelle cannot be empty!');
	}
	elseif (post('date_sous')==''){
	json_error('The field date sous cannot be empty!');
	}
	elseif (post('date_activ')==''){
	json_error('The field date activ cannot be empty!');
	}
	elseif (post('mode_paie')==''){
	json_error('The field mode paie cannot be empty!');
	}
	elseif (post('montant_tot_sous')==''){
	json_error('The field montant tot sous cannot be empty!');
	}
	else{
	$this->souscription_model->Update(post('compagny_id'),post('libelle'),post('date_sous'),post('date_activ'),post('mode_paie'),post('montant_tot_sous'),post('id'));
	json_send(''.H_ADMIN.'&view=souscription&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->souscription_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/souscription/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->souscription_model->TruncateTable(''.H_ADMIN.'&view=souscription&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/souscription/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->souscription_model->Delete(get('id'),''.H_ADMIN.'&view=souscription&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->souscription_model->Delete(get('id'),''.H_ADMIN.'&view=souscription&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=souscription&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	