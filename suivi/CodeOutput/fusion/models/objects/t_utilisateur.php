
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_utilisateur_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_utilisateur
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_utilisateur.php');
	
	class t_utilisateur_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_utilisateur LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_utilisateur");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_utilisateur");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_utilisateur","id_user=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_utilisateur","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_utilisateur");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_utilisateur","id_user=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($nom_user,$prenom_user,$sexe_user,$telephone_user,$email_user,$mdp_user,$adresse_mail,$type,$actif,$id_hotel,$company_id,$id_droit,$fconnect,$connect)
	{
	
	$values = array(array( 'nom_user'=>$nom_user,'prenom_user'=>$prenom_user,'sexe_user'=>$sexe_user,'telephone_user'=>$telephone_user,'email_user'=>$email_user,'mdp_user'=>$mdp_user,'adresse_mail'=>$adresse_mail,'type'=>$type,'actif'=>$actif,'id_hotel'=>$id_hotel,'company_id'=>$company_id,'id_droit'=>$id_droit,'fconnect'=>$fconnect,'connect'=>$connect ));
	HDB::hus()->Hinsert('t_utilisateur', $values);
	}
	
	// UPDATE
	public function Update($nom_user,$prenom_user,$sexe_user,$telephone_user,$email_user,$mdp_user,$adresse_mail,$type,$actif,$id_hotel,$company_id,$id_droit,$fconnect,$connect,$id)
	{
	$sql = "  nom_user =:nom_user,prenom_user =:prenom_user,sexe_user =:sexe_user,telephone_user =:telephone_user,email_user =:email_user,mdp_user =:mdp_user,adresse_mail =:adresse_mail,type =:type,actif =:actif,id_hotel =:id_hotel,company_id =:company_id,id_droit =:id_droit,fconnect =:fconnect,connect =:connect WHERE id_user = :id ";
	$data = array(':nom_user'=>$nom_user,':prenom_user'=>$prenom_user,':sexe_user'=>$sexe_user,':telephone_user'=>$telephone_user,':email_user'=>$email_user,':mdp_user'=>$mdp_user,':adresse_mail'=>$adresse_mail,':type'=>$type,':actif'=>$actif,':id_hotel'=>$id_hotel,':company_id'=>$company_id,':id_droit'=>$id_droit,':fconnect'=>$fconnect,':connect'=>$connect,':id'=>$id);
	HDB::hus()->Hupdate('t_utilisateur',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	