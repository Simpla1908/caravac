
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_reglage_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_reglage
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_reglage.php');
	
	class t_reglage_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_reglage LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_reglage");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_reglage");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_reglage","id_regl=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_reglage","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_reglage");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_reglage","id_regl=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($remise,$majoration,$date_regl,$dte_h,$temps_regl,$time_checkin,$m_insert,$m_affiche,$tauxdollar,$taux_op,$tva,$pourcentage_defaut,$pourcentage_24_heure,$pourcentage_48_heure,$pourcentage_72_heure,$pourcentage_sup_72_heure,$type_annul,$fcon_heberge,$user_id,$id_hotel,$company_id)
	{
	
	$values = array(array( 'remise'=>$remise,'majoration'=>$majoration,'date_regl'=>$date_regl,'dte_h'=>$dte_h,'temps_regl'=>$temps_regl,'time_checkin'=>$time_checkin,'m_insert'=>$m_insert,'m_affiche'=>$m_affiche,'tauxdollar'=>$tauxdollar,'taux_op'=>$taux_op,'tva'=>$tva,'pourcentage_defaut'=>$pourcentage_defaut,'pourcentage_24_heure'=>$pourcentage_24_heure,'pourcentage_48_heure'=>$pourcentage_48_heure,'pourcentage_72_heure'=>$pourcentage_72_heure,'pourcentage_sup_72_heure'=>$pourcentage_sup_72_heure,'type_annul'=>$type_annul,'fcon_heberge'=>$fcon_heberge,'user_id'=>$user_id,'id_hotel'=>$id_hotel,'company_id'=>$company_id ));
	HDB::hus()->Hinsert('t_reglage', $values);
	}
	
	// UPDATE
	public function Update($remise,$majoration,$date_regl,$dte_h,$temps_regl,$time_checkin,$m_insert,$m_affiche,$tauxdollar,$taux_op,$tva,$pourcentage_defaut,$pourcentage_24_heure,$pourcentage_48_heure,$pourcentage_72_heure,$pourcentage_sup_72_heure,$type_annul,$fcon_heberge,$user_id,$id_hotel,$company_id,$id)
	{
	$sql = "  remise =:remise,majoration =:majoration,date_regl =:date_regl,dte_h =:dte_h,temps_regl =:temps_regl,time_checkin =:time_checkin,m_insert =:m_insert,m_affiche =:m_affiche,tauxdollar =:tauxdollar,taux_op =:taux_op,tva =:tva,pourcentage_defaut =:pourcentage_defaut,pourcentage_24_heure =:pourcentage_24_heure,pourcentage_48_heure =:pourcentage_48_heure,pourcentage_72_heure =:pourcentage_72_heure,pourcentage_sup_72_heure =:pourcentage_sup_72_heure,type_annul =:type_annul,fcon_heberge =:fcon_heberge,user_id =:user_id,id_hotel =:id_hotel,company_id =:company_id WHERE id_regl = :id ";
	$data = array(':remise'=>$remise,':majoration'=>$majoration,':date_regl'=>$date_regl,':dte_h'=>$dte_h,':temps_regl'=>$temps_regl,':time_checkin'=>$time_checkin,':m_insert'=>$m_insert,':m_affiche'=>$m_affiche,':tauxdollar'=>$tauxdollar,':taux_op'=>$taux_op,':tva'=>$tva,':pourcentage_defaut'=>$pourcentage_defaut,':pourcentage_24_heure'=>$pourcentage_24_heure,':pourcentage_48_heure'=>$pourcentage_48_heure,':pourcentage_72_heure'=>$pourcentage_72_heure,':pourcentage_sup_72_heure'=>$pourcentage_sup_72_heure,':type_annul'=>$type_annul,':fcon_heberge'=>$fcon_heberge,':user_id'=>$user_id,':id_hotel'=>$id_hotel,':company_id'=>$company_id,':id'=>$id);
	HDB::hus()->Hupdate('t_reglage',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	