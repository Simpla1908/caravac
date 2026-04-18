<?php
include '../../bdd/connexion.php';
include_once'../../FUNCTION/hebergement.php';
include_once'../traitement/fonctionalites.php';
$result=getListeReglement($type_souscription,$bdd);
$monnaie =getsymbole_devise();
?>
<thead>
    <tr>
        <th style="width: 1%">#</th>
        <th>Date</th>
        <th>N° Facture</th>
        <th>Site</th>
        <th>Mode</th>
        <th>Montant payé</th>
    </tr>
</thead>
<tbody id="tb_contenu">
   <?php
    $i=1;
    $total=0;
    foreach ($result as $o) {
        $monnaie = $o->monnaie;
        $mont_paye=$o->montant;
        $mont_paye_af = afficheMontant( $monnaie,$mont_paye);
        $dte =  dateAffiche( $o->dte);
        $num_fact =$o->num_fact;
        $lib =$o->lib;
    ?>
        <tr>
           <td><?php echo $i ?></td>
           <td><?php echo $dte?></td>
           <td><?php echo affiche_numFact($num_fact)?></td>
           <td><?php echo $o->nom_hotel?></td>
            <td><?php echo $lib?></td>
           <td><?php echo $mont_paye_af?></td>
       </tr>
    <?php
    $i++;
    $total+=$mont_paye;
    } 
   $total_af= afficheMontant( $monnaie,$total);
  ?>
</tbody>
<tfoot>
   <tr>
       <td colspan="5"><span class="pull-right">Total général</span></td>
        <td><?php echo $total_af?></td>
    </tr> 
</tfoot>