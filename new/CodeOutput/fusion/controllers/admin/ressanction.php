
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        ressanction.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		ressanction
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/ressanction.php');
	include(APP_FOLDER . '/models/objects/resemployes.php');
	include(APP_FOLDER . '/models/objects/ressanctionempl.php');
	include(APP_FOLDER . '/models/objects/compteur.php');

	class ressanction_controller {
	public $ressanction_model;
	
	public function __construct()  
    {  
        $this->ressanction_model = new ressanction_model();
    } 
	
	public function invoke_ressanction()
	{
	$resempl_obj = new resemployes_model();
	$sancemplyobj = new ressanctionempl_model();
	$compteurobj= new compteur_model();

	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	$result = $this->ressanction_model->SelectAll($_SESSION['idsite']);
	include(APP_FOLDER.'/views/admin/ressanction/View.php');
	}
	
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='listsanctemply'){
	$result = $this->ressanction_model->SelectAll1($_SESSION['idsite']);
	include(APP_FOLDER.'/views/admin/ressanction/listsanctemply.php');
	}
	//SELECT ALL DETAILS //////////////////////////////////	
	if(get('do')=='listsanctemplydetail'){
	$employe_id = get('id');
	$result = $this->ressanction_model->SelectAlldetail($employe_id,$_SESSION['idsite']);
	include(APP_FOLDER.'/views/admin/ressanction/listsanctemplydetail.php');
	}
	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->ressanction_model->SelectAll();
	include(APP_FOLDER.'/views/admin/ressanction/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->ressanction_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/ressanction/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->ressanction_model->AutoSearch(trim($qstring),10,'libelle');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=ressanction&id='.$srow->id.'&do=details"><li class="list-group-item">'. $srow->libelle.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/ressanction/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
	$json = array();
	$json['s'] = false;
	$json['message'] = '';
	if($_POST){
	//form validation
	if (post('libelle')==''){
		$json['message'] = json_error2('Le champ désignation ne peut pas être vide!');
	}else if (post('nbrjr')==''){
		$json['message'] = json_error2('Le champ nombre de jours ne peut pas être vide!');
	}else{
		$libelle=post('libelle');
		$pseudo=post('pseudo');
		$nbrjr=post('nbrjr');
		$retenue=post('retenue');
		$contenu=post('contenu');
		$site_id=post('site_id');
	$this->ressanction_model->Insert($libelle,$pseudo,$nbrjr,$retenue,$contenu,$site_id);
	$json['message'] = json_success2("Opération effectuée avec succes");
    $json['s'] = true;
	}
	echo json_encode($json);
	}
	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){$rows = $this->ressanction_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/ressanction/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
		$json = array();
		$json['s'] = false;
		$json['message'] = '';
		if($_POST){
		//form validation
		if (post('libelle')==''){
			$json['message'] = json_error2('Le champ désignation ne peut pas être vide!');
		}else if (post('nbrjr')==''){
			$json['message'] = json_error2('Le champ nombre de jours ne peut pas être vide!');
		}else{
			$id=post('id');
			$libelle=post('libelle');
			$pseudo=post('pseudo');
			$nbrjr=post('nbrjr');
			$retenue=post('retenue');
			$contenu=post('contenu');
			$site_id=post('site_id');
			$this->ressanction_model->Update($libelle,$nbrjr,$retenue,$contenu,$site_id,$id);
		$json['message'] = json_success2("Opération effectuée avec succes");
		$json['s'] = true;
		}
		echo json_encode($json);
	}
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->ressanction_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/ressanction/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->ressanction_model->TruncateTable(''.H_ADMIN.'&view=ressanction&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/ressanction/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('id') and $dfile==''){
	$del = $this->ressanction_model->Delete(get('id'),''.H_ADMIN.'&view=ressanction&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->ressanction_model->Delete(get('id'),''.H_ADMIN.'&view=ressanction&do=viewall&msg=delete');
	}
	elseif(get('id') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=ressanction&id='.get('id').'&do=update&msg=delete');
	}
	}
//Affect Sanction ///////////////////////////////////////////////
		elseif(get('do')=='affect_sanction'){
			$result1 = $resempl_obj->SelectAllComboHr($_SESSION['idsite']);
			$result2 = $this->ressanction_model->SelectAll($_SESSION['idsite']);
			include(APP_FOLDER.'/views/admin/ressanction/affect_sanction.php');
			}
		elseif(get('do')=='affect_sanction_pro'){
	    $_SESSION['sanction'] = array();
        $_SESSION['sanction']['comment'] = array();
		$json = array();
		$json['s'] = false;
		$json['message'] = '';

		if($_POST){
		//form validation
		if (post('employe_id')==0){
			$json['message'] = json_error2('Veuillez sélectionner un employé');
		}else if (post('sanction_id')==0){
			$json['message'] = json_error2('Veuillez sélectionner une sanction');
		}else{
			$site_id=$_SESSION['idsite'];
			$employe_id=post('employe_id');
			$sanction_id=post('sanction_id');
		   //GET REFERENCE
            $librefsanct=NUM_REF_SANCTION;
            $num_cmd = $compteurobj->getnumerotation($site_id,$librefsanct);
            $num_cmd_format = format_numero($num_cmd);  
            $ref=$_SESSION['prefsanct'].$num_cmd_format;
            //MAJ REFERENCE
            $num_cmd+=1;
            $compteurobj->Update($librefsanct, $num_cmd, $site_id);
			$nbrj=post('nbrj')+post('nombjrs');
			$ret=post('ret');
			$doc=post('doc');
			$editor1=post('editor1');
			$dte=date('Y-m-d');
			$dte1=dateToformatBdd(post('dte1'));
        	$dte2=post('dte2');
			$sancemplyobj->preparinsertsanct($employe_id);
		    $idemplsc=$sancemplyobj->Insert($ref,$employe_id,$sanction_id,$dte,$dte1,$dte2,$nbrj,$ret,$editor1,$doc,$site_id);
			$json['message'] = json_success2('Opération effectuée avec succes');
			$json['s'] = true; 
			//donnees json pour l'impression
			$json['noms'] = post('noms');
			$json['sexe'] = post('sexe');
			$json['adresse'] = post('adresse');
			$json['commune'] = post('commune');
			$json['quartier'] = post('quartier');
			$json['rue'] = post('rue');
			$json['ville'] = post('ville');
			$json['dte'] = $dte;
			$json['dte1'] = $dte1;
			$json['dte2'] = $dte2;
			$json['ref'] = $ref;
			$json['comment'] = $editor1;
			$json['sanction'] = post('sanction_lib');
			$json['idemplsc'] = $idemplsc;
			$json['nbrj'] = $nbrj;
			$_SESSION['idemplsc']=$idemplsc;
        	$_SESSION['sanction']['comment'][$idemplsc]=$editor1;
			//fin
		}
		echo json_encode($json);
	}
			}



elseif(get('do') == 'generedatefin') {
            $json = array();
            $json['s'] = false;
            $json['message'] = '';
            $json['dte2'] = '';
            $json['dte2f'] = '';
            if (post('employe_id')==0){
                $json['message'] = json_error2('Le champ employé ne peut pas être vide!');
            }else if (post('sanction_id')==0){
                $json['message'] = json_error2('Le champ sanction ne peut pas être vide!');
            } else {
            $employe_id=post('employe_id');
            $nbrj=post('nbrj')+post('nombjrs');
            $dte1=dateToformatBdd(post('dte1')) ;
            $dte2=DateFutureCg($dte1,$nbrj,$employe_id);
            $json['dte2'] =$dte2;
            $json['dte2f'] =dateAffiche($dte2);
            $json['s'] = true;
            }
           
            echo json_encode($json);
            
        }
 elseif (get('do') == 'contenusanct') {
    $id=get('idsanct');
    echo $_SESSION['SC']['cont'][$id];
}

	}//end invoke
	}//end class
	?>
	