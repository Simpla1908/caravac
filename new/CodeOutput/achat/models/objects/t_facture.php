
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_facture_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_facture
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_facture.php');
	
	class t_facture_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_facture LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_facture");	
	}
	}
        
        public function SelectAllNum_bon($idsite){
            $type='achat';
            $requete='SELECT * FROM  t_facture  AS a WHERE a.id_hotel=:id AND a.type=:type ORDER BY a.id_fact';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id',$idsite);
            $query->BindParam(':type',$type);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        
        public function SelectAllNumbon_Commande($fournisseur_id){
            $requete='SELECT a.*
                    FROM  t_facture  AS a
                    WHERE a.type="achat" AND a.id_client=:id';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id',$fournisseur_id);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        
        
        public function SelectAllNumbon_Cmd($fournisseur_id){
            $statut="approuve";
            $requete='SELECT a.id_fact,a.num_fact,a.num_cmd FROM  t_facture  AS a WHERE a.id_client=:id AND a.statut_bon=:statut ORDER BY a.id_fact';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id',$fournisseur_id);
            $query->BindParam(':statut',$statut);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function SelectAllNumbon_Cmd2($fournisseur_id){
            $requete='SELECT  a.id_fact,a.num_fact, d.quantite, c.bcommande_id AS commande_id,SUM( d.quantite_liv ) AS quantite_liv
                        FROM t_facture AS a, stk_produit AS b, ach_livraison AS c, ach_produits_livres AS d, t_facture AS e
                        WHERE d.produit_id = b.idprod AND e.id_fact = c.bcommande_id
                        AND c.id_liv=d.livraison_id AND a.id_fact=c.bcommande_id
                        AND c.fournisseur_id=:id GROUP BY d.produit_id';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id',$fournisseur_id);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function SelectAllProduit_bon($boncommande_id){
            $requete='SELECT a.id, a.qte AS quantite, a.produit_id, a.commande_id, b.designation
                        FROM lignes_commandes AS a, stk_produit AS b
                        WHERE a.produit_id = b.idprod
                        AND a.commande_id =:commande_id';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':commande_id',$boncommande_id);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        public function SelectAllProduit_bon2($boncommande_id){
            $requete='SELECT  d.quantite,d.quantite_cmd, d.produit_id, c.bcommande_id AS commande_id, b.designation,
                        c.numBon_liv, SUM( d.quantite_liv ) AS quantite_liv, d.observation
                        FROM stk_produit AS b, ach_livraison AS c, ach_produits_livres AS d, t_facture AS e
                        WHERE d.produit_id = b.idprod AND e.id_fact = c.bcommande_id
                        AND c.id_liv=d.livraison_id
                        AND c.bcommande_id=:commande_id GROUP BY d.produit_id';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':commande_id',$boncommande_id);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        
        public function SelectAllProduit_bon3($boncommande_id, $id_liv){
            $requete='SELECT  d.id_produit_liv, d.quantite,d.quantite_cmd, d.produit_id, c.bcommande_id AS commande_id, b.designation,
                        c.numBon_liv, d.quantite_liv, d.observation
                        FROM stk_produit AS b, ach_livraison AS c, ach_produits_livres AS d, t_facture AS e
                        WHERE d.produit_id = b.idprod AND e.id_fact = c.bcommande_id
                        AND c.id_liv=d.livraison_id
                        AND c.bcommande_id=:commande_id AND d.livraison_id=:livraison_id';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':commande_id',$boncommande_id);
            $query->BindParam(':livraison_id',$id_liv);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        
        public function SelectAllBesoins($idsite){
            $date=  date('Y-m-d');
            $requete='SELECT a.id_fact,a.num_fact,a.num_cmd,a.date_edition,a.monnaie,a.justification,a.id_hotel,a.company_id,a.id_user,a.id_client,a.statut_bon,a.mode,
                        b.id_client,b.nom_entreprise, c.commande_id,SUM(c.prix * c.qte) AS tot_cmd
                        FROM  t_facture AS a, t_client AS b, lignes_commandes AS c
                        WHERE a.id_client=b.id_client
                        AND a.id_fact=c.commande_id 
                        AND a.type="achat" AND a.num_fact <> ""
                        AND a.id_hotel=:id AND a.date_edition=:dte
                        GROUP BY a.id_fact';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id',$idsite);
            $query->BindParam(':dte',$date);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        
        public function SelectAllCommandes($idsite,$dte1,$dte2){
            $requete='SELECT a.id_fact,a.num_fact,a.num_cmd,a.date_edition,a.monnaie,a.justification,a.id_hotel,a.company_id,a.id_user,a.id_client,a.statut_bon,a.mode,
                        b.id_client,b.nom_entreprise, c.commande_id,SUM(c.prix * c.qte) AS tot_cmd
                        FROM  t_facture AS a, t_client AS b, lignes_commandes AS c
                        WHERE a.id_client=b.id_client
                        AND a.id_fact=c.commande_id 
                        AND a.type="achat"
                        AND a.id_hotel=:id AND a.date_edition BETWEEN :dte1 AND :dte2
                        GROUP BY a.id_fact';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id',$idsite);
            $query->BindParam(':dte1',$dte1);
            $query->BindParam(':dte2',$dte2);
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
	return HDB::hus()->Hcount("t_facture");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_facture","id_fact=:id",$bind);
	}
        
        public function SelectOneBesoin($id) {
            $requete='SELECT a.id_fact,a.num_fact,a.num_cmd,a.i_souscription,a.date_edition,a.monnaie,a.justification,a.id_hotel,a.company_id,a.id_user,a.id_client,a.statut_bon,a.date_approbation,
                        b.id_client,b.nom_entreprise,c.nom_user, c.prenom_user
                        FROM  t_facture AS a, t_client AS b,t_utilisateur AS c
                        WHERE a.id_client=b.id_client AND a.id_user=c.id_user
                        AND a.id_fact=:id';
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
	return HDB::hus()->Hselect("t_facture","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_facture");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_facture","id_fact=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($num_fact,$type,$i_souscription,$etat,$etat_cmd,$date_echeance_old,$date_edition,$dte_blocage,$date_echeance,$date_desactivation,$montant_total,$mont_tva,$mont_ttc,$mont_ttc_remise,$taux,$taux_prix,$tva,$monnaie,$remise,$majoration,$justification,$id_res,$res_ch_id,$modulecompagny,$id_hotel,$company_id,$id_user,$id_client,$fact1)
	{
	
	$values = array(array( 'num_fact'=>$num_fact,'type'=>$type,'i_souscription'=>$i_souscription,'etat'=>$etat,'etat_cmd'=>$etat_cmd,'date_echeance_old'=>$date_echeance_old,'date_edition'=>$date_edition,'dte_blocage'=>$dte_blocage,'date_echeance'=>$date_echeance,'date_desactivation'=>$date_desactivation,'montant_total'=>$montant_total,'mont_tva'=>$mont_tva,'mont_ttc'=>$mont_ttc,'mont_ttc_remise'=>$mont_ttc_remise,'taux'=>$taux,'taux_prix'=>$taux_prix,'tva'=>$tva,'monnaie'=>$monnaie,'remise'=>$remise,'majoration'=>$majoration,'justification'=>$justification,'id_res'=>$id_res,'res_ch_id'=>$res_ch_id,'modulecompagny'=>$modulecompagny,'id_hotel'=>$id_hotel,'company_id'=>$company_id,'id_user'=>$id_user,'id_client'=>$id_client,'fact1'=>$fact1 ));
	HDB::hus()->Hinsert('t_facture', $values);
	}
        
        public function InsertBesoins($num_fact,$num_cmd,$type,$first,$date_edition,$montant_total,$mont_ttc,$taux,$monnaie,$justification,$id_hotel,$company_id,$id_user,$id_client,$statut_bon)
	{
	$values = array(array( 'num_fact'=>$num_fact,'num_cmd'=>$num_cmd,'type'=>$type,'i_souscription'=>$first,'date_edition'=>$date_edition,'montant_total'=>$montant_total,'mont_ttc'=>$mont_ttc,'taux'=>$taux,'monnaie'=>$monnaie,'justification'=>$justification,'id_hotel'=>$id_hotel,'company_id'=>$company_id,'id_user'=>$id_user,'id_client'=>$id_client,'statut_bon'=>$statut_bon ));
	HDB::hus()->Hinsert('t_facture', $values);
        return HDB::hus()->lastInsertId();
	}
	
	// UPDATE
	public function Update($num_fact,$type,$i_souscription,$etat,$etat_cmd,$date_echeance_old,$date_edition,$dte_blocage,$date_echeance,$date_desactivation,$montant_total,$mont_tva,$mont_ttc,$mont_ttc_remise,$taux,$taux_prix,$tva,$monnaie,$remise,$majoration,$justification,$id_res,$res_ch_id,$modulecompagny,$id_hotel,$company_id,$id_user,$id_client,$fact1,$id)
	{
	$sql = "  num_fact =:num_fact,type =:type,i_souscription =:i_souscription,etat =:etat,etat_cmd =:etat_cmd,date_echeance_old =:date_echeance_old,date_edition =:date_edition,dte_blocage =:dte_blocage,date_echeance =:date_echeance,date_desactivation =:date_desactivation,montant_total =:montant_total,mont_tva =:mont_tva,mont_ttc =:mont_ttc,mont_ttc_remise =:mont_ttc_remise,taux =:taux,taux_prix =:taux_prix,tva =:tva,monnaie =:monnaie,remise =:remise,majoration =:majoration,justification =:justification,id_res =:id_res,res_ch_id =:res_ch_id,modulecompagny =:modulecompagny,id_hotel =:id_hotel,company_id =:company_id,id_user =:id_user,id_client =:id_client,fact1 =:fact1 WHERE id_fact = :id ";
	$data = array(':num_fact'=>$num_fact,':type'=>$type,':i_souscription'=>$i_souscription,':etat'=>$etat,':etat_cmd'=>$etat_cmd,':date_echeance_old'=>$date_echeance_old,':date_edition'=>$date_edition,':dte_blocage'=>$dte_blocage,':date_echeance'=>$date_echeance,':date_desactivation'=>$date_desactivation,':montant_total'=>$montant_total,':mont_tva'=>$mont_tva,':mont_ttc'=>$mont_ttc,':mont_ttc_remise'=>$mont_ttc_remise,':taux'=>$taux,':taux_prix'=>$taux_prix,':tva'=>$tva,':monnaie'=>$monnaie,':remise'=>$remise,':majoration'=>$majoration,':justification'=>$justification,':id_res'=>$id_res,':res_ch_id'=>$res_ch_id,':modulecompagny'=>$modulecompagny,':id_hotel'=>$id_hotel,':company_id'=>$company_id,':id_user'=>$id_user,':id_client'=>$id_client,':fact1'=>$fact1,':id'=>$id);
	HDB::hus()->Hupdate('t_facture',$sql,$data);
	
	}
        
        public function UpdateStatut($mont_ttc,$mode,$statut,$num_commande,$facture_id) {
            $date_approuve=date('Y-m-d');
            $sql = "mont_ttc=:mont_ttc,mode=:mode,statut_bon=:statut_bon,num_cmd=:num_cmd,date_approbation=:date_approbation WHERE id_fact=:id_fact";
            $data = array(':mont_ttc' => $mont_ttc,':mode' => $mode,':statut_bon' => $statut,':num_cmd' => $num_commande, ':date_approbation' =>$date_approuve,':id_fact' => $facture_id);
            HDB::hus()->Hupdate('t_facture', $sql, $data);

        }
        public function UpdateStatut1($statut,$facture_id) {
            $sql = "statut_bon=:statut_bon WHERE id_fact=:id_fact";
            $data = array(':statut_bon' => $statut, ':id_fact' => $facture_id);
            HDB::hus()->Hupdate('t_facture', $sql, $data);

        }
        public function UpdateStatut2($statut,$montant, $facture_id) {
            $sql = "montant_total=:montant_total,statut_bon=:statut_bon WHERE id_fact=:id_fact";
            $data = array(':montant_total' => $montant,':statut_bon' => $statut, ':id_fact' => $facture_id);
            HDB::hus()->Hupdate('t_facture', $sql, $data);
        }
	
        public function UpdateFirstPrint($facture_id,$second_print) {
            $sql = "i_souscription=:i_souscription WHERE id_fact=:id_fact";
            $data = array(':i_souscription' => $second_print, ':id_fact' => $facture_id);
            HDB::hus()->Hupdate('t_facture', $sql, $data);
        }
	
	} // end class
	
	?>
	
	