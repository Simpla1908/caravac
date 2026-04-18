
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        stk_produit.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		stk_produit
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/stk_produit.php');
	
	class stk_produit_controller {
	public $stk_produit_model;
	
	public function __construct()  
    {  
        $this->stk_produit_model = new stk_produit_model();
    } 
	
	public function invoke_stk_produit()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->stk_produit_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->stk_produit_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=stk_produit&do=viewall');
	}else{
	$result = $this->stk_produit_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/stk_produit/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->stk_produit_model->SelectAll();
	include(APP_FOLDER.'/views/admin/stk_produit/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->stk_produit_model->SelectOne(get('idprod'));
	include(APP_FOLDER.'/views/admin/stk_produit/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->stk_produit_model->AutoSearch(trim($qstring),10,'code');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=stk_produit&idprod='.$srow->idprod.'&do=details"><li class="list-group-item">'. $srow->code.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/stk_produit/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('code')==''){
	json_error('The field code cannot be empty!');
	}
	elseif (post('designation')==''){
	json_error('The field designation cannot be empty!');
	}
	elseif (post('qte_min')==''){
	json_error('The field qte min cannot be empty!');
	}
	elseif (post('qte_initial')==''){
	json_error('The field qte initial cannot be empty!');
	}
	elseif (post('qte_dispo')==''){
	json_error('The field qte dispo cannot be empty!');
	}
	elseif (post('pa')==''){
	json_error('The field pa cannot be empty!');
	}
	elseif (post('pv')==''){
	json_error('The field pv cannot be empty!');
	}
	elseif (post('monnaie')==''){
	json_error('The field monnaie cannot be empty!');
	}
	elseif (post('repas')==''){
	json_error('The field repas cannot be empty!');
	}
	elseif (post('statut')==''){
	json_error('The field statut cannot be empty!');
	}
	elseif (post('pseudo_supp')==''){
	json_error('The field pseudo supp cannot be empty!');
	}
	elseif (post('unite')==''){
	json_error('The field unite cannot be empty!');
	}
	elseif (post('famille_id')==''){
	json_error('The field famille id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->stk_produit_model->Insert(post('code'),post('designation'),post('qte_min'),post('qte_initial'),post('qte_dispo'),post('pa'),post('pv'),post('monnaie'),post('repas'),post('statut'),post('pseudo_supp'),post('unite'),post('famille_id'),post('hotel_id'));
	json_send(''.H_ADMIN.'&view=stk_produit&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->stk_produit_model->SelectOne(get('idprod'));
	include(APP_FOLDER.'/views/admin/stk_produit/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('idprod')==''){
	json_error('The field idprod cannot be empty!');
	}
	elseif (post('code')==''){
	json_error('The field code cannot be empty!');
	}
	elseif (post('designation')==''){
	json_error('The field designation cannot be empty!');
	}
	elseif (post('qte_min')==''){
	json_error('The field qte min cannot be empty!');
	}
	elseif (post('qte_initial')==''){
	json_error('The field qte initial cannot be empty!');
	}
	elseif (post('qte_dispo')==''){
	json_error('The field qte dispo cannot be empty!');
	}
	elseif (post('pa')==''){
	json_error('The field pa cannot be empty!');
	}
	elseif (post('pv')==''){
	json_error('The field pv cannot be empty!');
	}
	elseif (post('monnaie')==''){
	json_error('The field monnaie cannot be empty!');
	}
	elseif (post('repas')==''){
	json_error('The field repas cannot be empty!');
	}
	elseif (post('statut')==''){
	json_error('The field statut cannot be empty!');
	}
	elseif (post('pseudo_supp')==''){
	json_error('The field pseudo supp cannot be empty!');
	}
	elseif (post('unite')==''){
	json_error('The field unite cannot be empty!');
	}
	elseif (post('famille_id')==''){
	json_error('The field famille id cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->stk_produit_model->Update(post('code'),post('designation'),post('qte_min'),post('qte_initial'),post('qte_dispo'),post('pa'),post('pv'),post('monnaie'),post('repas'),post('statut'),post('pseudo_supp'),post('unite'),post('famille_id'),post('hotel_id'),post('idprod'));
	json_send(''.H_ADMIN.'&view=stk_produit&idprod='.post('idprod').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->stk_produit_model->SelectOne(get('idprod'));
	include(APP_FOLDER.'/views/admin/stk_produit/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->stk_produit_model->TruncateTable(''.H_ADMIN.'&view=stk_produit&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/stk_produit/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('idprod') and $dfile==''){
	$del = $this->stk_produit_model->Delete(get('idprod'),''.H_ADMIN.'&view=stk_produit&do=viewall&msg=delete');
	}
	elseif(get('idprod') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->stk_produit_model->Delete(get('idprod'),''.H_ADMIN.'&view=stk_produit&do=viewall&msg=delete');
	}
	elseif(get('idprod') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=stk_produit&idprod='.get('idprod').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	