
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        rescontrat_model
	* DATE CREATED:  	26-10-2017
	* FOR TABLE:  		rescontrat
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_rescontrat.php');
	
	class rescontrat_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("rescontrat LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("rescontrat");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("rescontrat");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("rescontrat","idcontr=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("rescontrat","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE rescontrat");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("rescontrat","idcontr=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($typecontr,$dteng,$employe_id)
	{
	
	$values = array(array( 'typecontr'=>$typecontr,'dteng'=>$dteng,'employe_id'=>$employe_id ));
	HDB::hus()->Hinsert('rescontrat', $values);
	}
	
	// UPDATE
	public function Update($typecontr,$dteng,$employe_id)
	{
	$sql = "  typecontr =:typecontr,dteng =:dteng WHERE employe_id = :employe_id ";
	$data = array(':typecontr'=>$typecontr,':dteng'=>$dteng,':employe_id'=>$employe_id);
	HDB::hus()->Hupdate('rescontrat',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	