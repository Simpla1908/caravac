<?php
session_start();
include('../bdd/connexion.php');
//recuperation tva dans table reglage_systeme
$req_tva=$bdd->prepare("SELECT tva FROM reglage_systeme");
$req_tva->execute();
$tva=$req_tva->fetchAll(PDO::FETCH_OBJ);
foreach ($tva as $tva)$tva=$tva->tva;
?>
 <table class="table">
  <thead>
    <tr>
        <th>Applications</th>
        <th>Nombre Agent</th>
        <th>Nombre utilisateur</th>
        <th>Souscription</th>
        <th>Tarif</th>
    </tr>
</thead>
<tbody>
    <?php
    $nb = count($_SESSION['souscri']['module']);
//    var_dump($_SESSION['souscri']['module']);
 /* On parcoure le tableau de session */
 $ht=0;
 $ttc=0;
 $tot_tva=0;
 $a=0;
 for ($i = 0; $i < $nb; $i++) {
 ?>
    <tr>
        <td align="left">
            <samp>    <?php echo $_SESSION['souscri']['module_nom'][$i];?></samp>
        </td>
        <?php if($_SESSION['souscri']['module'][$i]==7){ $a=1; ?>
        <td align="left">
            <samp><?php echo $_SESSION['lbl_rh'];?></samp>
        </td>
        <?php }  else { ?>
        <td align="left">
        </td>
        <?php } ?>
        <td align="left">
            <samp><?php echo $_SESSION['souscri']['users'][$i];?></samp>
        </td>
        <td align="left">
            <samp><?php echo $_SESSION['souscri']['licence'][$i];?></samp>
        </td>
        <td align="left"><samp>$<?php echo $_SESSION['souscri']['prix'][$i];?></samp></td>
    </tr>
     <?php
     $ht+=$_SESSION['souscri']['prix'][$i];
     $tot_tva+=$_SESSION['souscri']['prix'][$i]*$tva/100;
     $ttc+=($_SESSION['souscri']['prix'][$i]+($_SESSION['souscri']['prix'][$i]*$tva/100));
     }
 ?>
</tbody>
<tfoot>
    <tr>
        <th colspan="4">HT</th>
        <th colspan="1" align="center">$<?php echo $ht-$tot_tva;?></th>
    </tr>
    <tr>
        <th colspan="4">TVA</th>
        <th colspan="1" align="center">$<?php echo $tot_tva;?></th>
    </tr>
    <tr>
        <th colspan="4">TTC</th>
        <th colspan="1" align="center">$<?php echo round($ht,2);?></th>
    </tr>

</tfoot>
 </table>
