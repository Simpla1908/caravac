
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_versement.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_versement
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_versement.php');
	
	class t_versement_controller {
	public $t_versement_model;
	
	public function __construct()  
    {  
        $this->t_versement_model = new t_versement_model();
    } 
	
	public function invoke_t_versement()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_versement_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_versement_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_versement&do=viewall');
	}else{
	$result = $this->t_versement_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_versement/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_versement_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_versement/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_versement_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/t_versement/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_versement_model->AutoSearch(trim($qstring),10,'user_vers');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_versement&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->user_vers.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_versement/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('user_vers')==''){
	json_error('The field user vers cannot be empty!');
	}
	elseif (post('date_vers')==''){
	json_error('The field date vers cannot be empty!');
	}
	elseif (post('montant_vers')==''){
	json_error('The field montant vers cannot be empty!');
	}
	elseif (post('montantusd')==''){
	json_error('The field montantusd cannot be empty!');
	}
	elseif (post('monaie_vers')==''){
	json_error('The field monaie vers cannot be empty!');
	}
	elseif (post('taux')==''){
	json_error('The field taux cannot be empty!');
	}
	elseif (post('motif')==''){
	json_error('The field motif cannot be empty!');
	}
	elseif (post('type_vers')==''){
	json_error('The field type vers cannot be empty!');
	}
	elseif (post('paie_id')==''){
	json_error('The field paie id cannot be empty!');
	}
	elseif (post('id_hotel')==''){
	json_error('The field id hotel cannot be empty!');
	}
	else{
	$this->t_versement_model->Insert(post('user_vers'),post('date_vers'),post('montant_vers'),post('montantusd'),post('monaie_vers'),post('taux'),post('motif'),post('type_vers'),post('paie_id'),post('id_hotel'));
	json_send(''.H_ADMIN.'&view=t_versement&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_versement_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/t_versement/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('user_vers')==''){
	json_error('The field user vers cannot be empty!');
	}
	elseif (post('date_vers')==''){
	json_error('The field date vers cannot be empty!');
	}
	elseif (post('montant_vers')==''){
	json_error('The field montant vers cannot be empty!');
	}
	elseif (post('montantusd')==''){
	json_error('The field montantusd cannot be empty!');
	}
	elseif (post('monaie_vers')==''){
	json_error('The field monaie vers cannot be empty!');
	}
	elseif (post('taux')==''){
	json_error('The field taux cannot be empty!');
	}
	elseif (post('motif')==''){
	json_error('The field motif cannot be empty!');
	}
	elseif (post('type_vers')==''){
	json_error('The field type vers cannot be empty!');
	}
	elseif (post('paie_id')==''){
	json_error('The field paie id cannot be empty!');
	}
	elseif (post('id_hotel')==''){
	json_error('The field id hotel cannot be empty!');
	}
	else{
	$this->t_versement_model->Update(post('user_vers'),post('date_vers'),post('montant_vers'),post('montantusd'),post('monaie_vers'),post('taux'),post('motif'),post('type_vers'),post('paie_id'),post('id_hotel'),post('id'));
	json_send(''.H_ADMIN.'&view=t_versement&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_versement_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/t_versement/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_versement_model->TruncateTable(''.H_ADMIN.'&view=t_versement&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_versement/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->t_versement_model->Delete(get('id'),''.H_ADMIN.'&view=t_versement&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_versement_model->Delete(get('id'),''.H_ADMIN.'&view=t_versement&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_versement&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	