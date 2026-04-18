
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        details_categorie.php
	* DATE CREATED:  	25-11-2019
	* FOR TABLE:  		details_categorie
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/details_categorie.php');
	
	class details_categorie_controller {
	public $details_categorie_model;
	
	public function __construct()  
    {  
        $this->details_categorie_model = new details_categorie_model();
    } 
	
	public function invoke_details_categorie()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
            $result = $this->details_categorie_model->SelectAll();
            include(APP_FOLDER.'/views/admin/details_categorie/View.php');
	
        }
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->details_categorie_model->SelectAll();
	include(APP_FOLDER.'/views/admin/details_categorie/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->details_categorie_model->SelectOne(get('id_detail_cat'));
	include(APP_FOLDER.'/views/admin/details_categorie/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->details_categorie_model->AutoSearch(trim($qstring),10,'categorie_id');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=details_categorie&id_detail_cat='.$srow->id_detail_cat.'&do=details"><li class="list-group-item">'. $srow->categorie_id.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/details_categorie/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('categorie_id')==''){
	json_error('The field categorie id cannot be empty!');
	}
	elseif (post('details_ch_id')==''){
	json_error('The field details ch id cannot be empty!');
	}
	else{
	$this->details_categorie_model->Insert(post('categorie_id'),post('details_ch_id'));
	json_send(''.H_ADMIN.'&view=details_categorie&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->details_categorie_model->SelectOne(get('id_detail_cat'));
	include(APP_FOLDER.'/views/admin/details_categorie/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_detail_cat')==''){
	json_error('The field id_detail_cat cannot be empty!');
	}
	elseif (post('categorie_id')==''){
	json_error('The field categorie id cannot be empty!');
	}
	elseif (post('details_ch_id')==''){
	json_error('The field details ch id cannot be empty!');
	}
	else{
	$this->details_categorie_model->Update(post('categorie_id'),post('details_ch_id'),post('id_detail_cat'));
	json_send(''.H_ADMIN.'&view=details_categorie&id_detail_cat='.post('id_detail_cat').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->details_categorie_model->SelectOne(get('id_detail_cat'));
	include(APP_FOLDER.'/views/admin/details_categorie/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->details_categorie_model->TruncateTable(''.H_ADMIN.'&view=details_categorie&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/details_categorie/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_detail_cat') and $dfile==''){
	$del = $this->details_categorie_model->Delete(get('id_detail_cat'),''.H_ADMIN.'&view=details_categorie&do=viewall&msg=delete');
	}
	elseif(get('id_detail_cat') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->details_categorie_model->Delete(get('id_detail_cat'),''.H_ADMIN.'&view=details_categorie&do=viewall&msg=delete');
	}
	elseif(get('id_detail_cat') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=details_categorie&id_detail_cat='.get('id_detail_cat').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	