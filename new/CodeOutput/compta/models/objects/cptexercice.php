
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        cptecritures_model
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		cptecritures
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if (!defined('VALID_DIR')) die('You are not allowed to execute this file directly');

	class cptexercice_model
	{

		// SELECT ALL
		public function SelectAll($site_id)
		{
			$requete = 'SELECT *
    FROM cptexercice 
    WHERE psedo=0
    AND site_id=:site_id
    ORDER BY lib DESC';
			$query = HDB::hus()->prepare($requete);
			$query->BindParam(':site_id', $site_id);
			try {
				$query->execute();
				return $query->fetchAll(PDO::FETCH_OBJ);
			} catch (PDOException $e) {
				die($e->getMessage());
			}
		}
		public function SelectAllJournal($site_id)
		{
			$requete = 'SELECT *
    FROM cptexercice 
    WHERE psedo=0
    AND cloture=0
    AND site_id=:site_id
    ORDER BY lib DESC';
			$query = HDB::hus()->prepare($requete);
			$query->BindParam(':site_id', $site_id);
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
			return HDB::hus()->Hcount("cptecritures");
		}

		// SELECT ONE
		public function SelectOne($id)
		{
			$bind = array(":id" => $id);
			return HDB::hus()->Hone("cptexercice", "id=:id", $bind);
		}

		// QUICK SEARCH
		public function AutoSearch($qstring, $limit, $where)
		{
			$bind = array(":svalue" => "%$qstring%");
			return HDB::hus()->Hselect("cptecritures", "$where LIKE :svalue LIMIT $limit", $bind);
		}

		// TRUNCATE TABLE
		public function TruncateTable($redirect_to)
		{
			$sql = HDB::hus()->prepare("TRUNCATE cptecritures");
			$sql->execute();
			send_to($redirect_to);
		}

		// DELETE
		public function Delete($id, $redirect_to)
		{
			$bind = array(":id" => $id);
			HDB::hus()->Hdelete("cptecritures", "id=:id", $bind);
			send_to($redirect_to);
		}

		// INSERT
		public function Insert($lib, $debut, $fin, $etat, $psedo, $config_id, $site_id)
		{

			$values = array(array('lib' => $lib, 'debut' => $debut, 'fin' => $fin, 'etat' => $etat, 'psedo' => $psedo, 'config_id' => $config_id, 'site_id' => $site_id));
			HDB::hus()->Hinsert('cptexercice', $values);
		}

		// UPDATE
		public function Update($lib, $debut, $fin, $etat, $psedo, $config_id, $site_id, $id)
		{
			$sql = "lib =:lib,debut =:debut,fin =:fin,etat =:etat,psedo =:psedo,config_id =:config_id,site_id =:site_id WHERE id = :id ";
			$data = array(':lib' => $lib, ':debut' => $debut, ':fin' => $fin, ':etat' => $etat, ':psedo' => $psedo, ':config_id' => $config_id, ':site_id' => $site_id, ':id' => $id);
			HDB::hus()->Hupdate('cptexercice', $sql, $data);
		}
		public function exerciceencours($id)
		{
			$etat = 0;
			$sql = "etat =:etat WHERE id <> :id ";
			$data = array(':etat' => $etat, ':id' => $id);
			HDB::hus()->Hupdate('cptexercice', $sql, $data);
			$etat = 1;
			$sql = "etat =:etat WHERE id = :id ";
			$data = array(':etat' => $etat, ':id' => $id);
			HDB::hus()->Hupdate('cptexercice', $sql, $data);
		}
		public function Updatepsedo($psedo, $id)
		{
			$sql = "  psedo =:psedo WHERE id = :id ";
			$data = array(':psedo' => $psedo, ':id' => $id);
			HDB::hus()->Hupdate('cptexercice', $sql, $data);
		}
		public function cloturerexercice($cloture, $id)
		{
			$sql = "cloture =:cloture WHERE id = :id ";
			$data = array(':cloture' => $cloture, ':id' => $id);
			HDB::hus()->Hupdate('cptexercice', $sql, $data);
		}
		public function SelectPrevions($site_id)
		{
			$requete = 'SELECT *
    FROM cptprevision 
    WHERE psedo=0
    AND site_id=:site_id
    ORDER BY libelle DESC';
			$query = HDB::hus()->prepare($requete);
			$query->BindParam(':site_id', $site_id);
			try {
				$query->execute();
				return $query->fetchAll(PDO::FETCH_OBJ);
			} catch (PDOException $e) {
				die($e->getMessage());
			}
		}
	} // end class

	?>
	
	