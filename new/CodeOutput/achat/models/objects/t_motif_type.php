
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_motif_type_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_motif_type
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_motif_type.php');
	
	class t_motif_type_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_motif_type LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_motif_type");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_motif_type");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_motif_type","idmotiftype=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_motif_type","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_motif_type");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_motif_type","idmotiftype=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($type,$visible,$hotel_id)
	{
	
	$values = array(array( 'type'=>$type,'visible'=>$visible,'hotel_id'=>$hotel_id ));
	HDB::hus()->Hinsert('t_motif_type', $values);
	}
	
	// UPDATE
	public function Update($type,$visible,$hotel_id,$id)
	{
	$sql = "  type =:type,visible =:visible,hotel_id =:hotel_id WHERE idmotiftype = :id ";
	$data = array(':type'=>$type,':visible'=>$visible,':hotel_id'=>$hotel_id,':id'=>$id);
	HDB::hus()->Hupdate('t_motif_type',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	