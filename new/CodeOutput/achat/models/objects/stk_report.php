
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        stk_report_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		stk_report
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_stk_report.php');
	
	class stk_report_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("stk_report LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("stk_report");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("stk_report");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("stk_report","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("stk_report","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE stk_report");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("stk_report","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($qte_initial_save,$dte_report,$dte_report_time,$produit_id,$idmvt,$hotel_id)
	{
	
	$values = array(array( 'qte_initial_save'=>$qte_initial_save,'dte_report'=>$dte_report,'dte_report_time'=>$dte_report_time,'produit_id'=>$produit_id,'idmvt'=>$idmvt,'hotel_id'=>$hotel_id ));
	HDB::hus()->Hinsert('stk_report', $values);
	}
	
	// UPDATE
	public function Update($qte_initial_save,$dte_report,$dte_report_time,$produit_id,$idmvt,$hotel_id,$id)
	{
	$sql = "  qte_initial_save =:qte_initial_save,dte_report =:dte_report,dte_report_time =:dte_report_time,produit_id =:produit_id,idmvt =:idmvt,hotel_id =:hotel_id WHERE id = :id ";
	$data = array(':qte_initial_save'=>$qte_initial_save,':dte_report'=>$dte_report,':dte_report_time'=>$dte_report_time,':produit_id'=>$produit_id,':idmvt'=>$idmvt,':hotel_id'=>$hotel_id,':id'=>$id);
	HDB::hus()->Hupdate('stk_report',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	