
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        cptcomptesites_model
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		cptcomptesites
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_cptcomptesites.php');
	
	class cptcomptesites_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("cptcomptesites LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("cptcomptesites");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("cptcomptesites");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("cptcomptesites","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("cptcomptesites","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE cptcomptesites");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("cptcomptesites","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($compte_id,$site_id)
	{
	
	$values = array(array( 'compte_id'=>$compte_id,'site_id'=>$site_id ));
	HDB::hus()->Hinsert('cptcomptesites', $values);
	}
	
	// UPDATE
	public function Update($compte_id,$site_id,$id)
	{
	$sql = "  compte_id =:compte_id,site_id =:site_id WHERE id = :id ";
	$data = array(':compte_id'=>$compte_id,':site_id'=>$site_id,':id'=>$id);
	HDB::hus()->Hupdate('cptcomptesites',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	