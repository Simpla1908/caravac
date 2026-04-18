<br>
<div class="table-responsive">
    <table id="table" class="table table-bordered table-condensed tblsousfam">
        <thead>
            <tr>
                <th>No</th>
                <th>Sous_famille</th>
                <th>Famille</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($sous_familles as $f): ?>
                <tr class="odd gradeX">
                    <td><?php echo $i ?></td>
                    <td v="<?php echo $f->id_s_fam ?>" class="td_modif"><?php echo $f->des ?></td>
                    <td><?php echo $f->designation ?></td>
                    <td>
                        <a href="main.php?p=plat&d=upsfam&ss=<?php echo $_SESSION['id_sousresto'] ?>&id=<?php echo $f->id_s_fam ?>" ><span class="label label-primary"><i class="fa fa-edit fa-fw"></i></span></a>
                        <a href="#" id="<?php echo $f->id_s_fam ?>" p="plat" d="delsfam" 
                           maj="majsfam" 
                           view="#view_sousfamille" 
                           tbl=".tblsousfam" 
                           ss="<?php echo $_SESSION['id_sousresto'] ?>" 
                           class="del_art" data-toggle="modal" data-target="#myModalSupp">
                            <span class="label label-danger "><i class="fa fa-trash-o fa-fw"></i></span>
                        </a>
                        <!--<a href="./details_config_plat.php?detail=sousfamille&id=<?php // echo $f->id_s_fam ?>"><span class="label label-success"><i class="fa fa-eye"></i> Voir</span></a>-->
                    </td>
                </tr>
    <?php 
       $i++;
        endforeach;
        ?>
        </tbody>
    </table>
</div>

