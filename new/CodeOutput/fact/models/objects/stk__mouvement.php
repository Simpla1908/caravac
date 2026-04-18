
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        stk__mouvement_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		stk__mouvement
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_stk__mouvement.php');
	
	class stk__mouvement_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("stk__mouvement LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("stk__mouvement");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("stk__mouvement");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("stk__mouvement","idmvt=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("stk__mouvement","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE stk__mouvement");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("stk__mouvement","idmvt=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($indice_bs,$type,$motif,$num_bon,$qte_entree,$qte_sortie,$dte_appro,$dte_appro_heure,$depot,$produit_id,$user_id,$hotel_id)
	{
	
	$values = array(array( 'indice_bs'=>$indice_bs,'type'=>$type,'motif'=>$motif,'num_bon'=>$num_bon,'qte_entree'=>$qte_entree,'qte_sortie'=>$qte_sortie,'dte_appro'=>$dte_appro,'dte_appro_heure'=>$dte_appro_heure,'depot'=>$depot,'produit_id'=>$produit_id,'user_id'=>$user_id,'hotel_id'=>$hotel_id ));
	HDB::hus()->Hinsert('stk__mouvement', $values);
	}
	
	// UPDATE
	public function Update($indice_bs,$type,$motif,$num_bon,$qte_entree,$qte_sortie,$dte_appro,$dte_appro_heure,$depot,$produit_id,$user_id,$hotel_id,$id)
	{
	$sql = "  indice_bs =:indice_bs,type =:type,motif =:motif,num_bon =:num_bon,qte_entree =:qte_entree,qte_sortie =:qte_sortie,dte_appro =:dte_appro,dte_appro_heure =:dte_appro_heure,depot =:depot,produit_id =:produit_id,user_id =:user_id,hotel_id =:hotel_id WHERE idmvt = :id ";
	$data = array(':indice_bs'=>$indice_bs,':type'=>$type,':motif'=>$motif,':num_bon'=>$num_bon,':qte_entree'=>$qte_entree,':qte_sortie'=>$qte_sortie,':dte_appro'=>$dte_appro,':dte_appro_heure'=>$dte_appro_heure,':depot'=>$depot,':produit_id'=>$produit_id,':user_id'=>$user_id,':hotel_id'=>$hotel_id,':id'=>$id);
	HDB::hus()->Hupdate('stk__mouvement',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	