
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        bon_commandes_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		bon_commandes
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_bon_commandes.php');
	
	class bon_commandes_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("bon_commandes LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("bon_commandes");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("bon_commandes");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("bon_commandes","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("bon_commandes","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE bon_commandes");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("bon_commandes","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($commande_id,$produit_id,$nameprod,$statut,$quantite,$user_id,$hotel_id,$dte,$dte_h)
	{
	
	$values = array(array( 'commande_id'=>$commande_id,'produit_id'=>$produit_id,'nameprod'=>$nameprod,'statut'=>$statut,'quantite'=>$quantite,'user_id'=>$user_id,'hotel_id'=>$hotel_id,'dte'=>$dte,'dte_h'=>$dte_h ));
	HDB::hus()->Hinsert('bon_commandes', $values);
	}
	
	// UPDATE
	public function Update($commande_id,$produit_id,$nameprod,$statut,$quantite,$user_id,$hotel_id,$dte,$dte_h,$id)
	{
	$sql = "  commande_id =:commande_id,produit_id =:produit_id,nameprod =:nameprod,statut =:statut,quantite =:quantite,user_id =:user_id,hotel_id =:hotel_id,dte =:dte,dte_h =:dte_h WHERE id = :id ";
	$data = array(':commande_id'=>$commande_id,':produit_id'=>$produit_id,':nameprod'=>$nameprod,':statut'=>$statut,':quantite'=>$quantite,':user_id'=>$user_id,':hotel_id'=>$hotel_id,':dte'=>$dte,':dte_h'=>$dte_h,':id'=>$id);
	HDB::hus()->Hupdate('bon_commandes',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	