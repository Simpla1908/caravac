<?php
session_start();
$json = array();
include '../bdd/connexion.php';
require '../../FUNCTION/hebergement.php';

?>

<table class="table table-condensed table-striped">
    <tr>
        <th style="width: 10px">#</th>
        <th>Utilisateur</th>
        <th>Sous resto</th>
        <th>Date</th>
        <th>Statut</th>
    </tr>
    <?php
    $i = 1;
    $result = listeAffect_sresto($_SESSION['id_hotel'], $bdd);
    foreach ($result as $r) {
        ?>
        <tr>
            <td><?php echo $i; ?>.</td>
            <td><?php echo $r->nom_user; ?></td>
            <td><?php echo $r->libelle; ?></td>
            <td><?php echo dateAffiche($r->date_affect); ?></td>
            <?php if ($r->statut == 0) { ?>
                <td><span class="badge bg-red">Désaffecter</span></td>
            <?php } else { ?>
                <td><span class="badge bg-green">Affecter</span></td>
                <td><a href="#" class="btn btn-primary btn-xs">Désaffecter</a></td>
            <?php } ?>
        </tr>
        <?php
        $i++;
    }
    ?>
</table> 
            