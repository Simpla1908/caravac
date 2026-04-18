
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        rescategorie_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		rescategorie
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_rescategorie.php');
	
	class rescategorie_model{
	
	// SELECT ALL
	public function SelectAll($idsite)
	{
            $requete='SELECT * FROM rescategorie AS a WHERE a.site_id=:id';
            $query = HDB::hus()->prepare($requete);
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
	return HDB::hus()->Hcount("rescategorie");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("rescategorie","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("rescategorie","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE rescategorie");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("rescategorie","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($libelle,$salbase,$montantjr,$devise,$psedo,$type,$preavis,$site_id)
	{
	
	$values = array(array( 'libelle'=>$libelle,'salbase'=>$salbase,'montantjr'=>$montantjr,'devise'=>$devise,'type'=>$type,'psedo'=>$psedo,'preavis'=>$preavis,'site_id'=>$site_id ));
	HDB::hus()->Hinsert('rescategorie', $values);
	}
	
	// UPDATE
	public function Update($libelle,$salbase,$montantjr,$devise,$psedo,$type,$preavis,$site_id,$id)
	{
	$sql = "  libelle =:libelle,salbase =:salbase,montantjr=:montantjr,devise =:devise,psedo =:psedo,type=:type,preavis=:preavis,site_id =:site_id WHERE id = :id ";
	$data = array(':libelle'=>$libelle,':salbase'=>$salbase,':montantjr'=>$montantjr,':devise'=>$devise,':psedo'=>$psedo,':type'=>$type,':preavis'=>$preavis,':site_id'=>$site_id,':id'=>$id);
	HDB::hus()->Hupdate('rescategorie',$sql,$data);
	
	}
		public function SelectAllMAJ($idsite,$id)
		{
			$requete='SELECT * FROM rescategorie AS a WHERE a.site_id=:id AND a.id<>:idcat';
			$query = HDB::hus()->prepare($requete);
			$query->BindParam(':id', $idsite);
			$query->BindParam(':idcat', $id);

			try {
				$query->execute();
				return $query->fetchAll(PDO::FETCH_OBJ);
			} catch (PDOException $e) {
				die($e->getMessage());
			}
		}


	} // end class
	
	?>
	
	