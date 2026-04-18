
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        souscription_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		souscription
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_souscription.php');
	
	class souscription_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("souscription LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("souscription");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("souscription");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("souscription","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("souscription","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE souscription");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("souscription","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($compagny_id,$libelle,$date_sous,$date_activ,$mode_paie,$montant_tot_sous)
	{
	
	$values = array(array( 'compagny_id'=>$compagny_id,'libelle'=>$libelle,'date_sous'=>$date_sous,'date_activ'=>$date_activ,'mode_paie'=>$mode_paie,'montant_tot_sous'=>$montant_tot_sous ));
	HDB::hus()->Hinsert('souscription', $values);
	}
	
	// UPDATE
	public function Update($compagny_id,$libelle,$date_sous,$date_activ,$mode_paie,$montant_tot_sous,$id)
	{
	$sql = "  compagny_id =:compagny_id,libelle =:libelle,date_sous =:date_sous,date_activ =:date_activ,mode_paie =:mode_paie,montant_tot_sous =:montant_tot_sous WHERE id = :id ";
	$data = array(':compagny_id'=>$compagny_id,':libelle'=>$libelle,':date_sous'=>$date_sous,':date_activ'=>$date_activ,':mode_paie'=>$mode_paie,':montant_tot_sous'=>$montant_tot_sous,':id'=>$id);
	HDB::hus()->Hupdate('souscription',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	