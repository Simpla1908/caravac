
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        reservation_table_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		reservation_table
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_reservation_table.php');
	
	class reservation_table_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("reservation_table LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("reservation_table");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("reservation_table");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("reservation_table","id_res_table=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("reservation_table","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE reservation_table");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("reservation_table","id_res_table=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($date_res_tbl,$date_hr_res_tbl,$client_nom,$table_id,$hotel_id)
	{
	
	$values = array(array( 'date_res_tbl'=>$date_res_tbl,'date_hr_res_tbl'=>$date_hr_res_tbl,'client_nom'=>$client_nom,'table_id'=>$table_id,'hotel_id'=>$hotel_id ));
	HDB::hus()->Hinsert('reservation_table', $values);
	}
	
	// UPDATE
	public function Update($date_res_tbl,$date_hr_res_tbl,$client_nom,$table_id,$hotel_id,$id)
	{
	$sql = "  date_res_tbl =:date_res_tbl,date_hr_res_tbl =:date_hr_res_tbl,client_nom =:client_nom,table_id =:table_id,hotel_id =:hotel_id WHERE id_res_table = :id ";
	$data = array(':date_res_tbl'=>$date_res_tbl,':date_hr_res_tbl'=>$date_hr_res_tbl,':client_nom'=>$client_nom,':table_id'=>$table_id,':hotel_id'=>$hotel_id,':id'=>$id);
	HDB::hus()->Hupdate('reservation_table',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	