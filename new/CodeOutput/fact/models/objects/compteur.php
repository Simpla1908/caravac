
<?php

/*
 * =======================================================================
 * CLASSNAME:        compteur_model
 * DATE CREATED:  	14-08-2017
 * FOR TABLE:  		compteur
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include_once(APP_FOLDER . '/models/classes/class_compteur.php');

class compteur_model {

    // SELECT ALL
    public function SelectAll($limit = NULL) {
        if ($limit) {
            $startpg = pageparam($limit);
            return HDB::hus()->Hselect("compteur LIMIT {$startpg} , {$limit}");
        } else {
            return HDB::hus()->Hselect("compteur");
        }
    }

    //Select Count for Pagination
    public function CountRow() {
        return HDB::hus()->Hcount("compteur");
    }

    // SELECT ONE
    public function SelectOne($id) {
        $bind = array(":id" => $id);
        return HDB::hus()->Hone("compteur", "id=:id", $bind);
    }

    // QUICK SEARCH
    public function AutoSearch($qstring, $limit, $where) {
        $bind = array(":svalue" => "%$qstring%");
        return HDB::hus()->Hselect("compteur", "$where LIKE :svalue LIMIT $limit", $bind);
    }

    // TRUNCATE TABLE
    public function TruncateTable($redirect_to) {
        $sql = HDB::hus()->prepare("TRUNCATE compteur");
        $sql->execute();
        send_to($redirect_to);
    }

    // DELETE
    public function Delete($id, $redirect_to) {
        $bind = array(":id" => $id);
        HDB::hus()->Hdelete("compteur", "id=:id", $bind);
        send_to($redirect_to);
    }

    // INSERT
    public function Insert($libelle, $numero, $site_id) {
        $values = array(array('libelle' => $libelle, 'numero' => $numero, 'site_id' => $site_id));
        HDB::hus()->Hinsert('compteur', $values);
    }
    public function Insertrec($libelle, $numero, $site_id,$bdd) {
        $values = array(array('libelle' => $libelle, 'numero' => $numero, 'site_id' => $site_id));
        $bdd->Hinsert('compteur', $values);
    }

    // UPDATE
    public function Update1($libelle, $numero, $site_id, $id) {
        $sql = "  libelle =:libelle,numero =:numero,site_id =:site_id WHERE id = :id ";
        $data = array(':libelle' => $libelle, ':numero' => $numero, ':site_id' => $site_id, ':id' => $id);
        HDB::hus()->Hupdate('compteur', $sql, $data);
    }

    // UPDATE
    public function Update($libelle, $numero, $site_id) {
        $sql = "numero=:numero WHERE libelle=:libelle AND site_id=:site_id";
        $data = array(':numero' => $numero, ':libelle' => $libelle, ':site_id' => $site_id);
        HDB::hus()->Hupdate('compteur', $sql, $data);
    }

    // VERIFICATION
    public function verification($site_id, $libelle) {
        $bool = 0;
        $requete = 'SELECT COUNT(*) AS nb_lg FROM compteur WHERE libelle=:libelle  AND site_id=:id';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':libelle', $libelle);
        $query->BindParam(':id', $site_id);
        try {
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);
            $nbre = $result->nb_lg;
            if ($nbre > 0) {
                $bool = 1;
            }
            return $bool;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function verificationrec($site_id, $libelle,$bdd) {
        $bool = 0;
        $requete = 'SELECT COUNT(*) AS nb_lg FROM compteur WHERE libelle=:libelle  AND site_id=:id';
        $query = $bdd->prepare($requete);
        $query->BindParam(':libelle', $libelle);
        $query->BindParam(':id', $site_id);
        try {
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);
            $nbre = $result->nb_lg;
            if ($nbre > 0) {
                $bool = 1;
            }
            return $bool;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function selectCompteurSite($site_id,$libelle) {
        $numero = 0;
        $requete = 'SELECT numero FROM compteur WHERE libelle=:libelle  AND site_id=:id';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':libelle', $libelle);
        $query->BindParam(':id',$site_id);
        try {
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);
            $numero = $result->numero;
            return $numero;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
     }
     public function selectCompteurSiterec($site_id,$libelle,$bdd) {
        $numero = 0;
        $requete = 'SELECT numero FROM compteur WHERE libelle=:libelle  AND site_id=:id';
        $query = $bdd->prepare($requete);
        $query->BindParam(':libelle', $libelle);
        $query->BindParam(':id',$site_id);
        try {
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);
            $numero = $result->numero;
            return $numero;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
     }
    public function getnumerotation($site_id, $libelle) {
        $num_cmd = 1;
        $bool = $this->verification($site_id, $libelle);
        if ($bool == 1) {
            $num_cmd = $this->selectCompteurSite($site_id, $libelle);
        } else {
            $this->Insert($libelle, $num_cmd, $site_id);
        }
        return $num_cmd;
    }
    
    
    public function getnumerotationrec($site_id, $libelle,$bdd) {
        $num_cmd = 1;
        $bool = $this->verificationrec($site_id, $libelle,$bdd);
        if ($bool == 1) {
            $num_cmd = $this->selectCompteurSiterec($site_id, $libelle,$bdd);
        } else {
            $this->Insertrec($libelle, $num_cmd, $site_id,$bdd);
        }
        return $num_cmd;
    }

    

}

// end class
?>
	
