
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_company.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_company
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_company.php');
	
	class t_company_controller {
	public $t_company_model;
	
	public function __construct()  
    {  
        $this->t_company_model = new t_company_model();
    } 
	
	public function invoke_t_company()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_company_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_company_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_company&do=viewall');
	}else{
	$result = $this->t_company_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_company/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_company_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_company/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_company_model->SelectOne(get('id_c'));
	include(APP_FOLDER.'/views/admin/t_company/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_company_model->AutoSearch(trim($qstring),10,'nom_c');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_company&id_c='.$srow->id_c.'&do=details"><li class="list-group-item">'. $srow->nom_c.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_company/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('nom_c')==''){
	json_error('The field nom c cannot be empty!');
	}
	elseif (post('etat')==''){
	json_error('The field etat cannot be empty!');
	}
	elseif (post('adresse_c')==''){
	json_error('The field adresse c cannot be empty!');
	}
	elseif (post('logo')==''){
	json_error('The field logo cannot be empty!');
	}
	elseif (post('idnat')==''){
	json_error('The field idnat cannot be empty!');
	}
	elseif (post('rccm')==''){
	json_error('The field rccm cannot be empty!');
	}
	elseif (post('mail_company')==''){
	json_error('The field mail company cannot be empty!');
	}
	elseif (post('ville')==''){
	json_error('The field ville cannot be empty!');
	}
	elseif (post('phone')==''){
	json_error('The field phone cannot be empty!');
	}
	elseif (post('num_impot')==''){
	json_error('The field num impot cannot be empty!');
	}
	elseif (post('cb')==''){
	json_error('The field cb cannot be empty!');
	}
	elseif (post('mention')==''){
	json_error('The field mention cannot be empty!');
	}
	else{
	$this->t_company_model->Insert(post('nom_c'),post('etat'),post('adresse_c'),post('logo'),post('idnat'),post('rccm'),post('mail_company'),post('ville'),post('phone'),post('num_impot'),post('cb'),post('mention'));
	json_send(''.H_ADMIN.'&view=t_company&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_company_model->SelectOne(get('id_c'));
	include(APP_FOLDER.'/views/admin/t_company/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_c')==''){
	json_error('The field id_c cannot be empty!');
	}
	elseif (post('nom_c')==''){
	json_error('The field nom c cannot be empty!');
	}
	elseif (post('etat')==''){
	json_error('The field etat cannot be empty!');
	}
	elseif (post('adresse_c')==''){
	json_error('The field adresse c cannot be empty!');
	}
	elseif (post('logo')==''){
	json_error('The field logo cannot be empty!');
	}
	elseif (post('idnat')==''){
	json_error('The field idnat cannot be empty!');
	}
	elseif (post('rccm')==''){
	json_error('The field rccm cannot be empty!');
	}
	elseif (post('mail_company')==''){
	json_error('The field mail company cannot be empty!');
	}
	elseif (post('ville')==''){
	json_error('The field ville cannot be empty!');
	}
	elseif (post('phone')==''){
	json_error('The field phone cannot be empty!');
	}
	elseif (post('num_impot')==''){
	json_error('The field num impot cannot be empty!');
	}
	elseif (post('cb')==''){
	json_error('The field cb cannot be empty!');
	}
	elseif (post('mention')==''){
	json_error('The field mention cannot be empty!');
	}
	else{
	$this->t_company_model->Update(post('nom_c'),post('etat'),post('adresse_c'),post('logo'),post('idnat'),post('rccm'),post('mail_company'),post('ville'),post('phone'),post('num_impot'),post('cb'),post('mention'),post('id_c'));
	json_send(''.H_ADMIN.'&view=t_company&id_c='.post('id_c').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_company_model->SelectOne(get('id_c'));
	include(APP_FOLDER.'/views/admin/t_company/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_company_model->TruncateTable(''.H_ADMIN.'&view=t_company&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_company/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_c') and $dfile==''){
	$del = $this->t_company_model->Delete(get('id_c'),''.H_ADMIN.'&view=t_company&do=viewall&msg=delete');
	}
	elseif(get('id_c') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_company_model->Delete(get('id_c'),''.H_ADMIN.'&view=t_company&do=viewall&msg=delete');
	}
	elseif(get('id_c') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_company&id_c='.get('id_c').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	