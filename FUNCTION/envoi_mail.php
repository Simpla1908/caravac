<?php

function EmailSend($to, $to_name, $subject, $body) {
    
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
        return 'Mail error: '.$mail->ErrorInfo;
    } else {
        return true;
    }
}
