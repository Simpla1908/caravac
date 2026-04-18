
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_histo_heberge_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_histo_heberge
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_histo_heberge.php');
	
	class t_histo_heberge_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_histo_heberge LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_histo_heberge");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_histo_heberge");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_histo_heberge","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_histo_heberge","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_histo_heberge");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_histo_heberge","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($idreserv,$idchambre,$statut,$date_occ,$date_lib,$monnaie,$tarif_ch,$idfact,$id_hotel)
	{
	
	$values = array(array( 'idreserv'=>$idreserv,'idchambre'=>$idchambre,'statut'=>$statut,'date_occ'=>$date_occ,'date_lib'=>$date_lib,'monnaie'=>$monnaie,'tarif_ch'=>$tarif_ch,'idfact'=>$idfact,'id_hotel'=>$id_hotel ));
	HDB::hus()->Hinsert('t_histo_heberge', $values);
	}
	
	// UPDATE
	public function Update($idreserv,$idchambre,$statut,$date_occ,$date_lib,$monnaie,$tarif_ch,$idfact,$id_hotel,$id)
	{
	$sql = "  idreserv =:idreserv,idchambre =:idchambre,statut =:statut,date_occ =:date_occ,date_lib =:date_lib,monnaie =:monnaie,tarif_ch =:tarif_ch,idfact =:idfact,id_hotel =:id_hotel WHERE id = :id ";
	$data = array(':idreserv'=>$idreserv,':idchambre'=>$idchambre,':statut'=>$statut,':date_occ'=>$date_occ,':date_lib'=>$date_lib,':monnaie'=>$monnaie,':tarif_ch'=>$tarif_ch,':idfact'=>$idfact,':id_hotel'=>$id_hotel,':id'=>$id);
	HDB::hus()->Hupdate('t_histo_heberge',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	