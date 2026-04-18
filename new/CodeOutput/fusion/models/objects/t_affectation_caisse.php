
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_affectation_caisse_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_affectation_caisse
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_affectation_caisse.php');
	
	class t_affectation_caisse_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_affectation_caisse LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_affectation_caisse");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_affectation_caisse");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_affectation_caisse","id_affectation=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_affectation_caisse","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_affectation_caisse");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_affectation_caisse","id_affectation=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($id_user,$id_caisse,$date_affect)
	{
	
	$values = array(array( 'id_user'=>$id_user,'id_caisse'=>$id_caisse,'date_affect'=>$date_affect ));
	HDB::hus()->Hinsert('t_affectation_caisse', $values);
	}
	
	// UPDATE
	public function Update($id_user,$id_caisse,$date_affect,$id)
	{
	$sql = "  id_user =:id_user,id_caisse =:id_caisse,date_affect =:date_affect WHERE id_affectation = :id ";
	$data = array(':id_user'=>$id_user,':id_caisse'=>$id_caisse,':date_affect'=>$date_affect,':id'=>$id);
	HDB::hus()->Hupdate('t_affectation_caisse',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	