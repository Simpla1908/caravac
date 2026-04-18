
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        partenaire_hotel_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		partenaire_hotel
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_partenaire_hotel.php');
	
	class partenaire_hotel_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("partenaire_hotel LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("partenaire_hotel");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("partenaire_hotel");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("partenaire_hotel","id_part_hotel=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("partenaire_hotel","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE partenaire_hotel");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("partenaire_hotel","id_part_hotel=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($partenaire_id,$hotel_id)
	{
	
	$values = array(array( 'partenaire_id'=>$partenaire_id,'hotel_id'=>$hotel_id ));
	HDB::hus()->Hinsert('partenaire_hotel', $values);
	}
	
	// UPDATE
	public function Update($partenaire_id,$hotel_id,$id)
	{
	$sql = "  partenaire_id =:partenaire_id,hotel_id =:hotel_id WHERE id_part_hotel = :id ";
	$data = array(':partenaire_id'=>$partenaire_id,':hotel_id'=>$hotel_id,':id'=>$id);
	HDB::hus()->Hupdate('partenaire_hotel',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	