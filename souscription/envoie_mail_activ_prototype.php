<?php
session_start();
include('../bdd/connexion.php');
include '../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include 'PHPMailer/class.phpmailer.php';
// $id_user='1';
// $login='login1';'simplicelandu1908@gmail.com';
// $adresse_mail='simplicelandu1908@gmail.com';
// $url='http://bktrysoft.esy.es/souscription/valider_souscription?id='.$id_user.'&login='.$login;
// $mail = new PHPMailer();
// $mail->IsHTML(true);
// $mail->CharSet = "utf-8";
// $mail->SetFrom('expediteur@gmail.com', 'Expéditeur');
// $mail->Subject = 'Objet de l\'email';
// $mail->Body = '<p><b>E-Mail</b> au format <i>HTML</i>pour activer cliquer ici.</p>'.$url;
// $mail->AddAddress('simplicelandu1908@gmail.com');
// if(!$mail->send()) 
// {
//     echo "Mailer Error: " . $mail->ErrorInfo;
// } 
// else 
// {
//     echo "Message has been sent successfully";
// }


//}
// $dest = "simplicelandu1908@gmail.com";
// $objet = "Test mail en HTML";
// $id_user='1';
// $login='login1';
// //Contenu HTML du mail
// $texte = "<html><head><title>Envoi de mail HTML</title></head>
// <body><h1>La bonne nouvelle du mois</h1>
// <b>Sortie de PHP 5 version finale!</b>
// <img src=\"http://static.php.net/www.php.net/images/php.gif\" alt=\"Logo PHP\" />
// <a href=\"http://www.php.net.\">Plus d'infos ici</A>
// <p>Télécharger un installeur pour une utilisation en local<br />
// <a href=\"http://bktrysoft.esy.es/souscription/activer_souscription.php?id=".$id_user."&login=".$login."\">Le site PHP@Home</A></body></html>";
// //En têtes indispensables pour un mail en HTML
// $entete="MIME-Version: 1.0";
// $entete .= "Content-Type:text/enriched;charset=iso-8859-1\n";
// $entete .= "Content-Transfer-Encoding: 8bit\n";
// $entete .= "From: mi@funhtml.com \n";
// //Envoi du mail
// if (mail($dest,$objet,$texte,$entete))
// {
// print "Le mail a été envoyé<br> <br />";
// }
// else 
// {
// print "le mail n'a pas été envoyé<br />";
// }
// Préparation du mail contenant le lien d'activation
// $cle ='1';
// $nom = 'login1';
// $destinataire ='simplicelandu1908@gmail.com';
// $sujet = "Activer votre compte" ;
// $entete = "From: maildusite" ;
  
// // Le lien d'activation est composé du nom et de la clé
// $message = '
  
// Pour valider votre participation, veuillez cliquer sur le lien ci dessous
// ou copier/coller dans votre navigateur internet.
  
// http://bktrysoft.esy.es/souscription/valider_souscription.php?page_id=88'.urlencode($nom).'&cle='.urlencode($cle).'
  
  
// ---------------
// Ceci est un mail automatique, Merci de ne pas y répondre.';
  
  
// mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail
// On va chercher la classe PHPMailer
// Création d'un nouvel objet $mail
$id ='1';
$nom = 'login1';
$mail = new PHPMailer();
// Encodage
$mail->CharSet = 'UTF-8';
// Corp de notre email
$body = "<p>Salut tout le <u>monde</u>,
voici un mail en <a href=\"http://bktrysoft.esy.es/souscription/activer_souscription.php?id=".$id."&nom=".$nom."\">HTML</a></p>";
// Expediteur, adresse de retour et destinataire :
$mail->SetFrom("contact@nicolas-verhoye.com", "bob");
$mail->AddReplyTo("nicolas.verhoye@gmail.com", "Nicolas Verhoye");
$mail->AddAddress("simplicelandu1908@gmail.com", "Destinataire");
// Sujet du mail
$mail->Subject = "Test d'envoi de mail avec PHPMailer";
// Le message
$mail->MsgHTML($body);
// Pièce jointe
//$mail->AddAttachment("images/phpmailer.gif");
// Envoi de l'email
if ( !$mail->Send() ) {
echo "Echec de l'envoi du mail, Erreur: " . $mail->ErrorInfo;
} else {
echo "Message envoyé!";
}
unset($mail);