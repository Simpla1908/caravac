
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_modulecompany_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_modulecompany
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_modulecompany.php');
	
	class t_modulecompany_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_modulecompany LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_modulecompany");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_modulecompany");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_modulecompany","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_modulecompany","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_modulecompany");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_modulecompany","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($nbreuser,$nbre_user_maj,$etat_module,$paye,$montantmodule,$prix_id,$pack_id,$company_id,$module_id,$souscription_id,$date_sous,$date_activ,$date_echeance,$dte_blocage,$site_id)
	{
	
	$values = array(array( 'nbreuser'=>$nbreuser,'nbre_user_maj'=>$nbre_user_maj,'etat_module'=>$etat_module,'paye'=>$paye,'montantmodule'=>$montantmodule,'prix_id'=>$prix_id,'pack_id'=>$pack_id,'company_id'=>$company_id,'module_id'=>$module_id,'souscription_id'=>$souscription_id,'date_sous'=>$date_sous,'date_activ'=>$date_activ,'date_echeance'=>$date_echeance,'dte_blocage'=>$dte_blocage,'site_id'=>$site_id ));
	HDB::hus()->Hinsert('t_modulecompany', $values);
	}
	
	// UPDATE
	public function Update($nbreuser,$nbre_user_maj,$etat_module,$paye,$montantmodule,$prix_id,$pack_id,$company_id,$module_id,$souscription_id,$date_sous,$date_activ,$date_echeance,$dte_blocage,$site_id,$id)
	{
	$sql = "  nbreuser =:nbreuser,nbre_user_maj =:nbre_user_maj,etat_module =:etat_module,paye =:paye,montantmodule =:montantmodule,prix_id =:prix_id,pack_id =:pack_id,company_id =:company_id,module_id =:module_id,souscription_id =:souscription_id,date_sous =:date_sous,date_activ =:date_activ,date_echeance =:date_echeance,dte_blocage =:dte_blocage,site_id =:site_id WHERE id = :id ";
	$data = array(':nbreuser'=>$nbreuser,':nbre_user_maj'=>$nbre_user_maj,':etat_module'=>$etat_module,':paye'=>$paye,':montantmodule'=>$montantmodule,':prix_id'=>$prix_id,':pack_id'=>$pack_id,':company_id'=>$company_id,':module_id'=>$module_id,':souscription_id'=>$souscription_id,':date_sous'=>$date_sous,':date_activ'=>$date_activ,':date_echeance'=>$date_echeance,':dte_blocage'=>$dte_blocage,':site_id'=>$site_id,':id'=>$id);
	HDB::hus()->Hupdate('t_modulecompany',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	