
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_caisse_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_caisse
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_caisse.php');
	
	class t_caisse_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_caisse LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_caisse");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_caisse");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_caisse","idcaisse=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_caisse","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_caisse");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_caisse","idcaisse=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($libelle,$hotel_id)
	{
	
	$values = array(array( 'libelle'=>$libelle,'hotel_id'=>$hotel_id ));
	HDB::hus()->Hinsert('t_caisse', $values);
	}
	
	// UPDATE
	public function Update($libelle,$hotel_id,$id)
	{
	$sql = "  libelle =:libelle,hotel_id =:hotel_id WHERE idcaisse = :id ";
	$data = array(':libelle'=>$libelle,':hotel_id'=>$hotel_id,':id'=>$id);
	HDB::hus()->Hupdate('t_caisse',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	