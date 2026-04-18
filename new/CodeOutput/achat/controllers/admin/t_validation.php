
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_validation.php
	* DATE CREATED:  	29-11-2018
	* FOR TABLE:  		t_validation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_validation.php');
	
	class t_validation_controller {
	public $t_validation_model;
	
	public function __construct()  
    {  
        $this->t_validation_model = new t_validation_model();
    } 
	
	public function invoke_t_validation()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_validation_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_validation_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_validation&do=viewall');
	}else{
	$result = $this->t_validation_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_validation/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_validation_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_validation/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_validation_model->SelectOne(get('id_validation'));
	include(APP_FOLDER.'/views/admin/t_validation/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_validation_model->AutoSearch(trim($qstring),10,'qte_envoye');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_validation&id_validation='.$srow->id_validation.'&do=details"><li class="list-group-item">'. $srow->qte_envoye.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_validation/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('qte_envoye')==''){
	json_error('The field qte envoye cannot be empty!');
	}
	elseif (post('qte_verif')==''){
	json_error('The field qte verif cannot be empty!');
	}
	elseif (post('motif_id')==''){
	json_error('The field motif id cannot be empty!');
	}
	elseif (post('produit_id')==''){
	json_error('The field produit id cannot be empty!');
	}
	elseif (post('fiche_id')==''){
	json_error('The field fiche id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->t_validation_model->Insert(post('qte_envoye'),post('qte_verif'),post('motif_id'),post('produit_id'),post('fiche_id'),post('hotel_id'));
	json_send(''.H_ADMIN.'&view=t_validation&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_validation_model->SelectOne(get('id_validation'));
	include(APP_FOLDER.'/views/admin/t_validation/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_validation')==''){
	json_error('The field id_validation cannot be empty!');
	}
	elseif (post('qte_envoye')==''){
	json_error('The field qte envoye cannot be empty!');
	}
	elseif (post('qte_verif')==''){
	json_error('The field qte verif cannot be empty!');
	}
	elseif (post('motif_id')==''){
	json_error('The field motif id cannot be empty!');
	}
	elseif (post('produit_id')==''){
	json_error('The field produit id cannot be empty!');
	}
	elseif (post('fiche_id')==''){
	json_error('The field fiche id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->t_validation_model->Update(post('qte_envoye'),post('qte_verif'),post('motif_id'),post('produit_id'),post('fiche_id'),post('hotel_id'),post('id_validation'));
	json_send(''.H_ADMIN.'&view=t_validation&id_validation='.post('id_validation').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_validation_model->SelectOne(get('id_validation'));
	include(APP_FOLDER.'/views/admin/t_validation/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_validation_model->TruncateTable(''.H_ADMIN.'&view=t_validation&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_validation/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_validation') and $dfile==''){
	$del = $this->t_validation_model->Delete(get('id_validation'),''.H_ADMIN.'&view=t_validation&do=viewall&msg=delete');
	}
	elseif(get('id_validation') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_validation_model->Delete(get('id_validation'),''.H_ADMIN.'&view=t_validation&do=viewall&msg=delete');
	}
	elseif(get('id_validation') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_validation&id_validation='.get('id_validation').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	