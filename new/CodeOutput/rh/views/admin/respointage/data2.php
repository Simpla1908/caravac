<?php
$i = 1;
foreach ($result as $rows){
    ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $rows->noms; ?></td>
        <td><?php echo $rows->presence;?></td>
        <td><?php echo $rows->absence;?></td>
        <td><?php echo $rows->malade; ?></td>
        <td><?php echo $rows->conge; ?></td>
    </tr>
    <?php $i++;
} ?>