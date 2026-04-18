
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        ressanction_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		ressanction
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_ressanction.php');
	
	class ressanction_model{
	
	// SELECT ALL
	public function SelectAll($idsite)
	{
		$requete='SELECT * FROM  ressanction AS a WHERE a.site_id=:id AND a.pseudo=0 ORDER BY a.libelle ASC';
		$query = HDB::hus()->prepare($requete);
		$query->BindParam(':id', $idsite);
		try {
			$query->execute();
			return $query->fetchAll(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	// SELECT ALL
	public function SelectAll1($idsite)
	{
		 $requete='SELECT a.employe_id,b.noms,COUNT(a.sanction_id) AS nbrsanct  FROM ressanctionempl a,resemployes b WHERE a.employe_id=b.id AND a.site_id=:id GROUP BY a.employe_id ORDER BY b.noms ASC';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id', $idsite);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            } 
	}
		public function SelectAlldetail($idemply,$idsite)
	{
		 $requete='SELECT a.id,a.ref,a.sanction_id,b.libelle,a.dte,a.dte1,a.dte2,a.comment,a.nbre,a.retenu,a.doc,a.employe_id,c.noms,c.sexe,c.Adresse,c.rue,c.quartier,c.commune,c.ville  FROM ressanctionempl a,ressanction b,resemployes c WHERE a.sanction_id=b.id AND a.employe_id=c.id AND a.employe_id=:idemply AND a.site_id=:id ORDER BY a.dte DESC';
            $query = HDB::hus()->prepare($requete);
           $query->BindParam(':idemply', $idemply);
            $query->BindParam(':id', $idsite);
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
	return HDB::hus()->Hcount("ressanction");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("ressanction","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("ressanction","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE ressanction");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
		$pseudo=1;
		$sql = "pseudo =:pseudo WHERE id = :id ";
		$data = array(':pseudo'=>$pseudo,':id'=>$id);
		HDB::hus()->Hupdate('ressanction',$sql,$data);
		send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($libelle,$pseudo,$nbrjr,$retenue,$contenu,$site_id)
	{
	$values = array(array('libelle'=>$libelle,'pseudo'=>$pseudo,'nbrjr'=>$nbrjr,'retenue'=>$retenue,'contenu'=>$contenu,'site_id'=>$site_id ));
	HDB::hus()->Hinsert('ressanction', $values);
	}
	
	// UPDATE
	public function Update($libelle,$nbrjr,$retenue,$contenu,$site_id,$id)
	{
	$sql = "  libelle =:libelle,nbrjr =:nbrjr,retenue =:retenue,contenu =:contenu,site_id =:site_id WHERE id = :id ";
	$data = array(':libelle'=>$libelle,':nbrjr'=>$nbrjr,':retenue'=>$retenue,':contenu'=>$contenu,':site_id'=>$site_id,':id'=>$id);
	HDB::hus()->Hupdate('ressanction',$sql,$data);
	
	}
	
	
	
	} // end class
	
	?>
	
	