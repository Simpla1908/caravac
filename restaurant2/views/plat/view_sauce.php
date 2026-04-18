 <br>
<div class="table-responsive">
    <table id="table" class="table table-bordered table-condensed tblsauce">
        <thead>
            <tr>
                <th>No</th>
                <th>Nom</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($details_plats as $dp):
                if($dp->etat==1){
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $dp->nom ?></td>
                    <td>
                        <a href="main.php?p=plat&d=upfam&ss=<?php echo $_SESSION['id_sousresto'] ?>&id=<?php echo $dp->id ?>" ><span class="label label-primary"><i class="fa fa-edit fa-fw"></i></span></a>
                        <a href="#" id="<?php echo $dp->id ?>" p="plat" d="delfam" 
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
                $i++;}
            endforeach;
            ?>
        </tbody>
    </table>
</div>

