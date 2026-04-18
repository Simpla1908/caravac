<?php
session_start();
include('../bdd/connexion.php');
include '../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include 'PHPMailer/class.phpmailer.php'
if(isset($_GET['id_user'])){
$requete = $bdd->prepare("SELECT * FROM t_utilisateur WHERE id_user=:id_user");
$requete->BindParam(':id_user',$_GET['id_user']);
$requete->execute();
$users = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($users as $user) {
    $id_user=$user->id_user;
    $login=$user->email_user;
    $adresse_mail=$user->adresse_mail;
    }
$url='http://ebutelo.com/souscription/valider_souscription?id='.$id_user.'&login='.$login;
$mail = new PHPMailer();
$mail->IsHTML(true);
$mail->CharSet = "utf-8";
$mail->SetFrom('expediteur@gmail.com', 'Expéditeur');
$mail->Subject = 'Objet de l\'email';
$mail->Body = '<p><b>E-Mail</b> au format <i>HTML</i>pour activer cliquer ici.</p>'.$url;
$mail->AddAddress($adresse_mail);
if(!$mail->send()) 
{
    echo "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
    echo "Message has been sent successfully";
}


}