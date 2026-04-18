
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        cptclasses_model
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		cptclasses
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_cptclasses.php');
	
	class cptclasses_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("cptclasses LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("cptclasses");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("cptclasses");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("cptclasses","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("cptclasses","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE cptclasses");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("cptclasses","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($libelle,$libelle2,$numero,$etat)
	{
	
	$values = array(array( 'libelle'=>$libelle,'libelle2'=>$libelle2,'numero'=>$numero,'etat'=>$etat ));
	HDB::hus()->Hinsert('cptclasses', $values);
	}
	
	// UPDATE
	public function Update($libelle,$libelle2,$numero,$etat,$id)
	{
	$sql = "  libelle =:libelle,libelle2 =:libelle2,numero =:numero,etat =:etat WHERE id = :id ";
	$data = array(':libelle'=>$libelle,':libelle2'=>$libelle2,':numero'=>$numero,':etat'=>$etat,':id'=>$id);
	HDB::hus()->Hupdate('cptclasses',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	