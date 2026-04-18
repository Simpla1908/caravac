
<?php

/*
 * =======================================================================
 * CLASSNAME:        ressalaire_model
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		ressalaire
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include_once(APP_FOLDER . '/models/classes/class_ressalaire.php');

class ressalaire_model {

    // SELECT ALL
    public function SelectAll($idsite){
         $requete='SELECT a.*,b.*,c.libelle AS fonction,d.libelle AS departement,f.*,
                    e.libelle AS categorie,e.id AS idcat,e.salbase,e.devise
                    FROM  resemployes  AS a, rescontrat AS b, resfonction AS c,resdepartement AS d,rescategorie AS e,ressalaire AS f
                         WHERE a.id=b.employe_id 
                         AND a.fonction_id=c.id 
                         AND a.departement_id=d.id
                         AND c.categorie_id=e.id
                         AND a.id=f.employe_id 
                         AND a.id_hotel=:id
                         ORDER BY a.noms,f.libelle2';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id',$idsite);
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
       // RETOURNE RUBRIQUES SALAIRE
    public function GetRubriques($id) {
         $requete='SELECT * FROM resrubrique AS a, resrubriquesal AS b
                    WHERE a.id=b.rubrique_id AND b.salaire_id=:id';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id',$id);
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    //Select Count for Pagination
    public function CountRow() {
        return HDB::hus()->Hcount("ressalaire");
    }

    // SELECT ONE
    public function SelectOne($id) {
//        $bind = array(":id" => $id);
//        return HDB::hus()->Hone("ressalaire", "id=:id", $bind);
         $requete='SELECT a.*,b.*,c.libelle AS fonction,d.libelle AS departement,f.*,
                    e.libelle AS categorie,e.id AS idcat,e.salbase,e.devise
                    FROM  resemployes  AS a, rescontrat AS b, resfonction AS c,resdepartement AS d,rescategorie AS e,ressalaire AS f
                         WHERE a.id=b.employe_id 
                         AND a.fonction_id=c.id 
                         AND a.departement_id=d.id
                         AND c.categorie_id=e.id
                         AND a.id=f.employe_id 
                         AND f.id=:id';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id',$id);
        try {
            $query->execute();
            return $query->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // QUICK SEARCH
    public function AutoSearch($qstring, $limit, $where) {
        $bind = array(":svalue" => "%$qstring%");
        return HDB::hus()->Hselect("ressalaire", "$where LIKE :svalue LIMIT $limit", $bind);
    }

    // TRUNCATE TABLE
    public function TruncateTable($redirect_to) {
        $sql = HDB::hus()->prepare("TRUNCATE ressalaire");
        $sql->execute();
        send_to($redirect_to);
    }

    // DELETE
    public function Delete($id, $redirect_to) {
        $bind = array(":id" => $id);
        HDB::hus()->Hdelete("ressalaire", "id=:id", $bind);
        send_to($redirect_to);
    }

    // INSERT
    public function Insert($libelle, $libelle2, $nbjrpreste, $nbjrconge,$montant,$totbase,$taux,$dte, $employe_id, $psedo, $site_id, $rubriques, $montants,$remboursement) {
        $bdd = HDB::hus();
        $montant = montant_equivalent_bdd($_SESSION['Paie_affiche'],getsymbole_local() ,$taux,$montant);
        $totbase = montant_equivalent_bdd($_SESSION['Paie_affiche'],getsymbole_local() ,$taux,$totbase);
        $values = array(array('libelle' => $libelle, 'libelle2' => $libelle2, 'nbjrpreste' => $nbjrpreste, 'nbjrconge' => $nbjrconge, 'montant' => $montant,'totbase'=>$totbase,'taux'=>$taux,'dte' => $dte, 'employe_id' => $employe_id, 'psedo' => $psedo, 'site_id' => $site_id));
        $bdd->Hinsert('ressalaire', $values);
        $salaire_id = HDB::hus()->lastInsertId();
        $cpt1 = count($rubriques);
        for ($i = 0; $i <= $cpt1 - 1; $i++) {
            if ($rubriques[$i] != 'no') {
                $rubrique_id = $rubriques[$i];
                $montant = montant_equivalent_bdd($_SESSION['Paie_affiche'],getsymbole_local() ,$taux, $montants[$i]);
                $requete = $bdd->prepare("INSERT resrubriquesal(rubrique_id,salaire_id,valeur)
                                            VALUES(:rubrique_id,:salaire_id,:valeur)");
                $requete->BindParam(':rubrique_id', $rubrique_id);
                $requete->BindParam(':salaire_id', $salaire_id);
                $requete->BindParam(':valeur', $montant);
                $requete->execute();
            }
        }
        //REMBOURSEMENT DES EMPRUNTS
        $cpt1 = count($remboursement['rubrique']);
        for ($i = 0; $i <= $cpt1 - 1; $i++) {
            $emprunt_id=$remboursement['emprunt_ids'][$i];
            $montant= montant_equivalent_bdd($_SESSION['Paie_affiche'],getsymbole_local() ,$taux,$remboursement['montremb'][$i]);
            $rubrique_id=$remboursement['rubrique'][$i];
            $requete = $bdd->prepare("INSERT resrubriquesal(rubrique_id,salaire_id,valeur)
                                        VALUES(:rubrique_id,:salaire_id,:valeur)");
            $requete->BindParam(':rubrique_id', $rubrique_id);
            $requete->BindParam(':salaire_id', $salaire_id);
            $requete->BindParam(':valeur', $montant);
            $requete->execute();
            //Insertion emprunt 
            $requete = $bdd->prepare("INSERT resremboursement(employe_id,salaire_id,montant,monnaie,taux,dte,emprunt_id)
                                        VALUES(:employe_id,:salaire_id,:montant,:monnaie,:taux,:dte,:emprunt_id)");
            $requete->BindParam(':employe_id', $employe_id);
            $requete->BindParam(':salaire_id', $salaire_id);
            $requete->BindParam(':montant', $montant);
            $requete->BindParam(':monnaie',$_SESSION['Paie_affiche']);
            $requete->BindParam(':taux', $_SESSION['Paie_taux']);
            $requete->BindParam(':dte',$dte);
            $requete->BindParam(':emprunt_id',$emprunt_id);
            $requete->execute();
        }
        return $salaire_id;
    }
    public function decompte($nbjrpreste, $nbjrconge,$montant,$totbase,$taux,$dte,$dte2,$employe_id, $psedo, $site_id,$jrpreavis,$cong6preavis,$congcomp,$connonpris,$arsal,$indemnite,$ancienete,$motif,$decompte){
        $bdd = HDB::hus();
        $montant = montant_equivalent_bdd($_SESSION['Paie_affiche'],getsymbole_local() ,$taux,$montant);
        $totbase = montant_equivalent_bdd($_SESSION['Paie_affiche'],getsymbole_local() ,$taux,$totbase);
        $values = array(array('nbjrpreste'=>$nbjrpreste,'nbjrconge' => $nbjrconge,'montant' => $montant,'totbase'=>$totbase,'taux'=>$taux,'dte' => $dte,'dte2' =>$dte2,
                              'employe_id' => $employe_id, 'psedo' => $psedo, 'site_id' => $site_id,'jrpreavis'=>$jrpreavis,'cong6preavis'=>$cong6preavis,
                              'congcomp'=>$congcomp,'connonpris'=>$connonpris,'arsal'=>$arsal,'indemnite'=>$indemnite,'ancienete'=>$ancienete,'motif'=>$motif,'decompte'=>$decompte));
        $bdd->Hinsert('ressalaire', $values);
        $salaire_id = HDB::hus()->lastInsertId();
//        $cpt1 = count($rubriques);
//        for ($i = 0; $i <= $cpt1 - 1; $i++) {
//            if ($rubriques[$i] != 'no') {
//                $rubrique_id = $rubriques[$i];
//                $montant = montant_equivalent_bdd($_SESSION['Paie_affiche'],getsymbole_local() ,$taux, $montants[$i]);
//                $requete = $bdd->prepare("INSERT resrubriquesal(rubrique_id,salaire_id,valeur)
//                                            VALUES(:rubrique_id,:salaire_id,:valeur)");
//                $requete->BindParam(':rubrique_id', $rubrique_id);
//                $requete->BindParam(':salaire_id', $salaire_id);
//                $requete->BindParam(':valeur', $montant);
//                $requete->execute();
//            }
//        }
        
        return $salaire_id;
    }
    // UPDATE
    public function Update($libelle, $nbjrpreste, $nbjrconge, $type, $montant, $dte, $employe_id, $psedo, $site_id, $id) {
        $sql = "  libelle =:libelle,nbjrpreste =:nbjrpreste,nbjrconge =:nbjrconge,type =:type,montant =:montant,dte =:dte,employe_id =:employe_id,psedo =:psedo,site_id =:site_id WHERE id = :id ";
        $data = array(':libelle' => $libelle, ':nbjrpreste' => $nbjrpreste, ':nbjrconge' => $nbjrconge, ':type' => $type, ':montant' => $montant, ':dte' => $dte, ':employe_id' => $employe_id, ':psedo' => $psedo, ':site_id' => $site_id, ':id' => $id);
        HDB::hus()->Hupdate('ressalaire', $sql, $data);
    }
     
}

// end class
?>
	
