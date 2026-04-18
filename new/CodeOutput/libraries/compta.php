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
date_default_timezone_set('Africa/Kinshasa');
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
        $_SESSION['menu'] = 'restaurant';
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
function format_chiffre2($mon)
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
        if ($dte >= $dte1 && $dte <= $dte2) $bool = 1;
    }
    array_push($_SESSION['EmployCG']['id'], $id);
    $_SESSION['EmployCG']['bool'][$id] = $bool;
    $_SESSION['EmployCG']['transport'][$id] = $transport;
}
function ValidationPointagetraite($horaire_id, $dte_in, $dbt, $fin, $site_id, $respointmdl)
{
    /* LISTE  DES AGENTS D'UN HORAIRE */
    $_SESSION['employe'] = array();
    $_SESSION['employe']['employe_id'] = array();
    $_SESSION['employe']['idpoint'] = array();
    $_SESSION['employe']['depart'] = array();

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
    /* APERCU LISTE DE PRESENCE */
    $afich = 1;
    $query = $bdd->prepare("UPDATE respointage SET afich=:afich WHERE dte_in=:dte_in  AND horaire_id=:horaire_id");
    $query->BindParam(':afich', $afich);
    $query->BindParam(':dte_in', $dte_in);
    $query->BindParam(':horaire_id', $horaire_id);
    $query->execute();
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

    /* INSERTION DES ABSENTS */

    foreach ($result1 as $res1) {
        $employe_id = $res1->employe_id;
        //insertion des agents qui sont en congé
        DatasEmployCG($employe_id);
        if ($_SESSION['EmployCG']['bool'][$employe_id] == 1) {
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
        //fin insertion
        $afich = 1;
        $motif = 'A';
        $absence = 1;
        $presence = 0;
        if (!in_array($employe_id, $_SESSION['employe']['employe_id'])) {
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
    /* vider table tampon depart */
    $query = $bdd->prepare("DELETE FROM restmp_pointage WHERE idsite=:idsite  AND horaire_id=:horaire_id");
    $query->BindParam(':idsite', $site_id);
    $query->BindParam(':horaire_id', $horaire_id);
    $query->execute();
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

    if ($reste > 0) $bool = 1;
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
            if ($j == 1) $j = '01';
            if ($j == 2) $j = '02';
            if ($j == 3) $j = '03';
            if ($j == 4) $j = '04';
            if ($j == 5) $j = '05';
            if ($j == 6) $j = '06';
            if ($j == 7) $j = '07';
            if ($j == 8) $j = '08';
            if ($j == 9) $j = '09';
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
        $mois = (string)$mois;
        $anne = (string)$anne;
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
            if ($j == 1) $j = '01';
            if ($j == 2) $j = '02';
            if ($j == 3) $j = '03';
            if ($j == 4) $j = '04';
            if ($j == 5) $j = '05';
            if ($j == 6) $j = '06';
            if ($j == 7) $j = '07';
            if ($j == 8) $j = '08';
            if ($j == 9) $j = '09';

            if ($mois == 1) $moisl = '01';
            if ($mois == 2) $moisl = '02';
            if ($mois == 3) $moisl = '03';
            if ($mois == 4) $moisl = '04';
            if ($mois == 5) $moisl = '05';
            if ($mois == 6) $moisl = '06';
            if ($mois == 7) $moisl = '07';
            if ($mois == 8) $moisl = '08';
            if ($mois == 9) $moisl = '09';
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
        $mois = (string)$mois;
        $anne = (string)$anne;
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
            if ($j == 1) $j = '01';
            if ($j == 2) $j = '02';
            if ($j == 3) $j = '03';
            if ($j == 4) $j = '04';
            if ($j == 5) $j = '05';
            if ($j == 6) $j = '06';
            if ($j == 7) $j = '07';
            if ($j == 8) $j = '08';
            if ($j == 9) $j = '09';
            if ($mois == 1) $mois = '01';
            if ($mois == 2) $mois = '02';
            if ($mois == 3) $mois = '03';
            if ($mois == 4) $mois = '04';
            if ($mois == 5) $mois = '05';
            if ($mois == 6) $mois = '06';
            if ($mois == 7) $mois = '07';
            if ($mois == 8) $mois = '08';
            if ($mois == 9) $mois = '09';
            $j = (string)$j;
            $mois = (string)$mois;
            $anne = (string)$anne;
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
        $mois = (string)$mois;
        $anne = (string)$anne;
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
        if ($dte >= $dte1 && $dte <= $dte2) $bool = 1;
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
        if ($dte >= $dte1 && $dte <= $dte2) $bool = 1;
    }
    return $bool;
}


function NJrs($dte1, $dte2)
{
    $dte1 = strtotime($dte1);
    $dte2 = strtotime($dte2);
    $njrs = ceil(abs($dte2  - $dte1) / 86400);
    return $njrs;
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
    $njrs_ancien = (int)($nombre_annee / $param_ancien);
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

//COMPTABILITE
function GetListComptes($bdd)
{
    $requete = $bdd->prepare("SELECT a.*,b.libelle AS categorie,c.libelle AS classe
 FROM cptcomptes AS a,cptcategories AS b,cptclasses AS c
 WHERE a.categorie_id=b.id AND b.classe_id=c.id AND a.psedo=0 ORDER BY a.numero");
    $requete->execute();
    $comptes = $requete->fetchAll(PDO::FETCH_OBJ);
    return $comptes;
}
function PlanComptable($bdd)
{
    $requete = $bdd->prepare("SELECT * FROM cptclasses AS a ORDER BY a.numero ASC");
    $requete->execute();
    $classes = $requete->fetchAll(PDO::FETCH_OBJ);
    $_SESSION['Comptes'] = array();
    $_SESSION['Comptes']['id'] = array();
    $_SESSION['Comptes']['numero'] = array();
    $_SESSION['Comptes']['nom'] = array();
    $_SESSION['Comptes']['classe'] = array();
    $_SESSION['Comptes']['modif'] = array();
    foreach ($classes as $r) {
        $classe_id = $r->id;
        $classe_num = $r->numero;
        $classe_lib = $r->libelle;
        $requete = $bdd->prepare("SELECT * FROM cptcategories AS b WHERE b.classe_id=:classe_id ORDER BY b.numero ASC");
        $requete->BindParam(':classe_id', $classe_id);
        $requete->execute();
        $categories = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($categories as $r) {
            $categorie_id = $r->id;
            $categorie_num = $r->numero;
            $categorie_lib = $r->libelle;
            array_push($_SESSION['Comptes']['id'], $categorie_id);
            array_push($_SESSION['Comptes']['numero'], $categorie_num);
            array_push($_SESSION['Comptes']['nom'], $categorie_lib);
            array_push($_SESSION['Comptes']['classe'], $classe_lib);
            array_push($_SESSION['Comptes']['modif'], 0);
            $requete = $bdd->prepare("SELECT * FROM cptcomptes AS c WHERE c.categorie_id=:categorie_id ORDER BY c.numero ASC");
            $requete->BindParam(':categorie_id', $categorie_id);
            $requete->execute();
            $comptes = $requete->fetchAll(PDO::FETCH_OBJ);
            foreach ($comptes as $r) {
                $compte_id = $r->id;
                $compte_num = $r->numero;
                $compte_lib = $r->libelle;
                array_push($_SESSION['Comptes']['id'], $compte_id);
                array_push($_SESSION['Comptes']['numero'], $compte_num);
                array_push($_SESSION['Comptes']['nom'], $compte_lib);
                array_push($_SESSION['Comptes']['classe'], $classe_lib);
                array_push($_SESSION['Comptes']['modif'], 0);
                $requete = $bdd->prepare("SELECT * FROM cptsouscomptes AS d WHERE d.compte_id=:compte_id  AND d.psedo=0  ORDER BY d.numero ASC");
                $requete->BindParam(':compte_id', $compte_id);
                $requete->execute();
                $souscomptes = $requete->fetchAll(PDO::FETCH_OBJ);
                foreach ($souscomptes as $r) {
                    $compte_id = $r->id;
                    $compte_num = $r->numero;
                    $compte_lib = $r->libelle;
                    $modif = $r->modif;
                    $site_id = $r->site_id;
                    if ($site_id == Null) {
                        array_push($_SESSION['Comptes']['id'], $compte_id);
                        array_push($_SESSION['Comptes']['numero'], $compte_num);
                        array_push($_SESSION['Comptes']['nom'], $compte_lib);
                        array_push($_SESSION['Comptes']['classe'], $classe_lib);
                        array_push($_SESSION['Comptes']['modif'], $modif);
                    } else {
                        if ($site_id == $_SESSION['idsite']) {
                            array_push($_SESSION['Comptes']['id'], $compte_id);
                            array_push($_SESSION['Comptes']['numero'], $compte_num);
                            array_push($_SESSION['Comptes']['nom'], $compte_lib);
                            array_push($_SESSION['Comptes']['classe'], $classe_lib);
                            array_push($_SESSION['Comptes']['modif'], $modif);
                        }
                    }
                }
            }
        }
    }
    //     sort($_SESSION['Comptes']['numero']);
}
function PlanComptablePourSelect($bdd)
{
    $requete = $bdd->prepare("SELECT * FROM cptclasses AS a ORDER BY a.numero ASC");
    $requete->execute();
    $classes = $requete->fetchAll(PDO::FETCH_OBJ);
    $_SESSION['Comptes'] = array();
    $_SESSION['Comptes']['id'] = array();
    $_SESSION['Comptes']['numero'] = array();
    $_SESSION['Comptes']['nom'] = array();
    $_SESSION['Comptes']['classe'] = array();
    $_SESSION['Comptes']['categorie_id'] = array();
    $_SESSION['Comptes']['compte_id'] = array();
    $_SESSION['Comptes']['modif'] = array();
    foreach ($classes as $r) {
        $classe_id = $r->id;
        $classe_num = $r->numero;
        $classe_lib = $r->libelle;
        $requete = $bdd->prepare("SELECT * FROM cptcategories AS b WHERE b.classe_id=:classe_id ORDER BY b.numero ASC");
        $requete->BindParam(':classe_id', $classe_id);
        $requete->execute();
        $categories = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($categories as $r) {
            $categorie_id = $r->id;
            $categorie_num = $r->numero;
            $categorie_lib = $r->libelle;
            array_push($_SESSION['Comptes']['id'], $categorie_id);
            array_push($_SESSION['Comptes']['numero'], $categorie_num);
            array_push($_SESSION['Comptes']['nom'], $categorie_lib);
            array_push($_SESSION['Comptes']['classe'], $classe_id);
            array_push($_SESSION['Comptes']['categorie_id'], 0);
            array_push($_SESSION['Comptes']['compte_id'], 0);
            array_push($_SESSION['Comptes']['modif'], 0);
            $requete = $bdd->prepare("SELECT * FROM cptcomptes AS c WHERE c.categorie_id=:categorie_id ORDER BY c.numero ASC");
            $requete->BindParam(':categorie_id', $categorie_id);
            $requete->execute();
            $comptes = $requete->fetchAll(PDO::FETCH_OBJ);
            foreach ($comptes as $r) {
                $compte_id = $r->id;
                $compte_num = $r->numero;
                $compte_lib = $r->libelle;
                array_push($_SESSION['Comptes']['id'], $compte_id);
                array_push($_SESSION['Comptes']['numero'], $compte_num);
                array_push($_SESSION['Comptes']['nom'], $compte_lib);
                array_push($_SESSION['Comptes']['classe'], $classe_id);
                array_push($_SESSION['Comptes']['categorie_id'], $categorie_id);
                array_push($_SESSION['Comptes']['compte_id'], 0);
                array_push($_SESSION['Comptes']['modif'], 0);
                $requete = $bdd->prepare("SELECT * FROM cptsouscomptes AS d WHERE d.compte_id=:compte_id AND d.psedo=0 ORDER BY d.numero ASC");
                $requete->BindParam(':compte_id', $compte_id);
                $requete->execute();
                $souscomptes = $requete->fetchAll(PDO::FETCH_OBJ);
                foreach ($souscomptes as $r) {
                    $scompte_id = $r->id;
                    $scompte_num = $r->numero;
                    $scompte_lib = $r->libelle;
                    $modif = $r->modif;
                    $site_id = $r->site_id;
                    if ($site_id == Null) {
                        array_push($_SESSION['Comptes']['id'], $scompte_id);
                        array_push($_SESSION['Comptes']['numero'], $scompte_num);
                        array_push($_SESSION['Comptes']['nom'], $scompte_lib);
                        array_push($_SESSION['Comptes']['classe'], $classe_id);
                        array_push($_SESSION['Comptes']['categorie_id'], $categorie_id);
                        array_push($_SESSION['Comptes']['compte_id'], $compte_id);
                        array_push($_SESSION['Comptes']['modif'], $modif);
                    } else {
                        if ($site_id == $_SESSION['idsite']) {
                            array_push($_SESSION['Comptes']['id'], $scompte_id);
                            array_push($_SESSION['Comptes']['numero'], $scompte_num);
                            array_push($_SESSION['Comptes']['nom'], $scompte_lib);
                            array_push($_SESSION['Comptes']['classe'], $classe_id);
                            array_push($_SESSION['Comptes']['categorie_id'], $categorie_id);
                            array_push($_SESSION['Comptes']['compte_id'], $compte_id);
                            array_push($_SESSION['Comptes']['modif'], $modif);
                        }
                    }
                }
            }
        }
    }
    //     sort($_SESSION['Comptes']['numero']);
}
function ListeComptes($site_id)
{
    $requete = 'SELECT a.id,a.libelle
    FROM cptsouscomptes AS a,cptcomptesites AS b
    WHERE a.id=b.compte_id AND b.site_id=:site_id AND a.psedo=0';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':site_id', $site_id);
    try {
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function ListeJournaux()
{
    $requete = 'SELECT a.id,a.libelle
    FROM cptjournal AS a 
    ORDER BY a.id ASC';
    $query = HDB::hus()->prepare($requete);
    try {
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function ListeJournauxGL()
{
    $requete = 'SELECT a.id,a.libelle
    FROM cptjournal AS a 
    ORDER BY a.libelle ASC';
    $query = HDB::hus()->prepare($requete);
    try {
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function CategoriesComptes($bdd)
{
    $requete = 'SELECT *
    FROM cptcategories 
    ORDER BY numero,libelle ASC';
    $query = $bdd->prepare($requete);
    try {
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function Getlisttresorerie($datedebut, $datefin, $type, $idsite, $bdd)
{
    $requete = $bdd->prepare("SELECT op.*,op.libelle AS description,op.motif_id AS compte_id FROM t_operation AS op WHERE op.hotel_id=:hotel_id AND op.type=:type AND op.date_bon BETWEEN :datedebut AND :datefin AND psedo=0 ORDER BY op.date_heure_bon DESC");
    $requete->BindParam(':hotel_id', $idsite);
    $requete->BindParam(':type', $type);
    $requete->BindParam(':datedebut', $datedebut);
    $requete->BindParam(':datefin', $datefin);
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_OBJ);
}
function ListeDesComptesTresorerie()
{
    $requete = 'SELECT a.id,a.libelle,a.numero
    FROM cptcomptes AS a
    WHERE a.psedo=0';
    $query = HDB::hus()->prepare($requete);
    try {
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
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

function selectCompteurSite($site_id, $libelle, $bdd)
{
    $numero = 0;
    $requete = $bdd->prepare("SELECT numero FROM compteur WHERE libelle=:libelle  AND site_id=:id_hotel");
    $requete->BindParam(':libelle', $libelle);
    $requete->BindParam(':id_hotel', $site_id);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($operations as $op) :
        $numero = $op->numero;
    endforeach;
    return $numero;
}
function getnumerotation($site_id, $libelle, $bdd)
{
    $num_cmd = 1;
    $bool = verifCompteurSite($site_id, $libelle, $bdd);
    if ($bool == 1) {
        $num_cmd =  selectCompteurSite($site_id, $libelle, $bdd);
    } else {
        insertCompteurSite($site_id, $libelle, $num_cmd, $bdd);
    }
    return $num_cmd;
}
function setnumerotation($site_id, $libelle, $numero, $bdd)
{
    $requete = $bdd->prepare("UPDATE compteur SET numero=:numero WHERE libelle=:libelle AND site_id=:site_id");
    $requete->BindParam(':numero', $numero);
    $requete->BindParam(':libelle', $libelle);
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
}

// function EcritureCompta($dte,$dtetime,$libelle,$reference,$beneficiaire,$journal_id,$psedo,$exercice_id,$user_id,$site_id){
//     $values = array(array( 'dte'=>$dte,'dtetime'=>$dtetime,'libelle'=>$libelle,'reference'=>$reference,'beneficiaire'=>$beneficiaire,'journal_id'=>$journal_id,'psedo'=>$psedo,'exercice_id'=>$exercice_id,'user_id'=>$user_id,'site_id'=>$site_id ));
//     HDB::hus()->Hinsert('cptecritures', $values);
//     $id= HDB::hus()->lastInsertId();
//     return $id;
// }
// function DetailsEcritureCompta($compte_id,$debit,$credit,$devise,$tauxop,$ecriture_id,$site_id,$categorie_id,$souscompte_id,$compte_ecriture,$long_compte){
// $values = array(array( 'compte_id'=>$compte_id,'debit'=>$debit,'credit'=>$credit,'devise'=>$devise,'taux'=>$tauxop,'ecriture_id'=>$ecriture_id,'site_id'=>$site_id,'categorie_id'=>$categorie_id,'souscompte_id'=>$souscompte_id,'compte_ecriture'=>$compte_ecriture,'long_compte'=>$long_compte));
// HDB::hus()->Hinsert('cptdetailsecritures', $values);
// }
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

function setresultatexercice($ecriture, $exercice_id, $resultat, $existe, $devise, $taux, $bdd)
{
    $requete = $bdd->prepare("UPDATE cptexercice SET resultat=:resultat,existe=:existe,ecriture =:ecriture,devise =:devise,taux =:taux  WHERE id=:exercice_id");
    $requete->BindParam(':resultat', $resultat);
    $requete->BindParam(':existe', $existe);
    $requete->BindParam(':exercice_id', $exercice_id);
    $requete->BindParam(':ecriture', $ecriture);
    $requete->BindParam(':devise', $devise);
    $requete->BindParam(':taux', $taux);

    $requete->execute();
}
function checkresultatexercice($exercice_id, $bdd)
{
    $data = array();
    $data['ecriture'] = array();
    $data['existe'] = array();
    $requete = $bdd->prepare("SELECT * FROM cptexercice WHERE id=:exercice_id");
    $requete->BindParam(':exercice_id', $exercice_id);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    $data['ecriture'] = $result->ecriture;
    $data['existe'] = $result->existe;
    return $data;
}
function ListeDesComptesTresorerieJ($idjournal, $bdd)
{
    $requete = $bdd->prepare("SELECT a.id,a.libelle,a.numero
    FROM cptcomptes AS a,cptjournalcompte AS b,cptjournalcompte AS c
    WHERE a.id=b.compte_id AND c.id=b.journal_id AND c.id=:idjournal AND a.psedo=0");
    $requete->BindParam(':idjournal', $idjournal);
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_OBJ);
}

function SoldeInitialJournalCaisse($devise, $dte, $site_id, $bdd)
{
    $requete = 'SELECT montantFC,montantUSD,type 
    FROM  t_operation
    WHERE date_bon <:dte AND hotel_id=:site_id AND psedo=0';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':dte', $dte);
    $query->BindParam(':site_id', $site_id);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    $So = 0;
    foreach ($result as $rows) {
        if ($devise == 'CDF') {
            if ($rows->type == 'entree') {
                $So = $So + $rows->montantFC;
            } else {
                $So = $So - $rows->montantFC;
            }
        } else {
            if ($rows->type == 'entree') {
                $So = $So + $rows->montantUSD;
            } else {
                $So = $So - $rows->montantUSD;
            }
        }
    }
    return $So;
}

function SoldeInitialJournalBanque($devise, $dte, $site_id, $bdd)
{
    $requete = 'SELECT debit,credit,devise  
    FROM  cptrapportjournal
    WHERE   dte<:dte AND site_id=:site_id AND psedo=0 AND journal_id=4 AND devise=:devise';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':dte', $dte);
    $query->BindParam(':site_id', $site_id);
    $query->BindParam(':devise', $devise);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    $So = 0;
    foreach ($result as $rows) {

        if ($rows->debit > 0) {
            $So = $So + $rows->debit;
        } else {
            $So = $So - $rows->credit;
        }
    }
    return $So;
}
function MontantsFacture($facture_id)
{
    $_SESSION['datas_exist'] = 0;
    $_SESSION['montant_total'] = 0;
    $_SESSION['montant_paye'] = 0;
    $_SESSION['montant_a_paye'] = 0;
    $bdd = HDB::hus();
    $req = "
        SELECT b.id_fact,mont_ttc_remise AS montant_total,SUM(e.montantusd+e.montantcdf) AS montant_paye
            FROM  t_facture AS b, t_reglement AS d, paiement AS e
            WHERE b.id_fact=d.id_fact 
                  AND d.id_regl=e.regl_id
                  AND b.id_fact=:facture_id 
                  AND b.type='achat'
                  GROUP BY b.id_fact
                ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':facture_id', $facture_id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $op) {
        $_SESSION['datas_exist'] = 1;
        $_SESSION['montant_total'] = $op->montant_total;
        $_SESSION['montant_paye'] = $op->montant_paye;
        $_SESSION['montant_a_paye'] = $op->montant_total - $op->montant_paye;
    }
}
function GenererRapportsJournaux($idjournal, $exercice_id, $d1, $d2, $site_id, $bdd)
{
    $requete = $bdd->prepare("SELECT a.id,a.dte,a.description,a.ref,a.compte,a.debit,a.credit,a.devise,a.benprov
    FROM cptrapportjournal AS a,cptjournal AS b,cptexercice AS c
    WHERE a.journal_id=b.id AND a.exercice_id=c.id  
    AND a.journal_id=:idjournal AND a.exercice_id=:exercice_id
    AND a.dte BETWEEN :d1 AND :d2 
    AND a.psedo=0  
    AND a.site_id=:site_id ORDER BY b.id ASC");
    $requete->BindParam(':idjournal', $idjournal);
    $requete->BindParam(':exercice_id', $exercice_id);
    $requete->BindParam(':d1', $d1);
    $requete->BindParam(':d2', $d2);
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_OBJ);
}
function GenererJournal($idjournal, $exercice_id, $d1, $d2, $site_id, $bdd)
{
    $requete = $bdd->prepare("SELECT a.id,a.dte,a.libelle AS description,a.reference,a.beneficiaire,b.debit,b.credit,b.devise,b.taux,d.libelle AS typejournal,b.compte_ecriture,b.long_compte 
    FROM cptecritures AS a,cptdetailsecritures AS b,cptjournal AS d
    WHERE a.id=b.ecriture_id AND a.journal_id=d.id  
    AND a.journal_id=:idjournal AND a.exercice_id=:exercice_id
    AND a.dte BETWEEN :d1 AND :d2 
    AND a.psedo=0  
    AND a.site_id=:site_id ORDER BY b.id ASC");
    $requete->BindParam(':idjournal', $idjournal);
    $requete->BindParam(':exercice_id', $exercice_id);
    $requete->BindParam(':d1', $d1);
    $requete->BindParam(':d2', $d2);
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_OBJ);
}
function GenererGrandLivre($exercice_id, $numerocompte, $d1, $d2, $site_id, $bdd)
{

    $requete = 'SELECT b.dte,b.reference,a.debit,a.credit,a.devise,a.taux,d.libelle AS typejournal,a.compte_ecriture,a.long_compte,b.libelle AS descriptjourn
    FROM  cptdetailsecritures AS a,cptecritures AS b,cptjournal AS d
    WHERE a.ecriture_id=b.id AND  b.journal_id=d.id AND b.exercice_id=:exercice_id AND b.site_id=:site_id
    AND b.dte BETWEEN :d1 AND :d2 
    AND a.compte_ecriture=:numerocompte
    AND b.psedo=0   
    ORDER BY b.dte ASC';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':exercice_id', $exercice_id);
    $query->BindParam(':site_id', $site_id);
    $query->BindParam(':d1', $d1);
    $query->BindParam(':d2', $d2);
    $query->BindParam(':numerocompte', $numerocompte);

    try {
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function GenererGrandLivreCumuls($exercice_id, $numerocompte, $d1, $d2, $site_id, $bdd)
{
    $data = array();
    $data['debitcdf'] = array();
    $data['creditcdf'] = array();
    $data['solde1'] = array();
    $data['devise'] = array();
    $data['cours'] = array();
    $data['debitusd'] = array();
    $data['creditusd'] = array();
    $data['solde2'] = array();
    $debitcdftot = 0;
    $creditcdftot = 0;
    $solde1 = 0;
    $debitusdtot = 0;
    $creditusdtot = 0;
    $solde2 = 0;
    $devisecdf = 'CDF';
    $deviseusd = 'USD';

    $requete = 'SELECT b.dte,b.reference,a.debit,a.credit,a.devise,a.taux,d.libelle AS typejournal,a.compte_ecriture,a.long_compte,b.libelle AS descriptjourn
    FROM  cptdetailsecritures AS a,cptecritures AS b,cptjournal AS d
    WHERE a.ecriture_id=b.id AND  b.journal_id=d.id AND b.exercice_id=:exercice_id AND b.site_id=:site_id
    AND b.dte <:d1
    AND a.compte_ecriture=:numerocompte
    AND b.psedo=0   
    ORDER BY b.dte ASC';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':exercice_id', $exercice_id);
    $query->BindParam(':site_id', $site_id);
    $query->BindParam(':d1', $d1);
    $query->BindParam(':numerocompte', $numerocompte);
    try {
        $query->execute();
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    $result = $query->fetchAll(PDO::FETCH_OBJ);

    foreach ($result as $rows) {
        if ($rows->debit > 0) {
            $debitcdf = arrondir(montant_equivalent_bdd($rows->devise, $devisecdf, $rows->taux, $rows->debit));
            $debitcdftot = $debitcdftot + $debitcdf;
        }
        if ($rows->credit > 0) {
            $creditcdf = arrondir(montant_equivalent_bdd($rows->devise, $devisecdf, $rows->taux, $rows->credit));
            $creditcdftot = $creditcdftot + $creditcdf;
        }
        if ($rows->debit > 0) {
            $debitusd = arrondir(montant_equivalent_bdd($rows->devise, $deviseusd, $rows->taux, $rows->debit));
            $debitusdtot = $debitusdtot + $debitusd;
        }
        if ($rows->credit > 0) {
            $creditusd = arrondir(montant_equivalent_bdd($rows->devise, $deviseusd, $rows->taux, $rows->credit));
            $creditusdtot = $creditusdtot + $creditusd;
        }
    }
    $solde1 = $debitcdftot - $creditcdftot;
    $solde2 = $debitusdtot - $creditusdtot;
    $data['debitcdf'] = $debitcdftot;
    $data['creditcdf'] = $creditcdftot;
    $data['debitusd'] = $debitusdtot;
    $data['creditusd'] = $creditusdtot;
    $data['solde1'] = $solde1;
    $data['solde2'] = $solde2;
    return $data;
}

function ComptesGrandLivre($exercice_id, $numerocompte, $d1, $d2, $site_id, $bdd)
{

    if ($numerocompte == 0) {
        $requete = 'SELECT DISTINCT b.dte,b.reference,a.debit,a.credit,a.devise,a.taux,d.libelle AS typejournal,a.compte_ecriture,a.long_compte 
    FROM  cptdetailsecritures AS a,cptecritures AS b,cptjournal AS d
    WHERE a.ecriture_id=b.id AND  b.journal_id=d.id AND b.exercice_id=:exercice_id AND b.site_id=:site_id
    AND b.dte BETWEEN :d1 AND :d2 
    AND b.psedo=0  
    ORDER BY a.compte_ecriture ASC';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':exercice_id', $exercice_id);
        $query->BindParam(':site_id', $site_id);
        $query->BindParam(':d1', $d1);
        $query->BindParam(':d2', $d2);
    } else {
        $requete = 'SELECT DISTINCT b.dte,b.reference,a.debit,a.credit,a.devise,a.taux,d.libelle AS typejournal,a.compte_ecriture,a.long_compte 
    FROM  cptdetailsecritures AS a,cptecritures AS b,cptjournal AS d
    WHERE a.ecriture_id=b.id AND  b.journal_id=d.id AND b.exercice_id=:exercice_id AND b.site_id=:site_id
    AND b.dte BETWEEN :d1 AND :d2 
    AND a.compte_ecriture LIKE :numerocompte
    AND b.psedo=0  
    ORDER BY a.compte_ecriture ASC';
        $numerocompte = $numerocompte . "%";
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':exercice_id', $exercice_id);
        $query->BindParam(':site_id', $site_id);
        $query->BindParam(':d1', $d1);
        $query->BindParam(':d2', $d2);
        $query->BindParam(':numerocompte', $numerocompte);
    }
    try {
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function GenererBalance($exercice_id, $d1, $d2, $site_id, $bdd)
{
    $requete = 'SELECT a.compte_ecriture,a.long_compte 
    FROM  cptdetailsecritures AS a,cptecritures AS b
    WHERE a.ecriture_id=b.id AND b.exercice_id=:exercice_id AND b.site_id=:site_id
    AND b.dte BETWEEN :d1 AND :d2 
    AND b.psedo=0   
    GROUP BY a.compte_ecriture
    ORDER BY a.compte_ecriture ASC';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':exercice_id', $exercice_id);
    $query->BindParam(':site_id', $site_id);
    $query->BindParam(':d1', $d1);
    $query->BindParam(':d2', $d2);

    try {
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

//Les fonctions de la balance
function SoldesPrecedents($devise, $numero, $dte, $exercice_id, $site_id, $bdd)
{
    $data = array();
    $data['sumdebit'] = array();
    $data['sumcredit'] = array();
    $sumdebit = 0;
    $sumcredit = 0;
    $requete = 'SELECT a.debit,a.credit,a.devise,a.taux
    FROM  cptdetailsecritures AS a,cptecritures AS b
    WHERE a.ecriture_id=b.id 
    AND a.compte_ecriture=:numero
    AND b.dte<:dte
    AND b.exercice_id=:exercice_id 
    AND b.psedo=0   
    AND b.site_id=:site_id';
    $query = $bdd->prepare($requete);
    $query->BindParam(':numero', $numero);
    $query->BindParam(':dte', $dte);
    $query->BindParam(':exercice_id', $exercice_id);
    $query->BindParam(':site_id', $site_id);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $sumdebit = $sumdebit + montant_equivalent_bdd($r->devise, $devise, $r->taux, $r->debit);
        $sumcredit = $sumcredit + montant_equivalent_bdd($r->devise, $devise, $r->taux, $r->credit);
    }
    $data['sumdebit'] = $sumdebit;
    $data['sumcredit'] = $sumcredit;
    return $data;
}
function SoldesCumuls($devise, $numero, $dte1, $dte2, $exercice_id, $site_id, $bdd)
{
    $data = array();
    $data['sumdebit'] = array();
    $data['sumcredit'] = array();
    $sumdebit = 0;
    $sumcredit = 0;
    $requete = 'SELECT a.debit,a.credit,a.devise,a.taux
    FROM  cptdetailsecritures AS a,cptecritures AS b
    WHERE a.ecriture_id=b.id 
    AND a.compte_ecriture=:numero
    AND b.dte BETWEEN :dte1 AND :dte2
    AND b.exercice_id=:exercice_id 
    AND b.psedo=0   
    AND b.site_id=:site_id';
    $query = $bdd->prepare($requete);
    $query->BindParam(':numero', $numero);
    $query->BindParam(':dte1', $dte1);
    $query->BindParam(':dte2', $dte2);
    $query->BindParam(':exercice_id', $exercice_id);
    $query->BindParam(':site_id', $site_id);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $sumdebit = $sumdebit + montant_equivalent_bdd($r->devise, $devise, $r->taux, $r->debit);
        $sumcredit = $sumcredit + montant_equivalent_bdd($r->devise, $devise, $r->taux, $r->credit);
    }
    $data['sumdebit'] = $sumdebit;
    $data['sumcredit'] = $sumcredit;
    return $data;
}
function NouveauxSoldes($spd, $spc, $scd, $scc)
{
    $data = array();
    $data['colonne'] = array();
    $data['solde'] = array();
    $colonne = 'd';
    $solde = ($spd + $scd) - ($spc + $scc);
    if ($solde < 0) {
        $colonne = 'c';
        $solde = abs($solde);
    }
    $data['colonne'] = $colonne;
    $data['solde'] = $solde;
    return $data;
}
function ModelesComptables($modeles, $bdd)
{
    if ($modeles == 'ba') {
        $requete = $bdd->prepare("SELECT id,compte_id,rubrique,ref,note,signe,typeligne,format,code,amortprov,saufbrut,solde,saufamort
     FROM cptmodeles 
    WHERE ba=1
    ORDER BY id ASC");
    } else if ($modeles == 'bp') {
        $requete = $bdd->prepare("SELECT id,compte_id,rubrique,ref,note,signe,typeligne,format,code,amortprov,saufbrut,solde,saufamort
    FROM cptmodeles 
    WHERE bp=1
    ORDER BY id ASC");
    } else if ($modeles == 'r') {
        $requete = $bdd->prepare("SELECT id,compte_id,rubrique,ref,note,signe,typeligne,format,code,amortprov,saufbrut,signevar,r
    FROM cptmodeles 
    WHERE r=1 OR r=2
    ORDER BY id ASC");
    }
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_OBJ);
}


//Les fonctions du bilan
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
function INFOSFromAccountNumber2($compte_id, $format, $bdd)
{
    $data = array();
    $data['id'] = array();
    $data['lib'] = array();
    $data['num'] = array();

    $id = 0;
    $lib = 0;
    if ($format == 2) {
        $requete = 'SELECT id,libelle,numero FROM cptcategories WHERE id=:id';
        $query = $bdd->prepare($requete);
        $query->BindParam(':id', $compte_id);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
            $id = $r->id;
            $lib = $r->libelle;
            $num = $r->numero;
        }
    } else if ($format == 3) {
        $requete = 'SELECT id,libelle,numero FROM cptcomptes WHERE id=:id';
        $query = $bdd->prepare($requete);
        $query->BindParam(':id', $compte_id);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
            $id = $r->id;
            $lib = $r->libelle;
            $num = $r->numero;
        }
    } else if ($format == 4) {
        $requete = 'SELECT id,libelle,numero FROM cptsouscomptes WHERE id=:id';
        $query = $bdd->prepare($requete);
        $query->BindParam(':id', $compte_id);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
            $id = $r->id;
            $lib = $r->libelle;
            $num = $r->numero;
        }
    }
    $data['id'] = $id;
    $data['lib'] = $lib;
    $data['num'] = $num;

    return $data;
}
function IDFromAccountNumber($compte_num, $format, $bdd)
{
    $compte_id = 0;
    if ($format == 2) {
        $requete = 'SELECT id FROM cptcategories WHERE numero=:compte_num';
        $query = $bdd->prepare($requete);
        $query->BindParam(':compte_num', $compte_num);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
            $compte_id = $r->id;
        }
    } else if ($format == 3) {
        $requete = 'SELECT id FROM cptcomptes WHERE numero=:compte_num';
        $query = $bdd->prepare($requete);
        $query->BindParam(':compte_num', $compte_num);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
            $compte_id = $r->id;
        }
    } else if ($format == 4) {
        $requete = 'SELECT id FROM cptsouscomptes WHERE numero=:compte_num';
        $query = $bdd->prepare($requete);
        $query->BindParam(':compte_num', $compte_num);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
            $compte_id = $r->id;
        }
    }
    return $compte_id;
}
//Les fonctions du bilan
function ConnectWithUtf()
{
    //Définition des variables de connexion
    $user = 'root';
    $pass = '';
    $dsn = 'mysql:host=localhost;dbname=ebuhoteldb';
    //Connexion à la base de données
    try {
        $bdd = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    } catch (PDOException $e) {
        print "Erreur ! : " . $e->getMessage() . "<br/>";
        die();
    }
    return $bdd;
}
function CalculValeurBrut($devise, $compte_id, $comptenum, $format, $dte1, $dte2, $exercice_id, $site_id, $bdd, $sld)
{
    $data = array();
    $data['sumdebit'] = array();
    $data['sumcredit'] = array();
    $sumdebit = 0;
    $sumcredit = 0;
    $requete = "SELECT a.debit,a.credit,a.devise,a.taux,a.compte_ecriture
FROM  cptdetailsecritures AS a,cptecritures AS b
WHERE a.ecriture_id=b.id 
AND a.compte_ecriture LIKE :comptenum
AND b.dte BETWEEN :dte1 AND :dte2
AND b.exercice_id=:exercice_id 
AND b.psedo=0   
AND b.site_id=:site_id";
    $comptenum = $comptenum . "%";
    $query = $bdd->prepare($requete);
    $query->BindParam(':comptenum', $comptenum);
    $query->BindParam(':dte1', $dte1);
    $query->BindParam(':dte2', $dte2);
    $query->BindParam(':exercice_id', $exercice_id);
    $query->BindParam(':site_id', $site_id);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        if (!in_array($r->compte_ecriture, $_SESSION['saufbrut']['id'])) {
            $sumdebit = $sumdebit + montant_equivalent_bdd($r->devise, $devise, $r->taux, $r->debit);
            $sumcredit = $sumcredit + montant_equivalent_bdd($r->devise, $devise, $r->taux, $r->credit);
        }
    }
    $solde = $sumdebit - $sumcredit;
    if ($sld == 1 && $solde < 0) {
        $solde = 0;
    }
    return $solde;
}
function CalculValeurBrutPassif($devise, $compte_id, $comptenum, $format, $dte1, $dte2, $exercice_id, $site_id, $bdd, $sld)
{
    $data = array();
    $data['sumdebit'] = array();
    $data['sumcredit'] = array();
    $sumdebit = 0;
    $sumcredit = 0;
    $requete = "SELECT a.debit,a.credit,a.devise,a.taux,a.compte_ecriture
FROM  cptdetailsecritures AS a,cptecritures AS b
WHERE a.ecriture_id=b.id 
AND a.compte_ecriture LIKE :comptenum
AND b.dte BETWEEN :dte1 AND :dte2
AND b.exercice_id=:exercice_id 
AND b.psedo=0   
AND b.site_id=:site_id";
    $comptenum = $comptenum . "%";
    $query = $bdd->prepare($requete);
    $query->BindParam(':comptenum', $comptenum);
    $query->BindParam(':dte1', $dte1);
    $query->BindParam(':dte2', $dte2);
    $query->BindParam(':exercice_id', $exercice_id);
    $query->BindParam(':site_id', $site_id);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        if (!in_array($r->compte_ecriture, $_SESSION['saufbrut']['id'])) {
            $sumdebit = $sumdebit + montant_equivalent_bdd($r->devise, $devise, $r->taux, $r->debit);
            $sumcredit = $sumcredit + montant_equivalent_bdd($r->devise, $devise, $r->taux, $r->credit);
        }
    }
    $solde = $sumcredit - $sumdebit;
    if ($sld == 2 && $solde < 0) {
        $solde = 0;
    }
    return $solde;
}
function CalculValeurAmort($devise, $compte_id, $comptenum, $format, $dte1, $dte2, $exercice_id, $site_id, $bdd)
{
    $data = array();
    $data['sumdebit'] = array();
    $data['sumcredit'] = array();
    $sumdebit = 0;
    $sumcredit = 0;
    $requete = "SELECT a.debit,a.credit,a.devise,a.taux,a.compte_ecriture
FROM  cptdetailsecritures AS a,cptecritures AS b
WHERE a.ecriture_id=b.id 
AND a.compte_ecriture LIKE :comptenum
AND b.dte BETWEEN :dte1 AND :dte2
AND b.exercice_id=:exercice_id 
AND b.psedo=0   
AND b.site_id=:site_id";
    $comptenum = $comptenum . "%";
    $query = $bdd->prepare($requete);
    $query->BindParam(':comptenum', $comptenum);
    $query->BindParam(':dte1', $dte1);
    $query->BindParam(':dte2', $dte2);
    $query->BindParam(':exercice_id', $exercice_id);
    $query->BindParam(':site_id', $site_id);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        if (!in_array($r->compte_ecriture, $_SESSION['saufamort']['id'])) {
            $sumdebit = $sumdebit + montant_equivalent_bdd($r->devise, $devise, $r->taux, $r->debit);
            $sumcredit = $sumcredit + montant_equivalent_bdd($r->devise, $devise, $r->taux, $r->credit);
        }
    }
    $solde = $sumcredit - $sumdebit;
    return $solde;
}


function CalculValeurCR($devise, $compte_id, $compte_num, $format, $dte1, $dte2, $exercice_id, $site_id, $chargeprod, $bdd)
{
    $data = array();
    $data['sumdebit'] = array();
    $data['sumcredit'] = array();
    $sumdebit = 0;
    $sumcredit = 0;
    //Compte a 2
    if ($format == 2) {
        $requete = 'SELECT a.debit,a.credit,a.devise,a.taux
FROM  cptdetailsecritures AS a,cptecritures AS b
WHERE a.ecriture_id=b.id 
AND a.categorie_id=:compte_id
AND b.dte BETWEEN :dte1 AND :dte2
AND b.exercice_id=:exercice_id 
AND b.psedo=0   
AND b.site_id=:site_id';
        $query = $bdd->prepare($requete);
        $query->BindParam(':compte_id', $compte_id);
        $query->BindParam(':dte1', $dte1);
        $query->BindParam(':dte2', $dte2);
        $query->BindParam(':exercice_id', $exercice_id);
        $query->BindParam(':site_id', $site_id);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
            $sumdebit = $sumdebit + montant_equivalent_bdd($r->devise, $devise, $r->taux, $r->debit);
            $sumcredit = $sumcredit + montant_equivalent_bdd($r->devise, $devise, $r->taux, $r->credit);
        }
        $data['sumdebit'] = $sumdebit;
        $data['sumcredit'] = $sumcredit;
    }
    //Compte a 2    
    //Compte a 3
    else if ($format == 3) {
        $requete = 'SELECT a.debit,a.credit,a.devise,a.taux
FROM  cptdetailsecritures AS a,cptecritures AS b
WHERE a.ecriture_id=b.id 
AND a.compte_id=:compte_id
AND b.dte BETWEEN :dte1 AND :dte2
AND b.exercice_id=:exercice_id 
AND b.psedo=0   
AND b.site_id=:site_id';
        $query = $bdd->prepare($requete);
        $query->BindParam(':compte_id', $compte_id);
        $query->BindParam(':dte1', $dte1);
        $query->BindParam(':dte2', $dte2);
        $query->BindParam(':exercice_id', $exercice_id);
        $query->BindParam(':site_id', $site_id);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
            $sumdebit = $sumdebit + montant_equivalent_bdd($r->devise, $devise, $r->taux, $r->debit);
            $sumcredit = $sumcredit + montant_equivalent_bdd($r->devise, $devise, $r->taux, $r->credit);
        }
        $data['sumdebit'] = $sumdebit;
        $data['sumcredit'] = $sumcredit;
    }
    //Compte a 3   
    //Compte a 3
    else if ($format == 4) {
        $requete = 'SELECT a.debit,a.credit,a.devise,a.taux
FROM  cptdetailsecritures AS a,cptecritures AS b
WHERE a.ecriture_id=b.id 
AND a.souscompte_id=:compte_id
AND b.dte BETWEEN :dte1 AND :dte2
AND b.exercice_id=:exercice_id
AND b.psedo=0    
AND b.site_id=:site_id';
        $query = $bdd->prepare($requete);
        $query->BindParam(':compte_id', $compte_id);
        $query->BindParam(':dte1', $dte1);
        $query->BindParam(':dte2', $dte2);
        $query->BindParam(':exercice_id', $exercice_id);
        $query->BindParam(':site_id', $site_id);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
            $sumdebit = $sumdebit + montant_equivalent_bdd($r->devise, $devise, $r->taux, $r->debit);
            $sumcredit = $sumcredit + montant_equivalent_bdd($r->devise, $devise, $r->taux, $r->credit);
        }
        $data['sumdebit'] = $sumdebit;
        $data['sumcredit'] = $sumcredit;
    }
    //Compte a 3  

    $solde = 0;
    if ($chargeprod == 1) {
        $solde = $sumdebit - $sumcredit;
    } else {
        $solde = $sumcredit - $sumdebit;
    }
    return $solde;
}
function InfosACccountFromID($compte_id, $format, $bdd)
{
    $data = array();
    $data['id'] = array();
    $data['lib'] = array();
    $id = 0;
    $lib = 0;
    if ($format == 2) {
        $requete = 'SELECT id,libelle FROM cptcategories WHERE id=:compte_id';
        $query = $bdd->prepare($requete);
        $query->BindParam(':compte_id', $compte_id);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
            $id = $r->id;
            $lib = $r->libelle;
        }
    } else if ($format == 3) {
        $requete = 'SELECT id,libelle FROM cptcomptes WHERE id=:compte_id';
        $query = $bdd->prepare($requete);
        $query->BindParam(':compte_id', $compte_id);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $r) {
            $id = $r->id;
            $lib = $r->libelle;
        }
    } else if ($format == 4) {
        $requete = 'SELECT id,libelle FROM cptsouscomptes WHERE id=:compte_id';
        $query = $bdd->prepare($requete);
        $query->BindParam(':compte_id', $compte_id);
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
function DeleteDetailsEcriture($ecriture_id, $bdd)
{
    $query = $bdd->prepare("DELETE FROM cptdetailsecritures WHERE ecriture_id=:ecriture_id");
    $query->BindParam(':ecriture_id', $ecriture_id);
    $query->execute();
}
function FormatChiffreCompta($n)
{
    $n = round($n, 0);
    return strrev(wordwrap(strrev($n), 3, ' ', true));
}
function GenererJournalCaisse($d1, $d2, $site_id, $bdd)
{
    $requete = $bdd->prepare("SELECT * FROM t_operation AS op WHERE op.hotel_id=:hotel_id AND op.date_bon BETWEEN :d1 AND :d2");
    $requete->BindParam(':hotel_id', $site_id);
    $requete->BindParam(':d1', $d1);
    $requete->BindParam(':d2', $d2);
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_OBJ);
}
function DatasExerciceDefault($site_id, $bdd)
{
    $module_id = 21;
    $requete = 'SELECT a.id AS id_exercice,a.lib,a.fin,a.debut,a.cloture,b.id AS config_id,b.taux,b.age AS format_compte
    FROM  cptexercice AS a,resconfig AS b
    WHERE a.config_id=b.id 
    AND a.etat=1
    AND b.module_id=:module_id
    AND a.site_id=:site_id';
    $query = $bdd->prepare($requete);
    $query->BindParam(':module_id', $module_id);
    $query->BindParam(':site_id', $site_id);
    $query->execute();
    $r = $query->fetch(PDO::FETCH_OBJ);
    $_SESSION['config_id'] = $r->config_id;
    $_SESSION['tauxop'] = $r->taux;
    $_SESSION['exercice_id'] = $r->id_exercice;
    $_SESSION['exercice_lib'] = $r->lib;
    $_SESSION['exercice_debut'] = $r->debut;
    $_SESSION['exercice_fin'] = $r->fin;
    $_SESSION['exercice_clot'] = $r->cloture;
    $_SESSION['format_compte'] = $r->format_compte;
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

function DataSubAccount($id, $bdd)
{
    $data = array();
    $requete = 'SELECT a.id AS idsouscpt,a.libelle AS libsouscpte,a.numero AS numsouscpte,a.suffixe AS sufxesouscpte,b.id AS idcpt,b.libelle AS libcpt,b.numero AS numcpt,c.id AS idcat,c.libelle AS libcat,c.numero AS numcat
    FROM cptsouscomptes AS a,cptcomptes AS b,cptcategories AS c WHERE a.id=:id AND a.compte_id=b.id AND b.categorie_id=c.id';
    $query = $bdd->prepare($requete);
    $query->BindParam(':id', $id);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);
    $data['idsouscpt'] = $result->idsouscpt;
    $data['libsouscpte'] = $result->libsouscpte;
    $data['numsouscpte'] = $result->numsouscpte;
    $data['sufxesouscpte'] = $result->sufxesouscpte;
    $data['idcpt'] = $result->idcpt;
    $data['libcpt'] = $result->libcpt;
    $data['numcpt'] = $result->numcpt;
    $data['idcat'] = $result->idcat;
    $data['libcat'] = $result->libcat;
    $data['numcat'] = $result->numcat;
    return $data;
}

function GetCompteDuJournal($compte_num, $bdd)
{
    $journal_id = 0;
    $requete = $bdd->prepare("SELECT journal_id
FROM cptjournalcompte
WHERE compte_num=:compte_num");
    $requete->BindParam(':compte_num', $compte_num);
    $requete->execute();
    $num_of_rows = $requete->rowCount();
    if ($num_of_rows > 0) {
        $result = $requete->fetch(PDO::FETCH_OBJ);
        $journal_id = $result->journal_id;
    }
    return $journal_id;
}


function report($dte, $id_hotel, $bdd)
{
    $dte = format_stringdateTodatetime('d/m/Y H:i', $dte, 'Y-m-d');
    $sql = "SELECT SUM(op.montantFC) AS montantFC,SUM(op.montantUSD) AS montantUSD,op.type,op.mode_operation 
            FROM t_operation op WHERE op.hotel_id=:hotel_id AND op.date_bon <:dte  GROUP BY op.type,op.mode_operation";
    $requete = $bdd->prepare($sql);
    $requete->BindParam(':hotel_id', $id_hotel);
    $requete->BindParam(':dte', $dte);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    $montfc_normal_in = 0;
    $montusd_normal_in = 0;
    $montfc_normal_out = 0;
    $montusd_normal_out = 0;
    $montfc_bank_in = 0;
    $montusd_bank_in = 0;
    $montfc_bank_out = 0;
    $montusd_bank_out = 0;
    $soldefc_bank = 0;
    $soldeusd_bank = 0;
    $soldefc_normal = 0;
    $soldeusd_normal = 0;
    $data = array();
    $data['soldefc_normal'] = 0;
    $data['soldeusd_normal'] = 0;
    $data['soldefc_bank'] = 0;
    $data['soldeusd_bank'] = 0;
    foreach ($operations as $op) {
        if ($op->mode_operation == 'normal') {
            if ($op->type == 'entree') {
                $montfc_normal_in = $op->montantFC;
                $montusd_normal_in = $op->montantUSD;
            } else {
                $montfc_normal_out = $op->montantFC;
                $montusd_normal_out = $op->montantUSD;
            }

            $soldefc_normal = $montfc_normal_in - $montfc_normal_out;
            $soldeusd_normal = $montusd_normal_in - $montusd_normal_out;
            $data['soldefc_normal'] = $soldefc_normal;
            $data['soldeusd_normal'] = $soldeusd_normal;
        } elseif ($op->mode_operation == 'banque') {
            if ($op->type == 'entree') {
                $montfc_bank_in = $op->montantFC;
                $montusd_bank_in = $op->montantUSD;
            } else {
                $montfc_bank_out = $op->montantFC;
                $montusd_bank_out = $op->montantUSD;
            }
            $soldefc_bank = $montfc_bank_in - $montfc_bank_out;
            $soldeusd_bank = $montusd_bank_in - $montusd_bank_out;
            $data['soldefc_bank'] = $soldefc_bank;
            $data['soldeusd_bank'] = $soldeusd_bank;
        }
    }
    return $data;
}
function report_mensuel2($dte1, $id_hotel, $bdd)
{
    $sql = "SELECT SUM(op.montantFC) AS montantFC,SUM(op.montantUSD) AS montantUSD,op.type,op.mode_operation 
            FROM t_operation op WHERE op.hotel_id=:hotel_id
            AND op.date_bon<:num_mois  
            GROUP BY op.type";
    $requete = $bdd->prepare($sql);
    $requete->BindParam(':hotel_id', $id_hotel);
    $requete->BindParam(':num_mois', $dte1);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    $montfc_normal_in = 0;
    $montusd_normal_in = 0;
    $montfc_normal_out = 0;
    $montusd_normal_out = 0;
    $montfc_bank_in = 0;
    $montusd_bank_in = 0;
    $montfc_bank_out = 0;
    $montusd_bank_out = 0;
    $soldefc_bank = 0;
    $soldeusd_bank = 0;
    $soldefc_normal = 0;
    $soldeusd_normal = 0;
    $data = array();
    $data['soldefc_normal'] = 0;
    $data['soldeusd_normal'] = 0;
    $data['soldefc_bank'] = 0;
    $data['soldeusd_bank'] = 0;
    foreach ($operations as $op) {
        if ($op->mode_operation == 'normal') {
            if ($op->type == 'entree') {
                $montfc_normal_in = $op->montantFC;
                $montusd_normal_in = $op->montantUSD;
            } else {
                $montfc_normal_out = $op->montantFC;
                $montusd_normal_out = $op->montantUSD;
            }

            $soldefc_normal = $montfc_normal_in - $montfc_normal_out;
            $soldeusd_normal = $montusd_normal_in - $montusd_normal_out;
            $data['soldefc_normal'] = $soldefc_normal;
            $data['soldeusd_normal'] = $soldeusd_normal;
        } elseif ($op->mode_operation == 'banque') {
            if ($op->type == 'entree') {
                $montfc_bank_in = $op->montantFC;
                $montusd_bank_in = $op->montantUSD;
            } else {
                $montfc_bank_out = $op->montantFC;
                $montusd_bank_out = $op->montantUSD;
            }
            $soldefc_bank = $montfc_bank_in - $montfc_bank_out;
            $soldeusd_bank = $montusd_bank_in - $montusd_bank_out;
            $data['soldefc_bank'] = $soldefc_bank;
            $data['soldeusd_bank'] = $soldeusd_bank;
        }
    }
    return $data;
}
function report_mensuel($annee1, $num_mois1, $id_hotel, $bdd)
{
    if ($num_mois1 == 1) {
        $num_mois = 12;
        $annee = (int)$annee1 - 1;
    } else {
        $num_mois = (int)$num_mois1 - 1;
        $annee = $annee1;
    }
    $jr = cal_days_in_month(CAL_GREGORIAN, $num_mois, $annee);
    $dterpt = $annee . '-' . $num_mois . '-' . $jr;
    $sql = "SELECT SUM(op.montantFC) AS montantFC,SUM(op.montantUSD) AS montantUSD,op.type,op.mode_operation 
            FROM t_operation op WHERE op.hotel_id=:hotel_id
            AND op.date_bon<=:num_mois  
            GROUP BY op.type";
    $requete = $bdd->prepare($sql);
    $requete->BindParam(':hotel_id', $id_hotel);
    $requete->BindParam(':num_mois', $dterpt);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    $montfc_normal_in = 0;
    $montusd_normal_in = 0;
    $montfc_normal_out = 0;
    $montusd_normal_out = 0;
    $montfc_bank_in = 0;
    $montusd_bank_in = 0;
    $montfc_bank_out = 0;
    $montusd_bank_out = 0;
    $soldefc_bank = 0;
    $soldeusd_bank = 0;
    $soldefc_normal = 0;
    $soldeusd_normal = 0;
    $data = array();
    $data['soldefc_normal'] = 0;
    $data['soldeusd_normal'] = 0;
    $data['soldefc_bank'] = 0;
    $data['soldeusd_bank'] = 0;
    foreach ($operations as $op) {
        if ($op->mode_operation == 'normal') {
            if ($op->type == 'entree') {
                $montfc_normal_in = $op->montantFC;
                $montusd_normal_in = $op->montantUSD;
            } else {
                $montfc_normal_out = $op->montantFC;
                $montusd_normal_out = $op->montantUSD;
            }

            $soldefc_normal = $montfc_normal_in - $montfc_normal_out;
            $soldeusd_normal = $montusd_normal_in - $montusd_normal_out;
            $data['soldefc_normal'] = $soldefc_normal;
            $data['soldeusd_normal'] = $soldeusd_normal;
        } elseif ($op->mode_operation == 'banque') {
            if ($op->type == 'entree') {
                $montfc_bank_in = $op->montantFC;
                $montusd_bank_in = $op->montantUSD;
            } else {
                $montfc_bank_out = $op->montantFC;
                $montusd_bank_out = $op->montantUSD;
            }
            $soldefc_bank = $montfc_bank_in - $montfc_bank_out;
            $soldeusd_bank = $montusd_bank_in - $montusd_bank_out;
            $data['soldefc_bank'] = $soldefc_bank;
            $data['soldeusd_bank'] = $soldeusd_bank;
        }
    }
    return $data;
}
function synthese($dte1, $dte2, $id_hotel, $bdd)
{

    $dte = format_stringdateTodatetime('d/m/Y H:i', $dte, 'Y-m-d');
    $sql = "SELECT SUM(op.montantFC) AS montantFC,SUM(op.montantUSD) AS montantUSD,op.type,op.mode_operation 
            FROM t_operation op WHERE op.hotel_id=:hotel_id AND MONTH(op.date_bon)<:num_mois  GROUP BY op.type,op.mode_operation";
    $requete = $bdd->prepare($sql);
    $requete->BindParam(':hotel_id', $id_hotel);
    $requete->BindParam(':num_mois', $num_mois);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    $montfc_normal_in = 0;
    $montusd_normal_in = 0;
    $montfc_normal_out = 0;
    $montusd_normal_out = 0;
    $montfc_bank_in = 0;
    $montusd_bank_in = 0;
    $montfc_bank_out = 0;
    $montusd_bank_out = 0;
    $soldefc_bank = 0;
    $soldeusd_bank = 0;
    $soldefc_normal = 0;
    $soldeusd_normal = 0;
    $data = array();
    $data['soldefc_normal'] = 0;
    $data['soldeusd_normal'] = 0;
    $data['soldefc_bank'] = 0;
    $data['soldeusd_bank'] = 0;
    foreach ($operations as $op) {
        if ($op->mode_operation == 'normal') {
            if ($op->type == 'entree') {
                $montfc_normal_in = $op->montantFC;
                $montusd_normal_in = $op->montantUSD;
            } else {
                $montfc_normal_out = $op->montantFC;
                $montusd_normal_out = $op->montantUSD;
            }

            $soldefc_normal = $montfc_normal_in - $montfc_normal_out;
            $soldeusd_normal = $montusd_normal_in - $montusd_normal_out;
            $data['soldefc_normal'] = $soldefc_normal;
            $data['soldeusd_normal'] = $soldeusd_normal;
        } elseif ($op->mode_operation == 'banque') {
            if ($op->type == 'entree') {
                $montfc_bank_in = $op->montantFC;
                $montusd_bank_in = $op->montantUSD;
            } else {
                $montfc_bank_out = $op->montantFC;
                $montusd_bank_out = $op->montantUSD;
            }
            $soldefc_bank = $montfc_bank_in - $montfc_bank_out;
            $soldeusd_bank = $montusd_bank_in - $montusd_bank_out;
            $data['soldefc_bank'] = $soldefc_bank;
            $data['soldeusd_bank'] = $soldeusd_bank;
        }
    }
    return $data;
}
function PeriodeSynthese($mois, $annee)
{
    $m = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    $m2 = array('', 'Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre');
    return $m2[$mois] . ' ' . $annee;
}
function VoirMonnaie($monnaie)
{
    if ($monnaie == 'fc') {
        return 'CDF';
    } elseif ($monnaie == 'usd') {
        return 'USD';
    }
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
function AutoEcrituresChecker($id_ch, $id_client, $module_id, $site_id, $bdd)
{
    $bool = 0;
    $requete = $bdd->prepare("SELECT * FROM cpt_auto_ecritures WHERE id_client=:id_client AND module_id=:module_id AND site_id=:site_id");
    $requete->BindParam(':id_client', $id_client);
    $requete->BindParam(':module_id', $module_id);
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $bool = 1;
        $_SESSION['lastdte'] = $r->lastdte;
    }
    return $bool;
}
function AutoEcrituresInsert($idreserv_ch, $lastdte, $id_ch, $id_client, $module_id, $site_id, $bdd)
{
    $requete = $bdd->prepare("INSERT INTO cpt_auto_ecritures(idreserv_ch,lastdte,id_ch,id_client,module_id,site_id)
                VALUES(:idreserv_ch,:lastdte,:id_ch,:id_client,:module_id,:site_id)");
    $requete->BindParam(':idreserv_ch', $idreserv_ch);
    $requete->BindParam(':lastdte', $lastdte);
    $requete->BindParam(':id_ch', $id_ch);
    $requete->BindParam(':id_client', $id_client);
    $requete->BindParam(':module_id', $module_id);
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
}
function AutoEcrituresUpdate($lastdte, $id_ch, $id_client, $module_id, $site_id, $bdd)
{
    $requete = $bdd->prepare("UPDATE cpt_auto_ecritures  SET lastdte =:lastdte WHERE id_ch=:id_ch AND id_client=:id_client AND module_id=:module_id AND site_id=:site_id");
    $requete->BindParam(':lastdte', $lastdte);
    $requete->BindParam(':id_ch', $id_ch);
    $requete->BindParam(':id_client', $id_client);
    $requete->BindParam(':module_id', $module_id);
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
}
function DestructAutoEcritures($id_ch, $id_client, $module_id, $site_id, $bdd)
{
    $requete = $bdd->prepare("DELETE FROM cpt_auto_ecritures WHERE id_ch=:id_ch AND id_client=:id_client AND module_id=:module_id AND site_id=:site_id");
    $requete->BindParam(':id_ch', $id_ch);
    $requete->BindParam(':id_client', $id_client);
    $requete->BindParam(':module_id', $module_id);
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
}
function NbJours2($dte_a, $dte_now)
{
    $tDeb = explode("-", $dte_a);
    $tFin = explode("-", $dte_now);
    $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
        mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);
    $nb_jrs = (($diff / 86400) + 1);
    $nb_jr = $nb_jrs - 1;
    return $nb_jr;
}

function AddDaysToDate($dte, $nbrejr)
{
    $addjr = '+' . $nbrejr . 'days';
    $date_collect = date("Y-m-d", strtotime($dte . $addjr));
    $new_date_collect = $date_collect;
    return $new_date_collect;
}
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
    $_SESSION['checkin'] = $config->checkin;
    $_SESSION['checkout'] = $config->checkout;
}
function AccountCustomerProcess($id_client, $type_client, $bdd)
{
    //Pour les clients qui n'ont pas des comptes ils sont considere occasionnel
    $_SESSION['Customer_compte_ecriture'] = '4111';
    $_SESSION['Customer_long_compte'] = 4;
    $_SESSION['Customer_souscompte_id'] = 385;
    $_SESSION['Customer_categorie_id'] = 49;
    $_SESSION['Customer_compte_id'] = 284;
    $_SESSION['Customer_nom_client'] = '';


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
            $_SESSION['Customer_nom_client'] = '';
        } else {

            $_SESSION['Customer_compte_ecriture'] = $r->compte_ecriture;
            $_SESSION['Customer_long_compte'] = 4;
            $_SESSION['Customer_souscompte_id'] = $r->souscompte_id;
            $_SESSION['Customer_categorie_id'] = 49;
            $_SESSION['Customer_compte_id'] = 284;
            $_SESSION['Customer_nom_client'] = $r->nom_client;
        }
    }
}

function CheckerUpdateComptaAuto($module_id, $site_id, $bdd)
{
    $ck = 0;
    $requete = $bdd->prepare("SELECT a.id_fact,a.mode,a.taux,a.tva,a.num_fact,a.date_edition ,b.id AS id_resch,b.idreserv,b.statut,b.date_occ,b.date_lib,b.nom_accomp,b.idchambre,b.occupe,b.tarif_ch,c.id_client,
        c.nom_client,c.adresse_provenance_client,c.email_client,c.telephone_client,c.sexe_client,a.assujetti,a.heb,a.num_cmd,a.date_desactivation,a.montpenalite,a.montremb,a.montpaie
        FROM t_facture a,t_reserve_chambre b,t_client c
        WHERE a.id_fact=b.idfact 
        AND b.id_client=c.id_client
        AND c.id_hotel=:id_hotel");
    $requete->BindParam(':id_hotel', $site_id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $rows) {
        $statutch = $rows->statut;
        $id_ch = $rows->idchambre;
        $id_client = $rows->id_client;
        $checkout = $_SESSION['checkout'];
        $hrs_sys = date('H:i') . ':00';
        // echo 'statutch ' . $statutch;
        // echo 'checkout ' . $checkout;
        // echo 'hrs_sys ' . $hrs_sys;
        if ($statutch == 'occupe') {
            $bool = AutoEcrituresChecker($id_ch, $id_client, $module_id, $site_id, $bdd);
            if ($bool == 0) {
                $dte1 = $rows->date_occ;
                $dte2 = date('Y-m-d');
                if ($dte1 < $dte2 && $hrs_sys > $checkout) {
                    $ck++;
                }
            } else {
                $dte1 = $_SESSION['lastdte'];
                $dte2 = date('Y-m-d');
                if ($dte1 < $dte2 && $hrs_sys > $checkout) {
                    $ck++;
                }
            }
        }
        if ($ck > 0) break;
    }
    return $ck;
}
function COMPTA_OCCUPATION_HEBERGE($renduincdf, $renduinusd, $montant_nuite, $type_rendu, $reference, $dte, $dtetime, $mode, $montantusd, $montantcdf, $montantsaisi, $ht, $tva, $ttc, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd)
{
    ExerciceEncours($site_id, $bdd);
    $exercice_id = $_SESSION['exercice_id'];
    $journal_id = 2;
    if ($mode == 'Cash') {
        $dteaff = $dte;
        $psedo = 0;
        $restecdf = 0;
        $resteusd = 0;
        //CAISSE CDF OU USD
        if ($montantcdf > 0 && $montantusd > 0) {
            $devisecdf = 'CDF';
            $deviseusd = 'USD';
            $montant_nuite_cdf = montant_equivalent_bdd($devise, $devisecdf, $tauxop, $ttc);
            $montant_nuite_usd = montant_equivalent_bdd($devise, $deviseusd, $tauxop, $ttc);
            if ($montantcdf >= $montant_nuite_cdf) {
                $restecdf = $montantcdf - $montant_nuite_cdf;
                $montantcdf = $montant_nuite_cdf;
                $resteusd = $montantusd;
                //Ecriture Monnaie locale
                $devise_op = 'CDF';
                $libelle = 'Hebergement : paiement occupation en CDF';
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
            } elseif ($montantusd >= $montant_nuite_usd) {

                $resteusd = $montantusd - $montant_nuite_usd;
                $montantusd = $montant_nuite_usd;
                $restecdf = $montantcdf;
                //Ecriture Monnaie etrangere
                $libelle = 'Hebergement : paiement occupation en USD';
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
            } elseif ($montantcdf < $montant_nuite_cdf) {

                $restecdf = 0;
                $soldecdf = $montant_nuite_cdf - $montantcdf;
                $soldeusd = montant_equivalent_bdd($devisecdf, $deviseusd, $tauxop, $soldecdf);
                $resteusd = $montantusd - $soldeusd;
                if ($montantusd >= $soldeusd) {
                    $montantusd = $soldeusd;
                }
                //Ecriture Monnaie etrangere
                $libelle = 'Hebergement : paiement occupation en CDF';
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
                //COMPLEMENT USD
                //Ecriture Monnaie etrangere
                $libelle = 'Hebergement : complement paiement occupation en USD';
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
                //COMPLEMENT USD

            }
        } elseif ($montantcdf > 0) {
            $libelle = 'Hebergemnt : paiement occupation en CDF';
            $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
            $devisecdf = 'CDF';
            $montant_nuite_cdf = montant_equivalent_bdd($devise, $devisecdf, $tauxop, $ttc);
            $restecdf = $montantcdf - $montant_nuite_cdf;
            if ($montantcdf > $montant_nuite_cdf) {
                $montantcdf = $montant_nuite_cdf;
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
            $libelle = 'Hebergement : paiement occupation en USD';
            $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
            $deviseusd = 'USD';
            $montant_nuite_usd = montant_equivalent_bdd($devise, $deviseusd, $tauxop, $ttc);
            $resteusd = $montantusd - $montant_nuite_usd;
            if ($montantusd > $montant_nuite_usd) {
                $montantusd = $montant_nuite_usd;
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
        }
        //Gestion paiement des surplus
        if ($type_rendu == 'non') {
            if ($restecdf > 0) {
                $reste = $restecdf - $renduincdf;
                $devisecdf2 = "CDF";
                $exercice_id = $_SESSION['exercice_id'];
                $journal_id = 2;
                $dte = date('Y-m-d');
                $dteaff = $dte;
                $dtetime = date('Y-m-d H:i:s');
                $libelle = 'Hebergement :avance accompte client en CDF';
                $psedo = 0;
                $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
                //CAISSE EN CDF
                $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESLOC'];
                $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESLOC'];
                $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESLOC'];
                $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESLOC'];
                $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESLOC'];
                $debit = $reste;
                $credit = 0;
                $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $devisecdf2, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
                //tresorerie
                $entree = 'entree';
                $date_bon = $dte;
                $date_heure_bon = $dtetime;
                $montantFC = $reste;
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
                $requete->BindParam(':devise', $devisecdf2);
                $requete->BindParam(':journal_id', $journal_id);
                $requete->BindParam(':exercice_id', $exercice_id);
                $requete->BindParam(':site_id', $site_id);
                $requete->BindParam(':ecriture_id', $ecriture_id);
                $requete->execute();
                //CAISSE EN CDF
                //CLIENT
                $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
                $long_compte = $_SESSION['Customer_long_compte'];
                $souscompte_id = $_SESSION['Customer_souscompte_id'];
                $categorie_id = $_SESSION['Customer_categorie_id'];
                $compte_id = $_SESSION['Customer_compte_id'];
                $debit = 0;
                $credit = $reste;
                DetailsEcritureCompta($compte_id, $debit, $credit, $devisecdf2, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
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
                $requete->BindParam(':devise', $devisecdf2);
                $requete->BindParam(':journal_id', $journal_id);
                $requete->BindParam(':exercice_id', $exercice_id);
                $requete->BindParam(':site_id', $site_id);
                $requete->BindParam(':ecriture_id', $ecriture_id);
                $requete->execute();
                //CLIENT

            }
            if ($resteusd > 0) {
                $deviseusd2 = "USD";
                $reste = $resteusd - $renduinusd;
                $exercice_id = $_SESSION['exercice_id'];
                $journal_id = 2;
                $dte = date('Y-m-d');
                $dteaff = $dte;
                $dtetime = date('Y-m-d H:i:s');
                $libelle = 'Hebergement :avance accompte client en USD';
                $psedo = 0;
                $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
                //CAISSE EN USD
                $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESETR'];
                $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESETR'];
                $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESETR'];
                $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESETR'];
                $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESETR'];
                $debit = $reste;
                $credit = 0;
                $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $deviseusd2, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
                //tresorerie
                $entree = 'entree';
                $date_bon = $dte;
                $date_heure_bon = $dtetime;
                $montantFC = 0;
                $montantUSD = $reste;
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
                $requete->BindParam(':devise', $deviseusd2);
                $requete->BindParam(':journal_id', $journal_id);
                $requete->BindParam(':exercice_id', $exercice_id);
                $requete->BindParam(':site_id', $site_id);
                $requete->BindParam(':ecriture_id', $ecriture_id);
                $requete->execute();
                //CAISSE EN USD
                //CLIENT
                $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
                $long_compte = $_SESSION['Customer_long_compte'];
                $souscompte_id = $_SESSION['Customer_souscompte_id'];
                $categorie_id = $_SESSION['Customer_categorie_id'];
                $compte_id = $_SESSION['Customer_compte_id'];
                $debit = 0;
                $credit = $reste;
                DetailsEcritureCompta($compte_id, $debit, $credit, $deviseusd2, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
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
                $requete->BindParam(':devise', $deviseusd2);
                $requete->BindParam(':journal_id', $journal_id);
                $requete->BindParam(':exercice_id', $exercice_id);
                $requete->BindParam(':site_id', $site_id);
                $requete->BindParam(':ecriture_id', $ecriture_id);
                $requete->execute();
                //CLIENT

            }
        }
        //Gestion paiement des surplus

        //CAISSE CDF OU USD
    } elseif ($mode == 'Credit') {
        $libelle = "Hebergement : occupation à credit";
        $dteaff = $dte;
        $psedo = 0;
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
            $montanttva = ($montant_nuite * $tva) / 100;
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
}
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

function AUTO_ECRITURES_PROCESS_HEB($module_id, $site_id, $bdd)
{
    //AUTOMATISATION DES ECRITURES 
    $requete = $bdd->prepare("SELECT a.*,a.id_fact,a.mode,a.taux,a.tva,a.num_fact,a.date_edition ,b.id AS id_resch,b.idreserv,b.statut,b.date_occ,b.date_lib,b.nom_accomp,b.idchambre,b.occupe,b.tarif_ch,c.id_client,
        c.nom_client,c.adresse_provenance_client,c.email_client,c.telephone_client,c.sexe_client,a.assujetti,a.heb,a.num_cmd,a.date_desactivation,a.montpenalite,a.montremb,a.montpaie
        FROM t_facture a,t_reserve_chambre b,t_client c
        WHERE a.id_fact=b.idfact 
        AND b.id_client=c.id_client
        AND c.id_hotel=:id_hotel");
    $requete->BindParam(':id_hotel', $site_id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $rows) {
        $id_resch = $rows->id_resch;
        $statut2 = $rows->statut;
        $id_ch = $rows->idchambre;
        $id_client = $rows->id_client;
        $num_fact = $rows->num_fact;
        $tarif_ch2 = $rows->tarif_ch;
        $tauxfact = $rows->taux;
        $nom_client = $rows->nom_client;
        $checkout = $_SESSION['checkout'];
        $tva = $rows->tva;
        $compte1 = $rows->compte1;
        $compte2 = $rows->compte2;
        $hrs_sys = date('H:i') . ':00';
        // echo $statut2; 
        if ($statut2 == 'occupe') {
            $bool = AutoEcrituresChecker($id_ch, $id_client, $module_id, $site_id, $bdd);
            if ($bool == 0) {
                $dte1 = $rows->date_occ;
                $dte2 = date('Y-m-d');
                if ($dte1 < $dte2 && $hrs_sys > $checkout) {
                    $account = $compte1 . $compte2;
                    CreateAcountForCustomer($compte1, $compte2, $account, $nom_client, $site_id, $bdd);
                    $nbrjrs = NbJours2($dte1, $dte2);
                    $reference = $num_fact;
                    $tauxop = $tauxfact;
                    $libelle = "Occupation à crédit";
                    $beneficiaire = $nom_client;
                    $site_id = $_SESSION['id_hotel'];
                    $user_id = $_SESSION['id_user'];
                    $devise = $_SESSION['Paie_affiche'];
                    $montantusd = 0;
                    $montantcdf = 0;
                    $montantsaisi = 0;
                    $mode = 'Credit';
                    $type_rendu = "oui";
                    //CALCUL HT ET TVA
                    $montantnuite = montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $tauxop, $tarif_ch2);
                    $mont_tva = ($montantnuite * $tva) / 100;
                    $ht = $montantnuite - $mont_tva;
                    $ttc = $montantnuite;
                    for ($i = 1; $i <= $nbrjrs; $i++) {
                        $dte = AddDaysToDate($dte1, $i);
                        $dtetime = $dte . ' ' . date('H:i:s');

                        // echo '$montantnuite '.$montantnuite;
                        // echo '$type_rendu '.$type_rendu;
                        // echo '$reference '.$reference;
                        // echo '$dte '.$dte;
                        // echo '$dtetime '.$dtetime;
                        // echo '$mode '.$mode;
                        // echo '$montantusd '.$montantusd;
                        // echo '$montantcdf '.$montantcdf;
                        // echo '$montantsaisi '.$montantsaisi;
                        // echo '$ht '.$ht;
                        // echo '$ttc '.$ttc;
                        // echo '$devise '.$devise;
                        // echo '$tauxop '.$tauxop;
                        // echo '$libelle '.$libelle;
                        // echo '$beneficiaire '.$beneficiaire;
                        // echo '$site_id '.$site_id;
                        // echo '$user_id '.$user_id;
                        // echo '$tva '.$tva;
                        $renduincdf = 0;
                        $renduinusd = 0;
                        COMPTA_OCCUPATION_HEBERGE($renduincdf, $renduinusd, $montantnuite, $type_rendu, $reference, $dte, $dtetime, $mode, $montantusd, $montantcdf, $montantsaisi, $ht, $tva, $ttc, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd);
                    }

                    $lastdte = date('Y-m-d');
                    AutoEcrituresInsert($id_resch, $lastdte, $id_ch, $id_client, $module_id, $site_id, $bdd);
                    //Fin checkout
                }
                //Fin bool
            } else {
                $dte1 = $_SESSION['lastdte'];
                $dte2 = date('Y-m-d');
                if ($dte1 < $dte2 && $hrs_sys > $checkout) {
                    $account = $compte1 . $compte2;
                    CreateAcountForCustomer($compte1, $compte2, $account, $nom_client, $site_id, $bdd);
                    $nbrjrs = NbJours2($dte1, $dte2);
                    $reference = $num_fact;
                    $tauxop = $tauxfact;
                    $libelle = "Occupation à crédit";
                    $beneficiaire = $nom_client;
                    $site_id = $_SESSION['id_hotel'];
                    $user_id = $_SESSION['id_user'];
                    $devise = $_SESSION['Paie_affiche'];
                    $montantusd = 0;
                    $montantcdf = 0;
                    $montantsaisi = 0;
                    $mode = 'Credit';
                    $type_rendu = "oui";
                    //CALCUL HT ET TVA
                    $montantnuite = montant_equivalent_bdd(getsymbole_local(), getsymbole_devise(), $tauxop, $tarif_ch2);
                    $mont_tva = ($montantnuite * $tva) / 100;
                    $ht = $montantnuite - $mont_tva;
                    $ttc = $montantnuite;
                    for ($i = 1; $i <= $nbrjrs; $i++) {
                        $dte = AddDaysToDate($dte1, $i);
                        $dtetime = $dte . ' ' . date('H:i:s');
                        //  echo '$montantnuite '.$montantnuite;
                        // echo '$type_rendu '.$type_rendu;
                        // echo '$reference '.$reference;
                        // echo '$dte '.$dte;
                        // echo '$dtetime '.$dtetime;
                        // echo '$mode '.$mode;
                        // echo '$montantusd '.$montantusd;
                        // echo '$montantcdf '.$montantcdf;
                        // echo '$montantsaisi '.$montantsaisi;
                        // echo '$ht '.$ht;
                        // echo '$ttc '.$ttc;
                        // echo '$devise '.$devise;
                        // echo '$tauxop '.$tauxop;
                        // echo '$libelle '.$libelle;
                        // echo '$beneficiaire '.$beneficiaire;
                        // echo '$site_id '.$site_id;
                        // echo '$user_id '.$user_id;
                        // echo '$tva '.$tva;
                        $renduincdf = 0;
                        $renduinusd = 0;
                        COMPTA_OCCUPATION_HEBERGE($renduincdf, $renduinusd, $montantnuite, $type_rendu, $reference, $dte, $dtetime, $mode, $montantusd, $montantcdf, $montantsaisi, $ht, $tva, $ttc, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd);
                    }
                    $lastdte = date('Y-m-d');
                    AutoEcrituresUpdate($lastdte, $id_ch, $id_client, $module_id, $site_id, $bdd);
                    //Fin checkout
                }
            }
            //Fin statut
        }
        //Fin automatisation
    }
    //AUTOMATISATION DES ECRITURES 

}

//GESTION BUDGETAIRE

function RealisationCompte($devise, $comptenum, $exercice_id, $site_id, $bdd)
{
    $data = array();
    $data['sumdebit'] = array();
    $data['sumcredit'] = array();
    $data['solde'] = array();
    $sumdebit = 0;
    $sumcredit = 0;
    $requete = "SELECT a.debit,a.credit,a.devise,a.taux,a.compte_ecriture
    FROM  cptdetailsecritures AS a,cptecritures AS b
    WHERE a.ecriture_id=b.id 
    AND a.compte_ecriture LIKE :comptenum
    AND b.exercice_id=:exercice_id 
    AND b.psedo=0   
    AND b.site_id=:site_id";
    $comptenum = $comptenum . "%";
    $query = $bdd->prepare($requete);
    $query->BindParam(':comptenum', $comptenum);
    $query->BindParam(':exercice_id', $exercice_id);
    $query->BindParam(':site_id', $site_id);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $sumdebit = $sumdebit + montant_equivalent_bdd($r->devise, $devise, $r->taux, $r->debit);
        $sumcredit = $sumcredit + montant_equivalent_bdd($r->devise, $devise, $r->taux, $r->credit);
    }
    $solde = $sumcredit - $sumdebit;
    $data['sumdebit'] = $sumdebit;
    $data['sumcredit'] = $sumcredit;
    $data['solde'] = $solde;
    return $data;
}

//GESTION BUDGETAIRE

function GetResultCompta2($devise, $dte1n, $dte2n, $exercicesn, $site_id, $bdd)
{
    $requete = $bdd->prepare("SELECT id,compte_id,rubrique,ref,note,signe,typeligne,format,code,amortprov,saufbrut,signevar,r
    FROM cptmodeles 
    WHERE r=1 OR r=2
    ORDER BY id ASC");
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    //Mise en session pour impression
    $_SESSION['CompteResultat'] = array();
    $_SESSION['CompteResultat']['ref'] = array();
    $_SESSION['CompteResultat']['lib'] = array();
    $_SESSION['CompteResultat']['signe'] = array();
    $_SESSION['CompteResultat']['note'] = array();
    $_SESSION['CompteResultat']['netn'] = array();
    $_SESSION['CompteResultat']['afficher'] = array();
    $netn = 0;
    $margecomn = 0;
    $chiffreaffairen = 0;
    $valeurajouten = 0;
    $excedentbrutn = 0;
    $resultatexploitn = 0;
    $resultatfinancen = 0;
    $resultatactivordin = 0;
    $resultathoactivordin = 0;
    $resultatnetn = 0;
    $afficher = 0;
    //fin mise en session
    foreach ($result as $rows) {

        if ($rows->typeligne == -1 || $rows->typeligne == 0 || $rows->typeligne == 1) {

            if ($rows->compte_id != '') {
                //Important Treatment 
                $_SESSION['valeur'] = array();
                $_SESSION['valeur']['id'] = array();
                $valeurn = 0;
                $compte_id = explode(',', $rows->compte_id);
                foreach ($compte_id as $value) {
                    $value = intval($value);
                    array_push($_SESSION['valeur']['id'], $value);
                }
                //calcul val brut
                $nbre = count($_SESSION['valeur']['id']);
                for ($i = 0; $i < $nbre; $i++) {
                    $format = (string)$_SESSION['valeur']['id'][$i];
                    $format = strlen($format);
                    $compte_num = $_SESSION['valeur']['id'][$i];
                    $compte_id = IDFromAccountNumber($_SESSION['valeur']['id'][$i], $format, $bdd);
                    $chargeprod = $rows->r;
                    $valeurn = $valeurn + CalculValeurCR($devise, $compte_id, $compte_num, $format, $dte1n, $dte2n, $exercicesn, $site_id, $chargeprod, $bdd);
                }
                //End Important Treatment 
                $netn = $valeurn;
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $netn;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
            }
        } elseif ($rows->typeligne == 2) {
            if ($rows->code == 'XA') {
                $afficher = 1;
                $margecomn = $_SESSION['CompteResultat']['netn']['TA'] - $_SESSION['CompteResultat']['netn']['RA'] + $_SESSION['CompteResultat']['netn']['RB'];
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $margecomn;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session
            } else if ($rows->code == 'XB') {
                $afficher = 1;
                $chiffreaffairen = $_SESSION['CompteResultat']['netn']['TA'] + $_SESSION['CompteResultat']['netn']['TB'] + $_SESSION['CompteResultat']['netn']['TC'] + $_SESSION['CompteResultat']['netn']['TD'];
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $chiffreaffairen;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session
            } else if ($rows->code == 'XC') {
                $afficher = 1;
                $TE_RJn = $_SESSION['CompteResultat']['netn']['TE'] + $_SESSION['CompteResultat']['netn']['TF'] + $_SESSION['CompteResultat']['netn']['TG'] + $_SESSION['CompteResultat']['netn']['TH'] + $_SESSION['CompteResultat']['netn']['TI'] - $_SESSION['CompteResultat']['netn']['RC'] + $_SESSION['CompteResultat']['netn']['RD'] - $_SESSION['CompteResultat']['netn']['RE'] + $_SESSION['CompteResultat']['netn']['RF'] - $_SESSION['CompteResultat']['netn']['RG'] - $_SESSION['CompteResultat']['netn']['RH'] - $_SESSION['CompteResultat']['netn']['RI'] - $_SESSION['CompteResultat']['netn']['RJ'];
                $valeurajouten = $_SESSION['CompteResultat']['netn']['XB'] - $_SESSION['CompteResultat']['netn']['RA'] + $_SESSION['CompteResultat']['netn']['RB'] + $TE_RJn;
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $valeurajouten;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session
            } else if ($rows->code == 'XD') {
                $afficher = 1;
                $excedentbrutn = $_SESSION['CompteResultat']['netn']['XC'] - $_SESSION['CompteResultat']['netn']['RK'];
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $excedentbrutn;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session  
            } else if ($rows->code == 'XE') {
                $afficher = 1;
                $resultatexploitn = $_SESSION['CompteResultat']['netn']['XD'] + $_SESSION['CompteResultat']['netn']['TJ'] - $_SESSION['CompteResultat']['netn']['RL'];
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $resultatexploitn;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session on 
            } else if ($rows->code == 'XF') {
                $afficher = 1;
                $resultatfinancen = $_SESSION['CompteResultat']['netn']['TK'] + $_SESSION['CompteResultat']['netn']['TL'] + $_SESSION['CompteResultat']['netn']['TM'] - $_SESSION['CompteResultat']['netn']['RM'] - $_SESSION['CompteResultat']['netn']['RN'];
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $resultatfinancen;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session on 
            } else if ($rows->code == 'XG') {
                $afficher = 1;
                $resultatactivordin = $_SESSION['CompteResultat']['netn']['XE'] + $_SESSION['CompteResultat']['netn']['XF'];
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $resultatactivordin;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session on 
            } else if ($rows->code == 'XH') {
                $afficher = 1;
                $resultathoactivordin = $_SESSION['CompteResultat']['netn']['TN'] + $_SESSION['CompteResultat']['netn']['TO'] - $_SESSION['CompteResultat']['netn']['RO'] + $_SESSION['CompteResultat']['netn']['RP'];
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $resultathoactivordin;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session on 
            } else if ($rows->code == 'XI') {
                $afficher = 1;
                $resultatnetn = $_SESSION['CompteResultat']['netn']['XG'] + $_SESSION['CompteResultat']['netn']['XH'] - $_SESSION['CompteResultat']['netn']['RQ'] - $_SESSION['CompteResultat']['netn']['RS'];
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $resultatnetn;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session 
                //Ecriture resultat
                $datas = checkresultatexercice($exercicesn, $bdd);
                $existe = $datas['existe'];
                $ecriture_id = $datas['ecriture'];
                if ($existe == 0) {

                    $dte = date('Y-m-d');
                    $dteaff = $dte;
                    $dtetime = date('Y-m-d H:i:s');
                    $libelle = 'RESULTAT EXERCICE';
                    $reference = 'RES00001';
                    $beneficiaire = '';
                    $journal_id = 5;
                    $psedo = 0;
                    $exercice_id = $exercicesn;
                    $user_id = $_SESSION['id_user'];

                    $ecriture_id = EcritureCompta($dte, $dteaff,  $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
                    $tauxop = $_SESSION['tauxop'];

                    if ($resultatnetn > 0) {
                        $compte_id = 25;
                        $debit = 0;
                        $credit = $resultatnetn;
                        $categorie_id = 23;
                        $souscompte_id = NULL;
                        $compte_ecriture = 131;
                        $long_compte = 3;
                        DetailsEcritureCompta($compte_id, $debit, $credit, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
                    } else {

                        $compte_id = 33;
                        $debit = 0;
                        $credit = $resultatnetn;
                        $categorie_id = 23;
                        $souscompte_id = NULL;
                        $compte_ecriture = 139;
                        $long_compte = 3;
                        DetailsEcritureCompta($compte_id, $debit, $credit, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
                    }

                    $resultat = $resultatnetn;
                    $existe = 1;
                    setresultatexercice($ecriture_id, $exercice_id, $resultat, $existe, $devise, $tauxop, $bdd);
                } else {

                    DeleteDetailsEcriture($ecriture_id, $bdd);
                    $tauxop = $_SESSION['tauxop'];
                    if ($resultatnetn > 0) {
                        $compte_id = 25;
                        $debit = 0;
                        $credit = $resultatnetn;
                        $categorie_id = 23;
                        $souscompte_id = NULL;
                        $compte_ecriture = 131;
                        $long_compte = 3;
                        DetailsEcritureCompta($compte_id, $debit, $credit, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
                    } else {
                        $compte_id = 33;
                        $debit = 0;
                        $credit = $resultatnetn;
                        $categorie_id = 23;
                        $souscompte_id = NULL;
                        $compte_ecriture = 139;
                        $long_compte = 3;
                        DetailsEcritureCompta($compte_id, $debit, $credit, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
                    }
                    $exercice_id = $exercicesn;
                    $resultat = $resultatnetn;
                    $existe = 1;
                    setresultatexercice($ecriture_id, $exercice_id, $resultat, $existe, $devise, $tauxop, $bdd);
                }


                //Fin ecriture resultat
            }
        }
    }
    return $resultat;
}

function GetResultCompta($devise, $dte1n, $dte2n, $exercicesn, $dte1n1, $dte2n1, $exercicesn1, $site_id, $bdd)
{

    $comptederesultat = array();
    $comptederesultat['chiffreaffairen'] = 0;
    $comptederesultat['chiffreaffairen1'] = 0;
    $comptederesultat['resultatnetn'] = 0;
    $comptederesultat['resultatnetn1'] = 0;

    $requete = $bdd->prepare("SELECT id,compte_id,rubrique,ref,note,signe,typeligne,format,code,amortprov,saufbrut,signevar,r
    FROM cptmodeles 
    WHERE r=1 OR r=2
    ORDER BY id ASC");
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    //Mise en session pour impression
    $_SESSION['CompteResultat'] = array();
    $_SESSION['CompteResultat']['ref'] = array();
    $_SESSION['CompteResultat']['lib'] = array();
    $_SESSION['CompteResultat']['signe'] = array();
    $_SESSION['CompteResultat']['note'] = array();
    $_SESSION['CompteResultat']['netn'] = array();
    $_SESSION['CompteResultat']['netn1'] = array();
    $_SESSION['CompteResultat']['afficher'] = array();
    $netn = 0;
    $netn1 = 0;
    $margecomn = 0;
    $margecomn1 = 0;
    $chiffreaffairen = 0;
    $chiffreaffairen1 = 0;
    $valeurajouten = 0;
    $valeurajouten1 = 0;
    $excedentbrutn = 0;
    $excedentbrutn1 = 0;
    $resultatexploitn = 0;
    $resultatexploitn1 = 0;
    $resultatfinancen = 0;
    $resultatfinancen1 = 0;
    $resultatactivordin = 0;
    $resultatactivordin1 = 0;
    $resultathoactivordin = 0;
    $resultathoactivordin1 = 0;
    $resultatnetn = 0;
    $resultatnetn1 = 0;
    $afficher = 0;
    //fin mise en session
    foreach ($result as $rows) {

        if ($rows->typeligne == -1 || $rows->typeligne == 0 || $rows->typeligne == 1) {

            if ($rows->compte_id != '') {
                //Important Treatment 
                $_SESSION['valeur'] = array();
                $_SESSION['valeur']['id'] = array();
                $valeurn = 0;
                $valeurn1 = 0;
                $compte_id = explode(',', $rows->compte_id);
                foreach ($compte_id as $value) {
                    $value = intval($value);
                    array_push($_SESSION['valeur']['id'], $value);
                }
                //calcul val brut
                $nbre = count($_SESSION['valeur']['id']);
                for ($i = 0; $i < $nbre; $i++) {
                    $format = (string)$_SESSION['valeur']['id'][$i];
                    $format = strlen($format);
                    $compte_num = $_SESSION['valeur']['id'][$i];
                    $compte_id = IDFromAccountNumber($_SESSION['valeur']['id'][$i], $format, $bdd);

                    ///$compte_num=691;
                    ///$format=3;
                    ///$compte_id=IDFromAccountNumber($compte_num,$format,$bdd);
                    ///echo $compte_id;

                    $chargeprod = $rows->r;
                    $valeurn = $valeurn + CalculValeurCR($devise, $compte_id, $compte_num, $format, $dte1n, $dte2n, $exercicesn, $site_id, $chargeprod, $bdd);
                    $valeurn1 = $valeurn1 + CalculValeurCR($devise, $compte_id, $compte_num, $format, $dte1n1, $dte2n1, $exercicesn1, $site_id, $chargeprod, $bdd);
                }

                //End Important Treatment 
                $netn = $valeurn;
                $netn1 = $valeurn1;
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $netn;
                $_SESSION['CompteResultat']['netn1'][$rows->ref] = $netn1;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
            }
        } elseif ($rows->typeligne == 2) {
            if ($rows->code == 'XA') {
                $afficher = 1;
                $margecomn = $_SESSION['CompteResultat']['netn']['TA'] - $_SESSION['CompteResultat']['netn']['RA'] + $_SESSION['CompteResultat']['netn']['RB'];
                $margecomn1 = $_SESSION['CompteResultat']['netn1']['TA'] - $_SESSION['CompteResultat']['netn1']['RA'] + $_SESSION['CompteResultat']['netn1']['RB'];
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $margecomn;
                $_SESSION['CompteResultat']['netn1'][$rows->ref] = $margecomn1;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session
            } else if ($rows->code == 'XB') {
                $afficher = 1;
                $chiffreaffairen = $_SESSION['CompteResultat']['netn']['TA'] + $_SESSION['CompteResultat']['netn']['TB'] + $_SESSION['CompteResultat']['netn']['TC'] + $_SESSION['CompteResultat']['netn']['TD'];
                $chiffreaffairen1 = $_SESSION['CompteResultat']['netn1']['TA'] + $_SESSION['CompteResultat']['netn1']['TB'] + $_SESSION['CompteResultat']['netn1']['TC'] + $_SESSION['CompteResultat']['netn1']['TD'];
                $comptederesultat['chiffreaffairen'] = $chiffreaffairen;
                $comptederesultat['chiffreaffairen1'] = $chiffreaffairen1;
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $chiffreaffairen;
                $_SESSION['CompteResultat']['netn1'][$rows->ref] = $chiffreaffairen1;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session
            } else if ($rows->code == 'XC') {
                $afficher = 1;
                $TE_RJn = $_SESSION['CompteResultat']['netn']['TE'] + $_SESSION['CompteResultat']['netn']['TF'] + $_SESSION['CompteResultat']['netn']['TG'] + $_SESSION['CompteResultat']['netn']['TH'] + $_SESSION['CompteResultat']['netn']['TI'] - $_SESSION['CompteResultat']['netn']['RC'] + $_SESSION['CompteResultat']['netn']['RD'] - $_SESSION['CompteResultat']['netn']['RE'] + $_SESSION['CompteResultat']['netn']['RF'] - $_SESSION['CompteResultat']['netn']['RG'] - $_SESSION['CompteResultat']['netn']['RH'] - $_SESSION['CompteResultat']['netn']['RI'] - $_SESSION['CompteResultat']['netn']['RJ'];
                $TE_RJn1 = $_SESSION['CompteResultat']['netn1']['TE'] + $_SESSION['CompteResultat']['netn1']['TF'] + $_SESSION['CompteResultat']['netn1']['TG'] + $_SESSION['CompteResultat']['netn1']['TH'] + $_SESSION['CompteResultat']['netn1']['TI'] - $_SESSION['CompteResultat']['netn1']['RC'] + $_SESSION['CompteResultat']['netn1']['RD'] - $_SESSION['CompteResultat']['netn1']['RE'] + $_SESSION['CompteResultat']['netn1']['RF'] - $_SESSION['CompteResultat']['netn1']['RG'] - $_SESSION['CompteResultat']['netn1']['RH'] - $_SESSION['CompteResultat']['netn1']['RI'] - $_SESSION['CompteResultat']['netn1']['RJ'];
                $valeurajouten = $_SESSION['CompteResultat']['netn']['XB'] - $_SESSION['CompteResultat']['netn']['RA'] + $_SESSION['CompteResultat']['netn']['RB'] + $TE_RJn;
                $valeurajouten1 = $_SESSION['CompteResultat']['netn1']['XB'] - $_SESSION['CompteResultat']['netn1']['RA'] + $_SESSION['CompteResultat']['netn1']['RB'] + $TE_RJn;
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $valeurajouten;
                $_SESSION['CompteResultat']['netn1'][$rows->ref] = $valeurajouten1;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session
            } else if ($rows->code == 'XD') {
                $afficher = 1;
                $excedentbrutn = $_SESSION['CompteResultat']['netn']['XC'] - $_SESSION['CompteResultat']['netn']['RK'];
                $excedentbrutn1 = $_SESSION['CompteResultat']['netn1']['XC'] - $_SESSION['CompteResultat']['netn1']['RK'];
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $excedentbrutn;
                $_SESSION['CompteResultat']['netn1'][$rows->ref] = $excedentbrutn1;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session  
            } else if ($rows->code == 'XE') {
                $afficher = 1;
                $resultatexploitn = $_SESSION['CompteResultat']['netn']['XD'] + $_SESSION['CompteResultat']['netn']['TJ'] - $_SESSION['CompteResultat']['netn']['RL'];
                $resultatexploitn1 = $_SESSION['CompteResultat']['netn1']['XD'] + $_SESSION['CompteResultat']['netn1']['TJ'] - $_SESSION['CompteResultat']['netn1']['RL'];

                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $resultatexploitn;
                $_SESSION['CompteResultat']['netn1'][$rows->ref] = $resultatexploitn1;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session on 
            } else if ($rows->code == 'XF') {
                $afficher = 1;
                $resultatfinancen = $_SESSION['CompteResultat']['netn']['TK'] + $_SESSION['CompteResultat']['netn']['TL'] + $_SESSION['CompteResultat']['netn']['TM'] - $_SESSION['CompteResultat']['netn']['RM'] - $_SESSION['CompteResultat']['netn']['RN'];
                $resultatfinancen1 = $_SESSION['CompteResultat']['netn1']['TK'] + $_SESSION['CompteResultat']['netn1']['TL'] + $_SESSION['CompteResultat']['netn1']['TM'] - $_SESSION['CompteResultat']['netn1']['RM'] - $_SESSION['CompteResultat']['netn1']['RN'];
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $resultatfinancen;
                $_SESSION['CompteResultat']['netn1'][$rows->ref] = $resultatfinancen1;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session on 
            } else if ($rows->code == 'XG') {
                $afficher = 1;
                $resultatactivordin = $_SESSION['CompteResultat']['netn']['XE'] + $_SESSION['CompteResultat']['netn']['XF'];
                $resultatactivordin1 = $_SESSION['CompteResultat']['netn1']['XE'] + $_SESSION['CompteResultat']['netn1']['XF'];
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $resultatactivordin;
                $_SESSION['CompteResultat']['netn1'][$rows->ref] = $resultatactivordin1;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session on 
            } else if ($rows->code == 'XH') {
                $afficher = 1;
                $resultathoactivordin = $_SESSION['CompteResultat']['netn']['TN'] + $_SESSION['CompteResultat']['netn']['TO'] - $_SESSION['CompteResultat']['netn']['RO'] + $_SESSION['CompteResultat']['netn']['RP'];
                $resultathoactivordin1 = $_SESSION['CompteResultat']['netn1']['TN'] + $_SESSION['CompteResultat']['netn1']['TO'] - $_SESSION['CompteResultat']['netn1']['RO'] + $_SESSION['CompteResultat']['netn1']['RP'];

                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $resultathoactivordin;
                $_SESSION['CompteResultat']['netn1'][$rows->ref] = $resultathoactivordin1;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session on 
            } else if ($rows->code == 'XI') {
                $afficher = 1;
                $resultatnetn = $_SESSION['CompteResultat']['netn']['XG'] + $_SESSION['CompteResultat']['netn']['XH'] - $_SESSION['CompteResultat']['netn']['RQ'] - $_SESSION['CompteResultat']['netn']['RS'];
                $resultatnetn1 = $_SESSION['CompteResultat']['netn1']['XG'] + $_SESSION['CompteResultat']['netn1']['XH'] - $_SESSION['CompteResultat']['netn1']['RQ'] - $_SESSION['CompteResultat']['netn1']['RS'];
                $comptederesultat['resultatnetn'] = $resultatnetn;
                $comptederesultat['resultatnetn1'] = $resultatnetn1;
                //Mise en session
                array_push($_SESSION['CompteResultat']['ref'], $rows->ref);
                $_SESSION['CompteResultat']['lib'][$rows->ref] = $rows->rubrique;
                $_SESSION['CompteResultat']['signe'][$rows->ref] = $rows->signevar;
                $_SESSION['CompteResultat']['note'][$rows->ref] = $rows->note;
                $_SESSION['CompteResultat']['netn'][$rows->ref] = $resultatnetn;
                $_SESSION['CompteResultat']['netn1'][$rows->ref] = $resultatnetn1;
                $_SESSION['CompteResultat']['afficher'][$rows->ref] = $afficher;
                //Mise en session 
                //Ecriture resultat
                $datas = checkresultatexercice($exercicesn, $bdd);
                $existe = $datas['existe'];
                $ecriture_id = $datas['ecriture'];
                if ($existe == 0) {

                    $dte = date('Y-m-d');
                    $dteaff = $dte;
                    $dtetime = date('Y-m-d H:i:s');
                    $libelle = 'RESULTAT EXERCICE';
                    $reference = 'RES00001';
                    $beneficiaire = '';
                    $journal_id = 5;
                    $psedo = 0;
                    $exercice_id = $exercicesn;
                    $user_id = $_SESSION['id_user'];

                    $ecriture_id = EcritureCompta($dte, $dteaff,  $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
                    $tauxop = $_SESSION['tauxop'];

                    if ($resultatnetn > 0) {
                        $compte_id = 25;
                        $debit = 0;
                        $credit = $resultatnetn;
                        $categorie_id = 23;
                        $souscompte_id = NULL;
                        $compte_ecriture = 131;
                        $long_compte = 3;
                        DetailsEcritureCompta($compte_id, $debit, $credit, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
                    } else {

                        $compte_id = 33;
                        $debit = 0;
                        $credit = $resultatnetn;
                        $categorie_id = 23;
                        $souscompte_id = NULL;
                        $compte_ecriture = 139;
                        $long_compte = 3;
                        DetailsEcritureCompta($compte_id, $debit, $credit, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
                    }

                    $resultat = $resultatnetn;
                    $existe = 1;
                    setresultatexercice($ecriture_id, $exercice_id, $resultat, $existe, $devise, $tauxop, $bdd);
                } else {
                    DeleteDetailsEcriture($ecriture_id, $bdd);
                    $tauxop = $_SESSION['tauxop'];
                    if ($resultatnetn > 0) {
                        $compte_id = 25;
                        $debit = 0;
                        $credit = $resultatnetn;
                        $categorie_id = 23;
                        $souscompte_id = NULL;
                        $compte_ecriture = 131;
                        $long_compte = 3;
                        DetailsEcritureCompta($compte_id, $debit, $credit, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
                    } else {
                        $compte_id = 33;
                        $debit = 0;
                        $credit = $resultatnetn;
                        $categorie_id = 23;
                        $souscompte_id = NULL;
                        $compte_ecriture = 139;
                        $long_compte = 3;
                        DetailsEcritureCompta($compte_id, $debit, $credit, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
                    }
                    $exercice_id = $exercicesn;
                    $resultat = $resultatnetn;
                    $existe = 1;
                    setresultatexercice($ecriture_id, $exercice_id, $resultat, $existe, $devise, $tauxop, $bdd);
                }


                //Fin ecriture resultat
            }
        }
    }
    return $comptederesultat;
}
