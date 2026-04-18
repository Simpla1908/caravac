<?php
session_start();
include('../bdd/connexion.php');
$type_cl = 'table';
$requete = $bdd->prepare("SELECT * FROM  t_client AS cl WHERE cl.id_hotel=:hotel_id AND cl.type=:type_cl AND cl.statut='libre' ORDER BY cl.id_client ASC");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':type_cl', $type_cl);
$requete->execute();
$tables = $requete->fetchAll(PDO::FETCH_OBJ);

?>   
<table id="example1" class="table table-bordered table-striped table-hover matable table-condensed">
    <thead>
        <tr>
            <th>N°</th>
            <th>Code</th>
            <th>Désignation</th>
            <th>Statut</th>  
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($tables as $tbl):
            ?>
            <tr id1="<?php echo $tbl->id_client ?>" id2="<?php echo $tbl->designation ?>">
                <td><?php echo $i ?></td>
                <td><?php echo $tbl->code ?></td>
                <td><?php echo $tbl->designation ?> </td>
                <td><?php echo $tbl->statut ?></td>
                <?php
                $i++;
            endforeach;
            ?>   
        </tr>

    </tbody>

</table> 

