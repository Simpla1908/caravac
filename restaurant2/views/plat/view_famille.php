 <br>
<div class="table-responsive">
    <table id="table" class="table table-bordered table-condensed tblfam">
        <thead>
            <tr>
                <th>No</th>
                <th>Designation</th>
                <th>Vente</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($familles as $fam):
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $fam->designation ?></td>
                    <?php if ($fam->affichage == 1) { ?>
                        <td><input type="checkbox" name="affichage_famille" class="affichage_famille" id="<?php echo $fam->idfamille ?>" value="<?php echo $fam->idfamille ?>" checked="checked"></td>
                    <?php } else { ?>
                        <td><input type="checkbox" name="affichage_famille" class="affichage_famille" id="<?php echo $fam->idfamille ?>" value="<?php echo $fam->idfamille ?>"></td>
                    <?php } ?>
                    <td>
                        <a href="main.php?p=plat&d=upfam&ss=<?php echo $_SESSION['id_sousresto'] ?>&id=<?php echo $fam->idfamille ?>" ><span class="label label-primary"><i class="fa fa-edit fa-fw"></i></span></a>
                        <a href="#" id="<?php echo $fam->idfamille ?>" p="plat" d="delfam" 
                           maj="majfam" 
                           view="#view_famille" 
                           tbl="tblfam"
                           ss="<?php echo $_SESSION['id_sousresto'] ?>" 
                           class="del_art" data-toggle="modal" data-target="#myModalSupp">
                            <span class="label label-danger "><i class="fa fa-trash-o fa-fw"></i></span>
                        </a>
                    </td>
                </tr>
                <?php
                $i++;
            endforeach;
            ?>
        </tbody>
    </table>
</div>

