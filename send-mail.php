

<?php
$body="\n";
$name=$_POST['name'];
$Email=$_POST['email'];
$phone=$_POST['phone'];
$message=$_POST['message'];


    
    $body .= "Nom: " . $name . "\n"; 
    $body .= "Email: " . $Email . "\n"; 
    $body .= "Téléphone: " . $phone . "\n"; 
    $body .= "Message: " . $message . "\n"; 

    //replace with your email
    mail("info@ebutelo.com","Nouveau message",$body); 

  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script>alert("Votre message a été envoyé avec succès.");</script>
<meta HTTP-EQUIV="REFRESH" content="0; url=index.php"> 

</head>