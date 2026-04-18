
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        cptcomptes_model
	* DATE CREATED:  	18-04-2019
	* FOR TABLE:  		cptcomptes
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_cptcomptes.php');
	
	class cptcomptes_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("cptcomptes LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("cptcomptes");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("cptcomptes");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("cptcomptes","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("cptcomptes","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE cptcomptes");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
//	$bind = array(":id" =>$id);
//	HDB::hus()->Hdelete("cptcomptes","id=:id",$bind);
        $psedo=1;
        $sql = "psedo =:psedo  WHERE id = :id ";
	$data = array(':psedo'=>$psedo,':id'=>$id);
	HDB::hus()->Hupdate('cptcomptes',$sql,$data);
	send_to($redirect_to);
	}
	
	// INSERT
	public function InsertSousCompte($libelle,$numero,$compte_id,$snumero,$bdd)
	{
            $modif = 1;
            $psedo=0;
            $site_id=$_SESSION['idsite'];
            $values = array(array('libelle'=>$libelle, 'numero' => $numero, 'psedo' => $psedo, 'modif' => $modif, 'compte_id' => $compte_id,'site_id' =>$site_id,'suffixe' =>$snumero));
            $bdd->Hinsert('cptsouscomptes', $values);
            $idcompte = $bdd->lastInsertId();
            $query = $bdd->prepare("INSERT cptcomptesites (compte_id,site_id)
                                             VALUES(:compte_id,:site_id)");
            $query->BindParam(':compte_id',$idcompte);
            $query->BindParam(':site_id',$site_id);
            $query->execute();
      }

      public function UpdateSousCompte($sous_compte_id,$libelle,$numero,$compte_id,$snumero,$bdd)
	{
            $requete = $bdd->prepare("UPDATE cptsouscomptes SET libelle =:libelle,numero =:numero,compte_id =:compte_id,suffixe=:suffixe WHERE id=:id");
		    $requete->BindParam(':libelle', $libelle);
		    $requete->BindParam(':numero',$numero);
		    $requete->BindParam(':compte_id',$compte_id);
		    $requete->BindParam(':suffixe',$snumero);
		    $requete->BindParam(':id',$sous_compte_id);
		    $requete->execute();
     }
       public function DeleteSousCompte($souscompteid,$bdd)
	{
            $requete = $bdd->prepare("UPDATE cptsouscomptes SET psedo=1 WHERE id=:id");
		    $requete->BindParam(':id', $souscompteid);
		    $requete->execute();
     }
   public function Insert($libelle,$numero,$statut,$categorie_id,$bdd)
	{
            $psedo =0;
            $values = array(array('libelle'=>$libelle,'numero' => $numero, 'statut' =>$statut,'categorie_id' =>$categorie_id,'psedo' => $psedo));
            $bdd->Hinsert('cptcomptes', $values);
//            $idcompte = $bdd->lastInsertId();
//            $query = $bdd->prepare("INSERT cptcomptesites (compte_id,site_id)
//                                             VALUES(:compte_id,:site_id)");
//            $query->BindParam(':compte_id',$idcompte);
//            $query->BindParam(':site_id',$_SESSION['idsite']);
//            $query->execute();
        }
	// INSERT
	public function VerifNumero($numero,$bdd)
	{
            $bool=FALSE;
            $requete = $bdd->prepare("SELECT *
                                    FROM  cptsouscomptes AS a,cptcomptesites AS b
                                    WHERE  a.id=b.compte_id AND a.psedo=0
                                    AND a.numero=:numero AND b.site_id=:site_id"); 
            $requete->BindParam(':numero',$numero);
            $requete->BindParam(':site_id', $_SESSION['id_hotel']);
            $requete->execute();
            $result= $requete->fetchAll(PDO::FETCH_OBJ); 
            foreach ($result as $r){
                $bool=TRUE;
            }
            return $bool;
        }
        public function VerifNumero2($numero,$oldnumero,$bdd)
	{
            $bool=FALSE;
            if ($numero==$oldnumero) {
            $bool=FALSE;
            } else {
			$requete = $bdd->prepare("SELECT *
                                    FROM  cptsouscomptes AS a,cptcomptesites AS b
                                    WHERE  a.id=b.compte_id AND a.psedo=0
                                    AND a.numero=:numero AND b.site_id=:site_id"); 
            $requete->BindParam(':numero',$numero);
            $requete->BindParam(':site_id', $_SESSION['id_hotel']);
            $requete->execute();
            $result= $requete->fetchAll(PDO::FETCH_OBJ); 
            foreach ($result as $r){
                $bool=TRUE;
            }            
         }        
            return $bool;
        }
	// UPDATE
	public function Update($libelle,$numero,$niveau,$psedo,$classe_id,$id)
	{
	$sql = "  libelle =:libelle,numero =:numero,niveau =:niveau,psedo =:psedo,classe_id =:classe_id WHERE id = :id ";
	$data = array(':libelle'=>$libelle,':numero'=>$numero,':niveau'=>$niveau,':psedo'=>$psedo,':classe_id'=>$classe_id,':id'=>$id);
	HDB::hus()->Hupdate('cptcomptes',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	