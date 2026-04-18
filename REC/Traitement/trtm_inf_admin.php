<?php
session_start();
include('../../bdd/connexion.php');
$mi = $_POST['monnaie_prix'];
$ma = $_POST['monnaie_fac'];
$tva = $_POST['tva'];
$rmz = $_POST['rmz'];
$taux = $_POST['taux'];
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];
$id_c =  $_SESSION['company_id'] ;
$user_id = $_SESSION['id_user'];
$id_site = $_POST['id_site'] ;

//maj  dans reglage
$requete = $bdd->prepare("UPDATE t_reglage SET remise=:remise,temps_regl=:temps_regl,time_checkin=:time_checkin,m_insert=:m_insert,m_affiche=:m_affiche,tauxdollar=:tauxdollar,tva=:tva,user_id=:user_id WHERE company_id=:company_id AND id_hotel=:id_hotel");
$requete->BindParam(':remise', $rmz);
$requete->BindParam(':temps_regl',$checkout);
$requete->BindParam(':time_checkin',$checkin);
$requete->BindParam(':m_insert', $mi);
$requete->BindParam(':m_affiche', $ma);
$requete->BindParam(':tauxdollar', $taux);
$requete->BindParam(':tva', $tva);
$requete->BindParam(':user_id', $user_id);
$requete->BindParam(':id_hotel', $id_site);
$requete->BindParam(':company_id', $id_c);
$requete->execute();
?>
<tr>
    <td>Monnaie Prix</td>
    <td>
        <span class="col-md-7 col-xs-12 cacher1">: <?php echo $mi; ?></span>
        <select name="monnaie_prix" id="monnaie_prix" class="form-control voir1">
            <?php if ($mi=="USD"){?>
                <option selected value="USD">USD</option>
                <option value="CDF">CDF</option>
            <?php }else if ($mi=="CDF"){?>
                <option value="USD">USD</option>
                <option selected value="CDF">CDF</option>
            <?php }?>
        </select>
    </td>
</tr>
<tr>
    <td>Monnaie Facture</td>
    <td>
        <span class="col-md-7 col-xs-12 cacher1">: <?php echo $ma; ?></span>
        <select name="monnaie_fac" id="monnaie_fac" class="form-control voir1">
            <?php if ($ma=="USD"){?>
                <option selected value="USD">USD</option>
                <option value="CDF">CDF</option>
            <?php }else if ($ma=="CDF"){?>
                <option value="USD">USD</option>
                <option selected value="CDF">CDF</option>
            <?php }?>
        </select>
    </td>
</tr>
<tr>
    <td>Taux d'échange de USD en monnaie locale</td>
    <td>
        <span class="col-md-7 col-xs-12 cacher1">:  <?php echo $taux; ?></span>
        <input id="taux" class="form-control col-md-7 col-xs-12 voir1" value="<?php echo $taux; ?>" name="taux" type="text">
    </td>
</tr>
<tr>
    <td>TVA par défaut</td>
    <td>
        <span class="col-md-7 col-xs-12 cacher1">: <?php echo $tva; ?>%</span>
        <div class="input-group demo2 voir1">
            <input type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $tva; ?>" id="tva" name="tva" />
            <span class="input-group-addon">%</span>
        </div>
    </td>
</tr>
<tr>
    <td>Rémise</td>
    <td>
        <span class="col-md-7 col-xs-12 cacher1">: <?php echo $rmz; ?>%</span>
        <div class="input-group demo2 voir1">
            <input type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $rmz; ?>" id="rmz" name="rmz" />
            <span class="input-group-addon">%</span>
        </div>
    </td>
</tr>
<tr>
    <td>Time Check in <small><i>(réservé à un hôtel)</i></small></td>
    <td>
        <span class="col-md-7 col-xs-12 cacher1">: <?php echo $checkin; ?></span>
        <input type="text" id="timepicker1" placeholder="Check in" value="<?php echo $checkin; ?>" class="form-control voir1" id="checkin" name="checkin">
    </td>
</tr>
<tr>
    <td>Time Check out <small><i>(réservé à un hôtel)</i></small></td>
    <td>
        <span class="col-md-7 col-xs-12 cacher1">: <?php echo $checkout; ?></span>
        <input type="text" id="timepicker2" placeholder="Check out" value="<?php echo $checkout; ?>" class="form-control voir1" id="checkout" name="checkout">
    </td>
</tr>