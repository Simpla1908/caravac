
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        lignes_commandes_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		lignes_commandes
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_lignes_commandes.php');
	
	class lignes_commandes_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("lignes_commandes LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("lignes_commandes");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("lignes_commandes");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("lignes_commandes","id=:id",$bind);
	}
	public function SelectOneBesoinLignecmd($id) {
            $requete='SELECT a.*, b.designation,b.unite
                    FROM lignes_commandes AS a, stk_produit AS b
                    WHERE a.produit_id=b.idprod AND a.commande_id=:id';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id',$id);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("lignes_commandes","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE lignes_commandes");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("lignes_commandes","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($qte,$prix,$repas,$monnaie,$dte,$dte_h,$commande_id,$produit_id,$user_id,$hotel_id)
	{
	
	$values = array(array( 'qte'=>$qte,'prix'=>$prix,'repas'=>$repas,'monnaie'=>$monnaie,'dte'=>$dte,'dte_h'=>$dte_h,'commande_id'=>$commande_id,'produit_id'=>$produit_id,'user_id'=>$user_id,'hotel_id'=>$hotel_id ));
	HDB::hus()->Hinsert('lignes_commandes', $values);
	}
        
        public function InsertLigneCmd($qte,$prix,$monnaie,$dte,$commande_id,$produit_id,$user_id,$hotel_id)
	{
	
	$values = array(array( 'qte'=>$qte,'prix'=>$prix,'monnaie'=>$monnaie,'dte'=>$dte,'commande_id'=>$commande_id,'produit_id'=>$produit_id,'user_id'=>$user_id,'hotel_id'=>$hotel_id ));
	HDB::hus()->Hinsert('lignes_commandes', $values);
	}
	
	// UPDATE
	public function Update($qte,$prix,$repas,$monnaie,$dte,$dte_h,$commande_id,$produit_id,$user_id,$hotel_id,$id)
	{
	$sql = "  qte =:qte,prix =:prix,repas =:repas,monnaie =:monnaie,dte =:dte,dte_h =:dte_h,commande_id =:commande_id,produit_id =:produit_id,user_id =:user_id,hotel_id =:hotel_id WHERE id = :id ";
	$data = array(':qte'=>$qte,':prix'=>$prix,':repas'=>$repas,':monnaie'=>$monnaie,':dte'=>$dte,':dte_h'=>$dte_h,':commande_id'=>$commande_id,':produit_id'=>$produit_id,':user_id'=>$user_id,':hotel_id'=>$hotel_id,':id'=>$id);
	HDB::hus()->Hupdate('lignes_commandes',$sql,$data);
	
	}
	
        public function UpdateQtePrix($qte,$prix,$id)
	{
	$sql = "  qte =:qte,prix =:prix WHERE id = :id ";
	$data = array(':qte'=>$qte,':prix'=>$prix,':id'=>$id);
	HDB::hus()->Hupdate('lignes_commandes',$sql,$data);
	
	}
	
	} // end class
	
	?>
	
	