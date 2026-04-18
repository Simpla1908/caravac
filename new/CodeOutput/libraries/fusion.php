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
    return number_format($mon, 0, ',', '.');
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

//verifie si une valeur est entier
function IsNombre($val) {
    $bool = FALSE;
    if (is_numeric($val) && $val > 0) {
        $bool = TRUE;
    }
    return $bool;
}

// TOUTES LES CONFIGURATIONS DU MODULE
function ConfigModule($module_id, $site_id) {
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

function ConfigModule2($module_id, $site_id, $bdd) {
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
function DetailsVenteGlobal($id, $date_bd1, $date_bd2, $niveau, $bdd) {
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
    $m_affiche = getsymbole_local();
    $requete = '';
    $articles3 = array();
    if ($niveau == 1) {
        $requete = $bdd->prepare("SELECT a.taux_prix,b.monnaie,a.mode,c.idprod,c.code, c.designation,
                                 SUM(b.qte) AS qte, b.prix AS pu, b.dte_h,a.mode AS lib,SUM(b.qte*b.prix) AS mont,
                                 SUM(b.qteoffert) AS qteoffert,SUM(b.qteoffert*b.prix2) AS montof
         FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a
         WHERE b.produit_id= c.idprod
         AND a.type ='restaurant'
         AND a.id_fact=b.commande_id 
         AND a.date_edition  BETWEEN :date_bd1 AND :date_bd2
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
        $prix =$art2->idprod.round($art2->pu);
        $prixaf = montant_equivalent_bdd($art2->monnaie, $m_affiche, $tauxdollar1, $prix1);
        if (!(in_array($art2->idprod, $_SESSION['prod']['id']) && in_array($prix, $_SESSION['prod']['prix']))) {
            array_push($_SESSION['prod']['id'], $art2->idprod);
            array_push($_SESSION['prod']['des'], $art2->designation);
            array_push($_SESSION['prod']['prix'], $prixaf);
            array_push($_SESSION['prod']['prix2'], $prix1);
            array_push($_SESSION['prod']['prodprice'],$prix);
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

function SiteInfos($id, $bdd) {
    $data = array();
    $data['id'] = array();
    $data['libelle'] = array();
    $data['niveau'] = array();
    $requete = "SELECT * FROM t_hotel AS a WHERE a.activite!='service' AND a.company_id=:id
               ORDER BY a.nom_hotel ASC";
    $requete = $bdd->prepare($requete);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $result = $requete->fetchALL(PDO::FETCH_OBJ);
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
    }
    return $data;
}

function VenteglobalDujour($bdd){
    $niveau =1;
    $date_bd1=$date_bd2=date('Y-m-d');
    $id = $_SESSION['company_id'];
    $m_affiche = getsymbole_local();
   $articles3 = array();
    $requete = $bdd->prepare("SELECT a.taux_prix,b.monnaie,a.mode,c.idprod,c.code, c.designation,
                             SUM(b.qte) AS qte, b.prix AS pu, b.dte_h,a.mode AS lib,SUM(b.qte*b.prix) AS mont,
                             SUM(b.qteoffert) AS qteoffert,SUM(b.qteoffert*b.prix2) AS montof
     FROM lignes_commandes AS b, stk_produit AS c, t_facture AS a
     WHERE b.produit_id= c.idprod AND a.id_fact=b.commande_id 
     AND a.date_edition  BETWEEN :date_bd1 AND :date_bd2
     AND a.company_id =:id
     GROUP BY c.idprod, a.mode,b.prix  
     ORDER BY c.designation");
    $requete->BindParam(':date_bd1', $date_bd1);
    $requete->BindParam(':date_bd2', $date_bd2);
    $requete->BindParam(':id', $id);
    $requete->execute();
    $articles3 = $requete->fetchAll(PDO::FETCH_OBJ);
    $tot=0;
    foreach ($articles3 as $art2) {
        $tauxdollar1 = $art2->taux_prix;
        $prix = $art2->pu;
        $prixaf = montant_equivalent_bdd($art2->monnaie, $m_affiche, $tauxdollar1, $prix);
        if ($art2->lib == 'Cash'){
            $_SESSION['cash']['qte'][$prix] = $art2->qte;
            $prix_u = montant_equivalent_bdd(getsymbole_local(), $m_affiche, $tauxdollar1, $art2->mont);
            $tot+=$prix_u;
        }
    }
    return $tot;
}
