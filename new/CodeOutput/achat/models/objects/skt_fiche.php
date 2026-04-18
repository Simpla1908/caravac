
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        skt_fiche_model
	* DATE CREATED:  	29-11-2018
	* FOR TABLE:  		skt_fiche
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_skt_fiche.php');
	
	class skt_fiche_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("skt_fiche LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("skt_fiche");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("skt_fiche");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("skt_fiche","id_fiche=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("skt_fiche","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE skt_fiche");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("skt_fiche","id_fiche=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($numero,$type,$motif,$beneficiere,$nbrprod,$dte,$dte_time,$approuve,$depot_id,$user_id,$hotel_id)
	{
            $values = array(array( 'numero'=>$numero,'type'=>$type,'motif'=>$motif,'beneficiere'=>$beneficiere,'nbrprod'=>$nbrprod,'dte'=>$dte,'dte_time'=>$dte_time,'approuve'=>$approuve,'depot_id'=>$depot_id,'user_id'=>$user_id,'hotel_id'=>$hotel_id ));
            HDB::hus()->Hinsert('skt_fiche', $values);
            return HDB::hus()->lastInsertId();
	}
	
	// UPDATE
	public function Update($numero,$type,$motif,$beneficiere,$nbrprod,$dte,$dte_time,$approuve,$depot_id,$user_id,$hotel_id,$id)
	{
	$sql = "  numero =:numero,type =:type,motif =:motif,beneficiere =:beneficiere,nbrprod =:nbrprod,dte =:dte,dte_time =:dte_time,approuve =:approuve,depot_id =:depot_id,user_id =:user_id,hotel_id =:hotel_id WHERE id_fiche = :id ";
	$data = array(':numero'=>$numero,':type'=>$type,':motif'=>$motif,':beneficiere'=>$beneficiere,':nbrprod'=>$nbrprod,':dte'=>$dte,':dte_time'=>$dte_time,':approuve'=>$approuve,':depot_id'=>$depot_id,':user_id'=>$user_id,':hotel_id'=>$hotel_id,':id'=>$id);
	HDB::hus()->Hupdate('skt_fiche',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	