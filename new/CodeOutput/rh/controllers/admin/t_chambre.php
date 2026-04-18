
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_chambre.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_chambre
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_chambre.php');
	
	class t_chambre_controller {
	public $t_chambre_model;
	
	public function __construct()  
    {  
        $this->t_chambre_model = new t_chambre_model();
    } 
	
	public function invoke_t_chambre()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_chambre_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_chambre_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_chambre&do=viewall');
	}else{
	$result = $this->t_chambre_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_chambre/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_chambre_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_chambre/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_chambre_model->SelectOne(get('id_ch'));
	include(APP_FOLDER.'/views/admin/t_chambre/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_chambre_model->AutoSearch(trim($qstring),10,'num_ch');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_chambre&id_ch='.$srow->id_ch.'&do=details"><li class="list-group-item">'. $srow->num_ch.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_chambre/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('num_ch')==''){
	json_error('The field num ch cannot be empty!');
	}
	elseif (post('etat_ch')==''){
	json_error('The field etat ch cannot be empty!');
	}
	elseif (post('tarif_ch')==''){
	json_error('The field tarif ch cannot be empty!');
	}
	elseif (post('monnaie')==''){
	json_error('The field monnaie cannot be empty!');
	}
	elseif (post('reserve')==''){
	json_error('The field reserve cannot be empty!');
	}
	elseif (post('occupe')==''){
	json_error('The field occupe cannot be empty!');
	}
	elseif (post('libre')==''){
	json_error('The field libre cannot be empty!');
	}
	elseif (post('capacite_init')==''){
	json_error('The field capacite init cannot be empty!');
	}
	elseif (post('capacite')==''){
	json_error('The field capacite cannot be empty!');
	}
	elseif (post('categorie')==''){
	json_error('The field categorie cannot be empty!');
	}
	elseif (post('niveau')==''){
	json_error('The field niveau cannot be empty!');
	}
	elseif (post('id_hotel')==''){
	json_error('The field id hotel cannot be empty!');
	}
	elseif (post('del')==''){
	json_error('The field del cannot be empty!');
	}
	else{
	$this->t_chambre_model->Insert(post('num_ch'),post('etat_ch'),post('tarif_ch'),post('monnaie'),post('reserve'),post('occupe'),post('libre'),post('capacite_init'),post('capacite'),post('categorie'),post('niveau'),post('id_hotel'),post('del'));
	json_send(''.H_ADMIN.'&view=t_chambre&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_chambre_model->SelectOne(get('id_ch'));
	include(APP_FOLDER.'/views/admin/t_chambre/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_ch')==''){
	json_error('The field id_ch cannot be empty!');
	}
	elseif (post('num_ch')==''){
	json_error('The field num ch cannot be empty!');
	}
	elseif (post('etat_ch')==''){
	json_error('The field etat ch cannot be empty!');
	}
	elseif (post('tarif_ch')==''){
	json_error('The field tarif ch cannot be empty!');
	}
	elseif (post('monnaie')==''){
	json_error('The field monnaie cannot be empty!');
	}
	elseif (post('reserve')==''){
	json_error('The field reserve cannot be empty!');
	}
	elseif (post('occupe')==''){
	json_error('The field occupe cannot be empty!');
	}
	elseif (post('libre')==''){
	json_error('The field libre cannot be empty!');
	}
	elseif (post('capacite_init')==''){
	json_error('The field capacite init cannot be empty!');
	}
	elseif (post('capacite')==''){
	json_error('The field capacite cannot be empty!');
	}
	elseif (post('categorie')==''){
	json_error('The field categorie cannot be empty!');
	}
	elseif (post('niveau')==''){
	json_error('The field niveau cannot be empty!');
	}
	elseif (post('id_hotel')==''){
	json_error('The field id hotel cannot be empty!');
	}
	elseif (post('del')==''){
	json_error('The field del cannot be empty!');
	}
	else{
	$this->t_chambre_model->Update(post('num_ch'),post('etat_ch'),post('tarif_ch'),post('monnaie'),post('reserve'),post('occupe'),post('libre'),post('capacite_init'),post('capacite'),post('categorie'),post('niveau'),post('id_hotel'),post('del'),post('id_ch'));
	json_send(''.H_ADMIN.'&view=t_chambre&id_ch='.post('id_ch').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_chambre_model->SelectOne(get('id_ch'));
	include(APP_FOLDER.'/views/admin/t_chambre/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_chambre_model->TruncateTable(''.H_ADMIN.'&view=t_chambre&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_chambre/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_ch') and $dfile==''){
	$del = $this->t_chambre_model->Delete(get('id_ch'),''.H_ADMIN.'&view=t_chambre&do=viewall&msg=delete');
	}
	elseif(get('id_ch') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_chambre_model->Delete(get('id_ch'),''.H_ADMIN.'&view=t_chambre&do=viewall&msg=delete');
	}
	elseif(get('id_ch') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_chambre&id_ch='.get('id_ch').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	