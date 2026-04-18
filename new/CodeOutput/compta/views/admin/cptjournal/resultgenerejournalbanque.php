  <div class="col-lg-12 table-responsive">
    <?php
    $So = SoldeInitialJournalBanque($devise, $d1, $site_id, $bdd);
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
          <th>débit</th>
          <th>Crédit</th>

        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        //Mise en session pour impression
        $_SESSION['datedebut'] = dateAffiche($d1);
        $_SESSION['datefin'] = dateAffiche($d2);
        $_SESSION['devise'] = $devise;
        $_SESSION['journal'] = array();
        $_SESSION['journal']['n'] = array();
        $_SESSION['journal']['reference'] = array();
        $_SESSION['journal']['date'] = array();
        $_SESSION['journal']['compte'] = array();
        $_SESSION['journal']['description'] = array();
        $_SESSION['journal']['debit'] = array();
        $_SESSION['journal']['credit'] = array();

        //fin mise en session

        foreach ($result as $rows) {
          // $data=INFOSFromAccountNumber($rows->compte_ecriture,$rows->long_compte,$bdd);
          // $libcompte=$data['lib'];
          // $numero=$rows->compte_ecriture;
          if ($devise == $rows->devise) {
        ?>
            <tr>
              <td><?php echo dateAffiche($rows->dte); ?></td>
              <td><?php echo $rows->ref; ?></td>
              <td><?php echo ucfirst($rows->description); ?></td>
              <td>
                <?php
                $benprov = ucfirst($rows->benprov);
                if ($rows->benprov == '') {
                  $benprov = ucfirst($rows->compte);
                }
                echo $benprov;
                ?></td>

              <td>
                <?php
                if ($rows->debit > 0) {
                  $Sf = $Sf + $rows->debit;
                  echo FormatChiffreCompta($rows->debit);
                }
                ?>
              </td>
              <td>
                <?php
                if ($rows->credit > 0) {
                  $Sf = $Sf - $rows->credit;
                  echo FormatChiffreCompta($rows->credit);
                }
                ?>
              </td>

            </tr>
        <?php
            $i++;
            array_push($_SESSION['journal']['n'], $i);
            array_push($_SESSION['journal']['reference'], $rows->ref);
            array_push($_SESSION['journal']['date'], dateAffiche($rows->dte));
            array_push($_SESSION['journal']['compte'], $benprov);
            array_push($_SESSION['journal']['description'], ucfirst($rows->description));
            array_push($_SESSION['journal']['debit'], FormatChiffreCompta($rows->debit));
            array_push($_SESSION['journal']['credit'], FormatChiffreCompta($rows->credit));
          }
        }
        $_SESSION['So'] = $So;
        $_SESSION['Sf'] = $Sf;
        ?>
      </tbody>
    </table>
    <p class="pull-right"><b><?php echo 'SOLDE FINAL : ' . FormatChiffreCompta($Sf); ?></b></p>
  </div>