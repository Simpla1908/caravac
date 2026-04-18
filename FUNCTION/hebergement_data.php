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


//post
function post($var) {
    if (isset($_POST[$var]))
        return $_POST[$var];
}

//get
function get($var) {
    if (isset($_GET[$var]))
        return $_GET[$var];
}

//send headers
function send_to($direction) {
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
function success_msg($dmsg) {
    print('<div class="heze-notify progress-bar-success">
  <p>' . $dmsg . '</p>
  </div>
	');
}

function error_msg($dmsg) {
    print('<div class="heze-notify progress-bar-danger">
  <p>' . $dmsg . '</p>
  </div>
	');
}

//TinyMCE editor
function HezecomEditor($txteditor) {
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
function delete_files($folder) {
    if (is_file($folder))
        unlink($folder);
}

//dir
function app_dir($folder = NULL) {
    $base = str_replace($folder, '', dirname(__FILE__));
    return str_replace('\\', '/', $base);
}

//paging
function pagination($query, $per_page = 10, $url = NULL, $page = 1) {
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
            $hezpaging.= "<li><a class='current'>" . LANG_FIRST . "</a></li>";
            $hezpaging.= "<li><a class='current'>" . LANG_PREVIOUS . "</a></li>";
        } else {
            $hezpaging.= "<li><a href='" . $url1 . "$firstPage'>" . LANG_FIRST . "</a></li>";
            $hezpaging.= "<li><a href='" . $url1 . "$prev'>" . LANG_PREVIOUS . "</a></li>";
        }

        if ($lastpage < 7 + ($splitter * 2)) {
            for ($counter = 1; $counter <= $lastpage; $counter++) {
                if ($counter == $page)
                    $hezpaging.= "<li><a class='current'>$counter</a></li>";
                else
                    $hezpaging.= "<li><a href='" . $url1 . "$counter'>$counter</a></li>";
            }
        }
        elseif ($lastpage > 5 + ($splitter * 2)) {
            if ($page < 1 + ($splitter * 2)) {
                for ($counter = 1; $counter < 4 + ($splitter * 2); $counter++) {
                    if ($counter == $page)
                        $hezpaging.= "<li><a class='current'>$counter</a></li>";
                    else
                        $hezpaging.= "<li><a href='" . $url1 . "$counter'>$counter</a></li>";
                }
                $hezpaging.= "<li class='dot'>...</li>";
                $hezpaging.= "<li><a href='" . $url1 . "$lpm1'>$lpm1</a></li>";
                $hezpaging.= "<li><a href='" . $url1 . "$lastpage'>$lastpage</a></li>";
            }
            elseif ($lastpage - ($splitter * 2) > $page && $page > ($splitter * 2)) {
                $hezpaging.= "<li><a href='" . $url1 . "1'>1</a></li>";
                $hezpaging.= "<li><a href='" . $url1 . "2'>2</a></li>";
                $hezpaging.= "<li class='dot'>...</li>";
                for ($counter = $page - $splitter; $counter <= $page + $splitter; $counter++) {
                    if ($counter == $page)
                        $hezpaging.= "<li><a class='current'>$counter</a></li>";
                    else
                        $hezpaging.= "<li><a href='" . $url1 . "$counter'>$counter</a></li>";
                }
                $hezpaging.= "<li class='dot'>..</li>";
                $hezpaging.= "<li><a href='" . $url1 . "$lpm1'>$lpm1</a></li>";
                $hezpaging.= "<li><a href='" . $url1 . "$lastpage'>$lastpage</a></li>";
            }else {
                $hezpaging.= "<li><a href='" . $url1 . "1'>1</a></li>";
                $hezpaging.= "<li><a href='" . $url1 . "2'>2</a></li>";
                $hezpaging.= "<li class='dot'>..</li>";
                for ($counter = $lastpage - (2 + ($splitter * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $hezpaging.= "<li><a class='current'>$counter</a></li>";
                    else
                        $hezpaging.= "<li><a href='" . $url1 . "$counter'>$counter</a></li>";
                }
            }
        }
        if ($page < $counter - 1) {
            $hezpaging.= "<li><a href='" . $url1 . "$next'>" . LANG_NEXT . "</a></li>";
            $hezpaging.= "<li><a href='" . $url1 . "$lastpage'>" . LANG_LAST . "</a></li>";
        } else {
            $hezpaging.= "<li><a class='current'>" . LANG_NEXT . "</a></li>";
            $hezpaging.= "<li><a class='current'>" . LANG_NEXT . "</a></li>";
        }
        $hezpaging.= "</ul>\n";
    }
    return $hezpaging;
}

function pageparam($limit) {
    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    return ($page * $limit) - $limit;
}

//Form Messages
function form_errors($errors) {
    if (empty($errors) === false) {
        echo '<div class="alert alert-danger">' . implode($errors) . '</div>';
    }
}

//Password Hashing
function hezecom_crypt($info, $encdata = false) {
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
function check_position($val) {
    $result = '';
    if ($val == 1) {
        $result.='Super Administrator';
    } elseif ($val == 2) {
        $result.='Administrator';
    }
    return $result;
}

//status
function check_status($val) {
    $result = '';
    if ($val == 1) {
        $result.='<a class="btn btn-success btn-sm">Active</a>';
    } elseif ($val == 0) {
        $result.='<a class="btn btn-danger btn-sm">Inactive</a>';
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
function SendRecord2CSV(array &$array) {
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

function DownloadSentHeaders($filename) {
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
function json_error($errors) {
    die('<div class="alert alert-danger">' . $errors . '</div>');
}

function json_success($success) {
    die('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' . $success . '</div>');
}

function json_send($success) {
    echo'<script>window.location.replace("' . $success . '");</script>';
}

//QUICK SEARCH
function AjaxSearchSuggest($url) {
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
    $jss.="
	function lookup(inputString) {
		if(inputString.length == 0) {
			$('#suggestions').fadeOut(); // Hide the suggestions box
	} else {
		
	$.post('" . $url . "', {qstring:";
    $jss.=' ""+inputString+""}, function(data) { 
		';
    $jss.="$('#suggestions').fadeIn();
		$('#suggestions').html(data);
			});
		}
	}
	</script>
    ";
    print($jss);
}

//pass generator
function Password_Generator($limit = 6) {
    $generator = "";
    for ($i = 0; $i < $limit; $i++) {
        $generator .= substr("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789", mt_rand(0, 63), 1);
    }
    return $generator;
}

//PARTIE PERSONALISE
function AfficheText($text) {
    return $text;
}

function AfficheTitre($text) {
    return ucfirst($text);
}

function ucfirstText($text) {
    return ucfirst($text);
}

function dateAffiche($stringdate) {
    if ($stringdate != '') {
        $stringdate = trim($stringdate);
        $tmp = explode("-", $stringdate);
        $date_iso = $tmp[2] . "/" . $tmp[1] . "/" . $tmp[0];
        return $date_iso;
    }
}

//Verifier si un parametre get est vide
function getIsvide($var) {
    if (!empty($_GET[$var])) {
        return $_GET[$var];
    } else {
        return '';
    }
}

//Retourne le nom du menu à partir de son code
function AfficheMenu($code) {

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
function GetNomSite($id) {
    foreach ($_SESSION['sites'] as $rows) {
        if ($rows->id_hotel == $id) {
            $nom = $rows->nom_hotel;
            break;
        }
    }
    return $nom;
}

//Formate un nombre
function format_chiffre($mon) {
    return number_format($mon, 2, ',', '.');
}

//Arrondir un nombre
function arrondir($montant) {
    return round($montant, 2);
}

//Affiche un nombre formaté + monnaie
function afficheMontant($maffiche, $montant1) {
    $montant1 = format_chiffre(arrondir($montant1));
    if ($maffiche == 'USD') {
        $maffiche = '$';
    } else {
        $maffiche = 'FC';
    }
    return $montant1 . ' ' . $maffiche;
}

//Montant Prix
function CalculMontPrice($montant, $remise) {
    $ht = $montant - CalculMontRemise($montant, $remise);
    return $ht;
}

//Montant HT
function CalculMontHt($montant, $tva) {
    if ($_SESSION['addpricetva'] == -1) {
        $ht = ($montant - CalculMontTva($montant, $tva));
        return $ht;
    }
}

function CalculMontHtHeb($montant, $tva) {
    $ht = ($montant - CalculMontTva($montant, $tva));
    return $ht;
}

//Montant TVA
function CalculMontTva($montant, $tva) {
    $montTva = ($montant * $tva) / 100;
    return $montTva;
}

//Montant Remise
function CalculMontRemise($montant, $remise) {
    $montRemise = ($montant * $remise) / 100;
    return $montRemise;
}

//Montant TTC
function CalculMontTtc($montHt, $montTva) {
    return ($montHt + $montTva);
}

function CalculMontTtcHeb($montHt, $montTva) {
    return ($montHt + $montTva);
}

//Retourne Tva
function getTVA($Tva) {
    return 16;
}

//Retourne Tva
function getRemise($remise) {

    return $_SESSION['panier']['remise'];
}

//Retourne Symbole devise
function getsymbole_devise() {
    return 'USD';
}

//Retourne Symbole local
function getsymbole_local() {
    return 'CDF';
}

//Montant TTC
function afficheprice($monnaie_price, $price, $monnaie_affiche, $taux) {
    if ($monnaie_price == $monnaie_affiche) {
        $price = $price;
    } else {
        $price = $price * $taux;
    }
    return $price;
}

function montant_equivalent_bdd($m1, $m2, $tauxdollar1, $montant1) {
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

function format_numero($numero) {
    return str_pad($numero, 5, "0", STR_PAD_LEFT); //00001;
}

//DATETIME
/* ça une chaine de format datetime et retourne une date au format désiré */
function format_stringdateTodatetime($format1, $stringdate, $format2) {
    if ($stringdate != '') {
        $date = DateTime::createFromFormat($format1, $stringdate);
        return $date->format($format2);
    } else {
        return "00-00-0000";
    }
}
function dateToformatBdd($stringdate) {
    if ($stringdate != '') {
        $stringdate = trim($stringdate);
        $tmp = explode("/", $stringdate);
        $date_iso = $tmp[2] . "-" . $tmp[1] . "-" . $tmp[0];
        return $date_iso;
    }
}

function getTauxFacture($service, $monnaie_fact, $tauxdollar, $taux_op, $taux_fact) {
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

function json_success2($success) {
    return('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' . $success . '</div>');
}

function json_error2($errors) {
    return('<div class="alert alert-danger">' . $errors . '</div>');
}

//RH
//POINTAGE
// VALIDATION POINTAGE
function ValidationPointage($idsite) {
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

function seconds_to_time2($seconds) {
    // extract hours
    $hours = floor($seconds / (60 * 60));
    return $hours;
}

// VALIDATION POINTAGE
function DatasEmployCG($id) {
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

function ValidationPointagetraite($horaire_id, $dte_in, $dbt, $fin, $site_id, $respointmdl) {
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
function JourmMoisAnnee($dte) {
    $dte = trim($dte);
    $tmp = explode("-", $dte);
    $data = array();
    $data['jour'] = $tmp[2];
    $data['mois'] = $tmp[1];
    $data['annee'] = $tmp[0];

    return $data;
}

//recuperer jour mois annee d'une date
function DepartPointage($site_id) {

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
function ValidationPermutation($id, $num, $idagent1, $nomsagent1, $idagent2, $nomsagent2, $idhoraire, $libhoraire, $statut, $type_code, $type_lib, $heure_suplmtr_dpt, $site_id, $dte_dbt, $dte_fin, $action) {
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

function AgentAppartientHoraire($idagent, $idhoraire) {
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

function ObservationPointage($obs) {
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

function NbAnnee($dte_a) {
    $dte_now = date('Y-m-d');
    $tDeb = explode("-", $dte_a);
    $tFin = explode("-", $dte_now);
    $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
            mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);
    $nb_jrs = (($diff / 31536000));
    return floor($nb_jrs) . ' ans';
}

//recuperer jour mois annee d'une date
function PeriodePaie($dteng) {
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

function PeriodePaie2($dteng) {
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
function TimeToSec($time) {
    $sec = 0;
    foreach (array_reverse(explode(':', $time)) as $k => $v)
        $sec += pow(60, $k) * $v;
    return $sec;
}

//Retourne le nom d'un type rubrique
function GetPenalite($num) {
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

function GetMontBase($nbrjrpreste, $montantjr) {
    $nbrjr = 0;
    if ($_SESSION['penalite'] == 0 || $_SESSION['penalite'] == 1) {
        $nbrjr = 26;
    } elseif ($_SESSION['penalite'] == 2 || $_SESSION['penalite'] == 3) {
        $nbrjr = $nbrjrpreste;
    }
    return $nbrjr * $montantjr;
}

function GetMontTransport($nbrjrtransp, $monttottransp) {
    $nbrjr = $nbrjrtransp;
    if ($_SESSION['penalite'] == 0 || $_SESSION['penalite'] == 2) {
        $nbrjr = 26;
    } elseif ($_SESSION['penalite'] == 1 || $_SESSION['penalite'] == 3) {
        $nbrjr = $nbrjrtransp;
    }
    return $nbrjr * ($monttottransp / 26);
}

function CalculMontantRubrique($rows, $salbase, $taux, $nbrenf, $nbjrpreste, $nbjrtransport, $hrsup) {
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

function CalculMontantRubrique2($rows, $salbase, $taux, $nbrenf, $nbjrpreste, $nbjrtransport, $hrsup) {
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
function GetNomTypeRubrique($type) {
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

function GetNomTypeRubrique2($type) {
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

function GetMontantjrPaie($salbase, $type) {
    $montantjr = 0;
    if ($type == 'mensuel') {
        $montantjr = $salbase / 26;
    } else {
        $montantjr = $salbase;
    }
    return $montantjr;
}

//EMPRUNT
function IdLibRubriq($type, $site_id) {
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

function IdSalAgt($employe_id, $site_id) {
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

function MontantRembourse1($emprunt_id, $employe_id, $libelle, $site_id) {
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

function MontantRembourse($employe_id, $libelle, $site_id) {
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
function DataBnMalad($id) {

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
function suppr_accents($str, $encoding = 'utf-8') {
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
function MontEmpruntSold($employe_id, $libelle, $site_id) {
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

function JrsSemaine($date) {
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

function DateFuture1($dtenow, $nbrj) {
    $dtenowTimestamp = strtotime($dtenow);
    $dtefutur = date('Y-m-d', strtotime('+' . $nbrj . ' days', $dtenowTimestamp));
    return $dtefutur;
}

function DateFuture($dte1, $nbrj, $employe_id) {
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

function DateFutureCg1($dte1, $nbrj, $employe_id) {
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

function DateFutureCg($dte1, $nbrj, $employe_id) {
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

function VerifSanction($id) {
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

function VerifCG($id) {
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

function NJrs($dte1, $dte2) {
    $dte1 = strtotime($dte1);
    $dte2 = strtotime($dte2);
    $njrs = ceil(abs($dte2 - $dte1) / 86400);
    return $njrs;
}

function NJrsCsnm($dte1, $dte2, $employe_id) {
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

function NextDateEngage($dte_now) {
    $dte_now = trim($dte_now);
    $tmp = explode("-", $dte_now);
    //$Y= (string)(intval($tmp[0])+1);
    $Y = date('Y');
    $m = $tmp[1];
    $d = $tmp[2];
    $dte_next = $Y . '-' . $m . '-' . $d;
    return $dte_next;
}

function NextDate($dtenow, $nbrj) {
    $dtenowTimestamp = strtotime($dtenow);
    $dtefutur = date('Y-m-d', strtotime('+' . $nbrj . ' days', $dtenowTimestamp));
    return $dtefutur;
}

function DateReprise($dte) {
    $nbrj = 1;
    $dterepri = NextDate($dte, $nbrj);
    if (JrsSemaine($dterepri) == 'dimanche') {
        $dterepri = NextDate($dterepri, $nbrj);
    }
    return $dterepri;
}

//Resiliation
function AncienneteEmploye($dte_engage) {
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
function MontantRembourse3($employe_id) {
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
                $data['emprunt_paye'][$emprunt_id]+=$montant;
                $data['mont_paye_rub'][$rubrique_id]+=$montant;
            }
        }
        return $data;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function GetAncienneteEmploye($dte_engage) {
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

function AfficheAncienneteEmploye($anciennete) {
    $lib_anciennete = $anciennete['annee'] . ' ans et ' . $anciennete['mois'] . ' mois';
    return $lib_anciennete;
}

function MontantDecompte($montant, $nbrejr) {
    return ($montant / 26) * $nbrejr;
}

//Retourne les jours préavis
function jrpreavis($preavis, $annee) {
    $cont = 8;
    if ($preavis == 26) {
        $cont = 9;
    }
    $val = $preavis + ($cont * $annee);
    return $val;
}

//Retourne les jours conge/preavis
function jrcongsurpreavis($preavis, $annee) {
    $nbrjrpreavis = jrpreavis($preavis, $annee);
    return floor(($nbrjrpreavis * $preavis) / 312);
}

//Retourne nombre de conge compensatoire
function congeComp($preavis, $nbrmois) {
    return floor(($preavis * $nbrmois) / 12);
}

//Retourne nombre de conge non pris
function congeNonpris($annee, $nbrmois) {
    return floor(($preavis * $nbrmois) / 12);
}

//Retourne motif decompte
function getMotifDecompte($code) {
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
function CalculDateEcheance($dte, $nbrejr) {
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
function prixFacturation($prix, $tva) {
    return $prix + $tva;
}

//verifie si une valeur est entier
function IsNombre($val) {
    $bool = FALSE;
    if (is_numeric($val) && $val > 0) {
        $bool = TRUE;
    }
    return $bool;
}

//Montant Total de la facture
function totalMontantPayeFactureAll() {
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

//Recuperer le taux de la facture
function getTauxFacture2($monnaie_fact, $tauxdollar, $taux_fact) {
    if ($monnaie_fact == getsymbole_devise()) {
        $taux_fact = $tauxdollar;
    } else {
        $taux_fact = $taux_fact;
    }
    return $taux_fact;
}

// TOUTES LES CONFIGURATIONS DU MODULE
function ConfigModule($module_id,$site_id) {
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
function ConfigModule2($module_id,$site_id,$bdd) {
    $requete =$bdd->prepare("SELECT a.mail,a.nom_hotel,b.* FROM resconfig AS b,t_hotel AS a  WHERE a.id_hotel=b.site_id AND b.module_id=:module_id AND b.site_id=:site_id");
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
//Envoi Mail
function EmailSendFichier($expnom, $expadr, $destnom, $destadr, $sujet, $msg, $fichier, $mailobj) {
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

function EmailSend2($to, $to_name, $subject, $body, $mail) {
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
function MontantsFacture($facture_id) {
    $_SESSION['datas_exist'] = 0;
    $_SESSION['montant_total'] = 0;
    $_SESSION['montant_paye'] = 0;
    $_SESSION['montant_a_paye'] = 0;
    $bdd = HDB::hus();
    $req = "
        SELECT b.id_fact,mont_ttc_remise AS montant_total,SUM(e.montantusd*e.taux+e.montantcdf-e.rendu) AS montant_paye
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
        $_SESSION['montant_total'] = $op->montant_total;
        $_SESSION['montant_paye'] = $op->montant_paye;
        $_SESSION['montant_a_paye'] = $op->montant_total - $op->montant_paye;
    }
}

//1HEBERGEMENT

function PeriodeReservation($dte1, $dte2) {
    $start = DateTime::createFromFormat('Y-m-d', $dte1);
    $end = DateTime::createFromFormat('Y-m-d', $dte2);
    $step = new DateInterval('P1D');
    $jr1 = array('', 'Lun', 'Mar', 'Mec', 'Jeu', 'Ven', 'Sam', 'Dim');
    $jr2 = array('', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    $data = array();
    $data['libelle'] = array();
    $data['dte'] = array();
    for ($cur = $start; $cur <= $end; $cur->add($step)) {
        $dtebd = $cur->format('Y-m-d');
        $dteaf = $cur->format('d/m/y');
        $num_jr = $cur->format('N');
        $libelle = $jr1[$num_jr] . '.' . $dteaf;
        array_push($data['libelle'], $libelle);
        array_push($data['dte'], $dtebd);
    }
    return $data;
}
function PeriodeHeberge($dte1, $dte2) {
    $start = DateTime::createFromFormat('Y-m-d', $dte1);
    $end = DateTime::createFromFormat('Y-m-d', $dte2);
    $step = new DateInterval('P1D');
    $data = array();
    $data['dte'] = array();
    for ($cur = $start; $cur <= $end; $cur->add($step)) {
        $dtebd = $cur->format('Y-m-d');
        $dteaf = $cur->format('d/m/y');
        $num_jr = $cur->format('N');
        array_push($data['dte'], $dtebd);
    }
    return $data;
}

function startEndDayWeek() {
    $dte1 = date('Y-m-d');
// Calcul de l'écart entre le jour de $day et le lundi (=1)
    $rel = 1 - date('N', strtotime($dte1));
//calcul du lundi avec cet écart
    $monday = date('Y-m-d', strtotime("$rel days", strtotime($dte1)));
//    $s = date('Y-m-d', strtotime("6days", strtotime($monday)));
    $s = date('Y-m-d', strtotime("6days", strtotime($dte1)));
    $data = array();
//    $data['sday'] = $monday;
    $data['sday'] =$dte1;
    $data['eday'] = $s;
    return $data;
}

function startEndDayMonth() {
    $s=date("Y-m-d", mktime(0, 0, 0, date('m'),1,date('Y')));
    $e=date("Y-m-d", mktime(0, 0, 0, date('m')+1,0,date('Y')));
    $data = array();
    $data['sday'] =$s ;
    $data['eday'] = $e;
    return $data;
}

function GetListChambre($idsite, $bdd) {
    $req = "SELECT c.id_ch,c.num_ch,c.monnaie,c.etat_ch,c.tarif_ch,k.lib_cat_cha
            FROM  t_chambre c,categorie_chambre k
            WHERE  k.id_cat_cha=c.categorie 
            AND c.del=0 AND c.libre='oui'
            AND c.id_hotel=:idsite 
             ORDER BY c.num_ch ASC
            ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':idsite', $idsite);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function GetListService($idsite, $bdd) {
    $req = "SELECT c.id_ch,c.num_ch,c.monnaie,c.etat_ch,c.tarif_ch
            FROM  t_chambre c
            WHERE  c.del=0 AND libre='non' AND c.id_hotel=:idsite 
             ORDER BY c.id_ch ASC
            ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':idsite', $idsite);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

//Pour de besoin de la cause
function InfosChambres($idsite, $bdd) {
    $req = "SELECT c.id_ch,c.num_ch,c.monnaie,c.etat_ch,c.tarif_ch
            FROM  t_chambre c
            WHERE  c.del=0  AND c.id_hotel=:idsite 
             ORDER BY c.id_ch ASC
            ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':idsite', $idsite);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    $sejour = array();
    $sejour['nom'] = array();
    $sejour['tarif'] = array();
    $sejour['monnaie'] = array();
    foreach ($result as $rows) {
        $id_ch = $rows->id_ch;
        $sejour['nom'][$id_ch] = $rows->num_ch;
        $sejour['tarif'][$id_ch] = $rows->tarif_ch;
        $sejour['monnaie'][$id_ch] = $rows->monnaie;
    }
    return $sejour;
}

//Liste de mode de paiement
function GetModepaiement($bdd) {
    $sejour = array();
    $sejour['id'] = array();
    $sejour['lib'] = array();
    $sejour['lib2'] = array();
    $req = "SELECT * FROM  t_mode_reglement ORDER BY lib";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':idsite', $idsite);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $rows) {
        $id = $rows->id_mode_regl;
        array_push($sejour['lib'], $rows->lib);
        array_push($sejour['id'], $id);
        $sejour['lib2'][$id] = $rows->lib;
    }
    return $sejour;
}

function GetSejourChambre($idsite, $dte1, $dte2, $bdd) {
    //AND b.date_occ  BETWEEN :dte1 AND :dte2
    //libre=oui signifie chambre
    $req = "SELECT a.id_ch,a.num_ch,a.libre,e.nom_client,b.*
                FROM  t_chambre a,t_reserve_chambre b,t_client e
                WHERE a.id_ch=b.idchambre
                AND b.id_client=e.id_client
                AND a.del=0
                AND a.libre='oui'
                AND b.statut!='libre'
                AND b.id_hotel=:idsite";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':idsite', $idsite);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function GetListClientByNom($idsite, $bdd) {
    $req = $requete = "SELECT * FROM t_client WHERE type='client' AND type_cl='hebergement'  AND pseudo_supp=0 AND id_hotel=:idsite ORDER BY nom_client";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':idsite', $idsite);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function GetListResponsable($idsite, $bdd) {
    $req = $requete = 'SELECT * FROM t_responsable WHERE  company_id=:idsite ORDER BY filtre,nom_respo';
    $requete = $bdd->prepare($req);
    $requete->BindParam(':idsite', $idsite);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function InfosFactByChambre($id, $bdd){
    $req = "
        SELECT a.id_fact,a.mode,a.taux,a.tva,a.num_fact,a.date_edition ,b.id AS id_resch,b.idreserv,b.statut,b.date_occ,b.date_lib,b.nom_accomp,b.idchambre,b.occupe,
        c.nom_client,c.adresse_provenance_client,c.email_client,c.telephone_client,c.sexe_client
            FROM t_facture a,t_reserve_chambre b,t_client c
             WHERE a.id_fact=b.idfact 
                   AND b.id_client=c.id_client
                   AND b.id=:id";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    return $result;
}
function InfosFactByChambre2($id, $bdd) {
    $req = "
        SELECT a.id_fact,a.mode,a.id_res,a.taux,a.tva,a.num_fact,a.date_edition ,b.id AS id_resch,b.idreserv,b.statut,b.date_occ,b.date_lib,b.nom_accomp,b.idchambre,b.occupe,
        c.nom_client,c.adresse_provenance_client,c.email_client,c.telephone_client,c.sexe_client
            FROM t_facture a,t_reserve_chambre b,t_client c
             WHERE a.id_fact=b.idfact 
                   AND b.id_client=c.id_client
                   AND b.idfact=:id";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    return $result;
}
function InfosFactHeb($idfact, $bdd) {
    $req = "
        SELECT a.id_fact,a.mode,a.taux,a.tva,a.num_fact,a.date_edition ,b.id_res,b.etat,b.dte_a,b.dte_s,c.id_client ,c.nom_client,
             c.adresse_provenance_client,c.email_client,c.telephone_client,c.sexe_client ,d.id_user,d.nom_user,d.prenom_user,e.entreprise AS nom_respo
            FROM t_facture a,t_client c,t_reservation AS b,t_utilisateur d,t_responsable e
             WHERE a.id_client=c.id_client 
                   AND a.id_res=b.id_res
                   AND a.id_user=d.id_user
                   AND b.respo_id=e.id_respo
                   AND a.id_fact=:id";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $idfact);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    return $result;
}
function LignesFactByChambre($id,$bdd){
    $req = "
        SELECT a.id_ch,a.num_ch,a.libre,b.tarif_ch,b.idres_ch,b.id AS histoch_id,b.statut,
         b.date_occ,b.date_lib,SUM(b.qte) AS qte,b.paie,b.qte AS nuitee,b.reserve,b.occupe,a.libre
            FROM t_chambre a, t_chambre_histo b
             WHERE a.id_ch=b.idchambre
                   AND b.idres_ch=:id 
                   GROUP BY a.id_ch ORDER BY b.statut";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetchALL(PDO::FETCH_OBJ);
    return $result;
}
function LignesFactHeb($idfact,$bdd) {
    $req = "
        SELECT a.id_ch,a.num_ch,a.libre,b.tarif_ch,b.idres_ch,b.id AS histoch_id,b.statut,b.date_occ,b.date_lib,SUM(b.qte) AS qte,b.paie,b.qte AS nuitee
            FROM t_chambre a, t_chambre_histo b,t_reserve_chambre d
             WHERE  d.id=b.idres_ch
                    AND b.idchambre=a.id_ch
                   AND d.idfact=:id GROUP BY a.id_ch";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $idfact);
    $requete->execute();
    $result = $requete->fetchALL(PDO::FETCH_OBJ);
    return $result;
}
function AfficheMonnaie($m) {
    if ($m == 'USD') {
        $m = '$';
    } else {
        $m = 'FC';
    }
    return $m;
}

function AfficheNomChambre($m) {
    return $m;
}

function prixHebergement($prix, $tva) {
    return $prix;
}

function NbJours($dte_a, $dte_now) {
    $tDeb = explode("-", $dte_a);
    $tFin = explode("-", $dte_now);
    $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
            mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);
    $nb_jrs = (($diff / 86400) + 1);
    $nb_jr = $nb_jrs - 1;
    if ($nb_jr == 0) {
        $nb_jr++;
    }
    return $nb_jr;
}
function NbJours2($dte_a, $dte_now) {
    $tDeb = explode("-", $dte_a);
    $tFin = explode("-", $dte_now);
    $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
            mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);
    $nb_jrs = (($diff / 86400) + 1);
    $nb_jr = $nb_jrs - 1;
    return $nb_jr;
}
function AddDaysToDate($dte, $nbrejr) {
    $addjr = '+' . $nbrejr . 'days';
    $date_collect = date("Y-m-d", strtotime($dte . $addjr));
    $new_date_collect = $date_collect;
    return $new_date_collect;
}

function InsertReservation($id_client, $type_heb, $dte, $dte_a, $dte_s, $num_reserv, $m_affiche, $id_hotel, $etat, $statut_res, $mont_total_res, $montant, $libele_mode,$respo_id,$bdd) {
    $requete = $bdd->prepare("INSERT INTO t_reservation (id_client,type,dte,dte_a,dte_s,num_reserv,monnaie,id_hotel,etat,statut_res,mont_total_res,mont_nuite,etat_credit,respo_id)
			       VALUES(:id_client,:type,:dte,:dte_a,:dte_s,:num_reserv,:monnaie,:id_hotel,:etat,:statut_res,:mont_total_res,:mont_nuite,:etat_credit,:respo_id)");
    
    $requete->BindParam(':id_client', $id_client);
    $requete->BindParam(':type', $type_heb);
    $requete->BindParam(':dte', $dte);
    $requete->BindParam(':dte_a', $dte_a);
    $requete->BindParam(':dte_s', $dte_s);
    $requete->BindParam(':num_reserv', $num_reserv);
    $requete->BindParam(':monnaie', $m_affiche);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->BindParam(':etat', $etat);
    $requete->BindParam(':statut_res', $statut_res);
    $requete->BindParam(':mont_total_res', $mont_total_res);
    $requete->BindParam(':mont_nuite', $montant);
    $requete->BindParam(':etat_credit', $libele_mode);
    $requete->BindParam(':respo_id',$respo_id);
    $requete->execute();
    $id_res = $bdd->lastInsertId();
    return $id_res;
}

function InsertFactureHeb($type, $num_fact, $id_res, $tauxdollar, $tva, $m_affiche, $dte, $id_client, $id_user, $id_hotel, $company_id, $mont_ttc, $valremise, $mode,$fact1,$bdd) {
    $requete = $bdd->prepare("INSERT INTO  t_facture (type,num_fact,id_res,taux,tva,monnaie,date_edition,id_client,id_user,id_hotel,company_id,mont_ttc,mont_ttc_remise,mode,fact1)
			                    VALUES(:type,:num_fact,:id_res,:taux,:tva,:monnaie,:date_edition,:id_client,:id_user,:id_hotel,:company_id,:mont_ttc ,:mont_ttc_remise,:mode,:fact1)");
    $requete->BindParam(':type', $type);
    $requete->BindParam(':num_fact', $num_fact);
    $requete->BindParam(':id_res', $id_res);
    $requete->BindParam(':taux', $tauxdollar);
    $requete->BindParam(':tva', $tva);
    $requete->BindParam(':monnaie', $m_affiche);
    $requete->BindParam(':date_edition', $dte);
    $requete->BindParam(':id_client', $id_client);
    $requete->BindParam(':id_user', $id_user);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->BindParam(':company_id', $company_id);
    $requete->BindParam(':mont_ttc', $mont_ttc);
    $requete->BindParam(':mont_ttc_remise', $valremise);
    $requete->BindParam(':mode', $mode);
    $requete->BindParam(':fact1',$fact1);
    $requete->execute();
    $id_fact = $bdd->lastInsertId();
    return $id_fact;
}

function InsertReserveChambre($id_res, $id_fact, $idch, $id_client,$statut,$dte_a, $dte_s, $tarif_ch, $id_accomp, $nom_accomp, $checkin, $checkout, $id_hotel, $monnaie_fact, $bdd) {
    $requete = $bdd->prepare("INSERT INTO t_reserve_chambre (idreserv,idfact,idchambre,id_client,id_accomp,statut,date_occ,date_lib,tarif_ch,nom_accomp,checkout,checkin,id_hotel,monnaie,occupe)
					     VALUES(:idreserv,:idfact,:idchambre,:id_client,:id_accomp,:statut,:date_occ,:date_lib,:tarif_ch,:nom_accomp,:checkout,:checkin,:id_hotel,:monnaie,:occupe)");
    $requete->BindParam(':idreserv', $id_res);
    $requete->BindParam(':idfact', $id_fact);
    $requete->BindParam(':idchambre', $idch);
    $requete->BindParam(':id_client', $id_client);
    $requete->BindParam(':id_accomp', $id_accomp);
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':date_occ', $dte_a);
    $requete->BindParam(':date_lib', $dte_s);
    $requete->BindParam(':tarif_ch', $tarif_ch);
    $requete->BindParam(':id_accomp', $id_accomp);
    $requete->BindParam(':nom_accomp', $nom_accomp);
    $requete->BindParam(':checkout', $checkout);
    $requete->BindParam(':checkin', $checkin);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->BindParam(':monnaie', $monnaie_fact);
    $requete->BindParam(':occupe',$dte_a);
    $requete->execute();
    $idresch = $bdd->lastInsertId();
    return $idresch;
}

function InsertChambreHisto($idres_ch, $idchambre, $statut, $dte_a, $dte_s, $tarif_ch, $monnaie_fact,$qte, $bdd) {
    
    if($statut=='occupe'){
        $reserve=0;
        $occupe=1;
    }else{
        $reserve=1;
        $occupe=0;
    }
    $requete = $bdd->prepare("INSERT INTO t_chambre_histo (idres_ch,idchambre,statut,date_occ,date_lib,tarif_ch,monnaie,qte,reserve,occupe)
                                    VALUES(:idres_ch,:idchambre,:statut,:date_occ,:date_lib,:tarif_ch,:monnaie,:qte,:reserve,:occupe)");
    $requete->BindParam(':idres_ch', $idres_ch);
    $requete->BindParam(':idchambre', $idchambre);
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':date_occ', $dte_a);
    $requete->BindParam(':date_lib', $dte_s);
    $requete->BindParam(':tarif_ch', $tarif_ch);
    $requete->BindParam(':monnaie', $monnaie_fact);
    $requete->BindParam(':qte',$qte);
    $requete->BindParam(':reserve', $reserve);
    $requete->BindParam(':occupe',$occupe);
    $requete->execute();
    $idresch = $bdd->lastInsertId();
    return $idresch;
}

function InsertReglement($num_fact, $id_fact, $dtereglhr, $dte, $id_user, $id_hotel, $bdd) {
    $requete = $bdd->prepare("INSERT INTO  t_reglement (numero,id_fact,date_regl,dte,id_user,id_hotel)
                                    VALUES(:numero,:id_fact,:date_regl,:dte,:id_user,:id_hotel)");
    $requete->BindParam(':numero', $num_fact);
    $requete->BindParam(':id_fact', $id_fact);
    $requete->BindParam(':date_regl', $dtereglhr);
    $requete->BindParam(':dte', $dte);
    $requete->BindParam(':id_user', $id_user);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->execute();
    $regl_id = $bdd->lastInsertId();
    return $regl_id;
}

function InsertPaiement($montantusd, $montantcdf, $tauxdollar, $rendu,$rendu_usd,$rendu_cdf,$montremise, $justification, $mode, $regl_id, $id_hotel, $company_id, $histch_id,$resch_id, $bdd) {
    $requete = $bdd->prepare("INSERT INTO  paiement (montantusd,montantcdf,taux,rendu,rendu_usd,rendu_cdf,remise,justification,id_mode_regl,regl_id,site_id,company_id,histch_id,resch_id,motif)
                              VALUES(:montantusd,:montantcdf,:taux,:rendu,:rendu_usd,:rendu_cdf,:remise,:justification,:id_mode_regl,:regl_id,:id_hotel,:company_id,:histch_id,:resch_id,:motif)");
    $motif='hebergement';
    $requete->BindParam(':montantusd', $montantusd);
    $requete->BindParam(':montantcdf', $montantcdf);
    $requete->BindParam(':taux', $tauxdollar);
    $requete->BindParam(':rendu', $rendu);
    $requete->BindParam(':rendu_usd',$rendu_usd);
    $requete->BindParam(':rendu_cdf',$rendu_cdf);
    $requete->BindParam(':remise', $montremise);
    $requete->BindParam(':justification', $justification);
    $requete->BindParam(':id_mode_regl', $mode);
    $requete->BindParam(':regl_id', $regl_id);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->BindParam(':company_id', $company_id);
    $requete->BindParam(':histch_id', $histch_id);
    $requete->BindParam(':resch_id', $resch_id);
    $requete->BindParam(':motif',$motif);
    $requete->execute();
    $paie_id = $bdd->lastInsertId();
    return $paie_id;
}
function LiberationChambre($idres_ch,$dte,$nbre_nte,$id_histo,$id_res,$bdd){
    //Liberation
    $statut = 'libre';
    $requete = $bdd->prepare("UPDATE t_reserve_chambre  SET statut=:statut,date_lib=:date_lib WHERE id=:id");
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':date_lib', $dte);
    $requete->BindParam(':id', $idres_ch);
    $requete->execute();
    $nbArticles = count($_SESSION['panier']['id_article']);
    $libre=1;
    for ($i = 0; $i <= $nbArticles - 1; $i++) {
        $repas = $_SESSION['panier']['repas'][$i];
        if($repas=='0'){
            $id_histo = $_SESSION['panier']['id_article'][$i];
            $dte_in=$_SESSION['panier']['dte_a'][$i];
            $qte = $_SESSION['panier']['qte'][$i];
            $statut2=$_SESSION['panier']['statut'][$i];
            $dte_out=date('Y-m-d');
//            if($dte_in<$dte_out){
//              $dte_out= AddDaysToDate($dte_in,$qte);  
//            }
            //Update t_chambre_histo
            $requete = $bdd->prepare("UPDATE t_chambre_histo SET statut=:statut,date_lib=:date_lib,qte=:qte,libre=:libre WHERE id=:id");
            $requete->BindParam(':statut', $statut);
            $requete->BindParam(':date_lib',$dte_out);
            $requete->BindParam(':qte',$qte);
            $requete->BindParam(':libre',$libre);
            $requete->BindParam(':id',$id_histo);
            $requete->execute();
        }
      }   
    //Update t_reservation
    $etat='libre';
    $requete = $bdd->prepare("UPDATE t_reservation SET etat=:etat  WHERE id_res=:id_res ");
    $requete->BindParam(':etat', $etat);
    $requete->BindParam(':id_res', $id_res);
    $requete->execute();
}
function LiberationChambre2($idres_ch,$dte,$nbre_nte,$id_histo,$id_res,$bdd){
    //Liberation
    $statut = 'libre';
    $requete = $bdd->prepare("UPDATE t_reserve_chambre  SET statut=:statut,date_lib=:date_lib WHERE id=:id");
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':date_lib', $dte);
    $requete->BindParam(':id', $idres_ch);
    $requete->execute();
    //Update t_chambre_histo
    $requete = $bdd->prepare("UPDATE t_chambre_histo SET statut=:statut,date_lib=:date_lib,qte=:qte WHERE id=:id");
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':date_lib',$dte);
    $requete->BindParam(':qte',$nbre_nte);
    $requete->BindParam(':id',$id_histo);
    $requete->execute();
    //Update t_reservation
    $etat='libre';
    $requete = $bdd->prepare("UPDATE t_reservation SET etat=:etat  WHERE id_res=:id_res ");
    $requete->BindParam(':etat', $etat);
    $requete->BindParam(':id_res', $id_res);
    $requete->execute();
}

function OccupationChambre($idres_ch,$id_res, $bdd){
    $statut = 'occupe';
    $occupe=1;
    $requete = $bdd->prepare("UPDATE t_reserve_chambre  SET statut=:statut WHERE id=:id");
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':id', $idres_ch);
    $requete->execute();
    //Update t_chambre_histo
    $requete = $bdd->prepare("UPDATE t_chambre_histo SET statut=:statut,occupe=:occupe WHERE idres_ch=:id  ");
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':occupe',$occupe);
    $requete->BindParam(':id', $idres_ch);
    $requete->execute();
//Update t_reservation
    $etat='occupe';
    $requete = $bdd->prepare("UPDATE t_reservation SET etat=:etat  WHERE id_res=:id_res ");
    $requete->BindParam(':etat', $etat);
    $requete->BindParam(':id_res', $id_res);
    $requete->execute();
   
}

//LA LISTE DE PAIEMENT HEB
function GetListPaiement($id, $dte1, $dte2, $bdd) {
    $req = "SELECT a.id_fact,a.num_fact,a.type,b.id_regl,b.numero,b.dte,c.idpaie,c.montant,c.montantusd-c.rendu_usd AS montantusd,
                    c.montantcdf-c.rendu_cdf AS montantcdf,c.taux,c.histch_id,d.id_mode_regl,d.lib,e.id_client,e.nom_client,h.nom_user,h.prenom_user
         FROM t_facture AS a, t_reglement AS b, paiement AS c,t_mode_reglement AS d, t_client AS e,t_utilisateur AS h
         WHERE  a.id_fact=b.id_fact
               AND b.id_regl=c.regl_id
               AND c.id_mode_regl=d.id_mode_regl
               AND e.id_client=a.id_client
               AND b.id_user=h.id_user
               AND c.motif='hebergement'
               AND d.lib='Cash'
               AND b.dte BETWEEN :dte1 AND :dte2
               AND a.id_hotel=:id
               ORDER BY b.numero ASC";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchALL(PDO::FETCH_OBJ);
    return $result;
}

//LA LISTE DE RECETTES HEBERGEMENT
function GetListRecette($id, $dte1, $dte2, $bdd) {

    $req = "SELECT re.dte,pa.taux AS txpaie,SUM(pa.montantusd-pa.rendu_usd) AS montantusd,SUM(pa.montantcdf-pa.rendu_cdf) AS montantcdf
            FROM t_reglement AS re,paiement AS pa
            WHERE re.id_regl=pa.regl_id 
                   AND pa.motif IN('hebergement')
                  AND pa.id_mode_regl=2
                  AND re.dte BETWEEN :dte1 AND :dte2
                  AND re.id_hotel=:id
                  GROUP BY re.dte
                  ORDER BY re.dte DESC";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchALL(PDO::FETCH_OBJ);
    return $result;
}

function AllFactureMontHeb($idsite,$monnaie_insert,$hrs_sys,$checkout,$bdd) {
    //RENVOIE MONTANT TOTAL ET PAYE D'UNE RESERVATION
    $data = array();
    $data['idfact'] = array();
    $data['ttc'] = array();
    $req = "SELECT a.id_ch,a.num_ch,a.libre,b.tarif_ch,b.qte,b.idres_ch,b.id AS histoch_id,b.statut,b.date_occ,b.date_lib,
            d.idfact,e.taux,e.tva,e.monnaie
            FROM t_facture e,t_reserve_chambre d,t_chambre_histo b,t_chambre a
            WHERE e.id_fact=d.idfact
                 AND d.id=b.idres_ch
                 AND a.id_ch=b.idchambre
                 AND e.id_fact=:id";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $idsite);
    try {
        $requete->execute();
        $result = $requete->fetchALL(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    $today=date('Y-m-d');
    foreach ($result as $r) {
        $fact_id=$r->idfact;
        $monnaie=$r->monnaie;
        $taux=$r->taux;
        $tva=$r->tva;
        $date_occ=$r->date_occ;
        $date_lib=$r->date_lib;
        $statut=$r->statut;
        $tarif_ch=$r->tarif_ch;
        $montpaye=0;
        if ($statut == 'occupe') {
            $date_lib = $today;
        } elseif ($statut == 'change'|| $statut == 'reserve') {
            $date_lib = $date_lib;
        }
        $tarif_ch = montant_equivalent_bdd(getsymbole_local(),$monnaie_insert, $taux,$tarif_ch);
        $montpaye = montant_equivalent_bdd(getsymbole_local(),$monnaie_insert, $taux,$montpaye);
        $qte = NbJours($date_occ, $date_lib);
         //Incrémentation de la nuitée par rapport au checkout
        if (($date_occ < $today && $hrs_sys > $checkout) && $statut == 'occupe') {
            $qte++;
        }
    }
    return $data;
}
function FactureMontHeb($idfact,$monnaie_insert,$hrs_sys,$checkout,$bdd) {
    //RENVOIE MONTANT TOTAL ET PAYE D'UNE RESERVATION
    $data = array();
    $data['idfact'] = array();
    $data['ttc'] = array();
    $req = "SELECT a.id_ch,a.num_ch,a.libre,b.tarif_ch,b.qte
             ,b.id AS histoch_id,b.statut,b.date_occ,b.date_lib,b.paie,
            d.idfact,e.taux,e.tva,e.monnaie,e.id_res,b.qte AS nuitee
            FROM t_facture e,t_reserve_chambre d,t_chambre_histo b,t_chambre a
            WHERE e.id_fact=d.idfact
                 AND d.id=b.idres_ch
                 AND a.id_ch=b.idchambre
                 AND e.id_fact=:id";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $idfact);
    try {
        $requete->execute();
        $result = $requete->fetchALL(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    $today=date('Y-m-d');
    $ttc=0;
    foreach ($result as $r){
        $fact_id=$r->idfact;
        $id_res=$r->id_res;
        $monnaie=$r->monnaie;
        $taux=$r->taux;
        $tva=$r->tva;
        $service=$r->libre;
        $date_occ=$r->date_occ;
        $date_lib=$r->date_lib;
        $statut=$r->statut;
        $tarif_ch=$r->tarif_ch;
        $paiech=$r->paie;
        $montpaye=0;
        if($service=='oui'){
           if ($statut == 'occupe') {
            $date_lib = $today;
           }elseif ($statut == 'change'|| $statut == 'reserve'){
            $date_lib = $date_lib;
           }
        $tarif_ch = montant_equivalent_bdd(getsymbole_local(),$monnaie_insert, $taux,$tarif_ch);
//        $montpaye = montant_equivalent_bdd(getsymbole_local(),$monnaie_insert, $taux,$montpaye);
        $qte = NbJours($date_occ, $date_lib);
         //Incrémentation de la nuitée par rapport au checkout
        if (($date_occ < $today && $hrs_sys > $checkout) && $statut == 'occupe') {
            $qte++;
        }
        if($statut=='change'|| $statut=='libre'){
            $qte =$r->nuitee;
        }
         if($paiech==0){
            $qte =0; 
         }
        $tarif_ch2=$tarif_ch*$qte;
        }else{
           $qte=$r->qte;
           $tarif_ch = montant_equivalent_bdd(getsymbole_local(),$monnaie_insert, $taux,$tarif_ch);
           $tarif_ch2=$tarif_ch*$qte; 
        }
       $ttc+= $tarif_ch2;
    }
    //Autres services
    $factures_heb=GetFacturesHeb($id_res,$bdd);
    $totResto=0;
    foreach ($factures_heb as $fh){
        $txp=$fh->taux;
        $tp=$fh->type;
        if($tp=='restaurant'&& $fh->mode=='Credit'){
           $totResto+=montant_equivalent_bdd(getsymbole_local(),$monnaie_insert,$txp,$fh->mont_ttc);  
        }
    }
    return $ttc+$totResto;
}
function AllFactureHeb($idsite,$dte1,$dte2,$bdd) {
    //RENVOIE LA LISTE DE RESERVATIONS OU FACTURES
    $req = "SELECT a.id_fact,a.taux,a.num_fact,a.id_user,b.id_res,b.dte_a ,b.dte_s,b.etat,c.id_client,c.nom_client 
            FROM t_facture a,t_reservation b,t_client c
             WHERE a.id_res=b.id_res
                   AND a.id_client=c.id_client
                   AND a.type='hebergement'
                   AND a.date_edition  BETWEEN :dte1 AND :dte2
                   AND b.id_hotel=:id";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->BindParam(':id', $idsite);
    try {
        $requete->execute();
        $result = $requete->fetchALL(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $result;
}
function AllFactureHeb2($idsite,$fact1,$bdd) {
    //RENVOIE LA LISTE DE RESERVATIONS OU FACTURES
    if($fact1!=5){
      $req = "SELECT a.id_fact,a.mode,a.taux,a.num_fact,a.id_user,b.dte,b.id_res,b.dte_a ,b.dte_s,b.etat,
          c.id_client,c.nom_client,d.nom_respo,d.entreprise 
            FROM t_facture a,t_reservation b,t_client c,t_responsable AS d
             WHERE a.id_res=b.id_res
                   AND a.id_client=c.id_client
                   AND b.respo_id=d.id_respo
                   AND a.type='hebergement'
                   AND a.fact1=:fact1
                   AND b.id_hotel=:id ORDER BY a.num_fact";  
      $requete = $bdd->prepare($req);
      $requete->BindParam(':fact1',$fact1);
      $requete->BindParam(':id', $idsite);
    }else{
       $req = "SELECT a.id_fact,a.mode,a.taux,a.num_fact,a.id_user,b.dte,b.id_res,b.dte_a ,b.dte_s,b.etat,
          c.id_client,c.nom_client,d.nom_respo,d.entreprise 
            FROM t_facture a,t_reservation b,t_client c,t_responsable AS d
             WHERE a.id_res=b.id_res
                   AND a.id_client=c.id_client
                   AND b.respo_id=d.id_respo
                   AND a.type='hebergement'
                   AND b.id_hotel=:id ORDER BY a.num_fact"; 
       $requete = $bdd->prepare($req);
       $requete->BindParam(':id',$idsite);
    }
    try {
        $requete->execute();
        $result = $requete->fetchALL(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $result;
}
function getchambreIndisponibles($id_hotel, $dte_a, $dte_s, $checkin, $checkout, $hrs_sys, $bdd) {
    $data['chambres'] = array();
    $data['chambres']['id'] = array();
    $requete = $bdd->prepare("SELECT * FROM t_reserve_chambre AS rc WHERE rc.statut!='libre' AND rc.id_hotel=:id");
    $requete->BindParam(':id',$id_hotel);
    $requete->execute();
    $chambres = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($chambres as $ch){
        $idch=$ch->idchambre;
        // Avant la date d'occupation       
        if(($dte_a <= $ch->date_occ)&&($dte_s <= $ch->date_occ)){
//            if(($hrs_sys > $ch->checkin)){
                 array_push($data['chambres']['id'], $idch);
//            } 
         
         }
         // Après la date de libération
         elseif(($dte_a >= $ch->date_lib)&&($dte_s >= $ch->date_lib)){
//            if($hrs_sys < $ch->checkout){
               array_push($data['chambres']['id'], $idch);
//            }
        }
         // Pendant
        elseif(($dte_a >= $ch->date_occ)&&($dte_s <= $ch->date_lib)){
            array_push($data['chambres']['id'], $idch);
        }
    
    }
    return $data;
}
function getchambreIndisponibles2($id_ch, $dte_a, $dte_s, $checkin, $checkout, $hrs_sys, $bdd) {
    $data['chambres'] = array();
    $data['chambres']['id'] = array();
     $data['chambres']['nom'] = array();
    $requete = $bdd->prepare("SELECT * FROM t_reserve_chambre AS rc,t_chambre a
                                WHERE a.id_ch=rc.idchambre
                                     AND rc.statut!='libre'
                                     AND rc.idchambre=:id");
    $requete->BindParam(':id',$id_ch);
    $requete->execute();
    $chambres = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($chambres as $ch){
        $idch = $ch->idchambre;
         // Avant la date d'occupation       
        if(($dte_a <= $ch->date_occ)&&($dte_s == $ch->date_occ)){
//            if(($hrs_sys > $ch->checkin)){
                 array_push($data['chambres']['id'], $idch);
//            } 
         
         }
         // Après la date de libération
        elseif(($dte_a > $ch->date_lib)&&($dte_s == $ch->date_lib)){
//            if($hrs_sys < $ch->checkout){
               array_push($data['chambres']['id'], $idch);
//            }
        }
         // Pendant
        elseif(($dte_a >= $ch->date_occ)&&($dte_s <= $ch->date_lib)){
            array_push($data['chambres']['id'], $idch);
        }
        elseif(($ch->date_occ>=$dte_a)&&($ch->date_lib<=$dte_s)){
            array_push($data['chambres']['id'], $idch);
        }
    }
    return $data;
}
//GET INFOS RECU
function GetRecuInfos($id, $bdd){
    $req = "
        SELECT b.id_fact,b.num_fact,e.taux,d.numero,d.dte,d.date_regl ,f.lib,e.montantusd,e.montantcdf,e.montantusd*e.taux+e.montantcdf AS montant_paye,e.rendu_cdf,e.rendu_usd,e.resch_id,
        g.id_client,g.nom_client,g.telephone_client,g.email_client,g.adresse_provenance_client,h.nom_user,h.prenom_user,i.ville_hotel
            FROM  t_facture AS b, t_reglement AS d, paiement AS e,
	          t_mode_reglement AS f,t_client AS g,t_utilisateur AS h,t_hotel AS i
            WHERE b.id_fact=d.id_fact 
	          AND b.id_client=g.id_client
                  AND d.id_regl=e.regl_id 
	          AND e.id_mode_regl=f.id_mode_regl
                 AND d.id_user=h.id_user
		 AND e.site_id=i.id_hotel
	         AND e.idpaie=:id";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    return $result;
}

//MONTANT POUR UNE CHAMBRE
function TotalPayeByChambre($bdd, $id) {
    $requete = $bdd->prepare("SELECT SUM(c.montantusd*c.taux-c.rendu_usd*c.taux+c.montantcdf-c.rendu_cdf) AS montantpaye
                                FROM t_facture AS a, t_reglement AS b, paiement AS c
                                WHERE a.id_fact=b.id_fact AND b.id_regl=c.regl_id 
                                AND c.resch_id=:id GROUP BY c.resch_id");
    $requete->BindParam(':id', $id);
    $requete->execute();
    $montantpaye = $requete->fetch(PDO::FETCH_OBJ);
    return $montantpaye->montantpaye;
}
function TotalPayeSejour($bdd, $id) {
    $requete = $bdd->prepare("SELECT SUM(c.montantusd*c.taux-c.rendu_usd*c.taux+c.montantcdf-c.rendu_cdf) AS montantpaye
                                FROM t_facture AS a, t_reglement AS b, paiement AS c
                                WHERE a.id_fact=b.id_fact AND b.id_regl=c.regl_id 
                                AND a.id_fact=:id  GROUP BY a.id_fact");
    $requete->BindParam(':id',$id);
    $requete->execute();
    $montantpaye = $requete->fetch(PDO::FETCH_OBJ);
    return $montantpaye->montantpaye;
}
function MontPaieFactCh($idfact,$monnaie_insert,$hrs_sys,$checkout,$bdd){
    //Renvoie le solde de chaque chambre d'une facture
    $data = array();
    $data['id'] = array();
    $data['nom'] = array();
    $data['ttc'] = array();
    $data['paye'] = array();
    $data['solde'] = array();
    $req = "SELECT a.id_ch,a.num_ch,a.libre,b.tarif_ch,b.qte,b.statut,b.date_occ,b.date_lib,
             d.id,d.idfact,e.taux,e.tva,e.monnaie
            FROM t_facture e,t_reserve_chambre d,t_chambre_histo b,t_chambre a
            WHERE e.id_fact=d.idfact
                 AND d.id=b.idres_ch
                 AND a.id_ch=b.idchambre
                 AND a.libre='oui'
                 AND e.id_fact=:id";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id',$idfact);
    try {
        $requete->execute();
        $result = $requete->fetchALL(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    $today=date('Y-m-d');
    $ttc=0;
    foreach ($result as $r) {
        $fact_id=$r->idfact;
        $monnaie=$r->monnaie;
        $taux=$r->taux;
        $tva=$r->tva;
        $service=$r->libre;
        $date_occ=$r->date_occ;
        $date_lib=$r->date_lib;
        $statut=$r->statut;
        $tarif_ch=$r->tarif_ch;
        $montpaye=0;
        if($service=='oui'){
           if ($statut == 'occupe') {
            $date_lib = $today;
            } elseif ($statut == 'change'|| $statut == 'reserve') {
                $date_lib = $date_lib;
            }
            $tarif_ch = montant_equivalent_bdd(getsymbole_local(),$monnaie_insert, $taux,$tarif_ch);
            $montpaye = montant_equivalent_bdd(getsymbole_local(),$monnaie_insert, $taux,$montpaye);
            $qte = NbJours($date_occ, $date_lib);
             //Incrémentation de la nuitée par rapport au checkout
            if (($date_occ < $today && $hrs_sys > $checkout) && $statut == 'occupe') {
                $qte++;
            }
            $tarif_ch2=$tarif_ch*$qte;
        }else{
           $qte=$r->qte;
           $tarif_ch = montant_equivalent_bdd(getsymbole_local(),$monnaie_insert, $taux,$tarif_ch);
           $tarif_ch2=$tarif_ch*$qte; 
        }
       $ttc+= $tarif_ch2;
    }
    return $ttc;
}
function ChangerChambre($id_reserv_chx,$id_chx_ex,$id_chx_new,$dte_a,$dte_s,$monnaie,$tarif,$nbre_nte,$id_histo,$bdd){
    //maj dans table t_reserve_chambre
    $date_occ=date('Y-m-d');
    $paie=1;
    if($dte_a==$date_occ){
        $paie=0; 
    }
    $libre=1;
    $requete = $bdd->prepare("UPDATE t_reserve_chambre SET idchambre =:idchambre,date_occ=:date_occ,monnaie=:monnaie,tarif_ch=:tarif_ch WHERE id=:id_reserv_chx");
    $requete->BindParam(':idchambre', $id_chx_new);
    $requete->BindParam(':date_occ', $date_occ);
    $requete->BindParam(':monnaie', $monnaie);
    $requete->BindParam(':tarif_ch',$tarif);
    $requete->BindParam(':id_reserv_chx',$id_reserv_chx);
    $requete->execute();
    //maj dans table t_chambre_histo
    $requete = $bdd->prepare("UPDATE t_chambre_histo SET statut ='change',date_lib=:date_lib,paie=:paie,qte=:qte,libre=:libre WHERE idchambre=:idchambre AND idres_ch=:idres_ch");
    $requete->BindParam(':date_lib',$date_occ);
    $requete->BindParam(':paie',$paie);
    $requete->BindParam(':idchambre',$id_chx_ex);
    $requete->BindParam(':idres_ch', $id_reserv_chx);
    $requete->BindParam(':qte',$nbre_nte);
    $requete->BindParam(':libre',$libre);
    $requete->execute();
    //insertion dans t_chambre_histo
    $occupe=1;
    $statut='occupe';
    $qte=1;
    $requete = $bdd->prepare("INSERT INTO t_chambre_histo (idres_ch,idchambre,statut,date_occ,date_lib,tarif_ch,monnaie,qte,occupe)
                                    VALUES(:idres_ch,:idchambre,:statut,:date_occ,:date_lib,:tarif_ch,:monnaie,:qte,:occupe)");
    $requete->BindParam(':idres_ch',$id_reserv_chx);
    $requete->BindParam(':idchambre', $id_chx_new);
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':date_occ',$date_occ);
    $requete->BindParam(':date_lib', $dte_s);
    $requete->BindParam(':tarif_ch',$tarif);
    $requete->BindParam(':monnaie',$monnaie);
    $requete->BindParam(':qte',$qte);
    $requete->BindParam(':occupe',$occupe);
    $requete->execute();
    
}
function GetFacturesHeb($id,$bdd){
    $req = "SELECT b.*FROM t_facture AS b WHERE b.id_res=:id ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetchALL(PDO::FETCH_OBJ);
    return $result;
}
function TotPayeHeb($id,$bdd){
    //Retourne toutes les commandes du sous-resto
    $requete = $bdd->prepare("SELECT SUM(c.montantusd*c.taux-c.rendu_usd*c.taux+c.montantcdf-c.rendu_cdf) AS montantpaye
                                FROM t_facture AS a, t_reglement AS b, paiement AS c
                                WHERE a.id_fact=b.id_fact AND b.id_regl=c.regl_id
                                 AND c.id_mode_regl IN(1,2)
                                AND a.id_fact=:id  
                                GROUP BY a.id_fact");
    $requete->BindParam(':id',$id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    $montantpaye=0;
     foreach ($result as $r){
        $montantpaye=$r->montantpaye;
     }
    return $montantpaye;
}

function GetInfosChambre($id,$bdd){
    $req = "SELECT d.*
        FROM t_reserve_chambre AS c,t_chambre AS d
        WHERE c.idchambre=d.id_ch AND c.id=:id";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id',$id);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    return $result;
}
function HistoPaiementHeb($id,$bdd){
    //Retourne toutes les commandes du sous-resto
    $req = "SELECT re.id_regl,re.numero,re.dte,re.date_regl,re.id_user,pa.montantusd,pa.montantcdf,pa.rendu_usd,pa.rendu_cdf,pa.taux,mo.lib,us.nom_user,us.prenom_user
        FROM t_reglement AS re,paiement AS pa,t_mode_reglement AS mo,t_utilisateur AS us
        WHERE re.id_regl=pa.regl_id 
       AND  mo.id_mode_regl=pa.id_mode_regl 
       AND  re.id_user=us.id_user
       AND re.id_fact=:id
       AND mo.id_mode_regl IN(1,2)
       ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id',$id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function HistoPaiementHebResto($resch_id,$bdd){
    //Retourne toutes les commandes du sous-resto
    $req = "SELECT re.id_regl,re.numero,re.dte,re.date_regl,re.id_user,pa.montantusd,pa.montantcdf,pa.rendu_usd,pa.rendu_cdf,pa.taux,mo.lib,us.nom_user,us.prenom_user
        FROM t_facture AS f,t_reglement AS re,paiement AS pa,t_mode_reglement AS mo,t_utilisateur AS us
        WHERE f.id_fact=re.id_fact AND re.id_regl=pa.regl_id 
       AND  mo.id_mode_regl=pa.id_mode_regl 
       AND  re.id_user=us.id_user
       AND f.res_ch_id=:id
       AND f.mode='Credit'
       AND mo.id_mode_regl IN(1,2)
       ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id',$resch_id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function dateAfficheForHr2($stringdate) {
    if($stringdate!=''){
        $stringdate = trim($stringdate);
        $tmp = explode(" ",$stringdate);
        $date_iso =dateAffiche($tmp[0])." ".$tmp[1];
        return $date_iso;
    }
}
function GetCaffOfDayHeb($bdd){
    $dte=date('Y-m-d');
    $select['usd']=0;
    $select['cdf']=0;
    $fc_usd=$fc_cdf=0;
    $id_user=$_SESSION['id_user'];
    $requete = $bdd->prepare("SELECT SUM(a.usd) AS usd,SUM(a.cdf) AS cdf
                                FROM fondscaisse AS a
                                WHERE a.user_id=:id_user
                                AND a.dte=:dte");
    $requete->BindParam(':id_user',$id_user);
    $requete->BindParam(':dte',$dte);
    $requete->execute();
    $fc = $requete->fetch(PDO::FETCH_OBJ);
    $fc_usd=$fc->usd;
    $fc_cdf=$fc->cdf;
    $requete = $bdd->prepare("SELECT SUM(c.montantusd-c.rendu_usd) AS usd,SUM(c.montantcdf-c.rendu_cdf) AS cdf
                                FROM t_facture AS a, t_reglement AS b, paiement AS c
                                WHERE a.id_fact=b.id_fact AND b.id_regl=c.regl_id
                                AND c.id_mode_regl IN(2)
                                AND b.id_user=:id_user
                                AND b.dte=:dte");
    $requete->BindParam(':id_user',$id_user);
    $requete->BindParam(':dte',$dte);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r){
        $select['usd']=$r->usd;
        $select['cdf']=$r->cdf;
    }
    $select['usd']+=$fc_usd;
    $select['cdf']+=$fc_cdf;
    return $select;
}
function NomRespoByIdRes($id_res,$bdd){
    $req = "
        SELECT e.entreprise AS nom_respo
            FROM t_reservation AS b,t_responsable e
             WHERE b.respo_id=e.id_respo
                   AND b.id_res=:id_res";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id_res',$id_res);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    return $result->nom_respo;
}
function NomClientById($idcl,$bdd){
    $nomcl='';
    if($idcl!=0){
      $req = "
        SELECT *
            FROM t_client
             WHERE id_client=:id";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id',$idcl);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    $nomcl=$result->nom_client;
    
    }
     return $nomcl; 
}
//king
function insertmontantVersement($user_vers,$date_vers,$montant_vers,$montantusd,$monaie_vers,$type_vers,$taux,$motif,$paie_id,$id_hotel,$id_sousresto,$num,$bdd){
    $requete = $bdd->prepare("INSERT INTO  t_versement (user_vers,date_vers,montant_vers,montantusd,monaie_vers,type_vers,taux,motif,id_sousresto,id_hotel,num)
                VALUES(:user_vers,:date_vers,:montant_vers,:montantusd,:monaie_vers,:type_vers,:taux,:motif,:id_sousresto,:id_hotel,:num)");
    /* monnaie Mis pour les besoins de la cause */
    $requete->BindParam(':user_vers',$user_vers);
    $requete->BindParam(':date_vers', $date_vers);
    $requete->BindParam(':montant_vers',$montant_vers);
    $requete->BindParam(':montantusd',$montantusd);
    $requete->BindParam(':monaie_vers', $monaie_vers);
    $requete->BindParam(':type_vers', $type_vers);
    $requete->BindParam(':taux',$taux);
    $requete->BindParam(':motif',$motif);
    $requete->BindParam(':id_sousresto',$id_sousresto);
    $requete->BindParam(':id_hotel',$id_hotel);
    $requete->BindParam(':num',$num);
    $requete->execute();
}
function verifCompteurSite($site_id,$libelle,$bdd){
    $nb=0;
    $bool=0;
    $requete = $bdd->prepare("SELECT COUNT(*) AS nb_lg FROM compteur WHERE libelle=:libelle  AND site_id=:id_hotel");
    /* monnaie Mis pour les besoins de la cause */
    $requete->BindParam(':libelle', $libelle);
    $requete->BindParam(':id_hotel', $site_id);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($operations as $op):
        $nb = $op->nb_lg;
    endforeach;
    if ($nb > 0)$bool=1;
    return $bool;
   
}
function insertCompteurSite($site_id,$libelle,$numero,$bdd){
    $requete = $bdd->prepare("INSERT INTO compteur (libelle,numero,site_id)
                VALUES(:libelle,:numero,:site_id)");
    $requete->BindParam(':libelle',$libelle);
    $requete->BindParam(':numero', $numero);
    $requete->BindParam(':site_id',$site_id);
    $requete->execute();
}


function selectCompteurSite($site_id,$libelle,$bdd){
   $numero=0;
   $requete = $bdd->prepare("SELECT numero FROM compteur WHERE libelle=:libelle  AND site_id=:id_hotel");
    $requete->BindParam(':libelle', $libelle);
    $requete->BindParam(':id_hotel', $site_id);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($operations as $op):
      $numero = $op->numero;
    endforeach;
    return $numero;
}
function getnumerotation($site_id,$libelle,$bdd){
   $num_cmd=1;
   $bool=verifCompteurSite($site_id,$libelle,$bdd);
    if($bool==1){
       $num_cmd=  selectCompteurSite($site_id,$libelle, $bdd);
    }else{
        insertCompteurSite($site_id, $libelle, $num_cmd, $bdd);
    }
    return $num_cmd;
}
function setnumerotation($site_id,$libelle,$numero,$bdd){
    $requete = $bdd->prepare("UPDATE compteur SET numero=:numero WHERE libelle=:libelle AND site_id=:site_id");
    $requete->BindParam(':numero', $numero);
    $requete->BindParam(':libelle',$libelle);
    $requete->BindParam(':site_id',$site_id);
    $requete->execute();
}
function GetClientreserv($datedebut,$datefin,$id,$bdd){
    $req = "SELECT c.id,c.idfact,a.id_res,a.num_reserv,c.monnaie,c.idchambre,
             d.num_ch,c.tarif_ch,c.id_client,e.nom_client,c.nom_accomp,a.dte,g.date_occ,g.date_lib,g.statut,f.taux
        FROM t_reservation AS a,t_reserve_chambre AS c,t_chambre AS d,t_client AS e,t_facture AS f,t_chambre_histo AS g
        WHERE a.id_res=c.idreserv AND c.id_client=e.id_client AND c.idfact=f.id_fact AND c.id=g.idres_ch 
              AND g.idchambre=d.id_ch AND a.id_hotel=:id AND g.reserve=1 AND d.libre='oui'
              AND g.date_occ BETWEEN :p_debut AND :p_fin
              ORDER BY g.date_occ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->BindParam(':p_debut', $datedebut);
    $requete->BindParam(':p_fin', $datefin);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function GetClientloges($datedebut,$datefin,$id, $bdd){
    $req = "SELECT c.id,c.idfact,a.id_res,a.num_reserv,c.monnaie,c.idchambre,
             d.num_ch,c.tarif_ch,c.id_client,e.nom_client,c.nom_accomp,g.date_occ,g.date_lib,g.statut,f.taux,g.libre
        FROM t_reservation AS a,t_reserve_chambre AS c,t_chambre AS d,t_client AS e,t_facture AS f,t_chambre_histo AS g
        WHERE a.id_res=c.idreserv AND c.id_client=e.id_client AND c.idfact=f.id_fact AND c.id=g.idres_ch 
        AND g.idchambre=d.id_ch AND a.id_hotel=:id AND g.statut='occupe' AND d.libre='oui'
        ORDER BY g.date_occ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

//CLIENTS LIBEREES
function GetClientsLiberes($datedebut,$datefin,$id, $bdd) {
    $req = "SELECT c.id,a.id_res,a.num_reserv,c.idchambre,d.num_ch,b.id_client,e.nom_client,g.date_occ,g.date_lib,c.id AS id_resch,g.tarif_ch,b.taux,c.nom_accomp,g.qte
        FROM t_reservation AS a, t_facture AS b, t_reserve_chambre AS c,t_chambre AS d,t_client AS e,t_chambre_histo AS g
        WHERE a.id_res=b.id_res AND b.id_fact=c.idfact 
             AND b.id_client=e.id_client 
              AND g.idchambre=d.id_ch 
              AND c.id=g.idres_ch
              AND a.id_hotel=:id AND g.libre=1 AND d.libre='oui'
              AND g.date_lib BETWEEN :p_debut AND :p_fin
              ORDER BY g.date_lib";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
     $requete->BindParam(':p_debut', $datedebut);
    $requete->BindParam(':p_fin', $datefin);
    $requete->execute();
    $result = $requete->fetchALL(PDO::FETCH_OBJ);
    return $result;
}
function ht($total,$tva,$remise){
//     $ht1=$total-($total*$tva)/100;
//     $ht2=$ht1-($ht1*$remise)/100;
     $ht2=$total-($total*$tva)/100;
     return $ht2;
}
?>


