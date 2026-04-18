
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        t_hotel.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_hotel
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/t_hotel.php');
	
	class t_hotel_controller {
	public $t_hotel_model;
	
	public function __construct()  
    {  
        $this->t_hotel_model = new t_hotel_model();
    } 
	
	public function invoke_t_hotel()
	{
	
	//SELECT ALL //////////////////////////////////	
	if (get('do') == 'viewall') {
            if (PAGINATION_TYPE == 'Normal') {
                $result = $this->t_hotel_model->SelectAll(RECORD_PER_PAGE);
                //Accept get url  e.g (index.php?id=1&cat=2...)
                $paging = pagination($this->t_hotel_model->CountRow(), RECORD_PER_PAGE, '' . H_ADMIN . '&view=t_hotel&do=viewall');
            } else {
                $result = $this->t_hotel_model->SelectAll();
            }
            include(APP_FOLDER . '/views/admin/t_hotel/View.php');
        }


        //EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->t_hotel_model->SelectAll();
	include(APP_FOLDER.'/views/admin/t_hotel/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->t_hotel_model->SelectOne(get('id_hotel'));
	include(APP_FOLDER.'/views/admin/t_hotel/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->t_hotel_model->AutoSearch(trim($qstring),10,'nom_hotel');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=t_hotel&id_hotel='.$srow->id_hotel.'&do=details"><li class="list-group-item">'. $srow->nom_hotel.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/t_hotel/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('nom_hotel')==''){
	json_error('The field nom hotel cannot be empty!');
	}
	elseif (post('adresse_hotel')==''){
	json_error('The field adresse hotel cannot be empty!');
	}
	elseif (post('province_hotel')==''){
	json_error('The field province hotel cannot be empty!');
	}
	elseif (post('ville_hotel')==''){
	json_error('The field ville hotel cannot be empty!');
	}
	elseif (post('etat')==''){
	json_error('The field etat cannot be empty!');
	}
	elseif (post('default_site')==''){
	json_error('The field default site cannot be empty!');
	}
	elseif (post('company_id')==''){
	json_error('The field company id cannot be empty!');
	}
	elseif (post('statut_site')==''){
	json_error('The field statut site cannot be empty!');
	}
	else{
	$this->t_hotel_model->Insert(post('nom_hotel'),post('adresse_hotel'),post('province_hotel'),post('ville_hotel'),post('etat'),post('default_site'),post('company_id'),post('statut_site'));
	json_send(''.H_ADMIN.'&view=t_hotel&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->t_hotel_model->SelectOne(get('id_hotel'));
	include(APP_FOLDER.'/views/admin/t_hotel/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_hotel')==''){
	json_error('The field id_hotel cannot be empty!');
	}
	elseif (post('nom_hotel')==''){
	json_error('The field nom hotel cannot be empty!');
	}
	elseif (post('adresse_hotel')==''){
	json_error('The field adresse hotel cannot be empty!');
	}
	elseif (post('province_hotel')==''){
	json_error('The field province hotel cannot be empty!');
	}
	elseif (post('ville_hotel')==''){
	json_error('The field ville hotel cannot be empty!');
	}
	elseif (post('etat')==''){
	json_error('The field etat cannot be empty!');
	}
	elseif (post('default_site')==''){
	json_error('The field default site cannot be empty!');
	}
	elseif (post('company_id')==''){
	json_error('The field company id cannot be empty!');
	}
	elseif (post('statut_site')==''){
	json_error('The field statut site cannot be empty!');
	}
	else{
	$this->t_hotel_model->Update(post('nom_hotel'),post('adresse_hotel'),post('province_hotel'),post('ville_hotel'),post('etat'),post('default_site'),post('company_id'),post('statut_site'),post('id_hotel'));
	json_send(''.H_ADMIN.'&view=t_hotel&id_hotel='.post('id_hotel').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
        
        elseif (get('do') == 'updatepro_tc') {
            if ($_POST) {
                //form validation
                if (post('id_hotel') == '') {
                    json_error('The field id_hotel cannot be empty!');
                } elseif (post('terme_condition') == '') {
                    json_error('le champ terme & condition ne peut pas être vide!');
                } else {
                    $this->t_hotel_model->Update_tc(post('terme_condition'), post('id_hotel'));
                    json_send('' . H_ADMIN . '&view=t_hotel&do=update&id_hotel=' . post('id_hotel') . '&msg=update');
                    json_success('Process Completed');
                }
            }
        }
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->t_hotel_model->SelectOne(get('id_hotel'));
	include(APP_FOLDER.'/views/admin/t_hotel/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->t_hotel_model->TruncateTable(''.H_ADMIN.'&view=t_hotel&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/t_hotel/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_hotel') and $dfile==''){
	$del = $this->t_hotel_model->Delete(get('id_hotel'),''.H_ADMIN.'&view=t_hotel&do=viewall&msg=delete');
	}
	elseif(get('id_hotel') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->t_hotel_model->Delete(get('id_hotel'),''.H_ADMIN.'&view=t_hotel&do=viewall&msg=delete');
	}
	elseif(get('id_hotel') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=t_hotel&id_hotel='.get('id_hotel').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	