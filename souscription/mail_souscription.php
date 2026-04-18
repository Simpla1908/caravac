<?php
//Fusion horaire
date_default_timezone_set('Africa/Kinshasa');

$to=$email;
$to_name = $prenom . ' ' . $nom;
$subject='EBUTELO-Souscription';
$body='<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    </head>
    <body style="font-family: Helvetica, Arial, Sans-Serif;">
    <div style="height:530px; 
                width:772px;
                background: #f2f2f2;
                margin: auto;
                border-radius: 5px;
                padding: 50px; 
                padding-top: 20px;
                border: 1px solid #c5c5c5;">
        <header id="top_header" style="margin: 0 10px 10px 0;">
            <img src="../css/assets/img/logo_bks.png" height="81" width="110"/>
        </header>
        
        <section style="clear: both;
                        border-top: 1px solid #eaeaea;">
            <b>EBUTELO (Souscription)</b>
            <p>
                Cher client, <br/><br/>
                Votre souscription un demo de 30 jours vient d’être effectuer avec succès. 
                Veuillez cliquer sur le lien ci-après <a target="_blank" href="www.ebutelo.com/test/login.php?sous_id='.$souscription.'&hotel_id='.$hotel_id.'">Confirmer votre compte</a> pour acceder au logiciel avec le nom d’utilisateur et le mot de passe que vous avez créés à la souscription. <br/><br/>
                En cas de difficulté, n’hésite pas à nous contacter au +243 85 464 6679 ou info@ebutelo.com <br/><br/>
                
                <p>
                    <b>Indentifiants de Connexion:</b><br/>
                    - Login: '.$login.'<br/>
                    - Mot de passe: '.$mdp.'
                </p>
                Merci de votre confiance !<br/><br/>
                Service Commercial. 

            </p>
        </section>

        <footer style="clear: both;
                       color: #000;
                       border-top: 1px solid #eaeaea;
                       text-align: center;
                       margin-top: 20px; ">
            <p style="font-size: 11px;">
                <span class="muted"><b>B.K. SERVICES  </b><br/>
                    <b>RCCM </b>: 16-B-10.039, <b>Id. Nat.</b> : 01-9-N10348L, <b>N° Impôt</b> : A1612552M , <b>Compte Bancaire</b>:1201-5660715-00-61 TMB <br/> 
                    273 NYANGWE, C/LINGWALA, VILLE/KINSHASA - <b>Contact</b> :0854646679,contact@etsb-k.com <br/>
                    Copyright &copy; <?php echo strftime("%Y"); ?> | </span> 
                <a href="#">Facebook</a> · ·
                <a href="#">YouTube</a>
            </p>
        </footer>
    </div>
</body>
</html>';
$_SESSION['ebumail_to']=$to;
$_SESSION['ebumail_to_name']=$to_name;
$_SESSION['ebumail_subject']=$subject;
$_SESSION['ebumail_body']=$body;
$_SESSION['ebumail_company']=$companie_id;
$result=  EmailSend($to,$to_name, $subject, $body);
$date_jr=date('Y-m-d H:i:s');
$statut_msg='';
if (true != $result)
{
    // erreur -- traiter l'erreur
    $statut_msg='nonenvoye';
    insertAccusseReception($to,$to_name,$subject,$body,$statut_msg,$date_jr,$companie_id,$bdd);
}else{
    $statut_msg='envoye';
    insertAccusseReception($to,$to_name,$subject,$body,$statut_msg,$date_jr,$companie_id,$bdd);
}
?>
