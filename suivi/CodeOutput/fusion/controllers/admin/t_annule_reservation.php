
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_annule_reservation.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_annule_reservation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_annule_reservation.php');
	
	class t_annule_reservation_controller {
	public $t_annule_reservation_model;
	
	public function __construct()  
    {  
        $this->t_annule_reservation_model = new t_annule_reservation_model();
    } 
	
	public function invoke_t_annule_reservation()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_annule_reservation_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_annule_reservation_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_annule_reservation&do=viewall');
	}else{
	$result = $this->t_annule_reservation_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_annule_reservation/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_annule_reservation_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_annule_reservation/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_annule_reservation_model->SelectOne(get('id_annule'));
	include(APP_FOLDER.'/views/admin/t_annule_reservation/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_annule_reservation_model->AutoSearch(trim($qstring),10,'id_res');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_annule_reservation&id_annule='.$srow->id_annule.'&do=details"><li class="list-group-item">'. $srow->id_res.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_annule_reservation/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('id_res')==''){
	json_error('The field id res cannot be empty!');
	}
	elseif (post('id_ch')==''){
	json_error('The field id ch cannot be empty!');
	}
	elseif (post('id_user')==''){
	json_error('The field id user cannot be empty!');
	}
	elseif (post('id_regl')==''){
	json_error('The field id regl cannot be empty!');
	}
	elseif (post('Montant_retirer')==''){
	json_error('The field Montant retirer cannot be empty!');
	}
	elseif (post('monnaie')==''){
	json_error('The field monnaie cannot be empty!');
	}
	elseif (post('poucentage')==''){
	json_error('The field poucentage cannot be empty!');
	}
	elseif (post('mont_remb')==''){
	json_error('The field mont remb cannot be empty!');
	}
	elseif (post('date_annule_res')==''){
	json_error('The field date annule res cannot be empty!');
	}
	elseif (post('date_annule')==''){
	json_error('The field date annule cannot be empty!');
	}
	else{
	$this->t_annule_reservation_model->Insert(post('id_res'),post('id_ch'),post('id_user'),post('id_regl'),post('Montant_retirer'),post('monnaie'),post('poucentage'),post('mont_remb'),post('date_annule_res'),post('date_annule'));
	json_send(''.H_ADMIN.'&view=t_annule_reservation&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_annule_reservation_model->SelectOne(get('id_annule'));
	include(APP_FOLDER.'/views/admin/t_annule_reservation/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_annule')==''){
	json_error('The field id_annule cannot be empty!');
	}
	elseif (post('id_res')==''){
	json_error('The field id res cannot be empty!');
	}
	elseif (post('id_ch')==''){
	json_error('The field id ch cannot be empty!');
	}
	elseif (post('id_user')==''){
	json_error('The field id user cannot be empty!');
	}
	elseif (post('id_regl')==''){
	json_error('The field id regl cannot be empty!');
	}
	elseif (post('Montant_retirer')==''){
	json_error('The field Montant retirer cannot be empty!');
	}
	elseif (post('monnaie')==''){
	json_error('The field monnaie cannot be empty!');
	}
	elseif (post('poucentage')==''){
	json_error('The field poucentage cannot be empty!');
	}
	elseif (post('mont_remb')==''){
	json_error('The field mont remb cannot be empty!');
	}
	elseif (post('date_annule_res')==''){
	json_error('The field date annule res cannot be empty!');
	}
	elseif (post('date_annule')==''){
	json_error('The field date annule cannot be empty!');
	}
	else{
	$this->t_annule_reservation_model->Update(post('id_res'),post('id_ch'),post('id_user'),post('id_regl'),post('Montant_retirer'),post('monnaie'),post('poucentage'),post('mont_remb'),post('date_annule_res'),post('date_annule'),post('id_annule'));
	json_send(''.H_ADMIN.'&view=t_annule_reservation&id_annule='.post('id_annule').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_annule_reservation_model->SelectOne(get('id_annule'));
	include(APP_FOLDER.'/views/admin/t_annule_reservation/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_annule_reservation_model->TruncateTable(''.H_ADMIN.'&view=t_annule_reservation&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_annule_reservation/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_annule') and $dfile==''){
	$del = $this->t_annule_reservation_model->Delete(get('id_annule'),''.H_ADMIN.'&view=t_annule_reservation&do=viewall&msg=delete');
	}
	elseif(get('id_annule') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_annule_reservation_model->Delete(get('id_annule'),''.H_ADMIN.'&view=t_annule_reservation&do=viewall&msg=delete');
	}
	elseif(get('id_annule') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_annule_reservation&id_annule='.get('id_annule').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	