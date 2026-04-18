
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_occupation_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_occupation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_occupation.php');
	
	class t_occupation_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_occupation LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_occupation");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_occupation");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_occupation","id_occ=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_occupation","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_occupation");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_occupation","id_occ=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($type_occ,$date_occ,$heure_occ,$id_ch,$id_client)
	{
	
	$values = array(array( 'type_occ'=>$type_occ,'date_occ'=>$date_occ,'heure_occ'=>$heure_occ,'id_ch'=>$id_ch,'id_client'=>$id_client ));
	HDB::hus()->Hinsert('t_occupation', $values);
	}
	
	// UPDATE
	public function Update($type_occ,$date_occ,$heure_occ,$id_ch,$id_client,$id)
	{
	$sql = "  type_occ =:type_occ,date_occ =:date_occ,heure_occ =:heure_occ,id_ch =:id_ch,id_client =:id_client WHERE id_occ = :id ";
	$data = array(':type_occ'=>$type_occ,':date_occ'=>$date_occ,':heure_occ'=>$heure_occ,':id_ch'=>$id_ch,':id_client'=>$id_client,':id'=>$id);
	HDB::hus()->Hupdate('t_occupation',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	