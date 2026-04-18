
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_chambre_histo_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_chambre_histo
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_chambre_histo.php');
	
	class t_chambre_histo_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_chambre_histo LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_chambre_histo");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_chambre_histo");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_chambre_histo","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_chambre_histo","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_chambre_histo");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_chambre_histo","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($idres_ch,$idchambre,$statut,$date_occ,$date_lib,$tarif_ch,$monnaie)
	{
	
	$values = array(array( 'idres_ch'=>$idres_ch,'idchambre'=>$idchambre,'statut'=>$statut,'date_occ'=>$date_occ,'date_lib'=>$date_lib,'tarif_ch'=>$tarif_ch,'monnaie'=>$monnaie ));
	HDB::hus()->Hinsert('t_chambre_histo', $values);
	}
	
	// UPDATE
	public function Update($idres_ch,$idchambre,$statut,$date_occ,$date_lib,$tarif_ch,$monnaie,$id)
	{
	$sql = "  idres_ch =:idres_ch,idchambre =:idchambre,statut =:statut,date_occ =:date_occ,date_lib =:date_lib,tarif_ch =:tarif_ch,monnaie =:monnaie WHERE id = :id ";
	$data = array(':idres_ch'=>$idres_ch,':idchambre'=>$idchambre,':statut'=>$statut,':date_occ'=>$date_occ,':date_lib'=>$date_lib,':tarif_ch'=>$tarif_ch,':monnaie'=>$monnaie,':id'=>$id);
	HDB::hus()->Hupdate('t_chambre_histo',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	