
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        paiement_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		paiement
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_paiement.php');
	
	class paiement_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("paiement LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("paiement");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("paiement");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("paiement","idpaie=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("paiement","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE paiement");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("paiement","idpaie=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($montant,$montantusd,$montantcdf,$taux,$rendu,$remise,$justification,$id_mode_regl,$id_monnaie,$regl_id,$site_id,$company_id)
	{
	
	$values = array(array( 'montant'=>$montant,'montantusd'=>$montantusd,'montantcdf'=>$montantcdf,'taux'=>$taux,'rendu'=>$rendu,'remise'=>$remise,'justification'=>$justification,'id_mode_regl'=>$id_mode_regl,'id_monnaie'=>$id_monnaie,'regl_id'=>$regl_id,'site_id'=>$site_id,'company_id'=>$company_id ));
	HDB::hus()->Hinsert('paiement', $values);
	}
	
	// UPDATE
	public function Update($montant,$montantusd,$montantcdf,$taux,$rendu,$remise,$justification,$id_mode_regl,$id_monnaie,$regl_id,$site_id,$company_id,$id)
	{
	$sql = "  montant =:montant,montantusd =:montantusd,montantcdf =:montantcdf,taux =:taux,rendu =:rendu,remise =:remise,justification =:justification,id_mode_regl =:id_mode_regl,id_monnaie =:id_monnaie,regl_id =:regl_id,site_id =:site_id,company_id =:company_id WHERE idpaie = :id ";
	$data = array(':montant'=>$montant,':montantusd'=>$montantusd,':montantcdf'=>$montantcdf,':taux'=>$taux,':rendu'=>$rendu,':remise'=>$remise,':justification'=>$justification,':id_mode_regl'=>$id_mode_regl,':id_monnaie'=>$id_monnaie,':regl_id'=>$regl_id,':site_id'=>$site_id,':company_id'=>$company_id,':id'=>$id);
	HDB::hus()->Hupdate('paiement',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	