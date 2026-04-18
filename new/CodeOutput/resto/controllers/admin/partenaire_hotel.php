
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        partenaire_hotel.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		partenaire_hotel
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/partenaire_hotel.php');
	
	class partenaire_hotel_controller {
	public $partenaire_hotel_model;
	
	public function __construct()  
    {  
        $this->partenaire_hotel_model = new partenaire_hotel_model();
    } 
	
	public function invoke_partenaire_hotel()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->partenaire_hotel_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->partenaire_hotel_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=partenaire_hotel&do=viewall');
	}else{
	$result = $this->partenaire_hotel_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/partenaire_hotel/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->partenaire_hotel_model->SelectAll();
	include(APP_FOLDER.'/views/admin/partenaire_hotel/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->partenaire_hotel_model->SelectOne(get('id_part_hotel'));
	include(APP_FOLDER.'/views/admin/partenaire_hotel/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->partenaire_hotel_model->AutoSearch(trim($qstring),10,'partenaire_id');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=partenaire_hotel&id_part_hotel='.$srow->id_part_hotel.'&do=details"><li class="list-group-item">'. $srow->partenaire_id.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/partenaire_hotel/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('partenaire_id')==''){
	json_error('The field partenaire id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->partenaire_hotel_model->Insert(post('partenaire_id'),post('hotel_id'));
	json_send(''.H_ADMIN.'&view=partenaire_hotel&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->partenaire_hotel_model->SelectOne(get('id_part_hotel'));
	include(APP_FOLDER.'/views/admin/partenaire_hotel/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_part_hotel')==''){
	json_error('The field id_part_hotel cannot be empty!');
	}
	elseif (post('partenaire_id')==''){
	json_error('The field partenaire id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->partenaire_hotel_model->Update(post('partenaire_id'),post('hotel_id'),post('id_part_hotel'));
	json_send(''.H_ADMIN.'&view=partenaire_hotel&id_part_hotel='.post('id_part_hotel').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->partenaire_hotel_model->SelectOne(get('id_part_hotel'));
	include(APP_FOLDER.'/views/admin/partenaire_hotel/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->partenaire_hotel_model->TruncateTable(''.H_ADMIN.'&view=partenaire_hotel&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/partenaire_hotel/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_part_hotel') and $dfile==''){
	$del = $this->partenaire_hotel_model->Delete(get('id_part_hotel'),''.H_ADMIN.'&view=partenaire_hotel&do=viewall&msg=delete');
	}
	elseif(get('id_part_hotel') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->partenaire_hotel_model->Delete(get('id_part_hotel'),''.H_ADMIN.'&view=partenaire_hotel&do=viewall&msg=delete');
	}
	elseif(get('id_part_hotel') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=partenaire_hotel&id_part_hotel='.get('id_part_hotel').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	