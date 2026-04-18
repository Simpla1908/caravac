<?php
if (!isset($_SESSION)) {
    session_start();
}
include('../bdd/connexion.php');
include('../../FUNCTION/hebergement.php');
include('../../FUNCTION/restaurant.php');
$plat_id = $_GET['idprod'];
$id_hotel = $_SESSION['id_hotel'];
$sousresto_id = $_SESSION['id_sousresto'];
$details_plats2 = SelectDetailsPlats($bdd);
$detailsprod=CheckDetailsProduit($plat_id, $bdd);
$accompagnements=$detailsprod->accomp;
$softplt=$detailsprod->softplt;
$softbtl=$detailsprod->softbtl;
$legume=$detailsprod->legume;
$cuisson=$detailsprod->cuisso;
$sauce=$detailsprod->soce;
$sel=$detailsprod->cond;
$popup=$detailsprod->pop;
$vin=$detailsprod->vin;
$biere=$detailsprod->biere;
$accomp_active='';
$softpltdiv='';
$legumediv='';
$cuisson_div='';
$sauce_div='';
$sel_div='';
//Visibilite
if($accompagnements==1){
  $accomp_active='active';  
}elseif($accompagnements==0 && ($softplt==1 || $softbtl==1 || $biere==1 || $vin==1)){
    $softpltdiv='active';
}elseif($accompagnements==0 && $softplt==0 &&  $legume==1){
    $legumediv='active';
}elseif($accompagnements==0 && $softplt==0 && $legume==0  && $cuisson==1){
  $cuisson_div='active';  
}elseif($accompagnements==0 && $softplt==0 && $legume==0  && $cuisson==1 && $sauce==1){
  $sauce_div='active';  
}
elseif($accompagnements==0 && $softplt==0 && $legume==0  && $cuisson==0 && $sauce==0 && $sel==1){
  $sel_div='active';  
}

?>
<div class="table-responsive">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <?php if ($accompagnements==1) { ?>
            <li class="<?php echo $accomp_active; ?>"><a href="#tab_11" data-toggle="tab">ACCOMPAGNEMENT</a></li>
            <?php } ?>
            <?php if ($softplt==1 || $softbtl==1 || $biere==1 || $vin==1) { ?>
                <li class="<?php echo $softpltdiv; ?>"><a href="#tab_55" data-toggle="tab"> BOISSONS</a></li>
            <?php } ?>

           <?php if ($legume==1) { ?>
                <li  class="<?php echo $legumediv; ?>"><a href="#tab_56" data-toggle="tab">LEGUMES</a></li>
            <?php } ?>
            <?php if ($cuisson==1) { ?>    
                <li  class="<?php echo $cuisson_div; ?>"><a href="#tab_22" data-toggle="tab">CUISSON</a></li>
            <?php } ?>
            <?php if ($sauce==1){ ?> 
                <li  class="<?php echo $sauce_div; ?>"><a href="#tab_33" data-toggle="tab">SAUCE</a></li>
            <?php } ?>
             <?php if ($sel==1){ ?> 
                <li  class="<?php echo $sel_div; ?>"><a href="#tab_44" data-toggle="tab">CONDITIONNEMENT</a></li>
            <?php } ?>
                
        </ul>
        <div class="tab-content">
            <?php //if ($accompagnements==1) { ?>
            <div class="tab-pane <?php echo $accomp_active; ?>" id="tab_11">
            <form id='accomp_frm' class="accomp_frm">  
                <table id="table_ingred" class="table table-striped table-condensed table-bordered table-hover">
                        <tbody>
                            <?php
                            $j = 1;
                            $result = listaccompagnements2( $bdd);
                            foreach ($result as $r) {
                                $idprod = $r->idprod;
                            ?>
                                <!-- <tr  class="platdet"  idp="<?php echo 'xx'.$idprod?>">
                                    <td align="center" style="font-familly:Arial Black;font-size:25px">
                                    <?php echo strtoupper($r->designation); ?>
                                    </td>
                                    <td align="center" style="font-size:25px">
                                        <input name="<?php echo 'accomp'.$idprod ?>"  type='hidden' value="<?php echo $r->designation ?>" />
                                    </td>
                                </tr> -->

                                <tr  class="platdet"  idp="<?php echo 'xx'.$idprod?>">
                                    <td align="center" style="font-size:25px">
                                        <input name="chx_accomp[]" class='<?php echo 'xx'.$idprod ?>' type='checkbox' id="<?php echo $r->idprod ?>" value="<?php echo $r->idprod ?>" />
                                        <input name="<?php echo 'accomp'.$idprod ?>"  type='hidden' value="<?php echo $r->designation ?>" />
                                    </td>
                                    <td align="center" style="font-familly:Arial Black;font-size:25px"><?php echo strtoupper($r->designation); ?></td>
                                    <td align="right" style="font-familly:Arial Black;">
                                    <input id="<?php echo 'inp'.'xx'.$idprod?>"
                                     idp="<?php echo 'xx'.$idprod?>" type="number" class="input-group-sm accompqte" 
                                     name="<?php echo 'accomp'.$idprod.'qte' ?>"  value="1" />
                                    </td>
                                </tr>
                            <?php
                                $j++;
                            }
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
            <!-- /.tab-pane -->
             <?php //} ?>
            <div class="tab-pane <?php echo $cuisson_div; ?>" id="tab_22">
                <table id="table_cuisson" class="table table-striped table-condensed table-bordered table-hover">
                    <tbody>
                        <?php
                        $j = 1;
                        foreach ($details_plats2 as $r) {
                            if ($r->etat == 0) {

                        ?>
                                <tr class="platdet"  idp="<?php echo 'xx'.$r->id ?>">
                                    <td align="center" style="font-familly:Arial Black;font-size:25px"><?php echo strtoupper($r->nom); ?></td>
                                    <td align="center" style="font-size:25px">
                                        <input name="chx_cuisson" nom='<?php echo $r->nom; ?>' class='chx_cuisson <?php echo 'xx'.$r->id ?>' type='radio' id="<?php echo $r->id ?>" value="<?php echo $r->id ?>" />
                                    </td>
                                </tr>
                        <?php
                                $j++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane <?php echo $sauce_div; ?>" id="tab_33">
                <table id="table_sauce" class="table table-striped table-condensed table-bordered table-hover">
                    <tbody>
                        <?php
                        $j = 1;
                        foreach ($details_plats2 as $r) {
                            if ($r->etat == 1) {
                        ?>
                                <tr class="platdet"  idp="<?php echo 'xx'. $r->id ?>">
                                    <td align="center" style="font-familly:Arial Black;font-size:25px"><?php echo strtoupper($r->nom); ?></td>
                                    <td align="center" style="font-size:25px">
                                        <input name="chx_sauce" nom='<?php echo $r->nom; ?>' class='chx_sauce <?php echo 'xx'.$r->id ?>' type='radio' id="<?php echo $r->id ?>" value="<?php echo $r->id ?>" />
                                    </td>
                                </tr>
                        <?php
                            $j++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane <?php echo $sel_div; ?> " id="tab_44">
                <table id="table_cond" class="table table-striped table-condensed table-bordered table-hover">
                    <tbody>
                        <?php
                        $j = 1;
                        foreach ($details_plats2 as $r) {
                            if ($r->etat==4) {
                        ?>
                        <?php if( $j==1){ ?>
                            <tr class="platdet"  idp="<?php echo 'xx'. $r->id ?>">
                                <td align="center" style="font-familly:Arial Black;font-size:25px"><?php echo strtoupper($r->nom); ?></td>
                                <td align="center" style="font-size:25px">
                                    <input name="chx_cond" nom='<?php echo $r->nom; ?>' class='chx_cond <?php echo 'xx'.$r->id ?>' type='radio' id="<?php echo $r->id ?>" value="<?php echo $r->id ?>" />
                                </td>
                            </tr>
                        <?php } else { ?>
                            <tr class="platdet"  idp="<?php echo 'xx'. $r->id ?>">
                                <td align="center" style="font-familly:Arial Black;font-size:25px"><?php echo strtoupper($r->nom); ?></td>
                                <td align="center" style="font-size:25px">
                                    <input name="chx_cond" nom='<?php echo $r->nom; ?>' class='chx_cond <?php echo 'xx'.$r->id ?>' type='radio' id="<?php echo $r->id ?>" value="<?php echo $r->id ?>"/>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php
                            $j++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane <?php echo $softpltdiv; ?>" id="tab_55">
            <form class='accomp_frm'>  
                <table id="table_ingred" class="table table-striped table-condensed table-bordered table-hover">
                        <tbody>
                            <?php
                            if($softplt==1){
                                $result = SelectSOFT($bdd);
                                foreach ($result as $r) {
                                    $idprod = $r->idprod; ?>
                                <tr  class="platdet"  idp="<?php echo 'xx'.$idprod?>">
                                    <td align="right" style="font-size:25px">
                                        <input name="chx_soft[]" class='<?php echo 'xx'.$idprod ?>' type='checkbox' id="<?php echo $r->idprod ?>" value="<?php echo $r->idprod ?>" />
                                        <input name="<?php echo 'soft'.$idprod ?>"  type='hidden' value="<?php echo $r->designation ?>" />
                                    </td>
                                    <td align="center" style="font-familly:Arial Black;font-size:25px"><?php echo strtoupper($r->designation); ?></td>
                                    <td align="right" style="font-familly:Arial Black;"><input id="<?php echo 'inp'.'xx'.$idprod?>" idp="<?php echo 'xx'.$idprod?>" type="number" class="input-group-sm qteboisson" name="<?php echo 'softqte'.$idprod ?>"  value="1" /></td>
                                </tr>
                            <?php
                                }
                            }
                            ?>
                             <?php
                             //Soft bouteille
                            if($biere==1){
                                $result = SelectSOFTBTL($bdd);
                                foreach ($result as $r) {
                                    $idprod = $r->idprod; ?>
                                <tr  class="platdet"  idp="<?php echo 'xx'.$idprod?>">
                                    <td align="right" style="font-size:25px">
                                        <input name="chx_soft[]" class='<?php echo 'xx'.$idprod ?>' type='checkbox' id="<?php echo $r->idprod ?>" value="<?php echo $r->idprod ?>" />
                                        <input name="<?php echo 'soft'.$idprod ?>"  type='hidden' value="<?php echo $r->designation ?>" />
                                    </td>
                                    <td align="center" style="font-familly:Arial Black;font-size:25px"><?php echo strtoupper($r->designation); ?></td>
                                    <td align="right" style="font-familly:Arial Black;"><input id="<?php echo 'inp'.'xx'.$idprod?>" idp="<?php echo 'xx'.$idprod?>" type="number" class="input-group-sm qteboisson" name="<?php echo 'softqte'.$idprod ?>"  value="1" /></td>
                                </tr>
                            <?php
                                }
                            }
                            ?>
                            <?php
                             //Vin maison
                            if($vin==1){
                                $result = SelectVinMaison($bdd);
                                foreach ($result as $r) {
                                    $idprod = $r->idprod; ?>
                                <tr  class="platdet"  idp="<?php echo 'xx'.$idprod?>">
                                    <td align="right" style="font-size:25px">
                                        <input name="chx_soft[]" class='<?php echo 'xx'.$idprod ?>' type='checkbox' id="<?php echo $r->idprod ?>" value="<?php echo $r->idprod ?>" />
                                        <input name="<?php echo 'soft'.$idprod ?>"  type='hidden' value="<?php echo $r->designation ?>" />
                                    </td>
                                    <td align="center" style="font-familly:Arial Black;font-size:25px"><?php echo strtoupper($r->designation); ?></td>
                                    <td align="right" style="font-familly:Arial Black;"><input id="<?php echo 'inp'.'xx'.$idprod?>" idp="<?php echo 'xx'.$idprod?>" type="number" class="input-group-sm qteboisson" name="<?php echo 'softqte'.$idprod ?>"  value="1" /></td>
                                </tr>
                            <?php
                                }
                            }
                            ?>
                            <?php
                            //Biere
                            if($softbtl==1){
                                $result = SelectBIERE($bdd);
                                foreach ($result as $r) {
                                    $idprod = $r->idprod; ?>
                                <tr  class="platdet"  idp="<?php echo 'xx'.$idprod?>">
                                    <td align="right" style="font-size:25px">
                                        <input name="chx_soft[]" class='<?php echo 'xx'.$idprod ?>' type='checkbox' id="<?php echo $r->idprod ?>" value="<?php echo $r->idprod ?>" />
                                        <input name="<?php echo 'soft'.$idprod ?>"  type='hidden' value="<?php echo $r->designation ?>" />
                                    </td>
                                    <td align="center" style="font-familly:Arial Black;font-size:25px"><?php echo strtoupper($r->designation); ?></td>
                                    <td align="right" style="font-familly:Arial Black;"><input id="<?php echo 'inp'.'xx'.$idprod?>" idp="<?php echo 'xx'.$idprod?>" type="number" class="input-group-sm qteboisson" name="<?php echo 'softqte'.$idprod ?>"  value="1" /></td>
                                </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="tab-pane <?php echo $legumediv; ?>" id="tab_56">
            <form class='accomp_frm'>  
                <table id="table_legumes" class="table table-striped table-condensed table-bordered table-hover">
                        <tbody>
                            <?php
                            $j = 1;
                            $result = SelectLegumes($bdd);
                            foreach ($result as $r) {
                                $idprod = $r->idprod;
                             
                            ?>
                                <tr  class="platdet"  idp="<?php echo 'xx'.$idprod?>">
                                    <td align="center" style="font-familly:Arial Black;font-size:25px"><?php echo strtoupper($r->designation); ?></td>
                                    <td align="center" style="font-size:25px">
                                        <input name="chx_legume[]" class='<?php echo 'xx'.$idprod ?>' type='checkbox' id="<?php echo $r->idprod ?>" value="<?php echo $r->idprod ?>" />
                                        <input name="<?php echo 'leg'.$idprod ?>"  type='hidden' value="<?php echo $r->designation ?>" />
                                    </td>
                                </tr>
                            <?php
                                $j++;
                            }
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <!-- /.tab-content -->
    </div>
</div>
