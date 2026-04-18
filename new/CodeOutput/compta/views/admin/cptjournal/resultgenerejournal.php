  <div class="col-lg-12 table-responsive">
      <table class="table table-md table-bordered table-condensed">
          <thead>
              <tr>
                  <th>Type journal</th>
                  <th>Réference</th>
                  <th>Date</th>
                  <th>Compte</th>
                  <th>Description</th>
                  <th>Débit</th>
                  <th>Crédit</th>
                  <th>Intitulé Compte</th>

              </tr>
          </thead>
          <tbody>
              <?php
                $i = 1;
                //Mise en session pour impression
                //  $_SESSION['typejournal']=$datedebut;
                // $_SESSION['exercice']=$datefin;
                $_SESSION['devise'] = $devise;
                $_SESSION['journal'] = array();
                $_SESSION['journal']['n'] = array();
                $_SESSION['journal']['typejournal'] = array();
                $_SESSION['journal']['reference'] = array();
                $_SESSION['journal']['date'] = array();
                $_SESSION['journal']['compte'] = array();
                $_SESSION['journal']['description'] = array();
                $_SESSION['journal']['debit'] = array();
                $_SESSION['journal']['credit'] = array();
                $_SESSION['journal']['intitule'] = array();

                //fin mise en session
                foreach ($result as $rows) {
                ?>
                  <tr>
                      <td><?php echo ucfirst($rows->typejournal); ?></td>
                      <td><?php echo $rows->reference; ?></td>
                      <td><?php echo dateAffiche($rows->dte) ?></td>
                      <td><?php echo $rows->numero; ?></td>
                      <td><?php echo ucfirst($rows->description); ?></td>
                      <td>
                          <?php
                            $debit = '';
                            if ($rows->debit > 0) {
                                $debit = afficheMontant($devise, montant_equivalent_bdd($rows->devise, $devise, $rows->taux, $rows->debit));
                            }
                            echo $debit;
                            ?>
                      </td>
                      <td>
                          <?php
                            $credit = '';
                            if ($rows->credit > 0) {
                                $credit = afficheMontant($devise, montant_equivalent_bdd($rows->devise, $devise, $rows->taux, $rows->credit));
                            }
                            echo $credit;
                            ?>
                      </td>
                      <td><?php echo ucfirst($rows->libcompte); ?></td>

                  </tr>
              <?php
                    $i++;
                    array_push($_SESSION['journal']['n'], $i);
                    array_push($_SESSION['journal']['typejournal'], ucfirst($rows->typejournal));
                    array_push($_SESSION['journal']['reference'], $rows->reference);
                    array_push($_SESSION['journal']['date'], dateAffiche($rows->dte));
                    array_push($_SESSION['journal']['compte'], $rows->numero);
                    array_push($_SESSION['journal']['description'], ucfirst($rows->description));
                    array_push($_SESSION['journal']['debit'], $debit);
                    array_push($_SESSION['journal']['credit'], $credit);
                    array_push($_SESSION['journal']['intitule'], ucfirst($rows->libcompte));
                }
                ?>
          </tbody>
      </table>
  </div>