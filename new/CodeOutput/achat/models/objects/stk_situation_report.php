
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        stk_situation_report_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		stk_situation_report
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_stk_situation_report.php');
	
	class stk_situation_report_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("stk_situation_report LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("stk_situation_report");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("stk_situation_report");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("stk_situation_report","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("stk_situation_report","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE stk_situation_report");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("stk_situation_report","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($report_effectue_date)
	{
	
	$values = array(array( 'report_effectue_date'=>$report_effectue_date ));
	HDB::hus()->Hinsert('stk_situation_report', $values);
	}
	
	// UPDATE
	public function Update($report_effectue_date,$id)
	{
	$sql = "  report_effectue_date =:report_effectue_date WHERE id = :id ";
	$data = array(':report_effectue_date'=>$report_effectue_date,':id'=>$id);
	HDB::hus()->Hupdate('stk_situation_report',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	