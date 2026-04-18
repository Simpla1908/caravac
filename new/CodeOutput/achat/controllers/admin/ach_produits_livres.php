
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        ach_produits_livres.php
	* DATE CREATED:  	09-07-2018
	* FOR TABLE:  		ach_produits_livres
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/ach_produits_livres.php');
	
	class ach_produits_livres_controller {
	public $ach_produits_livres_model;
	
	public function __construct()  
    {  
        $this->ach_produits_livres_model = new ach_produits_livres_model();
    } 
	
	public function invoke_ach_produits_livres()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->ach_produits_livres_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->ach_produits_livres_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=ach_produits_livres&do=viewall');
	}else{
	$result = $this->ach_produits_livres_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/ach_produits_livres/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->ach_produits_livres_model->SelectAll();
	include(APP_FOLDER.'/views/admin/ach_produits_livres/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->ach_produits_livres_model->SelectOne(get('id_produit_liv'));
	include(APP_FOLDER.'/views/admin/ach_produits_livres/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->ach_produits_livres_model->AutoSearch(trim($qstring),10,'quantite_cmd');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=ach_produits_livres&id_produit_liv='.$srow->id_produit_liv.'&do=details"><li class="list-group-item">'. $srow->quantite_cmd.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/ach_produits_livres/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('quantite_cmd')==''){
	json_error('The field quantite cmd cannot be empty!');
	}
	elseif (post('quantite_liv')==''){
	json_error('The field quantite liv cannot be empty!');
	}
	elseif (post('observation')==''){
	json_error('The field observation cannot be empty!');
	}
	elseif (post('produit_id')==''){
	json_error('The field produit id cannot be empty!');
	}
	elseif (post('livraison_id')==''){
	json_error('The field livraison id cannot be empty!');
	}
	elseif (post('user_id')==''){
	json_error('The field user id cannot be empty!');
	}
	else{
	$this->ach_produits_livres_model->Insert(post('quantite_cmd'),post('quantite_liv'),post('observation'),post('produit_id'),post('livraison_id'),post('user_id'));
	json_send(''.H_ADMIN.'&view=ach_produits_livres&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->ach_produits_livres_model->SelectOne(get('id_produit_liv'));
	include(APP_FOLDER.'/views/admin/ach_produits_livres/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_produit_liv')==''){
	json_error('The field id_produit_liv cannot be empty!');
	}
	elseif (post('quantite_cmd')==''){
	json_error('The field quantite cmd cannot be empty!');
	}
	elseif (post('quantite_liv')==''){
	json_error('The field quantite liv cannot be empty!');
	}
	elseif (post('observation')==''){
	json_error('The field observation cannot be empty!');
	}
	elseif (post('produit_id')==''){
	json_error('The field produit id cannot be empty!');
	}
	elseif (post('livraison_id')==''){
	json_error('The field livraison id cannot be empty!');
	}
	elseif (post('user_id')==''){
	json_error('The field user id cannot be empty!');
	}
	else{
	$this->ach_produits_livres_model->Update(post('quantite_cmd'),post('quantite_liv'),post('observation'),post('produit_id'),post('livraison_id'),post('user_id'),post('id_produit_liv'));
	json_send(''.H_ADMIN.'&view=ach_produits_livres&id_produit_liv='.post('id_produit_liv').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->ach_produits_livres_model->SelectOne(get('id_produit_liv'));
	include(APP_FOLDER.'/views/admin/ach_produits_livres/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->ach_produits_livres_model->TruncateTable(''.H_ADMIN.'&view=ach_produits_livres&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/ach_produits_livres/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_produit_liv') and $dfile==''){
	$del = $this->ach_produits_livres_model->Delete(get('id_produit_liv'),''.H_ADMIN.'&view=ach_produits_livres&do=viewall&msg=delete');
	}
	elseif(get('id_produit_liv') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->ach_produits_livres_model->Delete(get('id_produit_liv'),''.H_ADMIN.'&view=ach_produits_livres&do=viewall&msg=delete');
	}
	elseif(get('id_produit_liv') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=ach_produits_livres&id_produit_liv='.get('id_produit_liv').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	