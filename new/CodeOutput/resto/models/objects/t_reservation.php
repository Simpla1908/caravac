
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_reservation_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_reservation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_reservation.php');
	
	class t_reservation_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_reservation LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_reservation");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_reservation");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_reservation","id_res=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_reservation","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_reservation");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_reservation","id_res=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($num_reserv,$garantie,$num_bc,$num_occ,$num_com,$type,$tva,$taux,$remise,$majoration,$mont_nuite,$mont_total_res,$mont_par_chambre,$monnaie,$nbr_ch,$etat,$etat_credit,$dte,$date_res,$date_occ,$date_lib,$statut_res,$statut_occ,$statut_sorti,$id_client,$chambr_id,$id_hotel,$dte_a,$dte_s,$occ_indirect,$respo_id)
	{
	
	$values = array(array( 'num_reserv'=>$num_reserv,'garantie'=>$garantie,'num_bc'=>$num_bc,'num_occ'=>$num_occ,'num_com'=>$num_com,'type'=>$type,'tva'=>$tva,'taux'=>$taux,'remise'=>$remise,'majoration'=>$majoration,'mont_nuite'=>$mont_nuite,'mont_total_res'=>$mont_total_res,'mont_par_chambre'=>$mont_par_chambre,'monnaie'=>$monnaie,'nbr_ch'=>$nbr_ch,'etat'=>$etat,'etat_credit'=>$etat_credit,'dte'=>$dte,'date_res'=>$date_res,'date_occ'=>$date_occ,'date_lib'=>$date_lib,'statut_res'=>$statut_res,'statut_occ'=>$statut_occ,'statut_sorti'=>$statut_sorti,'id_client'=>$id_client,'chambr_id'=>$chambr_id,'id_hotel'=>$id_hotel,'dte_a'=>$dte_a,'dte_s'=>$dte_s,'occ_indirect'=>$occ_indirect,'respo_id'=>$respo_id ));
	HDB::hus()->Hinsert('t_reservation', $values);
	}
	
	// UPDATE
	public function Update($num_reserv,$garantie,$num_bc,$num_occ,$num_com,$type,$tva,$taux,$remise,$majoration,$mont_nuite,$mont_total_res,$mont_par_chambre,$monnaie,$nbr_ch,$etat,$etat_credit,$dte,$date_res,$date_occ,$date_lib,$statut_res,$statut_occ,$statut_sorti,$id_client,$chambr_id,$id_hotel,$dte_a,$dte_s,$occ_indirect,$respo_id,$id)
	{
	$sql = "  num_reserv =:num_reserv,garantie =:garantie,num_bc =:num_bc,num_occ =:num_occ,num_com =:num_com,type =:type,tva =:tva,taux =:taux,remise =:remise,majoration =:majoration,mont_nuite =:mont_nuite,mont_total_res =:mont_total_res,mont_par_chambre =:mont_par_chambre,monnaie =:monnaie,nbr_ch =:nbr_ch,etat =:etat,etat_credit =:etat_credit,dte =:dte,date_res =:date_res,date_occ =:date_occ,date_lib =:date_lib,statut_res =:statut_res,statut_occ =:statut_occ,statut_sorti =:statut_sorti,id_client =:id_client,chambr_id =:chambr_id,id_hotel =:id_hotel,dte_a =:dte_a,dte_s =:dte_s,occ_indirect =:occ_indirect,respo_id =:respo_id WHERE id_res = :id ";
	$data = array(':num_reserv'=>$num_reserv,':garantie'=>$garantie,':num_bc'=>$num_bc,':num_occ'=>$num_occ,':num_com'=>$num_com,':type'=>$type,':tva'=>$tva,':taux'=>$taux,':remise'=>$remise,':majoration'=>$majoration,':mont_nuite'=>$mont_nuite,':mont_total_res'=>$mont_total_res,':mont_par_chambre'=>$mont_par_chambre,':monnaie'=>$monnaie,':nbr_ch'=>$nbr_ch,':etat'=>$etat,':etat_credit'=>$etat_credit,':dte'=>$dte,':date_res'=>$date_res,':date_occ'=>$date_occ,':date_lib'=>$date_lib,':statut_res'=>$statut_res,':statut_occ'=>$statut_occ,':statut_sorti'=>$statut_sorti,':id_client'=>$id_client,':chambr_id'=>$chambr_id,':id_hotel'=>$id_hotel,':dte_a'=>$dte_a,':dte_s'=>$dte_s,':occ_indirect'=>$occ_indirect,':respo_id'=>$respo_id,':id'=>$id);
	HDB::hus()->Hupdate('t_reservation',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	