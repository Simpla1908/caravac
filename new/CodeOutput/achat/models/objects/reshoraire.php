
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        reshoraire_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		reshoraire
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_reshoraire.php');
	
	class reshoraire_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
		$requete='SELECT * FROM reshoraire WHERE site_id=:id ORDER BY libh ';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id',$_SESSION['idsite']);
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
	return HDB::hus()->Hcount("reshoraire");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("reshoraire","idh=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("reshoraire","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE reshoraire");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("reshoraire","idh=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($libh,$nbrjrstrav,$site_id)
	{

    $values = array(array('libh'=>$libh,'nbrjrstrav'=>$nbrjrstrav,'site_id'=>$site_id ));
    HDB::hus()->Hinsert('reshoraire', $values);
	$last_id_hor=HDB::hus()->lastInsertId();
	return $last_id_hor;
	}
	
	// UPDATE
	public function Update($libh,$nbrjrstrav,$id)
	{
	$sql = "libh =:libh,nbrjrstrav =:nbrjrstrav WHERE idh = :id";
	$data = array(':libh'=>$libh,'nbrjrstrav'=>$nbrjrstrav,':id'=>$id);
	HDB::hus()->Hupdate('reshoraire',$sql,$data);
	
	}

        //COMBO
        public function SelectAllCombo($idsite) {
            $requete='SELECT * FROM reshoraire WHERE site_id=:id ORDER BY libh ASC';
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
	
	