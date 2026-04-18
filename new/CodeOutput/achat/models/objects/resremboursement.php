
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        resremboursement_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		resremboursement
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_resremboursement.php');
	
	class resremboursement_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("resremboursement LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("resremboursement");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("resremboursement");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("resremboursement","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("resremboursement","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE resremboursement");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("resremboursement","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($employe_id,$salaire_id,$montant,$monnaie,$taux,$dte,$emprunt_id)
	{
	
	$values = array(array( 'employe_id'=>$employe_id,'salaire_id'=>$salaire_id,'montant'=>$montant,'monnaie'=>$monnaie,'taux'=>$taux,'dte'=>$dte,'emprunt_id'=>$emprunt_id));
	HDB::hus()->Hinsert('resremboursement',$values);
	}
	
	// UPDATE
	public function Update($employe_id,$salaire_id,$montant,$dte,$id)
	{
	$sql = "  employe_id =:employe_id,salaire_id =:salaire_id,montant =:montant,dte =:dte WHERE id = :id ";
	$data = array(':employe_id'=>$employe_id,':salaire_id'=>$salaire_id,':montant'=>$montant,':dte'=>$dte,':id'=>$id);
	HDB::hus()->Hupdate('resremboursement',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	