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

$_SESSION['app_folder']='fusion';
$_SESSION['fichierjs']= 'fusion';
$_SESSION['function']= 'fusion';
$path=dirname(__FILE__);  
$npath = str_replace('\\', '/', $path); 
$npath= str_replace($_SERVER['DOCUMENT_ROOT'], '', $npath); 
$absolutep= str_replace('config','',$npath);


define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','kembov4');
define('DB_TYPE','mysql');
define('H_TITLE','Ebutelo');
define('PAGINATION_TYPE','Normal');//Normal|Jquery
define('RECORD_PER_PAGE','20');
define('BIG_IMAGE_WIDTH','300');
define('THUMB_IMAGE_WIDTH','150');

//Admin Login Info
define('ADMIN_USERNAME','admin');
define('ADMIN_PASSWORD','hezecom');

//Upload Directory
define('UPLOAD_FOLDER','public/uploads/');
define('UPLOAD_LOGO','REC/images/logo_entreprise/');
define('THUMB_FOLDER','public/uploads/thumbs/');
$base = str_replace('config','',dirname(__FILE__).DIRECTORY_SEPARATOR.'/');
define('UPLOAD_LOGO_PATH',$base.UPLOAD_LOGO);
define('UPLOAD_PATH',$base.UPLOAD_FOLDER);
define('THUMB_PATH',$base.THUMB_FOLDER);
define('NO_IMAGE','public/themes/default/images/user_avatar.png');

define('VALID_DIR',1);
define('APP_PATH',$base);
define('APP_FOLDER',APP_PATH.$_SESSION['app_folder']);
//define('APP_FOLDER',APP_PATH.'rh');
define('DEFAULT_THEME','public/themes/default');
define('H_THEME',DEFAULT_THEME);
define('H_ADMIN','index.php?pg=admin');
define('H_LOGIN','../../Authentification/logout.php');
define('H_CLIENT','index.php?pg=public');
define('H_ADMIN_MAIN','main.php?pg=admin');
define('H_CLIENT_MAIN','main.php?pg=public');

//Backup Dir 
define('H_BACKUP_DIR','public/backups/');
define('H_EDITOR_FILES',$absolutep.'public/uploads/editor');

//Multiple File Upload
define('UPLOAD_TABLE','hfiles');
define('FILE_ID','fid');
define('RELATE_ID','relateid');
define('H_FILE','gfile');
define('H_DATE','gdate');

//System Access
define('H_SYSTEM_ACCESS','system_users');
define('H_USER_SESSION','hezecom_users');

//RH
define('NUM_BON_MALADE','BnMld');
define('NUM_PRET','pret');
define('NUM_AVANCE','avance');
define('NUM_BON_PERMT','bnpermt');
define('NUM_REF_SANCTION','refsanction');
define('NUM_REF_CONGE','refconge');
//FACTURATION
define('NUMFACT','numfacturation');
define('NUMPROFORMA','numproforma');
define('NUM_REGLEMENT','numreglement');
//ACHAT
define('NUM_BON_COMMANDE','boncmd');
define('NUM_BON_LIVRAISON','bonliv');
define('NUM_BON_APPRO','BE_STK');
define('NUM_ETAT_BESOIN','etatbesoin');
//HEBERGEMENT
define('NUMFACTHEB','numHebFact');
define('NUM_REGLEMENTHEB','numHebRec');
define('NUM_REMBOURSEMENT','numRemb');
