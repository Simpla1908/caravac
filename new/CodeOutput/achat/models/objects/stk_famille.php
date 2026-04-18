
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        stk_famille_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		stk_famille
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_stk_famille.php');
	
	class stk_famille_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("stk_famille LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("stk_famille");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("stk_famille");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("stk_famille","idfamille=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("stk_famille","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE stk_famille");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("stk_famille","idfamille=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($designation,$plat,$affichage,$hotel_id)
	{
	
	$values = array(array( 'designation'=>$designation,'plat'=>$plat,'affichage'=>$affichage,'hotel_id'=>$hotel_id ));
	HDB::hus()->Hinsert('stk_famille', $values);
	}
	
	// UPDATE
	public function Update($designation,$plat,$affichage,$hotel_id,$id)
	{
	$sql = "  designation =:designation,plat =:plat,affichage =:affichage,hotel_id =:hotel_id WHERE idfamille = :id ";
	$data = array(':designation'=>$designation,':plat'=>$plat,':affichage'=>$affichage,':hotel_id'=>$hotel_id,':id'=>$id);
	HDB::hus()->Hupdate('stk_famille',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	