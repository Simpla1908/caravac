
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        prix_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		prix
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_prix.php');
	
	class prix_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("prix LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("prix");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("prix");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("prix","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("prix","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE prix");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("prix","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($module_id,$souscription,$prix_user,$prix_par_user)
	{
	
	$values = array(array( 'module_id'=>$module_id,'souscription'=>$souscription,'prix_user'=>$prix_user,'prix_par_user'=>$prix_par_user ));
	HDB::hus()->Hinsert('prix', $values);
	}
	
	// UPDATE
	public function Update($module_id,$souscription,$prix_user,$prix_par_user,$id)
	{
	$sql = "  module_id =:module_id,souscription =:souscription,prix_user =:prix_user,prix_par_user =:prix_par_user WHERE id = :id ";
	$data = array(':module_id'=>$module_id,':souscription'=>$souscription,':prix_user'=>$prix_user,':prix_par_user'=>$prix_par_user,':id'=>$id);
	HDB::hus()->Hupdate('prix',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	