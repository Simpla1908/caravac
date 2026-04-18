
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_motif_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_motif
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_motif.php');
	
	class t_motif_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_motif LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_motif");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_motif");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_motif","idmotif=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_motif","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_motif");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_motif","idmotif=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($designation,$hotel_id,$type_id)
	{
	
	$values = array(array( 'designation'=>$designation,'hotel_id'=>$hotel_id,'type_id'=>$type_id ));
	HDB::hus()->Hinsert('t_motif', $values);
	}
	
	// UPDATE
	public function Update($designation,$hotel_id,$type_id,$id)
	{
	$sql = "  designation =:designation,hotel_id =:hotel_id,type_id =:type_id WHERE idmotif = :id ";
	$data = array(':designation'=>$designation,':hotel_id'=>$hotel_id,':type_id'=>$type_id,':id'=>$id);
	HDB::hus()->Hupdate('t_motif',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	