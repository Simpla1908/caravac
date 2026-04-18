
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        cptprevision_model
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		cptprevision
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if (!defined('VALID_DIR')) die('You are not allowed to execute this file directly');

	//include_once(APP_FOLDER . '/models/classes/class_cptprevision.php');

	class cptprevision_model
	{

		// SELECT ALL
		public function SelectAll($exercice_id, $idsite, $filtre)
		{
			if ($filtre == 1) {
				$requete = 'SELECT pvs.id,pvs.dte,pvs.libelle,pvs.devise
    					FROM cptprevision AS pvs
                        WHERE pvs.exercice_id=:exercice_id
                        AND pvs.site_id=:idsite
                        AND pvs.psedo=0
                        ORDER BY pvs.id DESC';
				$query = HDB::hus()->prepare($requete);
				$query->BindParam(':exercice_id', $exercice_id);
				$query->BindParam(':idsite', $idsite);
			} else {
				$requete = 'SELECT pvs.id,pvs.dte,pvs.libelle,pvs.devise
    					FROM cptprevision AS pvs
                        WHERE pvs.site_id=:idsite
                        AND pvs.psedo=0
                        ORDER BY pvs.id DESC';
				$query = HDB::hus()->prepare($requete);
				$query->BindParam(':idsite', $idsite);
			}

			try {
				$query->execute();
				return $query->fetchAll(PDO::FETCH_OBJ);
			} catch (PDOException $e) {
				die($e->getMessage());
			}
		}
		public function SelectAllTypJournal($datedebut, $datefin, $idsite, $typejournal)
		{

			$requete = 'SELECT a.id,a.dte,a.dtetime,a.libelle AS description,a.reference,b.libelle AS typejournal,a.lettrer
    FROM cptecritures AS a, cptprevision AS b
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

		public function SelectAllOnePrevision($id)
		{
			$requete = 'SELECT a.id,a.dte,a.libelle AS exercice_lib,a.devise,a.exercice_id
			FROM cptprevision AS a
			WHERE a.id=:id';
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
			return HDB::hus()->Hcount("cptprevision");
		}

		// SELECT ONE
		public function SelectOne($id)
		{
			$bind = array(":id" => $id);
			return HDB::hus()->Hone("cptprevision", "id=:id", $bind);
		}

		// QUICK SEARCH
		public function AutoSearch($qstring, $limit, $where)
		{
			$bind = array(":svalue" => "%$qstring%");
			return HDB::hus()->Hselect("cptprevision", "$where LIKE :svalue LIMIT $limit", $bind);
		}

		// TRUNCATE TABLE
		public function TruncateTable($redirect_to)
		{
			$sql = HDB::hus()->prepare("TRUNCATE cptprevision");
			$sql->execute();
			send_to($redirect_to);
		}

		// DELETE
		public function Delete($id, $redirect_to)
		{
			$bind = array(":id" => $id);
			HDB::hus()->Hdelete("cptprevision", "id=:id", $bind);
			//send_to($redirect_to);
		}

		// INSERT
		public function Insert($dte, $libelle, $psedo, $exercice_id, $user_id, $site_id, $devise)
		{

			$values = array(array('dte' => $dte, 'libelle' => $libelle, 'psedo' => $psedo, 'exercice_id' => $exercice_id, 'user_id' => $user_id, 'site_id' => $site_id, 'devise' => $devise));
			HDB::hus()->Hinsert('cptprevision', $values);
			$id = HDB::hus()->lastInsertId();
			return $id;
		}

		// UPDATE
		public function Update($libelle, $exercice_id, $user_id, $devise, $id)
		{
			$sql = "libelle =:libelle,exercice_id =:exercice_id,user_id =:user_id,devise =:devise WHERE id = :id ";
			$data = array(':libelle' => $libelle, ':exercice_id' => $exercice_id, ':user_id' => $user_id, ':devise' => $devise, ':id' => $id);
			HDB::hus()->Hupdate('cptprevision', $sql, $data);
		}
		public function AllTypeJournaux($idsite)
		{

			$requete = 'SELECT id,code,libelle,site_id
    FROM cptprevision
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
	
	