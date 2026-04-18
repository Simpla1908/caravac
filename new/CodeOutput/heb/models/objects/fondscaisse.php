
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        stk_famille_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		stk_famille
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	//include_once(APP_FOLDER.'/models/classes/class_stk_famille.php');
	
	class fondscaisse_model{
	
	// SELECT ALL
	public function SelectAll($bdd,$datedebut,$datefin)
	{
	   if ($_SESSION['type_user'] == 1) {
        $requete = $bdd->prepare("SELECT a.id,a.cdf AS fond_cdf,a.usd AS fond_usd,b.id_user,b.nom_user,b.prenom_user,a.dte,a.hr
        FROM fondscaisse AS a,t_utilisateur AS b
        WHERE a.dte BETWEEN :p_debut AND :p_fin 
        AND a.user_id=b.id_user AND a.hotel_id=:hotel_id AND a.type='hebergement' ORDER BY a.dte,a.hr DESC");
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
        }else{
        $requete = $bdd->prepare("SELECT a.id,a.cdf AS fond_cdf,a.usd AS fond_usd,b.id_user,b.nom_user,b.prenom_user,a.dte,a.hr
        FROM fondscaisse AS a,t_utilisateur AS b
        WHERE a.dte BETWEEN :p_debut AND :p_fin 
        AND a.user_id=b.id_user AND a.hotel_id=:hotel_id  AND b.id_user=:id_user AND a.type='hebergement' ORDER BY a.dte,a.hr DESC");
        $requete->BindParam(':p_debut', $datedebut);
        $requete->BindParam(':p_fin', $datefin);
        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
        $requete->BindParam(':id_user',$_SESSION['id_user']);

        }
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_OBJ); 
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("stk_famille");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("fondscaisse","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("stk_famille","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE stk_famille");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("stk_famille","idfamille=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($user_id,$usd,$cdf,$sousresto_id,$hotel_id,$dte,$hr,$type)
	{
	
	$values = array(array( 'user_id'=>$user_id,'usd'=>$usd,'cdf'=>$cdf,'hotel_id'=>$hotel_id,'dte'=>$dte,'hr'=>$hr,'type'=>$type ));
	HDB::hus()->Hinsert('fondscaisse', $values);
	}
	
	// UPDATE
	public function Update($usd,$cdf,$id)
	{
	$sql = "  usd =:usd,cdf =:cdf WHERE id = :id ";
	$data = array(':usd'=>$usd,':cdf'=>$cdf,':id'=>$id);
	HDB::hus()->Hupdate('fondscaisse',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	