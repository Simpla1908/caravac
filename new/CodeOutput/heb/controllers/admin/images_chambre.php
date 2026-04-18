
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        images_chambre.php
	* DATE CREATED:  	25-11-2019
	* FOR TABLE:  		images_chambre
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/images_chambre.php');
	
	class images_chambre_controller {
	public $images_chambre_model;
	
	public function __construct()  
    {  
        $this->images_chambre_model = new images_chambre_model();
    } 
	
	public function invoke_images_chambre()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->images_chambre_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->images_chambre_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=images_chambre&do=viewall');
	}else{
	$result = $this->images_chambre_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/images_chambre/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->images_chambre_model->SelectAll();
	include(APP_FOLDER.'/views/admin/images_chambre/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->images_chambre_model->SelectOne(get('id_img'));
	include(APP_FOLDER.'/views/admin/images_chambre/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->images_chambre_model->AutoSearch(trim($qstring),10,'visible');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=images_chambre&id_img='.$srow->id_img.'&do=details"><li class="list-group-item">'. $srow->visible.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/images_chambre/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('libelle')==''){
	json_error('The field libelle cannot be empty!');
	}
	elseif (post('visible')==''){
	json_error('The field visible cannot be empty!');
	}
	elseif (post('slide')==''){
	json_error('The field slide cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->images_chambre_model->Insert(post('libelle'),post('visible'),post('slide'),post('hotel_id'));
	json_send(''.H_ADMIN.'&view=images_chambre&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->images_chambre_model->SelectOne(get('id_img'));
	include(APP_FOLDER.'/views/admin/images_chambre/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id_img')==''){
	json_error('The field id_img cannot be empty!');
	}
	elseif (post('libelle')==''){
	json_error('The field libelle cannot be empty!');
	}
	elseif (post('visible')==''){
	json_error('The field visible cannot be empty!');
	}
	elseif (post('slide')==''){
	json_error('The field slide cannot be empty!');
	}
	elseif (post('hotel_id')==''){
	json_error('The field hotel id cannot be empty!');
	}
	else{
	$this->images_chambre_model->Update(post('libelle'),post('visible'),post('slide'),post('hotel_id'),post('id_img'));
	json_send(''.H_ADMIN.'&view=images_chambre&id_img='.post('id_img').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->images_chambre_model->SelectOne(get('id_img'));
	include(APP_FOLDER.'/views/admin/images_chambre/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->images_chambre_model->TruncateTable(''.H_ADMIN.'&view=images_chambre&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/images_chambre/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id_img') and $dfile==''){
	$del = $this->images_chambre_model->Delete(get('id_img'),''.H_ADMIN.'&view=images_chambre&do=viewall&msg=delete');
	}
	elseif(get('id_img') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->images_chambre_model->Delete(get('id_img'),''.H_ADMIN.'&view=images_chambre&do=viewall&msg=delete');
	}
	elseif(get('id_img') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=images_chambre&id_img='.get('id_img').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	