
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_occupation_direct_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_occupation_direct
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_occupation_direct.php');
	
	class t_occupation_direct_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_occupation_direct LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_occupation_direct");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_occupation_direct");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_occupation_direct","id_occ_d=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_occupation_direct","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_occupation_direct");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_occupation_direct","id_occ_d=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($date_occ_d,$heure_occ_d,$id_ch,$id_client)
	{
	
	$values = array(array( 'date_occ_d'=>$date_occ_d,'heure_occ_d'=>$heure_occ_d,'id_ch'=>$id_ch,'id_client'=>$id_client ));
	HDB::hus()->Hinsert('t_occupation_direct', $values);
	}
	
	// UPDATE
	public function Update($date_occ_d,$heure_occ_d,$id_ch,$id_client,$id)
	{
	$sql = "  date_occ_d =:date_occ_d,heure_occ_d =:heure_occ_d,id_ch =:id_ch,id_client =:id_client WHERE id_occ_d = :id ";
	$data = array(':date_occ_d'=>$date_occ_d,':heure_occ_d'=>$heure_occ_d,':id_ch'=>$id_ch,':id_client'=>$id_client,':id'=>$id);
	HDB::hus()->Hupdate('t_occupation_direct',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	