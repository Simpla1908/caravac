 <table class="table table-bordered table-striped table-condensed example1">
   <thead>
     <tr>
       <th>#</th>
       <th>CLIENT</th>
       <th>DEBIT</th>
       <th>CREDIT</th>
       <th>SOLDE</th>
       <th></th>
     </tr>
   </thead>
   <tbody>
     <?php
      $nbre = count($data['id']);
      $tdebit = 0;
      $tcredit = 0;
      $tsolde = 0;
      $j = 1;
      for ($i = 0; $i < $nbre; $i++) {
        $idclient = $data['id'][$i];
        $client = $data['client'][$i];
        $debit = $data['debit'][$i];
        $credit = $data['credit'][$i];
        $id_fact = $data['id_fact'][$i];
        $modepaie = $data['modepaie'][$i];
        $solde = $debit - $credit;
        $tdebit += $debit;
        $tcredit += $credit;
        $tsolde += $solde;
      ?>
       <tr>
         <td><?php echo $j; ?></td>
         <td><?php echo $client; ?></td>
         <td>
           <?php if ($debit > 0) {
              echo afficheMontant2(getsymbole_devise(), $debit);
            } ?>
         </td>
         <td>
           <?php if ($credit > 0) {
              echo afficheMontant2(getsymbole_devise(), $credit);
            } ?>
         </td>
         <td>
           <?php if ($solde > 0) {
              echo afficheMontant2(getsymbole_devise(), $solde);
            } ?>
         </td>
         <td>
           <a class="btn btn-info btn-xs" href="<?php echo H_ADMIN; ?>&view=paiement&do=extraitcomptedetail&idclient=<?php echo $idclient; ?>&cl=<?php echo $client; ?>">
             <i class="fa fa-list"></i> Détails
           </a>
           <?php if ($solde > 0) { ?>
             <a href="<?php echo H_ADMIN; ?>&view=paiement&do=add&modepaie=<?php echo $modepaie; ?>&id_fact=<?php echo $id_fact; ?>" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Payer</a>

           <?php }; ?>
         </td>
       </tr>
     <?php
        $j++;
      }
      ?>
   </tbody>
   <tfoot>
     <tr>
       <th colspan="2"><span class="pull-left">TOTAL</span></th>
       <th>
         <?php if ($tdebit > 0) {
            echo afficheMontant2(getsymbole_devise(), $tdebit);
          } ?>
       </th>
       <th>
         <?php if ($tcredit > 0) {
            echo afficheMontant2(getsymbole_devise(), $tcredit);
          } ?>
       </th>
       <th>
         <?php if ($tsolde > 0) {
            echo afficheMontant2(getsymbole_devise(), $tsolde);
          } ?>
       </th>
     </tr>

   </tfoot>
 </table>