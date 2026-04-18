
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_commussionnaire_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_commussionnaire
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_commussionnaire.php');
	
	class t_commussionnaire_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_commussionnaire LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_commussionnaire");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_commussionnaire");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_commussionnaire","id_com=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_commussionnaire","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_commussionnaire");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_commussionnaire","id_com=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($nomcom,$sxcom,$contact,$adr)
	{
	
	$values = array(array( 'nomcom'=>$nomcom,'sxcom'=>$sxcom,'contact'=>$contact,'adr'=>$adr ));
	HDB::hus()->Hinsert('t_commussionnaire', $values);
	}
	
	// UPDATE
	public function Update($nomcom,$sxcom,$contact,$adr,$id)
	{
	$sql = "  nomcom =:nomcom,sxcom =:sxcom,contact =:contact,adr =:adr WHERE id_com = :id ";
	$data = array(':nomcom'=>$nomcom,':sxcom'=>$sxcom,':contact'=>$contact,':adr'=>$adr,':id'=>$id);
	HDB::hus()->Hupdate('t_commussionnaire',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	