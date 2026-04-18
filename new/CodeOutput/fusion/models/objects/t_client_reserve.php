
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_client_reserve_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_client_reserve
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_client_reserve.php');
	
	class t_client_reserve_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_client_reserve LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_client_reserve");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_client_reserve");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_client_reserve","id_client_res=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_client_reserve","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_client_reserve");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_client_reserve","id_client_res=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($id_client,$id_res,$responsable)
	{
	
	$values = array(array( 'id_client'=>$id_client,'id_res'=>$id_res,'responsable'=>$responsable ));
	HDB::hus()->Hinsert('t_client_reserve', $values);
	}
	
	// UPDATE
	public function Update($id_client,$id_res,$responsable,$id)
	{
	$sql = "  id_client =:id_client,id_res =:id_res,responsable =:responsable WHERE id_client_res = :id ";
	$data = array(':id_client'=>$id_client,':id_res'=>$id_res,':responsable'=>$responsable,':id'=>$id);
	HDB::hus()->Hupdate('t_client_reserve',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	