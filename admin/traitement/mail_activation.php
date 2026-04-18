<?php
$to=$email;
$to_name=$name;
$subject='EBUTELO-Activation';
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
            <img src="../../css/assets/img/logo_bks.png" height="81" width="110"/>
        </header>
        
        <section style="clear: both;
                        border-top: 1px solid #eaeaea;">
            <b>EBUTELO (Souscription)</b>
            <p>
                Cher client, <br/><br/>
                Nous confirmons par la présente l’activation de votre souscription à la plateforme Ebutelo 
                et nous vous remercions.
                Nous restons à votre disposition pour assistance, 
                n’hésite pas à nous contacter au +243 85 464 6679 ou info@ebutelo.com <br/><br/>
                
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
                <span class="muted"><b>EBUTELO  </b><br/>
                    <b>RCCM </b>: 16-B-10.039, <b>Id. Nat.</b> : 01-9-N10348L, <b>N° Impôt</b> : A1612552M <br/> 
                    KINSHASA-RDCongo - <b>Contact</b> :+243854646679,info@ebutelo.com <br/>
                    Copyright &copy; <?php echo strftime("%Y"); ?> | </span> 
                <a href="#">Facebook</a> · ·
                <a href="#">YouTube</a>
            </p>
        </footer>
    </div>
</body>
</html>';

$result=  EmailSend($to, $to_name, $subject, $body);
if (true !== $result)
{
	// erreur -- traiter l'erreur
	echo $result;
}else{
    echo 'Message envoyé';
}
?>
