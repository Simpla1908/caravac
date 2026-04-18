
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        reservation_table.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		reservation_table
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/reservation_table.php');
	
	class reservation_table_controller {
	public $reservation_table_model;
	
	public function __construct()  
    {  
        $this->reservation_table_model = new reservation_table_model();
    } 
	
	public function invoke_reservation_table()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->reservation_table_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->reservation_table_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=reservation_table&do=viewall');
	}else{
	$result = $this->reservation_table_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/reservation_table/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->reservation_table_model->SelectAll();
	include(APP_FOLDER.'/views/admin/reservation_table/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->reservation_table_model->SelectOne(get('id_res_table'));
	include(APP_FOLDER.'/views/admin/reservation_table/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->reservation_table_model->AutoSearch(trim($qstring),10,'date_res_tbl');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=reservation_table&id_res_table='.$srow->id_res_table.'&do=details"><li class="list-group-item">'. $srow->date_res_tbl.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/reservation_table/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('date_res_tbl')==''){
	json_error('The field date res tbl cannot be empty!');
	}
	elseif (post('date_hr_res_tbl')==''){
	json_error('The field date hr res tbl cannot be empty!');
	}
	elseif (post('client_nom')==''){
	json_error('The field client nom cannot be empty!');
	}
	elseif (post('table_id')==''){
	json_error('The field table id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->reservation_table_model->Insert(post('date_res_tbl'),post('date_hr_res_tbl'),post('client_nom'),post('table_id'),post('hotel_id'));
	json_send(''.H_ADMIN.'&view=reservation_table&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->reservation_table_model->SelectOne(get('id_res_table'));
	include(APP_FOLDER.'/views/admin/reservation_table/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_res_table')==''){
	json_error('The field id_res_table cannot be empty!');
	}
	elseif (post('date_res_tbl')==''){
	json_error('The field date res tbl cannot be empty!');
	}
	elseif (post('date_hr_res_tbl')==''){
	json_error('The field date hr res tbl cannot be empty!');
	}
	elseif (post('client_nom')==''){
	json_error('The field client nom cannot be empty!');
	}
	elseif (post('table_id')==''){
	json_error('The field table id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->reservation_table_model->Update(post('date_res_tbl'),post('date_hr_res_tbl'),post('client_nom'),post('table_id'),post('hotel_id'),post('id_res_table'));
	json_send(''.H_ADMIN.'&view=reservation_table&id_res_table='.post('id_res_table').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->reservation_table_model->SelectOne(get('id_res_table'));
	include(APP_FOLDER.'/views/admin/reservation_table/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->reservation_table_model->TruncateTable(''.H_ADMIN.'&view=reservation_table&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/reservation_table/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_res_table') and $dfile==''){
	$del = $this->reservation_table_model->Delete(get('id_res_table'),''.H_ADMIN.'&view=reservation_table&do=viewall&msg=delete');
	}
	elseif(get('id_res_table') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->reservation_table_model->Delete(get('id_res_table'),''.H_ADMIN.'&view=reservation_table&do=viewall&msg=delete');
	}
	elseif(get('id_res_table') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=reservation_table&id_res_table='.get('id_res_table').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	