
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        resconfig_model
	* DATE CREATED:  	08-02-2018
	* FOR TABLE:  		resconfig
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if (!defined('VALID_DIR')) die('You are not allowed to execute this file directly');

	//include_once(APP_FOLDER.'/models/classes/class_resconfig.php');

	class parambase_model
	{

		// SELECT ALL
		public function SelectAll($limit = NULL)
		{
			if ($limit) {
				$startpg = pageparam($limit);
				return HDB::hus()->Hselect("facconfig LIMIT {$startpg} , {$limit}");
			} else {
				return HDB::hus()->Hselect("facconfig");
			}
		}

		//Select Count for Pagination
		public function CountRow()
		{
			return HDB::hus()->Hcount("facconfig");
		}

		// SELECT ONE
		public function SelectOne($id)
		{
			$requete = HDB::hus()->prepare("SELECT * FROM t_hotel AS a, resconfig AS b WHERE a.id_hotel=b.site_id AND b.site_id=:id");
			$requete->BindParam(':id', $id);
			$requete->execute();
			return $requete->fetch(PDO::FETCH_OBJ);
		}

		// QUICK SEARCH
		public function AutoSearch($qstring, $limit, $where)
		{
			$bind = array(":svalue" => "%$qstring%");
			return HDB::hus()->Hselect("facconfig", "$where LIKE :svalue LIMIT $limit", $bind);
		}

		// TRUNCATE TABLE
		public function TruncateTable($redirect_to)
		{
			$sql = HDB::hus()->prepare("TRUNCATE facconfig");
			$sql->execute();
			send_to($redirect_to);
		}

		// DELETE
		public function Delete($id, $redirect_to)
		{
			$bind = array(":id" => $id);
			HDB::hus()->Hdelete("facconfig", "id=:id", $bind);
			send_to($redirect_to);
		}

		// INSERT
		public function Insert($m_insert, $m_affich, $taux, $age, $penalite, $fuseauhoraire, $module_id, $site_id)
		{
			$newupload = new UploadControl;
			$uploadname = $newupload->ImageUplaodResize('logo', THUMB_IMAGE_WIDTH, BIG_IMAGE_WIDTH, UPLOAD_PATH, THUMB_PATH, 90);
			if ($uploadname == '') {
				$values = array(array('m_insert' => $m_insert, 'm_affich' => $m_affich, 'taux' => $taux, 'age' => $age, 'penalie' => $penalie, 'fuseauhoraire' => $fuseauhoraire, 'module_id' => $module_id, 'site_id' => $site_id));
			} else {
				$values = array(array('logo' => $uploadname, 'm_insert' => $m_insert, 'm_affich' => $m_affich, 'taux' => $taux, 'age' => $age, 'penalie' => $penalie, 'fuseauhoraire' => $fuseauhoraire, 'module_id' => $module_id, 'site_id' => $site_id));
			}
			HDB::hus()->Hinsert('facconfig', $values);
		}

		// UPDATE
		public function Update($nofile, $nomcomp, $adrcomp, $m_insert, $m_affich, $taux, $fuseauhoraire, $prefsanct, $prefconge, $tva, $echeance, $liestock, $infofact, $sujetmail, $msgmail, $module_id, $site_id, $id)
		{
			$uploadname = '';
			if ($nofile == 1) {
				$newupload = new UploadControl;
				$uploadname = $newupload->ImageUplaodResize('logo', THUMB_IMAGE_WIDTH, BIG_IMAGE_WIDTH, UPLOAD_PATH, THUMB_PATH, 90);
			}
			if ($uploadname == '') {
				$sql = "nomcomp=:nomcomp,adrcomp=:adrcomp,m_insert =:m_insert,m_affich =:m_affich,taux =:taux,fuseauhoraire =:fuseauhoraire,prefsanct =:prefsanct,prefconge =:prefconge,tva =:tva,echeance =:echeance,liestock =:liestock,infofact =:infofact,sujetmail=:sujetmail,msgmail=:msgmail,module_id =:module_id,site_id =:site_id WHERE id = :id";
				$data = array(':nomcomp' => $nomcomp, ':adrcomp' => $adrcomp, ':m_insert' => $m_insert, ':m_affich' => $m_affich, ':taux' => $taux, ':fuseauhoraire' => $fuseauhoraire, ':prefsanct' => $prefsanct, ':prefconge' => $prefconge, ':tva' => $tva, ':echeance' => $echeance, ':liestock' => $liestock, ':infofact' => $infofact, ':sujetmail' => $sujetmail, ':msgmail' => $msgmail, ':module_id' => $module_id, ':site_id' => $site_id, ':id' => $id);
			} else {
				$sql = "nomcomp=:nomcomp,adrcomp=:adrcomp,m_insert =:m_insert,m_affich =:m_affich,taux =:taux,fuseauhoraire =:fuseauhoraire,prefsanct =:prefsanct,prefconge =:prefconge,tva =:tva,echeance =:echeance,liestock =:liestock,infofact =:infofact,sujetmail=:sujetmail,msgmail=:msgmail,logo =:logo,module_id =:module_id,site_id =:site_id WHERE id = :id";
				$data = array(':nomcomp' => $nomcomp, ':adrcomp' => $adrcomp, ':m_insert' => $m_insert, ':m_affich' => $m_affich, ':taux' => $taux, ':fuseauhoraire' => $fuseauhoraire, ':prefsanct' => $prefsanct, ':prefconge' => $prefconge, ':tva' => $tva, ':echeance' => $echeance, ':liestock' => $liestock, ':infofact' => $infofact, ':sujetmail' => $sujetmail, ':msgmail' => $msgmail, ':logo' => $uploadname, ':module_id' => $module_id, ':site_id' => $site_id, ':id' => $id);
			}
			HDB::hus()->Hupdate('resconfig', $sql, $data);
		}

		// SELECT ALL
		public function SelectAllFuseau()
		{
			$requete = 'SELECT * FROM timezones';
			$query = HDB::hus()->prepare($requete);
			try {
				$query->execute();
				return $query->fetchAll(PDO::FETCH_OBJ);
			} catch (PDOException $e) {
				die($e->getMessage());
			}
		}
	} // end class

	?>
	
	