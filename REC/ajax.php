<?php

/**
 * You would replace this area with say a database call or your own information.
 *   This is only for getting information to work with.
 *
 * dataset.json data gotten from generatedata.com
 */
require '../bdd/connexion.php';
session_start();
/* Recuperation des donnees  */
$requete_cl_part = $bdd->prepare("SELECT id_respo,entreprise FROM t_responsable WHERE entreprise<>'Prive' AND company_id=:company_id");
$requete_cl_part->BindParam(':company_id', $_SESSION['company_id']);
$requete_cl_part->execute();
$donnees_json[]=array("Email"=>'1',"Name"=>'Client occasionnel');
 while ($donnees = $requete_cl_part->fetch()) {
$donnees_json[]=array("Email"=>$donnees['id_respo'],"Name"=>$donnees['entreprise']);
}
$tabenc=json_encode($donnees_json);
$fp=fopen('js/dataset.json','w');
 if ($fp==false)
 {echo 'echec';
 
}
 else
 {
 fputs($fp,$tabenc);
 fclose($fp);
 }
//var_dump($donnees_json);
$file_contents = file_get_contents('js/dataset.json');

if(!$file_contents){
	throw new Exception('Invalid file name');
}

$json = json_decode($file_contents, true);

/**
 * End information getting begin actual work code
 */

$q = $_POST['q']; //This is the textbox value


/**
 * This would be replaced with say a WHERE call in a SQL statement or your own array filtering.
 */
$filtered = $json;
if(strlen($q)) {
	$filtered = array_filter($json, function ($val) use ($q) {
		if (stripos($val['Name'], $q) !== false) {
			return true;
		} else {
			return false;
		}

		//Could be shortened to the line below, broken out above to show what it is doing:
		//return strpos($val['Name'], $q) !== false;
	});
}

//Return the data, as you can see it is not formatted, we will do that on the frontend in ajaxResultsPreHook
//  You can however if you want format the data returned here and leave out ajaxResultsPreHook.  It is an optional parameter
echo json_encode(array_slice(array_values($filtered), 0, 20));