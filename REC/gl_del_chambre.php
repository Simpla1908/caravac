<?php include('Gerant_local.php');
$id_ch=$_GET['id_ch'];
$ch = new chambre('', '', '','', '', '', '', '', '', '');
$ch->delchambre($id_ch);
echo "<script>document.location='gl_consultation_chambre.php'</script>";
?>
