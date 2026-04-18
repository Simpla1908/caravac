
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        monnaie.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		monnaie
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/monnaie.php');
	
	class monnaie_controller {
	public $monnaie_model;
	
	public function __construct()  
    {  
        $this->monnaie_model = new monnaie_model();
    } 
	
	public function invoke_monnaie()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->monnaie_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->monnaie_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=monnaie&do=viewall');
	}else{
	$result = $this->monnaie_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/monnaie/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->monnaie_model->SelectAll();
	include(APP_FOLDER.'/views/admin/monnaie/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->monnaie_model->SelectOne(get('id_monnaie'));
	include(APP_FOLDER.'/views/admin/monnaie/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->monnaie_model->AutoSearch(trim($qstring),10,'monnaie');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=monnaie&id_monnaie='.$srow->id_monnaie.'&do=details"><li class="list-group-item">'. $srow->monnaie.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/monnaie/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('monnaie')==''){
	json_error('The field monnaie cannot be empty!');
	}
	elseif (post('lib_monnaie')==''){
	json_error('The field lib monnaie cannot be empty!');
	}
	elseif (post('symbole')==''){
	json_error('The field symbole cannot be empty!');
	}
	elseif (post('choix')==''){
	json_error('The field choix cannot be empty!');
	}
	elseif (post('taux')==''){
	json_error('The field taux cannot be empty!');
	}
	elseif (post('tva')==''){
	json_error('The field tva cannot be empty!');
	}
	elseif (post('id_hotel')==''){
	json_error('The field id hotel cannot be empty!');
	}
	elseif (post('company_id')==''){
	json_error('The field company id cannot be empty!');
	}
	else{
	$this->monnaie_model->Insert(post('monnaie'),post('lib_monnaie'),post('symbole'),post('choix'),post('taux'),post('tva'),post('id_hotel'),post('company_id'));
	json_send(''.H_ADMIN.'&view=monnaie&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->monnaie_model->SelectOne(get('id_monnaie'));
	include(APP_FOLDER.'/views/admin/monnaie/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_monnaie')==''){
	json_error('The field id_monnaie cannot be empty!');
	}
	elseif (post('monnaie')==''){
	json_error('The field monnaie cannot be empty!');
	}
	elseif (post('lib_monnaie')==''){
	json_error('The field lib monnaie cannot be empty!');
	}
	elseif (post('symbole')==''){
	json_error('The field symbole cannot be empty!');
	}
	elseif (post('choix')==''){
	json_error('The field choix cannot be empty!');
	}
	elseif (post('taux')==''){
	json_error('The field taux cannot be empty!');
	}
	elseif (post('tva')==''){
	json_error('The field tva cannot be empty!');
	}
	elseif (post('id_hotel')==''){
	json_error('The field id hotel cannot be empty!');
	}
	elseif (post('company_id')==''){
	json_error('The field company id cannot be empty!');
	}
	else{
	$this->monnaie_model->Update(post('monnaie'),post('lib_monnaie'),post('symbole'),post('choix'),post('taux'),post('tva'),post('id_hotel'),post('company_id'),post('id_monnaie'));
	json_send(''.H_ADMIN.'&view=monnaie&id_monnaie='.post('id_monnaie').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->monnaie_model->SelectOne(get('id_monnaie'));
	include(APP_FOLDER.'/views/admin/monnaie/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->monnaie_model->TruncateTable(''.H_ADMIN.'&view=monnaie&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/monnaie/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_monnaie') and $dfile==''){
	$del = $this->monnaie_model->Delete(get('id_monnaie'),''.H_ADMIN.'&view=monnaie&do=viewall&msg=delete');
	}
	elseif(get('id_monnaie') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->monnaie_model->Delete(get('id_monnaie'),''.H_ADMIN.'&view=monnaie&do=viewall&msg=delete');
	}
	elseif(get('id_monnaie') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=monnaie&id_monnaie='.get('id_monnaie').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	