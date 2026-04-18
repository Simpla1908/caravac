
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        cptjournal_model
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		cptjournal
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_cptjournal.php');
	
	class cptjournal_model{
	
	// SELECT ALL
	public function SelectAll($datedebut,$datefin,$idsite)
	{

    $requete = 'SELECT a.id,a.dte,a.dtetime,a.libelle AS description,a.reference,b.libelle AS typejournal,a.lettrer
    FROM cptecritures AS a, cptjournal AS b
                        WHERE a.journal_id=b.id
                        AND a.dte BETWEEN :datedebut AND :datefin
                        AND a.site_id=:idsite
                        AND a.psedo=0
                        ORDER BY a.id DESC';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':datedebut', $datedebut);
    $query->BindParam(':datefin', $datefin);
    $query->BindParam(':idsite', $idsite);
    try {
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }

	}
	public function SelectAllTypJournal($datedebut,$datefin,$idsite,$typejournal)
	{

    $requete = 'SELECT a.id,a.dte,a.dtetime,a.libelle AS description,a.reference,b.libelle AS typejournal,a.lettrer
    FROM cptecritures AS a, cptjournal AS b
                        WHERE a.journal_id=b.id
                        AND a.dte BETWEEN :datedebut AND :datefin
                        AND a.site_id=:idsite
                        AND b.libelle=:typejournal
                        AND a.psedo=0
                        ORDER BY a.id DESC';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':datedebut', $datedebut);
    $query->BindParam(':datefin', $datefin);
    $query->BindParam(':idsite', $idsite);
    $query->BindParam(':typejournal', $typejournal);
    try {
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }

	}

    public function SelectAllOneJournal($id)
	{

    $requete = 'SELECT a.id,a.dte,a.dtetime,a.libelle AS description,a.reference,a.devise,a.lettrer,b.libelle AS typejournal,b.id AS idjournal
    FROM cptecritures AS a,cptjournal AS b
    WHERE a.journal_id=b.id AND a.id=:id';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':id', $id);
    try {
       $query->execute();
       $rows = $query->fetch(PDO::FETCH_OBJ); 
       return $rows;
    } catch (PDOException $e) {
        die($e->getMessage());
    }

	}
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("cptjournal");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("cptjournal","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("cptjournal","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE cptjournal");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("cptjournal","id=:id",$bind);
	//send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($code,$libelle,$psedo,$site_id)
	{
	
	$values = array(array( 'code'=>$code,'libelle'=>$libelle,'psedo'=>$psedo,'site_id'=>$site_id ));
	HDB::hus()->Hinsert('cptjournal', $values);
	}
	
	// UPDATE
	public function Update($code,$libelle,$id)
	{
	$sql = "  code =:code,libelle =:libelle WHERE id = :id ";
	$data = array(':code'=>$code,':libelle'=>$libelle,':id'=>$id);
	HDB::hus()->Hupdate('cptjournal',$sql,$data);
	
	}
	public function AllTypeJournaux($idsite)
	{

    $requete = 'SELECT id,code,libelle,site_id
    FROM cptjournal
   WHERE psedo=0 AND (site_id IS NULL OR site_id=:idsite)';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':idsite', $idsite);
    try {
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }

	}

	
	
	} // end class
	
	?>
	
	