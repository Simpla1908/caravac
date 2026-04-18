
<table class="table table-condensed table-bordered">
    <tbody>
        <tr>
            <th style="width: 10px"></th>
            <th>RUBRIQUE <?php // echo $hrsup  ?> </th>
            <th>MONTANT</th>
        </tr>
        <?php
        $netpayer=0;
        $remuneration=0;
        $retenue=0;
        $cpt1 = count($_SESSION['rubrique']['type']);
        for ($i = 0; $i <= $cpt1 - 1; $i++) {
            $total=0;
            $type = $_SESSION['rubrique']['type'][$i];
            ?>
            <tr>
                <td colspan="3"><b><?php echo strtoupper($type); ?></b></td>
            </tr> 
            <?php if($type=='remuneration'){ ?>
            <tr>
                <td>
                    <input type="checkbox"  checked="" disabled="">
                </td>
                <td><?php echo 'Base' ?></td>
                <td>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <input id="totbase"   type="text" value="<?php echo arrondir($totbase) ?>" class="form-control nbre" disabled="">
                                <span class="input-group-addon devise"><?php echo $_SESSION['Paie_affiche'] ?></span>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <?php
            $_SESSION[$type]['total']=$_SESSION[$type]['total']+$totbase;
            $remuneration=$_SESSION[$type]['total'];
            } ?>
            <?php
            $cpt2 = $_SESSION[$type]['compteur'];
            for ($j = 0; $j <= $cpt2 - 1; $j++) {
                $id = $_SESSION[$type]['id'][$j];
                $nom = $_SESSION[$type]['nom'][$j];
                $montant = $_SESSION[$type]['montant'][$j];
                ?>
                <tr>
                    <td>
                         <?php if (!in_array($id,$rubcoches)){?>
                          <input type="checkbox" name="rubrique_ids[]" value="<?php echo $id ?>" class="recalcul <?php echo 'chb'.$id ?>">
                         <?php }else{?>
                          <input type="checkbox" name="rubrique_ids[]" value="<?php echo $id ?>" checked="" class="recalcul <?php echo 'chb'.$id ?>">
                         <?php }?>
                        <input type="hidden" name="idsrubriques[]" value="<?php echo $id ?>">
                    </td>
                    <td><?php echo $nom ?></td>
                    <td>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <input id="montprime" name="montprime[]" chb="<?php echo $id ?>" type="text" value="<?php echo arrondir($montant) ?>" class="form-control nbre valrub">
                                    <span class="input-group-addon devise"><?php echo $_SESSION['Paie_affiche'] ?></span>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>

            <?php }
            $nbre_emprunt=count($emprunts['emprunt_id']);
            ?>
            <?php
            if($type=='retenue'){
            ?>    
            <?php if($nbre_emprunt>0){ ?>
            <?php 
            for ($k = 0; $k <= $nbre_emprunt- 1; $k++) {
                $id =$emprunts['rubrique_id'][$k];
                $emprunt_id=$emprunts['emprunt_id'][$k];
                $typerub=$emprunts['type'][$k];
                $nom =$emprunts['libelle'][$k];
                $monnaie =$emprunts['monnaie'][$k];
                $montant=$temp3['emprunt']['id'][$id];
            ?>
                <tr>
                    <td>
                        <?php if (!in_array($id,$remboursement['rubrique'])){?>
                         <input type="checkbox" name="rub_ids[]" value="<?php echo $id ?>"  class="recalcul <?php echo 'chb'.$id ?>">
                         <?php }else{?>
                           <input type="checkbox" name="rub_ids[]" value="<?php echo $id ?>" checked="" class="recalcul <?php echo 'chb'.$id ?>">
                         <?php }?>
                        <input type="hidden" name="rub_ids_all[]" value="<?php echo $id ?>">
                        <input type="hidden" name="emprunt_ids[]" value="<?php echo $emprunt_id ?>">
                        <input type="hidden" name="type_rubs[]" value="<?php echo $typerub ?>">
                        <input type="hidden" name="libs_rubs[]" value="<?php echo $nom ?>">
                    </td>
                    <td><?php echo $nom ?></td>
                    <td>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <input id="montremb" chb="<?php echo $id ?>" name="montremb[]" type="text" value="<?php echo arrondir($montant) ?>" class="form-control valrub">
                                    <span class="input-group-addon devise"><?php echo $_SESSION['Paie_affiche'] ?></span>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php 
            
            if (!in_array($id, $remboursement['rubrique'])) {
                    $_SESSION[$type]['total'] = $_SESSION[$type]['total'] + 0;
            } else{
                $_SESSION[$type]['total'] = $_SESSION[$type]['total'] + $montant;
            }
            } 
            ?>
            <?php }?>
            <?php $retenue=$_SESSION[$type]['total']; }?>
            <tr>
                <td colspan="2"><b><?php echo GetNomTypeRubrique($type); ?> </b></td>
                <td>
                    <b> <?php echo afficheMontant($_SESSION['Paie_affiche'], $_SESSION[$type]['total']); ?> </b>
                </td>
            </tr>
        <?php } $netpayer=$remuneration-$retenue; ?>
          <tr>
                <td colspan="2"><b>NET A PAYER </b></td>
                <td>
                    <input  name="totsb" type="hidden" value="<?php echo $totbase;?>">
                    <input  name="netapayer" type="hidden" value="<?php echo $netpayer?>">
                    <b> <?php echo afficheMontant($_SESSION['Paie_affiche'],$netpayer); ?> </b>
                </td>
            </tr>
    </tbody>
</table>