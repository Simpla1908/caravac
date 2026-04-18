<?php
session_start();
include_once '../../bdd/connexion.php';
include('../../FUNCTION/hebergement.php');
include_once '../Amelioration/reglage/recuperer_valeurs_reglages.php';
require 'connection.php';
require 'panier.php';
$panier = new Panier();
if (isset($_GET['idchambre'])) {
    if (isset($_GET['videpanier'])) {
        $panier->vider_panier();
        $panier = new Panier();
    }
    $idchambre = $_GET['idchambre'];
    $action = $_GET['action'];
    $select['monnaie'] = $_GET['monnaie'];
    $select['prix'] = $_GET['tarif'];
    $select['id'] = $idchambre;
    $select['nom'] = $_GET['nom'];
    if ($action == 'add') {
        $panier->ajouter($select);
    } else {
        $panier->supprimer_article($select);
    }
  }
?>

<div class="col-md-4">Total chambre: <?php echo count($_SESSION['panier']['id']) ?></div>
<div class="col-md-5">
    Total à payer pour <?php echo $_SESSION['nbre_jr']; ?> jour(s):
    <?php
    if (isset($_SESSION['panier'])) {
        $nbArticles = count($_SESSION['panier']['id']);
        if ($nbArticles == 0) {
            $som = 0;
        } else {
            $som = 0;
            for ($i = 0; $i <= $nbArticles - 1; $i++) {
                $tarif = $_SESSION['panier']['prix'][$i];
                $monnaie = $_SESSION['panier']['monnaie'][$i];
                $tarif_ch = montant_equivalent_bdd($monnaie, $m_affiche, $tauxdollar, $tarif);
                $som+=$tarif_ch;
            }
        }
    }

    $_SESSION['montant_nuite'] = $som;
    $_SESSION['total'] = $som * $_SESSION['nbre_jr'];
    echo afficheMontant($m_affiche, $_SESSION['total']);
    ?>
</div>
<div class="col-md-3">
    <select name="remise" id="rem" class="form-control col-md-7 col-xs-12" required>
        <?php
        if (isset($_GET['rem'])) {
            if ($_GET['rem'] == 0) {
                ?>
                <option value="0">0%</option>
                <option value="<?php echo $remise; ?>"><?php echo $remise; ?>%</option>
                <?php
            } else {
                ?>
                <option value="<?php echo $remise; ?>"><?php echo $remise; ?>%</option>
                <option value="0">0%</option>
                <?php
            }
        } else {
            ?>
            <option value="0">Remise</option>
            <option value="0">0%</option>
            <option value="<?php echo $remise; ?>"><?php echo $remise; ?>%</option>
            <?php
        }
        ?>
    </select>
</div> 
