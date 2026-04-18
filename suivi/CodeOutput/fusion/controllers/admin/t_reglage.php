
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_reglage.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_reglage
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_reglage.php');
	
	class t_reglage_controller {
	public $t_reglage_model;
	
	public function __construct()  
    {  
        $this->t_reglage_model = new t_reglage_model();
    } 
	
	public function invoke_t_reglage()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_reglage_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_reglage_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_reglage&do=viewall');
	}else{
	$result = $this->t_reglage_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_reglage/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_reglage_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_reglage/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_reglage_model->SelectOne(get('id_regl'));
	include(APP_FOLDER.'/views/admin/t_reglage/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_reglage_model->AutoSearch(trim($qstring),10,'remise');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_reglage&id_regl='.$srow->id_regl.'&do=details"><li class="list-group-item">'. $srow->remise.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_reglage/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('remise')==''){
	json_error('The field remise cannot be empty!');
	}
	elseif (post('majoration')==''){
	json_error('The field majoration cannot be empty!');
	}
	elseif (post('date_regl')==''){
	json_error('The field date regl cannot be empty!');
	}
	elseif (post('dte_h')==''){
	json_error('The field dte h cannot be empty!');
	}
	elseif (post('temps_regl')==''){
	json_error('The field temps regl cannot be empty!');
	}
	elseif (post('time_checkin')==''){
	json_error('The field time checkin cannot be empty!');
	}
	elseif (post('m_insert')==''){
	json_error('The field m insert cannot be empty!');
	}
	elseif (post('m_affiche')==''){
	json_error('The field m affiche cannot be empty!');
	}
	elseif (post('tauxdollar')==''){
	json_error('The field tauxdollar cannot be empty!');
	}
	elseif (post('taux_op')==''){
	json_error('The field taux op cannot be empty!');
	}
	elseif (post('tva')==''){
	json_error('The field tva cannot be empty!');
	}
	elseif (post('pourcentage_defaut')==''){
	json_error('The field pourcentage defaut cannot be empty!');
	}
	elseif (post('pourcentage_24_heure')==''){
	json_error('The field pourcentage 24 heure cannot be empty!');
	}
	elseif (post('pourcentage_48_heure')==''){
	json_error('The field pourcentage 48 heure cannot be empty!');
	}
	elseif (post('pourcentage_72_heure')==''){
	json_error('The field pourcentage 72 heure cannot be empty!');
	}
	elseif (post('pourcentage_sup_72_heure')==''){
	json_error('The field pourcentage sup 72 heure cannot be empty!');
	}
	elseif (post('type_annul')==''){
	json_error('The field type annul cannot be empty!');
	}
	elseif (post('fcon_heberge')==''){
	json_error('The field fcon heberge cannot be empty!');
	}
	elseif (post('user_id')==''){
	json_error('The field user id cannot be empty!');
	}
	elseif (post('id_hotel')==''){
	json_error('The field id hotel cannot be empty!');
	}
	elseif (post('company_id')==''){
	json_error('The field company id cannot be empty!');
	}
	else{
	$this->t_reglage_model->Insert(post('remise'),post('majoration'),post('date_regl'),post('dte_h'),post('temps_regl'),post('time_checkin'),post('m_insert'),post('m_affiche'),post('tauxdollar'),post('taux_op'),post('tva'),post('pourcentage_defaut'),post('pourcentage_24_heure'),post('pourcentage_48_heure'),post('pourcentage_72_heure'),post('pourcentage_sup_72_heure'),post('type_annul'),post('fcon_heberge'),post('user_id'),post('id_hotel'),post('company_id'));
	json_send(''.H_ADMIN.'&view=t_reglage&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_reglage_model->SelectOne(get('id_regl'));
	include(APP_FOLDER.'/views/admin/t_reglage/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_regl')==''){
	json_error('The field id_regl cannot be empty!');
	}
	elseif (post('remise')==''){
	json_error('The field remise cannot be empty!');
	}
	elseif (post('majoration')==''){
	json_error('The field majoration cannot be empty!');
	}
	elseif (post('date_regl')==''){
	json_error('The field date regl cannot be empty!');
	}
	elseif (post('dte_h')==''){
	json_error('The field dte h cannot be empty!');
	}
	elseif (post('temps_regl')==''){
	json_error('The field temps regl cannot be empty!');
	}
	elseif (post('time_checkin')==''){
	json_error('The field time checkin cannot be empty!');
	}
	elseif (post('m_insert')==''){
	json_error('The field m insert cannot be empty!');
	}
	elseif (post('m_affiche')==''){
	json_error('The field m affiche cannot be empty!');
	}
	elseif (post('tauxdollar')==''){
	json_error('The field tauxdollar cannot be empty!');
	}
	elseif (post('taux_op')==''){
	json_error('The field taux op cannot be empty!');
	}
	elseif (post('tva')==''){
	json_error('The field tva cannot be empty!');
	}
	elseif (post('pourcentage_defaut')==''){
	json_error('The field pourcentage defaut cannot be empty!');
	}
	elseif (post('pourcentage_24_heure')==''){
	json_error('The field pourcentage 24 heure cannot be empty!');
	}
	elseif (post('pourcentage_48_heure')==''){
	json_error('The field pourcentage 48 heure cannot be empty!');
	}
	elseif (post('pourcentage_72_heure')==''){
	json_error('The field pourcentage 72 heure cannot be empty!');
	}
	elseif (post('pourcentage_sup_72_heure')==''){
	json_error('The field pourcentage sup 72 heure cannot be empty!');
	}
	elseif (post('type_annul')==''){
	json_error('The field type annul cannot be empty!');
	}
	elseif (post('fcon_heberge')==''){
	json_error('The field fcon heberge cannot be empty!');
	}
	elseif (post('user_id')==''){
	json_error('The field user id cannot be empty!');
	}
	elseif (post('id_hotel')==''){
	json_error('The field id hotel cannot be empty!');
	}
	elseif (post('company_id')==''){
	json_error('The field company id cannot be empty!');
	}
	else{
	$this->t_reglage_model->Update(post('remise'),post('majoration'),post('date_regl'),post('dte_h'),post('temps_regl'),post('time_checkin'),post('m_insert'),post('m_affiche'),post('tauxdollar'),post('taux_op'),post('tva'),post('pourcentage_defaut'),post('pourcentage_24_heure'),post('pourcentage_48_heure'),post('pourcentage_72_heure'),post('pourcentage_sup_72_heure'),post('type_annul'),post('fcon_heberge'),post('user_id'),post('id_hotel'),post('company_id'),post('id_regl'));
	json_send(''.H_ADMIN.'&view=t_reglage&id_regl='.post('id_regl').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_reglage_model->SelectOne(get('id_regl'));
	include(APP_FOLDER.'/views/admin/t_reglage/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_reglage_model->TruncateTable(''.H_ADMIN.'&view=t_reglage&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_reglage/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_regl') and $dfile==''){
	$del = $this->t_reglage_model->Delete(get('id_regl'),''.H_ADMIN.'&view=t_reglage&do=viewall&msg=delete');
	}
	elseif(get('id_regl') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_reglage_model->Delete(get('id_regl'),''.H_ADMIN.'&view=t_reglage&do=viewall&msg=delete');
	}
	elseif(get('id_regl') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_reglage&id_regl='.get('id_regl').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	