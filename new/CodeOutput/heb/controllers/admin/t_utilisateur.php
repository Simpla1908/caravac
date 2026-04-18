
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_utilisateur.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_utilisateur
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_utilisateur.php');
	
	class t_utilisateur_controller {
	public $t_utilisateur_model;
	
	public function __construct()  
    {  
        $this->t_utilisateur_model = new t_utilisateur_model();
    } 
	
	public function invoke_t_utilisateur()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_utilisateur_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_utilisateur_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_utilisateur&do=viewall');
	}else{
	$result = $this->t_utilisateur_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_utilisateur/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_utilisateur_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_utilisateur/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_utilisateur_model->SelectOne(get('id_user'));
	include(APP_FOLDER.'/views/admin/t_utilisateur/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_utilisateur_model->AutoSearch(trim($qstring),10,'nom_user');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_utilisateur&id_user='.$srow->id_user.'&do=details"><li class="list-group-item">'. $srow->nom_user.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_utilisateur/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('nom_user')==''){
	json_error('The field nom user cannot be empty!');
	}
	elseif (post('prenom_user')==''){
	json_error('The field prenom user cannot be empty!');
	}
	elseif (post('sexe_user')==''){
	json_error('The field sexe user cannot be empty!');
	}
	elseif (post('telephone_user')==''){
	json_error('The field telephone user cannot be empty!');
	}
	elseif (post('email_user')==''){
	json_error('The field email user cannot be empty!');
	}
	elseif (post('mdp_user')==''){
	json_error('The field mdp user cannot be empty!');
	}
	elseif (post('adresse_mail')==''){
	json_error('The field adresse mail cannot be empty!');
	}
	elseif (post('type')==''){
	json_error('The field type cannot be empty!');
	}
	elseif (post('actif')==''){
	json_error('The field actif cannot be empty!');
	}
	elseif (post('id_hotel')==''){
	json_error('The field id hotel cannot be empty!');
	}
	elseif (post('company_id')==''){
	json_error('The field company id cannot be empty!');
	}
	elseif (post('id_droit')==''){
	json_error('The field id droit cannot be empty!');
	}
	elseif (post('fconnect')==''){
	json_error('The field fconnect cannot be empty!');
	}
	elseif (post('connect')==''){
	json_error('The field connect cannot be empty!');
	}
	else{
	$this->t_utilisateur_model->Insert(post('nom_user'),post('prenom_user'),post('sexe_user'),post('telephone_user'),post('email_user'),post('mdp_user'),post('adresse_mail'),post('type'),post('actif'),post('id_hotel'),post('company_id'),post('id_droit'),post('fconnect'),post('connect'));
	json_send(''.H_ADMIN.'&view=t_utilisateur&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_utilisateur_model->SelectOne(get('id_user'));
	include(APP_FOLDER.'/views/admin/t_utilisateur/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_user')==''){
	json_error('The field id_user cannot be empty!');
	}
	elseif (post('nom_user')==''){
	json_error('The field nom user cannot be empty!');
	}
	elseif (post('prenom_user')==''){
	json_error('The field prenom user cannot be empty!');
	}
	elseif (post('sexe_user')==''){
	json_error('The field sexe user cannot be empty!');
	}
	elseif (post('telephone_user')==''){
	json_error('The field telephone user cannot be empty!');
	}
	elseif (post('email_user')==''){
	json_error('The field email user cannot be empty!');
	}
	elseif (post('mdp_user')==''){
	json_error('The field mdp user cannot be empty!');
	}
	elseif (post('adresse_mail')==''){
	json_error('The field adresse mail cannot be empty!');
	}
	elseif (post('type')==''){
	json_error('The field type cannot be empty!');
	}
	elseif (post('actif')==''){
	json_error('The field actif cannot be empty!');
	}
	elseif (post('id_hotel')==''){
	json_error('The field id hotel cannot be empty!');
	}
	elseif (post('company_id')==''){
	json_error('The field company id cannot be empty!');
	}
	elseif (post('id_droit')==''){
	json_error('The field id droit cannot be empty!');
	}
	elseif (post('fconnect')==''){
	json_error('The field fconnect cannot be empty!');
	}
	elseif (post('connect')==''){
	json_error('The field connect cannot be empty!');
	}
	else{
	$this->t_utilisateur_model->Update(post('nom_user'),post('prenom_user'),post('sexe_user'),post('telephone_user'),post('email_user'),post('mdp_user'),post('adresse_mail'),post('type'),post('actif'),post('id_hotel'),post('company_id'),post('id_droit'),post('fconnect'),post('connect'),post('id_user'));
	json_send(''.H_ADMIN.'&view=t_utilisateur&id_user='.post('id_user').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_utilisateur_model->SelectOne(get('id_user'));
	include(APP_FOLDER.'/views/admin/t_utilisateur/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_utilisateur_model->TruncateTable(''.H_ADMIN.'&view=t_utilisateur&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_utilisateur/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_user') and $dfile==''){
	$del = $this->t_utilisateur_model->Delete(get('id_user'),''.H_ADMIN.'&view=t_utilisateur&do=viewall&msg=delete');
	}
	elseif(get('id_user') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_utilisateur_model->Delete(get('id_user'),''.H_ADMIN.'&view=t_utilisateur&do=viewall&msg=delete');
	}
	elseif(get('id_user') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_utilisateur&id_user='.get('id_user').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	