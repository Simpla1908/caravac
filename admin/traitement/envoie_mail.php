<?php

// Initialisation de la session
include '../../PHPMailer/class.phpmailer.php';
include '../../FUNCTION/envoi_mail.php';
$json = array();
//echo 'oooook';
if(isset($_POST['email'])&&isset($_POST['nom'])&&isset($_POST['sujet'])&&isset($_POST['message'])){
   $to=$_POST['email'];
    $to_name=$_POST['nom'];
    $subject=$_POST['sujet'];
    $body=$_POST['message'];

    $result= EmailSend($to, $to_name, $subject, $body);
    if (true !== $result)
    {
            // erreur -- traiter l'erreur
          //echo $result;
            $json['message_erreur'] = 'erreur';
    }else{
 //echo 'Message envoyé';
        $json['message_succes']='succes';
    } 
}
echo json_encode($json);
