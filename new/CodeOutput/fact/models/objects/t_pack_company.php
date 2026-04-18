
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_pack_company_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_pack_company
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_pack_company.php');
	
	class t_pack_company_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_pack_company LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_pack_company");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_pack_company");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_pack_company","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_pack_company","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_pack_company");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_pack_company","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($pack_id,$company_id,$etat)
	{
	
	$values = array(array( 'pack_id'=>$pack_id,'company_id'=>$company_id,'etat'=>$etat ));
	HDB::hus()->Hinsert('t_pack_company', $values);
	}
	
	// UPDATE
	public function Update($pack_id,$company_id,$etat,$id)
	{
	$sql = "  pack_id =:pack_id,company_id =:company_id,etat =:etat WHERE id = :id ";
	$data = array(':pack_id'=>$pack_id,':company_id'=>$company_id,':etat'=>$etat,':id'=>$id);
	HDB::hus()->Hupdate('t_pack_company',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	