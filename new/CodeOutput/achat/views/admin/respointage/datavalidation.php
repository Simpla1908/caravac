<?php
if (post('moisvld') && post('annevld')) {
    $mois = post('moisvld');
    $anne = post('annevld');
} else {
    $mois = date('m');
    $anne = date('Y');

}
$nbjour = cal_days_in_month(CAL_GREGORIAN, $mois, $anne); // nombre de jour dans le mois
if ($_SESSION['depart_pointage']['annee'] == $anne && $_SESSION['depart_pointage']['mois'] == $mois) {
    $d = $_SESSION['depart_pointage']['jour'];
} else {
    $d = 1;
}
for ($i = $d; $nbjour >= $i; $i++) {
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
    $datefrmtbd = $anne . '-' . $mois . '-' . $j;
    $datefrmt = $j . '/' . $mois . '/' . $anne;
    if ($datefrmtbd <= date('Y-m-d')) {
        $nbres1 = count($_SESSION['res1']['horaire_id']);
        for ($i1 = 0; $i1 < $nbres1; $i1++) {
            $horaire_id = $_SESSION['res1']['horaire_id'][$i1];
            $shift = $_SESSION['res1']['libh'][$horaire_id];
            $nbragt = $_SESSION['res1']['nbragt'][$horaire_id];
            if (isset($_SESSION['res2']['agtpnt'][$horaire_id . $datefrmtbd])) {
                $nbragtpnt = $_SESSION['res2']['agtpnt'][$horaire_id . $datefrmtbd];
            } else {
                $nbragtpnt = 0;
            }
            if (isset($_SESSION['result3']['agtvld'][$horaire_id . $datefrmtbd])) {
                $nbragtvld = $_SESSION['result3']['agtvld'][$horaire_id . $datefrmtbd];
            } else {
                $nbragtvld = 0;
            }
            //recuperation jour par rapport a la date
            $libelle_jrs = $this->respointage_model->JourSemaine($datefrmtbd);
            $this->respointage_model->DataShiftjour($horaire_id, $libelle_jrs);
            $jours_id = 0;
            $dte_fin=$datefrmtbd;
            $heure_fin_shift='';
            if (in_array($libelle_jrs, $_SESSION['data']['libelle_jrs'])) {
                //var_dump($_SESSION['data']);
                $jours_id = $_SESSION['data']['jours_id'][0];
                $dbt = $_SESSION['data']['dbt'][0];
                $fin = $_SESSION['data']['fin'][0];
                $finsec=$_SESSION['data']['finsec'][0];
                $mrgfinsec=$_SESSION['data']['mrgfinsec'][0];
               $heure_fin_shift=$this->respointage_model->seconds_to_time($finsec+$mrgfinsec);
            }

            if ($jours_id > 0) {
                if ($nbragtvld < $nbragt) {
                 if($dbt>$fin&&$dte_fin==date("Y-m-d")) {
                        $dte_fin=date("Y-m-d", strtotime("+1 day", strtotime($dte_fin)));
                    }

                    ?>

                    <tr>
                       <td><?php echo $shift; ?></td>
                        <td><?php echo $datefrmt; ?></td>
                        <td><?php echo $nbragt; ?></td>
                        <td><?php echo $nbragtpnt; ?></td>

                        <td class="table-actions">
                            <div class="btn-group">
                                <a horaire_id="<?php echo $horaire_id; ?>" dte_in="<?php echo $datefrmtbd; ?>" dte_fin="<?php echo $dte_fin; ?>"  hrs_dbt="<?php echo $dbt; ?>" hrs_fin="<?php echo $fin; ?>"
                                   href="#"
                                   class="btn btn-primary btn-xs btnvalidpresen"><span>Valider</span></a>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
            }
        }
    }
}
?>
