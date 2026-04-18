<?php

/*
  HEZECOM PHP CODE GENERATOR ULTIMATE (UltimateSpeed)
  Author: Hezecom Technologies (http://hezecom.com) info@hezecom.net
  COPYRIGHT 2014 ALL RIGHTS RESERVED
  FILE NAME functions.php

  You must have purchased a valid license from CodeCanyon.com in order to have
  access this file.

  You may only use this file according to the respective licensing terms
  you agreed to when purchasing this item.
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');

//post
function post($var)
{
    if (isset($_POST[$var]))
        return $_POST[$var];
}

//get
function get($var)
{
    if (isset($_GET[$var]))
        return $_GET[$var];
}

//send headers
function send_to($direction)
{
    if (!headers_sent()) {
        header('Location: ' . $direction);
        exit;
    } else
        print '<script type="text/javascript">';
    print 'window.location.href="' . $direction . '";';
    print '</script>';
    print '<noscript>';
    print '<meta http-equiv="refresh" content="0;url=' . $direction . '" />';
    print '</noscript>';
}

//msgs
function success_msg($dmsg)
{
    print('<div class="heze-notify progress-bar-success">
  <p>' . $dmsg . '</p>
  </div>
	');
}

function error_msg($dmsg)
{
    print('<div class="heze-notify progress-bar-danger">
  <p>' . $dmsg . '</p>
  </div>
	');
}

//TinyMCE editor
function HezecomEditor($txteditor)
{
    print('
<script>
tinymce.init({
    selector: "textarea.' . $txteditor . '",
    theme: "modern",
    width: "auto",
    height: 200,
    plugins: [
         "advlist autolink link image lists charmap  preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality   paste textcolor jbimages"
   ],
   toolbar: "styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink  jbimages | print preview ", 
  
		relative_urls: false
 }); 
</script>
	');
}

//File
function delete_files($folder)
{
    if (is_file($folder))
        unlink($folder);
}

//dir
function app_dir($folder = NULL)
{
    $base = str_replace($folder, '', dirname(__FILE__));
    return str_replace('\\', '/', $base);
}

//paging
function pagination($query, $per_page = 10, $url = NULL, $page = 1)
{
    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $total = $query;
    $splitter = "2";
    $url1 = $url . "&page=";
    $page = ($page == 0 ? 1 : $page);
    $start = ($page - 1) * $per_page;

    $firstPage = 1;
    $prev = ($page == 1) ? 1 : $page - 1;

    $prev = $page - 1;
    $next = $page + 1;
    $lastpage = ceil($total / $per_page);
    $lpm1 = $lastpage - 1;
    $hezpaging = "";
    if ($lastpage > 1) {
        $hezpaging .= "<ul class='hezpaging'>";
        $hezpaging .= "<li class='details'>" . LANG_PAGE . " $page of $lastpage</li>";

        if ($page == 1) {
            $hezpaging .= "<li><a class='current'>" . LANG_FIRST . "</a></li>";
            $hezpaging .= "<li><a class='current'>" . LANG_PREVIOUS . "</a></li>";
        } else {
            $hezpaging .= "<li><a href='" . $url1 . "$firstPage'>" . LANG_FIRST . "</a></li>";
            $hezpaging .= "<li><a href='" . $url1 . "$prev'>" . LANG_PREVIOUS . "</a></li>";
        }

        if ($lastpage < 7 + ($splitter * 2)) {
            for ($counter = 1; $counter <= $lastpage; $counter++) {
                if ($counter == $page)
                    $hezpaging .= "<li><a class='current'>$counter</a></li>";
                else
                    $hezpaging .= "<li><a href='" . $url1 . "$counter'>$counter</a></li>";
            }
        } elseif ($lastpage > 5 + ($splitter * 2)) {
            if ($page < 1 + ($splitter * 2)) {
                for ($counter = 1; $counter < 4 + ($splitter * 2); $counter++) {
                    if ($counter == $page)
                        $hezpaging .= "<li><a class='current'>$counter</a></li>";
                    else
                        $hezpaging .= "<li><a href='" . $url1 . "$counter'>$counter</a></li>";
                }
                $hezpaging .= "<li class='dot'>...</li>";
                $hezpaging .= "<li><a href='" . $url1 . "$lpm1'>$lpm1</a></li>";
                $hezpaging .= "<li><a href='" . $url1 . "$lastpage'>$lastpage</a></li>";
            } elseif ($lastpage - ($splitter * 2) > $page && $page > ($splitter * 2)) {
                $hezpaging .= "<li><a href='" . $url1 . "1'>1</a></li>";
                $hezpaging .= "<li><a href='" . $url1 . "2'>2</a></li>";
                $hezpaging .= "<li class='dot'>...</li>";
                for ($counter = $page - $splitter; $counter <= $page + $splitter; $counter++) {
                    if ($counter == $page)
                        $hezpaging .= "<li><a class='current'>$counter</a></li>";
                    else
                        $hezpaging .= "<li><a href='" . $url1 . "$counter'>$counter</a></li>";
                }
                $hezpaging .= "<li class='dot'>..</li>";
                $hezpaging .= "<li><a href='" . $url1 . "$lpm1'>$lpm1</a></li>";
                $hezpaging .= "<li><a href='" . $url1 . "$lastpage'>$lastpage</a></li>";
            } else {
                $hezpaging .= "<li><a href='" . $url1 . "1'>1</a></li>";
                $hezpaging .= "<li><a href='" . $url1 . "2'>2</a></li>";
                $hezpaging .= "<li class='dot'>..</li>";
                for ($counter = $lastpage - (2 + ($splitter * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $hezpaging .= "<li><a class='current'>$counter</a></li>";
                    else
                        $hezpaging .= "<li><a href='" . $url1 . "$counter'>$counter</a></li>";
                }
            }
        }
        if ($page < $counter - 1) {
            $hezpaging .= "<li><a href='" . $url1 . "$next'>" . LANG_NEXT . "</a></li>";
            $hezpaging .= "<li><a href='" . $url1 . "$lastpage'>" . LANG_LAST . "</a></li>";
        } else {
            $hezpaging .= "<li><a class='current'>" . LANG_NEXT . "</a></li>";
            $hezpaging .= "<li><a class='current'>" . LANG_NEXT . "</a></li>";
        }
        $hezpaging .= "</ul>\n";
    }
    return $hezpaging;
}

function pageparam($limit)
{
    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    return ($page * $limit) - $limit;
}

//Form Messages
function form_errors($errors)
{
    if (empty($errors) === false) {
        echo '<div class="alert alert-danger">' . implode($errors) . '</div>';
    }
}

//Password Hashing
function hezecom_crypt($info, $encdata = false)
{
    $strength = "08";
    if ($encdata) {
        if (substr($encdata, 0, 60) == crypt($info, "$2a$" . $strength . "$" . substr($encdata, 60))) {
            return true;
        } else {
            return false;
        }
    } else {
        $salt = "";
        for ($i = 0; $i < 22; $i++) {
            $salt .= substr("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789", mt_rand(0, 63), 1);
        }
        return crypt($info, "$2a$" . $strength . "$" . $salt) . $salt;
    }
}

//user position
function check_position($val)
{
    $result = '';
    if ($val == 1) {
        $result .= 'Super Administrator';
    } elseif ($val == 2) {
        $result .= 'Administrator';
    }
    return $result;
}

//status
function check_status($val)
{
    $result = '';
    if ($val == 1) {
        $result .= '<a class="btn btn-success btn-sm">Active</a>';
    } elseif ($val == 0) {
        $result .= '<a class="btn btn-danger btn-sm">Inactive</a>';
    }
    return $result;
}

//CSV EXPORT
/*
  USAGE
  DownloadSentHeaders('filename.csv');
  echo SendRecord2CSV($array);
  die();
 */
function SendRecord2CSV(array &$array)
{
    if (count($array) == 0) {
        return null;
    }
    ob_start();
    $hezfile = fopen("php://output", 'w');
    fputcsv($hezfile, array_keys(reset($array)));
    foreach ($array as $row) {
        fputcsv($hezfile, $row);
    }
    fclose($hezfile);
    return ob_get_clean();
}

function DownloadSentHeaders($filename)
{
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");
    // force download  
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
}

//MESSAGES
function json_error($errors)
{
    die('<div class="alert alert-danger">' . $errors . '</div>');
}

function json_success($success)
{
    die('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' . $success . '</div>');
}

function json_send($success)
{
    echo '<script>window.location.replace("' . $success . '");</script>';
}

//QUICK SEARCH
function AjaxSearchSuggest($url)
{
    $jss = "
	<script>
	asearch.load();
	asearch.setOnLoadCallback(function()
	{
		// Fade out the suggestions box when not active
		 $('input').blur(function(){
			$('#suggestions').fadeOut();
		 });
	});";
    $jss .= "
	function lookup(inputString) {
		if(inputString.length == 0) {
			$('#suggestions').fadeOut(); // Hide the suggestions box
	} else {
		
	$.post('" . $url . "', {qstring:";
    $jss .= ' ""+inputString+""}, function(data) { 
		';
    $jss .= "$('#suggestions').fadeIn();
		$('#suggestions').html(data);
			});
		}
	}
	</script>
    ";
    print($jss);
}

//pass generator
function Password_Generator($limit = 6)
{
    $generator = "";
    for ($i = 0; $i < $limit; $i++) {
        $generator .= substr("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789", mt_rand(0, 63), 1);
    }
    return $generator;
}

//PARTIE PERSONALISE
function AfficheText($text)
{
    return $text;
}

function AfficheTitre($text)
{
    return ucfirst($text);
}

function ucfirstText($text)
{
    return ucfirst($text);
}

function dateAffiche($stringdate)
{
    if ($stringdate != '') {
        $stringdate = trim($stringdate);
        $tmp = explode("-", $stringdate);
        $date_iso = $tmp[2] . "/" . $tmp[1] . "/" . $tmp[0];
        return $date_iso;
    }
}

//Verifier si un parametre get est vide
function getIsvide($var)
{
    if (!empty($_GET[$var])) {
        return $_GET[$var];
    } else {
        return '';
    }
}

//Retourne le nom du menu à partir de son code
function AfficheMenu($code)
{

    if ($code == 'MH') {
        $_SESSION['menu'] = 'hebergement';
    } elseif ($code == 'MR') {
        $_SESSION['menu'] = 'Facturation';
    } elseif ($code == 'MS') {
        $_SESSION['menu'] = 'stock';
    } elseif ($code == 'MC') {
        $_SESSION['menu'] = 'caisse';
    } elseif ($code == 'MCR') {
        $_SESSION['menu'] = 'configuration';
    }
    return $_SESSION['menu'];
}

//Retourne le nom du menu à partir de son code
function GetNomSite($id)
{
    foreach ($_SESSION['sites'] as $rows) {
        if ($rows->id_hotel == $id) {
            $nom = $rows->nom_hotel;
            break;
        }
    }
    return $nom;
}

//Formate un nombre
function format_chiffre($mon)
{
    return number_format($mon, 2, ',', '.');
}

//Arrondir un nombre
function arrondir($montant)
{
    return round($montant, 2);
}

//Affiche un nombre formaté + monnaie
function afficheMontant($maffiche, $montant1)
{
    $montant1 = format_chiffre(arrondir($montant1));
    return $montant1 . ' ' . $maffiche;
}

//Montant Prix
function CalculMontPrice($montant, $remise)
{
    $ht = $montant - CalculMontRemise($montant, $remise);
    return $ht;
}

//Montant HT
function CalculMontHt($montant, $tva)
{
    if ($_SESSION['addpricetva'] == -1) {
        $ht = ($montant - CalculMontTva($montant, $tva));
        return $ht;
    }
}

//Montant TVA
function CalculMontTva($montant, $tva)
{
    $montTva = ($montant * $tva) / 100;
    return $montTva;
}

//Montant Remise
function CalculMontRemise($montant, $remise)
{
    $montRemise = ($montant * $remise) / 100;
    return $montRemise;
}

//Montant TTC
function CalculMontTtc($montHt, $montTva)
{
    return ($montHt + $montTva);
}

//Retourne Tva
function getTVA($Tva)
{
    return 16;
}

//Retourne Tva
function getRemise($remise)
{

    return $_SESSION['panier']['remise'];
}

//Retourne Symbole devise
function getsymbole_devise()
{
    return 'USD';
}

//Retourne Symbole local
function getsymbole_local()
{
    return 'CDF';
}

//Montant TTC
function afficheprice($monnaie_price, $price, $monnaie_affiche, $taux)
{
    if ($monnaie_price == $monnaie_affiche) {
        $price = $price;
    } else {
        $price = $price * $taux;
    }
    return $price;
}

function montant_equivalent_bdd($m1, $m2, $tauxdollar1, $montant1)
{
    if ($m1 == $m2) {
        $mont = $montant1;
    } else {
        if ($m1 == 'USD' && $m2 == 'CDF') {
            $mont = $montant1 * $tauxdollar1;
        } else {
            $mont = $montant1 / $tauxdollar1;
        }
    }
    return $mont;
}

function format_numero($numero)
{
    return str_pad($numero, 5, "0", STR_PAD_LEFT); //00001;
}

//DATETIME
/* ça une chaine de format datetime et retourne une date au format désiré */
function format_stringdateTodatetime($format1, $stringdate, $format2)
{
    if ($stringdate != '') {
        $date = DateTime::createFromFormat($format1, $stringdate);
        return $date->format($format2);
    } else {
        return "00-00-0000";
    }
}

function dateToformatBdd($stringdate)
{
    if ($stringdate != '') {
        $stringdate = trim($stringdate);
        $tmp = explode("/", $stringdate);
        $date_iso = $tmp[2] . "-" . $tmp[1] . "-" . $tmp[0];
        return $date_iso;
    }
}

function getTauxFacture($service, $monnaie_fact, $tauxdollar, $taux_op, $taux_fact)
{
    if ($monnaie_fact == getsymbole_devise()) {
        if ($service == 'hebergement') {
            $taux_fact = $tauxdollar;
        } else {
            $taux_fact = $taux_op;
        }
    } else {
        $taux_fact = $taux_fact;
    }
    return $taux_fact;
}

function json_success2($success)
{
    return ('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' . $success . '</div>');
}

function json_error2($errors)
{
    return ('<div class="alert alert-danger">' . $errors . '</div>');
}

//RH
//POINTAGE
// VALIDATION POINTAGE
function ValidationPointage($idsite)
{
    $_SESSION['res1'] = array();
    $_SESSION['res1']['horaire_id'] = array();
    $_SESSION['res1']['libh'] = array();
    $_SESSION['res1']['nbragt'] = array();
    $_SESSION['res1']['dbt'] = array();
    $_SESSION['res1']['mrg'] = array();
    $_SESSION['res1']['fin'] = array();
    $_SESSION['res2'] = array();
    $_SESSION['res2']['horaire_id'] = array();
    $_SESSION['res2']['dte_in'] = array();
    $_SESSION['res2']['agtpnt'] = array();
    $_SESSION['res3'] = array();
    $_SESSION['result3']['horaire_id'] = array();
    $_SESSION['result3']['dte_in'] = array();
    $_SESSION['result3']['agtvld'] = array();

    $bdd = HDB::hus();
    //NOMBRE AGENT HORAIRE
    $requete = 'SELECT DISTINCT a.horaire_id,b.libh,COUNT(DISTINCT a.employe_id) AS nbragt,c.fin,c.dbt,c.mrg
        FROM resemployehoraire AS a,reshoraire AS b,reshorairejours AS c  
        WHERE a.horaire_id=b.idh 
        AND a.horaire_id=c.horaire_id    
        AND b.site_id=:id
        GROUP BY a.horaire_id,b.libh
        ORDER BY b.libh ASC';
    $query = $bdd->prepare($requete);
    $query->BindParam(':id', $idsite);
    try {
        $query->execute();
        $result1 = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    foreach ($result1 as $res1) {
        array_push($_SESSION['res1']['horaire_id'], $res1->horaire_id);
        $_SESSION['res1']['libh'][$res1->horaire_id] = $res1->libh;
        $_SESSION['res1']['nbragt'][$res1->horaire_id] = $res1->nbragt;
        $_SESSION['res1']['dbt'][$res1->horaire_id] = $res1->dbt;
        $_SESSION['res1']['mrg'][$res1->horaire_id] = $res1->mrg;
        $_SESSION['res1']['fin'][$res1->horaire_id] = $res1->fin;
    }
    //NOMBRE AGENT QUI ONT POINTE

    $requete = 'SELECT  COUNT(a.employe_id) AS agtpnt,a.dte_in,a.horaire_id
        FROM respointage AS a
        WHERE a.idsite=:id
        GROUP BY a.horaire_id,a.dte_in
        ORDER BY a.horaire_id ASC';
    $query = $bdd->prepare($requete);
    $query->BindParam(':id', $idsite);
    try {
        $query->execute();
        $result2 = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    foreach ($result2 as $res2) {
        array_push($_SESSION['res2']['horaire_id'], $res2->horaire_id);
        $_SESSION['res2']['dte_in'][$res2->horaire_id] = $res2->dte_in;
        $_SESSION['res2']['agtpnt'][$res2->horaire_id . $res2->dte_in] = $res2->agtpnt;
    }
    //NOMBRE AGENT VALIDES

    $requete = 'SELECT COUNT(a.employe_id) AS agtvld,a.dte_in,a.horaire_id
        FROM respointage AS a
        WHERE a.afich=1 AND 
        a.idsite=:id
        GROUP BY a.horaire_id,a.dte_in
        ORDER BY a.horaire_id ASC';
    $query = $bdd->prepare($requete);
    $query->BindParam(':id', $idsite);
    try {
        $query->execute();
        $result3 = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    foreach ($result3 as $res3) {
        array_push($_SESSION['result3']['horaire_id'], $res3->horaire_id);
        $_SESSION['result3']['dte_in'][$res3->horaire_id] = $res3->dte_in;
        $_SESSION['result3']['agtvld'][$res3->horaire_id . $res3->dte_in] = $res3->agtvld;
    }
}

function seconds_to_time2($seconds)
{
    // extract hours
    $hours = floor($seconds / (60 * 60));
    return $hours;
}

// VALIDATION POINTAGE
function DatasEmployCG($id)
{
    $bool = 0;
    $dte = date('Y-m-d');
    $dte1 = '';
    $dte2 = '';
    $transport = 0;
    $_SESSION['EmployCG'] = array();
    $_SESSION['EmployCG']['id'] = array();
    $_SESSION['EmployCG']['bool'] = array();
    $_SESSION['EmployCG']['transport'] = array();
    //verification s'il existe employe_id dans resempconge
    $requete = 'SELECT * FROM  resempconge WHERE employe_id=:employe_id AND encours=1';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':employe_id', $id);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    //fin verification
    if (COUNT($result) > 0) {
        foreach ($result as $rows) {
            $dte1 = $rows->dte1;
            $dte2 = $rows->dte2;
            $transport = $rows->transport;
        }
        if ($dte >= $dte1 && $dte <= $dte2)
            $bool = 1;
    }
    array_push($_SESSION['EmployCG']['id'], $id);
    $_SESSION['EmployCG']['bool'][$id] = $bool;
    $_SESSION['EmployCG']['transport'][$id] = $transport;
}

function ValidationPointagetraite($horaire_id, $dte_in, $dbt, $fin, $site_id, $respointmdl)
{
    $_SESSION['employe'] = array();
    $_SESSION['employe']['employe_id'] = array();
    $_SESSION['employe']['idpoint'] = array();
    $_SESSION['employe']['depart'] = array();
    /* LISTE  DES AGENTS D'UN HORAIRE */
    $bdd = HDB::hus();
    $requete = 'SELECT a.employe_id
        FROM resemployehoraire AS a 
        WHERE a.horaire_id=:horaire_id 
        ORDER BY a.employe_id ASC';
    $query = $bdd->prepare($requete);
    $query->BindParam(':horaire_id', $horaire_id);
    try {
        $query->execute();
        $result1 = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    /* LISTE  DES AGENTS AYANT POINTE */
    $requete = 'SELECT  a.id,a.employe_id,a.depart
        FROM respointage AS a
        WHERE a.dte_in=:dte_in
        AND a.horaire_id=:horaire_id 
        ORDER BY a.employe_id ASC';
    $query = $bdd->prepare($requete);
    $query->BindParam(':dte_in', $dte_in);
    $query->BindParam(':horaire_id', $horaire_id);
    try {
        $query->execute();
        $result2 = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    foreach ($result2 as $res2) {
        array_push($_SESSION['employe']['employe_id'], $res2->employe_id);
        $_SESSION['employe']['idpoint'][$res2->employe_id] = $res2->id;
        $_SESSION['employe']['depart'][$res2->employe_id] = $res2->depart;
    }
    /* ABSENCE POUR AGENT N AYANT PAS POINTER A LA SORTIE */

    $motif = 'A';
    $absence = 1;
    $presence = 0;
    $query = $bdd->prepare("UPDATE respointage SET motif=:motif,presence=:presence,absence=:absence WHERE dte_in=:dte_in  AND horaire_id=:horaire_id AND depart=0");
    $query->BindParam(':motif', $motif);
    $query->BindParam(':presence', $presence);
    $query->BindParam(':absence', $absence);
    $query->BindParam(':dte_in', $dte_in);
    $query->BindParam(':horaire_id', $horaire_id);
    $query->execute();
    /* APERCU LISTE DE PRESENCE */
    $afich = 1;
    $query = $bdd->prepare("UPDATE respointage SET afich=:afich WHERE dte_in=:dte_in  AND horaire_id=:horaire_id AND afich=0");
    $query->BindParam(':afich', $afich);
    $query->BindParam(':dte_in', $dte_in);
    $query->BindParam(':horaire_id', $horaire_id);
    $query->execute();

    /* INSERTION DES ABSENTS */

    foreach ($result1 as $res1) {
        $employe_id = $res1->employe_id;
        //insertion des agents qui sont en congé
        DatasEmployCG($employe_id);
        if ($_SESSION['EmployCG']['bool'][$employe_id] == 1) {

            $bool = Exist_Employe_Respointag($employe_id, $dte_in, $horaire_id, $site_id);
            if ($bool == 0) {
                $afich = 1;
                $motif = 'P';
                $absence = 0;
                $presence = 1;
                $conge = 1;
                $transport = $_SESSION['EmployCG']['transport'][$employe_id];
                $query = $bdd->prepare("INSERT respointage (employe_id,dte_in,motif,presence,absence,conge,afich,horaire_id,transport,hr_ind,hr_outf,idsite)
                                         VALUES(:employe_id,:dte_in,:motif,:presence,:absence,:conge,:afich,:horaire_id,:transport,:hr_ind,:hr_outf,:idsite)");

                $query->BindParam(':employe_id', $employe_id);
                $query->BindParam(':dte_in', $dte_in);
                $query->BindParam(':motif', $motif);
                $query->BindParam(':presence', $presence);
                $query->BindParam(':absence', $absence);
                $query->BindParam(':conge', $conge);
                $query->BindParam(':afich', $afich);
                $query->BindParam(':horaire_id', $horaire_id);
                $query->BindParam(':transport', $transport);
                $query->BindParam(':hr_ind', $dbt);
                $query->BindParam(':hr_outf', $fin);
                $query->BindParam(':idsite', $site_id);
                $query->execute();
                //insertion dans le tableau de session employe pour indiquer qu'il est en conge
                array_push($_SESSION['employe']['employe_id'], $employe_id);
            }
        }
        //fin insertion
        $afich = 1;
        $motif = 'A';
        $absence = 1;
        $presence = 0;
        if (!in_array($employe_id, $_SESSION['employe']['employe_id'])) {
            $NbreShift = NbreShiftAgent($employe_id);
            if ($NbreShift == 1) {
                //POUR LES EMPLOYES QUI SONT AFFECTES DANS UN SEUL SHIFT 
                $query = $bdd->prepare("INSERT respointage (employe_id,dte_in,motif,absence,afich,horaire_id,hr_ind,hr_outf,idsite)
                                         VALUES(:employe_id,:dte_in,:motif,:absence,:afich,:horaire_id,:hr_ind,:hr_outf,:idsite)");

                $query->BindParam(':employe_id', $employe_id);
                $query->BindParam(':dte_in', $dte_in);
                $query->BindParam(':motif', $motif);
                $query->BindParam(':absence', $absence);
                $query->BindParam(':afich', $afich);
                $query->BindParam(':horaire_id', $horaire_id);
                $query->BindParam(':hr_ind', $dbt);
                $query->BindParam(':hr_outf', $fin);
                $query->BindParam(':idsite', $site_id);
                $query->execute();
            } else if ($NbreShift == 2) {
                //POUR LES EMPLOYES QUI SONT AFFECTES DANS DEUX SHIFTS  
                $rows_employe_id = 0;
                $requete = 'SELECT a.employe_id
        FROM respointage AS a
        WHERE a.dte_in=:dte_in
        AND a.employe_id=:employe_id';
                $query = $bdd->prepare($requete);
                $query->BindParam(':dte_in', $dte_in);
                $query->BindParam(':employe_id', $employe_id);
                try {
                    $query->execute();
                    $res = $query->fetchAll(PDO::FETCH_OBJ);
                    if (COUNT($res) > 0) {
                        foreach ($res as $r) {
                            $rows_employe_id = $r->employe_id;
                        }
                    }
                } catch (PDOException $e) {
                    die($e->getMessage());
                }

                if ($rows_employe_id == 0) {
                    $query = $bdd->prepare("INSERT respointage (employe_id,dte_in,motif,absence,afich,horaire_id,hr_ind,hr_outf,idsite)
                                         VALUES(:employe_id,:dte_in,:motif,:absence,:afich,:horaire_id,:hr_ind,:hr_outf,:idsite)");

                    $query->BindParam(':employe_id', $employe_id);
                    $query->BindParam(':dte_in', $dte_in);
                    $query->BindParam(':motif', $motif);
                    $query->BindParam(':absence', $absence);
                    $query->BindParam(':afich', $afich);
                    $query->BindParam(':horaire_id', $horaire_id);
                    $query->BindParam(':hr_ind', $dbt);
                    $query->BindParam(':hr_outf', $fin);
                    $query->BindParam(':idsite', $site_id);
                    $query->execute();
                }
            }
        }
    }
    /* vider table tampon depart */
    $query = $bdd->prepare("DELETE FROM restmp_pointage WHERE idsite=:idsite  AND horaire_id=:horaire_id AND compteurshift=1");
    $query->BindParam(':idsite', $site_id);
    $query->BindParam(':horaire_id', $horaire_id);
    $query->execute();
    //SIGNALER HORAIRE VALIDEE
    $query = $bdd->prepare("INSERT checking_valid (shift,dte,site)
                                         VALUES(:shift,:dte,:site)");

    $query->BindParam(':shift', $horaire_id);
    $query->BindParam(':dte', $dte_in);
    $query->BindParam(':site', $site_id);
    $query->execute();
}
//VERIFIER SI HORAIRE VALIDE
function Checking_Shift_Valid($shift, $dte, $site)
{
    $bool = 0;
    $requete = 'SELECT id FROM  checking_valid WHERE shift=:shift AND dte=:dte AND site=:site';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':shift', $shift);
    $query->BindParam(':dte', $dte);
    $query->BindParam(':site', $site);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    //fin verification
    if (COUNT($result) > 0) {

        $bool = 1;
    }
    return $bool;
}
function Exist_Employe_Respointag($employe_id, $dte_in, $horaire_id, $site_id)
{
    $bool = 0;
    $requete = 'SELECT employe_id FROM  respointage WHERE dte_in=:dte_in AND horaire_id=:horaire_id AND idsite=:idsite';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':dte_in', $dte_in);
    $query->BindParam(':horaire_id', $horaire_id);
    $query->BindParam(':idsite', $site_id);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    //fin verification
    if (COUNT($result) > 0) {
        $bool = 1;
    }
    return $bool;
}
//recuperer jour mois annee d'une date
function JourmMoisAnnee($dte)
{
    $dte = trim($dte);
    $tmp = explode("-", $dte);
    $data = array();
    $data['jour'] = $tmp[2];
    $data['mois'] = $tmp[1];
    $data['annee'] = $tmp[0];

    return $data;
}

//recuperer jour mois annee d'une date
function DepartPointage($site_id)
{

    $bdd = HDB::hus();
    $date_dprt = '';
    $_SESSION['depart_pointage'] = array();
    $_SESSION['depart_pointage']['ok'] = 0;
    $_SESSION['depart_pointage']['annee'] = date('Y');
    $_SESSION['depart_pointage']['mois'] = date('m');
    $_SESSION['depart_pointage']['jour'] = date('d');
    $requete = 'SELECT dte_in FROM respointage 
                WHERE idsite=:idsite
                ORDER BY id ASC
                LIMIT 1';
    $query = $bdd->prepare($requete);
    $query->BindParam(':idsite', $site_id);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    if (COUNT($result) > 0) {
        foreach ($result as $res)
            $date_dprt = $res->dte_in;
        $data = JourmMoisAnnee($date_dprt);
        $_SESSION['depart_pointage']['ok'] = 1;
        $_SESSION['depart_pointage']['jour'] = intval($data['jour']);
        $_SESSION['depart_pointage']['mois'] = intval($data['mois']);
        $_SESSION['depart_pointage']['annee'] = intval($data['annee']);
    }
}

//recuperer jour mois annee d'une date
function ValidationPermutation($id, $num, $idagent1, $nomsagent1, $idagent2, $nomsagent2, $idhoraire, $libhoraire, $statut, $type_code, $type_lib, $heure_suplmtr_dpt, $site_id, $dte_dbt, $dte_fin, $action)
{
    $bdd = HDB::hus();
    if ($action == 1) {
        $query = $bdd->prepare("INSERT respermutation (num,dte,dtefin,idagent1,nomsagent1,idagent2,nomsagent2,idhoraire,libhoraire,statut,type_code,type_lib,idsite)
                                         VALUES(:num,:dte,:dtefin,:idagent1,:nomsagent1,:idagent2,:nomsagent2,:idhoraire,:libhoraire,:statut,:type_code,:type_lib,:idsite)");

        $query->BindParam(':num', $num);
        $query->BindParam(':dte', $dte_dbt);
        $query->BindParam(':dtefin', $dte_fin);
        $query->BindParam(':idagent1', $idagent1);
        $query->BindParam(':nomsagent1', $nomsagent1);
        $query->BindParam(':idagent2', $idagent2);
        $query->BindParam(':nomsagent2', $nomsagent2);
        $query->BindParam(':idhoraire', $idhoraire);
        $query->BindParam(':libhoraire', $libhoraire);
        $query->BindParam(':statut', $statut);
        $query->BindParam(':type_code', $type_code);
        $query->BindParam(':type_lib', $type_lib);
        $query->BindParam(':idsite', $site_id);
        $query->execute();
        $query = $bdd->prepare("UPDATE resemployehoraire SET employe_id=:idagent2,type_permt=:type_permt,agent_permt_id=:idagent1,heure_suplmtr_dpt=:heure_suplmtr_dpt,dte_dbt=:dte_dbt,dte_fin=:dte_fin WHERE employe_id=:idagent1 AND horaire_id=:horaire_id");
        $query->BindParam(':idagent2', $idagent2);
        $query->BindParam(':type_permt', $type_code);
        $query->BindParam(':agent_permt_id', $idagent1);
        $query->BindParam(':heure_suplmtr_dpt', $heure_suplmtr_dpt);
        $query->BindParam(':dte_dbt', $dte_dbt);
        $query->BindParam(':dte_fin', $dte_fin);
        $query->BindParam(':idagent1', $idagent1);
        $query->BindParam(':horaire_id', $idhoraire);
        $query->execute();
    } else if ($action == 2) {
        $query = $bdd->prepare("UPDATE respermutation SET statut=:statut WHERE id=:id");
        $query->BindParam(':statut', $statut);
        $query->BindParam(':id', $id);
        $query->execute();
        $type_p = 0;
        $ag_perm_id = Null;
        $he_suplm_d = Null;
        $dte_dbt = Null;
        $dte_fin = Null;
        $query = $bdd->prepare("UPDATE resemployehoraire SET employe_id=:idagent1,type_permt=:type_permt,agent_permt_id=:agent_permt_id,heure_suplmtr_dpt=:heure_suplmtr_dpt,dte_dbt=:dte_dbt,dte_fin=:dte_fin WHERE employe_id=:idagent2 AND horaire_id=:horaire_id");
        $query->BindParam(':idagent1', $idagent1);
        $query->BindParam(':type_permt', $type_p);
        $query->BindParam(':agent_permt_id', $ag_perm_id);
        $query->BindParam(':heure_suplmtr_dpt', $he_suplm_d);
        $query->BindParam(':dte_dbt', $dte_dbt);
        $query->BindParam(':dte_fin', $dte_fin);
        $query->BindParam(':idagent2', $idagent2);
        $query->BindParam(':horaire_id', $idhoraire);
        $query->execute();
    }
}

function AgentAppartientHoraire($idagent, $idhoraire)
{
    $bool = 0;
    $bdd = HDB::hus();
    $requete = 'SELECT COUNT(*) AS nbrlgnreq
        FROM resemployehoraire 
        WHERE employe_id=:employe_id
        AND horaire_id=:horaire_id';
    $query = $bdd->prepare($requete);
    $query->BindParam(':employe_id', $idagent);
    $query->BindParam(':horaire_id', $idhoraire);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    foreach ($result as $res)
        $bool = $res->nbrlgnreq;
    return $bool;
}

function ObservationPointage($obs)
{
    $o = '';
    if ($obs == 'A') {
        $o = 'Absent';
    } elseif ($obs == 'P' || $obs == 'RS') {
        $o = 'Présent';
    } elseif ($obs == 'AJ') {
        $o = 'Absence justifiée';
    }
    return $o;
}

function NbAnnee($dte_a)
{
    $dte_now = date('Y-m-d');
    $tDeb = explode("-", $dte_a);
    $tFin = explode("-", $dte_now);
    $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
        mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);
    $nb_jrs = (($diff / 31536000));
    return floor($nb_jrs) . ' ans';
}


function DecisionPointage($datedebut, $datefin, $heuredebutshift, $heurefinshift, $heuredebutuser, $heurefinuser)
{
    $bool = 0;
    if ($datedebut == $datefin) {

        if ($heuredebutuser <= $heuredebutshift) {

            if ($heurefinuser >= $heurefinshift) $bool = 1;
        }
    } else if ($datedebut < $datefin) {

        if ($heuredebutuser <= $heuredebutshift) {

            if ($heurefinuser >= $heurefinshift) $bool = 1;
        }
    }
    return $bool;
}
function CountShiftEmploy($libelle_jour, $employe_id)
{
    $_SESSION['countshiftemploy'] = array();
    $_SESSION['countshiftemploy']['horaire_id'] = array();
    $_SESSION['countshiftemploy']['horaire_lib'] = array();
    $_SESSION['countshiftemploy']['dbt'] = array();
    $_SESSION['countshiftemploy']['fin'] = array();
    $_SESSION['countshiftemploy']['jour_id'] = array();
    $_SESSION['countshiftemploy']['jour_lib'] = array();
    $compteur = 0;
    $bdd = HDB::hus();
    $requete = 'SELECT b.idh,b.libh,c.jours_id,c.dbt,c.mrg,c.fin,c.avmrgdbt,c.mrgfin,c.avmrgdbtsec,c.dbtsec,c.mrgdbtsec,c.finsec,c.mrgfinsec,d.libjrs
        FROM resemployehoraire AS a,reshoraire AS b,reshorairejours AS c,resjours AS d
        WHERE a.horaire_id=b.idh
        AND  b.idh=c.horaire_id
        AND c.jours_id=d.idjrs
        AND d.libjrs=:libelle_jour
        AND employe_id=:employe_id
        ORDER BY c.dbt ASC';
    $query = $bdd->prepare($requete);
    $query->BindParam(':libelle_jour', $libelle_jour);
    $query->BindParam(':employe_id', $employe_id);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    foreach ($result as $res) {
        array_push($_SESSION['countshiftemploy']['horaire_id'], $res->idh);
        $_SESSION['countshiftemploy']['horaire_lib'][$res->idh] = $res->libh;
        $_SESSION['countshiftemploy']['dbt'][$res->idh] = $res->dbt;
        $_SESSION['countshiftemploy']['fin'][$res->idh] = $res->fin;
        $_SESSION['countshiftemploy']['jour_id'][$res->idh] = $res->jours_id;
        $_SESSION['countshiftemploy']['jour_lib'][$res->idh] = $res->libjrs;
        $compteur = $compteur + 1;
    }
    return $compteur;
}
function NbreShiftAgent($idagent)
{
    $NbreShift = 0;
    $bdd = HDB::hus();
    $requete = 'SELECT COUNT(horaire_id) AS NbreShift
        FROM resemployehoraire 
        WHERE employe_id=:employe_id';
    $query = $bdd->prepare($requete);
    $query->BindParam(':employe_id', $idagent);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    foreach ($result as $res)
        $NbreShift = $res->NbreShift;
    return $NbreShift;
}

//recuperer jour mois annee d'une date
function PeriodePaie($dteng)
{
    $annee1 = date("Y");
    $tmp = explode("-", $dteng);
    $annee2 = $tmp[0];
    $m_eng = $tmp[1];
    $j_eng = $tmp[2];
    $m = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    $m2 = array('', 'Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre');
    $data = array();
    $data['mois'] = array();
    $data['mois2'] = array();
    $data['numero'] = array();
    $data['annee'] = array();
    for ($a = $annee1; $a >= $annee2; $a--) {
        $libmois = '';
        $libmois2 = '';
        for ($i = 1; $i <= 12; $i++) {
            $libmois = $m[$i] . ' ' . $a;
            $libmois2 = $m2[$i] . $a;
            if (($i <= date('m') && $i > $m_eng) && $a == $annee2) {
                array_push($data['mois'], $libmois);
                array_push($data['mois2'], $libmois2);
                array_push($data['numero'], $i);
                array_push($data['annee'], $a);
            } elseif ($a <= $annee2 && $a != $annee1) {
                array_push($data['mois'], $libmois);
                array_push($data['mois2'], $libmois2);
                array_push($data['numero'], $i);
                array_push($data['annee'], $a);
            } elseif (($a == $annee1 && $annee1 != $annee2) && ($i <= date('m'))) {
                array_push($data['mois'], $libmois);
                array_push($data['mois2'], $libmois2);
                array_push($data['numero'], $i);
                array_push($data['annee'], $a);
            }
        }
    }
    return $data;
}

function PeriodePaie2($dteng)
{
    $annee1 = date("Y");
    $tmp = explode("-", $dteng);
    $annee2 = $tmp[0];
    $m_eng = $tmp[1];
    $j_eng = $tmp[2];
    $m = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    $m2 = array('', 'Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre');
    $data = array();
    $data['mois'] = array();
    $data['mois2'] = array();
    $data['numero'] = array();
    $data['annee'] = array();
    for ($a = $annee1; $a >= $annee2; $a--) {
        $libmois = '';
        $libmois2 = '';
        for ($i = 1; $i <= 12; $i++) {
            $libmois = $m[$i] . ' ' . $a;
            $libmois2 = $m2[$i] . $a;
            if ($i <= date('m') && $i > $m_eng) {
                array_push($data['mois'], $libmois);
                array_push($data['mois2'], $libmois2);
                array_push($data['numero'], $i);
                array_push($data['annee'], $a);
            }
        }
    }
    return $data;
}

//PAIE
function TimeToSec($time)
{
    $sec = 0;
    foreach (array_reverse(explode(':', $time)) as $k => $v)
        $sec += pow(60, $k) * $v;
    return $sec;
}

//Retourne le nom d'un type rubrique
function GetPenalite($num)
{
    $nom = '';
    if ($num == 0) {
        $nom = 'Ne rien faire';
    } elseif ($num == 1) {
        $nom = 'Retenue montant transport équivalent';
    } elseif ($num == 2) {
        $nom = 'Retenue montant salaire de base équivalent';
    } elseif ($num == 3) {
        $nom = 'Retenue montant salaire de base et transport équivalents';
    }
    return $nom;
}

function GetMontBase($nbrjrpreste, $montantjr)
{
    $nbrjr = 0;
    if ($_SESSION['penalite'] == 0 || $_SESSION['penalite'] == 1) {
        $nbrjr = 26;
    } elseif ($_SESSION['penalite'] == 2 || $_SESSION['penalite'] == 3) {
        $nbrjr = $nbrjrpreste;
    }
    return $nbrjr * $montantjr;
}

function GetMontTransport($nbrjrtransp, $monttottransp)
{
    $nbrjr = $nbrjrtransp;
    if ($_SESSION['penalite'] == 0 || $_SESSION['penalite'] == 2) {
        $nbrjr = 26;
    } elseif ($_SESSION['penalite'] == 1 || $_SESSION['penalite'] == 3) {
        $nbrjr = $nbrjrtransp;
    }
    return $nbrjr * ($monttottransp / 26);
}

function CalculMontantRubrique($rows, $salbase, $taux, $nbrenf, $nbjrpreste, $nbjrtransport, $hrsup)
{
    $montant = 0;
    if ($rows->salbase == 1) {
        if ($_SESSION['monnaie_cat'] == getsymbole_local() && $rows->monnaie == getsymbole_devise()) {
            $salbase = montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $_SESSION['Paie_taux'], $salbase);
        } elseif ($_SESSION['monnaie_cat'] == getsymbole_devise() && $rows->monnaie == getsymbole_local()) {
            $salbase = montant_equivalent_bdd(getsymbole_devise(), getsymbole_local(), $_SESSION['Paie_taux'], $salbase);
        }
        $montant = $salbase;
    } elseif ($rows->manuel == 1) {
        $montant = $rows->valeur;
    }
    if ($rows->pourcentage == 1) {
        $taux = $rows->valeur2;
        $montant = $salbase * $taux / 100;
    }
    if ($rows->nbrenf == 1) {
        $montant = $montant * $nbrenf;
    }
    if ($rows->jrp == 1) {
        $montant = $montant * $nbjrpreste;
    }
    if ($rows->hrsup == 1) {
        $montant = $montant * $hrsup;
    }
    if ($rows->type2 == 'transport') {
        $montant = GetMontTransport($nbjrtransport, $montant);
    }
    if ($rows->monnaie == getsymbole_devise()) {
        $m2 = montant_equivalent_bdd($rows->monnaie, $_SESSION['Paie_affiche'], $_SESSION['Paie_taux'], $montant);
    } else {
        $m2 = $montant;
    }


    return $m2;
}

function CalculMontantRubrique2($rows, $salbase, $taux, $nbrenf, $nbjrpreste, $nbjrtransport, $hrsup)
{
    $taux_paie = 1650;
    $monnaie_cat = 'CDF';
    $monnaie_paie = 'CDF';
    $montant = 0;
    if ($rows->salbase == 1) {
        if ($monnaie_cat == getsymbole_local() && $rows->monnaie == getsymbole_devise()) {
            $salbase = montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $taux_paie, $salbase);
        } elseif ($monnaie_cat == getsymbole_devise() && $rows->monnaie == getsymbole_local()) {
            $salbase = montant_equivalent_bdd(getsymbole_devise(), getsymbole_local(), $taux_paie, $salbase);
        }
        $montant = $salbase;
    } elseif ($rows->manuel == 1) {
        $montant = $rows->valeur;
    }
    if ($rows->pourcentage == 1) {
        $taux = $rows->valeur2;
        $montant = $salbase * $taux / 100;
    }
    if ($rows->nbrenf == 1) {
        $montant = $montant * $nbrenf;
    }
    if ($rows->jrp == 1) {
        $montant = $montant * $nbjrpreste;
    }
    if ($rows->hrsup == 1) {
        $montant = $montant * $hrsup;
    }
    if ($rows->type2 == 'transport') {
        $montant = GetMontTransport($nbjrtransport, $montant);
    }
    if ($rows->monnaie == getsymbole_devise()) {
        $m2 = montant_equivalent_bdd($rows->monnaie, $monnaie_paie, $taux_paie, $montant);
    } else {
        $m2 = $montant;
    }


    return $m2;
}

//Retourne le nom d'un type rubrique
function GetNomTypeRubrique($type)
{
    $nom = '';
    if ($type == 'remuneration') {
        $nom = 'TOTAL BRUT';
    } elseif ($type == 'retenue') {
        $nom = 'TOTAL RETENUE';
    } elseif ($type == 'autre') {
        $nom = 'TOTAL AUTRES REMUNERATIONS';
    } else {
        $nom = 'TOTAL NET';
    }
    return $nom;
}

function GetNomTypeRubrique2($type)
{
    $nom = '';
    if ($type == 'base') {
        $nom = 'BASE';
    } elseif ($type == 'retenue') {
        $nom = 'RETENUE';
    } else {
        $nom = 'AUTRES REMUNERATIONS';
    }
    return $nom;
}

function GetMontantjrPaie($salbase, $type)
{
    $montantjr = 0;
    if ($type == 'mensuel') {
        $montantjr = $salbase / 26;
    } else {
        $montantjr = $salbase;
    }
    return $montantjr;
}

//EMPRUNT
function IdLibRubriq($type, $site_id)
{
    $id = 0;
    $bdd = HDB::hus();
    $requete = 'SELECT id
        FROM resrubrique 
        WHERE type=:type
        AND site_id=:site_id';
    $query = $bdd->prepare($requete);
    $query->BindParam(':type', $type);
    $query->BindParam(':site_id', $site_id);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    foreach ($result as $res)
        $id = $res->id;
    return $id;
}

function IdSalAgt($employe_id, $site_id)
{
    $id = 0;
    $bdd = HDB::hus();
    $requete = 'SELECT id
        FROM ressalaire 
        WHERE employe_id=:employe_id
        AND site_id=:site_id';
    $query = $bdd->prepare($requete);
    $query->BindParam(':employe_id', $employe_id);
    $query->BindParam(':site_id', $site_id);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    foreach ($result as $res)
        $id = $res->id;
    return $id;
}

function MontantRembourse1($emprunt_id, $employe_id, $libelle, $site_id)
{
    $requete = 'SELECT b.montant AS montrembourse,b.monnaie AS monnaierembourse,b.taux AS tauxremourse,b.dte AS dterembourse,b.emprunt_id 
    FROM resemprunt AS a,resremboursement AS b,resemployes AS d
    WHERE a.id=b.emprunt_id AND a.employe_id=d.id AND a.libelle=:libelle AND a.site_id=:site_id  AND a.employe_id=:employe_id  AND b.emprunt_id=:emprunt_id ORDER BY d.noms ASC';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':site_id', $site_id);
    $query->BindParam(':libelle', $libelle);
    $query->BindParam(':employe_id', $employe_id);
    $query->BindParam(':emprunt_id', $emprunt_id);

    try {
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function MontantRembourse($employe_id, $libelle, $site_id)
{
    $requete = 'SELECT b.montant AS montrembourse,b.monnaie AS monnaierembourse,b.taux AS tauxremourse,b.dte AS dterembourse,b.emprunt_id 
    FROM resemprunt AS a,resremboursement AS b,resemployes AS d
    WHERE a.id=b.emprunt_id AND a.employe_id=d.id AND a.libelle=:libelle AND a.site_id=:site_id  AND a.employe_id=:employe_id ORDER BY d.noms ASC';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':site_id', $site_id);
    $query->BindParam(':libelle', $libelle);
    $query->BindParam(':employe_id', $employe_id);

    try {
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

//BON DE MALADE
function DataBnMalad($id)
{

    $_SESSION['malade'] = array();
    $_SESSION['malade']['id'] = array();
    $_SESSION['malade']['noms'] = array();
    $_SESSION['malade']['statut'] = array();
    $requete = 'SELECT * FROM resemployes WHERE id=:id';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':id', $id);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    if (count($result) > 0) {
        foreach ($result as $res) {
            array_push($_SESSION['malade']['id'], $res->id);
            $_SESSION['malade']['noms'][$res->id] = $res->noms;
            $_SESSION['malade']['statut'][$res->id] = 'employe';
        }
    } else {

        $requete = 'SELECT * FROM resemployefamille WHERE id=:id';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':id', $id);
        try {
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (count($result) > 0) {
            foreach ($result as $res) {
                array_push($_SESSION['malade']['id'], $res->id);
                $_SESSION['malade']['noms'][$res->id] = $res->nom;
                $_SESSION['malade']['statut'][$res->id] = $res->type;
            }
        } else {
            echo "vide";
        }
    }
}

//SUPPRESSION ACCENTS
function suppr_accents($str, $encoding = 'utf-8')
{
    // transformer les caractères accentués en entités HTML
    $str = htmlentities($str, ENT_NOQUOTES, $encoding);

    // remplacer les entités HTML pour avoir juste le premier caractères non accentués
    // Exemple : "&ecute;" => "e", "&Ecute;" => "E", "à" => "a" ...
    $str = preg_replace('#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#', '\1', $str);

    // Remplacer les ligatures tel que : , Æ ...
    // Exemple "œ" => "oe"
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
    // Supprimer tout le reste
    $str = preg_replace('#&[^;]+;#', '', $str);

    return $str;
}

// VERIFICATION EMPRUNT SOLDE EMPLOYE
function MontEmpruntSold($employe_id, $libelle, $site_id)
{
    $bool = 0;
    $montant = 0;
    $montrembourse = 0;
    $reste = 0;
    $noms_employ = '';
    $requete = 'SELECT d.noms,a.id AS idresemprunt,a.libelle,SUM(a.montant) AS montant,a.montant2,a.monnaie AS monnaieresemprunt,a.taux AS tauxresemprunt,a.dte,a.dte_deduct,a.duree,a.employe_id
	FROM resemprunt AS a,resemployes AS d
	WHERE  a.employe_id=d.id AND a.libelle=:libelle AND a.site_id=:site_id AND a.employe_id=:employe_id GROUP BY a.employe_id ORDER BY d.noms ASC';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':site_id', $site_id);
    $query->BindParam(':libelle', $libelle);
    $query->BindParam(':employe_id', $employe_id);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    foreach ($result as $rows) {
        $noms_employ = $rows->noms;
        $montant = montant_equivalent_bdd($rows->monnaieresemprunt, $_SESSION['Paie_affiche'], $rows->tauxresemprunt, $rows->montant);
        $libelle = $rows->libelle;
        $site_id = $_SESSION['idsite'];
        $result2 = MontantRembourse($employe_id, $libelle, $site_id);
        foreach ($result2 as $rows2) {
            $montrembourse += montant_equivalent_bdd($rows2->monnaierembourse, $_SESSION['Paie_affiche'], $rows2->tauxremourse, $rows2->montrembourse);
        }
    }
    $reste = $montant - $montrembourse;
    $_SESSION['montant'] = $montant;
    $_SESSION['montrembourse'] = $montrembourse;
    $_SESSION['reste'] = $reste;
    $_SESSION['noms_employ'] = $noms_employ;

    if ($reste > 0)
        $bool = 1;
    return $bool;
}

function JrsSemaine($date)
{
    $jour{
        0} = "dimanche";
    $jour{
        1} = "lundi";
    $jour{
        2} = "mardi";
    $jour{
        3} = "mercredi";
    $jour{
        4} = "jeudi";
    $jour{
        5} = "vendredi";
    $jour{
        6} = "samedi";
    $timestamp = strtotime($date);
    $d = date("w/j/m/y", $timestamp);
    $date = explode("/", $d);
    $date_fr = $jour{
        $d[0]};
    return $date_fr;
}

function DateFuture1($dtenow, $nbrj)
{
    $dtenowTimestamp = strtotime($dtenow);
    $dtefutur = date('Y-m-d', strtotime('+' . $nbrj . ' days', $dtenowTimestamp));
    return $dtefutur;
}

function DateFuture($dte1, $nbrj, $employe_id)
{
    $_SESSION['h'] = array();
    $_SESSION['h']['j'] = array();
    //on recupere le nombre de jours de l'employé
    $requete = 'SELECT distinct a.jours_id,c.libjrs FROM reshorairejours AS a,resemployehoraire AS b,resjours AS c
WHERE  a.horaire_id=b.horaire_id AND b.employe_id=:employe_id AND a.jours_id=c.idjrs AND b.defaul=1';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':employe_id', $employe_id);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    foreach ($result as $rows) {
        if (!in_array($rows->libjrs, $_SESSION['h']['j'])) {
            array_push($_SESSION['h']['j'], $rows->libjrs);
        }
    }
    //fin
    $nbjexct = 1;
    $anne = date('Y');
    $mois = date('m');
    $jour = date('d');
    $jour = intval($jour) + 1;
    $dte2 = '';
    for ($n = 1; $nbrj >= $n; $n++) {
        $nbjour = cal_days_in_month(CAL_GREGORIAN, $mois, $anne); // nombre de jour dans le mois
        for ($i = $jour; $nbjour >= $i; $i++) {
            $j = $i;
            if ($j == 1)
                $j = '01';
            if ($j == 2)
                $j = '02';
            if ($j == 3)
                $j = '03';
            if ($j == 4)
                $j = '04';
            if ($j == 5)
                $j = '05';
            if ($j == 6)
                $j = '06';
            if ($j == 7)
                $j = '07';
            if ($j == 8)
                $j = '08';
            if ($j == 9)
                $j = '09';
            $datefrmtbd = $anne . '-' . $mois . '-' . $j;
            $libjrs = JrsSemaine($datefrmtbd);
            if (in_array($libjrs, $_SESSION['h']['j'])) {
                if ($nbjexct <= $nbrj) {
                    $dte2 = $datefrmtbd;
                    $nbjexct++;
                }
            }
        }
        $jour = 1;
        $mois = intval($mois);
        $anne = intval($anne);

        if ($mois <= 11) {
            $mois++;
        } else if ($mois == 12) {
            $mois = 1;
            $anne++;
        }
        $mois = (string) $mois;
        $anne = (string) $anne;
    }
    return $dte2;
}

function DateFutureCg1($dte1, $nbrj, $employe_id)
{
    $_SESSION['h'] = array();
    $_SESSION['h']['j'] = array();
    //on recupere le nombre de jours de l'employé
    $requete = 'SELECT distinct a.jours_id,c.libjrs FROM reshorairejours AS a,resemployehoraire AS b,resjours AS c
WHERE  a.horaire_id=b.horaire_id AND b.employe_id=:employe_id AND a.jours_id=c.idjrs AND b.defaul=1';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':employe_id', $employe_id);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    foreach ($result as $rows) {

        if (!in_array($rows->libjrs, $_SESSION['h']['j'])) {
            array_push($_SESSION['h']['j'], $rows->libjrs);
        }
    }
    //fin
    $nbjexct = 1;
    $stringdate = trim($dte1);
    $tmp = explode("-", $stringdate);
    //$date_iso = $tmp[2] . "/" . $tmp[1] . "/" . $tmp[0];
    $jour = $tmp[2];
    $mois = $tmp[1];
    $anne = $tmp[0];
    $jour = intval($jour);
    $dte2 = '';
    for ($n = 1; $nbrj >= $n; $n++) {
        $nbjour = cal_days_in_month(CAL_GREGORIAN, $mois, $anne); // nombre de jour dans le mois
        for ($i = $jour; $nbjour >= $i; $i++) {
            $j = $i;
            if ($j == 1)
                $j = '01';
            if ($j == 2)
                $j = '02';
            if ($j == 3)
                $j = '03';
            if ($j == 4)
                $j = '04';
            if ($j == 5)
                $j = '05';
            if ($j == 6)
                $j = '06';
            if ($j == 7)
                $j = '07';
            if ($j == 8)
                $j = '08';
            if ($j == 9)
                $j = '09';

            if ($mois == 1)
                $moisl = '01';
            if ($mois == 2)
                $moisl = '02';
            if ($mois == 3)
                $moisl = '03';
            if ($mois == 4)
                $moisl = '04';
            if ($mois == 5)
                $moisl = '05';
            if ($mois == 6)
                $moisl = '06';
            if ($mois == 7)
                $moisl = '07';
            if ($mois == 8)
                $moisl = '08';
            if ($mois == 9)
                $moisl = '09';
            $datefrmtbd = $anne . '-' . $moisl . '-' . $j;
            $libjrs = JrsSemaine($datefrmtbd);
            if (in_array($libjrs, $_SESSION['h']['j'])) {
                if ($nbjexct <= $nbrj) {
                    $dte2 = $datefrmtbd;
                    $nbjexct++;
                }
            }
        }
        $jour = 1;
        $mois = intval($mois);
        $anne = intval($anne);

        if ($mois <= 11) {
            $mois++;
        } else if ($mois == 12) {
            $mois = 1;
            $anne++;
        }
        $mois = (string) $mois;
        $anne = (string) $anne;
    }
    return $dte2;
}

function DateFutureCg($dte1, $nbrj, $employe_id)
{
    $nbjexct = 1;
    $stringdate = trim($dte1);
    $tmp = explode("-", $stringdate);
    //$date_iso = $tmp[2] . "/" . $tmp[1] . "/" . $tmp[0];
    $jour = $tmp[2];
    $mois = $tmp[1];
    $anne = $tmp[0];
    $jour = intval($jour);
    $dte2 = '';
    while ($nbjexct <= $nbrj) {
        $nbjour = cal_days_in_month(CAL_GREGORIAN, $mois, $anne); // nombre de jour dans le mois
        for ($j = $jour; $nbjour >= $j; $j++) {
            if ($j == 1)
                $j = '01';
            if ($j == 2)
                $j = '02';
            if ($j == 3)
                $j = '03';
            if ($j == 4)
                $j = '04';
            if ($j == 5)
                $j = '05';
            if ($j == 6)
                $j = '06';
            if ($j == 7)
                $j = '07';
            if ($j == 8)
                $j = '08';
            if ($j == 9)
                $j = '09';
            if ($mois == 1)
                $mois = '01';
            if ($mois == 2)
                $mois = '02';
            if ($mois == 3)
                $mois = '03';
            if ($mois == 4)
                $mois = '04';
            if ($mois == 5)
                $mois = '05';
            if ($mois == 6)
                $mois = '06';
            if ($mois == 7)
                $mois = '07';
            if ($mois == 8)
                $mois = '08';
            if ($mois == 9)
                $mois = '09';
            $j = (string) $j;
            $mois = (string) $mois;
            $anne = (string) $anne;
            $datefrmtbd = $anne . '-' . $mois . '-' . $j;
            $libjrs = JrsSemaine($datefrmtbd);
            if ($libjrs != 'dimanche') {
                if ($nbjexct <= $nbrj) {
                    $dte2 = $datefrmtbd;
                    $nbjexct++;
                }
            }
            $j = intval($j);
        }
        $jour = 1;
        $mois = intval($mois);
        $anne = intval($anne);

        if ($mois <= 11) {
            $mois++;
        } else if ($mois == 12) {
            $mois = 1;
            $anne++;
        }
        $mois = (string) $mois;
        $anne = (string) $anne;
    }
    return $dte2;
}

function VerifSanction($id)
{
    $bool = 0;
    $dte = date('Y-m-d');
    $dte1 = '';
    $dte2 = '';
    //verification s'il existe employe_id dans ressanction_employe
    $requete = 'SELECT * FROM  ressanctionempl WHERE employe_id=:employe_id AND nbre>0 AND encours=1';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':employe_id', $id);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    //fin verification
    if (COUNT($result) > 0) {
        foreach ($result as $rows) {
            $dte1 = $rows->dte1;
            $dte2 = $rows->dte2;
        }
        if ($dte >= $dte1 && $dte <= $dte2)
            $bool = 1;
    }
    return $bool;
}

function VerifCG($id)
{
    $bool = 0;
    $dte = date('Y-m-d');
    $dte1 = '';
    $dte2 = '';
    //verification s'il existe employe_id dans resempconge
    $requete = 'SELECT * FROM  resempconge WHERE employe_id=:employe_id AND encours=1';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':employe_id', $id);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    //fin verification
    if (COUNT($result) > 0) {
        foreach ($result as $rows) {
            $dte1 = $rows->dte1;
            $dte2 = $rows->dte2;
        }
        if ($dte >= $dte1 && $dte <= $dte2)
            $bool = 1;
    }
    return $bool;
}

function NJrs($dte1, $dte2)
{
    $dte1 = strtotime($dte1);
    $dte2 = strtotime($dte2);
    $njrs = ceil(abs($dte2 - $dte1) / 86400);
    return $njrs;
}

function NJrsCsnm($dte1, $dte2, $employe_id)
{
    $_SESSION['h'] = array();
    $_SESSION['h']['j'] = array();
    $njrs = 0;
    //on recupere le nombre de jours de l'employé
    $requete = 'SELECT distinct a.jours_id,c.libjrs FROM reshorairejours AS a,resemployehoraire AS b,resjours AS c
WHERE  a.horaire_id=b.horaire_id AND b.employe_id=:employe_id AND a.jours_id=c.idjrs AND b.defaul=1';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':employe_id', $employe_id);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    foreach ($result as $rows) {
        if (!in_array($rows->libjrs, $_SESSION['h']['j'])) {
            array_push($_SESSION['h']['j'], $rows->libjrs);
        }
    }
    //fin
    while ($dte1 <= $dte2) {
        $libjrs = JrsSemaine($dte1);
        if (in_array($libjrs, $_SESSION['h']['j'])) {
            $njrs++;
        }
        $c = 1;
        $dte1 = DateFuture1($dte1, $c);
    }
    return $njrs;
}

function NextDateEngage($dte_now)
{
    $dte_now = trim($dte_now);
    $tmp = explode("-", $dte_now);
    //$Y= (string)(intval($tmp[0])+1);
    $Y = date('Y');
    $m = $tmp[1];
    $d = $tmp[2];
    $dte_next = $Y . '-' . $m . '-' . $d;
    return $dte_next;
}

function NextDate($dtenow, $nbrj)
{
    $dtenowTimestamp = strtotime($dtenow);
    $dtefutur = date('Y-m-d', strtotime('+' . $nbrj . ' days', $dtenowTimestamp));
    return $dtefutur;
}

function DateReprise($dte)
{
    $nbrj = 1;
    $dterepri = NextDate($dte, $nbrj);
    if (JrsSemaine($dterepri) == 'dimanche') {
        $dterepri = NextDate($dterepri, $nbrj);
    }
    return $dterepri;
}

//Resiliation
function AncienneteEmploye($dte_engage)
{
    $date_actu = date('Y-m-d');
    $datetime1 = new DateTime($dte_engage);
    $datetime2 = new DateTime($date_actu);
    $difference = $datetime1->diff($datetime2);
    $nombre_annee = $difference->y;
    $param_ancien = 5;
    $njrs_ancien = (int) ($nombre_annee / $param_ancien);
    return $njrs_ancien;
}

//Resiliation
function MontantRembourse3($employe_id)
{
    $bdd = HDB::hus();
    $data = array();
    $data['id_rub'] = array();
    $data['lib_rub'] = array();
    $data['montant_rub'] = array();
    $data['mont_paye_rub'] = array();
    $data['emprunt_id'] = array();
    $data['emprunt_tot'] = array();
    $data['emprunt_paye'] = array();
    $requete1 = '
        SELECT a.id,a.montant AS mont_emp,a.monnaie AS mon_emp,a.taux AS tx_emp, b.montant AS mont_remb,
            b.monnaie AS mon_remb,b.taux AS tx_remb,
             c.id AS rubrique_id,c.libelle
        FROM resemprunt AS a,resremboursement AS b,resrubrique AS c
        WHERE a.id=b.emprunt_id 
               AND a.libelle=c.id
            AND a.employe_id=:employe_id';
    $query1 = $bdd->prepare($requete1);
    $query1->BindParam(':employe_id', $employe_id);
    try {
        $query1->execute();
        $result1 = $query1->fetchAll(PDO::FETCH_OBJ);

        foreach ($result1 as $r) {
            $montant_calc = montant_equivalent_bdd($r->mon_emp, $_SESSION['Paie_affiche'], $r->tx_emp, $r->mont_emp);
            $montant = montant_equivalent_bdd($r->mon_remb, $_SESSION['Paie_affiche'], $r->tx_remb, $r->mont_remb);
            $rubrique_id = $r->rubrique_id;
            $emprunt_id = $r->id;
            if (!in_array($rubrique_id, $data['id_rub'])) {
                array_push($data['id_rub'], $rubrique_id);
                $data['lib_rub'][$rubrique_id] = $r->libelle;
            }
            if (!in_array($emprunt_id, $data['emprunt_id'])) {
                array_push($data['emprunt_id'], $emprunt_id);
                $data['emprunt_tot'][$emprunt_id] = $montant_calc;
                $data['emprunt_paye'][$emprunt_id] = $montant;
                $data['montant_rub'][$rubrique_id] = $montant_calc;
                $data['mont_paye_rub'][$rubrique_id] = $montant;
            }
            if (in_array($emprunt_id, $data['emprunt_id'])) {
                $data['emprunt_paye'][$emprunt_id] += $montant;
                $data['mont_paye_rub'][$rubrique_id] += $montant;
            }
        }
        return $data;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function GetAncienneteEmploye($dte_engage)
{
    $data = array();
    $data['annee'] = 0;
    $data['mois'] = 0;
    $data['jour'] = 0;
    $date_actu = date('Y-m-d');
    $datetime1 = new DateTime($dte_engage);
    $datetime2 = new DateTime($date_actu);
    $difference = $datetime1->diff($datetime2);
    $data['annee'] = $difference->y;
    $data['mois'] = $difference->m;
    $data['jour'] = $difference->d;
    return $data;
}

function AfficheAncienneteEmploye($anciennete)
{
    $lib_anciennete = $anciennete['annee'] . ' ans et ' . $anciennete['mois'] . ' mois';
    return $lib_anciennete;
}

function MontantDecompte($montant, $nbrejr)
{
    return ($montant / 26) * $nbrejr;
}

//Retourne les jours préavis
function jrpreavis($preavis, $annee)
{
    $cont = 8;
    if ($preavis == 26) {
        $cont = 9;
    }
    $val = $preavis + ($cont * $annee);
    return $val;
}

//Retourne les jours conge/preavis
function jrcongsurpreavis($preavis, $annee)
{
    $nbrjrpreavis = jrpreavis($preavis, $annee);
    return floor(($nbrjrpreavis * $preavis) / 312);
}

//Retourne nombre de conge compensatoire
function congeComp($preavis, $nbrmois)
{
    return floor(($preavis * $nbrmois) / 12);
}

//Retourne nombre de conge non pris
function congeNonpris($annee, $nbrmois)
{
    return floor(($preavis * $nbrmois) / 12);
}

//Retourne motif decompte
function getMotifDecompte($code)
{
    $motif = '';
    if ($code == 1) {
        $motif = 'Décès';
    } elseif ($code == 2) {
        $motif = 'Démission';
    } elseif ($code == 3) {
        $motif = 'Désertion';
    } elseif ($code == 4) {
        $motif = "Faute lourde de l'employé";
    } elseif ($code == 5) {
        $motif = "Faute lourde de l'employeur";
    } elseif ($code == 6) {
        $motif = 'Licenciement sans préavis';
    } elseif ($code == 7) {
        $motif = 'Rétraite';
    } elseif ($code == 8) {
        $motif = "Séparation à l'amiable";
    }
    return $motif;
}

//FACTURATION
function CalculDateEcheance($dte, $nbrejr)
{
    $dte = dateToformatBdd($dte);
    $addjr = '+' . $nbrejr . 'days';
    $date_collect = date("Y-m-d", strtotime($dte . $addjr));
    $new_date_collect = $date_collect;
    $jour_collect = date("N", strtotime($new_date_collect));
    //6 signifie samedi et 7 dimanche
    if ($jour_collect == "7") {
        $new_date_collect = date("Y-m-d", strtotime($new_date_collect . " +1 days"));
        $jour_collect = date("N", strtotime($new_date_collect));
    }
    return $new_date_collect;
}

//verifie si une valeur est entier
function prixFacturation($prix, $tva)
{
    return $prix + $tva;
}

//verifie si une valeur est entier
function IsNombre($val)
{
    $bool = FALSE;
    if (is_numeric($val) && $val > 0) {
        $bool = TRUE;
    }
    return $bool;
}

//Montant Total de la facture
function totalMontantPayeFactureAll()
{
    $bdd = HDB::hus();
    $data = array();
    $data['montantpaye'] = array();
    $data['facture_ids'] = array();
    $total = 0;
    $req = "
        SELECT b.id_fact,SUM(e.montantusd*e.taux+e.montantcdf-e.rendu) AS montant_paye
            FROM  t_facture AS b, t_reglement AS d, paiement AS e
            WHERE b.id_fact=d.id_fact 
                  AND d.id_regl=e.regl_id 
                  GROUP BY b.id_fact
                ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id_fact);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $op) {
        $total = $op->montant_paye;
        $data['montantpaye'][$op->id_fact] = $total;
        array_push($data['facture_ids'], $op->id_fact);
    }
    return $data;
}
function totalMontantPayeFactureAllrec($bdd)
{
    //    $bdd = HDB::hus();
    $data = array();
    $data['montantpaye'] = array();
    $data['facture_ids'] = array();
    $total = 0;
    $req = "
        SELECT b.id_fact,SUM(e.montantusd*e.taux+e.montantcdf-e.rendu) AS montant_paye
            FROM  t_facture AS b, t_reglement AS d, paiement AS e
            WHERE b.id_fact=d.id_fact 
                  AND d.id_regl=e.regl_id 
                  GROUP BY b.id_fact
                ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id_fact);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $op) {
        $total = $op->montant_paye;
        $data['montantpaye'][$op->id_fact] = $total;
        array_push($data['facture_ids'], $op->id_fact);
    }
    return $data;
}
function totalMontantPayeFactureAll1()
{
    $bdd = HDB::hus();
    $data = array();
    $data['montantpaye'] = array();
    $data['facture_ids'] = array();
    $total = 0;
    $req = "
        SELECT b.id_fact,SUM(e.montantusd*e.taux+e.montantcdf-e.rendu) AS montant_paye,e.montant
            FROM  t_facture AS b, t_reglement AS d, paiement AS e
            WHERE b.id_fact=d.id_fact 
                  AND d.id_regl=e.regl_id 
                  GROUP BY b.id_fact
                ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id_fact);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $op) {
        $total = $op->montant;
        $data['montantpaye'][$op->id_fact] = $total;
        array_push($data['facture_ids'], $op->id_fact);
    }
    return $data;
}
//Recuperer le taux de la facture
function getTauxFacture2($monnaie_fact, $tauxdollar, $taux_fact)
{
    if ($monnaie_fact == getsymbole_devise()) {
        $taux_fact = $tauxdollar;
    } else {
        $taux_fact = $taux_fact;
    }
    return $taux_fact;
}

// TOUTES LES CONFIGURATIONS DU MODULE
function ConfigModule($module_id, $site_id)
{
    $requete = HDB::hus()->prepare("SELECT a.mail,a.nom_hotel,b.* FROM resconfig AS b,t_hotel AS a  WHERE a.id_hotel=b.site_id AND b.module_id=:module_id AND b.site_id=:site_id");
    $requete->BindParam(':module_id', $module_id);
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
    $config = $requete->fetch(PDO::FETCH_OBJ);
    $_SESSION['config_id'] = $config->id;
    $_SESSION['Paie_insert'] = $config->m_insert;
    $_SESSION['Paie_affiche'] = $config->m_affich;
    $_SESSION['Paie_taux'] = $config->taux;
    $_SESSION['Age_Lmt_Enfant_Bm'] = $config->age;
    $_SESSION['hopital_compagni'] = $config->hopital;
    $_SESSION['penalite'] = $config->penalite;
    $_SESSION['prefconge'] = $config->prefconge;
    $_SESSION['prefsanct'] = $config->prefsanct;
    $_SESSION['echeance'] = $config->echeance;
    $_SESSION['liestock'] = $config->liestock;
    $_SESSION['infofact'] = $config->infofact;
    $_SESSION['fuseauhoraire'] = $config->fuseauhoraire;
    $_SESSION['tva'] = $config->tva;
    $_SESSION['msgmail'] = $config->msgmail;
    $_SESSION['sujetmail'] = $config->sujetmail;
    $_SESSION['mailexp'] = $config->mail;
    $_SESSION['nomexp'] = $config->nom_hotel;
}

//Envoi Mail
function EmailSendFichier($expnom, $expadr, $destnom, $destadr, $sujet, $msg, $fichier, $mailobj)
{
    $mail = $mailobj;
    $mail->IsHTML(true);
    $mail->CharSet = "utf-8";
    // Expéditeur
    $mail->SetFrom($expadr, $expnom);
    // Destinataire
    $mail->AddAddress($destadr, $destnom);
    $mail->Subject = $sujet;
    $mail->MsgHTML($msg);
    $mail->AddStringAttachment($fichier, 'Facture.pdf', 'base64', 'application/pdf');
    if (!$mail->Send()) {
        //return 'Mail error: '.$mail->ErrorInfo;
        return FALSE;
    } else {
        return TRUE;
    }
}

function EmailSend2($to, $to_name, $subject, $body, $mail)
{
    $mail = new PHPMailer();
    $mail->IsHTML(true);
    $mail->CharSet = "utf-8";

    // Expéditeur
    $mail->SetFrom('info@ebutelo.com', 'Ebutelo sprl');

    // Destinataire
    $mail->AddAddress($to, $to_name);

    $mail->Subject = $subject;

    //$mail->Body = '<p><b>E-Mail</b> au format <i>HTML</i>.</p>';
    // On lit le contenu d'une page html
    //    $body = file_get_contents('page_mail.html');
    //$body ="Contenu du message en HTML";
    // On définit le contenu de cette page comme message
    $mail->MsgHTML($body);
    //    $mail->AddAttachment('./Fiche de stock.pdf');
    // Votre message
    //$mail->MsgHTML('Contenu du message en HTML');
    // Envoi du mail avec gestion des erreurs
    if (!$mail->Send()) {
        return 'Mail error: ' . $mail->ErrorInfo;
    } else {
        return true;
    }
}

//KING PAIEMENT
function MontantsFacture($facture_id)
{
    $_SESSION['datas_exist'] = 0;
    $_SESSION['montant_total'] = 0;
    $_SESSION['montant_paye'] = 0;
    $_SESSION['montant_a_paye'] = 0;
    $_SESSION['mode'] = "mode";
    $bdd = HDB::hus();
    $req = "
        SELECT b.mode,b.id_fact,mont_ttc_remise AS montant_total,SUM(e.montantusd*e.taux+e.montantcdf-e.rendu) AS montant_paye
            FROM  t_facture AS b, t_reglement AS d, paiement AS e
            WHERE b.id_fact=d.id_fact 
                  AND d.id_regl=e.regl_id
                  AND b.id_fact=:facture_id 
                  AND b.type='facturation'
                  GROUP BY b.id_fact
                ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':facture_id', $facture_id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $op) {
        $_SESSION['datas_exist'] = 1;
        $_SESSION['mode'] = $op->mode;
        $_SESSION['montant_total'] = $op->montant_total;
        $_SESSION['montant_paye'] = $op->montant_paye;
        $_SESSION['montant_a_paye'] = $op->montant_total - $op->montant_paye;
    }
}
function FxCLIENTS($site_id)
{
    $bdd = HDB::hus();
    $req = "
        SELECT COUNT(id_client) AS nbrcl
            FROM  t_client
            WHERE id_hotel=:site_id 
            GROUP BY id_hotel
                ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    $nbrcl = $result->nbrcl;
    // foreach ($result as $op) {
    //     $soldeusd+=montant_equivalent_bdd(getsymbole_local(),$maffiche, $op->taux,$op->montantusd);
    // }
    return $nbrcl;
}
function FxSOLDEUSD($maffiche, $site_id)
{
    $moisencours = date('m');
    $soldeusd = 0;
    $bdd = HDB::hus();
    $req = "
        SELECT e.montantusd,e.taux
            FROM  t_facture AS b, t_reglement AS d,paiement AS e
            WHERE b.id_fact=d.id_fact 
                  AND d.id_regl=e.regl_id
                  AND b.type='facturation'
                  AND b.id_hotel=:site_id 
                  AND EXTRACT(MONTH FROM d.date_regl)=:moisencours
                ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':site_id', $site_id);
    $requete->BindParam(':moisencours', $moisencours);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $op) {
        $soldeusd += $op->montantusd;
    }
    return $soldeusd;
}
function FxSOLDECDF($maffiche, $site_id)
{
    $moisencours = date('m');
    $soldecdf = 0;
    $bdd = HDB::hus();
    $req = "
        SELECT e.montantcdf,e.taux
            FROM  t_facture AS b, t_reglement AS d, paiement AS e
            WHERE b.id_fact=d.id_fact 
                  AND d.id_regl=e.regl_id
                  AND b.type='facturation'
                  AND b.id_hotel=:site_id 
                  AND EXTRACT(MONTH FROM d.date_regl)=:moisencours
                ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':site_id', $site_id);
    $requete->BindParam(':moisencours', $moisencours);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $op) {
        $soldecdf += $op->montantcdf;
    }
    return $soldecdf;
}
function FxPAYEES($maffiche, $site_id)
{
    $moisencours = date('m');
    $payees = 0;
    $bdd = HDB::hus();
    $req = "
        SELECT e.montant,e.taux
            FROM  t_facture AS b, t_reglement AS d, paiement AS e
            WHERE b.id_fact=d.id_fact 
                  AND d.id_regl=e.regl_id
                  AND b.type='facturation'
                  AND b.id_hotel=:site_id 
                  AND EXTRACT(MONTH FROM d.date_regl)=:moisencours
                ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':site_id', $site_id);
    $requete->BindParam(':moisencours', $moisencours);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $op) {
        $payees += montant_equivalent_bdd(getsymbole_local(), $maffiche, $op->taux, $op->montant);
    }
    return $payees;
}
function FxNONPAYEES($maffiche, $site_id)
{
    $moisencours = date('m');
    $payees = 0;
    $npayees = 0;
    $total = 0;
    $bdd = HDB::hus();
    $req = "
        SELECT e.montant,e.taux
            FROM  t_facture AS b, t_reglement AS d, paiement AS e
            WHERE b.id_fact=d.id_fact 
                  AND d.id_regl=e.regl_id
                  AND b.type='facturation'
                  AND b.id_hotel=:site_id 
                  AND EXTRACT(MONTH FROM d.date_regl)=:moisencours
                ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':site_id', $site_id);
    $requete->BindParam(':moisencours', $moisencours);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $op) {
        $payees += montant_equivalent_bdd(getsymbole_local(), $maffiche, $op->taux, $op->montant);
    }
    $req = "
        SELECT b.mont_ttc_remise,b.taux
            FROM  t_facture AS b
            WHERE b.type='facturation'
            AND b.id_hotel=:site_id 
            AND EXTRACT(MONTH FROM b.date_edition)=:moisencours
                ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':site_id', $site_id);
    $requete->BindParam(':moisencours', $moisencours);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $op) {
        $total += montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $op->taux, $op->mont_ttc_remise);
    }
    $npayees = $total - $payees;
    return $npayees;
}
//*************************************************
//Définition d'une fonction d'affichage en français
//*************************************************
function MoisEnFrancais($njour = 0)
{
    $timestamp = time() + $njour * 24 * 3600;
    //$semaine = array(" dimanche "," lundi "," mardi "," mercredi "," jeudi "," vendredi "," samedi ");
    $mois = array(1 => " janvier ", " février ", " mars ", " avril ", " mai ", " juin ", " juillet ", " août ", " septembre ", " octobre ", " novembre ", " décembre ");
    //$chdate= $semaine[date('w',$timestamp)] ." ".date('j',$timestamp)." ". $mois[date('n',$timestamp)];
    return $mois[date('n', $timestamp)];
}

function FxNombreFacture($mode, $site_id)
{
    $nbrefact = 0;
    $bdd = HDB::hus();
    $req = 'SELECT COUNT(*) AS nbrefact 
            FROM t_facture 
            WHERE type="facturation" 
            AND mode=:mode 
            AND id_hotel =:site_id';
    $requete = $bdd->prepare($req);
    $requete->BindParam(':mode', $mode);
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $op) {
        $nbrefact = $op->nbrefact;
    }
    return $nbrefact;
}

function FxNombreClient($site_id)
{
    $nbreclient = 0;
    $bdd = HDB::hus();
    $req = 'SELECT COUNT( * ) AS nbreclient
            FROM t_client
            WHERE type_cl = "facturation"
            AND id_hotel =:site_id';
    $requete = $bdd->prepare($req);
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $op) {
        $nbreclient = $op->nbreclient;
    }
    return $nbreclient;
}


// VERIFICATION
function verification($site_id, $libelle)
{
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
function selectCompteurSite($site_id, $libelle)
{
    $numero = 0;
    $requete = 'SELECT numero FROM compteur WHERE libelle=:libelle  AND site_id=:id';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':libelle', $libelle);
    $query->BindParam(':id', $site_id);
    try {
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        $numero = $result->numero;
        return $numero;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function InsertNumerotation($libelle, $num_cmd, $site_id)
{
    $bdd = HDB::hus();
    $query = $bdd->prepare("INSERT compteur (libelle,numero,site_id)
                                VALUES(:libelle,:numero,:site_id)");

    $query->BindParam(':libelle', $libelle);
    $query->BindParam(':numero', $num_cmd);
    $query->BindParam(':site_id', $site_id);
    $query->execute();
}
function getnumerotation($site_id, $libelle)
{
    $num_cmd = 1;
    $bool = verification($site_id, $libelle);
    if ($bool == 1) {
        $num_cmd = selectCompteurSite($site_id, $libelle);
    } else {
        InsertNumerotation($libelle, $num_cmd, $site_id);
    }
    return $num_cmd;
}

function InsertNewFactRecurente($numfacture, $type, $etat, $fact_recurente, $nbrejour, $dte_genfact, $dte_edit, $dte_ech, $monttotal_ht, $mont_tva, $mont_ttc, $montant_fact, $taux, $tva, $monnaie, $remise, $majoration, $justification, $id_hotel, $company_id, $id_user, $id_client)
{

    $libcptfact = NUMFACT;
    $num_cmd = getnumerotation($id_hotel, $libcptfact);
    $num_cmd_format = format_numero($num_cmd);
    $prefixefact = 'FAC/';
    $numfact = $prefixefact . $num_cmd_format;

    $bdd = HDB::hus();
    $query = $bdd->prepare("INSERT t_facture (num_fact,type,etat,etat_cmd,etat_sousresto,date_echeance_old,date_edition,date_echeance,montant_total,mont_tva,mont_ttc,mont_ttc_remise,taux,tva,monnaie,remise,majoration,justification,id_hotel,company_id,id_user,id_client)
                            VALUES(:num_fact,:type,:etat,:etat_cmd,:etat_sousresto,:date_echeance_old,:date_edition,:date_echeance,:montant_total,:mont_tva,:mont_ttc,:mont_ttc_remise,:taux,:tva,:monnaie,:remise,:majoration,:justification,:id_hotel,:company_id,:id_user,:id_client)");

    $query->BindParam(':num_fact', $numfact);
    $query->BindParam(':type', $type);
    $query->BindParam(':etat', $etat);
    $query->BindParam(':etat_cmd', $fact_recurente);
    $query->BindParam(':etat_sousresto', $nbrejour);
    $query->BindParam(':date_echeance_old', $dte_genfact);
    $query->BindParam(':date_edition', $dte_edit);
    $query->BindParam(':date_echeance', $dte_ech);
    $query->BindParam(':montant_total', $monttotal_ht);
    $query->BindParam(':mont_tva', $mont_tva);
    $query->BindParam(':mont_ttc', $mont_ttc);
    $query->BindParam(':mont_ttc_remise', $montant_fact);
    $query->BindParam(':taux', $taux);
    $query->BindParam(':tva', $tva);
    $query->BindParam(':monnaie', $monnaie);
    $query->BindParam(':remise', $remise);
    $query->BindParam(':majoration', $majoration);
    $query->BindParam(':justification', $justification);
    $query->BindParam(':id_hotel', $id_hotel);
    $query->BindParam(':company_id', $company_id);
    $query->BindParam(':id_user', $id_user);
    $query->BindParam(':id_client', $id_client);
    $query->execute();
}

function MiseSessionListeFact($num_fact, $date_edition, $date_echeance, $nom_client, $montantfact, $montant_paye, $solde)
{
    array_push($_SESSION['liste_fact']['num_fact'], $num_fact);
    array_push($_SESSION['liste_fact']['date_edition'], $date_edition);
    array_push($_SESSION['liste_fact']['date_echeance'], $date_echeance);
    array_push($_SESSION['liste_fact']['nom_client'], $nom_client);
    array_push($_SESSION['liste_fact']['montantfact'], $montantfact);
    array_push($_SESSION['liste_fact']['montant_paye'], $montant_paye);
    array_push($_SESSION['liste_fact']['solde'], $solde);
}

function VerifFactGen($date_recurente, $type, $hotel_id, $bdd)
{
    $bool = 0;
    //    $bdd = HDB::hus();
    $requete = 'SELECT COUNT(f.date_edition) AS nbre  FROM t_facture AS f 
                WHERE f.date_edition=:date_recurente AND f.type=:type
                 AND f.id_hotel=:id_hotel';
    $query = $bdd->prepare($requete);
    $query->BindParam(':date_recurente', $date_recurente);
    $query->BindParam(':type', $type);
    $query->BindParam(':id_hotel', $hotel_id);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    foreach ($result as $res)
        $bool = $res->nbre;
    return $bool;
}

function selectId_mode($mode)
{
    $requete = 'SELECT id_mode_regl FROM t_mode_reglement WHERE lib=:lib';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':lib', $mode);
    try {
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        $id_mode_regl = $result->id_mode_regl;
        return $id_mode_regl;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function ProdAndServ($sousresto_id, $idsite)
{
    //PRODUITS
    $requete = 'SELECT prod.designation AS produit,prod.statut,prod.idprod,prod.code,prod.pa,tprix.prix_vente AS pv,prod.qte_dispo,
                    prod.tva,prod.qte_initial,prod.qte_min,prod.unite, prod.monnaie
                    FROM stk_produit AS prod,t_prix_produit AS tprix
                    WHERE prod.pseudo_supp=0
					AND prod.idprod=tprix.produit_id
					AND tprix.sousresto_id=:sousresto_id
					ORDER BY prod.designation';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':sousresto_id', $sousresto_id);
    try {
        $query->execute();
        $produits = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    //SERVICES
    $requete = 'SELECT prod.designation AS produit,prod.statut,prod.idprod,prod.code,prod.pa,prod.pv,prod.qte_dispo,
                            prod.tva,prod.qte_initial,prod.qte_min,prod.unite, prod.monnaie
                            FROM stk_produit AS prod
                            WHERE prod.pseudo_supp=0 AND statut=5 ORDER BY prod.designation';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':id', $idsite);

    try {
        $query->execute();
        $services = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    $services_produits = array_merge($services, $produits);
    sort($services_produits);
    return $services_produits;
}


function format_chiffre2($mon)
{
    return number_format($mon, 2, ',', '');
}
function afficheMontant2($maffiche, $montant1)
{
    $montant1 = format_chiffre2($montant1);
    return $montant1 . ' ' . $maffiche;
}
function PaiementCreance($dte1, $dte2, $bdd)
{
    $total = 0;
    $idsite = $_SESSION['id_hotel'];
    $requete = $bdd->prepare("SELECT f.id_fact,f.taux,b.montantcdf,b.montantusd,b.rendu_cdf,b.rendu_usd
        FROM t_facture AS f,t_reglement AS fa,paiement AS b
        WHERE f.id_fact=fa.id_fact 
            AND fa.id_regl=b.regl_id
            AND f.mode='Acompte'
            AND b.id_mode_regl IN(4)
            AND fa.dte BETWEEN :dte1 AND :dte2
            AND  b.site_id=:id_hotel");
    $requete->BindParam(':id_hotel', $idsite);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $taux = $r->taux;
        $montantusd = $r->montantusd;
        $rendu_usd = $r->rendu_usd;
        $montantcdf = $r->montantcdf;
        $rendu_cdf = $r->rendu_cdf;
        $total += ($montantusd - $rendu_usd) + ($montantcdf - $rendu_cdf) / $taux;
    }
    return $total;
}
function DetailsVenteTout($date_bd1, $date_bd2, $bdd)
{
    $idsite = $_SESSION['id_hotel'];
    $requete = $bdd->prepare("SELECT b.prix AS prixremise,a.taux_prix,a.monnaie,a.mode,a.mont_ttc_remise,c.idprod,c.code, c.designation,c.repas,c.nourriture,
                SUM(b.qte) AS qte, b.prixremise AS pu, b.dte_h,a.mode AS lib,SUM((b.qte*b.prix)/a.taux_prix) AS mont,
                SUM(b.qteoffert) AS qteoffert,SUM(b.qteoffert*b.prix2) AS montof
            FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a,
            stk_sous_famille AS d
            WHERE a.id_fact=b.commande_id 
            AND b.produit_id= c.idprod
            AND c.famille_id=d.id_s_fam
            AND a.mode IS NOT NULL
            AND a.date_edition  BETWEEN :date_bd1 AND :date_bd2
            AND a.id_hotel  =:id_hotel 
            GROUP BY c.idprod, b.prix, a.mode  
            ORDER BY c.nourriture,c.designation");
    $requete->BindParam(':date_bd1', $date_bd1);
    $requete->BindParam(':date_bd2', $date_bd2);
    $requete->BindParam(':id_hotel', $idsite);
    $requete->execute();
    $articles3 = $requete->fetchAll(PDO::FETCH_OBJ);
    return $articles3;
}
function ExtraitDEcompteAll($id_hotel, $bdd)
{
    $data = array();
    $data['id'] = array();
    $data['client'] = array();
    $data['debit'] = array();
    $data['credit'] = array();
    $data['id_fact'] = array();
    $data['modepaie'] = array();


    $requete = $bdd->prepare("SELECT b.id_client,b.nom_client 
                                FROM t_facture AS a, t_client AS b 
                                WHERE a.id_client=b.id_client
                                AND a.type='facturation'
                                AND a.mode IN ('Credit','Acompte')
                                AND b.type='client'
                                AND b.id_hotel=:id_hotel
                                GROUP BY b.id_client
                                ORDER BY b.nom_client ASC");
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->execute();
    $clients = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($clients as $cli) {
        $idclient = $cli->id_client;
        $nom_client = $cli->nom_client;
        $debit = 0;
        $credit = 0;
        $requete = $bdd->prepare("SELECT * FROM t_facture AS a, t_client AS b 
                                WHERE a.id_client=b.id_client
                                     AND b.id_client=:idcl
                                     AND a.type='facturation'
                                     AND a.mode IN ('Credit','Acompte')
                                     ");
        $requete->BindParam(':idcl', $idclient);
        $requete->execute();
        $factures = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($factures as $fct) {
            $id_fact = $fct->id_fact;
            $modepaie = $fct->mode;
            $taux = $fct->taux;
            $monnaie = $fct->monnaie;
            $totalfact = $fct->mont_ttc_remise;
            if ($monnaie == 'CDF') {
                $debit += montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $taux, $totalfact);
            } else {
                $debit += $totalfact;
            }
            $requete = $bdd->prepare("SELECT * FROM t_reglement AS c, paiement AS d WHERE c.id_regl=d.regl_id AND c.id_fact=:id_fact ORDER BY c.dte");
            $requete->BindParam(':id_fact', $id_fact);
            $requete->execute();
            $paiements = $requete->fetchAll(PDO::FETCH_OBJ);
            $nbre = count($paiements);
            if ($nbre > 0) {
                foreach ($paiements as $p) {
                    $montantusd = $p->montantusd;
                    $montantcdf = $p->montantcdf;
                    $taux = $p->taux;
                    $credit += $montantusd + montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $taux, $montantcdf);
                }
            }
        }
        if ($debit > 0) {
            array_push($data['id'], $idclient);
            array_push($data['client'], $nom_client);
            array_push($data['debit'], $debit);
            array_push($data['credit'], $credit);
            array_push($data['id_fact'], $id_fact);
            array_push($data['modepaie'], $modepaie);
            
        }
    }
    return  $data;
}
function ExtraitDEcompte2($idclient, $bdd)
{
    $data = array();
    $data['id'] = array();
    $data['date'] = array();
    $data['numfact'] = array();
    $data['numrecu'] = array();
    $data['debitusd'] = array();
    $data['creditusd'] = array();
    $data['debitcdf'] = array();
    $data['creditcdf'] = array();
    $data['taux'] = array();
    $m_affiche = getsymbole_local();
    $requete = $bdd->prepare("SELECT * FROM t_facture AS a, t_client AS b 
                                WHERE a.id_client=b.id_client
                                     AND b.id_client=:idcl
                                     AND a.type='facturation'
                                     AND a.mode IN ('Credit','Acompte')
                                    ");
    $requete->BindParam(':idcl', $idclient);
    $requete->execute();
    $factures = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($factures as $fct) {
        $debitusd = 0;
        $debitcdf = 0;
        $numfact = $fct->num_fact;
        $id_fact = $fct->id_fact;
        $taux = $fct->taux;
        $monnaie = $fct->monnaie;
        $date_edition = $fct->date_edition;
        $totalfact = $fct->mont_ttc_remise;
        if ($monnaie == 'CDF') {
            $debitcdf = $totalfact;
        } else {
            $debitusd = $totalfact;
        }
        $requete = $bdd->prepare("SELECT * FROM t_reglement AS c, paiement AS d WHERE c.id_regl=d.regl_id AND c.id_fact=:id_fact ORDER BY c.dte");
        $requete->BindParam(':id_fact', $id_fact);
        $requete->execute();
        $paiements = $requete->fetchAll(PDO::FETCH_OBJ);

        $nbre = count($paiements);
        if ($nbre > 0) {
            foreach ($paiements as $p) {
                $creditusd = 0;
                $creditcdf = 0;
                $numrecu = $p->numero;
                $montantusd = $p->montantusd;
                $montantcdf = $p->montantcdf;
                $creditcdf = $montantcdf;
                $creditusd = $montantusd;
                $taux = $p->taux;
                array_push($data['id'], $id_fact);
                array_push($data['date'], $date_edition);
                if (!in_array($numfact, $data['numfact'])) {
                    array_push($data['numfact'], $numfact);
                } else {
                    array_push($data['numfact'], $numfact);
                    $debitcdf = 0;
                    $debitusd = 0;
                }
                array_push($data['numrecu'], $numrecu);
                array_push($data['debitcdf'], $debitcdf);
                array_push($data['creditcdf'], $creditcdf);
                array_push($data['debitusd'], $debitusd);
                array_push($data['creditusd'], $creditusd);
                array_push($data['taux'], $taux);
            }
        } else {
            array_push($data['id'], $id_fact);
            array_push($data['date'], $date_edition);
            array_push($data['numfact'], $numfact);
            array_push($data['numrecu'], '');
            array_push($data['debitcdf'], $debitcdf);
            array_push($data['creditcdf'], 0);
            array_push($data['debitusd'], $debitusd);
            array_push($data['creditusd'], 0);
            array_push($data['taux'], 1);
        }
    }

    return  $data;
}



//La Compta
function CreateAcountForCustomer($compte1, $compte2, $account, $nom_client, $site_id, $bdd)
{
    //RECHERCHE COMPTE CLIENT
    $nb = 0;
    $bool = 0;
    $requete = $bdd->prepare("SELECT COUNT(*) AS nb_lg FROM cptsouscomptes WHERE numero=:numero");
    $requete->BindParam(':numero', $account);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($operations as $op) :
        $nb = $op->nb_lg;
    endforeach;
    if ($nb > 0) $bool = 1;
    //RECHERCHE COMPTE CLIENT
    if ($bool == 0) {
        //CREATION COMPTE CLIENT
        $libelle_cpt = $nom_client;
        $numero = $account;
        $compte_id = '284';
        $psedo = 0;
        $modif = 0;
        $suffixe = $compte2;
        $requete = $bdd->prepare("INSERT INTO cptsouscomptes (libelle,numero,compte_id,psedo,modif,site_id,suffixe)
                                            VALUES(:libelle,:numero,:compte_id,:psedo,:modif,:site_id,:suffixe)");

        $requete->BindParam(':libelle', $libelle_cpt);
        $requete->BindParam(':numero', $numero);
        $requete->BindParam(':compte_id', $compte_id);
        $requete->BindParam(':psedo', $psedo);
        $requete->BindParam(':modif', $modif);
        $requete->BindParam(':site_id', $site_id);
        $requete->BindParam(':suffixe', $suffixe);
        $requete->execute();
        //CREATION COMPTE CLIENT

    }
    //SELECTION COMPTE
    $_SESSION['Customer_compte_ecriture'] = '4111';
    $_SESSION['Customer_long_compte'] = 4;
    $_SESSION['Customer_souscompte_id'] = 385;
    $_SESSION['Customer_categorie_id'] = 49;
    $_SESSION['Customer_compte_id'] = 284;
    $_SESSION['Customer_nom_client'] = '';
    $requete = $bdd->prepare("SELECT *,b.numero AS compte_ecriture,b.id AS souscompte_id FROM cptsouscomptes AS b,cptcomptes AS c,cptcategories AS d WHERE b.compte_id=c.id AND c.categorie_id=d.id AND b.numero=:numero AND b.psedo=0");
    $requete->BindParam(':numero', $account);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $_SESSION['Customer_compte_ecriture'] = $r->compte_ecriture;
        $_SESSION['Customer_long_compte'] = 4;
        $_SESSION['Customer_souscompte_id'] = $r->souscompte_id;
        $_SESSION['Customer_categorie_id'] = 49;
        $_SESSION['Customer_compte_id'] = 284;
        $_SESSION['Customer_nom_client'] = $nom_client;
    }
    //SELECTION COMPTE
}
function verifCompteurSite($site_id, $libelle, $bdd)
{
    $nb = 0;
    $bool = 0;
    $requete = $bdd->prepare("SELECT COUNT(*) AS nb_lg FROM compteur WHERE libelle=:libelle  AND site_id=:id_hotel");
    /* monnaie Mis pour les besoins de la cause */
    $requete->BindParam(':libelle', $libelle);
    $requete->BindParam(':id_hotel', $site_id);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($operations as $op) :
        $nb = $op->nb_lg;
    endforeach;
    if ($nb > 0) $bool = 1;
    return $bool;
}
function insertCompteurSite($site_id, $libelle, $numero, $bdd)
{
    $requete = $bdd->prepare("INSERT INTO compteur (libelle,numero,site_id)
                VALUES(:libelle,:numero,:site_id)");
    $requete->BindParam(':libelle', $libelle);
    $requete->BindParam(':numero', $numero);
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
}

function setnumerotation($site_id, $libelle, $numero, $bdd)
{
    $requete = $bdd->prepare("UPDATE compteur SET numero=:numero WHERE libelle=:libelle AND site_id=:site_id");
    $requete->BindParam(':numero', $numero);
    $requete->BindParam(':libelle', $libelle);
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
}
function EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd)
{

    $requete = $bdd->prepare("INSERT INTO cptecritures (dte,dteaff,dtetime,libelle,reference,beneficiaire,journal_id,psedo,exercice_id,user_id,site_id)
        VALUES(:dte,:dteaff,:dtetime,:libelle,:reference,:beneficiaire,:journal_id,:psedo,:exercice_id,:user_id,:site_id)");
    $requete->BindParam(':dte', $dte);
    $requete->BindParam(':dteaff', $dteaff);
    $requete->BindParam(':dtetime', $dtetime);
    $requete->BindParam(':libelle', $libelle);
    $requete->BindParam(':reference', $reference);
    $requete->BindParam(':beneficiaire', $beneficiaire);
    $requete->BindParam(':journal_id', $journal_id);
    $requete->BindParam(':psedo', $psedo);
    $requete->BindParam(':exercice_id', $exercice_id);
    $requete->BindParam(':user_id', $user_id);
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
    $id = $bdd->lastInsertId();
    return $id;
}

function DetailsEcritureCompta($compte_id, $debit, $credit, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd)
{

    $requete = $bdd->prepare("INSERT INTO cptdetailsecritures (compte_id,debit,credit,devise,taux,ecriture_id,site_id,categorie_id,souscompte_id,compte_ecriture,long_compte)
        VALUES(:compte_id,:debit,:credit,:devise,:taux,:ecriture_id,:site_id,:categorie_id,:souscompte_id,:compte_ecriture,:long_compte)");
    $requete->BindParam(':compte_id', $compte_id);
    $requete->BindParam(':debit', $debit);
    $requete->BindParam(':credit', $credit);
    $requete->BindParam(':devise', $devise);
    $requete->BindParam(':taux', $tauxop);
    $requete->BindParam(':ecriture_id', $ecriture_id);
    $requete->BindParam(':site_id', $site_id);
    $requete->BindParam(':categorie_id', $categorie_id);
    $requete->BindParam(':souscompte_id', $souscompte_id);
    $requete->BindParam(':compte_ecriture', $compte_ecriture);
    $requete->BindParam(':long_compte', $long_compte);
    $requete->execute();
    $id = $bdd->lastInsertId();
    return $id;
}

function ExerciceEncours($site_id, $bdd)
{
    $requete = 'SELECT id AS id_exercice,lib,fin,debut,cloture
    FROM  cptexercice
    WHERE  etat=1 AND site_id=:site_id';
    $query = $bdd->prepare($requete);
    $query->BindParam(':site_id', $site_id);
    $query->execute();
    $r = $query->fetch(PDO::FETCH_OBJ);
    $_SESSION['exercice_id'] = $r->id_exercice;
    $_SESSION['exercice_lib'] = $r->lib;
    $_SESSION['exercice_debut'] = $r->debut;
    $_SESSION['exercice_fin'] = $r->fin;
    $_SESSION['exercice_clot'] = $r->cloture;
}

function INFOSFromAccountNumber($compte_num, $format, $bdd)
{
    $data = array();
    $data['id'] = array();
    $data['lib'] = array();
    $id = 0;
    $lib = 0;
    if ($format == 2) {
        $requete = 'SELECT id,libelle FROM cptcategories WHERE numero=:compte_num';
        $query = $bdd->prepare($requete);
        $query->BindParam(':compte_num', $compte_num);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
            $id = $r->id;
            $lib = $r->libelle;
        }
    } else if ($format == 3) {
        $requete = 'SELECT id,libelle FROM cptcomptes WHERE numero=:compte_num';
        $query = $bdd->prepare($requete);
        $query->BindParam(':compte_num', $compte_num);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
            $id = $r->id;
            $lib = $r->libelle;
        }
    } else if ($format == 4) {
        $requete = 'SELECT id,libelle FROM cptsouscomptes WHERE numero=:compte_num';
        $query = $bdd->prepare($requete);
        $query->BindParam(':compte_num', $compte_num);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
            $id = $r->id;
            $lib = $r->libelle;
        }
    }
    $data['id'] = $id;
    $data['lib'] = $lib;
    return $data;
}

function TRESORERIE($entree, $libelle, $beneficiaire, $date_bon, $date_heure_bon, $montantFC, $montantUSD, $cpte_num, $id_user, $longcompte, $detail_id_ecrit, $lib_monnaie, $site_id, $bdd)
{
    $requete = $bdd->prepare("INSERT INTO t_operation (type,libelle,beneficiaire,date_bon,date_heure_bon,montantFC,
       montantUSD,numBordereau,mode_operation,session_id,motif_id,user_id,hotel_id,format,detail_id_ecrit)
       VALUES(:type,:libelle,:beneficiaire,:date_bon,:date_heure_bon,:montantFC
       ,:montantUSD,:numBordereau,:mode_operation,:session_id,
       :cpte_id,:user_id,:hotel_id,:format,:detail_id_ecrit)");
    $session_id = 1;
    $type_caisse = "normal";
    $numBordereau = "";
    $requete->BindParam(':type', $entree);
    $requete->BindParam(':libelle', $libelle);
    $requete->BindParam(':beneficiaire', $beneficiaire);
    $requete->BindParam(':date_bon', $date_bon);
    $requete->BindParam(':date_heure_bon', $date_heure_bon);
    $requete->BindParam(':montantFC', $montantFC);
    $requete->BindParam(':montantUSD', $montantUSD);
    $requete->BindParam(':numBordereau', $numBordereau);
    $requete->BindParam(':mode_operation', $type_caisse);
    $requete->BindParam(':session_id', $session_id);
    $requete->BindParam(':cpte_id', $cpte_num);
    $requete->BindParam(':user_id', $id_user);
    $requete->BindParam(':hotel_id', $site_id);
    $requete->BindParam(':format', $longcompte);
    $requete->BindParam(':detail_id_ecrit', $detail_id_ecrit);
    $requete->execute();
    $id_operation = $bdd->lastInsertId();
    //  Modification de numBon dans la bdd
    if ($entree == 'entree') {
        $pref = 'BE/';
    } else {
        $pref = 'BS/';
    }

    $num_cmd = getnumerotation($site_id, $lib_monnaie, $bdd);
    $numBon = $pref . str_pad($num_cmd, 4, "0", STR_PAD_LEFT); //001;
    $requete = $bdd->prepare("UPDATE t_operation  SET numBon =:numBon,type =:type WHERE idoperation=:idoperation");
    $requete->BindParam(':numBon', $numBon);
    $requete->BindParam(':type', $entree);
    $requete->BindParam(':idoperation', $id_operation);
    $requete->execute();
    $num_cmd += 1;
    setnumerotation($site_id, $lib_monnaie, $num_cmd, $bdd);
}

function ConfLinkMod($module_id, $site_id, $bdd)
{
    $_SESSION['ConfLinkMod'] = array();
    $_SESSION['ConfLinkMod']['compte_ecriture '] = array();
    $_SESSION['ConfLinkMod']['long_compte'] = array();
    $_SESSION['ConfLinkMod']['souscompte_id'] = array();
    $_SESSION['ConfLinkMod']['categorie_id'] = array();
    $_SESSION['ConfLinkMod']['compte_id'] = array();
    $_SESSION['ConfLinkMod']['libelle'] = array();
    $_SESSION['ConfLinkMod']['code'] = array();
    $_SESSION['ConfLinkMod']['champ'] = array();
    $_SESSION['ConfLinkMod_lie'] = 0;
    $requete = $bdd->prepare("SELECT * FROM cpt_liaison_module WHERE module_id=:module_id AND site_id=:site_id");
    $requete->BindParam(':module_id', $module_id);
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $_SESSION['ConfLinkMod_lie'] = $code = $r->lie;
        $code = $r->code;

        if (!in_array($code, $_SESSION['ConfLinkMod']['code'])) {
            array_push($_SESSION['ConfLinkMod']['code'], $code);
            $_SESSION['ConfLinkMod']['compte_ecriture'][$code] = $r->compte_ecriture;
            $_SESSION['ConfLinkMod']['long_compte'][$code] = $r->long_compte;
            $_SESSION['ConfLinkMod']['souscompte_id'][$code] = $r->souscompte_id;
            $_SESSION['ConfLinkMod']['categorie_id'][$code] = $r->categorie_id;
            $_SESSION['ConfLinkMod']['compte_id'][$code] = $r->compte_id;
            $_SESSION['ConfLinkMod']['libelle'][$code] = $r->libelle;
            $_SESSION['ConfLinkMod']['champ'][$code] = $r->champ;
        }
    }
}

function AccountCustomerProcess($id_client, $type_client, $bdd)
{
    //Pour les clients qui n'ont pas des comptes ils sont considere occasionnel
    $_SESSION['Customer_compte_ecriture'] = '4111';
    $_SESSION['Customer_long_compte'] = 4;
    $_SESSION['Customer_souscompte_id'] = 385;
    $_SESSION['Customer_categorie_id'] = 49;
    $_SESSION['Customer_compte_id'] = 284;

    $requete = $bdd->prepare("SELECT *,b.numero AS compte_ecriture,b.id AS souscompte_id FROM t_client AS a,cptsouscomptes AS b,cptcomptes AS c,cptcategories AS d WHERE a.id_sous_compte=b.id AND b.compte_id=c.id AND c.categorie_id=d.id AND a.id_client=:id_client AND b.psedo=0");
    $requete->BindParam(':id_client', $id_client);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        if ($type_client == "occasionnel") {

            $_SESSION['Customer_compte_ecriture'] = '4111';
            $_SESSION['Customer_long_compte'] = 4;
            $_SESSION['Customer_souscompte_id'] = 385;
            $_SESSION['Customer_categorie_id'] = 49;
            $_SESSION['Customer_compte_id'] = 284;
        } else {

            $_SESSION['Customer_compte_ecriture'] = $r->compte_ecriture;
            $_SESSION['Customer_long_compte'] = 4;
            $_SESSION['Customer_souscompte_id'] = $r->souscompte_id;
            $_SESSION['Customer_categorie_id'] = 49;
            $_SESSION['Customer_compte_id'] = 284;
        }
    }
}

function GetAccountCustomer($id_sous_compte, $bdd)
{

    $_SESSION['souscomptes_id'] = 0;
    $_SESSION['souscomptes_lib'] = '';
    $_SESSION['souscomptes_num'] = '';
    if ($id_sous_compte != Null) {
        $requete = 'SELECT id,libelle,numero
    FROM  cptsouscomptes
    WHERE  id=:id_sous_compte';
        $query = $bdd->prepare($requete);
        $query->BindParam(':id_sous_compte', $id_sous_compte);
        $query->execute();
        $r = $query->fetch(PDO::FETCH_OBJ);
        $_SESSION['souscomptes_id'] = $r->id;
        $_SESSION['souscomptes_lib'] = $r->libelle;
        $_SESSION['souscomptes_num'] = $r->numero;
    }
}

function COMPTA_VENTE_CASH_RESTO($type_rendu, $reference, $dte, $dtetime, $montantusd, $montantcdf, $montantsaisi, $ht, $tva, $ttc, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd)
{
    ExerciceEncours($site_id, $bdd);
    $exercice_id = $_SESSION['exercice_id'];
    $journal_id = 2;
    $montantcdf2 = 0;
    $montantusd2 = 0;
    $dteaff = $dte;
    $psedo = 0;
    //CAISSE CDF OU USD
    if ($montantcdf > 0 && $montantusd > 0) {

        $devisecdf = 'CDF';
        $deviseusd = 'USD';
        $ttc_cdf = montant_equivalent_bdd($devise, $devisecdf, $tauxop, $ttc);
        $ttc_usd = montant_equivalent_bdd($devise, $deviseusd, $tauxop, $ttc);

        if ($montantcdf >= $ttc_cdf) {

            $restecdf = $montantcdf - $ttc_cdf;
            $montantcdf = $ttc_cdf;
            $resteusd = $montantusd;
            //Ecriture Monnaie locale
            $devise_op = 'CDF';
            $libelle = 'Facturation : paiement vente cash en CDF';
            $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
            //TVA FACTUREE SUR VENTE
            $montanttva = 0;
            if ($tva != 0) {
                $montanttva = ($montantcdf * $tva) / 100;
                $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TVA'];
                $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TVA'];
                $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TVA'];
                $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TVA'];
                $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TVA'];
                $debit = 0;
                $credit = $montanttva;
                DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
                //GENERATION RAPPORT
                $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
                $libcompte = $data['lib'];
                $compte = $compte_ecriture . ' ' . $libcompte;
                $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
                       VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
                $requete->BindParam(':dte', $dte);
                $requete->BindParam(':ref', $reference);
                $requete->BindParam(':compte', $compte);
                $requete->BindParam(':description', $libelle);
                $requete->BindParam(':debit', $debit);
                $requete->BindParam(':credit', $credit);
                $requete->BindParam(':devise', $devise_op);
                $requete->BindParam(':journal_id', $journal_id);
                $requete->BindParam(':exercice_id', $exercice_id);
                $requete->BindParam(':site_id', $site_id);
                $requete->BindParam(':ecriture_id', $ecriture_id);
                $requete->execute();
            }
            //TVA FACTUREE SUR VENTE
            $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESLOC'];
            $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESLOC'];
            $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESLOC'];
            $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESLOC'];
            $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESLOC'];
            $debit = $montantcdf;
            $credit = 0;
            $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
            //tresorerie
            $entree = 'entree';
            $date_bon = $dte;
            $date_heure_bon = $dtetime;
            $montantFC = $montantcdf;
            $montantUSD = 0;
            $cpte_num = $compte_ecriture;
            $id_user = $user_id;
            $longcompte = 4;
            $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
            $lib_monnaie = 'entreecdf';
            TRESORERIE($entree, $libelle, $beneficiaire, $date_bon, $date_heure_bon, $montantFC, $montantUSD, $cpte_num, $id_user, $longcompte, $detail_id_ecrit, $lib_monnaie, $site_id, $bdd);
            //GENERATION RAPPORT
            $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
            $libcompte = $data['lib'];
            $compte = $compte_ecriture . ' ' . $libcompte;
            $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
                   VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
            $requete->BindParam(':dte', $dte);
            $requete->BindParam(':ref', $reference);
            $requete->BindParam(':compte', $compte);
            $requete->BindParam(':description', $libelle);
            $requete->BindParam(':debit', $debit);
            $requete->BindParam(':credit', $credit);
            $requete->BindParam(':devise', $devise_op);
            $requete->BindParam(':journal_id', $journal_id);
            $requete->BindParam(':exercice_id', $exercice_id);
            $requete->BindParam(':site_id', $site_id);
            $requete->BindParam(':ecriture_id', $ecriture_id);
            $requete->execute();
            $ht = $montantcdf - $montanttva;

            //VENTE MARCHANDISE OU VENTE PRODUIT FINI
            $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['PROSERV'];
            $long_compte = $_SESSION['ConfLinkMod']['long_compte']['PROSERV'];
            $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['PROSERV'];
            $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['PROSERV'];
            $compte_id = $_SESSION['ConfLinkMod']['compte_id']['PROSERV'];
            $debit = 0;
            $credit = $ht;
            DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
            //GENERATION RAPPORT
            $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
            $libcompte = $data['lib'];
            $compte = $compte_ecriture . ' ' . $libcompte;
            $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
                   VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
            $requete->BindParam(':dte', $dte);
            $requete->BindParam(':ref', $reference);
            $requete->BindParam(':compte', $compte);
            $requete->BindParam(':description', $libelle);
            $requete->BindParam(':debit', $debit);
            $requete->BindParam(':credit', $credit);
            $requete->BindParam(':devise', $devise_op);
            $requete->BindParam(':journal_id', $journal_id);
            $requete->BindParam(':exercice_id', $exercice_id);
            $requete->BindParam(':site_id', $site_id);
            $requete->BindParam(':ecriture_id', $ecriture_id);
            $requete->execute();
            //VENTE MARCHANDISE OU VENTE PRODUIT FINI

        } elseif ($montantusd >= $ttc_usd) {

            $resteusd = $montantusd - $ttc_usd;
            $montantusd = $ttc_usd;
            $restecdf = $montantcdf;
            //Ecriture Monnaie etrangere
            $libelle = 'Facturation : paiement vente cash en USD';
            $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
            $devise_op = 'USD';
            //TVA FACTUREE SUR VENTE
            $montanttva = 0;
            if ($tva != 0) {
                $montanttva = ($montantusd * $tva) / 100;
                $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TVA'];
                $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TVA'];
                $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TVA'];
                $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TVA'];
                $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TVA'];
                $debit = 0;
                $credit = $montanttva;
                $libelledescrpt = '';
                $numdoc = '';
                DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
                //GENERATION RAPPORT
                $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
                $libcompte = $data['lib'];
                $compte = $compte_ecriture . ' ' . $libcompte;
                $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
                       VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
                $requete->BindParam(':dte', $dte);
                $requete->BindParam(':ref', $reference);
                $requete->BindParam(':compte', $compte);
                $requete->BindParam(':description', $libelle);
                $requete->BindParam(':debit', $debit);
                $requete->BindParam(':credit', $credit);
                $requete->BindParam(':devise', $devise_op);
                $requete->BindParam(':journal_id', $journal_id);
                $requete->BindParam(':exercice_id', $exercice_id);
                $requete->BindParam(':site_id', $site_id);
                $requete->BindParam(':ecriture_id', $ecriture_id);
                $requete->execute();
            }
            //TVA FACTUREE SUR VENTE
            $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESETR'];
            $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESETR'];
            $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESETR'];
            $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESETR'];
            $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESETR'];
            $debit = $montantusd;
            $credit = 0;
            $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
            //tresorerie
            $entree = 'entree';
            $date_bon = $dte;
            $date_heure_bon = $dtetime;
            $montantFC = 0;
            $montantUSD = $montantusd;
            $cpte_num = $compte_ecriture;
            $id_user = $user_id;
            $longcompte = 4;
            $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
            $lib_monnaie = 'entreeusd';
            TRESORERIE($entree, $libelle, $beneficiaire, $date_bon, $date_heure_bon, $montantFC, $montantUSD, $cpte_num, $id_user, $longcompte, $detail_id_ecrit, $lib_monnaie, $site_id, $bdd);
            //GENERATION RAPPORT
            $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
            $libcompte = $data['lib'];
            $compte = $compte_ecriture . ' ' . $libcompte;
            $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
                   VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
            $requete->BindParam(':dte', $dte);
            $requete->BindParam(':ref', $reference);
            $requete->BindParam(':compte', $compte);
            $requete->BindParam(':description', $libelle);
            $requete->BindParam(':debit', $debit);
            $requete->BindParam(':credit', $credit);
            $requete->BindParam(':devise', $devise_op);
            $requete->BindParam(':journal_id', $journal_id);
            $requete->BindParam(':exercice_id', $exercice_id);
            $requete->BindParam(':site_id', $site_id);
            $requete->BindParam(':ecriture_id', $ecriture_id);
            $requete->execute();
            $ht = $montantusd - $montanttva;
            //VENTE MARCHANDISE OU VENTE PRODUIT FINI
            $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['PROSERV'];
            $long_compte = $_SESSION['ConfLinkMod']['long_compte']['PROSERV'];
            $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['PROSERV'];
            $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['PROSERV'];
            $compte_id = $_SESSION['ConfLinkMod']['compte_id']['PROSERV'];
            $debit = 0;
            $credit = $ht;
            DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
            //GENERATION RAPPORT
            $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
            $libcompte = $data['lib'];
            $compte = $compte_ecriture . ' ' . $libcompte;
            $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
                   VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
            $requete->BindParam(':dte', $dte);
            $requete->BindParam(':ref', $reference);
            $requete->BindParam(':compte', $compte);
            $requete->BindParam(':description', $libelle);
            $requete->BindParam(':debit', $debit);
            $requete->BindParam(':credit', $credit);
            $requete->BindParam(':devise', $devise_op);
            $requete->BindParam(':journal_id', $journal_id);
            $requete->BindParam(':exercice_id', $exercice_id);
            $requete->BindParam(':site_id', $site_id);
            $requete->BindParam(':ecriture_id', $ecriture_id);
            $requete->execute();
            //VENTE MARCHANDISE OU VENTE PRODUIT FINI



        } elseif ($montantcdf < $ttc_cdf) {

            $restecdf = 0;
            $soldecdf = $ttc_cdf - $montantcdf;
            $soldeusd = montant_equivalent_bdd($devisecdf, $deviseusd, $tauxop, $soldecdf);
            $resteusd = $montantusd - $soldeusd;
            if ($montantusd >= $soldeusd) {
                $montantusd = $soldeusd;
            }
            //Ecriture Monnaie etrangere
            $libelle = 'Facturation : paiement vente cash en CDF';
            $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
            $devise_op = 'CDF';
            //TVA FACTUREE SUR VENTE
            $montanttva = 0;
            if ($tva != 0) {
                $montanttva = ($montantcdf * $tva) / 100;
                $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TVA'];
                $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TVA'];
                $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TVA'];
                $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TVA'];
                $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TVA'];
                $debit = 0;
                $credit = $montanttva;

                DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
                //GENERATION RAPPORT
                $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
                $libcompte = $data['lib'];
                $compte = $compte_ecriture . ' ' . $libcompte;
                $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
                   VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
                $requete->BindParam(':dte', $dte);
                $requete->BindParam(':ref', $reference);
                $requete->BindParam(':compte', $compte);
                $requete->BindParam(':description', $libelle);
                $requete->BindParam(':debit', $debit);
                $requete->BindParam(':credit', $credit);
                $requete->BindParam(':devise', $devise_op);
                $requete->BindParam(':journal_id', $journal_id);
                $requete->BindParam(':exercice_id', $exercice_id);
                $requete->BindParam(':site_id', $site_id);
                $requete->BindParam(':ecriture_id', $ecriture_id);
                $requete->execute();
            }
            //TVA FACTUREE SUR VENTE
            $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESLOC'];
            $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESLOC'];
            $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESLOC'];
            $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESLOC'];
            $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESLOC'];
            $debit = $montantcdf;
            $credit = 0;
            $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
            //tresorerie
            $entree = 'entree';
            $date_bon = $dte;
            $date_heure_bon = $dtetime;
            $montantFC = $montantcdf;
            $montantUSD = 0;
            $cpte_num = $compte_ecriture;
            $id_user = $user_id;
            $longcompte = 4;
            $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
            $lib_monnaie = 'entreeusd';
            TRESORERIE($entree, $libelle, $beneficiaire, $date_bon, $date_heure_bon, $montantFC, $montantUSD, $cpte_num, $id_user, $longcompte, $detail_id_ecrit, $lib_monnaie, $site_id, $bdd);
            //GENERATION RAPPORT
            $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
            $libcompte = $data['lib'];
            $compte = $compte_ecriture . ' ' . $libcompte;
            $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
               VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
            $requete->BindParam(':dte', $dte);
            $requete->BindParam(':ref', $reference);
            $requete->BindParam(':compte', $compte);
            $requete->BindParam(':description', $libelle);
            $requete->BindParam(':debit', $debit);
            $requete->BindParam(':credit', $credit);
            $requete->BindParam(':devise', $devise_op);
            $requete->BindParam(':journal_id', $journal_id);
            $requete->BindParam(':exercice_id', $exercice_id);
            $requete->BindParam(':site_id', $site_id);
            $requete->BindParam(':ecriture_id', $ecriture_id);
            $requete->execute();
            $ht = $montantcdf - $montanttva;
            //VENTE MARCHANDISE OU VENTE PRODUIT FINI
            $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['PROSERV'];
            $long_compte = $_SESSION['ConfLinkMod']['long_compte']['PROSERV'];
            $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['PROSERV'];
            $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['PROSERV'];
            $compte_id = $_SESSION['ConfLinkMod']['compte_id']['PROSERV'];
            $debit = 0;
            $credit = $ht;
            $libelledescrpt = '';
            $numdoc = '';
            DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
            //GENERATION RAPPORT
            $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
            $libcompte = $data['lib'];
            $compte = $compte_ecriture . ' ' . $libcompte;
            $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
               VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
            $requete->BindParam(':dte', $dte);
            $requete->BindParam(':ref', $reference);
            $requete->BindParam(':compte', $compte);
            $requete->BindParam(':description', $libelle);
            $requete->BindParam(':debit', $debit);
            $requete->BindParam(':credit', $credit);
            $requete->BindParam(':devise', $devise_op);
            $requete->BindParam(':journal_id', $journal_id);
            $requete->BindParam(':exercice_id', $exercice_id);
            $requete->BindParam(':site_id', $site_id);
            $requete->BindParam(':ecriture_id', $ecriture_id);
            $requete->execute();
            //VENTE MARCHANDISE OU VENTE PRODUIT FINI
            //COMPLEMENT PAIEMENT USD
            $libelle = 'Facturation : complement paiement en USD';
            $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
            $montantusd2 = $montantusd;
            $deviseusd = 'USD';
            $montant_ttc = montant_equivalent_bdd($devise, $deviseusd, $tauxop, $ttc);
            if ($montantusd > $montant_ttc) {
                $montantusd = $montant_ttc;
            }
            $devise_op = 'USD';
            //TVA FACTUREE SUR VENTE
            $montanttva = 0;
            if ($tva != 0) {
                $montanttva = ($montantusd * $tva) / 100;
                $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TVA'];
                $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TVA'];
                $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TVA'];
                $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TVA'];
                $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TVA'];
                $debit = 0;
                $credit = $montanttva;
                DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
                //GENERATION RAPPORT
                $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
                $libcompte = $data['lib'];
                $compte = $compte_ecriture . ' ' . $libcompte;
                $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
                VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
                $requete->BindParam(':dte', $dte);
                $requete->BindParam(':ref', $reference);
                $requete->BindParam(':compte', $compte);
                $requete->BindParam(':description', $libelle);
                $requete->BindParam(':debit', $debit);
                $requete->BindParam(':credit', $credit);
                $requete->BindParam(':devise', $devise_op);
                $requete->BindParam(':journal_id', $journal_id);
                $requete->BindParam(':exercice_id', $exercice_id);
                $requete->BindParam(':site_id', $site_id);
                $requete->BindParam(':ecriture_id', $ecriture_id);
                $requete->execute();
            }
            //TVA FACTUREE SUR VENTE
            $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESETR'];
            $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESETR'];
            $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESETR'];
            $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESETR'];
            $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESETR'];
            $debit = $montantusd;
            $credit = 0;
            $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
            //tresorerie
            $entree = 'entree';
            $date_bon = $dte;
            $date_heure_bon = $dtetime;
            $montantFC = 0;
            $montantUSD = $montantusd;
            $cpte_num = $compte_ecriture;
            $id_user = $user_id;
            $longcompte = 4;
            $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
            $lib_monnaie = 'entreeusd';
            TRESORERIE($entree, $libelle, $beneficiaire, $date_bon, $date_heure_bon, $montantFC, $montantUSD, $cpte_num, $id_user, $longcompte, $detail_id_ecrit, $lib_monnaie, $site_id, $bdd);
            //GENERATION RAPPORT
            $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
            $libcompte = $data['lib'];
            $compte = $compte_ecriture . ' ' . $libcompte;
            $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
            VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
            $requete->BindParam(':dte', $dte);
            $requete->BindParam(':ref', $reference);
            $requete->BindParam(':compte', $compte);
            $requete->BindParam(':description', $libelle);
            $requete->BindParam(':debit', $debit);
            $requete->BindParam(':credit', $credit);
            $requete->BindParam(':devise', $devise_op);
            $requete->BindParam(':journal_id', $journal_id);
            $requete->BindParam(':exercice_id', $exercice_id);
            $requete->BindParam(':site_id', $site_id);
            $requete->BindParam(':ecriture_id', $ecriture_id);
            $requete->execute();
            $ht = $montantusd - $montanttva;

            //VENTE MARCHANDISE OU VENTE PRODUIT FINI
            $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['PROSERV'];
            $long_compte = $_SESSION['ConfLinkMod']['long_compte']['PROSERV'];
            $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['PROSERV'];
            $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['PROSERV'];
            $compte_id = $_SESSION['ConfLinkMod']['compte_id']['PROSERV'];
            $debit = 0;
            $credit = $ht;
            DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
            //GENERATION RAPPORT
            $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
            $libcompte = $data['lib'];
            $compte = $compte_ecriture . ' ' . $libcompte;
            $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
             VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
            $requete->BindParam(':dte', $dte);
            $requete->BindParam(':ref', $reference);
            $requete->BindParam(':compte', $compte);
            $requete->BindParam(':description', $libelle);
            $requete->BindParam(':debit', $debit);
            $requete->BindParam(':credit', $credit);
            $requete->BindParam(':devise', $devise_op);
            $requete->BindParam(':journal_id', $journal_id);
            $requete->BindParam(':exercice_id', $exercice_id);
            $requete->BindParam(':site_id', $site_id);
            $requete->BindParam(':ecriture_id', $ecriture_id);
            $requete->execute();
            //VENTE MARCHANDISE OU VENTE PRODUIT FINI
        }
    } elseif ($montantcdf > 0) {
        $libelle = 'Facturation : paiement vente cash en CDF';
        $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
        $devisecdf = 'CDF';
        $montant_ttc = montant_equivalent_bdd($devise, $devisecdf, $tauxop, $ttc);
        if ($montantcdf > $montant_ttc) {
            $montantcdf = $montant_ttc;
        }
        $devise_op = 'CDF';
        //TVA FACTUREE SUR VENTE
        $montanttva = 0;
        if ($tva != 0) {
            $montanttva = ($montantcdf * $tva) / 100;
            $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TVA'];
            $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TVA'];
            $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TVA'];
            $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TVA'];
            $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TVA'];
            $debit = 0;
            $credit = $montanttva;
            DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
            //GENERATION RAPPORT
            $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
            $libcompte = $data['lib'];
            $compte = $compte_ecriture . ' ' . $libcompte;
            $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
            VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
            $requete->BindParam(':dte', $dte);
            $requete->BindParam(':ref', $reference);
            $requete->BindParam(':compte', $compte);
            $requete->BindParam(':description', $libelle);
            $requete->BindParam(':debit', $debit);
            $requete->BindParam(':credit', $credit);
            $requete->BindParam(':devise', $devise_op);
            $requete->BindParam(':journal_id', $journal_id);
            $requete->BindParam(':exercice_id', $exercice_id);
            $requete->BindParam(':site_id', $site_id);
            $requete->BindParam(':ecriture_id', $ecriture_id);
            $requete->execute();
        }
        //TVA FACTUREE SUR VENTE
        $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESLOC'];
        $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESLOC'];
        $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESLOC'];
        $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESLOC'];
        $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESLOC'];
        $debit = $montantcdf;
        $credit = 0;
        $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
        //tresorerie
        $entree = 'entree';
        $date_bon = $dte;
        $date_heure_bon = $dtetime;
        $montantFC = $montantcdf;
        $montantUSD = 0;
        $cpte_num = $compte_ecriture;
        $id_user = $user_id;
        $longcompte = 4;
        $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
        $lib_monnaie = 'entreecdf';
        TRESORERIE($entree, $libelle, $beneficiaire, $date_bon, $date_heure_bon, $montantFC, $montantUSD, $cpte_num, $id_user, $longcompte, $detail_id_ecrit, $lib_monnaie, $site_id, $bdd);
        //GENERATION RAPPORT
        $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
        $libcompte = $data['lib'];
        $compte = $compte_ecriture . ' ' . $libcompte;
        $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
        VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
        $requete->BindParam(':dte', $dte);
        $requete->BindParam(':ref', $reference);
        $requete->BindParam(':compte', $compte);
        $requete->BindParam(':description', $libelle);
        $requete->BindParam(':debit', $debit);
        $requete->BindParam(':credit', $credit);
        $requete->BindParam(':devise', $devise_op);
        $requete->BindParam(':journal_id', $journal_id);
        $requete->BindParam(':exercice_id', $exercice_id);
        $requete->BindParam(':site_id', $site_id);
        $requete->BindParam(':ecriture_id', $ecriture_id);
        $requete->execute();
        $ht = $montantcdf - $montanttva;

        //VENTE MARCHANDISE OU VENTE PRODUIT FINI
        $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['PROSERV'];
        $long_compte = $_SESSION['ConfLinkMod']['long_compte']['PROSERV'];
        $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['PROSERV'];
        $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['PROSERV'];
        $compte_id = $_SESSION['ConfLinkMod']['compte_id']['PROSERV'];
        $debit = 0;
        $credit = $ht;
        DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
        //GENERATION RAPPORT
        $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
        $libcompte = $data['lib'];
        $compte = $compte_ecriture . ' ' . $libcompte;
        $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
        VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
        $requete->BindParam(':dte', $dte);
        $requete->BindParam(':ref', $reference);
        $requete->BindParam(':compte', $compte);
        $requete->BindParam(':description', $libelle);
        $requete->BindParam(':debit', $debit);
        $requete->BindParam(':credit', $credit);
        $requete->BindParam(':devise', $devise_op);
        $requete->BindParam(':journal_id', $journal_id);
        $requete->BindParam(':exercice_id', $exercice_id);
        $requete->BindParam(':site_id', $site_id);
        $requete->BindParam(':ecriture_id', $ecriture_id);
        $requete->execute();
        //VENTE MARCHANDISE OU VENTE PRODUIT FINI
    } elseif ($montantusd > 0) {
        $libelle = 'Facturation : paiement vente cash en USD';
        $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
        $deviseusd = 'USD';
        $montant_ttc = montant_equivalent_bdd($devise, $deviseusd, $tauxop, $ttc);
        if ($montantusd > $ttc) {
            $montantusd = $montant_ttc;
        }
        $devise_op = 'USD';
        //TVA FACTUREE SUR VENTE
        $montanttva = 0;
        if ($tva != 0) {
            $montanttva = ($montantusd * $tva) / 100;
            $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TVA'];
            $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TVA'];
            $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TVA'];
            $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TVA'];
            $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TVA'];
            $debit = 0;
            $credit = $montanttva;
            DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
            //GENERATION RAPPORT
            $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
            $libcompte = $data['lib'];
            $compte = $compte_ecriture . ' ' . $libcompte;
            $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
            VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
            $requete->BindParam(':dte', $dte);
            $requete->BindParam(':ref', $reference);
            $requete->BindParam(':compte', $compte);
            $requete->BindParam(':description', $libelle);
            $requete->BindParam(':debit', $debit);
            $requete->BindParam(':credit', $credit);
            $requete->BindParam(':devise', $devise_op);
            $requete->BindParam(':journal_id', $journal_id);
            $requete->BindParam(':exercice_id', $exercice_id);
            $requete->BindParam(':site_id', $site_id);
            $requete->BindParam(':ecriture_id', $ecriture_id);
            $requete->execute();
        }
        //TVA FACTUREE SUR VENTE
        $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESETR'];
        $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESETR'];
        $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESETR'];
        $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESETR'];
        $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESETR'];
        $debit = $montantusd;
        $credit = 0;
        $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
        //tresorerie
        $entree = 'entree';
        $date_bon = $dte;
        $date_heure_bon = $dtetime;
        $montantFC = 0;
        $montantUSD = $montantusd;
        $cpte_num = $compte_ecriture;
        $id_user = $user_id;
        $longcompte = 4;
        $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
        $lib_monnaie = 'entreeusd';
        TRESORERIE($entree, $libelle, $beneficiaire, $date_bon, $date_heure_bon, $montantFC, $montantUSD, $cpte_num, $id_user, $longcompte, $detail_id_ecrit, $lib_monnaie, $site_id, $bdd);
        //GENERATION RAPPORT
        $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
        $libcompte = $data['lib'];
        $compte = $compte_ecriture . ' ' . $libcompte;
        $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
        VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
        $requete->BindParam(':dte', $dte);
        $requete->BindParam(':ref', $reference);
        $requete->BindParam(':compte', $compte);
        $requete->BindParam(':description', $libelle);
        $requete->BindParam(':debit', $debit);
        $requete->BindParam(':credit', $credit);
        $requete->BindParam(':devise', $devise_op);
        $requete->BindParam(':journal_id', $journal_id);
        $requete->BindParam(':exercice_id', $exercice_id);
        $requete->BindParam(':site_id', $site_id);
        $requete->BindParam(':ecriture_id', $ecriture_id);
        $requete->execute();
        $ht = $montantusd - $montanttva;
        //VENTE MARCHANDISE OU VENTE PRODUIT FINI
        $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['PROSERV'];
        $long_compte = $_SESSION['ConfLinkMod']['long_compte']['PROSERV'];
        $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['PROSERV'];
        $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['PROSERV'];
        $compte_id = $_SESSION['ConfLinkMod']['compte_id']['PROSERV'];
        $debit = 0;
        $credit = $ht;
        DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
        //GENERATION RAPPORT
        $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
        $libcompte = $data['lib'];
        $compte = $compte_ecriture . ' ' . $libcompte;
        $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
        VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
        $requete->BindParam(':dte', $dte);
        $requete->BindParam(':ref', $reference);
        $requete->BindParam(':compte', $compte);
        $requete->BindParam(':description', $libelle);
        $requete->BindParam(':debit', $debit);
        $requete->BindParam(':credit', $credit);
        $requete->BindParam(':devise', $devise_op);
        $requete->BindParam(':journal_id', $journal_id);
        $requete->BindParam(':exercice_id', $exercice_id);
        $requete->BindParam(':site_id', $site_id);
        $requete->BindParam(':ecriture_id', $ecriture_id);
        $requete->execute();
        //VENTE MARCHANDISE OU VENTE PRODUIT FINI

    }
}



function COMPTA_VENTE_CREDIT_RESTO($type_rendu, $reference, $dte, $dtetime, $montantusd, $montantcdf, $montantsaisi, $ht, $tva, $ttc, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd)
{
    ExerciceEncours($site_id, $bdd);
    $exercice_id = $_SESSION['exercice_id'];
    $journal_id = 2;
    $montantcdf2 = 0;
    $montantusd2 = 0;
    $dteaff = $dte;
    $psedo = 0;
    $libelle = 'Facturation : Vente à credit';
    $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
    //VENTE MARCHANDISE OU VENTE PRODUIT FINI
    $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['PROSERV'];
    $long_compte = $_SESSION['ConfLinkMod']['long_compte']['PROSERV'];
    $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['PROSERV'];
    $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['PROSERV'];
    $compte_id = $_SESSION['ConfLinkMod']['compte_id']['PROSERV'];
    $debit = 0;
    $credit = $ht;
    DetailsEcritureCompta($compte_id, $debit, $credit, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
    //GENERATION RAPPORT
    $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
    $libcompte = $data['lib'];
    $compte = $compte_ecriture . ' ' . $libcompte;
    $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
       VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
    $requete->BindParam(':dte', $dte);
    $requete->BindParam(':ref', $reference);
    $requete->BindParam(':compte', $compte);
    $requete->BindParam(':description', $libelle);
    $requete->BindParam(':debit', $debit);
    $requete->BindParam(':credit', $credit);
    $requete->BindParam(':devise', $devise);
    $requete->BindParam(':journal_id', $journal_id);
    $requete->BindParam(':exercice_id', $exercice_id);
    $requete->BindParam(':site_id', $site_id);
    $requete->BindParam(':ecriture_id', $ecriture_id);
    $requete->execute();
    //VENTE MARCHANDISE OU VENTE PRODUIT FINI
    //TVA FACTUREE SUR 
    if ($tva != 0) {
        $montanttva = ($ttc * $tva) / 100;
        $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TVA'];
        $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TVA'];
        $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TVA'];
        $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TVA'];
        $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TVA'];
        $debit = 0;
        $credit = $montanttva;
        DetailsEcritureCompta($compte_id, $debit, $credit, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
        //GENERATION RAPPORT
        $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
        $libcompte = $data['lib'];
        $compte = $compte_ecriture . ' ' . $libcompte;
        $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
           VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
        $requete->BindParam(':dte', $dte);
        $requete->BindParam(':ref', $reference);
        $requete->BindParam(':compte', $compte);
        $requete->BindParam(':description', $libelle);
        $requete->BindParam(':debit', $debit);
        $requete->BindParam(':credit', $credit);
        $requete->BindParam(':devise', $devise);
        $requete->BindParam(':journal_id', $journal_id);
        $requete->BindParam(':exercice_id', $exercice_id);
        $requete->BindParam(':site_id', $site_id);
        $requete->BindParam(':ecriture_id', $ecriture_id);
        $requete->execute();
    }
    //TVA FACTUREE SUR VENTE
    //CLIENT
    $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
    $long_compte = $_SESSION['Customer_long_compte'];
    $souscompte_id = $_SESSION['Customer_souscompte_id'];
    $categorie_id = $_SESSION['Customer_categorie_id'];
    $compte_id = $_SESSION['Customer_compte_id'];
    $debit = $ttc;
    $credit = 0;
    DetailsEcritureCompta($compte_id, $debit, $credit, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
    //GENERATION RAPPORT
    $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
    $libcompte = $data['lib'];
    $compte = $compte_ecriture . ' ' . $libcompte;
    $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
       VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
    $requete->BindParam(':dte', $dte);
    $requete->BindParam(':ref', $reference);
    $requete->BindParam(':compte', $compte);
    $requete->BindParam(':description', $libelle);
    $requete->BindParam(':debit', $debit);
    $requete->BindParam(':credit', $credit);
    $requete->BindParam(':devise', $devise);
    $requete->BindParam(':journal_id', $journal_id);
    $requete->BindParam(':exercice_id', $exercice_id);
    $requete->BindParam(':site_id', $site_id);
    $requete->BindParam(':ecriture_id', $ecriture_id);
    $requete->execute();
    //CLIENT
}

function COMPTA_PAIE_RESTO($reference, $montantusd, $montantcdf, $montantsaisi, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd, $ttc)
{

    //CAISSE CDF OU USD
    $deviseusd = 'USD';
    $ttc_usd = montant_equivalent_bdd($devise, $deviseusd, $tauxop, $ttc);
    $devisecdf = 'CDF';
    $ttc_cdf = montant_equivalent_bdd($devise, $devisecdf, $tauxop, $ttc);

    if ($montantusd > 0 && $montantcdf > 0) {
        if ($montantusd >= $ttc_usd) {
            $resteusd = $montantusd - $ttc_usd;
            $montantusd = $ttc_usd;
            ExerciceEncours($site_id, $bdd);
            $exercice_id = $_SESSION['exercice_id'];
            $journal_id = 3;
            $dte = date('Y-m-d');
            $dteaff = $dte;
            $dtetime = date('Y-m-d H:i:s');
            $psedo = 0;
            $libelle = "Facturation : Paiement en USD";
            $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
            $deviseusd = "USD";
            $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESETR'];
            $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESETR'];
            $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESETR'];
            $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESETR'];
            $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESETR'];
            $debit = $montantusd;
            $credit = 0;
            $libelledescrpt = '';
            $numdoc = '';
            $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $deviseusd, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
            //tresorerie
            $entree = 'entree';
            $date_bon = $dte;
            $date_heure_bon = $dtetime;
            $montantFC = 0;
            $montantUSD = $montantusd;
            $cpte_num = $compte_ecriture;
            $id_user = $user_id;
            $longcompte = 4;
            $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
            $lib_monnaie = 'entreeusd';
            TRESORERIE($entree, $libelle, $beneficiaire, $date_bon, $date_heure_bon, $montantFC, $montantUSD, $cpte_num, $id_user, $longcompte, $detail_id_ecrit, $lib_monnaie, $site_id, $bdd);

            //GENERATION RAPPORT
            $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
            $libcompte = $data['lib'];
            $compte = $compte_ecriture . ' ' . $libcompte;
            $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
               VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
            $requete->BindParam(':dte', $dte);
            $requete->BindParam(':ref', $reference);
            $requete->BindParam(':compte', $compte);
            $requete->BindParam(':description', $libelle);
            $requete->BindParam(':debit', $debit);
            $requete->BindParam(':credit', $credit);
            $requete->BindParam(':devise', $deviseusd);
            $requete->BindParam(':journal_id', $journal_id);
            $requete->BindParam(':exercice_id', $exercice_id);
            $requete->BindParam(':site_id', $site_id);
            $requete->BindParam(':ecriture_id', $ecriture_id);
            $requete->execute();
            //COMPTE CLIENT
            $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
            $long_compte = $_SESSION['Customer_long_compte'];
            $souscompte_id = $_SESSION['Customer_souscompte_id'];
            $categorie_id = $_SESSION['Customer_categorie_id'];
            $compte_id = $_SESSION['Customer_compte_id'];
            $debit = 0;
            $credit = $montantusd;
            $libelledescrpt = '';
            $numdoc = '';
            DetailsEcritureCompta($compte_id, $debit, $credit, $deviseusd, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
            //GENERATION RAPPORT
            $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
            $libcompte = $data['lib'];
            $compte = $compte_ecriture . ' ' . $libcompte;
            $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
               VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
            $requete->BindParam(':dte', $dte);
            $requete->BindParam(':ref', $reference);
            $requete->BindParam(':compte', $compte);
            $requete->BindParam(':description', $libelle);
            $requete->BindParam(':debit', $debit);
            $requete->BindParam(':credit', $credit);
            $requete->BindParam(':devise', $deviseusd);
            $requete->BindParam(':journal_id', $journal_id);
            $requete->BindParam(':exercice_id', $exercice_id);
            $requete->BindParam(':site_id', $site_id);
            $requete->BindParam(':ecriture_id', $ecriture_id);
            $requete->execute();
            //COMPTE CLIENT  

        } elseif ($montantcdf >= $ttc_cdf) {
            $restecdf = $montantcdf - $ttc_cdf;
            $montantcdf = $ttc_cdf;
            ExerciceEncours($site_id, $bdd);
            $exercice_id = $_SESSION['exercice_id'];
            $journal_id = 3;
            $dte = date('Y-m-d');
            $dteaff = $dte;
            $dtetime = date('Y-m-d H:i:s');
            $psedo = 0;
            $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
            $devisecdf = 'CDF';
            $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESLOC'];
            $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESLOC'];
            $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESLOC'];
            $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESLOC'];
            $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESLOC'];
            $debit = $montantcdf;
            $credit = 0;
            $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $devisecdf, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
            //tresorerie
            $entree = 'entree';
            $date_bon = $dte;
            $date_heure_bon = $dtetime;
            $montantFC = $montantcdf;
            $montantUSD = 0;
            $cpte_num = $compte_ecriture;
            $id_user = $user_id;
            $longcompte = 4;
            $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
            $lib_monnaie = 'entreecdf';
            TRESORERIE($entree, $libelle, $beneficiaire, $date_bon, $date_heure_bon, $montantFC, $montantUSD, $cpte_num, $id_user, $longcompte, $detail_id_ecrit, $lib_monnaie, $site_id, $bdd);
            //GENERATION RAPPORT
            $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
            $libcompte = $data['lib'];
            $compte = $compte_ecriture . ' ' . $libcompte;
            $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
               VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
            $requete->BindParam(':dte', $dte);
            $requete->BindParam(':ref', $reference);
            $requete->BindParam(':compte', $compte);
            $requete->BindParam(':description', $libelle);
            $requete->BindParam(':debit', $debit);
            $requete->BindParam(':credit', $credit);
            $requete->BindParam(':devise', $devisecdf);
            $requete->BindParam(':journal_id', $journal_id);
            $requete->BindParam(':exercice_id', $exercice_id);
            $requete->BindParam(':site_id', $site_id);
            $requete->BindParam(':ecriture_id', $ecriture_id);
            $requete->execute();
            //COMPTE CLIENT
            $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
            $long_compte = $_SESSION['Customer_long_compte'];
            $souscompte_id = $_SESSION['Customer_souscompte_id'];
            $categorie_id = $_SESSION['Customer_categorie_id'];
            $compte_id = $_SESSION['Customer_compte_id'];
            $debit = 0;
            $credit = $montantcdf;
            DetailsEcritureCompta($compte_id, $debit, $credit, $devisecdf, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
            //GENERATION RAPPORT
            $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
            $libcompte = $data['lib'];
            $compte = $compte_ecriture . ' ' . $libcompte;
            $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
               VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
            $requete->BindParam(':dte', $dte);
            $requete->BindParam(':ref', $reference);
            $requete->BindParam(':compte', $compte);
            $requete->BindParam(':description', $libelle);
            $requete->BindParam(':debit', $debit);
            $requete->BindParam(':credit', $credit);
            $requete->BindParam(':devise', $devisecdf);
            $requete->BindParam(':journal_id', $journal_id);
            $requete->BindParam(':exercice_id', $exercice_id);
            $requete->BindParam(':site_id', $site_id);
            $requete->BindParam(':ecriture_id', $ecriture_id);
            $requete->execute();
            //COMPTE CLIENT   
        } elseif ($montantusd < $ttc_usd) {
            $devisecdf = 'CDF';
            $deviseusd = 'USD';
            $resteusd = 0;
            $soldeusd = $ttc_usd - $montantusd;
            $soldecdf = montant_equivalent_bdd($deviseusd, $devisecdf, $tauxop, $soldeusd);
            $restecdf = $montantcdf - $soldecdf;
            $montantcdf = $soldecdf;
            //paiement en usd
            ExerciceEncours($site_id, $bdd);
            $exercice_id = $_SESSION['exercice_id'];
            $journal_id = 3;
            $dte = date('Y-m-d');
            $dteaff = $dte;
            $dtetime = date('Y-m-d H:i:s');
            $psedo = 0;
            $libelle = "Facturation : Paiement en USD";
            $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
            $deviseusd = "USD";
            $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESETR'];
            $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESETR'];
            $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESETR'];
            $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESETR'];
            $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESETR'];
            $debit = $montantusd;
            $credit = 0;
            $libelledescrpt = '';
            $numdoc = '';
            $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $deviseusd, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
            //tresorerie
            $entree = 'entree';
            $date_bon = $dte;
            $date_heure_bon = $dtetime;
            $montantFC = 0;
            $montantUSD = $montantusd;
            $cpte_num = $compte_ecriture;
            $id_user = $user_id;
            $longcompte = 4;
            $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
            $lib_monnaie = 'entreeusd';
            TRESORERIE($entree, $libelle, $beneficiaire, $date_bon, $date_heure_bon, $montantFC, $montantUSD, $cpte_num, $id_user, $longcompte, $detail_id_ecrit, $lib_monnaie, $site_id, $bdd);

            //GENERATION RAPPORT
            $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
            $libcompte = $data['lib'];
            $compte = $compte_ecriture . ' ' . $libcompte;
            $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
            VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
            $requete->BindParam(':dte', $dte);
            $requete->BindParam(':ref', $reference);
            $requete->BindParam(':compte', $compte);
            $requete->BindParam(':description', $libelle);
            $requete->BindParam(':debit', $debit);
            $requete->BindParam(':credit', $credit);
            $requete->BindParam(':devise', $deviseusd);
            $requete->BindParam(':journal_id', $journal_id);
            $requete->BindParam(':exercice_id', $exercice_id);
            $requete->BindParam(':site_id', $site_id);
            $requete->BindParam(':ecriture_id', $ecriture_id);
            $requete->execute();
            //COMPTE CLIENT
            $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
            $long_compte = $_SESSION['Customer_long_compte'];
            $souscompte_id = $_SESSION['Customer_souscompte_id'];
            $categorie_id = $_SESSION['Customer_categorie_id'];
            $compte_id = $_SESSION['Customer_compte_id'];
            $debit = 0;
            $credit = $montantusd;
            $libelledescrpt = '';
            $numdoc = '';
            DetailsEcritureCompta($compte_id, $debit, $credit, $deviseusd, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
            //GENERATION RAPPORT
            $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
            $libcompte = $data['lib'];
            $compte = $compte_ecriture . ' ' . $libcompte;
            $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
            VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
            $requete->BindParam(':dte', $dte);
            $requete->BindParam(':ref', $reference);
            $requete->BindParam(':compte', $compte);
            $requete->BindParam(':description', $libelle);
            $requete->BindParam(':debit', $debit);
            $requete->BindParam(':credit', $credit);
            $requete->BindParam(':devise', $deviseusd);
            $requete->BindParam(':journal_id', $journal_id);
            $requete->BindParam(':exercice_id', $exercice_id);
            $requete->BindParam(':site_id', $site_id);
            $requete->BindParam(':ecriture_id', $ecriture_id);
            $requete->execute();
            //COMPTE CLIENT  
            //paiement en usd

            //paiement en cdf
            ExerciceEncours($site_id, $bdd);
            $exercice_id = $_SESSION['exercice_id'];
            $journal_id = 3;
            $dte = date('Y-m-d');
            $dteaff = $dte;
            $dtetime = date('Y-m-d H:i:s');
            $psedo = 0;
            $libelle = "Facturation : Paiement en CDF";
            $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
            $devisecdf = 'CDF';
            $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESLOC'];
            $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESLOC'];
            $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESLOC'];
            $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESLOC'];
            $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESLOC'];
            $debit = $montantcdf;
            $credit = 0;
            $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $devisecdf, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
            //tresorerie
            $entree = 'entree';
            $date_bon = $dte;
            $date_heure_bon = $dtetime;
            $montantFC = $montantcdf;
            $montantUSD = 0;
            $cpte_num = $compte_ecriture;
            $id_user = $user_id;
            $longcompte = 4;
            $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
            $lib_monnaie = 'entreecdf';
            TRESORERIE($entree, $libelle, $beneficiaire, $date_bon, $date_heure_bon, $montantFC, $montantUSD, $cpte_num, $id_user, $longcompte, $detail_id_ecrit, $lib_monnaie, $site_id, $bdd);
            //GENERATION RAPPORT
            $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
            $libcompte = $data['lib'];
            $compte = $compte_ecriture . ' ' . $libcompte;
            $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
           VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
            $requete->BindParam(':dte', $dte);
            $requete->BindParam(':ref', $reference);
            $requete->BindParam(':compte', $compte);
            $requete->BindParam(':description', $libelle);
            $requete->BindParam(':debit', $debit);
            $requete->BindParam(':credit', $credit);
            $requete->BindParam(':devise', $devisecdf);
            $requete->BindParam(':journal_id', $journal_id);
            $requete->BindParam(':exercice_id', $exercice_id);
            $requete->BindParam(':site_id', $site_id);
            $requete->BindParam(':ecriture_id', $ecriture_id);
            $requete->execute();
            //COMPTE CLIENT
            $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
            $long_compte = $_SESSION['Customer_long_compte'];
            $souscompte_id = $_SESSION['Customer_souscompte_id'];
            $categorie_id = $_SESSION['Customer_categorie_id'];
            $compte_id = $_SESSION['Customer_compte_id'];
            $debit = 0;
            $credit = $montantcdf;
            DetailsEcritureCompta($compte_id, $debit, $credit, $devisecdf, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
            //GENERATION RAPPORT
            $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
            $libcompte = $data['lib'];
            $compte = $compte_ecriture . ' ' . $libcompte;
            $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
           VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
            $requete->BindParam(':dte', $dte);
            $requete->BindParam(':ref', $reference);
            $requete->BindParam(':compte', $compte);
            $requete->BindParam(':description', $libelle);
            $requete->BindParam(':debit', $debit);
            $requete->BindParam(':credit', $credit);
            $requete->BindParam(':devise', $devisecdf);
            $requete->BindParam(':journal_id', $journal_id);
            $requete->BindParam(':exercice_id', $exercice_id);
            $requete->BindParam(':site_id', $site_id);
            $requete->BindParam(':ecriture_id', $ecriture_id);
            $requete->execute();
            //COMPTE CLIENT   
            //paiement en cdf

        }
    } elseif ($montantcdf > 0) {
        $restecdf = 0;
        if ($montantcdf > $ttc_cdf) {
            $restecdf = $montantcdf - $ttc_cdf;
            $montantcdf = $ttc_cdf;
        }

        ExerciceEncours($site_id, $bdd);
        $exercice_id = $_SESSION['exercice_id'];
        $journal_id = 3;
        $dte = date('Y-m-d');
        $dteaff = $dte;
        $dtetime = date('Y-m-d H:i:s');
        $psedo = 0;
        $libelle = "Facturation : Paiement en CDF";
        $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
        $devisecdf = 'CDF';
        $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESLOC'];
        $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESLOC'];
        $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESLOC'];
        $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESLOC'];
        $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESLOC'];
        $debit = $montantcdf;
        $credit = 0;
        $libelledescrpt = '';
        $numdoc = '';
        $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $devisecdf, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
        //tresorerie
        $entree = 'entree';
        $date_bon = $dte;
        $date_heure_bon = $dtetime;
        $montantFC = $montantcdf;
        $montantUSD = 0;
        $cpte_num = $compte_ecriture;
        $id_user = $user_id;
        $longcompte = 4;
        $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
        $lib_monnaie = 'entreecdf';
        TRESORERIE($entree, $libelle, $beneficiaire, $date_bon, $date_heure_bon, $montantFC, $montantUSD, $cpte_num, $id_user, $longcompte, $detail_id_ecrit, $lib_monnaie, $site_id, $bdd);
        //GENERATION RAPPORT
        $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
        $libcompte = $data['lib'];
        $compte = $compte_ecriture . ' ' . $libcompte;
        $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
       VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
        $requete->BindParam(':dte', $dte);
        $requete->BindParam(':ref', $reference);
        $requete->BindParam(':compte', $compte);
        $requete->BindParam(':description', $libelle);
        $requete->BindParam(':debit', $debit);
        $requete->BindParam(':credit', $credit);
        $requete->BindParam(':devise', $devisecdf);
        $requete->BindParam(':journal_id', $journal_id);
        $requete->BindParam(':exercice_id', $exercice_id);
        $requete->BindParam(':site_id', $site_id);
        $requete->BindParam(':ecriture_id', $ecriture_id);
        $requete->execute();
        //COMPTE CLIENT
        $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
        $long_compte = $_SESSION['Customer_long_compte'];
        $souscompte_id = $_SESSION['Customer_souscompte_id'];
        $categorie_id = $_SESSION['Customer_categorie_id'];
        $compte_id = $_SESSION['Customer_compte_id'];
        $debit = 0;
        $credit = $montantcdf;
        DetailsEcritureCompta($compte_id, $debit, $credit, $devisecdf, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
        //GENERATION RAPPORT
        $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
        $libcompte = $data['lib'];
        $compte = $compte_ecriture . ' ' . $libcompte;
        $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
       VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
        $requete->BindParam(':dte', $dte);
        $requete->BindParam(':ref', $reference);
        $requete->BindParam(':compte', $compte);
        $requete->BindParam(':description', $libelle);
        $requete->BindParam(':debit', $debit);
        $requete->BindParam(':credit', $credit);
        $requete->BindParam(':devise', $devisecdf);
        $requete->BindParam(':journal_id', $journal_id);
        $requete->BindParam(':exercice_id', $exercice_id);
        $requete->BindParam(':site_id', $site_id);
        $requete->BindParam(':ecriture_id', $ecriture_id);
        $requete->execute();
        //COMPTE CLIENT   

    } elseif ($montantusd > 0) {
        $resteusd = 0;
        if ($montantusd > $ttc_usd) {
            $resteusd = $montantusd - $ttc_usd;
            $montantusd = $ttc_usd;
        }
        ExerciceEncours($site_id, $bdd);
        $exercice_id = $_SESSION['exercice_id'];
        $journal_id = 3;
        $dte = date('Y-m-d');
        $dteaff = $dte;
        $dtetime = date('Y-m-d H:i:s');
        $psedo = 0;
        $libelle = "Facturation : Paiement en USD";
        $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
        $deviseusd = "USD";
        $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESETR'];
        $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESETR'];
        $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESETR'];
        $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESETR'];
        $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESETR'];
        $debit = $montantusd;
        $credit = 0;
        $libelledescrpt = '';
        $numdoc = '';
        $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $deviseusd, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
        //tresorerie
        $entree = 'entree';
        $date_bon = $dte;
        $date_heure_bon = $dtetime;
        $montantFC = 0;
        $montantUSD = $montantusd;
        $cpte_num = $compte_ecriture;
        $id_user = $user_id;
        $longcompte = 4;
        $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
        $lib_monnaie = 'entreeusd';
        TRESORERIE($entree, $libelle, $beneficiaire, $date_bon, $date_heure_bon, $montantFC, $montantUSD, $cpte_num, $id_user, $longcompte, $detail_id_ecrit, $lib_monnaie, $site_id, $bdd);

        //GENERATION RAPPORT
        $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
        $libcompte = $data['lib'];
        $compte = $compte_ecriture . ' ' . $libcompte;
        $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
       VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
        $requete->BindParam(':dte', $dte);
        $requete->BindParam(':ref', $reference);
        $requete->BindParam(':compte', $compte);
        $requete->BindParam(':description', $libelle);
        $requete->BindParam(':debit', $debit);
        $requete->BindParam(':credit', $credit);
        $requete->BindParam(':devise', $deviseusd);
        $requete->BindParam(':journal_id', $journal_id);
        $requete->BindParam(':exercice_id', $exercice_id);
        $requete->BindParam(':site_id', $site_id);
        $requete->BindParam(':ecriture_id', $ecriture_id);
        $requete->execute();
        //COMPTE CLIENT
        $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
        $long_compte = $_SESSION['Customer_long_compte'];
        $souscompte_id = $_SESSION['Customer_souscompte_id'];
        $categorie_id = $_SESSION['Customer_categorie_id'];
        $compte_id = $_SESSION['Customer_compte_id'];
        $debit = 0;
        $credit = $montantusd;
        $libelledescrpt = '';
        $numdoc = '';
        DetailsEcritureCompta($compte_id, $debit, $credit, $deviseusd, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
        //GENERATION RAPPORT
        $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
        $libcompte = $data['lib'];
        $compte = $compte_ecriture . ' ' . $libcompte;
        $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
       VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
        $requete->BindParam(':dte', $dte);
        $requete->BindParam(':ref', $reference);
        $requete->BindParam(':compte', $compte);
        $requete->BindParam(':description', $libelle);
        $requete->BindParam(':debit', $debit);
        $requete->BindParam(':credit', $credit);
        $requete->BindParam(':devise', $deviseusd);
        $requete->BindParam(':journal_id', $journal_id);
        $requete->BindParam(':exercice_id', $exercice_id);
        $requete->BindParam(':site_id', $site_id);
        $requete->BindParam(':ecriture_id', $ecriture_id);
        $requete->execute();
        //COMPTE CLIENT 
    }
    //CAISSE CDF OU USD

}


//La Compta