
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        resemploycontr_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resemploycontr
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_resemploycontr.php');
	
	class resemploycontr_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("resemploycontr LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("resemploycontr");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("resemploycontr");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("resemploycontr","idemplcontr=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("resemploycontr","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE resemploycontr");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("resemploycontr","idemplcontr=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($idemploy,$idcontr,$datedbtcontr,$datefincontr)
	{
	
	$values = array(array( 'idemploy'=>$idemploy,'idcontr'=>$idcontr,'datedbtcontr'=>$datedbtcontr,'datefincontr'=>$datefincontr ));
	HDB::hus()->Hinsert('resemploycontr', $values);
	}
	
	// UPDATE
	public function Update($idemploy,$idcontr,$datedbtcontr,$datefincontr,$id)
	{
	$sql = "  idemploy =:idemploy,idcontr =:idcontr,datedbtcontr =:datedbtcontr,datefincontr =:datefincontr WHERE idemplcontr = :id ";
	$data = array(':idemploy'=>$idemploy,':idcontr'=>$idcontr,':datedbtcontr'=>$datedbtcontr,':datefincontr'=>$datefincontr,':id'=>$id);
	HDB::hus()->Hupdate('resemploycontr',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	