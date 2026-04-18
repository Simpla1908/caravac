
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        monnaie_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		monnaie
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_monnaie.php');
	
	class monnaie_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("monnaie LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("monnaie");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("monnaie");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("monnaie","id_monnaie=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("monnaie","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE monnaie");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("monnaie","id_monnaie=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($monnaie,$lib_monnaie,$symbole,$choix,$taux,$tva,$id_hotel,$company_id)
	{
	
	$values = array(array( 'monnaie'=>$monnaie,'lib_monnaie'=>$lib_monnaie,'symbole'=>$symbole,'choix'=>$choix,'taux'=>$taux,'tva'=>$tva,'id_hotel'=>$id_hotel,'company_id'=>$company_id ));
	HDB::hus()->Hinsert('monnaie', $values);
	}
	
	// UPDATE
	public function Update($monnaie,$lib_monnaie,$symbole,$choix,$taux,$tva,$id_hotel,$company_id,$id)
	{
	$sql = "  monnaie =:monnaie,lib_monnaie =:lib_monnaie,symbole =:symbole,choix =:choix,taux =:taux,tva =:tva,id_hotel =:id_hotel,company_id =:company_id WHERE id_monnaie = :id ";
	$data = array(':monnaie'=>$monnaie,':lib_monnaie'=>$lib_monnaie,':symbole'=>$symbole,':choix'=>$choix,':taux'=>$taux,':tva'=>$tva,':id_hotel'=>$id_hotel,':company_id'=>$company_id,':id'=>$id);
	HDB::hus()->Hupdate('monnaie',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	