<?php

/*
 * =======================================================================
 * CLASSNAME:        respointage_model
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		respointage
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include_once(APP_FOLDER . '/models/classes/class_respointage.php');

class respointage_model {

    // SELECT ALL
    public function SelectAll($limit = NULL) {
        if ($limit) {
            $startpg = pageparam($limit);
            return HDB::hus()->Hselect("respointage LIMIT {$startpg} , {$limit}");
        } else {
            return HDB::hus()->Hselect("respointage");
        }
    }

    //Select Count for Pagination
    public function CountRow() {
        return HDB::hus()->Hcount("respointage");
    }

    // SELECT ONE
    public function SelectOne($id) {
        $bind = array(":id" => $id);
        return HDB::hus()->Hone("respointage", "id=:id", $bind);
    }

    // QUICK SEARCH
    public function AutoSearch($qstring, $limit, $where) {
        $bind = array(":svalue" => "%$qstring%");
        return HDB::hus()->Hselect("respointage", "$where LIKE :svalue LIMIT $limit", $bind);
    }

    // TRUNCATE TABLE
    public function TruncateTable($redirect_to) {
        $sql = HDB::hus()->prepare("TRUNCATE respointage");
        $sql->execute();
        send_to($redirect_to);
    }

    // DELETE
    public function Delete($id, $redirect_to) {
        $bind = array(":id" => $id);
        HDB::hus()->Hdelete("respointage", "id=:id", $bind);
        send_to($redirect_to);
    }

    // INSERT
    public function Insert($employe_id, $dte_in, $dte_out, $hr_in, $hr_out, $motif, $justification, $presence, $retard, $absence, $conge, $malade, $hrs_suplmtr, $horaire_id, $idsite) {

        $values = array(array('employe_id' => $employe_id, 'dte_in' => $dte_in, 'dte_out' => $dte_out, 'hr_in' => $hr_in, 'hr_out' => $hr_out, 'motif' => $motif, 'justification' => $justification, 'presence' => $presence, 'retard' => $retard, 'absence' => $absence, 'conge' => $conge, 'malade' => $malade, 'hrs_suplmtr' => $hrs_suplmtr, 'horaire_id' => $horaire_id, 'idsite' => $idsite));
        HDB::hus()->Hinsert('respointage', $values);
    }

    public function Insert1($employe_id, $dte_in, $dte_out, $hr_in, $hr_out, $motif, $justification, $presence, $retard, $absence, $conge, $malade, $hrs_suplmtr, $horaire_id, $arrive, $depart,$hr_ind,$hr_outf,$idsite) {

        $values = array(array('employe_id' => $employe_id, 'dte_in' => $dte_in, 'dte_out' => $dte_out, 'hr_in' => $hr_in, 'hr_out' => $hr_out, 'motif' => $motif, 'justification' => $justification, 'presence' => $presence, 'retard' => $retard, 'absence' => $absence, 'conge' => $conge, 'malade' => $malade, 'hrs_suplmtr' => $hrs_suplmtr, 'horaire_id' => $horaire_id, 'arrive' => $arrive, 'depart' => $depart, 'hr_ind' => $hr_ind, 'hr_outf' => $hr_outf, 'idsite' => $idsite));
        HDB::hus()->Hinsert('respointage', $values);
        $idpoint = HDB::hus()->lastInsertId();
        return $idpoint;
    }
     public function Insert2($employe_id, $dte_in, $dte_out, $hr_in, $hr_out, $motif, $justification, $presence, $retard, $absence, $conge, $malade,$afich,$hrs_suplmtr, $horaire_id, $arrive, $depart,$hr_ind,$hr_outf,$idsite) {

        $values = array(array('employe_id' => $employe_id, 'dte_in' => $dte_in, 'dte_out' => $dte_out, 'hr_in' => $hr_in, 'hr_out' => $hr_out, 'motif' => $motif, 'justification' => $justification, 'presence' => $presence, 'retard' => $retard, 'absence' => $absence, 'conge' => $conge, 'malade' => $malade, 'afich' => $afich, 'hrs_suplmtr' => $hrs_suplmtr, 'horaire_id' => $horaire_id, 'arrive' => $arrive, 'depart' => $depart, 'hr_ind' => $hr_ind, 'hr_outf' => $hr_outf, 'idsite' => $idsite));
        HDB::hus()->Hinsert('respointage', $values);
        $idpoint = HDB::hus()->lastInsertId();
        return $idpoint;
    }

    // UPDATE
    public function Update($employe_id, $dte_in, $dte_out, $hr_in, $hr_out, $motif, $justification, $presence, $retard, $absence, $conge, $malade, $hrs_suplmtr, $horaire_id, $idsite, $id) {
        $sql = "  employe_id =:employe_id,dte_in =:dte_in,dte_out =:dte_out,hr_in =:hr_in,hr_out =:hr_out,motif =:motif,justification =:justification,presence =:presence,retard =:retard,absence =:absence,conge =:conge,malade =:malade,hrs_suplmtr =:hrs_suplmtr,horaire_id =:horaire_id,depart =:depart,idsite =:idsite WHERE id = :id ";
        $data = array(':employe_id' => $employe_id, ':dte_in' => $dte_in, ':dte_out' => $dte_out, ':hr_in' => $hr_in, ':hr_out' => $hr_out, ':motif' => $motif, ':justification' => $justification, ':presence' => $presence, ':retard' => $retard, ':absence' => $absence, ':conge' => $conge, ':malade' => $malade, ':hrs_suplmtr' => $hrs_suplmtr, ':horaire_id' => $horaire_id, ':idsite' => $idsite, ':id' => $id);
        HDB::hus()->Hupdate('respointage', $sql, $data);
    }

    // UPDATE1
    public function Update1($employe_id, $dte_out, $hr_out, $motif, $presence, $absence,$retard, $hrs_suplmtr, $depart, $id,$horaire_id) {
        $sql = "  employe_id =:employe_id,dte_out =:dte_out,hr_out =:hr_out,motif =:motif,presence=:presence,absence=:absence,retard=:retard,hrs_suplmtr =:hrs_suplmtr,depart=:depart WHERE horaire_id = :horaire_id AND  employe_id = :employe_id";
        $data = array(':employe_id' => $employe_id, ':dte_out' => $dte_out, ':hr_out' => $hr_out, ':motif' => $motif, ':presence' => $presence, ':absence' => $absence, ':retard' => $retard, ':hrs_suplmtr' => $hrs_suplmtr, ':depart' => $depart, ':id' => $id, ':horaire_id' => $horaire_id, ':employe_id' => $employe_id);
        HDB::hus()->Hupdate('respointage', $sql, $data);
    }
    public function Update2($idpoint,$dte_out,$hr_out,$motif,$presence,$absence,$afich) {
        $sql = "dte_out =:dte_out,hr_out =:hr_out,motif =:motif,presence =:presence,absence =:absence,afich =:afich WHERE id = :id ";
        $data = array(':dte_out' => $dte_out,':hr_out' => $hr_out,':motif' => $motif,':presence' => $presence,':absence' => $absence,':afich' => $afich,':id' => $idpoint);
        HDB::hus()->Hupdate('respointage', $sql, $data);
    }
     public function Update3($idpoint,$motif,$presence,$afich) {
        $sql = "motif =:motif,presence =:presence,afich =:afich WHERE id = :id ";
        $data = array(':motif' => $motif,':presence' => $presence,':afich' => $afich,':id' => $idpoint);
        HDB::hus()->Hupdate('respointage', $sql, $data);
    }

    function UpdateDefaultShift($employe_id, $horaire_id) {
        $compt = 1;
        $hr_tamp = 0;
        $requete = HDB::hus()->prepare("
        SELECT  horaire_id,defaul
        FROM resemployehoraire 
        WHERE employe_id=:employe_id 
        ORDER BY defaul");
        $requete->BindParam(':employe_id', $employe_id);
        $requete->execute();
        $horaire_svt = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($horaire_svt as $hs) {
            if ($hs->defaul == 1) {
                $hr_tamp = $hs->horaire_id;
            } else {
                $requete = HDB::hus()->prepare("UPDATE resemployehoraire SET defaul=:default WHERE horaire_id=:horaire_id AND employe_id=:employe_id");
                $requete->BindParam(':default', $compt);
                $requete->BindParam(':horaire_id', $hs->horaire_id);
                $requete->BindParam(':employe_id', $employe_id);
                $requete->execute();
                $compt++;
            }
        }
        $requete = HDB::hus()->prepare("UPDATE resemployehoraire SET defaul=:default WHERE horaire_id=:horaire_id AND employe_id=:employe_id");
        $requete->BindParam(':default', $compt);
        $requete->BindParam(':horaire_id', $hr_tamp);
        $requete->BindParam(':employe_id', $employe_id);
        $requete->execute();
    }

    function UpdateDataShift($employe_id, $shift, $nbjrs, $nbjrsmaj, $nbseq, $nbseqmaj) {
        $nbjrsmaj = $nbjrsmaj - 1;
        $requete = HDB::hus()->prepare("UPDATE resemployehoraire SET nbrjrsmaj=:nbrjrsmaj WHERE horaire_id=:shift AND employe_id=:employe_id");
        $requete->BindParam(':nbrjrsmaj', $nbjrsmaj);
        $requete->BindParam(':shift', $shift);
        $requete->BindParam(':employe_id', $employe_id);
        $requete->execute();
        if ($nbjrsmaj == 0) {
            $nbseqmaj = $nbseqmaj - 1;
            $requete = HDB::hus()->prepare("UPDATE resemployehoraire SET nbrjrsmaj=:nbrjrsmaj,seqjrsmaj=:seqjrsmaj WHERE horaire_id=:shift AND employe_id=:employe_id");
            $requete->BindParam(':nbrjrsmaj', $nbjrs);
            $requete->BindParam(':seqjrsmaj', $nbseqmaj);
            $requete->BindParam(':shift', $shift);
            $requete->BindParam(':employe_id', $employe_id);

            $requete->execute();
            if ($nbseqmaj == 0) {
                $requete = HDB::hus()->prepare("UPDATE resemployehoraire SET seqjrsmaj=:seqjrsmaj WHERE horaire_id=:shift AND employe_id=:employe_id");
                $requete->BindParam(':seqjrsmaj', $nbseq);
                $requete->BindParam(':shift', $shift);
                $requete->BindParam(':employe_id', $employe_id);
                $requete->execute();
                $this->UpdateDefaultShift($employe_id, $shift);
            }
        }
    }

    function CheckPointEmployehoraire($employe_id, $dte, $horaire_id) {
        $dejapoint = 0;
        $nbrlgn = 0;
        $requete = HDB::hus()->prepare("
		SELECT  *
		FROM respointage 
		WHERE employe_id=:employe_id 
		AND dte_in=:dte
        AND horaire_id=:horaire_id");
        $requete->BindParam(':employe_id', $employe_id);
        $requete->BindParam(':dte', $dte);
        $requete->BindParam(':horaire_id', $horaire_id);
        $requete->execute();
        $result_req = $requete->fetchAll(PDO::FETCH_OBJ);
        $nbrlgn = count($result_req);
        if ($nbrlgn > 0) {
            $dejapoint = 1;
        }
        return $dejapoint;
    }

    function infosPointEmployehoraire($employe_id, $dte, $horaire_id) {
        $_SESSION['data'] = array();
        $_SESSION['data']['id'] = array();
        $_SESSION['data']['dte_in'] = array();
        $_SESSION['data']['dte_out'] = array();
        $_SESSION['data']['hr_in'] = array();
        $_SESSION['data']['hr_out'] = array();
        $_SESSION['data']['motif'] = array();
        $_SESSION['data']['justification'] = array();
        $_SESSION['data']['idtmppoint'] = array();
        $_SESSION['data']['departbool'] = array();
        $requete = HDB::hus()->prepare("
		SELECT  *,a.id AS idpoint,b.id AS idtmppoint
        FROM respointage  AS a,restmp_pointage AS b
        WHERE a.id=b.point_id 
        AND a.employe_id=:employe_id 
        AND a.dte_in=:dte
        AND a.horaire_id=:horaire_id");
        $requete->BindParam(':employe_id', $employe_id);
        $requete->BindParam(':dte', $dte);
        $requete->BindParam(':horaire_id', $horaire_id);
        $requete->execute();
        $result_req = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($result_req as $dh) {
            array_push($_SESSION['data']['id'], $dh->idpoint);
            array_push($_SESSION['data']['dte_in'], $dh->dte_in);
            array_push($_SESSION['data']['dte_out'], $dh->dte_out);
            array_push($_SESSION['data']['hr_in'], $dh->hr_in);
            array_push($_SESSION['data']['hr_out'], $dh->hr_out);
            array_push($_SESSION['data']['motif'], $dh->motif);
            array_push($_SESSION['data']['justification'], $dh->justification);
            array_push($_SESSION['data']['idtmppoint'], $dh->idtmppoint);
            array_push($_SESSION['data']['departbool'], $dh->depart);
        }
        return $_SESSION['data'];
    }

    function infosPointEmployehoraireOUT($employe_id, $dte) {
        $_SESSION['data'] = array();
        $_SESSION['data']['id'] = array();
        $_SESSION['data']['dte_in'] = array();
        $_SESSION['data']['dte_out'] = array();
        $_SESSION['data']['hr_in'] = array();
        $_SESSION['data']['hr_out'] = array();
        $_SESSION['data']['motif'] = array();
        $_SESSION['data']['justification'] = array();

        $requete = HDB::hus()->prepare("
        SELECT  *
        FROM respointage 
        WHERE employe_id=:employe_id 
        AND dte_out=:dte");
        $requete->BindParam(':employe_id', $employe_id);
        $requete->BindParam(':dte', $dte);
        $requete->execute();
        $result_req = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($result_req as $dh) {
            array_push($_SESSION['data']['id'], $dh->id);
            array_push($_SESSION['data']['dte_in'], $dh->dte_in);
            array_push($_SESSION['data']['dte_out'], $dh->dte_out);
            array_push($_SESSION['data']['hr_in'], $dh->hr_in);
            array_push($_SESSION['data']['hr_out'], $dh->hr_out);
            array_push($_SESSION['data']['motif'], $dh->motif);
            array_push($_SESSION['data']['justification'], $dh->justification);
        }
        return $_SESSION['data'];
    }

    function DataShiftjour($horaire_id, $jourlib) {
        $_SESSION['data'] = array();
         $_SESSION['data']['exist'] = array();
        $_SESSION['data']['jours_id'] = array();
        $_SESSION['data']['libelle_jrs'] = array();
        $_SESSION['data']['dbt'] = array();
        $_SESSION['data']['mrg'] = array();
        $_SESSION['data']['fin'] = array();
        $_SESSION['data']['avmrgdbt'] = array();
        $_SESSION['data']['mrgfin'] = array();
        $_SESSION['data']['avmrgdbtsec'] = array();
        $_SESSION['data']['dbtsec'] = array();
        $_SESSION['data']['mrgdbtsec'] = array();
        $_SESSION['data']['finsec'] = array();
        $_SESSION['data']['mrgfinsec'] = array();
        $_SESSION['data']['exist'] [0]=0;
        $requete = HDB::hus()->prepare("
    	SELECT  *
    	FROM reshorairejours AS a,resjours AS b 
    	WHERE a.jours_id=b.idjrs 
    	AND b.libjrs=:libjrs 
    	AND a.horaire_id=:horaire_id");
        $requete->BindParam(':libjrs', $jourlib);
        $requete->BindParam(':horaire_id', $horaire_id);
        $requete->execute();
        $data_hr = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($data_hr as $dh) {
            $_SESSION['data']['exist'][0]=1;
            array_push($_SESSION['data']['jours_id'], $dh->jours_id);
            array_push($_SESSION['data']['libelle_jrs'], $dh->libjrs);
            array_push($_SESSION['data']['dbt'], $dh->dbt);
            array_push($_SESSION['data']['mrg'], $dh->mrg);
            array_push($_SESSION['data']['fin'], $dh->fin);
            array_push($_SESSION['data']['avmrgdbt'], $dh->avmrgdbt);
            array_push($_SESSION['data']['mrgfin'], $dh->mrgfin);
            array_push($_SESSION['data']['avmrgdbtsec'], $dh->avmrgdbtsec);
            array_push($_SESSION['data']['dbtsec'], $dh->dbtsec);
            array_push($_SESSION['data']['mrgdbtsec'], $dh->mrgdbtsec);
            array_push($_SESSION['data']['finsec'], $dh->finsec);
            array_push($_SESSION['data']['mrgfinsec'], $dh->mrgfinsec);
        }
        return $_SESSION['data'];
    }

    function DatasEmployehoraire($employe_id) {
        $_SESSION['data'] = array();
        $_SESSION['data']['employe_id'] = array();
        $_SESSION['data']['horaire_id'] = array();
        $_SESSION['data']['nbrjrs'] = array();
        $_SESSION['data']['nbrjrsmaj'] = array();
        $_SESSION['data']['seq'] = array();
        $_SESSION['data']['seqjrsmaj'] = array();
        $requete = HDB::hus()->prepare("
		SELECT  *
		FROM resemployehoraire 
		WHERE employe_id=:employe_id 
		AND defaul=1");
        $requete->BindParam(':employe_id', $employe_id);
        $requete->execute();
        $data_empl = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($data_empl as $de) {
            array_push($_SESSION['data']['employe_id'], $de->employe_id);
            array_push($_SESSION['data']['horaire_id'], $de->horaire_id);
            array_push($_SESSION['data']['nbrjrs'], $de->nbrjrs);
            array_push($_SESSION['data']['nbrjrsmaj'], $de->nbrjrsmaj);
            array_push($_SESSION['data']['seq'], $de->seq);
            array_push($_SESSION['data']['seqjrsmaj'], $de->seqjrsmaj);
        }
        return $_SESSION['data'];
    }

    function DatasEmployehorairePerso($employe_id, $libjrs, $hr_point) {
        $_SESSION['data'] = array();
        $_SESSION['data']['exist'] = array();
        $_SESSION['data']['horaire_id'] = array();
        $_SESSION['data']['exist'] [0] = 0;
        $_SESSION['data']['horaire_id'] [0] = 0;

        $requete = HDB::hus()->prepare("SELECT  a.horaire_id AS shift_id
		FROM resemployehoraire AS a,reshorairejours AS b,resjours AS c
		WHERE a.employe_id=:employe_id
		AND  a.horaire_id=b.horaire_id
		AND  b.jours_id=c.idjrs
		AND  c.libjrs=:libjrs
		AND ((b.dbtsec<=b.finsec AND :hr_point>=b.dbtsec-b.avmrgdbtsec 
        AND :hr_point<=b.finsec) 
        OR (b.dbtsec>b.finsec AND :hr_point>=b.dbtsec-b.avmrgdbtsec))");
        $requete->BindParam(':employe_id', $employe_id);
        $requete->BindParam(':libjrs', $libjrs);
        $requete->BindParam(':hr_point', $hr_point);
        $requete->execute();
        $data_empl = $requete->fetchAll(PDO::FETCH_OBJ);
        if (COUNT($data_empl) > 0) {
            foreach ($data_empl as $de) {
                $_SESSION['data']['exist'] [0] = 1;
                $_SESSION['data']['horaire_id'][0] = $de->shift_id;
            }
        }

        return $_SESSION['data'];
    }

    function JourSemaine($date) {
        $jour{0} = "dimanche";
        $jour{1} = "lundi";
        $jour{2} = "mardi";
        $jour{3} = "mercredi";
        $jour{4} = "jeudi";
        $jour{5} = "vendredi";
        $jour{6} = "samedi";
        $timestamp = strtotime($date);
        $d = date("w/j/m/y", $timestamp);
        $date = explode("/", $d);
        $date_fr = $jour{$d[0]};
        return $date_fr;
    }

    function seconds_to_time($seconds) {
        // extract hours
        $hours = floor($seconds / (60 * 60));
        // extract minutes
        $divisor_for_minutes = $seconds % (60 * 60);
        $minutes = floor($divisor_for_minutes / 60);
        // extract the remaining seconds
        $divisor_for_seconds = $divisor_for_minutes % 60;
        $seconds = ceil($divisor_for_seconds);
        //create string HH:MM:SS
        //$ret = $hours . ":" . $minutes . ":" . $seconds;
        $ret = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
        return $ret;
    }
     function seconds_to_time2($seconds) {
        // extract hours
        $hours = floor($seconds / (60 * 60));
        // extract minutes
        $divisor_for_minutes = $seconds % (60 * 60);
        $minutes = floor($divisor_for_minutes / 60);
        // extract the remaining seconds
        $divisor_for_seconds = $divisor_for_minutes % 60;
        $seconds = ceil($divisor_for_seconds);
        //create string HH:MM:SS
        //$ret = $hours . ":" . $minutes . ":" . $seconds;
        return $hours;
    }


    function TimeToSec($time) {
        $sec = 0;
        foreach (array_reverse(explode(':', $time)) as $k => $v)
            $sec += pow(60, $k) * $v;
        return $sec;
    }

    function format_stringdateTodatetime($format1, $stringdate, $format2) {
        if ($stringdate != '') {
            $date = DateTime::createFromFormat($format1, $stringdate);
            return $date->format($format2);
        } else {
            return "00-00-0000";
        }
    }

    // INSERT tampon
    public function Inserttmp($employe_id, $dte_in, $point_id, $idsite, $horaire_id) {

        $values = array(array('employe_id' => $employe_id, 'dte_in' => $dte_in, 'point_id' => $point_id, 'idsite' => $idsite, 'horaire_id' => $horaire_id));
        HDB::hus()->Hinsert('restmp_pointage', $values);
    }
     public function Inserttmp1($employe_id,$dte_in, $point_id, $idsite, $horaire_id,$compteurshift,$idpointprec) {

        $values = array(array('employe_id' => $employe_id, 'dte_in' => $dte_in, 'point_id' => $point_id, 'idsite' => $idsite, 'horaire_id' => $horaire_id, 'compteurshift' => $compteurshift, 'idpointprec' => $idpointprec));
        HDB::hus()->Hinsert('restmp_pointage', $values);
    }

    // DELETE tampon
    public function Deltmp($idtmppoint) {
        $bind = array(":id" => $idtmppoint);
        HDB::hus()->Hdelete("restmp_pointage", "id=:id", $bind);
    }

      //EFFACER LAST INSERT POUR LES EMPLOYES DE 2 SHIFT
    public function DelPointage($employe_id,$dte_in) {
        $requete = 'DELETE FROM respointage WHERE employe_id=:employe_id AND dte_in=:dte_in';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':employe_id', $employe_id);
        $query->BindParam(':dte_in', $dte_in);
        $query->execute();
    }

    //View Permutation
    public function ViewPermut($idsite) {
        $requete = 'SELECT * FROM respermutation WHERE idsite=:idsite AND statut=0';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':idsite', $idsite);
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    function dataEmployeHoraire($employe_id,$horaire_id) {
        $_SESSION['data'] = array();
        $_SESSION['data']['id'] = array();
        $_SESSION['data']['type_permt'] = array();
        $_SESSION['data']['agent_permt_id'] = array();
        $_SESSION['data']['heure_suplmtr_dpt'] = array();
        $_SESSION['data']['dte_dbt'] = array();
        $_SESSION['data']['dte_fin'] = array();
        $requete = HDB::hus()->prepare("
        SELECT  *
        FROM resemployehoraire
        WHERE employe_id=:employe_id 
        AND horaire_id=:horaire_id");
        $requete->BindParam(':employe_id', $employe_id);
        $requete->BindParam(':horaire_id', $horaire_id);
        $requete->execute();
        $result_req = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($result_req as $dh) {
            array_push($_SESSION['data']['id'], $dh->id);
            array_push($_SESSION['data']['type_permt'], $dh->type_permt);
            array_push($_SESSION['data']['agent_permt_id'], $dh->agent_permt_id);
            array_push($_SESSION['data']['heure_suplmtr_dpt'], $dh->heure_suplmtr_dpt);
            array_push($_SESSION['data']['dte_dbt'], $dh->dte_dbt);
            array_push($_SESSION['data']['dte_fin'], $dh->dte_fin);
    
        }
        return $_SESSION['data'];
    }
    // SELECT POINTAGE ALL
    public function SelectPointageAll($idsite, $datedebut, $datefin, $limit = NULL) {
        if ($limit) {
            $startpg = pageparam($limit);
            $requete = 'SELECT b.id, b.matricule, b.noms,a.id,a.employe_id,SUM(a.presence) AS presence,SUM(a.retard) AS retard, 
                        SUM(a.absence) AS absence, SUM(a.conge) AS conge, SUM(a.malade) AS malade
                        FROM respointage AS a, resemployes AS b
                        WHERE b.id=a.employe_id AND a.dte_in BETWEEN :datedebut AND :datefin
                        AND a.afich=1 AND a.idsite=:id
                        GROUP BY a.employe_id
                        ORDER BY b.noms';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':datedebut', $datedebut);
            $query->BindParam(':datefin', $datefin);
            $query->BindParam(':id', $idsite);
//            $query->BindParam(':limit', $startpg);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        } else {
            $requete = 'SELECT b.id, b.matricule, b.noms,a.id,a.employe_id,SUM(a.presence) AS presence,SUM(a.retard) AS retard, 
                        SUM(a.absence) AS absence, SUM(a.conge) AS conge, SUM(a.malade) AS malade
                        FROM respointage AS a, resemployes AS b
                        WHERE b.id=a.employe_id AND a.dte_in BETWEEN :datedebut AND :datefin
                        AND a.afich=1 AND a.idsite=:id
                        GROUP BY a.employe_id
                        ORDER BY b.noms';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':datedebut', $datedebut);
            $query->BindParam(':datefin', $datefin);
            $query->BindParam(':id', $idsite);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
    }

    // SELECT POINTAGE AGENT
    public function SelectPointageAgent($employe_id, $idsite, $datedebut, $datefin) {

        $requete = 'SELECT d.id,d.dte_in, d.dte_out, d.hr_in, d.hr_out, d.motif,d.justification,d.employe_id,d.hrs_suplmtr
         FROM resemployes AS a, respointage AS d
                            WHERE a.id=d.employe_id
                            AND d.dte_in BETWEEN :datedebut AND :datefin
                            AND d.afich=1 AND d.idsite=:id
                            AND d.employe_id=:employe_id';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':datedebut', $datedebut);
        $query->BindParam(':datefin', $datefin);
        $query->BindParam(':id', $idsite);
        $query->BindParam(':employe_id', $employe_id);
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // SELECT Info AGENT
    public function SelectInfoAgent($employe_id, $idsite) {

        $requete = 'SELECT a.id, a.matricule, a.noms, b.libelle AS fonction, c.libelle AS dpmt
                        FROM resemployes AS a, resfonction AS b, resdepartement AS c
                        WHERE a.fonction_id=b.id AND a.departement_id=c.id 
                        AND a.id_hotel=:id
                        AND a.id=:employe_id';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id', $idsite);
        $query->BindParam(':employe_id', $employe_id);
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    //Select Count for Pagination
    public function CountPointageRow($idsite) {
        $requete = 'SELECT COUNT(b.employe_id) AS num FROM  resemployes  AS a, respointage AS b
                    WHERE a.id=b.employe_id 
                    AND b.idsite=:id
                    ORDER BY b.dte_in DESC';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id', $idsite);
        try {
            $query->execute();
            $records = $query->fetch(PDO::FETCH_OBJ);
            return $records->num;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

}

// end class
?>
	
