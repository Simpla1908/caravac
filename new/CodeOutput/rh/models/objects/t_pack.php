
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_pack_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_pack
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_pack.php');
	
	class t_pack_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_pack LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_pack");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_pack");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_pack","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_pack","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_pack");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_pack","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($libelle,$etat)
	{
	
	$values = array(array( 'libelle'=>$libelle,'etat'=>$etat ));
	HDB::hus()->Hinsert('t_pack', $values);
	}
	
	// UPDATE
	public function Update($libelle,$etat,$id)
	{
	$sql = "  libelle =:libelle,etat =:etat WHERE id = :id ";
	$data = array(':libelle'=>$libelle,':etat'=>$etat,':id'=>$id);
	HDB::hus()->Hupdate('t_pack',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	