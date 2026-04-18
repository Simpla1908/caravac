
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        paiement_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		paiement
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_paiement.php');
	
	class paiement_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("paiement LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("paiement");	
	}
	}
        
        public function SelectAllPaiement($idsite){
            $type='achat';
            $requete='SELECT a.id_fact,a.num_fact,a.num_cmd,a.mont_ttc,a.taux,a.monnaie,a.id_hotel,a.company_id,
                           c.id_client,c.nom_entreprise
                        FROM t_facture AS a, t_client AS c
                        WHERE a.id_client=c.id_client
                        AND a.id_hotel=:id AND a.type=:type
                        ORDER BY a.num_fact';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id',$idsite);
            $query->BindParam(':type',$type);
            try{
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            }catch (PDOException $e){
                die($e->getMessage());
            }
        }
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("paiement");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("paiement","idpaie=:id",$bind);
	}
        
        public function SelectOnePaie($id)
	{
            $type='achat';
            $requete='SELECT DISTINCT g.lib,a.id_fact,a.num_cmd AS num_fact,a.mont_ttc,a.taux,a.monnaie,a.id_hotel,a.company_id,b.id_user,b.fournisseur_id,b.id_regl,b.dte,
                        c.id_client,c.nom_entreprise,(d.montantusd+d.montantcdf) AS montant_paye,d.monnaie_achat,d.idpaie,e.id_mode_regl,e.lib,f.numBon
                        FROM  t_facture AS a,t_reglement AS b, t_client AS c, paiement AS d, t_mode_reglement AS e, t_operation AS f, t_mode_reglement AS g
                        WHERE a.id_fact=b.id_fact AND b.fournisseur_id=c.id_client
                        AND b.id_regl=d.regl_id AND d.id_mode_regl=e.id_mode_regl 
                        AND f.paie_id=d.idpaie AND d.id_mode_regl=g.id_mode_regl
                        AND a.type=:type AND a.id_fact=:id_fact
                        ORDER BY d.idpaie';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':type',$type);
            $query->BindParam(':id_fact',$id);
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
	return HDB::hus()->Hselect("paiement","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE paiement");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("paiement","idpaie=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($montant,$montantusd,$montantcdf,$taux,$rendu,$remise,$justification,$id_mode_regl,$id_monnaie,$regl_id,$site_id,$company_id)
	{
	
	$values = array(array( 'montant'=>$montant,'montantusd'=>$montantusd,'montantcdf'=>$montantcdf,'taux'=>$taux,'rendu'=>$rendu,'remise'=>$remise,'justification'=>$justification,'id_mode_regl'=>$id_mode_regl,'id_monnaie'=>$id_monnaie,'regl_id'=>$regl_id,'site_id'=>$site_id,'company_id'=>$company_id ));
	HDB::hus()->Hinsert('paiement', $values);
	}
	
	// UPDATE
	public function Update($montant,$montantusd,$montantcdf,$taux,$rendu,$remise,$justification,$id_mode_regl,$id_monnaie,$regl_id,$site_id,$company_id,$id)
	{
	$sql = "  montant =:montant,montantusd =:montantusd,montantcdf =:montantcdf,taux =:taux,rendu =:rendu,remise =:remise,justification =:justification,id_mode_regl =:id_mode_regl,id_monnaie =:id_monnaie,regl_id =:regl_id,site_id =:site_id,company_id =:company_id WHERE idpaie = :id ";
	$data = array(':montant'=>$montant,':montantusd'=>$montantusd,':montantcdf'=>$montantcdf,':taux'=>$taux,':rendu'=>$rendu,':remise'=>$remise,':justification'=>$justification,':id_mode_regl'=>$id_mode_regl,':id_monnaie'=>$id_monnaie,':regl_id'=>$regl_id,':site_id'=>$site_id,':company_id'=>$company_id,':id'=>$id);
	HDB::hus()->Hupdate('paiement',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	