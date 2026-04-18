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
//if (!defined('VALID_DIR'))
//    die('You are not allowed to execute this file directly');

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
//Affiche un nombre formaté + monnaie
function afficheMontant2($maffiche, $montant1)
{
    $montant1 = format_chiffre($montant1);
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
}

//CONSOLIDATION DES DONNEES
function DetailsVenteGlobal($id, $date_bd1, $date_bd2, $niveau, $bdd)
{
    $_SESSION['prod'] = array();
    $_SESSION['prod']['id'] = array();
    $_SESSION['prod']['des'] = array();
    $_SESSION['prod']['prix'] = array();
    $_SESSION['prod']['prix2'] = array();
    $_SESSION['prod']['prodprice'] = array();
    $_SESSION['cash'] = array();
    $_SESSION['cash']['qte'] = array();
    $_SESSION['cash']['pt'] = array();
    $_SESSION['credit'] = array();
    $_SESSION['credit']['qte'] = array();
    $_SESSION['credit']['pt'] = array();
    $_SESSION['don'] = array();
    $_SESSION['don']['qte'] = array();
    $_SESSION['don']['pt'] = array();
    $m_affiche = $_SESSION['m_affiche'];
    $requete = '';
    $articles3 = array();
    if ($niveau == 1) {
        $requete = $bdd->prepare("SELECT a.taux_prix,b.monnaie,a.mode,c.idprod,c.code, c.designation,
                             SUM(b.qte) AS qte, b.prix AS pu, b.dte_h,a.mode AS lib,SUM(b.qte*b.prix) AS mont,
                             SUM(b.qteoffert) AS qteoffert,SUM(b.qteoffert*b.prix2) AS montof
     FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a
     WHERE b.produit_id= c.idprod AND a.id_fact=b.commande_id 
     AND a.date_edition  BETWEEN :date_bd1 AND :date_bd2
     AND a.mode IS NOT NULL
     AND a.company_id =:id
     GROUP BY c.idprod, a.mode,b.prix  
     ORDER BY c.designation");
    } elseif ($niveau == 2) {
        $requete = $bdd->prepare("SELECT a.taux_prix,b.monnaie,a.mode,c.idprod,c.code, c.designation,
                                 SUM(b.qte) AS qte, b.prix AS pu, b.dte_h,a.mode AS lib,SUM(b.qte*b.prix) AS mont,
                                 SUM(b.qteoffert) AS qteoffert,SUM(b.qteoffert*b.prix2) AS montof
         FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a
         WHERE b.produit_id= c.idprod 
         AND a.type ='restaurant'
         AND a.id_fact=b.commande_id 
         AND a.date_edition  BETWEEN :date_bd1 AND :date_bd2
        AND a.mode IS NOT NULL
         AND a.id_hotel=:id
         GROUP BY c.idprod, a.mode,b.prix  
         ORDER BY c.designation");
    } elseif ($niveau == 3) {
        $requete = $bdd->prepare("SELECT a.taux_prix,b.monnaie,a.mode,c.idprod,c.code, c.designation,
                                 SUM(b.qte) AS qte, b.prix AS pu, b.dte_h,a.mode AS lib,SUM(b.qte*b.prix) AS mont,
                                 SUM(b.qteoffert) AS qteoffert,SUM(b.qteoffert*b.prix2) AS montof
         FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a
         WHERE b.produit_id= c.idprod 
         AND a.type ='restaurant'
         AND a.id_fact=b.commande_id 
         AND a.date_edition  BETWEEN :date_bd1 AND :date_bd2
        AND a.mode IS NOT NULL
         AND a.id_sousresto=:id
         GROUP BY c.idprod, a.mode,b.prix  
         ORDER BY c.designation");
    }
    $requete->BindParam(':date_bd1', $date_bd1);
    $requete->BindParam(':date_bd2', $date_bd2);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $articles3 = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($articles3 as $art2) {
        $tauxdollar1 = $art2->taux_prix;
        $prix1 = $art2->pu;
        $prix = $art2->idprod . round($art2->pu);
        $prixaf = montant_equivalent_bdd($art2->monnaie, $m_affiche, $tauxdollar1, $prix1);
        if (!(in_array($art2->idprod, $_SESSION['prod']['id']) && in_array($prix, $_SESSION['prod']['prix']))) {
            array_push($_SESSION['prod']['id'], $art2->idprod);
            array_push($_SESSION['prod']['des'], $art2->designation);
            array_push($_SESSION['prod']['prix'], $prixaf);
            array_push($_SESSION['prod']['prix2'], $prix1);
            array_push($_SESSION['prod']['prodprice'], $prix);
        }
        if ($art2->lib == 'Cash') {
            $_SESSION['cash']['qte'][$prix] = $art2->qte;
            $prix_u = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $art2->mont);
            $_SESSION['cash']['pt'][$prix] = $prix_u;
            $ptoffre = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $art2->montof);
            $_SESSION['don']['qte'][$prix] = $art2->qteoffert;
            $_SESSION['don']['pt'][$prix] = $ptoffre;
        } elseif ($art2->lib == 'Credit') {
            $_SESSION['credit']['qte'][$prix] = $art2->qte;
            $prix_u = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $art2->mont);
            $_SESSION['credit']['pt'][$prix] = $prix_u;
            $ptoffre = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $art2->montof);
            $_SESSION['don']['qte'][$prix] = $art2->qteoffert;
            $_SESSION['don']['pt'][$prix] = $ptoffre;
        } elseif ($art2->lib == 'Don') {
            $_SESSION['don']['qte'][$prix] = $art2->qte;
            $prix_u = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $art2->mont);
            $_SESSION['don']['pt'][$prix] = $prix_u;
        }
    }
}

function SiteInfos($id, $bdd)
{
    $_SESSION['default_site_name'] = '';
    $_SESSION['default_site_id'] = 0;
    $data = array();
    $data['id'] = array();
    $data['libelle'] = array();
    $data['niveau'] = array();
    $requete = "SELECT * FROM t_hotel AS a WHERE a.activite!='service'
                AND a.company_id=:id
                AND a.etat=1
               ORDER BY a.nom_hotel ASC";
    $requete = $bdd->prepare($requete);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetchALL(PDO::FETCH_OBJ);
    $bool_site = 0;
    foreach ($result as $art2) {
        $id_hotel = $art2->id_hotel;
        array_push($data['id'], $id_hotel);
        array_push($data['libelle'], $art2->nom_hotel);
        array_push($data['niveau'], 2);
        $activite = $art2->activite;
        if ($activite != 'service') {
            $requete = $bdd->prepare("SELECT *FROM t_sousresto AS a WHERE a.hotel_id=:id_hotel AND a.etat=1 AND a.statut=0");
            $requete->BindParam(':id_hotel', $art2->id_hotel);
            $requete->execute();
            $soussites = $requete->fetchALL(PDO::FETCH_OBJ);
            foreach ($soussites as $st) {
                $id_sous_resto = $st->id_sousresto;
                $libelle_resto = $st->libelle;
                array_push($data['id'], $id_sous_resto);
                array_push($data['libelle'], $libelle_resto);
                array_push($data['niveau'], 3);
            }
        }
        if ($bool_site == 0) {
            $_SESSION['default_site_id'] = $art2->id_hotel;
            $_SESSION['default_site_name'] = $art2->nom_hotel;
            $bool_site++;
        }
    }
    return $data;
}

function VenteglobalDujour($bdd)
{
    $idsite = $_SESSION['id_hotel'];
    $date_bd1 = $date_bd2 = date('Y-m-d');

    $requete = $bdd->prepare("SELECT e.familletype_id,b.prixremise,a.taux_prix,a.monnaie,a.mode,a.mont_ttc_remise,c.idprod,c.code, c.designation,c.repas,c.nourriture,
    SUM(b.qte) AS qte, b.prixremise AS pu, b.dte_h,a.mode AS lib,SUM((b.qte*b.prixremise)/a.taux_prix) AS mont,
    SUM(b.qteoffert) AS qteoffert,SUM(b.qteoffert*b.prix2) AS montof
FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a,
stk_sous_famille AS d,stk_famille AS e,stk_familletype AS f
WHERE a.id_fact=b.commande_id 
AND b.produit_id= c.idprod
AND c.famille_id=d.id_s_fam
AND d.famille=e.idfamille
AND e.familletype_id=f.id
AND a.mode IS NOT NULL
AND a.date_edition  BETWEEN :date_bd1 AND :date_bd2
AND a.id_hotel  =:id_hotel 
GROUP BY c.idprod, b.prixremise, a.mode2
ORDER BY c.nourriture,c.designation");

    $requete->BindParam(':date_bd1', $date_bd1);
    $requete->BindParam(':date_bd2', $date_bd2);
    $requete->BindParam(':id_hotel', $idsite);
    $requete->execute();
    $articles3 = $requete->fetchAll(PDO::FETCH_OBJ);

    $tot = 0;
    $m_affiche='USD';
    foreach ($articles3 as $art2) {
        if ($art2->lib !='Don') {
            $tauxdollar1 = $art2->taux_prix;
            $tx_remise = $art2->mont_ttc_remise;
            //$prix_u = montant_equivalent_bdd(getsymbole_devise(), $m_affiche, $tauxdollar1, $art2->mont);
            $prix_u = $art2->mont;
           // $prix_remise =  ($prix_u * $tx_remise) / 100;
            $prix_remise = 0;
           // $prix_u = $prix_u - $prix_remise;
            $tot+=$prix_u;
        }
        

    }
    return $tot;
}
function FicheStockBySite($idsite, $depot_id, $datedeb, $datefin, $bdd)
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
    $famille_id = 0;

    //Liste de tous les produits par depot
    $req3 = "SELECT DISTINCT prod.idprod,prod.code,prod.designation AS produit,prod.pa,prod.pv,
               prod.qte_initial,prod.qte_min,prod.unite,prod.monnaie,s_fam.des,fam.designation 
          FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam
           WHERE  prod.famille_id=s_fam.id_s_fam AND prod.hotel_id=:hotel_id 
                 AND s_fam.famille=fam.idfamille AND prod.pseudo_supp=0 
                 AND prod.repas=0
                 AND fam.plat=0 ORDER BY prod.designation ";
    $requete = $bdd->prepare($req3);
    $requete->BindParam(':hotel_id', $idsite);
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
    $req2 = "SELECT d.id_depot,d.libelle,prod.idprod,prod.code,prod.designation,SUM(qte_entree) AS qe,SUM(qte_sortie) AS qs,SUM(qte_declasse) AS qte_declasse
        FROM stk_produit AS prod, stk__mouvement AS m, t_depot AS d
        WHERE prod.idprod=m.produit_id AND d.id_depot=m.depot_id
        AND m.dte_appro BETWEEN :datedeb AND :datefin
        AND m.depot_id=:depot_id
        GROUP BY prod.idprod";
    $requete = $bdd->prepare($req2);
    $requete->BindParam(':datedeb', $datedeb);
    $requete->BindParam(':datefin', $datefin);
    $requete->BindParam(':depot_id', $depot_id);
    $requete->execute();
    $qesll = $requete->fetchAll(PDO::FETCH_OBJ);

    foreach ($qesll as $r) {
        if (!in_array($r->idprod, $_SESSION['fs']['id'])) {
            array_push($_SESSION['fs']['id'], $r->idprod);
        }
        $_SESSION['fs']['qin'][$r->idprod] = $r->qe;
        $_SESSION['fs']['qout'][$r->idprod] = $r->qs;
        $_SESSION['fs']['qavarie'][$r->idprod] = $r->qte_declasse;
    }
    $_SESSION['articles'] = $articles;
}
function GetDepotCentral_id($hotel_id, $bdd)
{
    $depot_id = 0;
    $requete = $bdd->prepare("SELECT *
                                FROM t_sousresto
                                        WHERE etat=0 AND hotel_id=:hotel_id");
    $requete->BindParam(':hotel_id', $hotel_id);
    $requete->execute();
    $reports = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($reports as $c) {
        $depot_id = $c->depot_id;
    }
    return $depot_id;
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

function ReduiceDaysToDate($dte, $nbrejr)
{
    $addjr = '-' . $nbrejr . 'days';
    $date_collect = date("Y-m-d", strtotime($dte . $addjr));
    $new_date_collect = $date_collect;
    return $new_date_collect;
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



function arrondir($montant)
{
    return round($montant, 2);
}
function SoldeTresorerie($company_id, $bdd)
{
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
    foreach ($result as $art2) {
        $id_hotel = $art2->id_hotel;
        $requete = $bdd->prepare("SELECT montantFC,montantUSD,type FROM  t_operation WHERE hotel_id=:hotel_id AND psedo=0");
        $requete->BindParam(':hotel_id', $id_hotel);
        $requete->execute();
        $result2 = $requete->fetchALL(PDO::FETCH_OBJ);
        $SoldeCDF = 0;
        $SoldeUSD = 0;
        foreach ($result2 as $rows) {
            if ($rows->type == 'entree') {
                $SoldeCDF = $SoldeCDF + $rows->montantFC;
                $SoldeUSD = $SoldeUSD + $rows->montantUSD;
            } else {
                $SoldeCDF = $SoldeCDF - $rows->montantFC;
                $SoldeUSD = $SoldeUSD - $rows->montantUSD;
            }
        }
        $data['tresorerie_cdf'] = $SoldeCDF;
        $data['tresorerie_usd'] = $SoldeUSD;
    }
    return $data;
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

       /*  if ($verser_usd == 0 &&  $verser_cdf == 0) {
            $SoldeCDF = ($rfond_cdf + $fond_cdf + $vente_cdf) - ($dep_cdf+$verser_cdf);
            $SoldeUSD = ($rfond_usd + $fond_usd + $vente_usd) - ($dep_usd+$verser_usd);
         } else {
            $SoldeCDF = $rfond_cdf;
            $SoldeUSD = $rfond_usd;
        } */

        $recettecdf=$rfond_cdf + $fond_cdf + $vente_cdf;
        $recetteusd=$rfond_usd + $fond_usd + $vente_usd;

        $sortiecdf=$dep_cdf+$verser_cdf;
        $sortieusd=$dep_usd+$verser_usd;
      
        $SoldeCDF =$recettecdf- $sortiecdf; 
        $SoldeUSD =$recetteusd- $sortieusd; 
    }



    $data['tresorerie_cdf'] = $SoldeCDF;
    $data['tresorerie_usd'] = $SoldeUSD;
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
function GenererJournalCaisse($d1, $d2, $site_id, $bdd)
{
    $requete = $bdd->prepare("SELECT op.*,dtc.devise FROM t_operation AS op, cptdetailsecritures AS dtc
WHERE op.detail_id_ecrit=dtc.id AND
 op.hotel_id=:hotel_id AND op.date_bon BETWEEN :d1 AND :d2");
    $requete->BindParam(':hotel_id', $site_id);
    $requete->BindParam(':d1', $d1);
    $requete->BindParam(':d2', $d2);
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_OBJ);
}
function DetailsJCG($company_id, $bdd)
{
    //journalcaisse
    $d1 = $d2 = date('Y-m-d');
    $idjournal = 3;
    //Mise en session pour impression
    $_SESSION['journal'] = array();
    $_SESSION['journal']['n'] = array();
    $_SESSION['journal']['reference'] = array();
    $_SESSION['journal']['date'] = array();
    $_SESSION['journal']['description'] = array();
    $_SESSION['journal']['debit'] = array();
    $_SESSION['journal']['credit'] = array();
    $_SESSION['journal']['beneficiaire'] = array();

    $requete = "SELECT * FROM t_hotel AS a,cptexercice AS b
                WHERE a.company_id=:id
                AND a.id_hotel=b.site_id
                AND b.etat=1
                AND a.etat=1
               ORDER BY a.id_hotel ASC";
    $requete = $bdd->prepare($requete);
    $requete->BindParam(':id', $company_id);
    $requete->execute();
    $result = $requete->fetchALL(PDO::FETCH_OBJ);

    foreach ($result as $art2) {
        $id_hotel = $art2->id_hotel;
        $exercice_id = $art2->id;
        $result2 = GenererJournalCaisse($d1, $d2, $id_hotel, $bdd);
        $i = 0;
        foreach ($result2 as $rows) {
            $datebon = $rows->date_bon;
            $numBon = $rows->numBon;
            $type = $rows->type;
            $description = $rows->libelle;
            $devise = $rows->devise;
            if ($devise == 'CDF') {
                if ($type == 'entree') {
                    $debit = $rows->montantFC;
                    $credit = 0;
                    $compte_id = $rows->motif_id;
                    $format = $rows->format;
                    $data = INFOSFromAccountNumber($compte_id, $format, $bdd);
                    $benprov = $compte_id . ' ' . $data['lib'];
                } else {
                    $debit = 0;
                    $credit = $rows->montantFC;
                    $benprov = $rows->beneficiaire;
                }
            } else {
                if ($type == 'entree') {
                    $debit = $rows->montantUSD;
                    $credit = 0;
                    $compte_id = $rows->motif_id;
                    $format = $rows->format;
                    $data = INFOSFromAccountNumber($compte_id, $format, $bdd);
                    $benprov = $compte_id . ' ' . $data['lib'];
                } else {
                    $debit = 0;
                    $credit = $rows->montantUSD;
                    $benprov = $rows->beneficiaire;
                }
            }
            array_push($_SESSION['journal']['n'], $i);
            array_push($_SESSION['journal']['reference'], $numBon);
            array_push($_SESSION['journal']['date'], dateAffiche($datebon));
            array_push($_SESSION['journal']['description'], ucfirst($description));
            array_push($_SESSION['journal']['debit'], $debit);
            array_push($_SESSION['journal']['credit'], $credit);
            array_push($_SESSION['journal']['beneficiaire'], ucfirst($benprov));
            $i++;
        }
    }
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
function SiteExerciceBycompany($idsite, $bdd)
{
    $requete = "SELECT * FROM t_hotel AS a,cptexercice AS b
                WHERE a.company_id=:id
                AND a.id_hotel=b.site_id
                AND b.etat=1
                AND a.etat=1
               ORDER BY a.id_hotel ASC";
    $requete = $bdd->prepare($requete);
    $requete->BindParam(':id', $idsite);
    try {
        $requete->execute();
        $result = $requete->fetchALL(PDO::FETCH_OBJ);
        return $result;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function SiteExerciceById($idsite, $bdd)
{
    $requete = "SELECT * FROM t_hotel AS a,cptexercice AS b
                WHERE a.id_hotel=:id
                AND a.id_hotel=b.site_id
                AND b.etat=1
                AND a.etat=1
               ORDER BY a.id_hotel ASC";
    $requete = $bdd->prepare($requete);
    $requete->BindParam(':id', $idsite);
    try {
        $requete->execute();
        $result = $requete->fetchALL(PDO::FETCH_OBJ);
        return $result;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function FormatChiffreCompta($n)
{
    $n = round($n, 0);
    return strrev(wordwrap(strrev($n), 3, ' ', true));
}

function GetBonsAchatBySite($idsite, $dte1, $dte2, $bdd)
{
    $requete = 'SELECT a.id_fact,a.num_fact,a.num_cmd,a.date_edition,a.monnaie,a.justification,a.id_hotel,a.company_id,a.id_user,a.id_client,a.statut_bon,a.mode,
                        b.id_client,b.nom_entreprise, c.commande_id,SUM(c.prix * c.qte) AS tot_cmd
                        FROM  t_facture AS a, t_client AS b, lignes_commandes AS c,t_hotel AS h
                        WHERE a.id_client=b.id_client
                        AND a.id_fact=c.commande_id 
                        AND a.id_hotel=h.id_hotel
                        AND h.id_hotel=:id
                        AND a.type="achat"
                        AND a.date_edition BETWEEN :dte1 AND :dte2
                        GROUP BY a.id_fact';
    $query = $bdd->prepare($requete);
    $query->BindParam(':id', $idsite);
    $query->BindParam(':dte1', $dte1);
    $query->BindParam(':dte2', $dte2);
    try {
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    try {
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function GetBonsAchatByCompany($idsite, $dte1, $dte2, $bdd)
{
    $requete = 'SELECT a.id_fact,a.num_fact,a.num_cmd,a.date_edition,a.monnaie,a.justification,a.id_hotel,a.company_id,a.id_user,a.id_client,a.statut_bon,a.mode,
                        b.id_client,b.nom_entreprise, c.commande_id,SUM(c.prix * c.qte) AS tot_cmd
                        FROM  t_facture AS a, t_client AS b, lignes_commandes AS c,t_hotel AS h
                        WHERE a.id_client=b.id_client
                        AND a.id_fact=c.commande_id 
                        AND a.id_hotel=h.id_hotel
                        AND h.company_id=:id
                        AND a.type="achat"
                        AND a.date_edition BETWEEN :dte1 AND :dte2
                        GROUP BY a.id_fact';
    $query = $bdd->prepare($requete);
    $query->BindParam(':id', $idsite);
    $query->BindParam(':dte1', $dte1);
    $query->BindParam(':dte2', $dte2);
    try {
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function GetSitesByCompany($idsite, $bdd)
{
    $requete = "SELECT * FROM t_hotel AS a WHERE a.company_id=:id AND a.etat=1 ORDER BY a.id_hotel ASC";
    $requete = $bdd->prepare($requete);
    $requete->BindParam(':id', $idsite);
    try {
        $requete->execute();
        $result = $requete->fetchALL(PDO::FETCH_OBJ);
        return $result;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function SelectOneBesoin($id, $bdd)
{
    $requete = 'SELECT a.id_fact,a.num_fact,a.num_cmd,a.i_souscription,a.date_edition,a.monnaie,a.justification,a.id_hotel,a.company_id,a.id_user,a.id_client,a.statut_bon,a.date_approbation,
                b.id_client,b.nom_entreprise,c.nom_user, c.prenom_user
                FROM  t_facture AS a, t_client AS b,t_utilisateur AS c
                WHERE a.id_client=b.id_client AND a.id_user=c.id_user
                AND a.id_fact=:id';
    $query = $bdd->prepare($requete);
    $query->BindParam(':id', $id);
    try {
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function SelectOneBesoinLignecmd($id, $bdd)
{
    $requete = 'SELECT a.*, b.designation,b.unite
            FROM lignes_commandes AS a, stk_produit AS b
            WHERE a.produit_id=b.idprod AND a.commande_id=:id';
    $query = $bdd->prepare($requete);
    $query->BindParam(':id', $id);
    try {
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function UpdateStatut($mont_ttc, $mode, $statut, $num_commande, $facture_id, $bdd)
{
    $date_approuve = date('Y-m-d');
    $requete = $bdd->prepare("UPDATE t_facture  SET mont_ttc=:mont_ttc,mode=:mode,statut_bon=:statut_bon,num_cmd=:num_cmd,date_approbation=:date_approbation WHERE id_fact=:id_fact");
    $requete->BindParam(':mont_ttc', $mont_ttc);
    $requete->BindParam(':mode', $mode);
    $requete->BindParam(':statut_bon', $statut);
    $requete->BindParam(':num_cmd', $num_commande);
    $requete->BindParam(':date_approbation', $date_approuve);
    $requete->BindParam(':id_fact', $facture_id);
    try {
        $requete->execute();
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function UpdateStatut1($statut, $facture_id, $bdd)
{
    $requete = $bdd->prepare("UPDATE t_facture SET statut_bon=:statut_bon WHERE id_fact=:id_fact");
    $requete->BindParam(':statut_bon', $statut);
    $requete->BindParam(':id_fact', $facture_id);
    try {
        $requete->execute();
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
function Dellignecom($id, $bdd)
{
    $query = $bdd->prepare("DELETE FROM lignes_commandes WHERE id=:id");
    $query->BindParam(':id', $id);
    $query->execute();
}
//HEBERGEMENT
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
function DimunuerDaysToDate($dte, $nbrejr)
{
    //A ne pas modifier
    return $dte;
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
function GetCountChambres($id, $bdd)
{
    $req = "SELECT * FROM t_chambre AS a WHERE libre='oui' AND id_hotel=:id";
    $requete = $bdd->prepare($req);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    return $result;
}