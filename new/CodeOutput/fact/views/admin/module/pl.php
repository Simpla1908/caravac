<?php // var_dump($chambres) ?>
<table class="table table-md table-bordered table-condensed">
    <thead>
        <tr>
            <th scope="col"></th>
            <?php for ($i = 0; $i < $nbre; $i++) { ?>
                <th scope="col"><?php echo $periode_reservations['libelle'][$i] ?></th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($chambres as $rows){ ?>
            <tr>
                <th scope="row"><span class="badge bg-lighten-1"><?php echo 'Ch'.$rows->num_ch ?></span></th>
                <?php
                for ($i = 0; $i < $nbre; $i++) {
                    $dtesej=$periode_reservations['dte'][$i];
                   
                    $color="badge bg-lime";
                    ?>
                    <?php if(in_array($rows->id_ch,$sejour['chambre'])){ ?>
                      <?php 
                        if(in_array($dtesej,$sejour['dte'])){ 
                            $nomclient1=ucfirst(strtolower($sejour['client'][$dtesej]));
                            $nomclient2 = substr($nomclient1,0,10);
                            $id_resch=$sejour['res_id'][$dtesej];
                            if($sejour['etat'][$dtesej]=='reserve'){
                              $color="badge bg-red";  
                            }
                         ?>
                         <td>
                          <span class="<?php echo $color ?>">
                              <a href="<?php echo H_ADMIN;?>&view=t_reservation&do=add&id_resch=<?php echo $id_resch;?>" data-toggle="tooltip" 
                                 data-html="true" title="<?php echo $nomclient1 ?>" style="color: white" class="tip">
                              <?php echo $nomclient2;?>
                             </a>
                          </span>
                        </td>
                    <?php }else{?>
                        <td bgcolor="<?php echo '' ?>">
                            <?php echo '';?>
                        </td>
                     <?php }?>
                    <?php }else{ ?>
                        <td> </td>
                    <?php }?>
              <?php } ?>
            </tr>
         <?php } ?>
    </tbody>
</table>
