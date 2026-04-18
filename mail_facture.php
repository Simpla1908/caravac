<?php
require_once './PHPMailer/class.phpmailer.php';
include './FUNCTION/envoi_mail.php';

$name="Tumba Kitoko";
$email='tumbamerveille@gmail.com';
$pawd='motdepasse';

$to=$email;
$to_name=$name;
$subject='EBUTELO-Facture';

$date=date('d/m/Y');

$body='<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Facture</title>
</head>
<body style="font-family: Helvetica, Arial, Sans-Serif;">
    <div style="height:780px; 
                width:772px;
                background: #f2f2f2;
                margin: auto;
                border-radius: 5px;
                padding: 50px; 
                border: 1px solid #c5c5c5;">
        <header id="top_header" style="margin: 0 10px 20px 0;">
            <img src="css/assets/img/logo_bks.png" height="81" width="110"/>
        </header>
        
        <section style="clear: both;
                        border-top: 1px solid #eaeaea;
                        border-bottom: 1px solid #eaeaea;
                        margin-bottom: 20px;">
            <b>FACTURE N° BKS-E0001</b>
            <p>Date d\'édition: 07/08/2017<br/>
            Date d\'écheance: 07/08/2017<br/>
            Période d\'abonnement: du 10/08/2017 au 10/09/2017
            </p>
            <p>
                <strong>CLIENT : </strong><br/> 
                <strong>Justin Neogo Cater</strong><br/>
                678, Lamen Trees Lane,Boston Bay<br/>
                United States - 2018976<br/>
                Email: <em>justindemo@domain.com</em><br/>
                Télephone: +01-90-89-56-00
            </p>
        </section>
        
        <section style="clear: both;
                        border-top: 1px solid #eaeaea;
                        padding-bottom: 15px;">
            <table width="720" border="1" style="margin: auto;
                                                 width: 100%; 
                                                color: #717375; 
                                                font-family: helvetica; 
                                                line-height: 5mm; 
                                                border-collapse: collapse; ">
                <thead>
                    <tr>
                        <th style="border: 1px solid #000;  
                                    color: white; 
                                    background: #000; 
                                    padding: 5px; 
                                    font-weight: normal; 
                                    font-size: 14px; 
                                    text-align: center; ">N°</th>
                        <th style="border: 1px solid #000;  
                                    color: white; 
                                    background: #000; 
                                    padding: 5px; 
                                    font-weight: normal; 
                                    font-size: 14px; 
                                    text-align: center; ">Désignation</th>
                        <th style="border: 1px solid #000;  
                                    color: white; 
                                    background: #000; 
                                    padding: 5px; 
                                    font-weight: normal; 
                                    font-size: 14px; 
                                    text-align: center; ">Prix</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="border: 1px solid #CFD1D2; 
                                    padding: 5px 10px; 
                                    text-align: center;">1</td>
                        <td style="border: 1px solid #CFD1D2; 
                                    padding: 5px 10px;
                                    text-align: left;">Module Hébergement</td>
                        <td style="border: 1px solid #CFD1D2; 
                                    padding: 5px 10px; 
                                    text-align: center;">75 USD</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #CFD1D2; 
                                    padding: 5px 10px; 
                                    text-align: center;">2</td>
                        <td style="border: 1px solid #CFD1D2; 
                                    padding: 5px 10px;
                                    text-align: left;">Module Restaurant</td>
                        <td style="border: 1px solid #CFD1D2; 
                                    padding: 5px 10px; 
                                    text-align: center;">75 USD</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #CFD1D2; 
                                    padding: 5px 10px; 
                                    text-align: center;">3</td>
                        <td style="border: 1px solid #CFD1D2; 
                                    padding: 5px 10px;
                                    text-align: left;">Module Stock</td>
                        <td style="border: 1px solid #CFD1D2; 
                                    padding: 5px 10px; 
                                    text-align: center;">75 USD</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #CFD1D2; 
                                    padding: 5px 10px; 
                                    text-align: center;">4</td>
                        <td style="border: 1px solid #CFD1D2; 
                                    padding: 5px 10px;
                                    text-align: left;">Module Caisse</td>
                        <td style="border: 1px solid #CFD1D2; 
                                    padding: 5px 10px; 
                                    text-align: center;">75 USD</td>
                    </tr>
                </tbody>
                 <tfoot>
                    <tr>
                        <td colspan="2" style="border: 1px solid #CFD1D2; 
                                                padding: 5px 10px; 
                                                text-align: right;"><b>Total hors taxe: </b></td> 
                        <td style="border: 1px solid #CFD1D2; 
                                    padding: 5px 10px; 
                                    text-align: center;"><b>75 USD</b></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border: 1px solid #CFD1D2; 
                                                padding: 5px 10px; 
                                                text-align: right;"><b>Total avec taxe(16%): </b></td> 
                        <td style="border: 1px solid #CFD1D2; 
                                    padding: 5px 10px; 
                                    text-align: center;"><b>75 USD</b></td>
                    </tr>
                </tfoot>
            </table>
        </section>
        <footer style="clear: both;
                       color: #000;
                       border-top: 1px solid #eaeaea;
                       text-align: center;
                       margin-top: 100px; ">
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

//echo $body;
$result=  EmailSend($to, $to_name, $subject, $body);
if (true !== $result)
{
	// erreur -- traiter l'erreur
	echo $result;
}else{
    echo 'Message envoyé';
}
?>

