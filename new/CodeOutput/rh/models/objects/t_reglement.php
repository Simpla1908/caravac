
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_reglement_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_reglement
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_reglement.php');
	
	class t_reglement_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_reglement LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_reglement");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_reglement");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_reglement","id_regl=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_reglement","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_reglement");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_reglement","id_regl=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($numero,$montant_dollar,$montant_fc,$reste,$id_mode_regl,$date_regl,$dte,$rejete,$id_fact,$id_monnaie,$id_user,$id_hotel)
	{
	
	$values = array(array( 'numero'=>$numero,'montant_dollar'=>$montant_dollar,'montant_fc'=>$montant_fc,'reste'=>$reste,'id_mode_regl'=>$id_mode_regl,'date_regl'=>$date_regl,'dte'=>$dte,'rejete'=>$rejete,'id_fact'=>$id_fact,'id_monnaie'=>$id_monnaie,'id_user'=>$id_user,'id_hotel'=>$id_hotel ));
	HDB::hus()->Hinsert('t_reglement', $values);
	}
	
	// UPDATE
	public function Update($numero,$montant_dollar,$montant_fc,$reste,$id_mode_regl,$date_regl,$dte,$rejete,$id_fact,$id_monnaie,$id_user,$id_hotel,$id)
	{
	$sql = "  numero =:numero,montant_dollar =:montant_dollar,montant_fc =:montant_fc,reste =:reste,id_mode_regl =:id_mode_regl,date_regl =:date_regl,dte =:dte,rejete =:rejete,id_fact =:id_fact,id_monnaie =:id_monnaie,id_user =:id_user,id_hotel =:id_hotel WHERE id_regl = :id ";
	$data = array(':numero'=>$numero,':montant_dollar'=>$montant_dollar,':montant_fc'=>$montant_fc,':reste'=>$reste,':id_mode_regl'=>$id_mode_regl,':date_regl'=>$date_regl,':dte'=>$dte,':rejete'=>$rejete,':id_fact'=>$id_fact,':id_monnaie'=>$id_monnaie,':id_user'=>$id_user,':id_hotel'=>$id_hotel,':id'=>$id);
	HDB::hus()->Hupdate('t_reglement',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	