
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_session_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_session
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_session.php');
	
	class t_session_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_session LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_session");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_session");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_session","idsession=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_session","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_session");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_session","idsession=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($date_ouverture,$date_fermeture,$statut,$dte_heure_ouvert,$dte_heure_ferm,$user_id,$caisse_id,$hotel_id)
	{
	
	$values = array(array( 'date_ouverture'=>$date_ouverture,'date_fermeture'=>$date_fermeture,'statut'=>$statut,'dte_heure_ouvert'=>$dte_heure_ouvert,'dte_heure_ferm'=>$dte_heure_ferm,'user_id'=>$user_id,'caisse_id'=>$caisse_id,'hotel_id'=>$hotel_id ));
	HDB::hus()->Hinsert('t_session', $values);
	}
	
	// UPDATE
	public function Update($date_ouverture,$date_fermeture,$statut,$dte_heure_ouvert,$dte_heure_ferm,$user_id,$caisse_id,$hotel_id,$id)
	{
	$sql = "  date_ouverture =:date_ouverture,date_fermeture =:date_fermeture,statut =:statut,dte_heure_ouvert =:dte_heure_ouvert,dte_heure_ferm =:dte_heure_ferm,user_id =:user_id,caisse_id =:caisse_id,hotel_id =:hotel_id WHERE idsession = :id ";
	$data = array(':date_ouverture'=>$date_ouverture,':date_fermeture'=>$date_fermeture,':statut'=>$statut,':dte_heure_ouvert'=>$dte_heure_ouvert,':dte_heure_ferm'=>$dte_heure_ferm,':user_id'=>$user_id,':caisse_id'=>$caisse_id,':hotel_id'=>$hotel_id,':id'=>$id);
	HDB::hus()->Hupdate('t_session',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	