<?php
session_start();
include('../bdd/connexion.php');
?>
    <table class="table">
        <thead>
            <tr>
                <th>Applications</th>
                <th>Nombre utilisateur</th>
                <th>Souscription</th>
                <th>Tarif</th>
            </tr>
        </thead>
        <tbody>
            <?php
	$nb = count($_SESSION['souscria']['modulea']);
 /* On parcoure le tableau de session  */
 $tot=0;
 for ($i = 0; $i < $nb; $i++) {
$requete = $bdd->prepare("SELECT prix_user FROM  prix WHERE module_id=:module  AND souscription=:souscription");
$requete->BindParam(':module',$_SESSION['souscria']['modulea'][$i]);
$requete->BindParam(':souscription',$_SESSION['souscria']['licencea'][$i]);
$requete->execute();
$prix= $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($prix as $prix) $prix = $prix->prix_user;
 ?>
                <tr>
                    <td align="left">
                        <samp>	<?php echo $_SESSION['souscria']['module_noma'][$i];?></samp>
                    </td>
                    <td align="left">
                        <samp><?php echo $_SESSION['souscria']['usersa'][$i];?></samp>
                    </td>
                    <td align="left">
                        <samp><?php echo $_SESSION['souscria']['licencea'][$i];?></samp>
                    </td>
                    <td align="left"><samp>$<?php echo $prix*$_SESSION['souscria']['usersa'][$i];?></samp></td>
                </tr>
                <?php
 $tot+=$prix*$_SESSION['souscria']['usersa'][$i];
 	}
 ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <th colspan="1" align="center">$
                    <?php echo $tot;?>
                </th>
            </tr>
        </tfoot>
    </table>