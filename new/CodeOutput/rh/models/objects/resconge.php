
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        resconge_model
	* DATE CREATED:  	23-10-2017
	* FOR TABLE:  		resconge
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_resconge.php');
	
	class resconge_model{
	
	// SELECT ALL
	public function SelectAll($idsite)
	{
            $requete = 'SELECT * FROM resconge  WHERE psedo=0 AND site_id=:id';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id', $idsite);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
	

	public function SelectAll1($idsite)
	{
		 $requete='SELECT a.employe_id,b.noms,COUNT(a.conge_id) AS nbrcg  FROM resempconge a,resemployes b WHERE a.employe_id=b.id AND a.site_id=:id GROUP BY a.employe_id ORDER BY b.noms ASC';
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
		 $requete='SELECT a.id,a.ref,a.conge_id,b.libelle,a.dte,a.dte1,a.dte2,a.nbre,a.comment,a.doc,a.employe_id,c.noms,c.sexe,c.Adresse,c.rue,c.quartier,c.commune,c.ville  FROM resempconge a,resconge b,resemployes c WHERE a.conge_id=b.id  AND a.employe_id=c.id  AND a.employe_id=:idemply AND a.site_id=:id ORDER BY a.dte DESC';
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
	return HDB::hus()->Hcount("resconge");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("resconge","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("resconge","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE resconge");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("resconge","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($libelle,$trans,$pseudo,$nbrjr,$type,$contenu,$site_id)
	{
	
	$values = array(array( 'libelle'=>$libelle,'transport'=>$trans,'psedo'=>$pseudo,'nbrjr'=>$nbrjr,'type'=>$type,'contenu'=>$contenu,'site_id'=>$site_id ));
	HDB::hus()->Hinsert('resconge', $values);
	}
	
	// UPDATE
	public function Update($libelle,$transport,$psedo,$nbrjr,$type,$contenu,$site_id,$id)
	{
	$sql = "  libelle =:libelle,transport =:transport,psedo =:psedo,nbrjr =:nbrjr,type=:type,contenu=:contenu,site_id =:site_id WHERE id = :id ";
	$data = array(':libelle'=>$libelle,':transport' =>$transport,':psedo'=>$psedo,':nbrjr'=>$nbrjr,'type'=>$type,'contenu'=>$contenu,':site_id'=>$site_id,':id'=>$id);
	HDB::hus()->Hupdate('resconge',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	