
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        reshorairejours_model
	* DATE CREATED:  	20-10-2017
	* FOR TABLE:  		reshorairejours
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_reshorairejours.php');
	
	class reshorairejours_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("reshorairejours LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("reshorairejours");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("reshorairejours");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("reshorairejours","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("reshorairejours","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE reshorairejours");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("reshorairejours","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($horaire_id,$jours_id,$dbt,$mrg,$fin,$avmrgdbt,$mrgfin,$avmrgdbtsec,$dbtsec,$mrgdbtsec,$finsec,$mrgfinsec)
	{
	
	$values = array(array( 'horaire_id'=>$horaire_id,'jours_id'=>$jours_id,'dbt'=>$dbt,'mrg'=>$mrg,'fin'=>$fin,'avmrgdbt'=>$avmrgdbt,'mrgfin'=>$mrgfin,'avmrgdbtsec'=>$avmrgdbtsec,'dbtsec'=>$dbtsec,'mrgdbtsec'=>$mrgdbtsec,'finsec'=>$finsec,'mrgfinsec'=>$mrgfinsec ));
	HDB::hus()->Hinsert('reshorairejours', $values);
	}
	
	// UPDATE
	public function Update($horaire_id,$jours_id,$dbt,$mrg,$fin,$id)
	{
	$sql = "  horaire_id =:horaire_id,jours_id =:jours_id,dbt =:dbt,mrg =:mrg,fin =:fin WHERE id = :id ";
	$data = array(':horaire_id'=>$horaire_id,':jours_id'=>$jours_id,':dbt'=>$dbt,':mrg'=>$mrg,':fin'=>$fin,':id'=>$id);
	HDB::hus()->Hupdate('reshorairejours',$sql,$data);
	
	}
		public function SelectJrsH($horaire_id)
		{

			$requete='SELECT a.jours_id,a.dbt,a.mrg,a.fin,a.avmrgdbt,a.mrgfin FROM reshorairejours AS a,resjours AS b WHERE a.jours_id=b.idjrs AND a.horaire_id=:id ORDER BY a.jours_id ASC';
			$query = HDB::hus()->prepare($requete);
			$query->BindParam(':id', $horaire_id);
			try {
				$query->execute();
				return $query->fetchAll(PDO::FETCH_OBJ);
			} catch (PDOException $e) {
				die($e->getMessage());
			}

		}
		public function Delete2($id)
		{
			$bind = array(":horaire_id" =>$id);
			HDB::hus()->Hdelete("reshorairejours","horaire_id=:horaire_id",$bind);
		}

	} // end class

	?>
	
	