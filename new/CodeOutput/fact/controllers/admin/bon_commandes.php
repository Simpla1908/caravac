
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        bon_commandes.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		bon_commandes
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/bon_commandes.php');
	
	class bon_commandes_controller {
	public $bon_commandes_model;
	
	public function __construct()  
    {  
        $this->bon_commandes_model = new bon_commandes_model();
    } 
	
	public function invoke_bon_commandes()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->bon_commandes_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->bon_commandes_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=bon_commandes&do=viewall');
	}else{
	$result = $this->bon_commandes_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/bon_commandes/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->bon_commandes_model->SelectAll();
	include(APP_FOLDER.'/views/admin/bon_commandes/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->bon_commandes_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/bon_commandes/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->bon_commandes_model->AutoSearch(trim($qstring),10,'commande_id');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=bon_commandes&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->commande_id.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/bon_commandes/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('commande_id')==''){
	json_error('The field commande id cannot be empty!');
	}
	elseif (post('produit_id')==''){
	json_error('The field produit id cannot be empty!');
	}
	elseif (post('nameprod')==''){
	json_error('The field nameprod cannot be empty!');
	}
	elseif (post('statut')==''){
	json_error('The field statut cannot be empty!');
	}
	elseif (post('quantite')==''){
	json_error('The field quantite cannot be empty!');
	}
	elseif (post('user_id')==''){
	json_error('The field user id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	elseif (post('dte')==''){
	json_error('The field dte cannot be empty!');
	}
	elseif (post('dte_h')==''){
	json_error('The field dte h cannot be empty!');
	}
	else{
	$this->bon_commandes_model->Insert(post('commande_id'),post('produit_id'),post('nameprod'),post('statut'),post('quantite'),post('user_id'),post('hotel_id'),post('dte'),post('dte_h'));
	json_send(''.H_ADMIN.'&view=bon_commandes&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->bon_commandes_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/bon_commandes/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('commande_id')==''){
	json_error('The field commande id cannot be empty!');
	}
	elseif (post('produit_id')==''){
	json_error('The field produit id cannot be empty!');
	}
	elseif (post('nameprod')==''){
	json_error('The field nameprod cannot be empty!');
	}
	elseif (post('statut')==''){
	json_error('The field statut cannot be empty!');
	}
	elseif (post('quantite')==''){
	json_error('The field quantite cannot be empty!');
	}
	elseif (post('user_id')==''){
	json_error('The field user id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	elseif (post('dte')==''){
	json_error('The field dte cannot be empty!');
	}
	elseif (post('dte_h')==''){
	json_error('The field dte h cannot be empty!');
	}
	else{
	$this->bon_commandes_model->Update(post('commande_id'),post('produit_id'),post('nameprod'),post('statut'),post('quantite'),post('user_id'),post('hotel_id'),post('dte'),post('dte_h'),post('id'));
	json_send(''.H_ADMIN.'&view=bon_commandes&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->bon_commandes_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/bon_commandes/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->bon_commandes_model->TruncateTable(''.H_ADMIN.'&view=bon_commandes&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/bon_commandes/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->bon_commandes_model->Delete(get('id'),''.H_ADMIN.'&view=bon_commandes&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->bon_commandes_model->Delete(get('id'),''.H_ADMIN.'&view=bon_commandes&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=bon_commandes&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	