
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_histo_heberge.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_histo_heberge
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_histo_heberge.php');
	
	class t_histo_heberge_controller {
	public $t_histo_heberge_model;
	
	public function __construct()  
    {  
        $this->t_histo_heberge_model = new t_histo_heberge_model();
    } 
	
	public function invoke_t_histo_heberge()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_histo_heberge_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_histo_heberge_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_histo_heberge&do=viewall');
	}else{
	$result = $this->t_histo_heberge_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_histo_heberge/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_histo_heberge_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_histo_heberge/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_histo_heberge_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/t_histo_heberge/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_histo_heberge_model->AutoSearch(trim($qstring),10,'idreserv');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_histo_heberge&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->idreserv.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_histo_heberge/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('idreserv')==''){
	json_error('The field idreserv cannot be empty!');
	}
	elseif (post('idchambre')==''){
	json_error('The field idchambre cannot be empty!');
	}
	elseif (post('statut')==''){
	json_error('The field statut cannot be empty!');
	}
	elseif (post('date_occ')==''){
	json_error('The field date occ cannot be empty!');
	}
	elseif (post('date_lib')==''){
	json_error('The field date lib cannot be empty!');
	}
	elseif (post('monnaie')==''){
	json_error('The field monnaie cannot be empty!');
	}
	elseif (post('tarif_ch')==''){
	json_error('The field tarif ch cannot be empty!');
	}
	elseif (post('idfact')==''){
	json_error('The field idfact cannot be empty!');
	}
	elseif (post('id_hotel')==''){
	json_error('The field id hotel cannot be empty!');
	}
	else{
	$this->t_histo_heberge_model->Insert(post('idreserv'),post('idchambre'),post('statut'),post('date_occ'),post('date_lib'),post('monnaie'),post('tarif_ch'),post('idfact'),post('id_hotel'));
	json_send(''.H_ADMIN.'&view=t_histo_heberge&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_histo_heberge_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/t_histo_heberge/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('idreserv')==''){
	json_error('The field idreserv cannot be empty!');
	}
	elseif (post('idchambre')==''){
	json_error('The field idchambre cannot be empty!');
	}
	elseif (post('statut')==''){
	json_error('The field statut cannot be empty!');
	}
	elseif (post('date_occ')==''){
	json_error('The field date occ cannot be empty!');
	}
	elseif (post('date_lib')==''){
	json_error('The field date lib cannot be empty!');
	}
	elseif (post('monnaie')==''){
	json_error('The field monnaie cannot be empty!');
	}
	elseif (post('tarif_ch')==''){
	json_error('The field tarif ch cannot be empty!');
	}
	elseif (post('idfact')==''){
	json_error('The field idfact cannot be empty!');
	}
	elseif (post('id_hotel')==''){
	json_error('The field id hotel cannot be empty!');
	}
	else{
	$this->t_histo_heberge_model->Update(post('idreserv'),post('idchambre'),post('statut'),post('date_occ'),post('date_lib'),post('monnaie'),post('tarif_ch'),post('idfact'),post('id_hotel'),post('id'));
	json_send(''.H_ADMIN.'&view=t_histo_heberge&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_histo_heberge_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/t_histo_heberge/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_histo_heberge_model->TruncateTable(''.H_ADMIN.'&view=t_histo_heberge&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_histo_heberge/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->t_histo_heberge_model->Delete(get('id'),''.H_ADMIN.'&view=t_histo_heberge&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_histo_heberge_model->Delete(get('id'),''.H_ADMIN.'&view=t_histo_heberge&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_histo_heberge&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	