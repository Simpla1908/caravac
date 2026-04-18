<?php
session_start();
include_once '../../bdd/connexion.php';
include_once '../Amelioration/reglage/recuperer_valeurs_reglages.php';
require 'connection.php';
require 'panier.php';
$panier = new Panier();
if (isset($_GET['idchambre'])) {
    $idchambre = $_GET['idchambre'];
    $panier->delall();
    $panier->add($idchambre);
}
?>
<div class="col-lg-6 pull-left">Total chambre&nbsp;:&nbsp;<?php echo count($_SESSION['panier']) ?></div>

<div class="col-lg-4 text-right">
    Total à payer pour <?php echo $_SESSION['nbre_jr']; ?> jour(s):
    <?php
    if (empty($_SESSION['panier'])) {
        $som = 0;
    } else {
        $som = 0;
        $ids = array_keys($_SESSION['panier']);

        $req = $bd->prepare('SELECT id_ch, num_ch, tarif_ch,monnaie FROM t_chambre WHERE id_ch in (' . implode(',', $ids) . ')');
        $req->execute();
        $chambre = $req->fetchAll(PDO::FETCH_OBJ);

        foreach ($chambre as $ch):
            // Affichage selon monnaie d'affichage définie                                   
            if ($ch->monnaie == $m_affiche) {
                $tarif_ch = $ch->tarif_ch;
            } else {
                if ($ch->monnaie = 'USD' && $m_affiche == 'CDF') {
                    $tarif_ch = round($ch->tarif_ch * $tauxdollar, 2);
                } else {
                    $tarif_ch = round($ch->tarif_ch * 1 / $tauxdollar, 2);
                }
            }
            $som+=$tarif_ch;
        endforeach;
    }


    $_SESSION['montant_nuite'] = $som;
    $_SESSION['total'] = $som * $_SESSION['nbre_jr'];
    echo $_SESSION['total'] . ' ' . $m_affiche;
    ?> 
</div>
<div class="col-lg-2 text-right">
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