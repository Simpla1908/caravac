
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        resconfig_model
	* DATE CREATED:  	08-02-2018
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
	public function Insert($m_insert,$m_affich,$taux,$age,$penalite,$fuseauhoraire,$module_id,$site_id)
	{
	$newupload = new UploadControl;
	$uploadname=$newupload->ImageUplaodResize('logo',THUMB_IMAGE_WIDTH,BIG_IMAGE_WIDTH,UPLOAD_PATH,THUMB_PATH,90);
	if($uploadname==''){
	$values = array(array( 'm_insert'=>$m_insert,'m_affich'=>$m_affich,'taux'=>$taux,'age'=>$age,'penalie'=>$penalie,'fuseauhoraire'=>$fuseauhoraire,'module_id'=>$module_id,'site_id'=>$site_id ));
	}else{
	$values = array(array( 'logo'=>$uploadname,'m_insert'=>$m_insert,'m_affich'=>$m_affich,'taux'=>$taux,'age'=>$age,'penalie'=>$penalie,'fuseauhoraire'=>$fuseauhoraire,'module_id'=>$module_id,'site_id'=>$site_id ));
	}
	HDB::hus()->Hinsert('resconfig', $values);
	}
	
	// UPDATE
	public function Update($nofile,$nomcomp,$adrcomp,$m_insert,$m_affich,$taux,$age,$penalite,$hopital,$fuseauhoraire,$prefsanct,$prefconge,$module_id,$site_id,$pointage,$id)
	{
            $bdd=HDB::hus();
	$uploadname='';
	if($nofile==1){
	$newupload = new UploadControl;
	$uploadname=$newupload->ImageUplaodResize('logo',THUMB_IMAGE_WIDTH,BIG_IMAGE_WIDTH,UPLOAD_PATH,THUMB_PATH,90);
	}
	if($uploadname==''){
	$sql = "nomcomp=:nomcomp,adrcomp=:adrcomp, m_insert =:m_insert,m_affich =:m_affich,taux =:taux,age =:age,penalite=:penalite,hopital =:hopital,fuseauhoraire =:fuseauhoraire,prefsanct =:prefsanct,prefconge =:prefconge,module_id =:module_id,site_id =:site_id,pointage=:pointage WHERE id = :id ";
	$data = array(':nomcomp'=>$nomcomp,':adrcomp'=>$adrcomp,':m_insert'=>$m_insert,':m_affich'=>$m_affich,':taux'=>$taux,':age'=>$age,':penalite'=>$penalite,':hopital'=>$hopital,':fuseauhoraire'=>$fuseauhoraire,':prefsanct'=>$prefsanct,':prefconge'=>$prefconge,':module_id'=>$module_id,':site_id'=>$site_id,':pointage'=>$pointage,':id'=>$id);
	}else{
	$sql = "nomcomp=:nomcomp,adrcomp=:adrcomp,logo=:logo,m_insert =:m_insert,m_affich =:m_affich,taux =:taux,age =:age,penalite=:penalite,hopital =:hopital,fuseauhoraire =:fuseauhoraire,prefsanct =:prefsanct,prefconge =:prefconge,module_id =:module_id,site_id =:site_id,pointage=:pointage WHERE id = :id ";
	$data = array(':nomcomp'=>$nomcomp,':adrcomp'=>$adrcomp,':logo'=>$uploadname,':m_insert'=>$m_insert,':m_affich'=>$m_affich,':taux'=>$taux,':age'=>$age,':penalite'=>$penalite,':hopital'=>$hopital,':fuseauhoraire'=>$fuseauhoraire,':prefsanct'=>$prefsanct,':prefconge'=>$prefconge,':module_id'=>$module_id,':site_id'=>$site_id,':pointage'=>$pointage,':id'=>$id);
	}
	$bdd->Hupdate('resconfig',$sql,$data);
        $sql2 = "pointage=:pointage WHERE id_hotel=:site_id";
	$data2 = array(':site_id'=>$site_id,':pointage'=>$pointage);
        $bdd->Hupdate('t_hotel',$sql2,$data2);
	
	}
	
	
	} // end class
	
	?>
	
	