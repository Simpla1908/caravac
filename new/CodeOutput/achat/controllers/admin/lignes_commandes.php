
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        lignes_commandes.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		lignes_commandes
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/lignes_commandes.php');
	
	class lignes_commandes_controller {
	public $lignes_commandes_model;
	
	public function __construct()  
    {  
        $this->lignes_commandes_model = new lignes_commandes_model();
    } 
	
	public function invoke_lignes_commandes()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->lignes_commandes_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->lignes_commandes_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=lignes_commandes&do=viewall');
	}else{
	$result = $this->lignes_commandes_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/lignes_commandes/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->lignes_commandes_model->SelectAll();
	include(APP_FOLDER.'/views/admin/lignes_commandes/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->lignes_commandes_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/lignes_commandes/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->lignes_commandes_model->AutoSearch(trim($qstring),10,'qte');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=lignes_commandes&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->qte.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/lignes_commandes/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('qte')==''){
	json_error('The field qte cannot be empty!');
	}
	elseif (post('prix')==''){
	json_error('The field prix cannot be empty!');
	}
	elseif (post('repas')==''){
	json_error('The field repas cannot be empty!');
	}
	elseif (post('monnaie')==''){
	json_error('The field monnaie cannot be empty!');
	}
	elseif (post('dte')==''){
	json_error('The field dte cannot be empty!');
	}
	elseif (post('dte_h')==''){
	json_error('The field dte h cannot be empty!');
	}
	elseif (post('commande_id')==''){
	json_error('The field commande id cannot be empty!');
	}
	elseif (post('produit_id')==''){
	json_error('The field produit id cannot be empty!');
	}
	elseif (post('user_id')==''){
	json_error('The field user id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->lignes_commandes_model->Insert(post('qte'),post('prix'),post('repas'),post('monnaie'),post('dte'),post('dte_h'),post('commande_id'),post('produit_id'),post('user_id'),post('hotel_id'));
	json_send(''.H_ADMIN.'&view=lignes_commandes&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->lignes_commandes_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/lignes_commandes/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('qte')==''){
	json_error('The field qte cannot be empty!');
	}
	elseif (post('prix')==''){
	json_error('The field prix cannot be empty!');
	}
	elseif (post('repas')==''){
	json_error('The field repas cannot be empty!');
	}
	elseif (post('monnaie')==''){
	json_error('The field monnaie cannot be empty!');
	}
	elseif (post('dte')==''){
	json_error('The field dte cannot be empty!');
	}
	elseif (post('dte_h')==''){
	json_error('The field dte h cannot be empty!');
	}
	elseif (post('commande_id')==''){
	json_error('The field commande id cannot be empty!');
	}
	elseif (post('produit_id')==''){
	json_error('The field produit id cannot be empty!');
	}
	elseif (post('user_id')==''){
	json_error('The field user id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->lignes_commandes_model->Update(post('qte'),post('prix'),post('repas'),post('monnaie'),post('dte'),post('dte_h'),post('commande_id'),post('produit_id'),post('user_id'),post('hotel_id'),post('id'));
	json_send(''.H_ADMIN.'&view=lignes_commandes&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->lignes_commandes_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/lignes_commandes/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->lignes_commandes_model->TruncateTable(''.H_ADMIN.'&view=lignes_commandes&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/lignes_commandes/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->lignes_commandes_model->Delete(get('id'),''.H_ADMIN.'&view=lignes_commandes&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->lignes_commandes_model->Delete(get('id'),''.H_ADMIN.'&view=lignes_commandes&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=lignes_commandes&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	