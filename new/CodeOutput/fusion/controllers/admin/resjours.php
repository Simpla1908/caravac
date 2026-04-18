
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        resjours.php
	* DATE CREATED:  	20-10-2017
	* FOR TABLE:  		resjours
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/resjours.php');
	
	class resjours_controller {
	public $resjours_model;
	
	public function __construct()  
    {  
        $this->resjours_model = new resjours_model();
    } 
	
	public function invoke_resjours()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->resjours_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->resjours_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=resjours&do=viewall');
	}else{
	$result = $this->resjours_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/resjours/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->resjours_model->SelectAll();
	include(APP_FOLDER.'/views/admin/resjours/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->resjours_model->SelectOne(get('idjrs'));
	include(APP_FOLDER.'/views/admin/resjours/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->resjours_model->AutoSearch(trim($qstring),10,'codejrs');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=resjours&idjrs='.$srow->idjrs.'&do=details"><li class="list-group-item">'. $srow->codejrs.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/resjours/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('codejrs')==''){
	json_error('The field codejrs cannot be empty!');
	}
	elseif (post('codejrsphp')==''){
	json_error('The field codejrsphp cannot be empty!');
	}
	elseif (post('libjrs')==''){
	json_error('The field libjrs cannot be empty!');
	}
	else{
	$this->resjours_model->Insert(post('codejrs'),post('codejrsphp'),post('libjrs'));
	json_send(''.H_ADMIN.'&view=resjours&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->resjours_model->SelectOne(get('idjrs'));
	include(APP_FOLDER.'/views/admin/resjours/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('idjrs')==''){
	json_error('The field idjrs cannot be empty!');
	}
	elseif (post('codejrs')==''){
	json_error('The field codejrs cannot be empty!');
	}
	elseif (post('codejrsphp')==''){
	json_error('The field codejrsphp cannot be empty!');
	}
	elseif (post('libjrs')==''){
	json_error('The field libjrs cannot be empty!');
	}
	else{
	$this->resjours_model->Update(post('codejrs'),post('codejrsphp'),post('libjrs'),post('idjrs'));
	json_send(''.H_ADMIN.'&view=resjours&idjrs='.post('idjrs').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->resjours_model->SelectOne(get('idjrs'));
	include(APP_FOLDER.'/views/admin/resjours/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->resjours_model->TruncateTable(''.H_ADMIN.'&view=resjours&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/resjours/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('idjrs') and $dfile==''){
	$del = $this->resjours_model->Delete(get('idjrs'),''.H_ADMIN.'&view=resjours&do=viewall&msg=delete');
	}
	elseif(get('idjrs') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->resjours_model->Delete(get('idjrs'),''.H_ADMIN.'&view=resjours&do=viewall&msg=delete');
	}
	elseif(get('idjrs') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=resjours&idjrs='.get('idjrs').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	