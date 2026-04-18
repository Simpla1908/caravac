
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        ach_produits_livres_model
	* DATE CREATED:  	09-07-2018
	* FOR TABLE:  		ach_produits_livres
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_ach_produits_livres.php');
	
	class ach_produits_livres_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("ach_produits_livres LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("ach_produits_livres");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("ach_produits_livres");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("ach_produits_livres","id_produit_liv=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("ach_produits_livres","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE ach_produits_livres");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("ach_produits_livres","id_produit_liv=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($quantite_cmd,$quantite_liv,$observation,$produit_id,$livraison_id,$user_id)
	{
	
	$values = array(array( 'quantite_cmd'=>$quantite_cmd,'quantite_liv'=>$quantite_liv,'observation'=>$observation,'produit_id'=>$produit_id,'livraison_id'=>$livraison_id,'user_id'=>$user_id ));
	HDB::hus()->Hinsert('ach_produits_livres', $values);
	}
        
        public function InsertLigneLiv($qte_cmd,$quantite_cmd,$quantite_liv,$observation,$produit_id,$livraison_id,$user_id,$hotel_id)
	{
	
	$values = array(array( 'quantite'=>$qte_cmd,'quantite_cmd'=>$quantite_cmd,'quantite_liv'=>$quantite_liv,'observation'=>$observation,'produit_id'=>$produit_id,'livraison_id'=>$livraison_id,'user_id'=>$user_id,'hotel_id'=>$hotel_id ));
	HDB::hus()->Hinsert('ach_produits_livres', $values);
	}
	
	// UPDATE
	public function Update($quantite_cmd,$quantite_liv,$observation,$produit_id,$livraison_id,$user_id,$id)
	{
	$sql = "  quantite_cmd =:quantite_cmd,quantite_liv =:quantite_liv,observation =:observation,produit_id =:produit_id,livraison_id =:livraison_id,user_id =:user_id WHERE id_produit_liv = :id ";
	$data = array(':quantite_cmd'=>$quantite_cmd,':quantite_liv'=>$quantite_liv,':observation'=>$observation,':produit_id'=>$produit_id,':livraison_id'=>$livraison_id,':user_id'=>$user_id,':id'=>$id);
	HDB::hus()->Hupdate('ach_produits_livres',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	