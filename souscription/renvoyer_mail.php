<?php

session_start();
$json = array();
include('../bdd/connexion.php');
include '../FUNCTION/hebergement.php';
require_once '../PHPMailer/class.phpmailer.php';
include '../FUNCTION/envoi_mail.php';

$result=  EmailSend($_SESSION['ebumail_to'],$_SESSION['ebumail_to_name'],$_SESSION['ebumail_subject'],$_SESSION['ebumail_body']);
$date_jr=date('Y-m-d H:i:s');
if (true != $result)
{
    // erreur -- traiter l'erreur
     $statut_msg='nonenvoye';
     insertAccusseReception($_SESSION['ebumail_to'],$_SESSION['ebumail_to_name'],$_SESSION['ebumail_subject'],$_SESSION['ebumail_body'],$statut_msg,$date_jr,$_SESSION['ebumail_company'],$bdd);
    $json['statut'] = 'nonenvoye';
}else{
    $statut_msg='envoye';
     insertAccusseReception($_SESSION['ebumail_to'],$_SESSION['ebumail_to_name'],$_SESSION['ebumail_subject'],$_SESSION['ebumail_body'],$statut_msg,$date_jr,$_SESSION['ebumail_company'],$bdd);
    $json['statut'] = 'envoye';
}
echo json_encode($json);

