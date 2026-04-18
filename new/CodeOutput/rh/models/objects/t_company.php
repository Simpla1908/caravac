
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_company_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_company
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_company.php');
	
	class t_company_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_company LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_company");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_company");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_company","id_c=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_company","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_company");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_company","id_c=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($nom_c,$etat,$adresse_c,$logo,$idnat,$rccm,$mail_company,$ville,$phone,$num_impot,$cb,$mention)
	{
	
	$values = array(array( 'nom_c'=>$nom_c,'etat'=>$etat,'adresse_c'=>$adresse_c,'logo'=>$logo,'idnat'=>$idnat,'rccm'=>$rccm,'mail_company'=>$mail_company,'ville'=>$ville,'phone'=>$phone,'num_impot'=>$num_impot,'cb'=>$cb,'mention'=>$mention ));
	HDB::hus()->Hinsert('t_company', $values);
	}
	
	// UPDATE
	public function Update($nom_c,$etat,$adresse_c,$logo,$idnat,$rccm,$mail_company,$ville,$phone,$num_impot,$cb,$mention,$id)
	{
	$sql = "  nom_c =:nom_c,etat =:etat,adresse_c =:adresse_c,logo =:logo,idnat =:idnat,rccm =:rccm,mail_company =:mail_company,ville =:ville,phone =:phone,num_impot =:num_impot,cb =:cb,mention =:mention WHERE id_c = :id ";
	$data = array(':nom_c'=>$nom_c,':etat'=>$etat,':adresse_c'=>$adresse_c,':logo'=>$logo,':idnat'=>$idnat,':rccm'=>$rccm,':mail_company'=>$mail_company,':ville'=>$ville,':phone'=>$phone,':num_impot'=>$num_impot,':cb'=>$cb,':mention'=>$mention,':id'=>$id);
	HDB::hus()->Hupdate('t_company',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	