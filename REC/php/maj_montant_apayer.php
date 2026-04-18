<?php 
session_start();
include '../php/connection.php';
?>

<p>Total à payer pour <?php echo $_SESSION['nbre_jr'];?> jour(s):<font size="+1" color="#FF0000">
	<?php
//                $ids=array_keys($_SESSION['panier']);
//                $req = $bd -> prepare('SELECT id_ch, num_ch, tarif_ch FROM t_chambre WHERE id_ch in ('.implode(',', $ids).')');
//                $req -> execute();
//                $chambre = $req -> fetchAll(PDO::FETCH_OBJ);
                $som=0;
//                foreach($chambre as $d):
//                $som+=$d->tarif_ch;
//                endforeach;
//		$_SESSION['montant_nuite']=$som; 
//		$_SESSION['total']=$som*$_SESSION['nbre_jr'];
		echo $_SESSION['total'];
		
	?> $
    </font></p>