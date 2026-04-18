
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        accuse_reception_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		accuse_reception
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_accuse_reception.php');
	
	class accuse_reception_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("accuse_reception LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("accuse_reception");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("accuse_reception");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("accuse_reception","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("accuse_reception","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE accuse_reception");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("accuse_reception","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($email,$nom,$sujet,$message,$statut,$date)
	{
	
	$values = array(array( 'email'=>$email,'nom'=>$nom,'sujet'=>$sujet,'message'=>$message,'statut'=>$statut,'date'=>$date ));
	HDB::hus()->Hinsert('accuse_reception', $values);
	}
	
	// UPDATE
	public function Update($email,$nom,$sujet,$message,$statut,$date,$id)
	{
	$sql = "  email =:email,nom =:nom,sujet =:sujet,message =:message,statut =:statut,date =:date WHERE id = :id ";
	$data = array(':email'=>$email,':nom'=>$nom,':sujet'=>$sujet,':message'=>$message,':statut'=>$statut,':date'=>$date,':id'=>$id);
	HDB::hus()->Hupdate('accuse_reception',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	