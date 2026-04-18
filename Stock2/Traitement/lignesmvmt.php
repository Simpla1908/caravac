<?php
$nbArticles = count($_SESSION['panier']['id_article']);
$j = 1;
for ($i = 0; $i <= $nbArticles - 1; $i++) {
    $idmotif = $_SESSION['panier']['idmotif'][$i];
    if ($idmotif == 7 || $op == 'appro' || $op == 'transfert') {
        $id = $_SESSION['panier']['id_article'][$i];
        $nom = $_SESSION['panier']['nom'][$i];
        $qte = $_SESSION['panier']['qte'][$i];
        $unite = $_SESSION['panier']['unite'][$i];
        $motif = $_SESSION['panier']['motif'][$i];
?>
        <tr class="odd gradeX">
            <td><?php echo $j ?></td>
            <td><?php echo $nom ?></td>
            <td><?php echo $qte ?></td>
            <td><?php echo $unite ?></td>
            <td>
                <a href="#" op="appro" affichage="#lignesmvmt" id="<?php echo $id ?>" title="Supprimer" class="text-danger btn_del_prod_panier">
                    <i class="fa fa-trash-o"></i>
                </a>
            </td>
        </tr>
<?php $j++;
    }
} ?>