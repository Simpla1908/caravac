
 <?php
/*
 * =======================================================================
 * FILE NAME:        Add.php
 * DATE CREATED:    17-11-2017
 * FOR TABLE:       respointage
 * PRODUCED BY:     HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:          Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
  die('You are not allowed to execute this file directly');
    $anne=post('annevld');
?>
<option value="0">Mois</option>
    <?php
    $_SESSION['mois'] = array();
    $_SESSION['mois'][1] = 'Janvier';
    $_SESSION['mois'][2] = 'Février';
    $_SESSION['mois'][3] = 'Mars';
    $_SESSION['mois'][4] = 'Avril';
    $_SESSION['mois'][5] = 'Mai';
    $_SESSION['mois'][6] = 'Juin';
    $_SESSION['mois'][7] = 'Juillet';
    $_SESSION['mois'][8] = 'Août';
    $_SESSION['mois'][9] = 'Septembre';
    $_SESSION['mois'][10] = 'Octobre';
    $_SESSION['mois'][11] = 'Novembre';
    $_SESSION['mois'][12] = 'Décembre';
      if ($_SESSION['depart_pointage']['annee'] ==$anne ) {
        $d=$_SESSION['depart_pointage']['mois'];
        $f=12;
        if($_SESSION['depart_pointage']['annee']==date('Y')){
        $f=date('m');
      }
      }else{
        $d=1;
        $f=12;
        if($anne==date('Y')){
        $f=date('m');
      }
      }
    for ($i = $d; $i <=$f; $i++) {
        $j = $i;
        if ($j == 1) $j = '01';
        if ($j == 2) $j = '02';
        if ($j == 3) $j = '03';
        if ($j == 4) $j = '04';
        if ($j == 5) $j = '05';
        if ($j == 6) $j = '06';
        if ($j == 7) $j = '07';
        if ($j == 8) $j = '08';
        if ($j == 9) $j = '09';
            ?>
            <option value="<?php echo $j; ?>"><?php echo $_SESSION['mois'][$i]; ?></option>
            <?php
        } 
    ?>