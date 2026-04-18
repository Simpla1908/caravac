
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        ach_livraison_model
	* DATE CREATED:  	09-07-2018
	* FOR TABLE:  		ach_livraison
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_ach_livraison.php');
	
	class ach_livraison_model{
	
	// SELECT ALL
	public function SelectAll($idsite) {
            $requete='SELECT a.id_liv, a.numBon_liv, a.date,a.date_h, a.bcommande_id, a.fournisseur_id, b.num_fact,b.num_cmd, c.nom_entreprise, d.nom_user, d.prenom_user
            FROM ach_livraison AS a, t_facture AS b, t_client AS c, t_utilisateur AS d
            WHERE a.bcommande_id=b.id_fact
            AND a.fournisseur_id=c.id_client 
            AND a.user_id=d.id_user  AND a.hotel_id=:id
            ORDER BY a.date DESC';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id',$idsite);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        
        public function SelectProduitNumBon($facture_id){
            $requete='SELECT a.id_fact, a.num_fact,a.num_cmd, d.quantite, c.bcommande_id AS commande_id, SUM( d.quantite_liv ) AS quantite_liv
                    FROM t_facture AS a, stk_produit AS b, ach_livraison AS c, ach_produits_livres AS d
                    WHERE d.produit_id = b.idprod
                    AND c.id_liv = d.livraison_id
                    AND a.id_fact = c.bcommande_id
                    AND c.bcommande_id =:id
                    GROUP BY d.produit_id';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id',$facture_id);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        
        public function SelectProduitLiv($id_liv) {
            $requete='SELECT a.*, b.idprod, b.designation FROM ach_produits_livres AS a, stk_produit AS b
            WHERE a.produit_id=b.idprod AND a.livraison_id=:id';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id',$id_liv);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        
        public function SelectId_liv($id) {
            $num=0;
            $requete='SELECT id_liv, numBon_liv, date, date_h FROM ach_livraison WHERE bcommande_id=:id AND numBon_cmd=:num';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id',$id);
            $query->BindParam(':num',$num);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        
        public function SelectNbre_ligne($id) {
            $requete='SELECT id_liv FROM ach_livraison WHERE fournisseur_id=:id';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id',$id);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        
        public function SelectQteLiv($produit_id,$bcommande_id) {
            $requete='SELECT  SUM(a.quantite_liv) AS qte_liv
                        FROM ach_produits_livres AS a,ach_livraison AS b
                        WHERE a.livraison_id=b.id_liv AND a.produit_id =:produit_id AND b.bcommande_id=:bcommande_id
                        GROUP BY a.produit_id';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':produit_id',$produit_id);
            $query->BindParam(':bcommande_id',$bcommande_id);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }

    //Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("ach_livraison");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("ach_livraison","id_liv=:id",$bind);
	}
        
        public function SelectOneLiv($id) {
            $requete='SELECT a.id_liv, a.numBon_liv, a.date, a.bcommande_id, a.fournisseur_id, b.id_fact, b.num_fact,b.num_cmd,b.date_edition, c.nom_entreprise, d.nom_user, d.prenom_user
            FROM ach_livraison AS a, t_facture AS b, t_client AS c, t_utilisateur AS d
            WHERE a.bcommande_id=b.id_fact
            AND a.fournisseur_id=c.id_client 
            AND a.user_id=d.id_user AND a.id_liv=:id';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id',$id);
            try {
                $query->execute();
                return $query->fetch(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("ach_livraison","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE ach_livraison");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("ach_livraison","id_liv=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($numBon_liv,$numBon_cmd,$bcommande_id,$fournisseur_id,$user_id)
	{
	
	$values = array(array( 'numBon_liv'=>$numBon_liv,'numBon_cmd'=>$numBon_cmd,'bcommande_id'=>$bcommande_id,'fournisseur_id'=>$fournisseur_id,'user_id'=>$user_id ));
	HDB::hus()->Hinsert('ach_livraison', $values);
	}
        public function InsertLivraison($first,$numBon_liv,$date,$date_h,$bcommande_id,$fournisseur_id,$user_id,$hotel_id)
	{
	
	$values = array(array( 'first'=>$first,'numBon_liv'=>$numBon_liv,'date'=>$date,'date_h'=>$date_h,'bcommande_id'=>$bcommande_id,'fournisseur_id'=>$fournisseur_id,'user_id'=>$user_id,'hotel_id'=>$hotel_id ));
	HDB::hus()->Hinsert('ach_livraison', $values);
        return HDB::hus()->lastInsertId();
	}
	
	// UPDATE
	public function Update($numBon_liv,$numBon_cmd,$bcommande_id,$fournisseur_id,$user_id,$id)
	{
	$sql = "  numBon_liv =:numBon_liv,numBon_cmd =:numBon_cmd,bcommande_id =:bcommande_id,fournisseur_id =:fournisseur_id,user_id =:user_id WHERE id_liv = :id ";
	$data = array(':numBon_liv'=>$numBon_liv,':numBon_cmd'=>$numBon_cmd,':bcommande_id'=>$bcommande_id,':fournisseur_id'=>$fournisseur_id,':user_id'=>$user_id,':id'=>$id);
	HDB::hus()->Hupdate('ach_livraison',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	