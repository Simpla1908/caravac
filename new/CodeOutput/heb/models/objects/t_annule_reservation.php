
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_annule_reservation_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_annule_reservation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_annule_reservation.php');
	
	class t_annule_reservation_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_annule_reservation LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_annule_reservation");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_annule_reservation");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_annule_reservation","id_annule=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_annule_reservation","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_annule_reservation");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_annule_reservation","id_annule=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($id_res,$id_ch,$id_user,$id_regl,$Montant_retirer,$monnaie,$poucentage,$mont_remb,$date_annule_res,$date_annule)
	{
	
	$values = array(array( 'id_res'=>$id_res,'id_ch'=>$id_ch,'id_user'=>$id_user,'id_regl'=>$id_regl,'Montant_retirer'=>$Montant_retirer,'monnaie'=>$monnaie,'poucentage'=>$poucentage,'mont_remb'=>$mont_remb,'date_annule_res'=>$date_annule_res,'date_annule'=>$date_annule ));
	HDB::hus()->Hinsert('t_annule_reservation', $values);
	}
	
	// UPDATE
	public function Update($id_res,$id_ch,$id_user,$id_regl,$Montant_retirer,$monnaie,$poucentage,$mont_remb,$date_annule_res,$date_annule,$id)
	{
	$sql = "  id_res =:id_res,id_ch =:id_ch,id_user =:id_user,id_regl =:id_regl,Montant_retirer =:Montant_retirer,monnaie =:monnaie,poucentage =:poucentage,mont_remb =:mont_remb,date_annule_res =:date_annule_res,date_annule =:date_annule WHERE id_annule = :id ";
	$data = array(':id_res'=>$id_res,':id_ch'=>$id_ch,':id_user'=>$id_user,':id_regl'=>$id_regl,':Montant_retirer'=>$Montant_retirer,':monnaie'=>$monnaie,':poucentage'=>$poucentage,':mont_remb'=>$mont_remb,':date_annule_res'=>$date_annule_res,':date_annule'=>$date_annule,':id'=>$id);
	HDB::hus()->Hupdate('t_annule_reservation',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	