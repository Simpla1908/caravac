
<?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		t_reservation
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<?php
$ttc =0;
$totpaye=0;
for ($i = 0; $i <= $nbArticles - 1; $i++) {
    if($_SESSION['panier']['repas'][$i]==1){
    $id_ch = $_SESSION['panier']['id_article'][$i];
    $nom_ch = $_SESSION['panier']['nom'][$i];
    $qte = $_SESSION['panier']['qte'][$i];
    $monttva = $_SESSION['panier']['monttva'][$i];
    $tarif_ch2 = $_SESSION['panier']['prix'][$i];
    $cout_ch = prixHebergement($tarif_ch2, $monttva) * $qte;
    if ($_SESSION['Paie_affiche'] == getsymbole_devise()) {
        $usd = $cout_ch;
        $cdf = 0;
    } else {
        $usd = 0;
        $cdf = $cout_ch;
    }
    $ttc+=$cout_ch;
    ?>
<tr>
    <td><?php echo AfficheNomChambre($nom_ch); ?></td>
    <td class="form-inline">
        <div class="input-group" > 
            <input name="idsch[]" type="hidden" value="<?php echo $id_ch; ?>">
            <input name="price[]" id="<?php echo $id_ch; ?>" id2="<?php echo $id_ch; ?>" class="form-control price"  type="text" value="<?php echo arrondir($tarif_ch2); ?>" style="width: 85px;">
            <span class="input-group-addon"><?php echo AfficheMonnaie($_SESSION['Paie_affiche']); ?></span>
        </div> 
    </td>
    <td>
        <?php echo $qte; ?>
    </td>
    <td id='monttot<?php echo $id_ch; ?>'>
      <?php echo afficheMontant($_SESSION['Paie_affiche'],$cout_ch); ?>
    </td>
    <td>
        <a href="#" class="delch tip" title="Supprimer" id="<?php echo $id_ch; ?>"><i class="fa fa-trash-o"></i></a>
    </td>
</tr>
<?php }}; ?>
<!--<tr>
    <td><b>Total</b></td>
    <td></td>
      <td></td>
      <td> <b><span class="tip" title="Total facturé" id="totfacture"><?php echo afficheMontant($_SESSION['Paie_affiche'],$ttc); ?> </span></b></td>
    <td></td>
</tr>-->
<input name="totfact" id="totfact"  type="hidden" value="<?php echo $ttc; ?>">
<input name="totpayef" id="totpayef"  type="hidden" value="<?php echo $ttc; ?>">
<input name="nbresej" id="nbresej"  type="hidden" value="<?php echo $qte; ?>">