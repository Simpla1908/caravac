
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_versement_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_versement
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_versement.php');
	
	class t_versement_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_versement LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_versement");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_versement");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_versement","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_versement","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_versement");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_versement","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($user_vers,$date_vers,$montant_vers,$montantusd,$monaie_vers,$taux,$motif,$type_vers,$paie_id,$id_hotel)
	{
	
	$values = array(array( 'user_vers'=>$user_vers,'date_vers'=>$date_vers,'montant_vers'=>$montant_vers,'montantusd'=>$montantusd,'monaie_vers'=>$monaie_vers,'taux'=>$taux,'motif'=>$motif,'type_vers'=>$type_vers,'paie_id'=>$paie_id,'id_hotel'=>$id_hotel ));
	HDB::hus()->Hinsert('t_versement', $values);
	}
	
	// UPDATE
	public function Update($user_vers,$date_vers,$montant_vers,$montantusd,$monaie_vers,$taux,$motif,$type_vers,$paie_id,$id_hotel,$id)
	{
	$sql = "  user_vers =:user_vers,date_vers =:date_vers,montant_vers =:montant_vers,montantusd =:montantusd,monaie_vers =:monaie_vers,taux =:taux,motif =:motif,type_vers =:type_vers,paie_id =:paie_id,id_hotel =:id_hotel WHERE id = :id ";
	$data = array(':user_vers'=>$user_vers,':date_vers'=>$date_vers,':montant_vers'=>$montant_vers,':montantusd'=>$montantusd,':monaie_vers'=>$monaie_vers,':taux'=>$taux,':motif'=>$motif,':type_vers'=>$type_vers,':paie_id'=>$paie_id,':id_hotel'=>$id_hotel,':id'=>$id);
	HDB::hus()->Hupdate('t_versement',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	