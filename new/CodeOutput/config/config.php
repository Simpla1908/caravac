<?php
/*
	HEZECOM UltimateSpeed PHP CODE GENERATOR
	Author: Hezecom Technologies (http://hezecom.com) info@hezecom.net
	COPYRIGHT 2013 ALL RIGHTS RESERVED
	Configuration File
	FILE NAME config.php 
	
	You must have purchased a valid license from CodeCanyon.com in order to have 
	access this file.

	You may only use this file according to the respective licensing terms 
	you agreed to when purchasing this item.
	*/


if (isset($_GET['do'])) {
    $action = $_GET['do'];
    if ($action == 'heb2') {
        $_SESSION['app_folder'] = 'heb';
        $_SESSION['fichierjs'] = 'hebergement';
        $_SESSION['function'] = 'hebergement';
    } else if ($action == 'achat') {
        $_SESSION['app_folder'] = 'achat';
        $_SESSION['fichierjs'] = 'achat';
        $_SESSION['function'] = 'achat';
    } else if ($action == 'rh') {
        $_SESSION['app_folder'] = 'rh';
        $_SESSION['fichierjs'] = 'rh';
        $_SESSION['function'] = 'rh';
    } else if ($action == 'fact') {
        $_SESSION['app_folder'] = 'fact';
        $_SESSION['fichierjs'] = 'fact';
        $_SESSION['function'] = 'fact';
    } else if ($action == 'fusion') {
        $_SESSION['app_folder'] = 'fusion';
        $_SESSION['fichierjs'] = 'fusion';
        $_SESSION['function'] = 'fusion';
    } else if ($action == 'compta') {
        $_SESSION['app_folder'] = 'compta';
        $_SESSION['fichierjs'] = 'compta';
        $_SESSION['function'] = 'compta';
    }
}
$path = dirname(__FILE__);
$npath = str_replace('\\', '/', $path);
$npath = str_replace($_SERVER['DOCUMENT_ROOT'], '', $npath);
$absolutep = str_replace('config', '', $npath);

/* define('LOCALHOST','ebutelocirbp4265.mysql.db');
define('DB_USERNAME','ebutelocirbp4265');
define('DB_PASSWORD','Mot2pa553');
define('DB_NAME','ebutelocirbp4265'); */
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'E1b2u3t4e5l6o@');
define('DB_NAME', 'caravacdb');
define('DB_TYPE', 'mysql');
define('H_TITLE', 'Ebutelo');
define('PAGINATION_TYPE', 'Normal'); //Normal|Jquery
define('RECORD_PER_PAGE', '20');
define('BIG_IMAGE_WIDTH', '300');
define('THUMB_IMAGE_WIDTH', '150');

//Admin Login Info
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'hezecom');

//Upload Directory
define('UPLOAD_FOLDER', 'public/uploads/');
define('UPLOAD_LOGO', 'REC/images/logo_entreprise/');
define('THUMB_FOLDER', 'public/uploads/thumbs/');
$base = str_replace('config', '', dirname(__FILE__) . DIRECTORY_SEPARATOR . '/');
define('UPLOAD_LOGO_PATH', $base . UPLOAD_LOGO);
define('UPLOAD_PATH', $base . UPLOAD_FOLDER);
define('THUMB_PATH', $base . THUMB_FOLDER);
define('NO_IMAGE', 'public/themes/default/images/user_avatar.png');

define('VALID_DIR', 1);
define('APP_PATH', $base);
define('APP_FOLDER', APP_PATH . $_SESSION['app_folder']);
//define('APP_FOLDER',APP_PATH.'rh');
define('DEFAULT_THEME', 'public/themes/default');
define('H_THEME', DEFAULT_THEME);
define('H_ADMIN', 'index.php?pg=admin');
define('H_LOGIN', '../../Authentification/logout.php');
define('H_CLIENT', 'index.php?pg=public');
define('H_ADMIN_MAIN', 'main.php?pg=admin');
define('H_CLIENT_MAIN', 'main.php?pg=public');

//Backup Dir 
define('H_BACKUP_DIR', 'public/backups/');
define('H_EDITOR_FILES', $absolutep . 'public/uploads/editor');

//Multiple File Upload
define('UPLOAD_TABLE', 'hfiles');
define('FILE_ID', 'fid');
define('RELATE_ID', 'relateid');
define('H_FILE', 'gfile');
define('H_DATE', 'gdate');

//System Access
define('H_SYSTEM_ACCESS', 'system_users');
define('H_USER_SESSION', 'hezecom_users');

//RH
define('NUM_BON_MALADE', 'BnMld');
define('NUM_PRET', 'pret');
define('NUM_AVANCE', 'avance');
define('NUM_BON_PERMT', 'bnpermt');
define('NUM_REF_SANCTION', 'refsanction');
define('NUM_REF_CONGE', 'refconge');
//FACTURATION
define('NUMFACT', 'numfacturation');
define('NUMPROFORMA', 'numproforma');
define('NUM_REGLEMENT', 'numreglement');
//ACHAT
define('NUM_BON_COMMANDE', 'boncmd');
define('NUM_BON_LIVRAISON', 'bonliv');
define('NUM_BON_APPRO', 'BE_STK');
define('NUM_ETAT_BESOIN', 'etatbesoin');
//HEBERGEMENT
define('NUMFACTHEB', 'numHebFact');
define('NUM_REGLEMENTHEB', 'numHebRec');
define('NUM_REMBOURSEMENT', 'numRemb');
