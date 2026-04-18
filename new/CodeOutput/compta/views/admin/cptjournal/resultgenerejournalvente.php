  <div class="col-lg-12 table-responsive">
    <table class="table table-md table-bordered table-condensed">
      <thead>
        <tr>
          <th>Date</th>
          <th>Ref</th>
          <th>Compte</th>
          <th>Description</th>
          <th>Debit</th>
          <th>Credit</th>


        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        //Mise en session pour impression
        $_SESSION['TypeJournalExcel'] = "JOURNAL DE VENTE";
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
        $Totald = 0;
        $Totalc = 0;
        foreach ($result as $rows) {
          // $data=INFOSFromAccountNumber($rows->compte_ecriture,$rows->long_compte,$bdd);
          // $libcompte=$data['lib'];
          // $numero=$rows->compte_ecriture;
          if ($devise == $rows->devise) {
        ?>
            <tr>
              <td><?php echo dateAffiche($rows->dte) ?></td>
              <td><?php echo $rows->ref; ?></td>
              <td><?php echo ucfirst($rows->compte); ?></td>
              <td><?php echo ucfirst($rows->description); ?></td>
              <td>
                <?php
                $debit = '';
                if ($rows->debit > 0) {
                  $Totald = $Totald + $rows->debit;
                  $debit = FormatChiffreCompta($rows->debit);
                }
                echo $debit;
                ?>
              </td>
              <td>
                <?php
                $credit = '';
                if ($rows->credit > 0) {
                  $Totalc = $Totalc + $rows->credit;
                  $credit = FormatChiffreCompta($rows->credit);
                }
                echo $credit;
                ?>
              </td>
            </tr>
        <?php
            $i++;
            array_push($_SESSION['journal']['n'], $i);
            array_push($_SESSION['journal']['reference'], $rows->ref);
            array_push($_SESSION['journal']['date'], dateAffiche($rows->dte));
            array_push($_SESSION['journal']['compte'], ucfirst($rows->compte));
            array_push($_SESSION['journal']['description'], ucfirst($rows->description));
            array_push($_SESSION['journal']['debit'], $debit);
            array_push($_SESSION['journal']['credit'], $credit);
          }
        }
        $_SESSION['Totald'] = FormatChiffreCompta($Totald);
        $_SESSION['Totalc'] = FormatChiffreCompta($Totalc);
        ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="4">TOTAL</th>
          <th><?php echo FormatChiffreCompta($Totald); ?></th>
          <th><?php echo FormatChiffreCompta($Totalc); ?></th>
        </tr>
      </tfoot>
    </table>
  </div>