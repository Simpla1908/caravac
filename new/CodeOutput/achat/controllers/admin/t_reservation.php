
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_reservation.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_reservation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_reservation.php');
	
	class t_reservation_controller {
	public $t_reservation_model;
	
	public function __construct()  
    {  
        $this->t_reservation_model = new t_reservation_model();
    } 
	
	public function invoke_t_reservation()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->t_reservation_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->t_reservation_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=t_reservation&do=viewall');
	}else{
	$result = $this->t_reservation_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/t_reservation/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_reservation_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_reservation/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_reservation_model->SelectOne(get('id_res'));
	include(APP_FOLDER.'/views/admin/t_reservation/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_reservation_model->AutoSearch(trim($qstring),10,'num_reserv');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_reservation&id_res='.$srow->id_res.'&do=details"><li class="list-group-item">'. $srow->num_reserv.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_reservation/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('num_reserv')==''){
	json_error('The field num reserv cannot be empty!');
	}
	elseif (post('garantie')==''){
	json_error('The field garantie cannot be empty!');
	}
	elseif (post('num_bc')==''){
	json_error('The field num bc cannot be empty!');
	}
	elseif (post('num_occ')==''){
	json_error('The field num occ cannot be empty!');
	}
	elseif (post('num_com')==''){
	json_error('The field num com cannot be empty!');
	}
	elseif (post('type')==''){
	json_error('The field type cannot be empty!');
	}
	elseif (post('tva')==''){
	json_error('The field tva cannot be empty!');
	}
	elseif (post('taux')==''){
	json_error('The field taux cannot be empty!');
	}
	elseif (post('remise')==''){
	json_error('The field remise cannot be empty!');
	}
	elseif (post('majoration')==''){
	json_error('The field majoration cannot be empty!');
	}
	elseif (post('mont_nuite')==''){
	json_error('The field mont nuite cannot be empty!');
	}
	elseif (post('mont_total_res')==''){
	json_error('The field mont total res cannot be empty!');
	}
	elseif (post('mont_par_chambre')==''){
	json_error('The field mont par chambre cannot be empty!');
	}
	elseif (post('monnaie')==''){
	json_error('The field monnaie cannot be empty!');
	}
	elseif (post('nbr_ch')==''){
	json_error('The field nbr ch cannot be empty!');
	}
	elseif (post('etat')==''){
	json_error('The field etat cannot be empty!');
	}
	elseif (post('etat_credit')==''){
	json_error('The field etat credit cannot be empty!');
	}
	elseif (post('dte')==''){
	json_error('The field dte cannot be empty!');
	}
	elseif (post('date_res')==''){
	json_error('The field date res cannot be empty!');
	}
	elseif (post('date_occ')==''){
	json_error('The field date occ cannot be empty!');
	}
	elseif (post('date_lib')==''){
	json_error('The field date lib cannot be empty!');
	}
	elseif (post('statut_res')==''){
	json_error('The field statut res cannot be empty!');
	}
	elseif (post('statut_occ')==''){
	json_error('The field statut occ cannot be empty!');
	}
	elseif (post('statut_sorti')==''){
	json_error('The field statut sorti cannot be empty!');
	}
	elseif (post('id_client')==''){
	json_error('The field id client cannot be empty!');
	}
	elseif (post('chambr_id')==''){
	json_error('The field chambr id cannot be empty!');
	}
	elseif (post('id_hotel')==''){
	json_error('The field id hotel cannot be empty!');
	}
	elseif (post('dte_a')==''){
	json_error('The field dte a cannot be empty!');
	}
	elseif (post('dte_s')==''){
	json_error('The field dte s cannot be empty!');
	}
	elseif (post('occ_indirect')==''){
	json_error('The field occ indirect cannot be empty!');
	}
	elseif (post('respo_id')==''){
	json_error('The field respo id cannot be empty!');
	}
	else{
	$this->t_reservation_model->Insert(post('num_reserv'),post('garantie'),post('num_bc'),post('num_occ'),post('num_com'),post('type'),post('tva'),post('taux'),post('remise'),post('majoration'),post('mont_nuite'),post('mont_total_res'),post('mont_par_chambre'),post('monnaie'),post('nbr_ch'),post('etat'),post('etat_credit'),post('dte'),post('date_res'),post('date_occ'),post('date_lib'),post('statut_res'),post('statut_occ'),post('statut_sorti'),post('id_client'),post('chambr_id'),post('id_hotel'),post('dte_a'),post('dte_s'),post('occ_indirect'),post('respo_id'));
	json_send(''.H_ADMIN.'&view=t_reservation&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_reservation_model->SelectOne(get('id_res'));
	include(APP_FOLDER.'/views/admin/t_reservation/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_res')==''){
	json_error('The field id_res cannot be empty!');
	}
	elseif (post('num_reserv')==''){
	json_error('The field num reserv cannot be empty!');
	}
	elseif (post('garantie')==''){
	json_error('The field garantie cannot be empty!');
	}
	elseif (post('num_bc')==''){
	json_error('The field num bc cannot be empty!');
	}
	elseif (post('num_occ')==''){
	json_error('The field num occ cannot be empty!');
	}
	elseif (post('num_com')==''){
	json_error('The field num com cannot be empty!');
	}
	elseif (post('type')==''){
	json_error('The field type cannot be empty!');
	}
	elseif (post('tva')==''){
	json_error('The field tva cannot be empty!');
	}
	elseif (post('taux')==''){
	json_error('The field taux cannot be empty!');
	}
	elseif (post('remise')==''){
	json_error('The field remise cannot be empty!');
	}
	elseif (post('majoration')==''){
	json_error('The field majoration cannot be empty!');
	}
	elseif (post('mont_nuite')==''){
	json_error('The field mont nuite cannot be empty!');
	}
	elseif (post('mont_total_res')==''){
	json_error('The field mont total res cannot be empty!');
	}
	elseif (post('mont_par_chambre')==''){
	json_error('The field mont par chambre cannot be empty!');
	}
	elseif (post('monnaie')==''){
	json_error('The field monnaie cannot be empty!');
	}
	elseif (post('nbr_ch')==''){
	json_error('The field nbr ch cannot be empty!');
	}
	elseif (post('etat')==''){
	json_error('The field etat cannot be empty!');
	}
	elseif (post('etat_credit')==''){
	json_error('The field etat credit cannot be empty!');
	}
	elseif (post('dte')==''){
	json_error('The field dte cannot be empty!');
	}
	elseif (post('date_res')==''){
	json_error('The field date res cannot be empty!');
	}
	elseif (post('date_occ')==''){
	json_error('The field date occ cannot be empty!');
	}
	elseif (post('date_lib')==''){
	json_error('The field date lib cannot be empty!');
	}
	elseif (post('statut_res')==''){
	json_error('The field statut res cannot be empty!');
	}
	elseif (post('statut_occ')==''){
	json_error('The field statut occ cannot be empty!');
	}
	elseif (post('statut_sorti')==''){
	json_error('The field statut sorti cannot be empty!');
	}
	elseif (post('id_client')==''){
	json_error('The field id client cannot be empty!');
	}
	elseif (post('chambr_id')==''){
	json_error('The field chambr id cannot be empty!');
	}
	elseif (post('id_hotel')==''){
	json_error('The field id hotel cannot be empty!');
	}
	elseif (post('dte_a')==''){
	json_error('The field dte a cannot be empty!');
	}
	elseif (post('dte_s')==''){
	json_error('The field dte s cannot be empty!');
	}
	elseif (post('occ_indirect')==''){
	json_error('The field occ indirect cannot be empty!');
	}
	elseif (post('respo_id')==''){
	json_error('The field respo id cannot be empty!');
	}
	else{
	$this->t_reservation_model->Update(post('num_reserv'),post('garantie'),post('num_bc'),post('num_occ'),post('num_com'),post('type'),post('tva'),post('taux'),post('remise'),post('majoration'),post('mont_nuite'),post('mont_total_res'),post('mont_par_chambre'),post('monnaie'),post('nbr_ch'),post('etat'),post('etat_credit'),post('dte'),post('date_res'),post('date_occ'),post('date_lib'),post('statut_res'),post('statut_occ'),post('statut_sorti'),post('id_client'),post('chambr_id'),post('id_hotel'),post('dte_a'),post('dte_s'),post('occ_indirect'),post('respo_id'),post('id_res'));
	json_send(''.H_ADMIN.'&view=t_reservation&id_res='.post('id_res').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_reservation_model->SelectOne(get('id_res'));
	include(APP_FOLDER.'/views/admin/t_reservation/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_reservation_model->TruncateTable(''.H_ADMIN.'&view=t_reservation&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_reservation/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_res') and $dfile==''){
	$del = $this->t_reservation_model->Delete(get('id_res'),''.H_ADMIN.'&view=t_reservation&do=viewall&msg=delete');
	}
	elseif(get('id_res') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_reservation_model->Delete(get('id_res'),''.H_ADMIN.'&view=t_reservation&do=viewall&msg=delete');
	}
	elseif(get('id_res') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_reservation&id_res='.get('id_res').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	