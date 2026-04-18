
<?php

/*
 * =======================================================================
 * CLASSNAME:        resemployes_model
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		resemployes
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

include_once(APP_FOLDER . '/models/classes/class_resemployes.php');

class resemployes_model {

    // SELECT ALL
    public function SelectAll($idsite){
        $requete='SELECT a.*,b.*,c.libelle AS fonction,d.libelle AS departement,
                    e.libelle AS categorie,e.id AS idcat,e.salbase,e.devise,e.montantjr,e.preavis
                    FROM  resemployes  AS a, rescontrat AS b, resfonction AS c,resdepartement AS d,rescategorie AS e
                         WHERE a.id=b.employe_id 
                         AND a.fonction_id=c.id 
                         AND a.departement_id=d.id
                         AND c.categorie_id=e.id
                         AND a.id_hotel=:id
                         ORDER BY a.noms';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id',$idsite);
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    //Select Count for Pagination
    public function CountRow() {
        return HDB::hus()->Hcount("resemployes");
    }

    // SELECT ONE
    public function SelectOne($id){
        $requete='SELECT a.*,b.*,c.libelle AS fonction,d.libelle AS departement,e.libelle AS categorie,e.preavis
                    FROM  resemployes  AS a, rescontrat AS b, resfonction AS c,resdepartement AS d,rescategorie AS e
                         WHERE a.id=b.employe_id 
                         AND a.fonction_id=c.id 
                         AND a.departement_id=d.id
                         AND c.categorie_id=e.id
                         AND a.id=:id';
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
        return HDB::hus()->Hselect("resemployes", "$where LIKE :svalue LIMIT $limit", $bind);
    }

    // TRUNCATE TABLE
    public function TruncateTable($redirect_to) {
        $sql = HDB::hus()->prepare("TRUNCATE resemployes");
        $sql->execute();
        send_to($redirect_to);
    }

    // DELETE
    public function Delete($id, $redirect_to) {
        $bind = array(":id" => $id);
        HDB::hus()->Hdelete("resemployes", "id=:id", $bind);
        send_to($redirect_to);
    }

    // INSERT
    public function Insert($matricule, $noms, $sexe, $etatcivil, $nationalite, $lieunais, $datenais, $Adresse, $rue, $quartier, $commune, $ville, $piece, $numpiece, $tel1, $tel2, $email, $nbrenf, $actif, $pseudo_supp, $fonction_id, $departement_id, $id_hotel,$inss,$fingerprint) {
        $values = array(array('matricule' => $matricule, 'noms' => $noms, 'sexe' => $sexe, 'etatcivil' => $etatcivil, 'nationalite' => $nationalite, 'lieunais' => $lieunais, 'datenais' => $datenais, 'Adresse' => $Adresse, 'rue' => $rue, 'quartier' => $quartier, 'commune' => $commune, 'ville' => $ville, 'piece' => $piece, 'numpiece' => $numpiece, 'tel1' => $tel1, 'tel2' => $tel2, 'email' => $email, 'nbrenf' => $nbrenf, 'actif' => $actif, 'pseudo_supp' => $pseudo_supp, 'fonction_id' => $fonction_id, 'departement_id' => $departement_id, 'id_hotel' => $id_hotel, 'inss' => $inss,'fingerprint'=>$fingerprint));
        HDB::hus()->Hinsert('resemployes', $values);
       return HDB::hus()->lastInsertId();
    }
    public function InsertImage($matricule, $noms, $sexe, $etatcivil, $nationalite, $lieunais, $datenais, $Adresse, $rue, $quartier, $commune, $ville, $piece, $numpiece, $tel1, $tel2, $email, $nbrenf, $actif, $pseudo_supp, $fonction_id, $departement_id, $id_hotel,$inss,$fingerprint) {
        $newupload = new UploadControl;
        $uploadname = $newupload->ImageUplaodResize('image', THUMB_IMAGE_WIDTH, BIG_IMAGE_WIDTH, UPLOAD_PATH, THUMB_PATH, 90);
        $values = array(array('image' => $uploadname, 'matricule' => $matricule, 'noms' => $noms, 'sexe' => $sexe, 'etatcivil' => $etatcivil, 'nationalite' => $nationalite, 'lieunais' => $lieunais, 'datenais' => $datenais, 'Adresse' => $Adresse, 'rue' => $rue, 'quartier' => $quartier, 'commune' => $commune, 'ville' => $ville, 'piece' => $piece, 'numpiece' => $numpiece, 'tel1' => $tel1, 'tel2' => $tel2, 'email' => $email, 'nbrenf' => $nbrenf, 'actif' => $actif, 'pseudo_supp' => $pseudo_supp, 'fonction_id' => $fonction_id, 'departement_id' => $departement_id, 'id_hotel' => $id_hotel, 'inss' => $inss,'fingerprint'=>$fingerprint));
        HDB::hus()->Hinsert('resemployes', $values);
        return HDB::hus()->lastInsertId();
    }
    // UPDATE
      public function Update($matricule, $noms, $sexe, $etatcivil, $nationalite, $lieunais, $datenais, $Adresse, $rue, $quartier, $commune, $ville, $piece, $numpiece, $tel1, $tel2, $email, $nbrenf, $actif, $pseudo_supp, $fonction_id, $departement_id, $id_hotel, $id,$inss,$fingerprint) {
        $sql = "  matricule =:matricule,noms =:noms,sexe =:sexe,etatcivil =:etatcivil,nationalite =:nationalite,lieunais =:lieunais,datenais =:datenais,Adresse =:Adresse,rue =:rue,quartier =:quartier,commune =:commune,ville =:ville,piece =:piece,numpiece =:numpiece,tel1 =:tel1,tel2 =:tel2,email =:email,nbrenf =:nbrenf,actif =:actif,pseudo_supp =:pseudo_supp,fonction_id =:fonction_id,departement_id =:departement_id,id_hotel =:id_hotel,inss=:inss,fingerprint=:fingerprint WHERE id = :id ";
        $data = array(':matricule' => $matricule, ':noms' => $noms, ':sexe' => $sexe, ':etatcivil' => $etatcivil, ':nationalite' => $nationalite, ':lieunais' => $lieunais, ':datenais' => $datenais, ':Adresse' => $Adresse, ':rue' => $rue, ':quartier' => $quartier, ':commune' => $commune, ':ville' => $ville, ':piece' => $piece, ':numpiece' => $numpiece, ':tel1' => $tel1, ':tel2' => $tel2, ':email' => $email, ':nbrenf' => $nbrenf, ':actif' => $actif, ':pseudo_supp' => $pseudo_supp, ':fonction_id' => $fonction_id, ':departement_id' => $departement_id, ':id_hotel' => $id_hotel, ':id' => $id,':inss' => $inss,':fingerprint' => $fingerprint);
        HDB::hus()->Hupdate('resemployes', $sql, $data);
    }
    public function UpdateImage($matricule, $noms, $sexe, $etatcivil, $nationalite, $lieunais, $datenais, $Adresse, $rue, $quartier, $commune, $ville, $piece, $numpiece, $tel1, $tel2, $email, $nbrenf, $actif, $pseudo_supp, $fonction_id, $departement_id, $id_hotel, $id,$inss,$fingerprint) {
        $newupload = new UploadControl;
        $uploadname = $newupload->ImageUplaodResize('image', THUMB_IMAGE_WIDTH, BIG_IMAGE_WIDTH, UPLOAD_PATH, THUMB_PATH, 90);
        $sql = "  image=:image,matricule =:matricule,noms =:noms,sexe =:sexe,etatcivil =:etatcivil,nationalite =:nationalite,lieunais =:lieunais,datenais =:datenais,Adresse =:Adresse,rue =:rue,quartier =:quartier,commune =:commune,ville =:ville,piece =:piece,numpiece =:numpiece,tel1 =:tel1,tel2 =:tel2,email =:email,nbrenf =:nbrenf,actif =:actif,pseudo_supp =:pseudo_supp,fonction_id =:fonction_id,departement_id =:departement_id,id_hotel =:id_hotel,inss=:inss,fingerprint=:fingerprint WHERE id = :id ";
        $data = array(':image' => $uploadname, ':matricule' => $matricule, ':noms' => $noms, ':sexe' => $sexe, ':etatcivil' => $etatcivil, ':nationalite' => $nationalite, ':lieunais' => $lieunais, ':datenais' => $datenais, ':Adresse' => $Adresse, ':rue' => $rue, ':quartier' => $quartier, ':commune' => $commune, ':ville' => $ville, ':piece' => $piece, ':numpiece' => $numpiece, ':tel1' => $tel1, ':tel2' => $tel2, ':email' => $email, ':nbrenf' => $nbrenf, ':actif' => $actif, ':pseudo_supp' => $pseudo_supp, ':fonction_id' => $fonction_id, ':departement_id' => $departement_id, ':id_hotel' => $id_hotel, ':id' => $id,':inss' => $inss,':fingerprint' => $fingerprint);
        HDB::hus()->Hupdate('resemployes', $sql, $data);
    }
      //COMBO
    public function SelectAllCombo($idsite) {
        $requete='SELECT * FROM resemployes WHERE id_hotel=:id ORDER BY noms ASC';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id', $idsite);
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    //combo employe horaire
    public function SelectAllComboHr($idsite) {
        $requete='SELECT DISTINCT a.* FROM resemployes AS a,resemployehoraire AS b
               WHERE  a.id=b.employe_id AND id_hotel=:id ORDER BY noms ASC';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id', $idsite);
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    //combo employe horaire congé
    public function SelectAllComboHrCg($idsite) {
        $requete='SELECT DISTINCT a.*,c.* FROM resemployes AS a,resemployehoraire AS b,rescontrat AS c
               WHERE  a.id=b.employe_id AND a.id=c.employe_id AND id_hotel=:id ORDER BY noms ASC';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id', $idsite);
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    //combo employe horaire depart
    public function SelectAllComboHrDprt($idsite) {
        $requete='SELECT a.id,a.noms,b.dte_in,b.horaire_id FROM resemployes AS a,restmp_pointage AS b
               WHERE  a.id=b.employe_id AND id_hotel=:id ORDER BY noms ASC';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id', $idsite);
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    //MODIFIE L'HORAIRE AFFECTE A UN EMPLOYE
    public function UpdateHoraire($employe_id,$horaire_ids,$priorites,$seqs,$nbrjrstrav,$affectationhoraireobj){
       $bdd = HDB::hus();
       $requete = "DELETE FROM resemployehoraire WHERE employe_id=:employe_id";
        $query = $bdd->prepare($requete);
        $query->BindParam(':employe_id',$employe_id);
        $query->execute();
       $nbrhoraire=COUNT($horaire_ids);
       if($nbrhoraire>0){
            for ($j =0; $j <=$nbrhoraire-1; $j++){
                $default =$priorites[$j];
                $seq=$seqs[$j];
                $seqjrsmaj=$seq;
                $horaire_id=$horaire_ids[$j];
                $nbrjrs =$nbrjrstrav[$j];
                $nbrjrsmaj=$nbrjrs;
                $affectationhoraireobj->Insert($employe_id,$horaire_id,$default,$nbrjrs,$nbrjrsmaj, $seq, $seqjrsmaj,$_SESSION['idsite']);
            } 
        }
    }
    public function GetHoraire($employe_id){
       $bdd = HDB::hus();
       $_SESSION['res4'] = array();
       $_SESSION['res4']['horaire_id'] = array();
       $_SESSION['res4']['sequence'] = array();
       $_SESSION['res4']['priorite'] = array();
       $requete='SELECT * FROM resemployehoraire
                    WHERE employe_id=:id';
        $query =$bdd->prepare($requete);
        $query->BindParam(':id',$employe_id);
        try {
            $query->execute();
            $result=$query->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $res2) {
                array_push($_SESSION['res4']['horaire_id'], $res2->horaire_id);
                $_SESSION['res4']['sequence'][$res2->horaire_id] =$res2->seq;
                $_SESSION['res4']['priorite'][$res2->horaire_id] =$res2->defaul;
            }
        } catch (PDOException $e){
            die($e->getMessage());
        }
       
    }
    // Renvoie conjoint et enfant de l'employé
    public function GetFamille($employe_id){
       $bdd = HDB::hus();
       $_SESSION['res6'] = array();
       $_SESSION['nomconj']='';
       $_SESSION['res6']['nom'] = array();
       $_SESSION['res6']['type'] = array();
       $_SESSION['res6']['datenais'] = array();
       $requete='SELECT * FROM resemployefamille
                    WHERE employe_id=:id';
        $query =$bdd->prepare($requete);
        $query->BindParam(':id',$employe_id);
        try {
            $query->execute();
            $result=$query->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $res2){
                if($res2->type=='enfant'){
                    array_push($_SESSION['res6']['nom'], $res2->nom);
                    array_push($_SESSION['res6']['type'], $res2->type);
                    array_push($_SESSION['res6']['datenais'],dateAffiche($res2->datenais));
                }elseif($res2->type=='conjoint'){
                    $_SESSION['nomconj']=$res2->nom;
                }
            }
        } catch (PDOException $e){
            die($e->getMessage());
        }
       
    }
    public function UpdateFamille($employe_id,$nomconj,$nbrenf,$enfnoms,$enfdatenais,$employefamilleobj){
       $bdd = HDB::hus();
            $requete = "DELETE FROM resemployefamille WHERE employe_id=:employe_id";
            $query = $bdd->prepare($requete);
            $query->BindParam(':employe_id',$employe_id);
            $query->execute();
            for ($i = 0; $i <= $nbrenf - 1; $i++) {
                //$dtenais=dateToformatBdd($enfdatenais[$i]);
                $dtenais=format_stringdateTodatetime('d/m/Y',$enfdatenais[$i],'Y-m-d');
                $employefamilleobj->Insert($enfnoms[$i],$dtenais,'enfant',$employe_id);
            }
            if ($nomconj!= ''){
                $datenais = '0000-00-00';
                $type = 'conjoint';
                $employefamilleobj->Insert($nomconj,$datenais,$type,$employe_id);
            }
        
    }
     public function GetPeriodePayees($employe_id){
       $bdd = HDB::hus();
       $data = array();
       $data['mois']=array();
       $data['mois2']=array();
       $requete='SELECT * FROM ressalaire
                    WHERE employe_id=:id';
        $query =$bdd->prepare($requete);
        $query->BindParam(':id',$employe_id);
        try {
            $query->execute();
            $result=$query->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $res2){
                array_push( $data['mois'],$res2->libelle);
                array_push( $data['mois2'],$res2->libelle2);
            }
            return $data;
        } catch (PDOException $e){
            die($e->getMessage());
        }
    }
 
    public function GetJourPreste($employe_id,$num_mois,$annee){
     //Jours prestés excepté samedi & dimanche     
       $bdd = HDB::hus();
       $nbjr=0;
       $data = array();
       $data['presence']=0;
       $data['jrtransport']=0;
       $data['conge']=0;
       $data['hrsuppl']=0;
       $requete="SELECT *
                FROM respointage AS p
                WHERE p.employe_id=:id 
                AND MONTH(p.dte_in)=:num_mois 
                AND DAYOFWEEK (p.dte_in) NOT IN(1,7)
                AND YEAR(p.dte_in)=:annee
                AND p.afich=1";
        $query =$bdd->prepare($requete);
        $query->BindParam(':id',$employe_id);
        $query->BindParam(':num_mois',$num_mois);
        $query->BindParam(':annee',$annee);
        try {
            $query->execute();
            $result=$query->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $rows){
                if($rows->presence==1){
                    $hdebsec= TimeToSec($rows->hr_ind);
                    $hfinsec= TimeToSec($rows->hr_outf);
                    $diff=$hfinsec-$hdebsec;
                    $nbjr=floor($diff/28800);
                    if($rows->conge==1 && $rows->transport==1){
                         $data['jrtransport']+=$nbjr;
                         $data['conge']+=$nbjr;
                    }elseif ($rows->conge==1 && $rows->transport==0){
                        $data['jrtransport']+=0;
                        $data['conge']+=$nbjr;
                    }else{
                        $data['jrtransport']+=$nbjr;
                    }
                    $data['presence']+=$nbjr;
                }
                
            }
            $data['hrsuppl']= $this->GetHrsupp($employe_id, $num_mois, $annee, $bdd);
            return $data;
        } catch (PDOException $e){
            die($e->getMessage());
        }
    }
     public function GetHrsupp($employe_id,$num_mois,$annee,$bdd){
     //heure supplementaire excepté samedi & dimanche     
       $data =0;
       $requete="SELECT hrs_suplmtr AS hrsuppl 
                FROM respointage AS p
                WHERE p.employe_id=:id 
                AND MONTH(p.dte_in)=:num_mois 
                AND DAYOFWEEK (p.dte_in) NOT IN(1,7)
                AND YEAR(p.dte_in)=:annee
                AND p.afich=1";
        $query =$bdd->prepare($requete);
        $query->BindParam(':id',$employe_id);
        $query->BindParam(':num_mois',$num_mois);
        $query->BindParam(':annee',$annee);
        try {
            $query->execute();
            $result=$query->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $rows) {
                $data = $data+seconds_to_time2($rows->hrsuppl); 
            }
            return $data;
        } catch (PDOException $e){
            die($e->getMessage());
        }
    }
    public function GetRubriqueByCat($idcat){
       $bdd = HDB::hus();
       $requete="SELECT *,a.id AS rubrique_id FROM resrubrique AS a,resrubriquecateg AS b
                    WHERE a.id=b.rubrique_id
                    AND b.categorie_id=:id ORDER BY a.sequence,a.libelle";
        $query =$bdd->prepare($requete);
        $query->BindParam(':id',$idcat);
        try {
            $query->execute();
            $result=$query->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (PDOException $e){
            die($e->getMessage());
        }
    }
    public function GetEmprunt($employe_id,$periode){
       $bdd = HDB::hus();
       $data = array();
       $data['emprunt_id']=array();
       $data['rubrique_id']=array();
       $data['libelle']=array();
       $data['type']=array();
       $data['duree']=array();
       $data['mont_emprunt']=array();
       $data['mont_deduit']=array();
       $data['mont_remb']=array();
       $data['monnaie']=array();
       $data['nbre']=array();
       $requete="SELECT d.id,d.libelle,d.type,b.id AS emprunt_id,b.dte_deduct,b.duree,b.montant AS mont_emprunt,b.monnaie AS mon_emprunt,
                    b.montant2 AS mont_deduit,SUM(c.montant) AS mont_remb,c.monnaie,c.taux,COUNT(c.id) AS nbre,a.id AS employe_id
                  FROM  resemployes AS a,resemprunt AS b,resremboursement AS c,resrubrique AS d
                    WHERE a.id=b.employe_id 
                    AND b.id=c.emprunt_id
                    AND b.libelle=d.id
                    AND a.id=:employe_id AND b.dte_deduct=:periode
                    GROUP BY emprunt_id";
        $query =$bdd->prepare($requete);
        $query->BindParam(':employe_id',$employe_id);
        $query->BindParam(':periode',$periode);
        try {
            $query->execute();
            $result=$query->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $res2){
                array_push( $data['emprunt_id'],$res2->emprunt_id);
                array_push( $data['rubrique_id'],$res2->id);
                array_push( $data['libelle'],$res2->libelle);
                array_push( $data['type'],$res2->type);
                array_push( $data['duree'],$res2->duree);
                array_push( $data['mont_emprunt'],$res2->mont_emprunt);
                array_push( $data['mont_deduit'],$res2->mont_deduit);
                array_push( $data['mont_remb'],$res2->mont_remb);
                array_push( $data['nbre'],$res2->nbre);
                array_push( $data['monnaie'],$res2->mon_emprunt);
            }
            return $data;
        } catch (PDOException $e){
            die($e->getMessage());
        }
    }
    // GET NOMBRE BULLETIN EMPLOYE
    public function GetNbrBulletin($idsite){
        $requete='SELECT a.id,a.noms,a.matricule,COUNT(b.employe_id) AS nbreblt 
                     FROM resemployes AS a,ressalaire AS b 
                    WHERE a.id=b.employe_id AND b.decompte=0 AND a.id_hotel=:idsite
                    GROUP BY a.id';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':idsite',$idsite);
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
     // RETOURNE TOUS LES BULLETINS D'UN EMPLOYE
    public function GetAllBltById($id){
        $requete='SELECT a.*,b.*,c.libelle AS fonction,d.libelle AS departement,f.*,
                    e.libelle AS categorie,e.id AS idcat,e.salbase,e.devise
                    FROM  resemployes  AS a, rescontrat AS b, resfonction AS c,resdepartement AS d,rescategorie AS e,ressalaire AS f
                         WHERE a.id=b.employe_id 
                         AND a.fonction_id=c.id 
                         AND a.departement_id=d.id
                         AND c.categorie_id=e.id
                         AND a.id=f.employe_id 
                          AND f.decompte=0 
                         AND a.id=:id
                    ORDER BY f.id DESC';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id',$id);
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    // RETOURNE NBRE JOUR CONGE NON PRIS
    public function CongeNonPris($employe_id,$anciennete,$preavis){
        $type=1;
        $requete='SELECT COUNT(b.conge_id) AS nbrcongepris,c.nbrjr
	FROM resemployes AS a,resempconge AS b,resconge AS c
	WHERE a.id=b.employe_id AND b.conge_id=c.id AND
         c.type=:type AND b.employe_id=:employe_id';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':type',$type);
        $query->BindParam(':employe_id',$employe_id);
        try {
            $query->execute();
            $result= $query->fetch(PDO::FETCH_OBJ);
            $nbrcongepris=$result->nbrcongepris;
            $n=$preavis;
            if($result->nbrjr!=''){
              $n=$result->nbrjr;  
            }
            $bonnus=floor($anciennete/5);
            $jrcongannuel=$n+$bonnus;
            $an_non_pris=$anciennete-$nbrcongepris;
            if($an_non_pris<0){
               $an_non_pris=0; 
            }
            return $an_non_pris*$jrcongannuel;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function GetEmpruntAll($employe_id,$periode){
       $bdd = HDB::hus();
       $data = array();
       $data['emprunt_id']=array();
       $data['rubrique_id']=array();
       $data['libelle']=array();
       $data['type']=array();
       $data['duree']=array();
       $data['mont_emprunt']=array();
       $data['mont_deduit']=array();
       $data['mont_remb']=array();
       $data['monnaie']=array();
       $data['nbre']=array();
       
       $req0="SELECT b.id AS rubrique_id,b.libelle AS rubrique 
                 FROM  resemprunt AS a,resrubrique AS b
                WHERE a.libelle=b.id AND a.employe_id =:employe_id
                GROUP BY b.id";
       $query0=$bdd->prepare($req0);
       $query0->BindParam(':employe_id',$employe_id);
       $req1="SELECT a.*,b.id AS rubrique_id,b.libelle AS rubrique 
           FROM  resemprunt AS a,resrubrique AS b
                WHERE a.libelle=b.id AND a.employe_id =:employe_id";
        $query1 =$bdd->prepare($req1);
        $query1->BindParam(':employe_id',$employe_id);
        try {
             $query0->execute();
            $query1->execute();
            $result0=$query0->fetchAll(PDO::FETCH_OBJ);
            $result1=$query1->fetchAll(PDO::FETCH_OBJ);
            foreach ($result1 as $res2){
                array_push( $data['emprunt_id'],$res2->emprunt_id);
                array_push( $data['rubrique_id'],$res2->id);
                array_push( $data['libelle'],$res2->libelle);
                array_push( $data['type'],$res2->type);
                array_push( $data['duree'],$res2->duree);
                array_push( $data['mont_emprunt'],$res2->mont_emprunt);
                array_push( $data['mont_deduit'],$res2->mont_deduit);
                array_push( $data['mont_remb'],$res2->mont_remb);
                array_push( $data['nbre'],$res2->nbre);
                array_push( $data['monnaie'],$res2->mon_emprunt);
            } 
            return $data;
        } catch (PDOException $e){
            die($e->getMessage());
        }
    }
    
     public function GeArriereSalaire($employe_id){
       $bdd = HDB::hus();
       $data = array();
       $data['emprunt_id']=array();
       $data['rubrique_id']=array();
       $data['libelle']=array();
       $data['type']=array();
       $data['duree']=array();
       $data['mont_emprunt']=array();
       $data['mont_deduit']=array();
       $data['mont_remb']=array();
       $data['monnaie']=array();
       $data['nbre']=array();
       
       $req0="SELECT b.id AS rubrique_id,b.libelle AS rubrique 
                 FROM  resemprunt AS a,resrubrique AS b
                WHERE a.libelle=b.id AND a.employe_id =:employe_id
                GROUP BY b.id";
       $query0=$bdd->prepare($req0);
       $query0->BindParam(':employe_id',$employe_id);
       $req1="SELECT a.*,b.id AS rubrique_id,b.libelle AS rubrique 
           FROM  resemprunt AS a,resrubrique AS b
                WHERE a.libelle=b.id AND a.employe_id =:employe_id";
        $query1 =$bdd->prepare($req1);
        $query1->BindParam(':employe_id',$employe_id);
        try {
             $query0->execute();
            $query1->execute();
            $result0=$query0->fetchAll(PDO::FETCH_OBJ);
            $result1=$query1->fetchAll(PDO::FETCH_OBJ);
            foreach ($result1 as $res2){
                array_push( $data['emprunt_id'],$res2->emprunt_id);
                array_push( $data['rubrique_id'],$res2->id);
                array_push( $data['libelle'],$res2->libelle);
                array_push( $data['type'],$res2->type);
                array_push( $data['duree'],$res2->duree);
                array_push( $data['mont_emprunt'],$res2->mont_emprunt);
                array_push( $data['mont_deduit'],$res2->mont_deduit);
                array_push( $data['mont_remb'],$res2->mont_remb);
                array_push( $data['nbre'],$res2->nbre);
                array_push( $data['monnaie'],$res2->mon_emprunt);
            } 
            return $data;
        } catch (PDOException $e){
            die($e->getMessage());
        }
    }
    public function GetEmpResilies($idsite){
        $requete='SELECT a.*,b.*,c.libelle AS fonction,d.libelle AS departement,f.*,
                    e.libelle AS categorie,e.id AS idcat,e.salbase,e.devise
                    FROM  resemployes  AS a, rescontrat AS b, resfonction AS c,resdepartement AS d,rescategorie AS e,ressalaire AS f
                         WHERE a.id=b.employe_id 
                         AND a.fonction_id=c.id 
                         AND a.departement_id=d.id
                         AND c.categorie_id=e.id
                         AND a.id=f.employe_id
                         AND a.id_hotel=:id
                          AND f.decompte=1
                    ORDER BY a.noms';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id',$idsite);
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    // DESACTIVATION EMPLOYE
    public function setDesactif($id) {
        $actif=0; 
        $sql = "actif =:actif WHERE id = :id ";
        $data = array(':actif' => $actif, ':id' => $id);
        HDB::hus()->Hupdate('resemployes', $sql, $data);
    }
    //ACTIVATION EMPLOYE
    public function setActif($id) {
        $actif=1; 
        $sql = "actif =:actif WHERE id = :id ";
        $data = array(':actif' => $actif, ':id' => $id);
        HDB::hus()->Hupdate('resemployes', $sql, $data);
    }
}

// end class
?>
	
