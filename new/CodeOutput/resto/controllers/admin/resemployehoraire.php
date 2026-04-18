
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        resemployehoraire.php
	* DATE CREATED:  	30-10-2017
	* FOR TABLE:  		resemployehoraire
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/resemployehoraire.php');
        include_once(APP_FOLDER . '/models/objects/resemployes.php');
        include_once(APP_FOLDER.'/models/objects/reshoraire.php');
	
	class resemployehoraire_controller {
	public $resemployehoraire_model;
	
	public function __construct()  
    {  
        $this->resemployehoraire_model = new resemployehoraire_model();
    } 
	
	public function invoke_resemployehoraire()
	{
	$employeobj=new resemployes_model();
        $horaireobj=new reshoraire_model();
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
           $horaires=$horaireobj->SelectAll($_SESSION['idsite']);
           $NbrEmployeByHoraires=$this->resemployehoraire_model->NbrEmployeByHoraire($_SESSION['idsite']);
	   include(APP_FOLDER.'/views/admin/resemployehoraire/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->resemployehoraire_model->SelectAll();
	include(APP_FOLDER.'/views/admin/resemployehoraire/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->resemployehoraire_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/resemployehoraire/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->resemployehoraire_model->AutoSearch(trim($qstring),10,'employe_id');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=resemployehoraire&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->employe_id.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
           $result= $employeobj->SelectAll($_SESSION['idsite']);
           $horaires=$horaireobj->SelectAll($_SESSION['idsite']);
	include(APP_FOLDER.'/views/admin/resemployehoraire/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('employe_id')=='9OP'){
	json_error('The field employe id cannot be empty!');
	}
	else{
          $nbrjrsmaj=0;
          $seqjrsmaj=0;
          $affectation_id=NULL;
          $nbremploye=COUNT($_POST['employe_ids']);
          $nbrhoraire=COUNT($_POST['horaire_ids']);
           for ($i =0; $i <=$nbremploye-1; $i++) {
               $employe_id=$_POST['employe_ids'][$i];
              for ($j =0; $j <=$nbrhoraire-1; $j++) {
                  $default =$_POST['priorites'][$j];
                  $seq=$_POST['seqs'][$j];
                  $horaire_id=$_POST['horaire_ids'][$j];
                   $nbrjrs =$_POST['nbrjrstrav'][$j];
                  $this->resemployehoraire_model->Insert($employe_id,$horaire_id,$default,$nbrjrs,$nbrjrsmaj,$seq,$seqjrsmaj,$_SESSION['idsite']);
              } 
           }
            json_send(''.H_ADMIN.'&view=resemployehoraire&do=viewall&msg=add');
            json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->resemployehoraire_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/resemployehoraire/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
	if (post('id')==''){
	json_error('The field id cannot be empty!');
	}
	elseif (post('employe_id')==''){
	json_error('The field employe id cannot be empty!');
	}
	elseif (post('horaire_id')==''){
	json_error('The field horaire id cannot be empty!');
	}
	elseif (post('affectation_id')==''){
	json_error('The field affectation id cannot be empty!');
	}
	elseif (post('default')==''){
	json_error('The field default cannot be empty!');
	}
	elseif (post('nbrjrs')==''){
	json_error('The field nbrjrs cannot be empty!');
	}
	elseif (post('nbrjrsmaj')==''){
	json_error('The field nbrjrsmaj cannot be empty!');
	}
	elseif (post('seq')==''){
	json_error('The field seq cannot be empty!');
	}
	elseif (post('seqjrsmaj')==''){
	json_error('The field seqjrsmaj cannot be empty!');
	}
	else{
	$this->resemployehoraire_model->Update(post('employe_id'),post('horaire_id'),post('affectation_id'),post('default'),post('nbrjrs'),post('nbrjrsmaj'),post('seq'),post('seqjrsmaj'),post('id'));
	json_send(''.H_ADMIN.'&view=resemployehoraire&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$result = $this->resemployehoraire_model->detailsAffectation(get('id'));
	include(APP_FOLDER.'/views/admin/resemployehoraire/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->resemployehoraire_model->TruncateTable(''.H_ADMIN.'&view=resemployehoraire&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/resemployehoraire/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->resemployehoraire_model->Delete(get('id'),''.H_ADMIN.'&view=resemployehoraire&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->resemployehoraire_model->Delete(get('id'),''.H_ADMIN.'&view=resemployehoraire&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=resemployehoraire&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	