
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_reserve_chambre_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_reserve_chambre
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_reserve_chambre.php');
	
	class t_reserve_chambre_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_reserve_chambre LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_reserve_chambre");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_reserve_chambre");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_reserve_chambre","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_reserve_chambre","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_reserve_chambre");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_reserve_chambre","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($idreserv,$idchambre,$id_client,$id_accomp,$statut,$occupe,$date_occ,$date_lib,$annule,$est_responsable,$mont_paye_heb,$mont_paye_resto,$monnaie,$tarif_ch,$nom_accomp,$checkin,$checkout,$idfact,$id_hotel)
	{
	
	$values = array(array( 'idreserv'=>$idreserv,'idchambre'=>$idchambre,'id_client'=>$id_client,'id_accomp'=>$id_accomp,'statut'=>$statut,'occupe'=>$occupe,'date_occ'=>$date_occ,'date_lib'=>$date_lib,'annule'=>$annule,'est_responsable'=>$est_responsable,'mont_paye_heb'=>$mont_paye_heb,'mont_paye_resto'=>$mont_paye_resto,'monnaie'=>$monnaie,'tarif_ch'=>$tarif_ch,'nom_accomp'=>$nom_accomp,'checkin'=>$checkin,'checkout'=>$checkout,'idfact'=>$idfact,'id_hotel'=>$id_hotel ));
	HDB::hus()->Hinsert('t_reserve_chambre', $values);
	}
	
	// UPDATE
	public function Update($idreserv,$idchambre,$id_client,$id_accomp,$statut,$occupe,$date_occ,$date_lib,$annule,$est_responsable,$mont_paye_heb,$mont_paye_resto,$monnaie,$tarif_ch,$nom_accomp,$checkin,$checkout,$idfact,$id_hotel,$id)
	{
	$sql = "  idreserv =:idreserv,idchambre =:idchambre,id_client =:id_client,id_accomp =:id_accomp,statut =:statut,occupe =:occupe,date_occ =:date_occ,date_lib =:date_lib,annule =:annule,est_responsable =:est_responsable,mont_paye_heb =:mont_paye_heb,mont_paye_resto =:mont_paye_resto,monnaie =:monnaie,tarif_ch =:tarif_ch,nom_accomp =:nom_accomp,checkin =:checkin,checkout =:checkout,idfact =:idfact,id_hotel =:id_hotel WHERE id = :id ";
	$data = array(':idreserv'=>$idreserv,':idchambre'=>$idchambre,':id_client'=>$id_client,':id_accomp'=>$id_accomp,':statut'=>$statut,':occupe'=>$occupe,':date_occ'=>$date_occ,':date_lib'=>$date_lib,':annule'=>$annule,':est_responsable'=>$est_responsable,':mont_paye_heb'=>$mont_paye_heb,':mont_paye_resto'=>$mont_paye_resto,':monnaie'=>$monnaie,':tarif_ch'=>$tarif_ch,':nom_accomp'=>$nom_accomp,':checkin'=>$checkin,':checkout'=>$checkout,':idfact'=>$idfact,':id_hotel'=>$id_hotel,':id'=>$id);
	HDB::hus()->Hupdate('t_reserve_chambre',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	