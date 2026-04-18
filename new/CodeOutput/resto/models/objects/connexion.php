
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        connexion_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		connexion
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_connexion.php');
	
	class connexion_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("connexion LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("connexion");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("connexion");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("connexion","id_con=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("connexion","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE connexion");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("connexion","id_con=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($date_con,$date_decon,$id_user)
	{
	
	$values = array(array( 'date_con'=>$date_con,'date_decon'=>$date_decon,'id_user'=>$id_user ));
	HDB::hus()->Hinsert('connexion', $values);
	}
	
	// UPDATE
	public function Update($date_con,$date_decon,$id_user,$id)
	{
	$sql = "  date_con =:date_con,date_decon =:date_decon,id_user =:id_user WHERE id_con = :id ";
	$data = array(':date_con'=>$date_con,':date_decon'=>$date_decon,':id_user'=>$id_user,':id'=>$id);
	HDB::hus()->Hupdate('connexion',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	