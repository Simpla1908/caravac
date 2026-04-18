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
// if (!defined('VALID_DIR'))
//     die('You are not allowed to execute this file directly');

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
    //return number_format($mon, 0, ',', '.');
    return $mon;
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
    if ($maffiche == 'USD') {
        $maffiche = '$';
    } else {
        $maffiche = 'FC';
    }
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

function CalculMontHtHeb($montant, $tva)
{
    $ht = ($montant - CalculMontTva($montant, $tva));
    return $ht;
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

function CalculMontTtcHeb($montHt, $montTva)
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

//verifie si une valeur est entier
function IsNombre($val)
{
    $bool = FALSE;
    if (is_numeric($val) && $val > 0) {
        $bool = TRUE;
    }
    return $bool;
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
    $_SESSION['checkin'] = $config->checkin;
    $_SESSION['checkout'] = $config->checkout;
}
function ConfigModule2($module_id, $site_id, $bdd)
{
    $requete = $bdd->prepare("SELECT a.mail,a.nom_hotel,b.* FROM resconfig AS b,t_hotel AS a  WHERE a.id_hotel=b.site_id AND b.module_id=:module_id AND b.site_id=:site_id");
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
    $_SESSION['prefreservation'] = $config->prefreservation;
}

//1HEBERGEMENT
function PeriodeReservation($dte1, $dte2)
{
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
function PeriodeHeberge($dte1, $dte2)
{
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

function startEndDayWeek()
{
    $dte1 = date('Y-m-d');
    // Calcul de l'écart entre le jour de $day et le lundi (=1)
    $rel = 1 - date('N', strtotime($dte1));
    //calcul du lundi avec cet écart
    $monday = date('Y-m-d', strtotime("$rel days", strtotime($dte1)));
    //    $s = date('Y-m-d', strtotime("6days", strtotime($monday)));
    $s = date('Y-m-d', strtotime("6days", strtotime($dte1)));
    $data = array();
    //    $data['sday'] = $monday;
    $data['sday'] = $dte1;
    $data['eday'] = $s;
    return $data;
}

function startEndDayMonth()
{
    $s = date("Y-m-d", mktime(0, 0, 0, date('m'), 1, date('Y')));
    $e = date("Y-m-d", mktime(0, 0, 0, date('m') + 1, 0, date('Y')));
    $data = array();
    $data['sday'] = $s;
    $data['eday'] = $e;
    return $data;
}

function GetListChambre($idsite, $bdd)
{
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

function GetListService($idsite, $bdd)
{
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
function InfosChambres($idsite, $bdd)
{
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
function GetModepaiement($bdd)
{
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

function GetSejourChambre($idsite, $dte1, $dte2, $bdd)
{
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

function GetListClientByNom($idsite, $bdd)
{
    $req = $requete = "SELECT * FROM t_client WHERE type='client' AND pseudo_supp=0 AND id_hotel=:idsite  ORDER BY nom_client";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':idsite', $idsite);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function GetListClientByID($idsite, $bdd)
{
    $req = $requete = "SELECT * FROM t_client WHERE type='client' AND pseudo_supp=0 AND id_hotel=:idsite  ORDER BY id_client DESC";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':idsite', $idsite);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function GetListResponsable($idsite, $bdd)
{
    $req = $requete = 'SELECT * FROM t_responsable AS a,cptsouscomptes AS b WHERE  a.id_sous_compte=b.id AND a.company_id=:idsite ORDER BY a.filtre,a.nom_respo';
    $requete = $bdd->prepare($req);
    $requete->BindParam(':idsite', $idsite);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function getnumerotationresponsable($site_id, $libelle, $num_cmd, $bdd)
{
    $bool = verifCompteurSite($site_id, $libelle, $bdd);
    if ($bool == 1) {
        $num_cmd =  selectCompteurSite($site_id, $libelle, $bdd);
    } else {
        insertCompteurSite($site_id, $libelle, $num_cmd, $bdd);
    }
    return $num_cmd;
}

function InfosFactByChambre($id, $bdd)
{
    $req = "
        SELECT a.*,a.id_client,a.compte1,a.compte2,a.id_fact,a.mode,a.taux,a.tva,a.num_fact,a.date_edition ,b.id AS id_resch,b.idreserv,b.statut,b.date_occ,b.date_lib,b.nom_accomp,b.idchambre,b.occupe,
        c.nom_client,c.adresse_provenance_client,c.email_client,c.telephone_client,c.sexe_client,a.assujetti,a.heb,a.num_cmd,a.date_desactivation,a.montpenalite,a.montremb,a.montpaie
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
function InfosFactByChambre2($id, $bdd)
{
    $req = "
        SELECT a.*,a.id_client,a.id_fact,a.mode,a.id_res,a.taux,a.tva,a.num_fact,a.date_edition ,b.id AS id_resch,b.idreserv,b.statut,b.date_occ,b.date_lib,b.nom_accomp,b.idchambre,b.occupe,
        c.nom_client,c.adresse_provenance_client,c.email_client,c.telephone_client,c.sexe_client,a.assujetti,a.heb,a.num_cmd,a.date_desactivation,a.montpenalite,a.montremb,a.montpaie 
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
function InfosFactHeb($idfact, $bdd)
{
    $req = "
        SELECT a.id_fact,a.mode,a.taux,a.tva,a.num_fact,a.date_edition ,b.id_res,b.etat,b.dte_a,b.dte_s,c.id_client ,c.nom_client,a.num_cmd,a.date_desactivation,a.montpenalite,a.montremb,a.montpaie,
             c.adresse_provenance_client,c.email_client,c.telephone_client,c.sexe_client ,d.id_user,d.nom_user,d.prenom_user,e.entreprise AS nom_respo,a.assujetti
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
function LignesFactByChambre($id, $bdd)
{
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
function LignesFactHeb($idfact, $bdd)
{
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
function AfficheMonnaie($m)
{
    if ($m == 'USD') {
        $m = '$';
    } else {
        $m = 'FC';
    }
    return $m;
}

function AfficheNomChambre($m)
{
    return $m;
}

function prixHebergement($prix, $tva)
{
    return $prix;
}

function NbJours($dte_a, $dte_now)
{
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


function InsertReservation($id_client, $type_heb, $dte, $dte_a, $dte_s, $num_reserv, $m_affiche, $id_hotel, $etat, $statut_res, $mont_total_res, $montant, $libele_mode, $respo_id, $bdd)
{
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
    $requete->BindParam(':respo_id', $respo_id);
    $requete->execute();
    $id_res = $bdd->lastInsertId();
    return $id_res;
}

function InsertFactureHeb($type, $num_fact, $id_res, $tauxdollar, $tva, $m_affiche, $facture, $dte, $id_client, $id_user, $id_hotel, $company_id, $mont_ttc, $valremise, $mode, $fact1, $compte1, $compte2, $chiffre_aff, $bdd)
{
    $requete = $bdd->prepare("INSERT INTO  t_facture (type,num_fact,id_res,taux,tva,monnaie,justification,date_edition,id_client,id_user,id_hotel,company_id,mont_ttc,mont_ttc_remise,mode,fact1,compte1,compte2,chiffre_aff)
			                    VALUES(:type,:num_fact,:id_res,:taux,:tva,:monnaie,:justification,:date_edition,:id_client,:id_user,:id_hotel,:company_id,:mont_ttc ,:mont_ttc_remise,:mode,:fact1,:compte1,:compte2,:chiffre_aff)");
    $requete->BindParam(':type', $type);
    $requete->BindParam(':num_fact', $num_fact);
    $requete->BindParam(':id_res', $id_res);
    $requete->BindParam(':taux', $tauxdollar);
    $requete->BindParam(':tva', $tva);
    $requete->BindParam(':monnaie', $m_affiche);
    $requete->BindParam(':justification', $facture);
    $requete->BindParam(':date_edition', $dte);
    $requete->BindParam(':id_client', $id_client);
    $requete->BindParam(':id_user', $id_user);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->BindParam(':company_id', $company_id);
    $requete->BindParam(':mont_ttc', $mont_ttc);
    $requete->BindParam(':mont_ttc_remise', $valremise);
    $requete->BindParam(':mode', $mode);
    $requete->BindParam(':fact1', $fact1);
    $requete->BindParam(':compte1', $compte1);
    $requete->BindParam(':compte2', $compte2);
    $requete->BindParam(':chiffre_aff', $chiffre_aff);
    $requete->execute();
    $id_fact = $bdd->lastInsertId();
    return $id_fact;
}

function InsertReserveChambre($id_res, $id_fact, $idch, $id_client, $statut, $dte_a, $dte_s, $tarif_ch, $id_accomp, $nom_accomp, $checkin, $checkout, $id_hotel, $monnaie_fact, $bdd)
{
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
    $requete->BindParam(':occupe', $dte_a);
    $requete->execute();
    $idresch = $bdd->lastInsertId();
    return $idresch;
}

function InsertChambreHisto($idres_ch, $idchambre, $statut, $dte_a, $dte_s, $tarif_ch, $monnaie_fact, $qte, $bdd)
{

    if ($statut == 'occupe') {
        $reserve = 0;
        $occupe = 1;
    } else {
        $reserve = 1;
        $occupe = 0;
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
    $requete->BindParam(':qte', $qte);
    $requete->BindParam(':reserve', $reserve);
    $requete->BindParam(':occupe', $occupe);
    $requete->execute();
    $idresch = $bdd->lastInsertId();
    return $idresch;
}

function InsertReglement($num_fact, $id_fact, $dtereglhr, $dte, $id_user, $id_hotel, $bdd)
{
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

function InsertPaiement($montantusd, $montantcdf, $tauxdollar, $rendu, $rendu_usd, $rendu_cdf, $montremise, $justification, $mode, $regl_id, $id_hotel, $company_id, $histch_id, $resch_id, $bdd)
{
    $requete = $bdd->prepare("INSERT INTO  paiement (montantusd,montantcdf,taux,rendu,rendu_usd,rendu_cdf,remise,justification,id_mode_regl,regl_id,site_id,company_id,histch_id,resch_id,motif)
                              VALUES(:montantusd,:montantcdf,:taux,:rendu,:rendu_usd,:rendu_cdf,:remise,:justification,:id_mode_regl,:regl_id,:id_hotel,:company_id,:histch_id,:resch_id,:motif)");
    $motif = 'hebergement';
    $requete->BindParam(':montantusd', $montantusd);
    $requete->BindParam(':montantcdf', $montantcdf);
    $requete->BindParam(':taux', $tauxdollar);
    $requete->BindParam(':rendu', $rendu);
    $requete->BindParam(':rendu_usd', $rendu_usd);
    $requete->BindParam(':rendu_cdf', $rendu_cdf);
    $requete->BindParam(':remise', $montremise);
    $requete->BindParam(':justification', $justification);
    $requete->BindParam(':id_mode_regl', $mode);
    $requete->BindParam(':regl_id', $regl_id);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->BindParam(':company_id', $company_id);
    $requete->BindParam(':histch_id', $histch_id);
    $requete->BindParam(':resch_id', $resch_id);
    $requete->BindParam(':motif', $motif);
    $requete->execute();
    $paie_id = $bdd->lastInsertId();
    return $paie_id;
}
function LiberationChambre($idres_ch, $dte, $nbre_nte, $id_histo, $id_res, $bdd)
{
    //Liberation
    $statut = 'libre';
    $requete = $bdd->prepare("UPDATE t_reserve_chambre  SET statut=:statut,date_lib=:date_lib WHERE id=:id");
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':date_lib', $dte);
    $requete->BindParam(':id', $idres_ch);
    $requete->execute();
    $nbArticles = count($_SESSION['panier']['id_article']);
    $libre = 1;
    $hr_out = date('H:i:s');
    for ($i = 0; $i <= $nbArticles - 1; $i++) {
        $repas = $_SESSION['panier']['repas'][$i];
        if ($repas == '0') {
            $id_histo = $_SESSION['panier']['id_article'][$i];
            $dte_in = $_SESSION['panier']['dte_a'][$i];
            $qte = $_SESSION['panier']['qte'][$i];
            $statut2 = $_SESSION['panier']['statut'][$i];
            $dte_out = date('Y-m-d');
            //            if($dte_in<$dte_out){
            //              $dte_out= AddDaysToDate($dte_in,$qte);  
            //            }
            //Update t_chambre_histo
            $requete = $bdd->prepare("UPDATE t_chambre_histo SET statut=:statut,date_lib=:date_lib,qte=:qte,libre=:libre,hr_out=:hr_out  WHERE id=:id");
            $requete->BindParam(':statut', $statut);
            $requete->BindParam(':date_lib', $dte_out);
            $requete->BindParam(':qte', $qte);
            $requete->BindParam(':libre', $libre);
            $requete->BindParam(':id', $id_histo);
            $requete->BindParam(':hr_out', $hr_out);
            $requete->execute();
        }
    }
    //Update t_reservation
    $etat = 'libre';
    $requete = $bdd->prepare("UPDATE t_reservation SET etat=:etat  WHERE id_res=:id_res ");
    $requete->BindParam(':etat', $etat);
    $requete->BindParam(':id_res', $id_res);
    $requete->execute();
}
function LiberationChambre2($idres_ch, $dte, $nbre_nte, $id_histo, $id_res, $bdd)
{
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
    $requete->BindParam(':date_lib', $dte);
    $requete->BindParam(':qte', $nbre_nte);
    $requete->BindParam(':id', $id_histo);
    $requete->execute();
    //Update t_reservation
    $etat = 'libre';
    $requete = $bdd->prepare("UPDATE t_reservation SET etat=:etat  WHERE id_res=:id_res ");
    $requete->BindParam(':etat', $etat);
    $requete->BindParam(':id_res', $id_res);
    $requete->execute();
}

function OccupationChambre($idres_ch, $id_res, $id_fact, $bdd)
{
    $statut = 'occupe';
    $occupe = 1;
    $requete = $bdd->prepare("UPDATE t_reserve_chambre  SET statut=:statut WHERE id=:id");
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':id', $idres_ch);
    $requete->execute();
    //Update t_chambre_histo
    $requete = $bdd->prepare("UPDATE t_chambre_histo SET statut=:statut,occupe=:occupe WHERE idres_ch=:id  ");
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':occupe', $occupe);
    $requete->BindParam(':id', $idres_ch);
    $requete->execute();
    //Update t_reservation
    $etat = 'occupe';
    $requete = $bdd->prepare("UPDATE t_reservation SET etat=:etat  WHERE id_res=:id_res ");
    $requete->BindParam(':etat', $etat);
    $requete->BindParam(':id_res', $id_res);
    $requete->execute();
    $chiffre_aff = 1;
    $requete = $bdd->prepare("UPDATE t_facture  SET chiffre_aff=:chiffre_aff WHERE id_fact=:id_fact");
    $requete->BindParam(':chiffre_aff', $chiffre_aff);
    $requete->BindParam(':id_fact', $id_fact);
    $requete->execute();
}

//LA LISTE DE PAIEMENT HEB
function GetListPaiement($id, $dte1, $dte2, $bdd)
{
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
               AND c.annuler=0
               AND b.dte BETWEEN :dte1 AND :dte2
               AND a.etat_cmd=0
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
function GetListRecette($idsite, $dte1, $dte2, $bdd)
{
    $_SESSION['recette'] = array();
    $_SESSION['recette']['date'] = array();
    $_SESSION['recette']['sejour'] = array();
    $_SESSION['recette']['consommation'] = array();
    $req = "SELECT f.type,re.dte,pa.taux,pa.montantusd,pa.rendu_usd,pa.montantcdf,pa.rendu_cdf 
            FROM t_facture AS f,t_reglement AS re,paiement AS pa
            WHERE  f.id_fact=re.id_fact
                   AND re.id_regl=pa.regl_id 
                   AND pa.motif IN('hebergement')
                  AND pa.id_mode_regl=2
                  AND pa.annuler=0
                  AND re.dte BETWEEN :dte1 AND :dte2
                  AND f.etat_cmd=0
                  AND pa.site_id=:id
                  ORDER BY re.dte DESC";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $idsite);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchALL(PDO::FETCH_OBJ);
    $montantpaye = 0;
    foreach ($result as $r) {
        $dte = $r->dte;
        $tpfact = $r->type;
        $txp = $r->taux;
        $rendu_cdf = $r->rendu_cdf;
        $rendu_usd = $r->rendu_usd;
        $montantcdf = $r->montantcdf;
        $cdf = $montantcdf - $rendu_cdf;
        $usd = $r->montantusd * $txp - $rendu_usd * $txp;
        $montantpaye = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $usd + $cdf);
        if (!in_array($dte, $_SESSION['recette']['date'])) {
            array_push($_SESSION['recette']['date'], $dte);
            $_SESSION['recette']['consommation'][$dte] = 0;
            $_SESSION['recette']['sejour'][$dte] = 0;
            if ($tpfact == 'restaurant') {
                $_SESSION['recette']['consommation'][$dte] = $montantpaye;
            } else {
                $_SESSION['recette']['sejour'][$dte] = $montantpaye;
            }
        } else {
            if ($tpfact == 'restaurant') {
                $_SESSION['recette']['consommation'][$dte] += $montantpaye;
            } else {
                $_SESSION['recette']['sejour'][$dte] += $montantpaye;
            }
        }
    }
}

function AllFactureMontHeb($idsite, $monnaie_insert, $hrs_sys, $checkout, $bdd)
{
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
    $today = date('Y-m-d');
    $dtecomp = $today;
    $checkin = $_SESSION['checkin'];
    foreach ($result as $r) {
        $fact_id = $r->idfact;
        $monnaie = $r->monnaie;
        $taux = $r->taux;
        $tva = $r->tva;
        $date_occ = $r->date_occ;
        $date_lib = $r->date_lib;
        $statut = $r->statut;
        $tarif_ch = $r->tarif_ch;
        $montpaye = 0;
        if ($statut == 'occupe') {
            if ($hrs_sys < $checkout) {
                $date_lib = DimunuerDaysToDate($dtecomp, 1);
            } else {
                $date_lib = $dtecomp;
            }
        } elseif ($statut == 'change' || $statut == 'reserve') {
            $date_lib = $date_lib;
        }
        $tarif_ch = montant_equivalent_bdd(getsymbole_local(), $monnaie_insert, $taux, $tarif_ch);
        $montpaye = montant_equivalent_bdd(getsymbole_local(), $monnaie_insert, $taux, $montpaye);
        $qte = NbJours($date_occ, $date_lib);
        //Incrémentation de la nuitée par rapport au checkout
        if (($date_occ < $today && $hrs_sys > $checkin) && $statut == 'occupe') {
            $qte++;
        }
    }
    return $data;
}
function FactureMontHeb($idfact, $monnaie_insert, $hrs_sys, $checkout, $bdd)
{
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
    $today = date('Y-m-d');
    $dtecomp = $today;
    $checkin = $_SESSION['checkin'];
    $ttc = 0;
    foreach ($result as $r) {
        $fact_id = $r->idfact;
        $id_res = $r->id_res;
        $monnaie = $r->monnaie;
        $taux = $r->taux;
        $tva = $r->tva;
        $service = $r->libre;
        $date_occ = $r->date_occ;
        $date_lib = $r->date_lib;
        $statut = $r->statut;
        $tarif_ch = $r->tarif_ch;
        $paiech = $r->paie;
        $montpaye = 0;
        if ($service == 'oui') {
            if ($statut == 'occupe') {
                if ($date_occ < $today) {
                    $dtecomp = DimunuerDaysToDate($dtecomp, 1);
                }
            } elseif ($statut == 'change' || $statut == 'reserve') {
                $dtecomp = $date_lib;
            }
            $tarif_ch = montant_equivalent_bdd(getsymbole_local(), $monnaie_insert, $taux, $tarif_ch);
            //        $montpaye = montant_equivalent_bdd(getsymbole_local(),$monnaie_insert, $taux,$montpaye);
            $qte = NbJours($date_occ, $dtecomp);
            //Incrémentation de la nuitée par rapport au checkout
            if (($date_occ < $today && $hrs_sys > $checkout) && $statut == 'occupe') {
                $qte++;
            }
            if ($statut == 'change' || $statut == 'libre') {
                $qte = $r->nuitee;
            }
            if ($paiech == 0) {
                $qte = 0;
            }
            $tarif_ch2 = $tarif_ch * $qte;
        } else {
            $qte = $r->qte;
            $tarif_ch = montant_equivalent_bdd(getsymbole_local(), $monnaie_insert, $taux, $tarif_ch);
            $tarif_ch2 = $tarif_ch * $qte;
        }
        $ttc += $tarif_ch2;
    }
    //Autres services
    $factures_heb = GetFacturesHeb($id_res, $bdd);
    $totResto = 0;
    foreach ($factures_heb as $fh) {
        $txp = $fh->taux;
        $tp = $fh->type;
        if ($tp == 'restaurant' && $fh->mode == 'Credit') {
            $totResto += $fh->mont_ttc;
        }
    }
    return $ttc + $totResto;
}
function AllFactureHeb($idsite, $dte1, $dte2, $bdd)
{
    //RENVOIE LA LISTE DE RESERVATIONS OU FACTURES
    $req = "SELECT a.*,b.dte,b.id_res,b.dte_a ,b.dte_s,b.etat,
          c.id_client,c.nom_client,d.nom_respo,d.entreprise 
            FROM t_facture a,t_reservation b,t_client c,t_responsable AS d
             WHERE a.id_res=b.id_res
                   AND a.id_client=c.id_client
                   AND b.respo_id=d.id_respo
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
function AllFactureHebPartner($idpartner, $idsite, $dte1, $dte2, $bdd)
{
    //RENVOIE LA LISTE DE RESERVATIONS OU FACTURES
    $req = "SELECT a.*,b.dte,b.id_res,b.dte_a ,b.dte_s,b.etat,
          c.id_client,c.nom_client,d.nom_respo,d.entreprise 
            FROM t_facture a,t_reservation b,t_client c,t_responsable AS d
             WHERE a.id_res=b.id_res
                   AND a.id_client=c.id_client
                   AND b.respo_id=d.id_respo
                   AND a.type='hebergement'
                   AND a.date_edition  BETWEEN :dte1 AND :dte2
                   AND b.id_hotel=:id
                   AND d.id_respo=:idpartner";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->BindParam(':id', $idsite);
    $requete->BindParam(':idpartner', $idpartner);

    try {
        $requete->execute();
        $result = $requete->fetchALL(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $result;
}
function AllFactureHeb2($idsite, $fact1, $bdd)
{
    //RENVOIE LA LISTE DE RESERVATIONS OU FACTURES
    if ($fact1 != 5) {
        $req = "SELECT a.id_fact,a.mode,a.taux,a.num_fact,a.id_user,b.dte,b.id_res,b.dte_a ,b.dte_s,b.etat,
          c.id_client,c.nom_client,d.nom_respo,d.entreprise 
            FROM t_facture a,t_reservation b,t_client c,t_responsable AS d
             WHERE a.id_res=b.id_res
                   AND a.id_client=c.id_client
                   AND b.respo_id=d.id_respo
                   AND a.type='hebergement'
                   AND a.fact1=:fact1
                   AND b.id_hotel=:id ORDER BY a.id_fact DESC";
        $requete = $bdd->prepare($req);
        $requete->BindParam(':fact1', $fact1);
        $requete->BindParam(':id', $idsite);
    } else {
        $req = "SELECT a.id_fact,a.mode,a.taux,a.num_fact,a.id_user,b.dte,b.id_res,b.dte_a ,b.dte_s,b.etat,
          c.id_client,c.nom_client,d.nom_respo,d.entreprise 
            FROM t_facture a,t_reservation b,t_client c,t_responsable AS d
             WHERE a.id_res=b.id_res
                   AND a.id_client=c.id_client
                   AND b.respo_id=d.id_respo
                   AND a.type='hebergement'
                   AND b.id_hotel=:id ORDER BY a.id_fact DESC";
        $requete = $bdd->prepare($req);
        $requete->BindParam(':id', $idsite);
    }
    try {
        $requete->execute();
        $result = $requete->fetchALL(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $result;
}
function getchambreIndisponibles($id_hotel, $dte_a, $dte_s, $checkin, $checkout, $hrs_sys, $bdd)
{
    $data['chambres'] = array();
    $data['chambres']['id'] = array();
    $requete = $bdd->prepare("SELECT * FROM t_reserve_chambre AS rc WHERE rc.statut!='libre' AND rc.id_hotel=:id");
    $requete->BindParam(':id', $id_hotel);
    $requete->execute();
    $chambres = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($chambres as $ch) {
        $idch = $ch->idchambre;
        // Avant la date d'occupation       
        if (($dte_a <= $ch->date_occ) && ($dte_s <= $ch->date_occ)) {
            //            if(($hrs_sys > $ch->checkin)){
            array_push($data['chambres']['id'], $idch);
            //            } 

        }
        // Après la date de libération
        elseif (($dte_a >= $ch->date_lib) && ($dte_s >= $ch->date_lib)) {
            //            if($hrs_sys < $ch->checkout){
            array_push($data['chambres']['id'], $idch);
            //            }
        }
        // Pendant
        elseif (($dte_a >= $ch->date_occ) && ($dte_s <= $ch->date_lib)) {
            array_push($data['chambres']['id'], $idch);
        }
    }
    return $data;
}
function getchambreIndisponibles2($id_ch, $dte_a, $dte_s, $checkin, $checkout, $hrs_sys, $bdd)
{
    $data['chambres'] = array();
    $data['chambres']['id'] = array();
    $data['chambres']['nom'] = array();
    $requete = $bdd->prepare("SELECT * FROM t_reserve_chambre AS rc,t_chambre a
                                WHERE a.id_ch=rc.idchambre
                                     AND rc.statut!='libre'
                                     AND rc.idchambre=:id");
    $requete->BindParam(':id', $id_ch);
    $requete->execute();
    $chambres = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($chambres as $ch) {
        $idch = $ch->idchambre;
        // Avant la date d'occupation       
        if (($dte_a <= $ch->date_occ) && ($dte_s == $ch->date_occ)) {
            //            if(($hrs_sys > $ch->checkin)){
            array_push($data['chambres']['id'], $idch);
            //            } 

        }
        // Après la date de libération
        elseif (($dte_a > $ch->date_lib) && ($dte_s == $ch->date_lib)) {
            //            if($hrs_sys < $ch->checkout){
            array_push($data['chambres']['id'], $idch);
            //            }
        }
        // Pendant
        elseif (($dte_a >= $ch->date_occ) && ($dte_s <= $ch->date_lib)) {
            array_push($data['chambres']['id'], $idch);
        } elseif (($ch->date_occ >= $dte_a) && ($ch->date_lib <= $dte_s)) {
            array_push($data['chambres']['id'], $idch);
        }
    }
    return $data;
}
//GET INFOS RECU
function GetRecuInfos($id, $bdd)
{
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
function TotalPayeByChambre($bdd, $id)
{
    $requete = $bdd->prepare("SELECT c.montantusd,c.taux,c.rendu_usd,c.montantcdf,c.rendu_cdf
                                FROM t_facture AS a, t_reglement AS b, paiement AS c
                                WHERE a.id_fact=b.id_fact AND b.id_regl=c.regl_id 
                                AND c.resch_id=:id AND c.annuler=0");
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    $montantpaye = 0;
    foreach ($result as $r) {
        $txp = $r->taux;
        $rendu_cdf = $r->rendu_cdf;
        $montantcdf = $r->montantcdf;
        $cdf = $montantcdf - $rendu_cdf;
        $usd = $r->montantusd * $r->taux - $r->rendu_usd * $r->taux;
        $montantpaye += montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $usd + $cdf);
    }
    return $montantpaye;
}
function TotalPayeSejour($bdd, $id)
{
    $requete = $bdd->prepare("SELECT SUM(c.montantusd*c.taux-c.rendu_usd*c.taux+c.montantcdf-c.rendu_cdf) AS montantpaye
                                FROM t_facture AS a, t_reglement AS b, paiement AS c
                                WHERE a.id_fact=b.id_fact AND b.id_regl=c.regl_id 
                                AND a.id_fact=:id AND c.annuler=0 GROUP BY a.id_fact");
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    $montantpaye = 0;
    foreach ($result as $r) {
        $montantpaye = $r->montantpaye;
    }
    return $montantpaye;
}
function MontPaieFactCh($idfact, $monnaie_insert, $hrs_sys, $checkout, $bdd)
{
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
    $requete->BindParam(':id', $idfact);
    try {
        $requete->execute();
        $result = $requete->fetchALL(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    $today = date('Y-m-d');
    $ttc = 0;
    foreach ($result as $r) {
        $fact_id = $r->idfact;
        $monnaie = $r->monnaie;
        $taux = $r->taux;
        $tva = $r->tva;
        $service = $r->libre;
        $date_occ = $r->date_occ;
        $date_lib = $r->date_lib;
        $statut = $r->statut;
        $tarif_ch = $r->tarif_ch;
        $montpaye = 0;
        if ($service == 'oui') {
            if ($statut == 'occupe') {
                $date_lib = $today;
            } elseif ($statut == 'change' || $statut == 'reserve') {
                $date_lib = $date_lib;
            }
            $tarif_ch = montant_equivalent_bdd(getsymbole_local(), $monnaie_insert, $taux, $tarif_ch);
            $montpaye = montant_equivalent_bdd(getsymbole_local(), $monnaie_insert, $taux, $montpaye);
            $qte = NbJours($date_occ, $date_lib);
            //Incrémentation de la nuitée par rapport au checkout
            if (($date_occ < $today && $hrs_sys > $checkout) && $statut == 'occupe') {
                $qte++;
            }
            $tarif_ch2 = $tarif_ch * $qte;
        } else {
            $qte = $r->qte;
            $tarif_ch = montant_equivalent_bdd(getsymbole_local(), $monnaie_insert, $taux, $tarif_ch);
            $tarif_ch2 = $tarif_ch * $qte;
        }
        $ttc += $tarif_ch2;
    }
    return $ttc;
}
function ChangerChambre($id_reserv_chx, $id_chx_ex, $id_chx_new, $dte_a, $dte_s, $monnaie, $tarif, $nbre_nte, $id_histo, $bdd)
{
    //maj dans table t_reserve_chambre
    $date_occ = date('Y-m-d');
    $paie = 1;
    if ($dte_a == $date_occ) {
        $paie = 0;
    }
    $libre = 1;
    $requete = $bdd->prepare("UPDATE t_reserve_chambre SET idchambre =:idchambre,date_occ=:date_occ,monnaie=:monnaie,tarif_ch=:tarif_ch WHERE id=:id_reserv_chx");
    $requete->BindParam(':idchambre', $id_chx_new);
    $requete->BindParam(':date_occ', $date_occ);
    $requete->BindParam(':monnaie', $monnaie);
    $requete->BindParam(':tarif_ch', $tarif);
    $requete->BindParam(':id_reserv_chx', $id_reserv_chx);
    $requete->execute();
    //maj dans table t_chambre_histo
    $requete = $bdd->prepare("UPDATE t_chambre_histo SET statut ='change',date_lib=:date_lib,paie=:paie,qte=:qte,libre=:libre WHERE idchambre=:idchambre AND idres_ch=:idres_ch");
    $requete->BindParam(':date_lib', $date_occ);
    $requete->BindParam(':paie', $paie);
    $requete->BindParam(':idchambre', $id_chx_ex);
    $requete->BindParam(':idres_ch', $id_reserv_chx);
    $requete->BindParam(':qte', $nbre_nte);
    $requete->BindParam(':libre', $libre);
    $requete->execute();
    //insertion dans t_chambre_histo
    $occupe = 1;
    $statut = 'occupe';
    $qte = 1;
    $requete = $bdd->prepare("INSERT INTO t_chambre_histo (idres_ch,idchambre,statut,date_occ,date_lib,tarif_ch,monnaie,qte,occupe)
                                    VALUES(:idres_ch,:idchambre,:statut,:date_occ,:date_lib,:tarif_ch,:monnaie,:qte,:occupe)");
    $requete->BindParam(':idres_ch', $id_reserv_chx);
    $requete->BindParam(':idchambre', $id_chx_new);
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':date_occ', $date_occ);
    $requete->BindParam(':date_lib', $dte_s);
    $requete->BindParam(':tarif_ch', $tarif);
    $requete->BindParam(':monnaie', $monnaie);
    $requete->BindParam(':qte', $qte);
    $requete->BindParam(':occupe', $occupe);
    $requete->execute();
}
function GetFacturesHeb($id, $bdd)
{
    $req = "SELECT b.*FROM t_facture AS b WHERE b.id_res=:id AND b.etat_cmd<>3";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetchALL(PDO::FETCH_OBJ);
    return $result;
}
function TotPayeHeb($id, $bdd)
{
    //Retourne toutes les commandes du sous-resto
    $requete = $bdd->prepare("SELECT SUM(c.montantusd*c.taux-c.rendu_usd*c.taux+c.montantcdf-c.rendu_cdf) AS montantpaye
                                FROM t_facture AS a, t_reglement AS b, paiement AS c
                                WHERE a.id_fact=b.id_fact AND b.id_regl=c.regl_id
                                 AND c.id_mode_regl IN(1,2)
                                AND a.id_fact=:id AND c.annuler=0  
                                GROUP BY a.id_fact");
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    $montantpaye = 0;
    foreach ($result as $r) {
        $montantpaye = $r->montantpaye;
    }
    return $montantpaye;
}

function GetInfosChambre($id, $bdd)
{
    $req = "SELECT d.*
        FROM t_reserve_chambre AS c,t_chambre AS d
        WHERE c.idchambre=d.id_ch AND c.id=:id";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    return $result;
}
function HistoPaiementHeb($id, $bdd)
{
    //Retourne toutes les commandes du sous-resto
    $req = "SELECT pa.idpaie,re.id_regl,re.numero,re.dte,re.date_regl,re.id_user,pa.montantusd,pa.montantcdf,pa.rendu_usd,pa.rendu_cdf,pa.taux,mo.lib,us.nom_user,us.prenom_user,pa.annuler
        FROM t_reglement AS re,paiement AS pa,t_mode_reglement AS mo,t_utilisateur AS us
        WHERE re.id_regl=pa.regl_id 
       AND  mo.id_mode_regl=pa.id_mode_regl 
       AND  re.id_user=us.id_user
       AND re.id_fact=:id
       AND mo.id_mode_regl IN(1,2)
       ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function HistoPaiementHebResto($resch_id, $bdd)
{
    //Retourne toutes les commandes du sous-resto
    $req = "SELECT re.id_regl,re.numero,re.dte,re.date_regl,re.id_user,pa.montantusd,pa.montantcdf,pa.rendu_usd,pa.rendu_cdf,pa.taux,mo.lib,us.nom_user,us.prenom_user,pa.annuler
        FROM t_facture AS f,t_reglement AS re,paiement AS pa,t_mode_reglement AS mo,t_utilisateur AS us
        WHERE f.id_fact=re.id_fact AND re.id_regl=pa.regl_id 
       AND  mo.id_mode_regl=pa.id_mode_regl 
       AND  re.id_user=us.id_user
       AND f.res_ch_id=:id
       AND f.mode='Credit'
       AND mo.id_mode_regl IN(1,2)
       ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $resch_id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function dateAfficheForHr2($stringdate)
{
    if ($stringdate != '') {
        $stringdate = trim($stringdate);
        $tmp = explode(" ", $stringdate);
        $date_iso = dateAffiche($tmp[0]) . " " . $tmp[1];
        return $date_iso;
    }
}
function GetCaffOfDayHeb($bdd)
{
    $dte = date('Y-m-d');
    $select['usd'] = 0;
    $select['cdf'] = 0;
    $fc_usd = $fc_cdf = 0;
    $id_user = $_SESSION['id_user'];
    $requete = $bdd->prepare("SELECT SUM(a.usd) AS usd,SUM(a.cdf) AS cdf
                                FROM fondscaisse AS a
                                WHERE a.user_id=:id_user
                                AND a.dte=:dte");
    $requete->BindParam(':id_user', $id_user);
    $requete->BindParam(':dte', $dte);
    $requete->execute();
    $fc = $requete->fetch(PDO::FETCH_OBJ);
    $fc_usd = $fc->usd;
    $fc_cdf = $fc->cdf;
    $requete = $bdd->prepare("SELECT SUM(c.montantusd-c.rendu_usd) AS usd,SUM(c.montantcdf-c.rendu_cdf) AS cdf
                                FROM t_facture AS a, t_reglement AS b, paiement AS c
                                WHERE a.id_fact=b.id_fact AND b.id_regl=c.regl_id
                                AND c.id_mode_regl IN(2)
                                AND c.annuler=0
                                AND b.id_user=:id_user
                                AND b.dte=:dte");
    $requete->BindParam(':id_user', $id_user);
    $requete->BindParam(':dte', $dte);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $select['usd'] = $r->usd;
        $select['cdf'] = $r->cdf;
    }
    $select['usd'] += $fc_usd;
    $select['cdf'] += $fc_cdf;
    return $select;
}
function NomRespoByIdRes($id_res, $bdd)
{
    $req = "
        SELECT e.entreprise AS nom_respo
            FROM t_reservation AS b,t_responsable e
             WHERE b.respo_id=e.id_respo
                   AND b.id_res=:id_res";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id_res', $id_res);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    return $result->nom_respo;
}
function NomClientById($idcl, $bdd)
{
    $nomcl = '';
    if ($idcl != 0) {
        $req = "
        SELECT *
            FROM t_client
             WHERE id_client=:id";
        $requete = $bdd->prepare($req);
        $requete->BindParam(':id', $idcl);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_OBJ);
        $nomcl = $result->nom_client;
    }
    return $nomcl;
}
//king
function insertmontantVersement($user_vers, $date_vers, $montant_vers, $montantusd, $monaie_vers, $type_vers, $taux, $motif, $paie_id, $id_hotel, $id_sousresto, $num, $bdd)
{
    $requete = $bdd->prepare("INSERT INTO  t_versement (user_vers,date_vers,montant_vers,montantusd,monaie_vers,type_vers,taux,motif,id_sousresto,id_hotel,num)
                VALUES(:user_vers,:date_vers,:montant_vers,:montantusd,:monaie_vers,:type_vers,:taux,:motif,:id_sousresto,:id_hotel,:num)");
    /* monnaie Mis pour les besoins de la cause */
    $requete->BindParam(':user_vers', $user_vers);
    $requete->BindParam(':date_vers', $date_vers);
    $requete->BindParam(':montant_vers', $montant_vers);
    $requete->BindParam(':montantusd', $montantusd);
    $requete->BindParam(':monaie_vers', $monaie_vers);
    $requete->BindParam(':type_vers', $type_vers);
    $requete->BindParam(':taux', $taux);
    $requete->BindParam(':motif', $motif);
    $requete->BindParam(':id_sousresto', $id_sousresto);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->BindParam(':num', $num);
    $requete->execute();
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
function GetClientreserv($datedebut, $datefin, $id, $bdd)
{
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
function GetClientloges($datedebut, $datefin, $id, $bdd)
{
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
function GetClientsLiberes($datedebut, $datefin, $id, $bdd)
{
    $req = "SELECT c.id,a.id_res,a.num_reserv,c.idchambre,d.num_ch,b.id_client,e.nom_client,g.date_occ,g.date_lib,c.id AS id_resch,g.tarif_ch,b.taux,c.nom_accomp,g.qte,b.id_fact,b.num_fact
        FROM t_reservation AS a, t_facture AS b, t_reserve_chambre AS c,t_chambre AS d,t_client AS e,t_chambre_histo AS g
        WHERE a.id_res=b.id_res AND b.id_fact=c.idfact 
             AND b.id_client=e.id_client 
              AND g.idchambre=d.id_ch 
              AND c.id=g.idres_ch
              AND a.id_hotel=:id AND g.libre=1 AND d.libre='oui'
              AND g.date_lib BETWEEN :p_debut AND :p_fin
              GROUP BY g.idres_ch
              ORDER BY g.date_lib";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->BindParam(':p_debut', $datedebut);
    $requete->BindParam(':p_fin', $datefin);
    $requete->execute();
    $result = $requete->fetchALL(PDO::FETCH_OBJ);
    return $result;
}
function TotSolde($id_user, $dte, $bdd)
{
    //Retourne montant payé saisi et rendu
    $select['percu_cdf'] = 0;
    $select['percu_usd'] = 0;
    $select['rendu_usd'] = 0;
    $select['rendu_cdf'] = 0;
    $select['remb_usd'] = 0;
    $select['remb_cdf'] = 0;
    $requete = $bdd->prepare("SELECT SUM(f.montrembusd) AS remb_usd,SUM(f.montrembcdf) AS remb_cdf,SUM(b.montantcdf) AS percu_cdf,SUM(b.montantusd) AS percu_usd,b.id_sousresto,
       SUM(b.rendu_cdf) AS rendu_cdf,SUM(b.rendu_usd) AS rendu_usd,a.dte AS date_vers,a.id_user AS user_vers,d.nom_user,d.prenom_user
        FROM t_facture AS f,t_reglement AS a,paiement AS b,t_utilisateur AS d
        WHERE f.id_fact=a.id_fact 
             AND a.id_regl=b.regl_id 
             AND a.id_user=d.id_user
             AND b.annuler=0
             AND b.motif IN('hebergement')
             AND b.id_mode_regl IN(2)
			 AND a.id_user=:id_user
             AND a.dte BETWEEN :dte AND :dte 
        GROUP BY a.dte,a.id_user");
    $requete->BindParam(':dte', $dte);
    $requete->BindParam(':id_user', $id_user);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $select['percu_cdf'] = $r->percu_cdf;
        $select['percu_usd'] = $r->percu_usd;
        $select['rendu_usd'] = $r->rendu_usd;
        $select['rendu_cdf'] = $r->rendu_cdf;
        $select['remb_usd'] = $r->remb_usd;
        $select['remb_cdf'] = $r->remb_cdf;
    }
    return $select;
}
function RespoUpdate($id_res, $respo_id, $bdd)
{
    //Update t_reservation
    $requete = $bdd->prepare("UPDATE t_reservation SET respo_id=:respo_id  WHERE id_res=:id_res ");
    $requete->BindParam(':respo_id', $respo_id);
    $requete->BindParam(':id_res', $id_res);
    $requete->execute();
}
function DetailsVenteHeb($d1, $d2, $bdd)
{
    $data = array();
    $data['id'] = array();
    $data['chambre'] = array();
    $data['tarif'] = array();
    $data['nuites_cash'] = array();
    $data['prix_total_cash'] = array();
    $data['nuites_credit'] = array();
    $data['prix_total_credit'] = array();
    $data['nuites_don'] = array();
    $data['prix_total_don'] = array();
    $data['numTarif'] = array();
    $data['taux'] = array();
    $requete = $bdd->prepare("SELECT e.id_ch,e.num_ch,a.prix,SUM(a.nuite) AS nuite,SUM(a.montant) AS montant,a.dte,d.mode,d.taux
    FROM  factchambre AS a,t_chambre AS e,t_facture AS d
    WHERE a.facture_id=d.id_fact 
    AND a.ch_id=e.id_ch 
    AND d.id_hotel=:id_hotel
    AND a.dte BETWEEN :dte1 AND :dte2
    AND d.etat_cmd=0
    GROUP BY a.ch_id
    ORDER BY e.num_ch,a.prix ASC");
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->BindParam(':dte1', $d1);
    $requete->BindParam(':dte2', $d2);
    $requete->execute();
    $occupations = $requete->fetchAll(PDO::FETCH_OBJ);


    foreach ($occupations as $r) {
        $id = $r->id_ch;
        $num_ch = $r->num_ch;
        $mode = $r->mode;
        $tarif = $r->prix;
        $qte = $r->nuite;
        $montant = $r->montant;
        $taux = $r->taux;
        $numTarif = $id . $tarif;


        if (!in_array($numTarif, $data['numTarif'])) {
            array_push($data['numTarif'], $numTarif);
        }

        $data['id'][$numTarif] = $id;
        $data['chambre'][$numTarif] = $num_ch;
        $data['tarif'][$numTarif] = $tarif;
        $data['taux'][$numTarif] = $taux;

        if ($mode == 'Cash') {
            $data['nuites_cash'][$numTarif] = $qte;
            $data['nuites_credit'][$numTarif] = 0;
            $data['nuites_don'][$numTarif] = 0;
            $data['prix_total_cash'][$numTarif] = $montant;
            $data['prix_total_credit'][$numTarif] = 0;
            $data['prix_total_don'][$numTarif] = 0;
        } elseif ($mode == 'Credit') {
            $data['nuites_cash'][$numTarif] = 0;
            $data['nuites_credit'][$numTarif] = $qte;
            $data['nuites_don'][$numTarif] = 0;
            $data['prix_total_cash'][$numTarif] = 0;
            $data['prix_total_credit'][$numTarif] = $montant;
            $data['prix_total_don'][$numTarif] = 0;
        } elseif ($mode == 'Don') {
            $data['nuites_cash'][$numTarif] = 0;
            $data['nuites_credit'][$numTarif] = 0;
            $data['nuites_don'][$numTarif] = $qte;
            $data['prix_total_cash'][$numTarif] = 0;
            $data['prix_total_credit'][$numTarif] = 0;
            $data['prix_total_don'][$numTarif] = $montant;
        }
    }

    return $data;
}
function PrixChambreUpdate($tarif_ch, $ch_histo_id, $bdd)
{
    //Update t_chambre_histo
    $requete = $bdd->prepare("UPDATE t_chambre_histo SET tarif_ch =:tarif_ch,monnaie=:monnaie  WHERE id=:id");
    $requete->BindParam(':tarif_ch', $tarif_ch);
    $requete->BindParam(':monnaie', $_SESSION['Paie_affiche']);
    $requete->BindParam(':id', $ch_histo_id);
    $requete->execute();
}
function AnnulerPaiement($reglement_id, $bdd)
{
    //Update paiement
    $annuler = 1;
    $requete = $bdd->prepare("UPDATE paiement SET annuler =:annuler  WHERE regl_id=:regl_id");
    $requete->BindParam(':annuler', $annuler);
    $requete->BindParam(':regl_id', $reglement_id);
    $requete->execute();
}
function ListeUsers($bdd)
{
    $requete = $bdd->prepare("SELECT * FROM t_utilisateur WHERE psedo=0 AND id_hotel=:id_hotel AND (module_name='Hebergement' OR type=1) ORDER BY nom_user,prenom_user");
    $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function DimunuerDaysToDate($dte, $nbrejr)
{
    //A ne pas modifier
    return $dte;
}
function ReduiceDaysToDate($dte, $nbrejr)
{
    $addjr = '-' . $nbrejr . 'days';
    $date_collect = date("Y-m-d", strtotime($dte . $addjr));
    $new_date_collect = $date_collect;
    return $new_date_collect;
}
function ClientTVA($val)
{
    $libelle = 'Assujetti';
    if ($val == 0) {
        $libelle = 'Exonéré';
    }
    return $libelle;
}
function TVAUpdateFacture($assujetti, $id_fact, $bdd)
{
    //facture client assujeti à la tva
    $requete = $bdd->prepare("UPDATE t_facture SET assujetti=:assujetti WHERE id_fact=:id_fact");
    $requete->BindParam(':assujetti', $assujetti);
    $requete->BindParam(':id_fact', $id_fact);
    $requete->execute();
}
function GetClientFiche($datedebut, $datefin, $id, $bdd)
{
    $req = "SELECT e.*
        FROM t_reservation AS a,t_reserve_chambre AS c,t_chambre AS d,t_client AS e,t_facture AS f,t_chambre_histo AS g
        WHERE a.id_res=c.idreserv AND c.id_client=e.id_client AND c.idfact=f.id_fact AND c.id=g.idres_ch 
        AND g.idchambre=d.id_ch AND a.id_hotel=:id  AND d.libre='oui'
        AND g.date_occ BETWEEN :p_debut AND :p_fin
        GROUP BY e.id_client
        ORDER BY e.nom_client";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->BindParam(':p_debut', $datedebut);
    $requete->BindParam(':p_fin', $datefin);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function UpdateFacthebres($id_fact, $num_recu, $dteannule, $montpenalite, $bdd)
{
    $etat_cmd = 3;
    $heb = 0;
    //$dteannulation=date('Y-m-d');
    $requete = $bdd->prepare("UPDATE t_facture SET etat_cmd=:etat_cmd,heb=:heb,num_cmd=:num_cmd,date_desactivation=:date_desactivation,montpenalite=:montpenalite WHERE id_fact=:id_fact");
    $requete->BindParam(':etat_cmd', $etat_cmd);
    $requete->BindParam(':heb', $heb);
    $requete->BindParam(':num_cmd', $num_recu);
    $requete->BindParam(':date_desactivation', $dteannule);
    $requete->BindParam(':montpenalite', $montpenalite);
    $requete->BindParam(':id_fact', $id_fact);
    $requete->execute();
}
function Verifcfgannulationreservation($bdd)
{
    $requete = $bdd->prepare("SELECT * FROM reservationconfig WHERE site_id=:id");
    $requete->BindParam(':id', $_SESSION['idsite']);
    $requete->execute();
    $res = $requete->fetchAll(PDO::FETCH_OBJ);
    $val = count($res);
    return $val;
}
function Getcfgannulationreservation($bdd)
{
    $requete = $bdd->prepare("SELECT * FROM reservationconfig WHERE site_id=:id");
    $requete->BindParam(':id', $_SESSION['idsite']);
    $requete->execute();
    $res = $requete->fetch(PDO::FETCH_OBJ);
    return $res;
}
function InsertAnnulationResconfig($penalite, $retention, $valmont, $jrannule, $bdd)
{
    $manuel = 1;
    $requete = $bdd->prepare("INSERT INTO  reservationconfig (manuel,penalite,retention,valmont,jrannule,site_id,monnaie)
                                    VALUES(:manuel,:penalite,:retention,:valmont,:jrannule,:site_id,:monnaie)");
    $requete->BindParam(':manuel', $manuel);
    $requete->BindParam(':penalite', $penalite);
    $requete->BindParam(':retention', $retention);
    $requete->BindParam(':valmont', $valmont);
    $requete->BindParam(':valmont', $valmont);
    $requete->BindParam(':jrannule', $jrannule);
    $requete->BindParam(':monnaie', $_SESSION['Paie_affiche']);
    $requete->BindParam(':site_id', $_SESSION['idsite']);
    $requete->execute();
}
function UpdateAnnulationResconfig($penalite, $retention, $valmont, $jrannule, $bdd)
{
    $requete = $bdd->prepare("UPDATE reservationconfig  SET penalite=:penalite,retention=:retention,valmont=:valmont,jrannule=:jrannule,monnaie=:monnaie WHERE site_id=:id");
    $requete->BindParam(':penalite', $penalite);
    $requete->BindParam(':retention', $retention);
    $requete->BindParam(':valmont', $valmont);
    $requete->BindParam(':jrannule', $jrannule);
    $requete->BindParam(':monnaie', $_SESSION['Paie_affiche']);
    $requete->BindParam(':id', $_SESSION['idsite']);
    $requete->execute();
}
function libjrannulation($jr)
{
    $data = array();
    $data['lib'] = "";
    $data['text'] = "";
    $lib = '';
    if ($jr == 0) {
        $lib = "Même jour que la date d'occupation";
    } elseif ($jr == 1) {
        $lib = "24 heures avant la date d'occupation";
    } elseif ($jr == 2) {
        $lib = "48 heures avant la date d'occupation";
    } elseif ($jr == 3) {
        $lib = "72 heures avant la date d'occupation";
    }
    $data['lib'] = $jr;
    $data['text'] = $lib;
    return $data;
}
function libmontretenir($jr)
{
    $data = array();
    $data['lib'] = "";
    $data['opval'] = "";
    $data['text'] = "";
    if ($jr == 'nuite') {
        $lib = "en nuitée";
        $data['lib'] = "nuitée(s)";
        $data['text'] = "en nuitée";
    } elseif ($jr == 'pourcentage') {
        $data['lib'] = "%";
        $data['text'] = "24 heures avant la date d'occupation";
    } elseif ($jr == 'chiffre') {
        $lib = "72 heures avant la date d'occupation";
        $data['lib'] = 'chiffre';
        $data['text'] = $_SESSION['Paie_affiche'];
    }
    $data['opval'] = $jr;
    return $data;
}
function listereservations($bdd)
{
    $req = "SELECT f.id_fact,c.id,c.tarif_ch,c.occupe,f.taux
        FROM t_reservation AS a,t_reserve_chambre AS c,t_facture AS f
        WHERE a.id_res=f.id_res AND c.idfact=f.id_fact 
               AND a.type='reservation' AND f.heb=1 AND f.id_hotel=:id ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $_SESSION['idsite']);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
function LiberationChambre3($idres_ch, $bdd)
{
    //Liberation
    $statut = 'libre';
    $requete = $bdd->prepare("UPDATE t_reserve_chambre  SET statut=:statut WHERE id=:id");
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':id', $idres_ch);
    $requete->execute();
    //Update t_chambre_histo
    $requete = $bdd->prepare("UPDATE t_chambre_histo SET statut=:statut WHERE idres_ch=:id");
    $requete->BindParam(':statut', $statut);
    $requete->BindParam(':id', $idres_ch);
    $requete->execute();
}
function UpdtRemboursement($id_fact, $montremb, $tauxremb, $montpaie, $bdd)
{
    if ($_SESSION['Paie_affiche'] == getsymbole_devise()) {
        $montremb = $montremb * $tauxremb;
        $montpaie = $montpaie * $tauxremb;
    }
    $requete = $bdd->prepare("UPDATE t_facture SET montremb=:montremb,montpaie=:montpaie WHERE id_fact=:id_fact");
    $requete->BindParam(':montremb', $montremb);
    $requete->BindParam(':montpaie', $montpaie);
    $requete->BindParam(':id_fact', $id_fact);
    $requete->execute();
}
function SetMontsRembourFact($id_fact, $montrembusd, $montrembcdf, $bdd)
{

    $requete = $bdd->prepare("UPDATE t_facture SET montrembusd=:montrembusd,montrembcdf=:montrembcdf WHERE id_fact=:id_fact");
    $requete->BindParam(':montrembusd', $montrembusd);
    $requete->BindParam(':montrembcdf', $montrembcdf);
    $requete->BindParam(':id_fact', $id_fact);
    $requete->execute();
}
function GetMontsRembourFact($id_fact, $bdd)
{
    $data = array();
    $data['montrembusd'] = array();
    $data['montrembcdf'] = array();
    $requete = 'SELECT montrembusd,montrembcdf FROM  t_facture WHERE id_fact=:id_fact';
    $query = $bdd->prepare($requete);
    $query->BindParam(':id_fact', $id_fact);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $montrembusd = $r->montrembusd;
        $montrembcdf = $r->montrembcdf;
    }
    $data['montrembusd'] = $montrembusd;
    $data['montrembcdf'] = $montrembcdf;
    return $data;
}
function GetSejourClient($id_hotel, $dte1, $dte2, $bdd)
{
    $req = " SELECT a.nom_client,b.num_ch,d.tarif_ch,d.date_occ,d.date_lib,d.qte,d.idres_ch,c.idfact,d.statut,d.paie,f.taux
FROM t_client AS a, t_reserve_chambre AS c,t_chambre_histo AS d,t_chambre AS b,t_facture AS f
  WHERE a.id_client=c.id_client AND 
        c.idfact=f.id_fact AND
	c.id=d.idres_ch AND 
	d.idchambre=b.id_ch
    AND f.etat_cmd=0
	AND d.idres_ch IN(SELECT resch_id FROM t_reglement AS r,paiement AS p 
                WHERE r.id_regl=p.regl_id 
                AND r.dte BETWEEN :dte1 AND :dte2
                AND p.site_id=:id_hotel)";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
//LA LISTE DE RECETTES HEBERGEMENT
function paieSejour($site_id, $dte1, $dte2, $bdd)
{
    $_SESSION['paiesej'] = array();
    $_SESSION['paiesej']['date'] = array();
    $_SESSION['paiesej']['sejour'] = array();
    $_SESSION['paiesej']['consommation'] = array();
    $req = "SELECT f.type,re.dte,pa.taux,pa.montantusd,pa.rendu_usd,pa.montantcdf,pa.rendu_cdf,pa.resch_id 
            FROM t_facture AS f,t_reglement AS re,paiement AS pa
            WHERE  f.id_fact=re.id_fact
                   AND re.id_regl=pa.regl_id 
                   AND pa.motif IN('hebergement')
                  AND pa.id_mode_regl=2
                  AND pa.annuler=0
                  AND re.dte BETWEEN :dte1 AND :dte2
                  AND pa.site_id=:id";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $site_id);
    $requete->BindParam(':dte1', $dte1);
    $requete->BindParam(':dte2', $dte2);
    $requete->execute();
    $result = $requete->fetchALL(PDO::FETCH_OBJ);
    $montantpaye = 0;
    foreach ($result as $r) {
        $dte = $r->resch_id;
        $tpfact = $r->type;
        $txp = $r->taux;
        $rendu_cdf = $r->rendu_cdf;
        $rendu_usd = $r->rendu_usd;
        $montantcdf = $r->montantcdf;
        $cdf = $montantcdf - $rendu_cdf;
        $usd = $r->montantusd * $txp - $rendu_usd * $txp;
        $montantpaye = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $txp, $usd + $cdf);
        if (!in_array($dte, $_SESSION['paiesej']['date'])) {
            array_push($_SESSION['paiesej']['date'], $dte);
            if ($tpfact == 'restaurant') {
                $_SESSION['paiesej']['consommation'][$dte] = $montantpaye;
            } else {
                $_SESSION['paiesej']['sejour'][$dte] = $montantpaye;
            }
        } else {
            if ($tpfact == 'restaurant') {
                $_SESSION['paiesej']['consommation'][$dte] += $montantpaye;
            } else {
                $_SESSION['paiesej']['sejour'][$dte] += $montantpaye;
            }
        }
    }
}





function TarifChambre($categorie_id, $bdd)
{
    $req = "
        SELECT a.tarif,a.monnaie
            FROM categorie_chambre a
             WHERE a.id_cat_cha=:id_cat_cha";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id_cat_cha', $categorie_id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function GetClientreservOnline($datedebut, $datefin, $id, $bdd)
{
    $req = "SELECT c.id,c.idfact,a.id_res,a.num_reserv,c.monnaie,c.idchambre,j.montantcdf,f.mont_ttc, j.montantusd,j.rendu_usd,j.rendu_cdf,
             d.num_ch,c.tarif_ch,c.id_client,e.nom_client,c.nom_accomp,a.dte,g.date_occ,g.date_lib,g.statut,f.taux,j.justification
        FROM t_reservation AS a,t_reserve_chambre AS c,t_chambre AS d,t_client AS e,t_facture AS f,t_chambre_histo AS g,t_reglement AS h,paiement AS j
        WHERE a.id_res=c.idreserv AND c.id_client=e.id_client AND c.idfact=f.id_fact AND c.id=g.idres_ch AND f.id_fact=h.id_fact AND h.id_regl=j.regl_id
              AND g.idchambre=d.id_ch AND a.id_hotel=:id AND g.reserve=1 AND d.libre='oui' AND a.statut_occ='online' AND j.annuler=0
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
function GetNumReservation($id, $bdd)
{
    $req = "SELECT a.num_reserv
            FROM t_reservation a
             WHERE a.id_res=:id_res";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id_res', $id);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    return $result->num_reserv;
}
function GetNumRecu($id, $bdd)
{
    $req = "SELECT a.numero
            FROM t_reglement a
             WHERE a.id_fact=:id_fact";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id_fact', $id);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    return $result->numero;
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
function factChambre($nuite, $prix, $montant, $dte, $ch_id, $reservech_id, $facture_id, $site_id, $bdd)
{
    $requete = $bdd->prepare("INSERT INTO factchambre (nuite,prix,montant,dte,ch_id,reservech_id,facture_id,site_id)
					     VALUES(:nuite,:prix ,:montant,:dte,:ch_id,:reservech_id,:facture_id,:site_id)");
    $requete->BindParam(':nuite', $nuite);
    $requete->BindParam(':prix', $prix);
    $requete->BindParam(':montant', $montant);
    $requete->BindParam(':dte', $dte);
    $requete->BindParam(':ch_id', $ch_id);
    $requete->BindParam(':reservech_id', $reservech_id);
    $requete->BindParam(':facture_id', $facture_id);
    $requete->BindParam(':site_id', $site_id);
    $requete->execute();
    /*  $idresch = $bdd->lastInsertId();
    return $idresch; */
}
function AddSaleRooms($datedebut, $datefin, $id, $bdd)
{
    $dte = date('Y-m-d');

    $billedRooms = array();
    $billedRooms['id'] = array();
    $billedRooms['dte'] = array();
    $billedRooms['code'] = array();

    // Billed Rooms 
    $req = "SELECT fc.ch_id, MAX(fc.dte) AS dte
    FROM factchambre fc ,t_chambre_histo cht
    WHERE fc.site_id=:site_id
       AND fc.reservech_id=cht.id
       AND cht.statut='occupe'
    GROUP BY fc.ch_id";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':site_id', $id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        array_push($billedRooms['id'], $r->ch_id);
        $billedRooms['dte'][$r->ch_id] = $r->dte;
        array_push($billedRooms['code'], $r->ch_id . $r->dte);
    }

    $req = "SELECT g.id AS idhistoch,a.id_hotel,c.id,c.idfact,a.id_res,a.num_reserv,c.monnaie,c.idchambre,
             d.num_ch,c.tarif_ch,c.id_client,e.nom_client,c.nom_accomp,g.date_occ,g.date_lib,g.statut,f.taux,g.libre
        FROM t_reservation AS a,t_reserve_chambre AS c,t_chambre AS d,t_client AS e,t_facture AS f,t_chambre_histo AS g
        WHERE a.id_res=c.idreserv AND c.id_client=e.id_client AND c.idfact=f.id_fact AND c.id=g.idres_ch 
        AND g.idchambre=d.id_ch AND a.id_hotel=:id AND g.statut='occupe' AND d.libre='oui'
        ORDER BY g.date_occ";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($result as $r) {
        $date_occ = date('Y-m-d');
        // Au cas ou la facturation avait echouee
        if (isset($billedRooms['dte'][$r->idchambre])) {
            $date_occ = $billedRooms['dte'][$r->idchambre];
        } else {
            $date_occ = $r->date_occ;
        }

        $d1 = new DateTime($dte);
        $d2 = new DateTime($date_occ);
        $diff = $d1->diff($d2);
        $nuite = $diff->format('%d');
        $tarif_ch = $r->tarif_ch;
        $montant = floatval($nuite * $r->tarif_ch);
        $idch = $r->idchambre;
        $chhisto_id = $r->idhistoch;
        $id_fact = $r->idfact;
        $site_id = $r->id_hotel;

        if (!in_array($idch, $billedRooms['code']) && $nuite > 0) {
            for ($i = 1; $i <= $nuite; $i++) {

                $montant = $tarif_ch;
                $nuitex = 1;
                $pref = '+' . $i . ' days';
                $date = date_create($date_occ);
                date_modify($date, $pref);
                $dtecalc = date_format($date, 'Y-m-d');
                factChambre($nuitex, $tarif_ch, $montant, $dtecalc, $idch, $chhisto_id, $id_fact, $site_id, $bdd);
            }
        }
    }

    return $result;
}

function diffBetweenTimes($time)
{
    /* $dt=date('Y-M-d').' '.$time;
     $time = new DateTime($dt);
    $timediff =$time->diff(new DateTime());
    $start =$timediff->format('%h');
    return $start; */
    $start = 0;
    $hrs_sys = date('H:i') . ':00';
    if ($hrs_sys > $time) {
        $start = 1;
    }
    return $start;
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

function detailsSaleService($d1, $d2, $idsite, $bdd)
{
    $data = array();
    $data['id'] = array();
    $data['chambre'] = array();
    $data['tarif'] = array();
    $data['nuites_cash'] = array();
    $data['prix_total_cash'] = array();
    $data['nuites_credit'] = array();
    $data['prix_total_credit'] = array();
    $data['nuites_don'] = array();
    $data['prix_total_don'] = array();
    $data['numTarif'] = array();
    $data['taux'] = array();
    $requete = $bdd->prepare("SELECT a.id,a.idchambre,a.statut,a.date_occ,e.num_ch,a.tarif_ch,a.monnaie,d.mode,SUM(a.qte) AS qte,SUM(a.qte*a.tarif_ch) AS montant,d.taux
    FROM  t_chambre_histo AS a,t_chambre AS e,t_reserve_chambre AS b,t_facture AS d
    WHERE  a.idres_ch=b.id AND a.idchambre=e.id_ch AND b.idfact=d.id_fact 
    AND d.id_hotel=:id_hotel
    AND a.statut='service'
    AND a.date_occ BETWEEN :dte1 AND :dte2
    GROUP BY a.idchambre
    ORDER BY e.num_ch,a.tarif_ch ASC");
    $requete->BindParam(':id_hotel', $idsite);
    $requete->BindParam(':dte1', $d1);
    $requete->BindParam(':dte2', $d2);
    $requete->execute();

    $saleServices = $requete->fetchAll(PDO::FETCH_OBJ);


    foreach ($saleServices as $r) {
        $id = $r->idchambre;
        $num_ch = $r->num_ch;
        $mode = $r->mode;
        $tarif = $r->tarif_ch;
        $qte = $r->qte;
        $montant = $r->montant;
        $taux = $r->taux;
        $numTarif = $id . $tarif;


        if (!in_array($numTarif, $data['numTarif'])) {
            array_push($data['numTarif'], $numTarif);
        }

        $data['id'][$numTarif] = $id;
        $data['chambre'][$numTarif] = $num_ch;
        $data['tarif'][$numTarif] = $tarif;
        $data['taux'][$numTarif] = $taux;

        if ($mode == 'Cash') {
            $data['nuites_cash'][$numTarif] = $qte;
            $data['nuites_credit'][$numTarif] = 0;
            $data['nuites_don'][$numTarif] = 0;
            $data['prix_total_cash'][$numTarif] = $montant;
            $data['prix_total_credit'][$numTarif] = 0;
            $data['prix_total_don'][$numTarif] = 0;
        } elseif ($mode == 'Credit') {
            $data['nuites_cash'][$numTarif] = 0;
            $data['nuites_credit'][$numTarif] = $qte;
            $data['nuites_don'][$numTarif] = 0;
            $data['prix_total_cash'][$numTarif] = 0;
            $data['prix_total_credit'][$numTarif] = $montant;
            $data['prix_total_don'][$numTarif] = 0;
        } elseif ($mode == 'Don') {
            $data['nuites_cash'][$numTarif] = 0;
            $data['nuites_credit'][$numTarif] = 0;
            $data['nuites_don'][$numTarif] = $qte;
            $data['prix_total_cash'][$numTarif] = 0;
            $data['prix_total_credit'][$numTarif] = 0;
            $data['prix_total_don'][$numTarif] = $montant;
        }
    }

    return $data;
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

function COMPTA_RESERVATION_HEBERGE($montant_nuite, $type_rendu, $reference, $dte, $dtetime, $mode, $montantusd, $montantcdf, $montantsaisi, $ht, $tva, $ttc, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd)
{
    ExerciceEncours($site_id, $bdd);
    $exercice_id = $_SESSION['exercice_id'];
    $journal_id = 3;
    $devise_op = '';
    if ($mode == 'Cash') {
        $credit_client = 0;
        $dteaff = $dte;
        $psedo = 0;
        $restecdf = 0;
        $resteusd = 0;
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
                $libelle = 'Hebergement : paiement reservation en CDF';
                $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
                $devise_op = 'CDF';
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
                $credit_client = $montantcdf;
                //CLIENT
                $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
                $long_compte = $_SESSION['Customer_long_compte'];
                $souscompte_id = $_SESSION['Customer_souscompte_id'];
                $categorie_id = $_SESSION['Customer_categorie_id'];
                $compte_id = $_SESSION['Customer_compte_id'];
                $debit = 0;
                $credit = $credit_client;
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
                $requete->BindParam(':devise', $devise);
                $requete->BindParam(':journal_id', $journal_id);
                $requete->BindParam(':exercice_id', $exercice_id);
                $requete->BindParam(':site_id', $site_id);
                $requete->BindParam(':ecriture_id', $ecriture_id);
                $requete->execute();
                //CLIENT           
            } elseif ($montantusd >= $ttc_usd) {
                $resteusd = $montantusd - $ttc_usd;
                $montantusd = $ttc_usd;
                $restecdf = $montantcdf;
                //Ecriture Monnaie etrangere
                $deviseusd = 'USD';
                $libelle = "Hebergement : paiement reservation en USD";
                $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
                $devise_op = 'USD';
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
                $credit_client = $montantusd;
                //CLIENT
                $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
                $long_compte = $_SESSION['Customer_long_compte'];
                $souscompte_id = $_SESSION['Customer_souscompte_id'];
                $categorie_id = $_SESSION['Customer_categorie_id'];
                $compte_id = $_SESSION['Customer_compte_id'];
                $debit = 0;
                $credit = $credit_client;
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
                $requete->BindParam(':devise', $devise);
                $requete->BindParam(':journal_id', $journal_id);
                $requete->BindParam(':exercice_id', $exercice_id);
                $requete->BindParam(':site_id', $site_id);
                $requete->BindParam(':ecriture_id', $ecriture_id);
                $requete->execute();
                //CLIENT  

            } elseif ($montantcdf < $ttc_cdf) {
                $restecdf = 0;
                $soldecdf = $ttc_cdf - $montantcdf;
                $soldeusd = montant_equivalent_bdd($devisecdf, $deviseusd, $tauxop, $soldecdf);
                $resteusd = $montantusd - $soldeusd;
                if ($montantusd >= $soldeusd) {
                    $montantusd = $soldeusd;
                }
                //Ecriture Monnaie locale
                $libelle = "Hebergement : paiement reservation en CDF";
                $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
                $devise_op = 'CDF';
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
                $credit_client = $montantcdf;
                //CLIENT
                $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
                $long_compte = $_SESSION['Customer_long_compte'];
                $souscompte_id = $_SESSION['Customer_souscompte_id'];
                $categorie_id = $_SESSION['Customer_categorie_id'];
                $compte_id = $_SESSION['Customer_compte_id'];
                $debit = 0;
                $credit = $credit_client;
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
                $requete->BindParam(':devise', $devise);
                $requete->BindParam(':journal_id', $journal_id);
                $requete->BindParam(':exercice_id', $exercice_id);
                $requete->BindParam(':site_id', $site_id);
                $requete->BindParam(':ecriture_id', $ecriture_id);
                $requete->execute();
                //CLIENT        
                //COMPLEMENT USD
                $deviseusd = "USD";
                $exercice_id = $_SESSION['exercice_id'];
                $journal_id = 3;
                $dte = date('Y-m-d');
                $dteaff = $dte;
                $dtetime = date('Y-m-d H:i:s');
                $libelle = 'Hebergement : complement paiement en USD';
                $psedo = 0;
                $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
                //CAISSE EN USD
                $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESETR'];
                $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESETR'];
                $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESETR'];
                $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESETR'];
                $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESETR'];
                $debit = $montantusd;
                $credit = 0;
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
                //CAISSE EN USD
                //CLIENT
                $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
                $long_compte = $_SESSION['Customer_long_compte'];
                $souscompte_id = $_SESSION['Customer_souscompte_id'];
                $categorie_id = $_SESSION['Customer_categorie_id'];
                $compte_id = $_SESSION['Customer_compte_id'];
                $debit = 0;
                $credit = $montantusd;
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
                //CLIENT
            }
        } elseif ($montantcdf > 0) {
            $devisecdf = 'CDF';
            $ttc_cdf = montant_equivalent_bdd($devise, $devisecdf, $tauxop, $ttc);
            $restecdf = $montantcdf - $ttc_cdf;
            if ($montantcdf >= $ttc_cdf) {
                $montantcdf = $ttc_cdf;
            }
            $libelle = "Hebergement : paiement reservation en CDF";
            $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
            $devise_op = 'CDF';
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
            $credit_client = $montantcdf;
            //CLIENT
            $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
            $long_compte = $_SESSION['Customer_long_compte'];
            $souscompte_id = $_SESSION['Customer_souscompte_id'];
            $categorie_id = $_SESSION['Customer_categorie_id'];
            $compte_id = $_SESSION['Customer_compte_id'];
            $debit = 0;
            $credit = $credit_client;
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
            $requete->BindParam(':devise', $devise);
            $requete->BindParam(':journal_id', $journal_id);
            $requete->BindParam(':exercice_id', $exercice_id);
            $requete->BindParam(':site_id', $site_id);
            $requete->BindParam(':ecriture_id', $ecriture_id);
            $requete->execute();
            //CLIENT        

        } elseif ($montantusd > 0) {

            $deviseusd = 'USD';
            $ttc_usd = montant_equivalent_bdd($devise, $deviseusd, $tauxop, $ttc);
            $resteusd = $montantusd - $ttc_usd;
            if ($montantusd >= $ttc_usd) {
                $montantusd = $ttc_usd;
            }
            $libelle = "Hebergement : paiement reservation en USD";
            $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
            $devise_op = 'USD';
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
            $credit_client = $montantusd;
            //CLIENT
            $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
            $long_compte = $_SESSION['Customer_long_compte'];
            $souscompte_id = $_SESSION['Customer_souscompte_id'];
            $categorie_id = $_SESSION['Customer_categorie_id'];
            $compte_id = $_SESSION['Customer_compte_id'];
            $debit = 0;
            $credit = $credit_client;
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
            $requete->BindParam(':devise', $devise);
            $requete->BindParam(':journal_id', $journal_id);
            $requete->BindParam(':exercice_id', $exercice_id);
            $requete->BindParam(':site_id', $site_id);
            $requete->BindParam(':ecriture_id', $ecriture_id);
            $requete->execute();
            //CLIENT  

        }
        //Gestion paiement des surplus
        if ($type_rendu == 'non') {
            if ($restecdf > 0) {
                $reste = $restecdf;
                $devisecdf2 = "CDF";
                $exercice_id = $_SESSION['exercice_id'];
                $journal_id = 3;
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
                $reste = $resteusd;
                $exercice_id = $_SESSION['exercice_id'];
                $journal_id = 3;
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
    }
    // elseif ($mode == 'Credit') {
    //     $libelle = 'Hebergement : reservation à credit';
    //     $dteaff = $dte;
    //     $psedo = 0;
    //     $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
    //     //VENTE MARCHANDISE OU VENTE PRODUIT FINI
    //     $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['PROSERV'];
    //     $long_compte = $_SESSION['ConfLinkMod']['long_compte']['PROSERV'];
    //     $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['PROSERV'];
    //     $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['PROSERV'];
    //     $compte_id = $_SESSION['ConfLinkMod']['compte_id']['PROSERV'];
    //     $debit = 0;
    //     $credit = $ht;
    //     DetailsEcritureCompta($compte_id, $debit, $credit, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
    //     //GENERATION RAPPORT
    //     $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
    //     $libcompte = $data['lib'];
    //     $compte = $compte_ecriture . ' ' . $libcompte;
    //     $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
    //     VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
    //     $requete->BindParam(':dte', $dte);
    //     $requete->BindParam(':ref', $reference);
    //     $requete->BindParam(':compte', $compte);
    //     $requete->BindParam(':description', $libelle);
    //     $requete->BindParam(':debit', $debit);
    //     $requete->BindParam(':credit', $credit);
    //     $requete->BindParam(':devise', $devise);
    //     $requete->BindParam(':journal_id', $journal_id);
    //     $requete->BindParam(':exercice_id', $exercice_id);
    //     $requete->BindParam(':site_id', $site_id);
    //     $requete->BindParam(':ecriture_id', $ecriture_id);
    //     $requete->execute();
    //     //VENTE MARCHANDISE OU VENTE PRODUIT FINI
    //     //TVA FACTUREE SUR 
    //     if ($tva != 0) {
    //         $montanttva = ($montant_nuite * $tva) / 100;
    //         $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TVA'];
    //         $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TVA'];
    //         $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TVA'];
    //         $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TVA'];
    //         $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TVA'];
    //         $debit = 0;
    //         $credit = $montanttva;
    //         DetailsEcritureCompta($compte_id, $debit, $credit, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
    //         //GENERATION RAPPORT
    //         $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
    //         $libcompte = $data['lib'];
    //         $compte = $compte_ecriture . ' ' . $libcompte;
    //         $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
    //         VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
    //         $requete->BindParam(':dte', $dte);
    //         $requete->BindParam(':ref', $reference);
    //         $requete->BindParam(':compte', $compte);
    //         $requete->BindParam(':description', $libelle);
    //         $requete->BindParam(':debit', $debit);
    //         $requete->BindParam(':credit', $credit);
    //         $requete->BindParam(':devise', $devise);
    //         $requete->BindParam(':journal_id', $journal_id);
    //         $requete->BindParam(':exercice_id', $exercice_id);
    //         $requete->BindParam(':site_id', $site_id);
    //         $requete->BindParam(':ecriture_id', $ecriture_id);
    //         $requete->execute();
    //     }
    //     //TVA FACTUREE SUR VENTE
    //     //CLIENT
    //     $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
    //     $long_compte = $_SESSION['Customer_long_compte'];
    //     $souscompte_id = $_SESSION['Customer_souscompte_id'];
    //     $categorie_id = $_SESSION['Customer_categorie_id'];
    //     $compte_id = $_SESSION['Customer_compte_id'];
    //     $debit = $ttc;
    //     $credit = 0;
    //     DetailsEcritureCompta($compte_id, $debit, $credit, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
    //     //GENERATION RAPPORT
    //     $data = INFOSFromAccountNumber($compte_ecriture, $long_compte, $bdd);
    //     $libcompte = $data['lib'];
    //     $compte = $compte_ecriture . ' ' . $libcompte;
    //     $requete = $bdd->prepare("INSERT INTO cptrapportjournal (dte,ref,compte,description,debit,credit,devise,journal_id,exercice_id,site_id,ecriture_id)
    //      VALUES(:dte,:ref,:compte,:description,:debit,:credit,:devise,:journal_id,:exercice_id,:site_id,:ecriture_id)");
    //     $requete->BindParam(':dte', $dte);
    //     $requete->BindParam(':ref', $reference);
    //     $requete->BindParam(':compte', $compte);
    //     $requete->BindParam(':description', $libelle);
    //     $requete->BindParam(':debit', $debit);
    //     $requete->BindParam(':credit', $credit);
    //     $requete->BindParam(':devise', $devise);
    //     $requete->BindParam(':journal_id', $journal_id);
    //     $requete->BindParam(':exercice_id', $exercice_id);
    //     $requete->BindParam(':site_id', $site_id);
    //     $requete->BindParam(':ecriture_id', $ecriture_id);
    //     $requete->execute();
    //     //CLIENT
    // }
}
function COMPTA_PAIE_HEBERGE($type_rendu, $reference, $dte, $dtetime, $mode, $montantusd, $montantcdf, $ttc, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd)
{
    ExerciceEncours($site_id, $bdd);
    $exercice_id = $_SESSION['exercice_id'];
    $journal_id = 3;
    $devise_op = '';
    if ($mode == 'Cash') {
        $credit_client = 0;
        $dteaff = $dte;
        $psedo = 0;
        $restecdf = 0;
        $resteusd = 0;
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
                $libelle = 'Hebergement : paiement occupation en CDF';
                $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
                $devise_op = 'CDF';
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
                $credit_client = $montantcdf;
                //CLIENT
                $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
                $long_compte = $_SESSION['Customer_long_compte'];
                $souscompte_id = $_SESSION['Customer_souscompte_id'];
                $categorie_id = $_SESSION['Customer_categorie_id'];
                $compte_id = $_SESSION['Customer_compte_id'];
                $debit = 0;
                $credit = $credit_client;
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
                $requete->BindParam(':devise', $devise);
                $requete->BindParam(':journal_id', $journal_id);
                $requete->BindParam(':exercice_id', $exercice_id);
                $requete->BindParam(':site_id', $site_id);
                $requete->BindParam(':ecriture_id', $ecriture_id);
                $requete->execute();
                //CLIENT           
            } elseif ($montantusd >= $ttc_usd) {
                $resteusd = $montantusd - $ttc_usd;
                $montantusd = $ttc_usd;
                $restecdf = $montantcdf;
                //Ecriture Monnaie etrangere
                $deviseusd = 'USD';
                $libelle = "Hebergement : paiement occupation en USD";
                $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
                $devise_op = 'USD';
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
                $credit_client = $montantusd;
                //CLIENT
                $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
                $long_compte = $_SESSION['Customer_long_compte'];
                $souscompte_id = $_SESSION['Customer_souscompte_id'];
                $categorie_id = $_SESSION['Customer_categorie_id'];
                $compte_id = $_SESSION['Customer_compte_id'];
                $debit = 0;
                $credit = $credit_client;
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
                $requete->BindParam(':devise', $devise);
                $requete->BindParam(':journal_id', $journal_id);
                $requete->BindParam(':exercice_id', $exercice_id);
                $requete->BindParam(':site_id', $site_id);
                $requete->BindParam(':ecriture_id', $ecriture_id);
                $requete->execute();
                //CLIENT  

            } elseif ($montantcdf < $ttc_cdf) {
                $restecdf = 0;
                $soldecdf = $ttc_cdf - $montantcdf;
                $soldeusd = montant_equivalent_bdd($devisecdf, $deviseusd, $tauxop, $soldecdf);
                $resteusd = $montantusd - $soldeusd;
                if ($montantusd >= $soldeusd) {
                    $montantusd = $soldeusd;
                }
                //Ecriture Monnaie locale
                $libelle = "Hebergement : paiement occupation en CDF";
                $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
                $devise_op = 'CDF';
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
                $credit_client = $montantcdf;
                //CLIENT
                $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
                $long_compte = $_SESSION['Customer_long_compte'];
                $souscompte_id = $_SESSION['Customer_souscompte_id'];
                $categorie_id = $_SESSION['Customer_categorie_id'];
                $compte_id = $_SESSION['Customer_compte_id'];
                $debit = 0;
                $credit = $credit_client;
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
                $requete->BindParam(':devise', $devise);
                $requete->BindParam(':journal_id', $journal_id);
                $requete->BindParam(':exercice_id', $exercice_id);
                $requete->BindParam(':site_id', $site_id);
                $requete->BindParam(':ecriture_id', $ecriture_id);
                $requete->execute();
                //CLIENT        
                //COMPLEMENT USD
                $deviseusd = "USD";
                $exercice_id = $_SESSION['exercice_id'];
                $journal_id = 3;
                $dte = date('Y-m-d');
                $dteaff = $dte;
                $dtetime = date('Y-m-d H:i:s');
                $libelle = 'Hebergement : complement paiement en USD';
                $psedo = 0;
                $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
                //CAISSE EN USD
                $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESETR'];
                $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESETR'];
                $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESETR'];
                $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESETR'];
                $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESETR'];
                $debit = $montantusd;
                $credit = 0;
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
                //CAISSE EN USD
                //CLIENT
                $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
                $long_compte = $_SESSION['Customer_long_compte'];
                $souscompte_id = $_SESSION['Customer_souscompte_id'];
                $categorie_id = $_SESSION['Customer_categorie_id'];
                $compte_id = $_SESSION['Customer_compte_id'];
                $debit = 0;
                $credit = $montantusd;
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
                //CLIENT
            }
        } elseif ($montantcdf > 0) {
            $devisecdf = 'CDF';
            $ttc_cdf = montant_equivalent_bdd($devise, $devisecdf, $tauxop, $ttc);
            $restecdf = $montantcdf - $ttc_cdf;
            if ($montantcdf >= $ttc_cdf) {
                $montantcdf = $ttc_cdf;
            }
            $libelle = "Hebergement : paiement occupation en CDF";
            $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
            $devise_op = 'CDF';
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
            $credit_client = $montantcdf;
            //CLIENT
            $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
            $long_compte = $_SESSION['Customer_long_compte'];
            $souscompte_id = $_SESSION['Customer_souscompte_id'];
            $categorie_id = $_SESSION['Customer_categorie_id'];
            $compte_id = $_SESSION['Customer_compte_id'];
            $debit = 0;
            $credit = $credit_client;
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
            $requete->BindParam(':devise', $devise);
            $requete->BindParam(':journal_id', $journal_id);
            $requete->BindParam(':exercice_id', $exercice_id);
            $requete->BindParam(':site_id', $site_id);
            $requete->BindParam(':ecriture_id', $ecriture_id);
            $requete->execute();
            //CLIENT        

        } elseif ($montantusd > 0) {

            $deviseusd = 'USD';
            $ttc_usd = montant_equivalent_bdd($devise, $deviseusd, $tauxop, $ttc);
            $resteusd = $montantusd - $ttc_usd;
            if ($montantusd >= $ttc_usd) {
                $montantusd = $ttc_usd;
            }
            $libelle = "Hebergement : paiement occupation en USD";
            $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
            $devise_op = 'USD';
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
            $credit_client = $montantusd;
            //CLIENT
            $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
            $long_compte = $_SESSION['Customer_long_compte'];
            $souscompte_id = $_SESSION['Customer_souscompte_id'];
            $categorie_id = $_SESSION['Customer_categorie_id'];
            $compte_id = $_SESSION['Customer_compte_id'];
            $debit = 0;
            $credit = $credit_client;
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
            $requete->BindParam(':devise', $devise);
            $requete->BindParam(':journal_id', $journal_id);
            $requete->BindParam(':exercice_id', $exercice_id);
            $requete->BindParam(':site_id', $site_id);
            $requete->BindParam(':ecriture_id', $ecriture_id);
            $requete->execute();
            //CLIENT  

        }
        //Gestion paiement des surplus
        if ($type_rendu == 'non') {
            if ($restecdf > 0) {
                $reste = $restecdf;
                $devisecdf2 = "CDF";
                $exercice_id = $_SESSION['exercice_id'];
                $journal_id = 3;
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
                $reste = $resteusd;
                $exercice_id = $_SESSION['exercice_id'];
                $journal_id = 3;
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
    }
}
function COMPTA_PAIE_PLUS_HEBERGE($type_rendu, $reference, $dte, $dtetime, $mode, $montantusd, $montantcdf, $ttc, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd)
{
    if ($type_rendu == 'non') {
        ExerciceEncours($site_id, $bdd);
        $exercice_id = $_SESSION['exercice_id'];
        $journal_id = 3;
        if ($montantcdf > 0) {
            $devisecdf = "CDF";
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
            //CAISSE EN CDF
            //CLIENT
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
            //CLIENT

        }
        if ($montantusd > 0) {
            $deviseusd = "USD";
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
            $debit = $montantusd;
            $credit = 0;
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
            //CAISSE EN USD
            //CLIENT
            $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
            $long_compte = $_SESSION['Customer_long_compte'];
            $souscompte_id = $_SESSION['Customer_souscompte_id'];
            $categorie_id = $_SESSION['Customer_categorie_id'];
            $compte_id = $_SESSION['Customer_compte_id'];
            $debit = 0;
            $credit = $montantusd;
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
            //CLIENT

        }
    }
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
            $libelle = "Restaurant : Paiement en USD";
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
            $libelle = "Restaurant : Paiement en USD";
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
            $libelle = "Restaurant : Paiement en CDF";
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
        $libelle = "Restaurant : Paiement en CDF";
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
        $libelle = "Restaurant : Paiement en USD";
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
function AutoEcrituresInsert($lastdte, $id_ch, $id_client, $module_id, $site_id, $bdd)
{
    $requete = $bdd->prepare("INSERT INTO cpt_auto_ecritures(lastdte,id_ch,id_client,module_id,site_id)
        VALUES(:lastdte,:id_ch,:id_client,:module_id,:site_id)");
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


function COMPTA_REMBOURSEMENT($reference, $dte, $dtetime, $montantusd, $montantcdf, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd)
{
    ExerciceEncours($site_id, $bdd);
    $exercice_id = $_SESSION['exercice_id'];
    $journal_id = 2;
    $montantcdf2 = 0;
    $montantusd2 = 0;
    $devise_op = '';
    $dteaff = $dte;
    $psedo = 0;
    $debit_client = 0;
    //CAISSE CDF OU USD
    if ($montantcdf > 0) {
        $libelle = 'Hebergement : remboursement client en CDF';
        $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
        $devise_op = 'CDF';
        $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESLOC'];
        $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESLOC'];
        $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESLOC'];
        $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESLOC'];
        $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESLOC'];
        $debit = 0;
        $credit = $montantcdf;
        $libelledescrpt = '';
        $numdoc = '';
        $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
        //tresorerie
        $entree = 'sortie';
        $date_bon = $dte;
        $date_heure_bon = $dtetime;
        $montantFC = $montantcdf;
        $montantUSD = 0;
        $cpte_num = $compte_ecriture;
        $id_user = $user_id;
        $longcompte = 4;
        $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
        $lib_monnaie = 'sortiecdf';
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
        $debit_client = $montantcdf;
        //CLIENT
        $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
        $long_compte = $_SESSION['Customer_long_compte'];
        $souscompte_id = $_SESSION['Customer_souscompte_id'];
        $categorie_id = $_SESSION['Customer_categorie_id'];
        $compte_id = $_SESSION['Customer_compte_id'];
        $debit = $debit_client;
        $credit = 0;
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
        $requete->BindParam(':devise', $devise);
        $requete->BindParam(':journal_id', $journal_id);
        $requete->BindParam(':exercice_id', $exercice_id);
        $requete->BindParam(':site_id', $site_id);
        $requete->BindParam(':ecriture_id', $ecriture_id);
        $requete->execute();
        //CLIENT 
    }
    if ($montantusd > 0) {
        $libelle = 'Hebergement : remboursement client en USD';
        $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
        $devise_op = 'USD';
        $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESETR'];
        $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESETR'];
        $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESETR'];
        $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESETR'];
        $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESETR'];
        $debit = 0;
        $credit = $montantusd;
        $libelledescrpt = '';
        $numdoc = '';
        $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
        //tresorerie
        $entree = 'sortie';
        $date_bon = $dte;
        $date_heure_bon = $dtetime;
        $montantFC = 0;
        $montantUSD = $montantusd;
        $cpte_num = $compte_ecriture;
        $id_user = $user_id;
        $longcompte = 4;
        $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
        $lib_monnaie = 'sortieusd';
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
        $debit_client = $montantusd;
        //CLIENT
        $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
        $long_compte = $_SESSION['Customer_long_compte'];
        $souscompte_id = $_SESSION['Customer_souscompte_id'];
        $categorie_id = $_SESSION['Customer_categorie_id'];
        $compte_id = $_SESSION['Customer_compte_id'];
        $debit = $debit_client;
        $credit = 0;
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
        $requete->BindParam(':devise', $devise);
        $requete->BindParam(':journal_id', $journal_id);
        $requete->BindParam(':exercice_id', $exercice_id);
        $requete->BindParam(':site_id', $site_id);
        $requete->BindParam(':ecriture_id', $ecriture_id);
        $requete->execute();
        //CLIENT        
    }
    //CAISSE CDF OU USD

}



function COMPTA_REMBOURSEMENT_ANNULATION($reference, $dte, $dtetime, $montantusd, $montantcdf, $montpenalite, $montpayeres, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd)
{
    ExerciceEncours($site_id, $bdd);
    $exercice_id = $_SESSION['exercice_id'];
    $journal_id = 2;
    $montantcdf2 = 0;
    $montantusd2 = 0;
    $devise_op = '';
    $dteaff = $dte;
    $psedo = 0;
    $debit_client = 0;
    //Ecriture penalité    
    if ($montpenalite > 0) {
        $libelle = 'Annulation avec penalité';
        $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
        $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['ROF'];
        $long_compte = $_SESSION['ConfLinkMod']['long_compte']['ROF'];
        $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['ROF'];
        $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['ROF'];
        $compte_id = $_SESSION['ConfLinkMod']['compte_id']['ROF'];
        // $compte_ecriture=7782;
        // $long_compte=4;
        // $souscompte_id=853;
        // $categorie_id=83;
        // $compte_id=391;
        $debit = 0;
        $credit = $montpenalite;
        $libelledescrpt = '';
        $numdoc = '';
        $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);

        //CLIENT
        $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
        $long_compte = $_SESSION['Customer_long_compte'];
        $souscompte_id = $_SESSION['Customer_souscompte_id'];
        $categorie_id = $_SESSION['Customer_categorie_id'];
        $compte_id = $_SESSION['Customer_compte_id'];
        $debit = $montpenalite;
        $credit = 0;
        $libelledescrpt = '';
        $numdoc = '';
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
    //Ecriture penalité 

    //CAISSE CDF OU USD
    if ($montantcdf > 0) {
        $libelle = 'Remboursement client en monnaie locale';
        $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
        $devise_op = 'CDF';
        $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESLOC'];
        $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESLOC'];
        $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESLOC'];
        $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESLOC'];
        $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESLOC'];
        $debit = 0;
        $credit = $montantcdf;
        $libelledescrpt = '';
        $numdoc = '';
        $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
        //tresorerie
        $entree = 'sortie';
        $date_bon = $dte;
        $date_heure_bon = $dtetime;
        $montantFC = $montantcdf;
        $montantUSD = 0;
        $cpte_num = $compte_ecriture;
        $id_user = $user_id;
        $longcompte = 4;
        $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
        $lib_monnaie = 'sortiecdf';
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
        $debit_client = $montantcdf;
        //CLIENT
        $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
        $long_compte = $_SESSION['Customer_long_compte'];
        $souscompte_id = $_SESSION['Customer_souscompte_id'];
        $categorie_id = $_SESSION['Customer_categorie_id'];
        $compte_id = $_SESSION['Customer_compte_id'];
        $debit = $debit_client;
        $credit = 0;
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
        $requete->BindParam(':devise', $devise);
        $requete->BindParam(':journal_id', $journal_id);
        $requete->BindParam(':exercice_id', $exercice_id);
        $requete->BindParam(':site_id', $site_id);
        $requete->BindParam(':ecriture_id', $ecriture_id);
        $requete->execute();
        //CLIENT    
    }
    if ($montantusd > 0) {
        $libelle = 'Remboursement client en monnaie etrangere';
        $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
        $devise_op = 'USD';
        $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESETR'];
        $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESETR'];
        $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESETR'];
        $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESETR'];
        $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESETR'];
        $debit = 0;
        $credit = $montantusd;
        $libelledescrpt = '';
        $numdoc = '';
        $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
        //tresorerie
        $entree = 'sortie';
        $date_bon = $dte;
        $date_heure_bon = $dtetime;
        $montantFC = 0;
        $montantUSD = $montantusd;
        $cpte_num = $compte_ecriture;
        $id_user = $user_id;
        $longcompte = 4;
        $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
        $lib_monnaie = 'sortieusd';
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
        $debit_client = $montantusd;
        //CLIENT
        $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
        $long_compte = $_SESSION['Customer_long_compte'];
        $souscompte_id = $_SESSION['Customer_souscompte_id'];
        $categorie_id = $_SESSION['Customer_categorie_id'];
        $compte_id = $_SESSION['Customer_compte_id'];
        $debit = $debit_client;
        $credit = 0;
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
        $requete->BindParam(':devise', $devise);
        $requete->BindParam(':journal_id', $journal_id);
        $requete->BindParam(':exercice_id', $exercice_id);
        $requete->BindParam(':site_id', $site_id);
        $requete->BindParam(':ecriture_id', $ecriture_id);
        $requete->execute();
        //CLIENT    
    }
    //CAISSE CDF OU USD



}

function Soldes_Monnaie_Locale_Etrangere($site_id, $bdd)
{
    $_SESSION['solde_caisse_fc_normal'] = 0;
    $_SESSION['solde_caisse_usd_normal'] = 0;
    $requete = 'SELECT montantFC,montantUSD,type 
    FROM  t_operation
    WHERE hotel_id=:site_id AND psedo=0';
    $query = $bdd->prepare($requete);
    $query->BindParam(':site_id', $_SESSION['id_hotel']);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    $SoldeCDF = 0;
    $SoldeUSD = 0;
    foreach ($result as $rows) {
        if ($rows->type == 'entree') {
            $SoldeCDF = $SoldeCDF + $rows->montantFC;
            $SoldeUSD = $SoldeUSD + $rows->montantUSD;
        } else {
            $SoldeCDF = $SoldeCDF - $rows->montantFC;
            $SoldeUSD = $SoldeUSD - $rows->montantUSD;
        }
    }
    $_SESSION['solde_caisse_fc_normal'] = $SoldeCDF;
    $_SESSION['solde_caisse_usd_normal'] = $SoldeUSD;
}


function AnnulationPaiemmentCompta($reference, $dte, $dtetime, $montantusd, $montantcdf, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd)
{
    ExerciceEncours($site_id, $bdd);
    $exercice_id = $_SESSION['exercice_id'];
    $journal_id = 2;
    $montantcdf2 = 0;
    $montantusd2 = 0;
    $devise_op = '';
    $dteaff = $dte;
    $psedo = 0;
    $debit_client = 0;
    //CAISSE CDF OU USD
    if ($montantcdf > 0) {
        $libelle = 'Hebergement : annulation paiement & remboursement en CDF';
        $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
        $devise_op = 'CDF';
        $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESLOC'];
        $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESLOC'];
        $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESLOC'];
        $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESLOC'];
        $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESLOC'];
        $debit = 0;
        $credit = $montantcdf;
        $libelledescrpt = '';
        $numdoc = '';
        $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
        //tresorerie
        $entree = 'sortie';
        $date_bon = $dte;
        $date_heure_bon = $dtetime;
        $montantFC = $montantcdf;
        $montantUSD = 0;
        $cpte_num = $compte_ecriture;
        $id_user = $user_id;
        $longcompte = 4;
        $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
        $lib_monnaie = 'sortiecdf';
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
        $debit_client = $montantcdf;
        //CLIENT
        $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
        $long_compte = $_SESSION['Customer_long_compte'];
        $souscompte_id = $_SESSION['Customer_souscompte_id'];
        $categorie_id = $_SESSION['Customer_categorie_id'];
        $compte_id = $_SESSION['Customer_compte_id'];
        $debit = $debit_client;
        $credit = 0;
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
        $requete->BindParam(':devise', $devise);
        $requete->BindParam(':journal_id', $journal_id);
        $requete->BindParam(':exercice_id', $exercice_id);
        $requete->BindParam(':site_id', $site_id);
        $requete->BindParam(':ecriture_id', $ecriture_id);
        $requete->execute();
        //CLIENT 
    }
    if ($montantusd > 0) {
        $libelle = 'Hebergement : annulation paiement & remboursement en USD';
        $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
        $devise_op = 'USD';
        $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESETR'];
        $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESETR'];
        $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESETR'];
        $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESETR'];
        $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESETR'];
        $debit = 0;
        $credit = $montantusd;
        $libelledescrpt = '';
        $numdoc = '';
        $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $devise_op, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
        //tresorerie
        $entree = 'sortie';
        $date_bon = $dte;
        $date_heure_bon = $dtetime;
        $montantFC = 0;
        $montantUSD = $montantusd;
        $cpte_num = $compte_ecriture;
        $id_user = $user_id;
        $longcompte = 4;
        $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
        $lib_monnaie = 'sortieusd';
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
        $debit_client = $montantusd;
        //CLIENT
        $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
        $long_compte = $_SESSION['Customer_long_compte'];
        $souscompte_id = $_SESSION['Customer_souscompte_id'];
        $categorie_id = $_SESSION['Customer_categorie_id'];
        $compte_id = $_SESSION['Customer_compte_id'];
        $debit = $debit_client;
        $credit = 0;
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
        $requete->BindParam(':devise', $devise);
        $requete->BindParam(':journal_id', $journal_id);
        $requete->BindParam(':exercice_id', $exercice_id);
        $requete->BindParam(':site_id', $site_id);
        $requete->BindParam(':ecriture_id', $ecriture_id);
        $requete->execute();
        //CLIENT        
    }
    //CAISSE CDF OU USD

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


function COMPTA_OCCUP_APRES_RESERV($reference, $dte, $dtetime, $ht, $tva, $ttc, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd)
{
    $exercice_id = $_SESSION['exercice_id'];
    $journal_id = 2;
    ExerciceEncours($site_id, $bdd);
    $libelle = "Hebergement : occupation chambre";
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

function regularizeBilledNight($id, $nuite1, $bdd)
{
    $req = "SELECT *,SUM(a.nuite) AS totalnuitee
            FROM factchambre a
             WHERE a.reservech_id=:id";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->execute();

    $result = $requete->fetch(PDO::FETCH_OBJ);

    $nuite2 = $result->totalnuitee;
    $diffNuite = $nuite1 - $nuite2;
    $prix = $result->nuite;
    $montant = $prix * $diffNuite;
    $dte = ('Y-m-d');
    $ch_id = $result->ch_id;
    $reservech_id = $result->reservech_id;
    $facture_id = $result->facture_id;
    $site_id = $result->site_id;

    if ($diffNuite != 0) {
        factChambre($diffNuite, $prix, $montant, $dte, $ch_id, $reservech_id, $facture_id, $site_id, $bdd);
    }
}

function getChiffreAffaireOccupation($datedebut, $datefin, $monnaieAffichage, $idsite, $bdd)
{
    $chiffreAffaire = 0;
    if ($monnaieAffichage == 'USD') {

        $req = "SELECT a.id_fact,a.taux,a.tva,SUM(b.montant/a.taux) AS montant
        FROM t_facture AS a,factchambre AS b
        WHERE a.id_fact=b.facture_id
            AND a.id_hotel=:id_hotel
            AND b.dte BETWEEN :dte1 AND :dte2
            AND a.etat_cmd=0
            AND a.chiffre_aff=1";
        $requete = $bdd->prepare($req);
        $requete->BindParam(':id_hotel', $idsite);
        $requete->BindParam(':dte1', $datedebut);
        $requete->BindParam(':dte2', $datefin);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_OBJ);

        $chiffreAffaire = $result->montant;
    } else {

        $req = "SELECT a.id_fact,a.taux,a.tva,SUM(montant) AS montant
        FROM t_facture AS a,factchambre AS b
        WHERE a.id_fact=b.facture_id
            AND a.id_hotel=:id_hotel
            AND b.dte BETWEEN :dte1 AND :dte2 
            AND a.chiffre_aff=1
            AND a.etat_cmd=0";
        $requete = $bdd->prepare($req);
        $requete->BindParam(':id_hotel', $idsite);
        $requete->BindParam(':dte1', $datedebut);
        $requete->BindParam(':dte2', $datefin);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_OBJ);

        $chiffreAffaire = $result->montant;
    }




    return $chiffreAffaire;
}

function countOccupiedRooms($datedebut, $datefin, $id, $bdd)
{
    $req = "SELECT COUNT(*) AS nbrech
   FROM t_facture AS a,factchambre AS b
   WHERE a.id_fact=b.facture_id
       AND a.id_hotel=:id_hotel
       AND b.dte BETWEEN :dte1 AND :dte2 
        AND a.chiffre_aff=1
       AND a.etat_cmd=0";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id_hotel', $id);
    $requete->BindParam(':dte1', $datedebut);
    $requete->BindParam(':dte2', $datefin);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);

    $nbrOccupiedRooms = $result->nbrech;
    return $nbrOccupiedRooms;
}

function getNumberRooms($id, $bdd)
{
    $req = "SELECT  COUNT(c.num_ch) AS nbrech
    FROM  t_chambre c,categorie_chambre k
     WHERE  k.id_cat_cha=c.categorie 
            AND c.del=0 
			AND c.libre='oui'
            AND c.id_hotel=:id";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_OBJ);
    return $result->nbrech;
}
function getFirstAndLastDateOfCurrentMonth()
{
    $mois = date('m');
    $annee = date('Y');
    $data = array();
    $data['startDate'] = date("Y-m-d", mktime(0, 0, 0, $mois, 1, $annee));
    $data['endDate'] = date("Y-m-d", mktime(0, 0, 0, $mois + 1, 0, $annee));

    return  $data;
}
function getTxOccupation($datedebut, $datefin, $id, $bdd)
{
    $d1 = new DateTime($datefin);
    $d2 = new DateTime($datedebut);
    $diff = $d1->diff($d2);
    $nbrDays = $diff->format('%d');
    $nbrDays = $nbrDays + 1;

    $chambreOccupes = countOccupiedRooms($datedebut, $datefin, $id, $bdd);
    $chambreDispo1 = getNumberRooms($id, $bdd);

    $chambreDispo = $chambreDispo1 * $nbrDays;
    $txoccup = ($chambreOccupes / $chambreDispo) * 100;
    return   round($txoccup, 2);
}

function getPrixMoyenChambre($datedebut, $datefin, $monnaieAffichage, $id, $bdd)
{
    $pmc = 0;
    if ($monnaieAffichage == 'USD') {
        $req = "SELECT COUNT(*) AS nbrech, SUM(b.montant/a.taux) AS ca
        FROM t_facture AS a,factchambre AS b
        WHERE a.id_fact=b.facture_id
            AND a.id_hotel=:id_hotel
            AND b.nuite>0
            AND b.dte BETWEEN :dte1 AND :dte2 
             AND a.chiffre_aff=1
            AND a.etat_cmd=0";
        $requete = $bdd->prepare($req);
        $requete->BindParam(':id_hotel', $id);
        $requete->BindParam(':dte1', $datedebut);
        $requete->BindParam(':dte2', $datefin);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_OBJ);

        $nbrech = $result->nbrech;
        $ca = $result->ca;
        if ($nbrech == 0) {
            $nbrech = 1;
        }
        $pmc = $ca / $nbrech;
    } else {
        $req = "SELECT COUNT(*) AS nbrech, SUM(b.montant) AS ca
        FROM t_facture AS a,factchambre AS b
        WHERE a.id_fact=b.facture_id
            AND a.id_hotel=:id_hotel
            AND b.nuite>0
            AND b.dte BETWEEN :dte1 AND :dte2 
             AND a.chiffre_aff=1
            AND a.etat_cmd=0";
        $requete = $bdd->prepare($req);
        $requete->BindParam(':id_hotel', $id);
        $requete->BindParam(':dte1', $datedebut);
        $requete->BindParam(':dte2', $datefin);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_OBJ);

        $nbrech = $result->nbrech;
        $ca = $result->ca;
        if ($nbrech == 0) {
            $nbrech = 1;
        }
        $pmc = $ca / $nbrech;
    }

    return round($pmc, 2);
}


function getTopRooms($datedebut, $datefin, $monnaieAffichage, $id, $bdd)
{
    if ($monnaieAffichage == 'USD') {
        $req = "SELECT a.id_ch,a.num_ch,SUM(b.montant/c.taux)AS montant
        FROM t_chambre AS a,factchambre AS b,t_facture AS c
        WHERE a.id_ch=b.ch_id 
        AND c.id_fact=b.facture_id
        AND c.id_hotel=:id_hotel 
        AND b.dte BETWEEN :dte1 AND :dte2 
         AND c.chiffre_aff=1
        AND c.etat_cmd=0
        GROUP BY a.id_ch 
        ORDER BY montant DESC LIMIT 5";
        $requete = $bdd->prepare($req);
        $requete->BindParam(':id_hotel', $id);
        $requete->BindParam(':dte1', $datedebut);
        $requete->BindParam(':dte2', $datefin);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
    } else {
        $req = "SELECT a.id_ch,a.num_ch,SUM(b.montant)AS montant
        FROM t_chambre AS a,factchambre AS b,t_facture AS c
        WHERE a.id_ch=b.ch_id 
        AND c.id_fact=b.facture_id
        AND c.id_hotel=:id_hotel 
        AND b.dte BETWEEN :dte1 AND :dte2
         AND c.chiffre_aff=1 
        AND c.etat_cmd=0
        GROUP BY a.id_ch 
        ORDER BY montant DESC LIMIT 5";
        $requete = $bdd->prepare($req);
        $requete->BindParam(':id_hotel', $id);
        $requete->BindParam(':dte1', $datedebut);
        $requete->BindParam(':dte2', $datefin);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
    }

    return $result;
}
function VenteglobalDujour($bdd)
{
    $niveau = 1;
    $date_bd1 = $date_bd2 = date('Y-m-d');
    $id = $_SESSION['company_id'];
    $m_affiche = $_SESSION['m_affiche'];
    $articles3 = array();
    $requete = $bdd->prepare("SELECT a.taux_prix,b.monnaie,a.mode,c.idprod,c.code, c.designation,
                             SUM(b.qte) AS qte, b.prix AS pu, b.dte_h,a.mode AS lib,SUM(b.qte*b.prix) AS mont,
                             SUM(b.qteoffert) AS qteoffert,SUM(b.qteoffert*b.prix2) AS montof
     FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a
     WHERE b.produit_id= c.idprod AND a.id_fact=b.commande_id 
     AND a.date_edition  BETWEEN :date_bd1 AND :date_bd2
     AND a.etat_cmd=0
     AND a.company_id =:id
     GROUP BY c.idprod, a.mode,b.prix  
     ORDER BY c.designation");
    $requete->BindParam(':date_bd1', $date_bd1);
    $requete->BindParam(':date_bd2', $date_bd2);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $articles3 = $requete->fetchAll(PDO::FETCH_OBJ);
    $tot = 0;
    foreach ($articles3 as $art2) {
        $tauxdollar1 = $art2->taux_prix;
        $prix = $art2->pu;
        $prixaf = montant_equivalent_bdd($art2->monnaie, $m_affiche, $tauxdollar1, $prix);
        // if ($art2->lib == 'Cash') {
        $_SESSION['cash']['qte'][$prix] = $art2->qte;
        $prix_u = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $art2->mont);
        $tot += $prix_u;
        // }
    }
    return $tot;
}

function SoldeTresorerie2($company_id, $bdd)
{
    $SoldeCDF = 0;
    $SoldeUSD = 0;
    $hr_1 = '00:00:00';
    $hr_2 = '05:00:00';
    $hr_operation = date('H:i:s');
    $dte = date('Y-m-d');

    if ($hr_operation >= $hr_1 && $hr_operation <= $hr_2) {
        $dte = ReduiceDaysToDate($dte, 1);
    }
    $data = array();
    $data['tresorerie_usd'] = 0;
    $data['tresorerie_cdf'] = 0;

    $requete = "SELECT * FROM t_hotel AS a WHERE a.company_id=:id
                AND a.etat=1
               ORDER BY a.id_hotel ASC";
    $requete = $bdd->prepare($requete);
    $requete->BindParam(':id', $company_id);
    $requete->execute();
    $result = $requete->fetchALL(PDO::FETCH_OBJ);
    $id_hotel = 0;
    foreach ($result as $art2) {
        $id_hotel = $art2->id_hotel;

        // REPORT
        $rfond_cdf = 0;
        $rfond_usd = 0;

        $requete = $bdd->prepare("SELECT cdf ,usd  FROM  reportcaisse WHERE hotel_id=:id_hotel
                                     ORDER BY id DESC LIMIT 1");
        $requete->BindParam(':id_hotel', $id_hotel);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);

        foreach ($result as $r) {
            $rfond_cdf = $r->cdf;
            $rfond_usd = $r->usd;
        }
        //FONDS DE CAISSE
        $requete = $bdd->prepare("SELECT SUM(cdf) AS fond_cdf,SUM(usd) AS fond_usd
        FROM fondscaisse 
        WHERE dte=:dte
        AND hotel_id=:id_hotel ");
        $requete->BindParam(':dte', $dte);
        $requete->BindParam(':id_hotel', $id_hotel);
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_OBJ);
        $fond_cdf = 0;
        $fond_usd = 0;
        foreach ($result as $r) {
            $fond_cdf = $r->fond_cdf;
            $fond_usd = $r->fond_usd;
        }
        //RECETTES
        $requete = $bdd->prepare("SELECT c.montantusd-c.rendu_usd AS montantUSD,c.montantcdf-c.rendu_cdf AS montantFC
                                     FROM  paiement AS c,t_reglement AS r WHERE r.id_regl=c.regl_id AND c.site_id=:hotel_id AND c.id_mode_regl=2 AND r.dte=:dte");
        $requete->BindParam(':hotel_id', $id_hotel);
        $requete->BindParam(':dte', $dte);
        $requete->execute();

        $result2 = $requete->fetchALL(PDO::FETCH_OBJ);
        $vente_cdf = $vente_usd = 0;
        foreach ($result2 as $rows) {
            $vente_cdf += $rows->montantFC;
            $vente_usd += $rows->montantUSD;
        }
        //Depenses
        $requete = $bdd->prepare("SELECT * FROM depenses AS a  WHERE  a.site_id=:site_id AND a.psedo=0 AND dte_dep=:dte");

        $requete->BindParam(':site_id', $id_hotel);
        $requete->BindParam(':dte', $dte);
        $requete->execute();
        $depenses = $requete->fetchAll(PDO::FETCH_OBJ);
        $dep_cdf = 0;
        $dep_usd = 0;
        foreach ($depenses as $r) {
            $dep_cdf += $r->cdf;
            $dep_usd += $r->usd;
        }



        //VERSEMENT
        $requete = $bdd->prepare("SELECT a.date_vers,a.user_vers,SUM(a.montant_vers) AS mont_cdf,SUM(a.montantusd) AS mont_usd,a.date_vers
        FROM t_versement AS a
        WHERE   a.date_vers=:dte 
        AND  a.id_hotel=:id_hotel  GROUP BY a.date_vers");

        $requete->BindParam(':dte', $dte);
        $requete->BindParam(':id_hotel', $id_hotel);
        $requete->execute();

        $result = $requete->fetchAll(PDO::FETCH_OBJ);

        $verser_usd = 0;
        $verser_cdf = 0;

        foreach ($result as $r) {
            $verser_usd = $r->mont_usd;
            $verser_cdf = $r->mont_cdf;
        }

        if ($verser_usd == 0 || $verser_cdf == 0) {
            $SoldeCDF = ($rfond_cdf + $fond_cdf + $vente_cdf) - ($dep_cdf);
            $SoldeUSD = ($rfond_usd + $fond_usd + $vente_usd) - ($dep_usd);
        } else {
            $SoldeCDF = $rfond_cdf;
            $SoldeUSD = $rfond_usd;
        }
    }



    $data['tresorerie_cdf'] = $SoldeCDF;
    $data['tresorerie_usd'] = $SoldeUSD;
    return $data;
}

function COMPTA_ANNULATION_FAC_HEB($id_fact, $libmodefact, $reference, $dte, $dtetime, $ht, $tva, $ttc, $devise, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd)
{

    if ($libmodefact == 'Credit') {
        ExerciceEncours($site_id, $bdd);
        $exercice_id = $_SESSION['exercice_id'];
        $journal_id = 2;
        $dteaff = $dte;
        $psedo = 0;
        //NUMERO ANNULATION
        $lib = 'HebNumAnnul';
        $compteur = getnumerotation($site_id, $lib, $bdd);
        $numero = str_pad($compteur, 5, "0", STR_PAD_LEFT);
        $compteur += 1;
        setnumerotation($site_id, $lib, $compteur, $bdd);
        //NUMERO ANNULATION
        $libelle = 'Hebergement : Note Credit N° ' . $numero . ' Annulation occupation';
        $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
        //VENTE MARCHANDISE OU VENTE PRODUIT FINI
        $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['PROSERV'];
        $long_compte = $_SESSION['ConfLinkMod']['long_compte']['PROSERV'];
        $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['PROSERV'];
        $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['PROSERV'];
        $compte_id = $_SESSION['ConfLinkMod']['compte_id']['PROSERV'];
        $debit = $ht;
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
        //VENTE MARCHANDISE OU VENTE PRODUIT FINI
        //TVA FACTUREE SUR 
        if ($tva != 0) {
            $montanttva = ($ttc * $tva) / 100;
            $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TVA'];
            $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TVA'];
            $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TVA'];
            $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TVA'];
            $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TVA'];
            $debit = $montanttva;
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
        }
        //TVA FACTUREE SUR VENTE
        //CLIENT
        $compte_ecriture = $_SESSION['Customer_compte_ecriture'];
        $long_compte = $_SESSION['Customer_long_compte'];
        $souscompte_id = $_SESSION['Customer_souscompte_id'];
        $categorie_id = $_SESSION['Customer_categorie_id'];
        $compte_id = $_SESSION['Customer_compte_id'];
        $debit = 0;
        $credit = $ttc;
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
        //ANNULATION PAIEMENT(S) 
        COMPTA_ANUL_PAIE_FAC($id_fact, $reference, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd);
        //ANNULATION PAIEMENT(S) 
    } elseif ($libmodefact == 'Cash') {

        ExerciceEncours($site_id, $bdd);
        $exercice_id = $_SESSION['exercice_id'];
        $journal_id = 2;
        $dte = date('Y-m-d');
        $dteaff = $dte;
        $dtetime = date('Y-m-d H:i:s');
        $psedo = 0;
        //NUMERO ANNULATION
        $lib = 'HebNumAnnul';
        $compteur = getnumerotation($site_id, $lib, $bdd);
        $numero = str_pad($compteur, 5, "0", STR_PAD_LEFT);
        $compteur += 1;
        setnumerotation($site_id, $lib, $compteur, $bdd);
        //NUMERO ANNULATION
        $sql = "SELECT re.id_regl,re.numero,re.dte,re.date_regl,re.id_user,pa.montantusd,pa.montantcdf,pa.rendu_usd,pa.rendu_cdf,pa.taux,mo.lib,us.nom_user,us.prenom_user
        FROM t_reglement AS re,paiement AS pa,t_mode_reglement AS mo,t_utilisateur AS us
        WHERE re.id_regl=pa.regl_id 
       AND  mo.id_mode_regl=pa.id_mode_regl 
       AND  re.id_user=us.id_user
       AND re.id_fact=:id
       AND mo.id_mode_regl IN(1,2)
       ";
        $requete = $bdd->prepare($sql);
        $requete->BindParam(':id', $id_fact);
        $requete->execute();
        $nblgn = $requete->rowCount();
        if ($nblgn > 0) {
            $paiements = $requete->fetchAll(PDO::FETCH_OBJ);
            foreach ($paiements as $p) {
                $montantcdf = $p->montantcdf;
                $montantusd = $p->montantusd;
                //CAISSE CDF OU USD
                if ($montantcdf > 0) {
                    $devise = getsymbole_local();
                    $libelle = 'Hebergemnt : Note Credit N° ' . $numero . ' Annulation occupation,remboursement client en CDF';
                    $ttc = $montantcdf;
                    $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESLOC'];
                    $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESLOC'];
                    $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESLOC'];
                    $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESLOC'];
                    $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESLOC'];
                    $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
                    $debit = 0;
                    $credit = $ttc;
                    $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
                    //tresorerie
                    $entree = 'sortie';
                    $date_bon = $dte;
                    $date_heure_bon = $dtetime;
                    $lib_monnaie = '';
                    $montantFC = $ttc;
                    $montantUSD = 0;
                    $lib_monnaie = 'sortiecdf';
                    $cpte_num = $compte_ecriture;
                    $id_user = $user_id;
                    $longcompte = 4;
                    $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
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
                    $requete->BindParam(':devise', $devise);
                    $requete->BindParam(':journal_id', $journal_id);
                    $requete->BindParam(':exercice_id', $exercice_id);
                    $requete->BindParam(':site_id', $site_id);
                    $requete->BindParam(':ecriture_id', $ecriture_id);
                    $requete->execute();
                    //TVA FACTUREE SUR 
                    if ($tva != 0) {
                        $montanttva = ($ttc * $tva) / 100;
                        $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TVA'];
                        $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TVA'];
                        $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TVA'];
                        $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TVA'];
                        $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TVA'];
                        $debit = $montanttva;
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
                    }
                    //TVA FACTUREE SUR VENTE  

                    //VENTE MARCHANDISE OU VENTE PRODUIT FINI
                    $ht = $ttc - $montanttva;
                    $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['PROSERV'];
                    $long_compte = $_SESSION['ConfLinkMod']['long_compte']['PROSERV'];
                    $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['PROSERV'];
                    $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['PROSERV'];
                    $compte_id = $_SESSION['ConfLinkMod']['compte_id']['PROSERV'];
                    $debit = $ht;
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
                    //VENTE MARCHANDISE OU VENTE PRODUIT FINI
                }
                if ($montantusd > 0) {
                    $devise = getsymbole_devise();
                    $libelle = 'Hebergement : Note Credit N° ' . $numero . ' Annulation occupation,remboursement client en USD';
                    $ttc = $montantusd;
                    $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESETR'];
                    $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESETR'];
                    $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESETR'];
                    $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESETR'];
                    $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESETR'];
                    $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
                    $debit = 0;
                    $credit = $ttc;
                    $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $devise, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
                    //tresorerie
                    $entree = 'sortie';
                    $date_bon = $dte;
                    $date_heure_bon = $dtetime;
                    $lib_monnaie = '';
                    $montantFC = 0;
                    $montantUSD = $ttc;
                    $lib_monnaie = 'sortieusd';
                    $cpte_num = $compte_ecriture;
                    $id_user = $user_id;
                    $longcompte = 4;
                    $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
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
                    $requete->BindParam(':devise', $devise);
                    $requete->BindParam(':journal_id', $journal_id);
                    $requete->BindParam(':exercice_id', $exercice_id);
                    $requete->BindParam(':site_id', $site_id);
                    $requete->BindParam(':ecriture_id', $ecriture_id);
                    $requete->execute();
                    //TVA FACTUREE SUR 
                    if ($tva != 0) {
                        $montanttva = ($ttc * $tva) / 100;
                        $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TVA'];
                        $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TVA'];
                        $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TVA'];
                        $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TVA'];
                        $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TVA'];
                        $debit = $montanttva;
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
                    }
                    //TVA FACTUREE SUR VENTE  

                    //VENTE MARCHANDISE OU VENTE PRODUIT FINI
                    $ht = $ttc - $montanttva;
                    $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['PROSERV'];
                    $long_compte = $_SESSION['ConfLinkMod']['long_compte']['PROSERV'];
                    $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['PROSERV'];
                    $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['PROSERV'];
                    $compte_id = $_SESSION['ConfLinkMod']['compte_id']['PROSERV'];
                    $debit = $ht;
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
                    //VENTE MARCHANDISE OU VENTE PRODUIT FINI
                }
            }
        }
    }
}



function COMPTA_ANUL_PAIE_FAC($id_fact, $reference, $tauxop, $libelle, $beneficiaire, $site_id, $user_id, $bdd)
{
    $sql = "SELECT re.id_regl,re.numero,re.dte,re.date_regl,re.id_user,pa.montantusd,pa.montantcdf,pa.rendu_usd,pa.rendu_cdf,pa.taux,mo.lib,us.nom_user,us.prenom_user
        FROM t_reglement AS re,paiement AS pa,t_mode_reglement AS mo,t_utilisateur AS us
        WHERE re.id_regl=pa.regl_id 
       AND  mo.id_mode_regl=pa.id_mode_regl 
       AND  re.id_user=us.id_user
       AND re.id_fact=:id
       AND mo.id_mode_regl IN(1,2)
       ";
    $requete = $bdd->prepare($sql);
    $requete->BindParam(':id', $id_fact);
    $requete->execute();
    $nblgn = $requete->rowCount();
    if ($nblgn > 0) {
        $paiements = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($paiements as $p) {
            $montantcdf = $p->montantcdf;
            $montantusd = $p->montantusd;
            //CAISSE CDF OU USD
            if ($montantcdf > 0) {

                ExerciceEncours($site_id, $bdd);
                $exercice_id = $_SESSION['exercice_id'];
                $journal_id = 3;
                $dte = date('Y-m-d');
                $dteaff = $dte;
                $dtetime = date('Y-m-d H:i:s');
                $psedo = 0;
                $libelle = 'Hebergement : Remboursement client en CDF';
                $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
                $devisecdf = 'CDF';
                $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESLOC'];
                $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESLOC'];
                $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESLOC'];
                $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESLOC'];
                $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESLOC'];
                $debit = 0;
                $credit = $montantcdf;
                $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $devisecdf, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
                //tresorerie
                $entree = 'sortie';
                $date_bon = $dte;
                $date_heure_bon = $dtetime;
                $montantFC = $montantcdf;
                $montantUSD = 0;
                $cpte_num = $compte_ecriture;
                $id_user = $user_id;
                $longcompte = 4;
                $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
                $lib_monnaie = 'sortiecdf';
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
                $debit = $montantcdf;
                $credit = 0;
                $libelledescrpt = '';
                $numdoc = '';
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

            }
            if ($montantusd > 0) {
                ExerciceEncours($site_id, $bdd);
                $exercice_id = $_SESSION['exercice_id'];
                $journal_id = 3;
                $dte = date('Y-m-d');
                $dteaff = $dte;
                $dtetime = date('Y-m-d H:i:s');
                $psedo = 0;
                $libelle = 'Hebergement: Remboursement client en USD';
                $ecriture_id = EcritureCompta($dte, $dteaff, $dtetime, $libelle, $reference, $beneficiaire, $journal_id, $psedo, $exercice_id, $user_id, $site_id, $bdd);
                $deviseusd = "USD";
                $compte_ecriture = $_SESSION['ConfLinkMod']['compte_ecriture']['TRESETR'];
                $long_compte = $_SESSION['ConfLinkMod']['long_compte']['TRESETR'];
                $souscompte_id = $_SESSION['ConfLinkMod']['souscompte_id']['TRESETR'];
                $categorie_id = $_SESSION['ConfLinkMod']['categorie_id']['TRESETR'];
                $compte_id = $_SESSION['ConfLinkMod']['compte_id']['TRESETR'];
                $debit = 0;
                $credit = $montantusd;
                $detail_id_ecrit = DetailsEcritureCompta($compte_id, $debit, $credit, $deviseusd, $tauxop, $ecriture_id, $site_id, $categorie_id, $souscompte_id, $compte_ecriture, $long_compte, $bdd);
                //tresorerie
                $entree = 'sortie';
                $date_bon = $dte;
                $date_heure_bon = $dtetime;
                $montantFC = 0;
                $montantUSD = $montantusd;
                $cpte_num = $compte_ecriture;
                $id_user = $user_id;
                $longcompte = 4;
                $datas = INFOSFromAccountNumber($cpte_num, $longcompte, $bdd);
                $lib_monnaie = 'sortieusd';
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
                $debit = $montantusd;
                $credit = 0;
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
    }
}
function CreancesClients($bdd)
{
    $idsite = $_SESSION['id_hotel'];
    $date_bd1 = $date_bd2 = date('Y-m-d');
    $solde = $tdebit = $tcredit = 0;
    $requete = $bdd->prepare("SELECT b.id_client,b.nom_client 
                                FROM t_facture AS a, t_client AS b 
                                WHERE a.id_client=b.id_client
                                AND a.type='restaurant'
                                AND a.etat_cmd=0
                                AND b.type='client'
                                AND a.id_hotel=:id
                                GROUP BY b.id_client
                                ORDER BY b.nom_client ASC");
    $requete->BindParam(':id', $idsite);
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
                                     AND a.type='restaurant'
                                     AND a.etat_cmd=0
                                     AND a.date_edition BETWEEN :date_bd1 AND :date_bd2");
        $requete->BindParam(':idcl', $idclient);
        $requete->BindParam(':date_bd1', $date_bd1);
        $requete->BindParam(':date_bd2', $date_bd2);
        $requete->execute();
        $factures = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($factures as $fct) {
            $id_fact = $fct->id_fact;
            $taux = $fct->taux;
            $monnaie = $fct->monnaie;
            $totalfact = $fct->mont_ttc;
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
        $tdebit += $debit;
        $tcredit += $credit;
    }
    $solde = $tdebit - $tcredit;
    return $solde;
}

function FicheStockBySite2($etat_depot, $famille_id, $depot_id, $datedeb, $datefin, $bdd)
{

    $_SESSION['fs'] = array();
    $_SESSION['fs']['id'] = array();
    $_SESSION['fs']['des'] = array();
    $_SESSION['fs']['q0'] = array();
    $_SESSION['fs']['qin'] = array();
    $_SESSION['fs']['qout'] = array();
    $_SESSION['fs']['qavarie'] = array();
    $_SESSION['fs']['qsolde'] = array();
    $_SESSION['fs']['depot_id'] = array();
    $_SESSION['fs']['depot_name'] = array();
    $_SESSION['fs']['qa'] = array();
    //Liste de tous les produits par depot
    $req3 = "SELECT DISTINCT prod.idprod,prod.code,prod.designation AS produit,prod.pa,prod.pv,
                           prod.qte_initial,prod.qte_min,prod.unite,prod.monnaie,s_fam.des,fam.designation 
                      FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam
                       WHERE  prod.famille_id=s_fam.id_s_fam AND prod.hotel_id=:hotel_id 
                             AND s_fam.famille=fam.idfamille AND prod.pseudo_supp=0 
                             AND prod.repas=0
                             AND fam.plat=0 ORDER BY prod.designation ";
    $requete = $bdd->prepare($req3);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $articles = $requete->fetchAll(PDO::FETCH_OBJ);
    //Liste des reports des produits
    $req1 = "SELECT a.produit_id,a.qte_report FROM stk__mouvement AS a
                    WHERE a.idmvt IN
			(SELECT MAX(b.idmvt) AS idmvt 
                                  FROM stk__mouvement AS b 
                                   WHERE  b.depot_id=:depot_id
                                          AND b.dte_appro<:datedeb
                                          GROUP BY b.produit_id)";
    $requete = $bdd->prepare($req1);
    $requete->BindParam(':datedeb', $datedeb);
    $requete->BindParam(':depot_id', $depot_id);
    $requete->execute();
    $qiall = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($qiall as $r) {
        if (!in_array($r->produit_id, $_SESSION['fs']['id'])) {
            array_push($_SESSION['fs']['id'], $r->produit_id);
            $_SESSION['fs']['q0'][$r->produit_id] = $r->qte_report;
        }
    }
    //Liste des entrées et sorties
    $req2 = "SELECT d.id_depot,d.libelle,prod.idprod,prod.code,prod.designation,SUM(qte_entree) AS qe,SUM(qte_annul) AS qa,SUM(qte_sortie) AS qs,SUM(qte_declasse) AS qte_declasse
            FROM stk_produit AS prod, stk__mouvement AS m, t_depot AS d
            WHERE prod.idprod=m.produit_id AND d.id_depot=m.depot_id
            AND m.dte_appro BETWEEN :datedeb AND :datefin
            AND m.depot_id=:depot_id
            AND prod.hotel_id=:hotel_id
            GROUP BY prod.idprod";
    $requete = $bdd->prepare($req2);
    $requete->BindParam(':datedeb', $datedeb);
    $requete->BindParam(':datefin', $datefin);
    $requete->BindParam(':depot_id', $depot_id);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $qesll = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($qesll as $r) {
        if (!in_array($r->idprod, $_SESSION['fs']['id'])) {
            array_push($_SESSION['fs']['id'], $r->idprod);
        }
        $_SESSION['fs']['qin'][$r->idprod] = $r->qe;
        $_SESSION['fs']['qout'][$r->idprod] = $r->qs;
        $_SESSION['fs']['qavarie'][$r->idprod] = $r->qte_declasse;
        $_SESSION['fs']['qa'][$r->idprod] = $r->qa;
    }
    $_SESSION['articles_stk_session'] = $articles;
}
function NombreSosProds($bdd)
{
    $nbr = 0;
    $id = $_SESSION['company_id'];
    $depots = ListPOSAll($id, $bdd);
    $idsite = $_SESSION['default_site_id'];
    $date_bd1 = date('Y-m-d');
    $date_bd2 = date('Y-m-d');
    $depot_id = $_SESSION['default_depot_id'];
    $etat_depot = 0;
    $famille_id = 0;
    FicheStockBySite2($etat_depot, $famille_id, $depot_id, $date_bd1, $date_bd2, $bdd);
    $articles = $_SESSION['articles_stk_session'];
    foreach ($articles as $art) {
        $q0 = 0;
        $qin = 0;
        $qout = 0;
        $qsolde = 0;
        $qte_declasse = 0;
        $idprod = $art->idprod;
        $des = $art->produit;
        $qte_min = $art->qte_min;
        if (in_array($idprod, $_SESSION['fs']['id'])) {
            if (isset($_SESSION['fs']['q0'][$idprod])) {
                $q0 = $_SESSION['fs']['q0'][$idprod];
            } else {
                $_SESSION['fs']['q0'][$idprod] = $q0;
            }
            if (isset($_SESSION['fs']['qin'][$idprod])) {
                $qin = $_SESSION['fs']['qin'][$idprod];
            } else {
                $_SESSION['fs']['qin'][$idprod] = $qin;
            }
            if (isset($_SESSION['fs']['qout'][$idprod])) {
                $qout = $_SESSION['fs']['qout'][$idprod];
            } else {
                $_SESSION['fs']['qout'][$idprod] = $qout;
            }
            if (isset($_SESSION['fs']['qavarie'][$idprod])) {
                $qte_declasse = $_SESSION['fs']['qavarie'][$idprod];
            } else {
                $_SESSION['fs']['qavarie'][$idprod] = $qte_declasse;
            }
        } else {
            array_push($_SESSION['fs']['id'], $idprod);
            $_SESSION['fs']['q0'][$idprod] = $q0;
            $_SESSION['fs']['qin'][$idprod] = $qin;
            $_SESSION['fs']['qout'][$idprod] = $qout;
            $_SESSION['fs']['qavarie'][$idprod] = $qte_declasse;
        }
        $_SESSION['fs']['des'][$idprod] = $art->produit;
        $qsolde = ($q0 + $qin) - ($qout + $qte_declasse);
        $_SESSION['fs']['qsolde'][$idprod] = $qsolde;
        if ($qte_min >= $qsolde) {
            $nbr++;
        }
    }
    return $nbr;
}
function ListPOSAll($company_id, $bdd)
{
    $_SESSION['default_site_name'] = '';
    $_SESSION['default_site_id'] = 0;
    $_SESSION['default_depot_id'] = 0;
    $data = array();
    $data['depot_id'] = array();
    $data['libelle'] = array();
    $data['site_id'] = array();
    $requete = "SELECT * FROM t_hotel AS a WHERE a.company_id=:id
                AND a.etat=1
               ORDER BY a.id_hotel ASC";
    $requete = $bdd->prepare($requete);
    $requete->BindParam(':id', $company_id);
    $requete->execute();
    $result = $requete->fetchALL(PDO::FETCH_OBJ);
    $bool_site = 0;
    foreach ($result as $art2) {
        $id_hotel = $art2->id_hotel;
        $activite = $art2->activite;
        //if ($activite != 'service'){
        $requete = $bdd->prepare("SELECT * FROM t_sousresto WHERE hotel_id=:hotel_id ORDER BY etat,libelle");
        $requete->BindParam(':hotel_id', $id_hotel);
        $requete->execute();
        $soussites = $requete->fetchALL(PDO::FETCH_OBJ);
        foreach ($soussites as $st) {
            $id_sous_resto = $st->depot_id;
            $libelle_resto = $st->libelle;
            array_push($data['depot_id'], $id_sous_resto);
            array_push($data['libelle'], $libelle_resto);
            array_push($data['site_id'], $id_hotel);
            if ($bool_site == 0) {
                $_SESSION['default_site_id'] = $id_hotel;
                $_SESSION['default_site_name'] = $libelle_resto;
                $_SESSION['default_depot_id'] = $id_sous_resto;
                $bool_site++;
            }
        }
        //}

    }
    return $data;
    //return $result;
}

function infosPosTDB($id, $default, $bdd)
{
    //    $default=0 signifie pos par defaut
    if ($default != 0) {
        $requete = $bdd->prepare("SELECT *FROM t_sousresto AS a WHERE a.id_sousresto=:id_sousresto");
        $requete->BindParam(':id_sousresto', $id);
    } else {
        $requete = $bdd->prepare("SELECT *FROM t_sousresto AS a WHERE a.hotel_id=:id_hotel AND a.etat=1 AND a.statut=0");
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
    }
    $requete->execute();
    $st = $requete->fetch(PDO::FETCH_OBJ);
    $id_sous_resto = $st->id_sousresto;
    $libelle_resto = $st->libelle;
    $depot_id = $st->depot_id;
    $_SESSION['id_sousresto'] = $id_sous_resto;
    $_SESSION['libelle_resto'] = $libelle_resto;
    $_SESSION['taux_resto'] = $st->taux;
    $_SESSION['depot_id'] = $depot_id;
    $_SESSION['mention'] = $st->mentionlegale;
    $_SESSION['remise'] = $st->remise;
    return $st;
}
