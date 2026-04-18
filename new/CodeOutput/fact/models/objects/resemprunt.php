
<?php

/*
 * =======================================================================
 * CLASSNAME:        resemprunt_model
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		resemprunt
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include_once(APP_FOLDER . '/models/classes/class_resemprunt.php');

class resemprunt_model {

    // SELECT ALL
    public function SelectAll($limit = NULL) {
        if ($limit) {
            $startpg = pageparam($limit);
            return HDB::hus()->Hselect("resemprunt LIMIT {$startpg} , {$limit}");
        } else {
            return HDB::hus()->Hselect("resemprunt");
        }
    }

    //Select Count for Pagination
    public function CountRow() {
        return HDB::hus()->Hcount("resemprunt");
    }

    // SELECT ONE
    public function SelectOne($id) {
        $bind = array(":id" => $id);
        return HDB::hus()->Hone("resemprunt", "id=:id", $bind);
    }

    // QUICK SEARCH
    public function AutoSearch($qstring, $limit, $where) {
        $bind = array(":svalue" => "%$qstring%");
        return HDB::hus()->Hselect("resemprunt", "$where LIKE :svalue LIMIT $limit", $bind);
    }

    // TRUNCATE TABLE
    public function TruncateTable($redirect_to) {
        $sql = HDB::hus()->prepare("TRUNCATE resemprunt");
        $sql->execute();
        send_to($redirect_to);
    }

    // DELETE
    public function Delete($id, $redirect_to) {
        $bind = array(":id" => $id);
        HDB::hus()->Hdelete("resemprunt", "id=:id", $bind);
        send_to($redirect_to);
    }

    // INSERT
    public function Insert($idlib,$num,$mont1,$mont2,$monnaie, $taux, $dte, $dte_deduct, $duree, $idagent, $psedo, $site_id) {

        $values = array(array('libelle' => $idlib,'num_emprnt' => $num, 'montant' => $mont1, 'montant2' => $mont2, 'monnaie' => $monnaie, 'taux' => $taux, 'dte' => $dte, 'dte_deduct' => $dte_deduct, 'duree' => $duree, 'employe_id' => $idagent, 'psedo' => $psedo, 'site_id' => $site_id));
        HDB::hus()->Hinsert('resemprunt', $values);
        $last_id = HDB::hus()->lastInsertId();
        return $last_id;
    }

    // UPDATE
    public function Update($libelle, $type, $montant, $dte, $dte_deduct, $employe_id, $psedo, $site_id, $id) {
        $sql = "  libelle =:libelle,type =:type,montant =:montant,dte =:dte,dte_deduct =:dte_deduct,employe_id =:employe_id,psedo =:psedo,site_id =:site_id WHERE id = :id ";
        $data = array(':libelle' => $libelle, ':type' => $type, ':montant' => $montant, ':dte' => $dte, ':dte_deduct' => $dte_deduct, ':employe_id' => $employe_id, ':psedo' => $psedo, ':site_id' => $site_id, ':id' => $id);
        HDB::hus()->Hupdate('resemprunt', $sql, $data);
    }

    //View pret&avance
    public function ViewPretAvan($libelle, $site_id) {
        $requete = 'SELECT d.noms,a.id AS idresemprunt,a.libelle,SUM(a.montant) AS montant,a.montant2,a.monnaie AS monnaieresemprunt,a.taux AS tauxresemprunt,a.dte,a.dte_deduct,a.duree,a.employe_id
	FROM resemprunt AS a,resemployes AS d
	WHERE  a.employe_id=d.id AND a.libelle=:libelle AND a.site_id=:site_id GROUP BY a.employe_id ORDER BY d.noms ASC';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':site_id', $site_id);
        $query->BindParam(':libelle', $libelle);

        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function ViewPretAvan1($employe_id,$libelle, $site_id) {
        $requete = 'SELECT d.noms,a.id AS idresemprunt,a.libelle,a.montant AS montant,a.montant2,a.monnaie AS monnaieresemprunt,a.taux AS tauxresemprunt,a.dte,a.num_emprnt,a.dte_deduct,a.duree,a.employe_id
    FROM resemprunt AS a,resemployes AS d
    WHERE  a.employe_id=d.id AND a.libelle=:libelle AND a.site_id=:site_id AND a.employe_id=:employe_id  ORDER BY d.noms ASC';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':site_id', $site_id);
        $query->BindParam(':libelle', $libelle);
                $query->BindParam(':employe_id', $employe_id);


        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    //Détail pret&avance
    public function SelectOneDetails($libelle,$id) {
    $requete = 'SELECT b.montant AS montrembourse,b.monnaie AS monnaierembourse,b.taux AS tauxremourse,b.dte AS dterembourse,b.emprunt_id 
    FROM resemprunt AS a,resremboursement AS b
    WHERE a.id=b.emprunt_id  AND a.libelle=:libelle AND b.emprunt_id=:emprunt_id ORDER BY b.dte DESC';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':libelle', $libelle);
    $query->BindParam(':emprunt_id', $id);
    try {
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    }


}

// end class
?>
	
