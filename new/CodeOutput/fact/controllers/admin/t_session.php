
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_session.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_session
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_session.php');
	
	class t_session_controller {
	public $t_session_model;
	
	public function __construct()  
    {  
        $this->t_session_model = new t_session_model();
    } 
	
	public function invoke_t_session()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_session_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_session_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_session&do=viewall');
	}else{
	$result = $this->t_session_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_session/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_session_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_session/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_session_model->SelectOne(get('idsession'));
	include(APP_FOLDER.'/views/admin/t_session/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_session_model->AutoSearch(trim($qstring),10,'date_ouverture');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_session&idsession='.$srow->idsession.'&do=details"><li class="list-group-item">'. $srow->date_ouverture.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_session/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('date_ouverture')==''){
	json_error('The field date ouverture cannot be empty!');
	}
	elseif (post('date_fermeture')==''){
	json_error('The field date fermeture cannot be empty!');
	}
	elseif (post('statut')==''){
	json_error('The field statut cannot be empty!');
	}
	elseif (post('dte_heure_ouvert')==''){
	json_error('The field dte heure ouvert cannot be empty!');
	}
	elseif (post('dte_heure_ferm')==''){
	json_error('The field dte heure ferm cannot be empty!');
	}
	elseif (post('user_id')==''){
	json_error('The field user id cannot be empty!');
	}
	elseif (post('caisse_id')==''){
	json_error('The field caisse id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->t_session_model->Insert(post('date_ouverture'),post('date_fermeture'),post('statut'),post('dte_heure_ouvert'),post('dte_heure_ferm'),post('user_id'),post('caisse_id'),post('hotel_id'));
	json_send(''.H_ADMIN.'&view=t_session&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_session_model->SelectOne(get('idsession'));
	include(APP_FOLDER.'/views/admin/t_session/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('idsession')==''){
	json_error('The field idsession cannot be empty!');
	}
	elseif (post('date_ouverture')==''){
	json_error('The field date ouverture cannot be empty!');
	}
	elseif (post('date_fermeture')==''){
	json_error('The field date fermeture cannot be empty!');
	}
	elseif (post('statut')==''){
	json_error('The field statut cannot be empty!');
	}
	elseif (post('dte_heure_ouvert')==''){
	json_error('The field dte heure ouvert cannot be empty!');
	}
	elseif (post('dte_heure_ferm')==''){
	json_error('The field dte heure ferm cannot be empty!');
	}
	elseif (post('user_id')==''){
	json_error('The field user id cannot be empty!');
	}
	elseif (post('caisse_id')==''){
	json_error('The field caisse id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->t_session_model->Update(post('date_ouverture'),post('date_fermeture'),post('statut'),post('dte_heure_ouvert'),post('dte_heure_ferm'),post('user_id'),post('caisse_id'),post('hotel_id'),post('idsession'));
	json_send(''.H_ADMIN.'&view=t_session&idsession='.post('idsession').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_session_model->SelectOne(get('idsession'));
	include(APP_FOLDER.'/views/admin/t_session/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_session_model->TruncateTable(''.H_ADMIN.'&view=t_session&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_session/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('idsession') and $dfile==''){
	$del = $this->t_session_model->Delete(get('idsession'),''.H_ADMIN.'&view=t_session&do=viewall&msg=delete');
	}
	elseif(get('idsession') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_session_model->Delete(get('idsession'),''.H_ADMIN.'&view=t_session&do=viewall&msg=delete');
	}
	elseif(get('idsession') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_session&idsession='.get('idsession').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	