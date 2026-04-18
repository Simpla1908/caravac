  <div class="col-lg-12 table-responsive">
    <?php
    $So = SoldeInitialJournalCaisse($devise, $d1, $site_id, $bdd);
    $Sf = $So;
    ?>
    <p class="pull-right"><b><?php echo 'SOLDE INITIAL : ' . FormatChiffreCompta($So); ?></b></p>
    <table class="table table-md table-bordered table-condensed">
      <thead>
        <tr>
          <th>Date</th>
          <th>No Doc</th>
          <th>Motif</th>
          <th>Bén/Prov</th>
          <th>Encaissement</th>
          <th>Decaissement</th>

        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        //Mise en session pour impression
        $_SESSION['TypeJournalExcel'] = "JOURNAL DE CAISSE";
        $_SESSION['datedebut'] = dateAffiche($d1);
        $_SESSION['datefin'] = dateAffiche($d2);
        $_SESSION['devise'] = $devise;
        $_SESSION['journal'] = array();
        $_SESSION['journal']['n'] = array();
        $_SESSION['journal']['reference'] = array();
        $_SESSION['journal']['date'] = array();
        $_SESSION['journal']['description'] = array();
        $_SESSION['journal']['debit'] = array();
        $_SESSION['journal']['credit'] = array();
        $_SESSION['journal']['beneficiaire'] = array();
        $TotalE = 0;
        $TotalD = 0;
        //fin mise en session

        foreach ($result as $rows) {
          $datebon = $rows->date_bon;
          $numBon = $rows->numBon;
          $type = $rows->type;
          $description = $rows->libelle;
          if ($devise == 'CDF') {


            if ($type == 'entree') {
              $TotalE = $TotalE + $rows->montantFC;
              $debit = $rows->montantFC;
              $credit = 0;
              $compte_id = $rows->motif_id;
              $format = $rows->format;
              $data = INFOSFromAccountNumber($compte_id, $format, $bdd);
              $benprov = $compte_id . ' ' . $data['lib'];
            } else {
              $TotalD = $TotalD + $rows->montantFC;
              $debit = 0;
              $credit = $rows->montantFC;
              $benprov = $rows->beneficiaire;
            }
          } else {

            if ($type == 'entree') {
              $TotalE = $TotalE + $rows->montantUSD;
              $debit = $rows->montantUSD;
              $credit = 0;
              $compte_id = $rows->motif_id;
              $format = $rows->format;
              $data = INFOSFromAccountNumber($compte_id, $format, $bdd);
              $benprov = $compte_id . ' ' . $data['lib'];
            } else {
              $TotalD = $TotalD + $rows->montantUSD;
              $debit = 0;
              $credit = $rows->montantUSD;
              $benprov = $rows->beneficiaire;
            }
          }
          if ($debit > 0 || $credit > 0) {
        ?>
            <tr>
              <td><?php echo dateAffiche($datebon) ?></td>
              <td><?php echo $numBon; ?></td>
              <td><?php echo ucfirst($description); ?></td>
              <td><?php echo ucfirst($benprov); ?></td>
              <td>
                <?php
                if ($debit > 0) {
                  $Sf = $Sf + $debit;
                  $debit = FormatChiffreCompta($debit);
                  echo $debit;
                }
                ?>
              </td>
              <td>
                <?php
                if ($credit > 0) {
                  $Sf = $Sf - $credit;
                  $credit = FormatChiffreCompta($credit);
                  echo $credit;
                }
                ?>
              </td>

            </tr>
        <?php
            array_push($_SESSION['journal']['n'], $i);
            array_push($_SESSION['journal']['reference'], $numBon);
            array_push($_SESSION['journal']['date'], dateAffiche($datebon));
            array_push($_SESSION['journal']['description'], ucfirst($description));
            array_push($_SESSION['journal']['debit'], $debit);
            array_push($_SESSION['journal']['credit'], $credit);
            array_push($_SESSION['journal']['beneficiaire'], ucfirst($benprov));
          }
          $i++;
        }
        $_SESSION['So'] = FormatChiffreCompta($So);
        $_SESSION['Sf'] = FormatChiffreCompta($Sf);
        ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="4">TOTAL</th>
          <th><?php echo FormatChiffreCompta($TotalE); ?></th>
          <th><?php echo FormatChiffreCompta($TotalD); ?></th>
        </tr>
      </tfoot>
    </table>
    <p class="pull-right"><b><?php echo 'SOLDE FINAL : ' . FormatChiffreCompta($Sf); ?></b></p>
  </div>
  <?php
  $_SESSION['TotalE'] = FormatChiffreCompta($TotalE);
  $_SESSION['TotalD'] = FormatChiffreCompta($TotalD);
  ?>