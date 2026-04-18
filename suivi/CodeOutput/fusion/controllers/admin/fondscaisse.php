
	<?php
	
	/*
	* =======================================================================
	* FILE NAME:        stk_famille.php
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		stk_famille
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include(APP_FOLDER.'/models/objects/fondscaisse.php');
	
	class fondscaisse_controller {
	public $stk_famille_model;
	
	public function __construct()  
    {  
        $this->fondscaisse_model = new fondscaisse_model();
    } 
	
	public function invoke_fondscaisse()
	{
	
	//SELECT ALL //////////////////////////////////	
	if(get('do')=='viewall'){
	$bdd=HDB::hus();
	$result=array();
    $datedebut =date('Y-m-d');
    $datefin=date('Y-m-d');
	$result = $this->fondscaisse_model->SelectAll($bdd,$datedebut,$datefin);	
	include(APP_FOLDER.'/views/admin/fondscaisse/View.php');
	}
	
	if(get('do')=='filtrerfdc'){
	$bdd=HDB::hus();
	$result=array();
     /* Conversion date1 */
    $transpostion_date1 = explode('/',post('dte1'));
    $jour = $transpostion_date1[0];
    $mois = $transpostion_date1[1];
    $annee = $transpostion_date1[2];
    $datedebut = $annee . '-' . $mois . '-' . $jour;
    /* Conversion date2 */
    $transpostion_date2 = explode('/',post('dte2'));
    $jour2 = $transpostion_date2[0];
    $mois2 = $transpostion_date2[1];
    $annee2 = $transpostion_date2[2];
    $datefin = $annee2 . '-' . $mois2 . '-' . $jour2;
	$result = $this->fondscaisse_model->SelectAll($bdd,$datedebut,$datefin);	
	include(APP_FOLDER.'/views/admin/fondscaisse/contentdatafiltered.php');
	}

	//EXPORT ////////////////////////////////////////////////////	
	if(get('do')=='export'){
	$result = $this->stk_famille_model->SelectAll();
	include(APP_FOLDER.'/views/admin/stk_famille/Export.php');
	}
	
	//Expeort2
	elseif(get('do')=='export2'){
	$rows = $this->stk_famille_model->SelectOne(get('idfamille'));
	include(APP_FOLDER.'/views/admin/stk_famille/Export2.php');
	}
	//SEARCH SUGGEST ////////////////////////////////////////////////////	
	elseif(get('do')=='autosearch'){
	$qstring = post('qstring');
	if(strlen($qstring) >0) {
	$autosearch = $this->stk_famille_model->AutoSearch(trim($qstring),10,'designation');
	echo' <div class=widget><ul class="list-group">';
	foreach ($autosearch as $srow) {
	echo '<span class="searchheading"><a href="'.H_ADMIN.'&view=stk_famille&idfamille='.$srow->idfamille.'&do=details"><li class="list-group-item">'. $srow->designation.'</li></a>
	</span>';
	}
	echo '</ul></div>';
	}
	}
	
	
	//ADD //////////////////////////////////////////////////
	elseif(get('do')=='add'){
	include(APP_FOLDER.'/views/admin/stk_famille/Add.php');
	}
	
	//ADD PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='addpro'){
        $json = array();
        $json['s'] = false;
        $json['message'] = '';
        $montantusd=post('montantusd');
        $montantcdf=post('montantcdf');
        $user_id = $_SESSION['id_user'];
		$id_hotel = $_SESSION['id_hotel'];
		$sousresto_id =Null;
		$dte = date('Y-m-d');
		$hr = date('H:i:s');
		$type = 'hebergement';
			if ($montantusd <0 || $montantcdf <0 ) {
 					$json['message'] = json_success2("Les fonds de caisse ne doivent pas etre negatifs.");
			}elseif ($montantusd==''&&$montantcdf=='') {
 					$json['message'] = json_success2("Les fonds de caisse ne doivent pas etre tous nuls.");
			} else {
			    if ($montantusd == '') {
			        $montantusd = 0;
			    }
			    if ($montantcdf == '') {
			        $montantcdf = 0;
			    }
					$this->fondscaisse_model->Insert($user_id,$montantusd,$montantcdf,$sousresto_id,$id_hotel,$dte,$hr,$type);
 					$json['message'] = json_success2("Fonds de caisse inserés avec succes");
        			$json['s'] = true;			  

			}
	 echo json_encode($json);

	}
	
	//UPDATE //////////////////////////////////////////////////
	elseif(get('do')=='update'){

	$rows = $this->fondscaisse_model->SelectOne(get('id'));
	include(APP_FOLDER.'/views/admin/fondscaisse/Update.php');
	}
	
	//UPDATE PROCESS //////////////////////////////////////////////////
	elseif(get('do')=='updatepro'){
		$json = array();
        $json['s'] = false;
        $id=post('id');
        $montantusd=post('montantusd');
        $montantcdf=post('montantcdf');
        $json['message'] = '';
			if (($montantusd <0 || $montantcdf <0)) {
 					$json['message'] = json_success2("Les fonds de caisse ne doivent pas etre negatifs.");
			} else {
			    if ($montantusd == '') {
			        $montantusd = 0;
			    }
			    if ($montantcdf == '') {
			        $montantcdf = 0;
			    }
			        $this->fondscaisse_model->Update($montantusd,$montantcdf,$id);
 					$json['message'] = json_success2("Opération effectuée avec succes");
        			$json['s'] = true;			  

			}
	 echo json_encode($json);
	}
	
	//DETAILS //////////////////////////////////////////////
	elseif(get('do')=='details'){
	$rows = $this->stk_famille_model->SelectOne(get('idfamille'));
	include(APP_FOLDER.'/views/admin/stk_famille/Details.php');
	}
	
	//TRUNCATE ///////////////////////////////////////////////
	elseif(get('do')=='truncate'){
	$this->stk_famille_model->TruncateTable(''.H_ADMIN.'&view=stk_famille&do=viewall&msg=truncate');
	include(APP_FOLDER.'/views/admin/stk_famille/View.php');
	}
	
	//DELETE /////////////////////////////////////////////////
	elseif(get('do')=='delete'){
	$dfile=get('dfile');
		if(get('idfamille') and $dfile==''){
	$del = $this->stk_famille_model->Delete(get('idfamille'),''.H_ADMIN.'&view=stk_famille&do=viewall&msg=delete');
	}
	elseif(get('idfamille') and $dfile!='' and get('fdel')==''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	$del = $this->stk_famille_model->Delete(get('idfamille'),''.H_ADMIN.'&view=stk_famille&do=viewall&msg=delete');
	}
	elseif(get('idfamille') and $dfile!='' and get('fdel')!=''){
	delete_files(UPLOAD_PATH.get('dfile'));
	delete_files(THUMB_PATH.get('dfile'));
	send_to(''.H_ADMIN.'&view=stk_famille&idfamille='.get('idfamille').'&do=update&msg=delete');
	}
	}
	}//end invoke
	}//end class
	?>
	