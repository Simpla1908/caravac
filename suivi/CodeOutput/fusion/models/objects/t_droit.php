
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_droit_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_droit
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_droit.php');
	
	class t_droit_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_droit LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_droit");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_droit");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_droit","id_droit=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_droit","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_droit");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_droit","id_droit=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($droit,$libe_droit)
	{
	
	$values = array(array( 'droit'=>$droit,'libe_droit'=>$libe_droit ));
	HDB::hus()->Hinsert('t_droit', $values);
	}
	
	// UPDATE
	public function Update($droit,$libe_droit,$id)
	{
	$sql = "  droit =:droit,libe_droit =:libe_droit WHERE id_droit = :id ";
	$data = array(':droit'=>$droit,':libe_droit'=>$libe_droit,':id'=>$id);
	HDB::hus()->Hupdate('t_droit',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	