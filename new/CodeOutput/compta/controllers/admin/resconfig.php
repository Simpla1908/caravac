
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        resconfig.php
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		resconfig
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/resconfig.php');
	include(APP_FOLDER . '/models/objects/cptexercice.php');

	
	class resconfig_controller {
	public $resconfig_model;
	
	public function __construct()  
    {  
        $this->resconfig_model = new resconfig_model();
    } 
	
	public function invoke_resconfig()
	{
	$cptexerciceo = new cptexercice_model();
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	if(PAGINATION_TYPE=='Normal'){
	$result = $this->resconfig_model->SelectAll(RECORD_PER_PAGE);
	//Accept get url  e.g (index.php?id=1&cat=2...)
	$paging = pagination($this->resconfig_model->CountRow(),RECORD_PER_PAGE,''.H_ADMIN.'&view=resconfig&do=viewall');
	}else{
	$result = $this->resconfig_model->SelectAll();	
	}
	include(APP_FOLDER.'/views/admin/resconfig/View.php');
	}
	
	
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->resconfig_model->SelectAll();
	include(APP_FOLDER.'/views/admin/resconfig/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->resconfig_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/resconfig/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->resconfig_model->AutoSearch(trim($qstring),10,'nomcomp');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=resconfig&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->nomcomp.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/resconfig/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	if($_POST){
	//form validation
	if (post('nomcomp')==''){
	json_error('The field nomcomp cannot be empty!');
	}
	elseif (post('adrcomp')==''){
	json_error('The field adrcomp cannot be empty!');
	}
	elseif (post('m_insert')==''){
	json_error('The field m insert cannot be empty!');
	}
	elseif (post('m_affich')==''){
	json_error('The field m affich cannot be empty!');
	}
	elseif (post('taux')==''){
	json_error('The field taux cannot be empty!');
	}
	elseif (post('age')==''){
	json_error('The field age cannot be empty!');
	}
	elseif (post('penalite')==''){
	json_error('The field penalite cannot be empty!');
	}
	elseif (post('hopital')==''){
	json_error('The field hopital cannot be empty!');
	}
	elseif (post('fuseauhoraire')==''){
	json_error('The field fuseauhoraire cannot be empty!');
	}
	elseif (post('prefsanct')==''){
	json_error('The field prefsanct cannot be empty!');
	}
	elseif (post('prefconge')==''){
	json_error('The field prefconge cannot be empty!');
	}
	elseif (post('tva')==''){
	json_error('The field tva cannot be empty!');
	}
	elseif (post('echeance')==''){
	json_error('The field echeance cannot be empty!');
	}
	elseif (post('liestock')==''){
	json_error('The field liestock cannot be empty!');
	}
	elseif (post('infofact')==''){
	json_error('The field infofact cannot be empty!');
	}
	elseif (post('sujetmail')==''){
	json_error('The field sujetmail cannot be empty!');
	}
	elseif (post('msgmail')==''){
	json_error('The field msgmail cannot be empty!');
	}
	elseif (post('module_id')==''){
	json_error('The field module id cannot be empty!');
	}
	elseif (post('site_id')==''){
	json_error('The field site id cannot be empty!');
	}
	elseif (post('checkin')==''){
	json_error('The field checkin cannot be empty!');
	}
	elseif (post('checkout')==''){
	json_error('The field checkout cannot be empty!');
	}
	else{
	$this->resconfig_model->Insert(post('nomcomp'),post('adrcomp'),post('m_insert'),post('m_affich'),post('taux'),post('age'),post('penalite'),post('hopital'),post('fuseauhoraire'),post('prefsanct'),post('prefconge'),post('tva'),post('echeance'),post('liestock'),post('infofact'),post('sujetmail'),post('msgmail'),post('module_id'),post('site_id'),post('checkin'),post('checkout'));
	json_send(''.H_ADMIN.'&view=resconfig&do=viewall&msg=add');
	json_success('Process Completed');
	}
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){
	$exercices=$cptexerciceo->SelectAll($_SESSION['idsite']);
	$bdd=HDB::hus();
	DatasExerciceDefault($_SESSION['idsite'],$bdd);
	include(APP_FOLDER.'/views/admin/resconfig/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
	if($_POST){
	//form validation
    if (post('taux')==''){
	json_error('Le champs taux  ne peut pas etre vide!');
	}
	elseif (post('format')==''){
	json_error('Le champs format compte ne peut pas etre vide!');
	}
	else{
	$this->resconfig_model->Update(post('taux'),post('format'),post('module_id'),post('site_id'),post('id'));
	$cptexerciceo->exerciceencours(post('exercice_id'));
	$bdd=HDB::hus();
    DatasExerciceDefault($_SESSION['idsite'],$bdd);
	json_send(''.H_ADMIN.'&view=resconfig&id='.post('id').'&do=details&msg=update');
	json_success('Process Completed');
	}
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
    $bdd=HDB::hus();
	DatasExerciceDefault($_SESSION['idsite'],$bdd);
	include(APP_FOLDER.'/views/admin/resconfig/Details.php');
	}
	//Configuration hebergement
	elseif(get('do')=='confheberge'){
	$module_id=23;
    $site_id=$_SESSION['id_hotel'];
	$bdd=ConnectWithUtf();
    PlanComptablePourSelect($bdd);
    ConfLinkMod($module_id,$site_id,$bdd);
	include(APP_FOLDER.'/views/admin/resconfig/confheberge.php');
	}
	elseif(get('do')=='confhebergepro'){
	$bdd=HDB::hus();
    $json = array();
    $json['message'] = '';
	$module_id=23;
    $site_id=$_SESSION['id_hotel'];
	$bdd=ConnectWithUtf();
	ConfLinkMod($module_id,$site_id,$bdd);
    $vide='nonvide';
    $lie=post('lie');
    $nbArticles = count($_SESSION['ConfLinkMod']['code']);
    for ($i = 0; $i <= $nbArticles - 1; $i++) {
	$code=$_SESSION['ConfLinkMod']['code'][$i];
	$libelle=post($code.'libelle');
	$compte_ecriture=post($code.'compte_ecriture');
    $long_compte=post($code.'long_compte');
	$souscompte_id=post($code.'souscompte_id');
	$categorie_id=post($code.'categorie_id');
	$compte_id=post($code.'compte_id');
	if($libelle==''){
	 $vide='vide';
	}

	}
	if($vide=="nonvide"){
	 for ($i = 0; $i <= $nbArticles - 1; $i++) {
	$code=$_SESSION['ConfLinkMod']['code'][$i];
	$libelle=post($code.'libelle');
	$compte_ecriture=post($code.'compte_ecriture');
    $long_compte=post($code.'long_compte');
	$souscompte_id=post($code.'souscompte_id');
	$categorie_id=post($code.'categorie_id');
	$compte_id=post($code.'compte_id');
    if($souscompte_id==0)$souscompte_id=NULL;
    if($compte_id==0)$compte_id=NULL;

	$query = $bdd->prepare("UPDATE cpt_liaison_module SET libelle=:libelle,compte_ecriture=:compte_ecriture,long_compte=:long_compte,souscompte_id=:souscompte_id,categorie_id=:categorie_id,compte_id=:compte_id WHERE code=:code  AND module_id=:module_id AND site_id=:site_id");
    $query->BindParam(':libelle', $libelle);
    $query->BindParam(':compte_ecriture', $compte_ecriture);
    $query->BindParam(':long_compte', $long_compte);
    $query->BindParam(':souscompte_id', $souscompte_id);
    $query->BindParam(':categorie_id', $categorie_id);
    $query->BindParam(':compte_id', $compte_id);
    $query->BindParam(':code', $code);
    $query->BindParam(':module_id', $module_id);
    $query->BindParam(':site_id', $site_id);
    $query->execute();

	}
	$query = $bdd->prepare("UPDATE cpt_liaison_module SET lie=:lie WHERE module_id=:module_id AND site_id=:site_id");
    $query->BindParam(':lie', $lie);
    $query->BindParam(':module_id', $module_id);
    $query->BindParam(':site_id', $site_id);
    $query->execute();
    $json['message'] = json_success2("Configuration effectuée avec succes.");
	}else{
    $json['message'] = json_error2("Veuillez remplir tous les champs.");
	}




	echo json_encode($json);
	}
	//Configuration hebergement
	//Configuration restaurant
	elseif(get('do')=='confresto'){
	$module_id=22;
    $site_id=$_SESSION['id_hotel'];
	$bdd=ConnectWithUtf();
    PlanComptablePourSelect($bdd);
    ConfLinkMod($module_id,$site_id,$bdd);
	include(APP_FOLDER.'/views/admin/resconfig/confresto.php');
	}
	elseif(get('do')=='confrestopro'){
	$bdd=HDB::hus();
    $json = array();
    $json['message'] = '';
	$module_id=22;
    $site_id=$_SESSION['id_hotel'];
	$bdd=ConnectWithUtf();
	ConfLinkMod($module_id,$site_id,$bdd);
    $vide='nonvide';
    $lie=post('lie');
    $nbArticles = count($_SESSION['ConfLinkMod']['code']);
    for ($i = 0; $i <= $nbArticles - 1; $i++) {
	$code=$_SESSION['ConfLinkMod']['code'][$i];
	$libelle=post($code.'libelle');
	$compte_ecriture=post($code.'compte_ecriture');
    $long_compte=post($code.'long_compte');
	$souscompte_id=post($code.'souscompte_id');
	$categorie_id=post($code.'categorie_id');
	$compte_id=post($code.'compte_id');
	if($libelle==''){
	 $vide='vide';
	}

	}
	if($vide=="nonvide"){
	 for ($i = 0; $i <= $nbArticles - 1; $i++) {
	$code=$_SESSION['ConfLinkMod']['code'][$i];
	$libelle=post($code.'libelle');
	$compte_ecriture=post($code.'compte_ecriture');
    $long_compte=post($code.'long_compte');
	$souscompte_id=post($code.'souscompte_id');
	$categorie_id=post($code.'categorie_id');
	$compte_id=post($code.'compte_id');
    if($souscompte_id==0)$souscompte_id=NULL;
    if($compte_id==0)$compte_id=NULL;

	$query = $bdd->prepare("UPDATE cpt_liaison_module SET libelle=:libelle,compte_ecriture=:compte_ecriture,long_compte=:long_compte,souscompte_id=:souscompte_id,categorie_id=:categorie_id,compte_id=:compte_id WHERE code=:code  AND module_id=:module_id AND site_id=:site_id");
    $query->BindParam(':libelle', $libelle);
    $query->BindParam(':compte_ecriture', $compte_ecriture);
    $query->BindParam(':long_compte', $long_compte);
    $query->BindParam(':souscompte_id', $souscompte_id);
    $query->BindParam(':categorie_id', $categorie_id);
    $query->BindParam(':compte_id', $compte_id);
    $query->BindParam(':code', $code);
    $query->BindParam(':module_id', $module_id);
    $query->BindParam(':site_id', $site_id);
    $query->execute();

	}
	$query = $bdd->prepare("UPDATE cpt_liaison_module SET lie=:lie WHERE module_id=:module_id AND site_id=:site_id");
    $query->BindParam(':lie', $lie);
    $query->BindParam(':module_id', $module_id);
    $query->BindParam(':site_id', $site_id);
    $query->execute();
    $json['message'] = json_success2("Configuration effectuée avec succes.");
	}else{
    $json['message'] = json_error2("Veuillez remplir tous les champs.");
	}




	echo json_encode($json);
	}
	//Configuration restaurant

	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->resconfig_model->TruncateTable(''.H_ADMIN.'&view=resconfig&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/resconfig/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->resconfig_model->Delete(get('id'),''.H_ADMIN.'&view=resconfig&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->resconfig_model->Delete(get('id'),''.H_ADMIN.'&view=resconfig&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=resconfig&id='.get('id').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	