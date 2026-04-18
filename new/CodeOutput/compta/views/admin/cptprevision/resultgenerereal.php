  <div class="col-lg-12 table-responsive">
      <table class="table table-md table-bordered table-condensed">
          <thead>
              <tr>
                  <th>COMPTE</th>
                  <th>PREVISION</th>
                  <th>REALISATION</th>
                  <th>ECART</th>
                  <th>%</th>
              </tr>
          </thead>
          <tbody>
              <?php
                $tot_montant_prev = 0;
                $tot_montant_real = 0;
                foreach ($result as $rows) {
                    $data = INFOSFromAccountNumber($rows->compte_ecriture, $rows->long_compte, $bdd);
                    $libcompte = $rows->compte_ecriture . ' ' . $data['lib'];
                ?>
                  <tr>
                      <td><?php echo ucfirst($libcompte); ?></td>
                      <td>
                          <?php
                            $montant_prev = $rows->mont;
                            $devisedb = $rows->devise;
                            $taux = $rows->tauxop;
                            $montant_prev = montant_equivalent_bdd($devisedb, $devise, $taux, $montant_prev);
                            $tot_montant_prev = $tot_montant_prev + $montant_prev;
                            echo afficheMontant($devise, $montant_prev);
                            ?>
                      </td>
                      <td>
                          <?php
                            $comptenum = $rows->compte_ecriture;
                            $data = RealisationCompte($devise, $comptenum, $exercice_id, $site_id, $bdd);
                            $montant_real = $data['sumcredit'];
                            $tot_montant_real = $tot_montant_real + $montant_real;
                            echo afficheMontant($devise, $montant_real);
                            ?>
                      </td>
                      <td>
                          <?php
                            $ecart = $montant_prev - $montant_real;
                            echo afficheMontant($devise, $ecart);
                            ?>
                      </td>
                      <td>
                          <?php
                            $rate = ($montant_real / $montant_prev) * 100;
                            echo arrondir($rate);
                            ?>
                      </td>
                  </tr>
              <?php
                }
                $tot_ecart = $tot_montant_prev - $tot_montant_real;
                $tot_rate = ($tot_montant_real / $tot_montant_prev) * 100;
                ?>
          </tbody>
          <tfoot>
              <tr>
                  <th>TOTAL</th>
                  <th><?php echo afficheMontant($devise, $tot_montant_prev); ?></th>
                  <th><?php echo afficheMontant($devise, $tot_montant_real);
                        ?></th>
                  <th><?php echo afficheMontant($devise, $tot_ecart);
                        ?></th>
                  <th><?php echo arrondir($tot_rate);
                        ?></th>
              </tr>
          </tfoot>
      </table>
  </div>