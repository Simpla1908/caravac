

<?php
$entreprise=$_POST['entreprise'];
$name=$_POST['name'];
$adresse=$_POST['adresse'];
$Email=$_POST['email'];
$phone=$_POST['phone'];
$date_heure=$_POST['date_heure'];
$message=$_POST['message'];


    $body .= "Entreprise: " . $entreprise . "\n"; 
    $body .= "Nom: " . $name . "\n"; 
    $body .= "Adresse: " . $adresse . "\n"; 
    $body .= "Téléphone: " . $phone . "\n"; 
    $body .= "Email: " . $Email . "\n"; 
    $body .= "Date et Heure du rendez-vous: " . $date_heure . "\n"; 
    $body .= "Description: " . $message . "\n"; 

    //replace with your email
    mail("info@ebutelo.com","rendez-vous démo",$body); 

  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script>alert("Votre message a été envoyé avec succès.");</script>
<meta HTTP-EQUIV="REFRESH" content="0; url=demo/index.php"> 

</head>