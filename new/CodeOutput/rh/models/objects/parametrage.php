
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        parametrage_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		parametrage
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_parametrage.php');
	
	class parametrage_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("parametrage LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("parametrage");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("parametrage");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("parametrage","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("parametrage","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE parametrage");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("parametrage","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($tva,$taux)
	{
	
	$values = array(array( 'tva'=>$tva,'taux'=>$taux ));
	HDB::hus()->Hinsert('parametrage', $values);
	}
	
	// UPDATE
	public function Update($tva,$taux,$id)
	{
	$sql = "  tva =:tva,taux =:taux WHERE id = :id ";
	$data = array(':tva'=>$tva,':taux'=>$taux,':id'=>$id);
	HDB::hus()->Hupdate('parametrage',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	