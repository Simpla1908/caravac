
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        stk_produit_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		stk_produit
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_stk_produit.php');
	
	class stk_produit_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("stk_produit LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("stk_produit");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("stk_produit");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("stk_produit","idprod=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("stk_produit","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE stk_produit");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("stk_produit","idprod=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($code,$designation,$qte_min,$qte_initial,$qte_dispo,$pa,$pv,$monnaie,$repas,$statut,$pseudo_supp,$unite,$famille_id,$hotel_id)
	{
            $values = array(array( 'code'=>$code,'designation'=>$designation,'qte_min'=>$qte_min,'qte_initial'=>$qte_initial,'qte_dispo'=>$qte_dispo,'pa'=>$pa,'pv'=>$pv,'monnaie'=>$monnaie,'repas'=>$repas,'statut'=>$statut,'pseudo_supp'=>$pseudo_supp,'unite'=>$unite,'famille_id'=>$famille_id,'hotel_id'=>$hotel_id ));
            HDB::hus()->Hinsert('stk_produit', $values);
	}
	public function InsertFact($code,$designation,$qte_min,$pa,$pv,$tva,$monnaie,$repas,$unite,$famille_id,$hotel_id)
	{
            $values = array(array('code'=>$code,'designation'=>$designation,'qte_min'=>$qte_min,'pa'=>$pa,'pv'=>$pv,'tva'=>$tva,'monnaie'=>$monnaie,'repas'=>$repas,'unite'=>$unite,'famille_id'=>$famille_id,'hotel_id'=>$hotel_id ));
            HDB::hus()->Hinsert('stk_produit', $values);
	}
	// UPDATE
	public function Update($code,$designation,$qte_min,$qte_initial,$qte_dispo,$pa,$pv,$monnaie,$repas,$statut,$pseudo_supp,$unite,$famille_id,$hotel_id,$id)
	{
	$sql = "  code =:code,designation =:designation,qte_min =:qte_min,qte_initial =:qte_initial,qte_dispo =:qte_dispo,pa =:pa,pv =:pv,monnaie =:monnaie,repas =:repas,statut =:statut,pseudo_supp =:pseudo_supp,unite =:unite,famille_id =:famille_id,hotel_id =:hotel_id WHERE idprod = :id ";
	$data = array(':code'=>$code,':designation'=>$designation,':qte_min'=>$qte_min,':qte_initial'=>$qte_initial,':qte_dispo'=>$qte_dispo,':pa'=>$pa,':pv'=>$pv,':monnaie'=>$monnaie,':repas'=>$repas,':statut'=>$statut,':pseudo_supp'=>$pseudo_supp,':unite'=>$unite,':famille_id'=>$famille_id,':hotel_id'=>$hotel_id,':id'=>$id);
	HDB::hus()->Hupdate('stk_produit',$sql,$data);
	
	}
	public function SelectAllBySite($idsite) {
        $requete = 'SELECT prod.idprod,prod.code,prod.designation AS produit,prod.pa,prod.pv,prod.qte_dispo,
                    prod.tva,prod.qte_initial,prod.qte_min,prod.unite, prod.monnaie,s_fam.des,fam.designation 
                    FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam 
                    WHERE  prod.famille_id=s_fam.id_s_fam AND prod.hotel_id=:id 
                    AND s_fam.famille=fam.idfamille 
                    AND prod.pseudo_supp=0  ORDER BY prod.designation';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id', $idsite);
        
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
	
	} // end class
	
	?>
	
	