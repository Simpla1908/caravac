
<?php

/*
 * =======================================================================
 * CLASSNAME:        resdepartement_model
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		resdepartement
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include_once(APP_FOLDER . '/models/classes/class_resdepartement.php');

class resdepartement_model {

    // SELECT ALL
    public function SelectAll($idsite) {
        $requete = 'SELECT * FROM resdepartement AS a WHERE a.site_id=:id AND a.psedo=0 ORDER BY a.libelle ASC';
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
    public function CountRow() {
        return HDB::hus()->Hcount("resdepartement");
    }

    // SELECT ONE
    public function SelectOne($id) {
        $bind = array(":id" => $id);
        return HDB::hus()->Hone("resdepartement", "id=:id", $bind);
    }

    // QUICK SEARCH
    public function AutoSearch($qstring, $limit, $where) {
        $bind = array(":svalue" => "%$qstring%");
        return HDB::hus()->Hselect("resdepartement", "$where LIKE :svalue LIMIT $limit", $bind);
    }

    // TRUNCATE TABLE
    public function TruncateTable($redirect_to) {
        $sql = HDB::hus()->prepare("TRUNCATE resdepartement");
        $sql->execute();
        send_to($redirect_to);
    }

    // DELETE
    public function Delete($id, $redirect_to) {
        $psedo = 1;
        $sql = "  psedo =:psedo WHERE id = :id ";
        $data = array(':psedo' => $psedo, ':id' => $id);
        HDB::hus()->Hupdate('resdepartement', $sql, $data);
        send_to($redirect_to);
    }

    // INSERT
    public function Insert($libelle, $psedo, $site_id){
        $values = array(array('libelle' => $libelle, 'psedo' => $psedo, 'site_id' => $site_id));
        HDB::hus()->Hinsert('resdepartement', $values);
    }

    // UPDATE
    public function Update($libelle, $psedo, $site_id, $id) {
        $sql = "  libelle =:libelle,psedo =:psedo,site_id =:site_id WHERE id = :id ";
        $data = array(':libelle' => $libelle, ':psedo' => $psedo, ':site_id' => $site_id, ':id' => $id);
        HDB::hus()->Hupdate('resdepartement', $sql, $data);
    }

}

// end class
?>
	
