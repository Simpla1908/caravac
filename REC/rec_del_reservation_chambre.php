<?php include('Receptionniste.php');
$id_res=$_GET['id_res']; 
$res= new Reservation('','','','','','',0,0,0,0);
$res->del_reservation_chambre_($id_res);
?>
