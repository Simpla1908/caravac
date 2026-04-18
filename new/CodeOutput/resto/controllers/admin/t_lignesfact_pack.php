
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_lignesfact_pack.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_lignesfact_pack
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_lignesfact_pack.php');
	
	class t_lignesfact_pack_controller {
	public $t_lignesfact_pack_model;
	
	public function __construct()  
    {  
        $this->t_lignesfact_pack_model = new t_lignesfact_pack_model();
    } 
	
	public function invoke_t_lignesfact_pack()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_lignesfact_pack_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_lignesfact_pack_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_lignesfact_pack&do=viewall');
	}else{
	$result = $this->t_lignesfact_pack_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_lignesfact_pack/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_lignesfact_pack_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_lignesfact_pack/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_lignesfact_pack_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/t_lignesfact_pack/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_lignesfact_pack_model->AutoSearch(trim($qstring),10,'montant');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_lignesfact_pack&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->montant.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_lignesfact_pack/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('montant')==''){
	json_error('The field montant cannot be empty!');
	}
	elseif (post('mont_paye')==''){
	json_error('The field mont paye cannot be empty!');
	}
	elseif (post('active')==''){
	json_error('The field active cannot be empty!');
	}
	elseif (post('pack_company_id')==''){
	json_error('The field pack company id cannot be empty!');
	}
	elseif (post('pack_id')==''){
	json_error('The field pack id cannot be empty!');
	}
	elseif (post('fact_id')==''){
	json_error('The field fact id cannot be empty!');
	}
	elseif (post('type')==''){
	json_error('The field type cannot be empty!');
	}
	else{
	$this->t_lignesfact_pack_model->Insert(post('montant'),post('mont_paye'),post('active'),post('pack_company_id'),post('pack_id'),post('fact_id'),post('type'));
	json_send(''.H_ADMIN.'&view=t_lignesfact_pack&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_lignesfact_pack_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/t_lignesfact_pack/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('montant')==''){
	json_error('The field montant cannot be empty!');
	}
	elseif (post('mont_paye')==''){
	json_error('The field mont paye cannot be empty!');
	}
	elseif (post('active')==''){
	json_error('The field active cannot be empty!');
	}
	elseif (post('pack_company_id')==''){
	json_error('The field pack company id cannot be empty!');
	}
	elseif (post('pack_id')==''){
	json_error('The field pack id cannot be empty!');
	}
	elseif (post('fact_id')==''){
	json_error('The field fact id cannot be empty!');
	}
	elseif (post('type')==''){
	json_error('The field type cannot be empty!');
	}
	else{
	$this->t_lignesfact_pack_model->Update(post('montant'),post('mont_paye'),post('active'),post('pack_company_id'),post('pack_id'),post('fact_id'),post('type'),post('id'));
	json_send(''.H_ADMIN.'&view=t_lignesfact_pack&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_lignesfact_pack_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/t_lignesfact_pack/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_lignesfact_pack_model->TruncateTable(''.H_ADMIN.'&view=t_lignesfact_pack&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_lignesfact_pack/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->t_lignesfact_pack_model->Delete(get('id'),''.H_ADMIN.'&view=t_lignesfact_pack&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_lignesfact_pack_model->Delete(get('id'),''.H_ADMIN.'&view=t_lignesfact_pack&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_lignesfact_pack&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	