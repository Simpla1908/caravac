
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_liberation_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_liberation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_liberation.php');
	
	class t_liberation_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_liberation LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_liberation");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_liberation");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_liberation","id_lib=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_liberation","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_liberation");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_liberation","id_lib=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($date_lib,$heure_lib,$id_ch,$id_client,$id_hotel,$id_res,$id_reser_cham,$id_user,$dte_lib)
	{
	
	$values = array(array( 'date_lib'=>$date_lib,'heure_lib'=>$heure_lib,'id_ch'=>$id_ch,'id_client'=>$id_client,'id_hotel'=>$id_hotel,'id_res'=>$id_res,'id_reser_cham'=>$id_reser_cham,'id_user'=>$id_user,'dte_lib'=>$dte_lib ));
	HDB::hus()->Hinsert('t_liberation', $values);
	}
	
	// UPDATE
	public function Update($date_lib,$heure_lib,$id_ch,$id_client,$id_hotel,$id_res,$id_reser_cham,$id_user,$dte_lib,$id)
	{
	$sql = "  date_lib =:date_lib,heure_lib =:heure_lib,id_ch =:id_ch,id_client =:id_client,id_hotel =:id_hotel,id_res =:id_res,id_reser_cham =:id_reser_cham,id_user =:id_user,dte_lib =:dte_lib WHERE id_lib = :id ";
	$data = array(':date_lib'=>$date_lib,':heure_lib'=>$heure_lib,':id_ch'=>$id_ch,':id_client'=>$id_client,':id_hotel'=>$id_hotel,':id_res'=>$id_res,':id_reser_cham'=>$id_reser_cham,':id_user'=>$id_user,':dte_lib'=>$dte_lib,':id'=>$id);
	HDB::hus()->Hupdate('t_liberation',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	