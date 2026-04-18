
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_modulecompany.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_modulecompany
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_modulecompany.php');
	
	class t_modulecompany_controller {
	public $t_modulecompany_model;
	
	public function __construct()  
    {  
        $this->t_modulecompany_model = new t_modulecompany_model();
    } 
	
	public function invoke_t_modulecompany()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_modulecompany_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_modulecompany_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_modulecompany&do=viewall');
	}else{
	$result = $this->t_modulecompany_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_modulecompany/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_modulecompany_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_modulecompany/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_modulecompany_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/t_modulecompany/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_modulecompany_model->AutoSearch(trim($qstring),10,'nbreuser');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_modulecompany&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->nbreuser.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_modulecompany/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('nbreuser')==''){
	json_error('The field nbreuser cannot be empty!');
	}
	elseif (post('nbre_user_maj')==''){
	json_error('The field nbre user maj cannot be empty!');
	}
	elseif (post('etat_module')==''){
	json_error('The field etat module cannot be empty!');
	}
	elseif (post('paye')==''){
	json_error('The field paye cannot be empty!');
	}
	elseif (post('montantmodule')==''){
	json_error('The field montantmodule cannot be empty!');
	}
	elseif (post('prix_id')==''){
	json_error('The field prix id cannot be empty!');
	}
	elseif (post('pack_id')==''){
	json_error('The field pack id cannot be empty!');
	}
	elseif (post('company_id')==''){
	json_error('The field company id cannot be empty!');
	}
	elseif (post('module_id')==''){
	json_error('The field module id cannot be empty!');
	}
	elseif (post('souscription_id')==''){
	json_error('The field souscription id cannot be empty!');
	}
	elseif (post('date_sous')==''){
	json_error('The field date sous cannot be empty!');
	}
	elseif (post('date_activ')==''){
	json_error('The field date activ cannot be empty!');
	}
	elseif (post('date_echeance')==''){
	json_error('The field date echeance cannot be empty!');
	}
	elseif (post('dte_blocage')==''){
	json_error('The field dte blocage cannot be empty!');
	}
	elseif (post('site_id')==''){
	json_error('The field site id cannot be empty!');
	}
	else{
	$this->t_modulecompany_model->Insert(post('nbreuser'),post('nbre_user_maj'),post('etat_module'),post('paye'),post('montantmodule'),post('prix_id'),post('pack_id'),post('company_id'),post('module_id'),post('souscription_id'),post('date_sous'),post('date_activ'),post('date_echeance'),post('dte_blocage'),post('site_id'));
	json_send(''.H_ADMIN.'&view=t_modulecompany&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_modulecompany_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/t_modulecompany/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('nbreuser')==''){
	json_error('The field nbreuser cannot be empty!');
	}
	elseif (post('nbre_user_maj')==''){
	json_error('The field nbre user maj cannot be empty!');
	}
	elseif (post('etat_module')==''){
	json_error('The field etat module cannot be empty!');
	}
	elseif (post('paye')==''){
	json_error('The field paye cannot be empty!');
	}
	elseif (post('montantmodule')==''){
	json_error('The field montantmodule cannot be empty!');
	}
	elseif (post('prix_id')==''){
	json_error('The field prix id cannot be empty!');
	}
	elseif (post('pack_id')==''){
	json_error('The field pack id cannot be empty!');
	}
	elseif (post('company_id')==''){
	json_error('The field company id cannot be empty!');
	}
	elseif (post('module_id')==''){
	json_error('The field module id cannot be empty!');
	}
	elseif (post('souscription_id')==''){
	json_error('The field souscription id cannot be empty!');
	}
	elseif (post('date_sous')==''){
	json_error('The field date sous cannot be empty!');
	}
	elseif (post('date_activ')==''){
	json_error('The field date activ cannot be empty!');
	}
	elseif (post('date_echeance')==''){
	json_error('The field date echeance cannot be empty!');
	}
	elseif (post('dte_blocage')==''){
	json_error('The field dte blocage cannot be empty!');
	}
	elseif (post('site_id')==''){
	json_error('The field site id cannot be empty!');
	}
	else{
	$this->t_modulecompany_model->Update(post('nbreuser'),post('nbre_user_maj'),post('etat_module'),post('paye'),post('montantmodule'),post('prix_id'),post('pack_id'),post('company_id'),post('module_id'),post('souscription_id'),post('date_sous'),post('date_activ'),post('date_echeance'),post('dte_blocage'),post('site_id'),post('id'));
	json_send(''.H_ADMIN.'&view=t_modulecompany&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_modulecompany_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/t_modulecompany/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_modulecompany_model->TruncateTable(''.H_ADMIN.'&view=t_modulecompany&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_modulecompany/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->t_modulecompany_model->Delete(get('id'),''.H_ADMIN.'&view=t_modulecompany&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_modulecompany_model->Delete(get('id'),''.H_ADMIN.'&view=t_modulecompany&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_modulecompany&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	