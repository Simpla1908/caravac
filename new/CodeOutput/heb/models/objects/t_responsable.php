
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_responsable_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_responsable
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if (!defined('VALID_DIR')) die('You are not allowed to execute this file directly');

	include_once(APP_FOLDER . '/models/classes/class_t_responsable.php');

	class t_responsable_model
	{

		// SELECT ALL
		public function SelectAll($company_id)
		{

			$requete = "SELECT * FROM t_responsable WHERE company_id=:id AND filtre=1 AND pseudo_supp=0 ORDER BY nom_respo";
			$query = HDB::hus()->prepare($requete);
			$query->BindParam(':id', $company_id);
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
			return HDB::hus()->Hcount("t_responsable");
		}

		// SELECT ONE
		public function SelectOne($id)
		{
			$bind = array(":id" => $id);
			return HDB::hus()->Hone("t_responsable", "id_respo=:id", $bind);
		}
		public function SelectOne2($id)
		{
			$req = $requete = 'SELECT * FROM t_responsable AS a,cptsouscomptes AS b WHERE  a.id_sous_compte=b.id AND a.id_respo=:id_respo ORDER BY a.filtre,a.nom_respo';
			$requete = HDB::hus()->prepare($req);
			$requete->BindParam(':id_respo', $id);
			$requete->execute();
			$result = $requete->fetch(PDO::FETCH_OBJ);
			return $result;
		}
		// QUICK SEARCH
		public function AutoSearch($qstring, $limit, $where)
		{
			$bind = array(":svalue" => "%$qstring%");
			return HDB::hus()->Hselect("t_responsable", "$where LIKE :svalue LIMIT $limit", $bind);
		}

		// TRUNCATE TABLE
		public function TruncateTable($redirect_to)
		{
			$sql = HDB::hus()->prepare("TRUNCATE t_responsable");
			$sql->execute();
			send_to($redirect_to);
		}

		// DELETE
		public function Delete($id, $redirect_to)
		{
			$bind = array(":id" => $id);
			HDB::hus()->Hdelete("t_responsable", "id_respo=:id", $bind);
			send_to($redirect_to);
		}
		public function PseudoDel($pseudo_supp, $id)
		{
			$sql = "pseudo_supp =:pseudo_supp WHERE id_respo = :id ";
			$data = array(':pseudo_supp' => $pseudo_supp, ':id' => $id);
			HDB::hus()->Hupdate('t_responsable', $sql, $data);
		}
		// INSERT
		public function Insert($nom_respo, $telephone_respo, $email, $adresse_respo, $entreprise, $filtre, $company_id, $id_sous_compte)
		{

			$values = array(array('nom_respo' => $nom_respo, 'telephone_respo' => $telephone_respo, 'email' => $email, 'adresse_respo' => $adresse_respo, 'entreprise' => $entreprise, 'filtre' => $filtre, 'company_id' => $company_id, 'id_sous_compte' => $id_sous_compte));
			HDB::hus()->Hinsert('t_responsable', $values);
		}

		// UPDATE
		public function Update($nom_respo, $telephone_respo, $email, $adresse_respo, $entreprise, $filtre, $company_id, $id_sous_compte, $id)
		{
			$sql = "  nom_respo =:nom_respo,telephone_respo =:telephone_respo,email =:email,adresse_respo =:adresse_respo,entreprise =:entreprise,filtre =:filtre,company_id =:company_id,id_sous_compte =:id_sous_compte WHERE id_respo = :id ";
			$data = array(':nom_respo' => $nom_respo, ':telephone_respo' => $telephone_respo, ':email' => $email, ':adresse_respo' => $adresse_respo, ':entreprise' => $entreprise, ':filtre' => $filtre, ':company_id' => $company_id, ':id_sous_compte' => $id_sous_compte, ':id' => $id);
			HDB::hus()->Hupdate('t_responsable', $sql, $data);
		}
	} // end class

	?>
	
	