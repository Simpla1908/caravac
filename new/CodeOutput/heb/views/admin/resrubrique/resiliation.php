<?php 
$jours='jours';
?>
<table class="table table-condensed table-bordered">
    <tbody>
       <?php 
        $nbrtype=count($_SESSION['resiliation']['type']);
        for ($p = 0; $p <= $nbrtype - 1; $p++){
            $type=$_SESSION['resiliation']['type'][$p];
            $nbre=count($_SESSION[$type]['id']);
            if($type=='jour'){
                $jours='jours';
            }else{
                $jours=$_SESSION['Paie_affiche'];
            }
       ?>
        <tr>
            <td colspan="3"><b><?php echo $_SESSION['resiliation']['libelle'][$p]; ?></b></td>
        </tr>
         <?php for ($q = 0;$q <= $nbre - 1;$q++){ ?>
        <tr>
            <td>
                <?php if($type=='jour' || $type=='autre'){?>
                <input type="checkbox" value="<?php echo $_SESSION[$type]['id'][$q] ?>" checked="" class="recalcul <?php echo 'chb' ?> hidden">
                <?php }else{?>
                  <input type="checkbox" name="rubrique_ids[]" value="<?php echo $_SESSION[$type]['id'][$q] ?>" checked="" class="recalcul <?php echo 'chb' ?> hidden">
                <?php }?>
                  <input type="checkbox"  checked="" class="recalcul <?php echo 'chb' ?>" disabled="">
            </td>
            <td><?php echo $_SESSION[$type]['nom'][$q] ?></td>
            <td>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <?php if($type=='jour'){?>
                            <input  name="<?php echo $_SESSION[$type]['code'][$q]?>" type="text" value="<?php echo $_SESSION[$type]['montant'][$q] ?>" class="form-control nbre valrub hidden">
                            <input   type="text" value="<?php echo $_SESSION[$type]['montant'][$q] ?>" class="form-control nbre valrub" disabled="">
                           <?php }else if($type=='autre'){?>
                             <input  name="<?php echo $_SESSION[$type]['code'][$q]?>" type="text" value="<?php echo $_SESSION[$type]['montant'][$q] ?>" class="form-control nbre valrub hidden">
                              <input  type="text" value="<?php echo $_SESSION[$type]['montant'][$q] ?>" class="form-control nbre valrub"  disabled="">
                           <?php }else{?>
                             <input  name="vals[]" type="text" value="<?php echo $_SESSION[$type]['montant'][$q] ?>" class="form-control nbre valrub hidden">
                             <input   type="text" value="<?php echo $_SESSION[$type]['montant'][$q] ?>" class="form-control nbre valrub" disabled="">
                           <?php }?>
                            <span class="input-group-addon devise"><?php echo $jours?></span>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="2"><b><?php echo $_SESSION['resiliation']['lib_type'][$p]?> </b></td>
            <td>
                <b>
                    <?php 
                    if($type=='jour'){
                       echo  $_SESSION[$type]['total'].' '.$jours;
                    }else{
                       echo afficheMontant($jours,$_SESSION[$type]['total']);  
                    }
                    ?> 
                </b>
            </td>
        </tr>
       <?php } ?>
        <tr>
            <td colspan="2"><b>NET A PAYER </b></td>
            <td>
                <?php $netapayer=$_SESSION['remuneration']['total']-$_SESSION['retenue']['total']+$_SESSION['autre']['total']; ?>
                <b> <?php echo afficheMontant($jours,$netapayer); ?> </b>
                <input  name="netapayer" type="hidden" value="<?php echo $netapayer ?>">
            </td>
        </tr>
    </tbody>
</table>