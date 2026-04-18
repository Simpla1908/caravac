
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        resconfig_model
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		resconfig
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_resconfig.php');
	
	class resconfig_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("resconfig LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("resconfig");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("resconfig");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("resconfig","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("resconfig","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE resconfig");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("resconfig","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($nomcomp,$adrcomp,$m_insert,$m_affich,$taux,$age,$penalite,$hopital,$fuseauhoraire,$prefsanct,$prefconge,$tva,$echeance,$liestock,$infofact,$sujetmail,$msgmail,$module_id,$site_id,$checkin,$checkout)
	{
	$newupload = new UploadControl;
	$uploadname=$newupload->ImageUplaodResize('logo',THUMB_IMAGE_WIDTH,BIG_IMAGE_WIDTH,UPLOAD_PATH,THUMB_PATH,90);
	if($uploadname==''){
	$values = array(array( 'nomcomp'=>$nomcomp,'adrcomp'=>$adrcomp,'m_insert'=>$m_insert,'m_affich'=>$m_affich,'taux'=>$taux,'age'=>$age,'penalite'=>$penalite,'hopital'=>$hopital,'fuseauhoraire'=>$fuseauhoraire,'prefsanct'=>$prefsanct,'prefconge'=>$prefconge,'tva'=>$tva,'echeance'=>$echeance,'liestock'=>$liestock,'infofact'=>$infofact,'sujetmail'=>$sujetmail,'msgmail'=>$msgmail,'module_id'=>$module_id,'site_id'=>$site_id,'checkin'=>$checkin,'checkout'=>$checkout ));
	}else{
	$values = array(array( 'logo'=>$uploadname,'nomcomp'=>$nomcomp,'adrcomp'=>$adrcomp,'m_insert'=>$m_insert,'m_affich'=>$m_affich,'taux'=>$taux,'age'=>$age,'penalite'=>$penalite,'hopital'=>$hopital,'fuseauhoraire'=>$fuseauhoraire,'prefsanct'=>$prefsanct,'prefconge'=>$prefconge,'tva'=>$tva,'echeance'=>$echeance,'liestock'=>$liestock,'infofact'=>$infofact,'sujetmail'=>$sujetmail,'msgmail'=>$msgmail,'module_id'=>$module_id,'site_id'=>$site_id,'checkin'=>$checkin,'checkout'=>$checkout ));
	}
	HDB::hus()->Hinsert('resconfig', $values);
	}
	
	// UPDATE
	public function Update($taux,$format,$module_id,$site_id,$id)
	{
	$sql = "taux =:taux,age =:format,module_id =:module_id,site_id =:site_id WHERE id = :id ";
	$data = array(':taux'=>$taux,':format'=>$format,':module_id'=>$module_id,':site_id'=>$site_id,':id'=>$id);
	HDB::hus()->Hupdate('resconfig',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	