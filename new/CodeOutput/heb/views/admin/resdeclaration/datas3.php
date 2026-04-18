<?php
if (!isset($_SESSION)) {
    session_start();
 }
?>
  <table data-page="false" class="t1 t2 table table-bordered table-condensed table-hover table-striped" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
    <thead>
        <tr>
            <th>N°</th>
            <th data-hide="phone,tablet">Noms Agent</th>
            <th data-hide="phone,tablet">Salaire de Base</th>
            <th data-hide="phone,tablet">Montant</th>
        </tr>
    </thead>
    <tbody>
       <?php
       //Mise en session pour impression
       $_SESSION['rows_declaration'] = array();
       $_SESSION['rows_declaration']['i'] = array();
       $_SESSION['rows_declaration']['noms'] = array();
       $_SESSION['rows_declaration']['salbase'] = array();
       $_SESSION['rows_declaration']['montant'] = array();
       //Fin mise en session
        $i = 1;
        $tot_salbase=0;
        $tot_montant=0;
        foreach ($result as $rows) {
            $salbase= montant_equivalent_bdd($rows->devise, $_SESSION['Paie_affiche'],$_SESSION['Paie_taux'], $rows->salbase);
            $montant=($salbase*$poursoc)/100;
            $tot_salbase+=$salbase;
            $tot_montant+=$montant;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $rows->noms; ?></td>
                <td><?php echo afficheMontant($_SESSION['Paie_affiche'],$salbase);?></td>
                <td><?php echo afficheMontant($_SESSION['Paie_affiche'],$montant);?></td>
            </tr>
            <?php 
            //Mise en session pour impression
            array_push($_SESSION['rows_declaration']['i'], $i);
            array_push($_SESSION['rows_declaration']['noms'], $rows->noms);
            array_push($_SESSION['rows_declaration']['salbase'], afficheMontant($_SESSION['Paie_affiche'],$salbase));
            array_push($_SESSION['rows_declaration']['montant'], afficheMontant($_SESSION['Paie_affiche'],$montant));
            //Fin mise en session
            $i++;


        } 

        ?>
    </tbody>
  <tfoot>
  <tr>
  <td colspan="2">Total</td>
  <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $tot_salbase);?></td>
  <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $tot_montant);?></td>
  </tr>
</tfoot>
    </table>
     <?php 
    //Mise en session pour impression
    $_SESSION['lib_declaration']=$lib;
    $_SESSION['datedebut_declaration']=post('datedebut');
    $_SESSION['datefin_declaration']=post('datefin');
    $_SESSION['tot_salbase_declaration']=afficheMontant($_SESSION['Paie_affiche'], $tot_salbase);
    $_SESSION['tot_montant_declaration']=afficheMontant($_SESSION['Paie_affiche'], $tot_montant);
    //Fin mise en session
?>