<?php
include '../../bdd/connexion.php';
include_once'../../FUNCTION/hebergement.php';
include_once'../traitement/fonctionalites.php';

$idfact = 0;
$num_fact='';
if (isset($_GET['id'])) {
    $idfact = (int) $_GET['id'];
}
$result=getLigneFacture($idfact,$bdd);
$i = 1;
$total_fact = 0;
$total_paye = 0;
$activation = 0;
$monnaie = "";
$id_hotel = 0;
$company_id = 0;
$num_fact = '';
foreach ($result as $o) {
    $monnaie = $o->monnaie;
    $mont_tot = afficheMontant($monnaie, $o->montant);
    $mont_paye = afficheMontant($monnaie, $o->mont_paye);
    $reste = $o->montant - $o->mont_paye;
    $reste_af = afficheMontant($monnaie,$reste);
    $dte_blocage_fact = $o->dte_arret;
    $lfp_id = $o->lfp_id;
    $pack_id = $o->pack_id;
    $id_hotel = $o->id_hotel;
    $company_id = $o->company_id;
    $num_fact = $o->num_fact;
    $activation = $o->active;
    $pack_company_id = $o->pack_company_id;
    $type_souscript = $o->type;
    $fact1 = $o->fact1;
    $fact1 = $o->fact1;
    $id_user= $o->id_user;
    $prnom_user= $o->prenom_user;
    $nom_user= $o->nom_user;
    $mail_company= $o->mail_company;
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo affiche_numFact($num_fact); ?></td>
        <td><?php echo $o->libelle ?></td>
        <td><?php echo $mont_tot ?></td>
        <td><?php echo $mont_paye ?></td>
        <td><?php echo $reste_af ?></td>
        <td>
            <a href="#" 
               fact_id="<?php echo $idfact ?>" 
               mont_fact="<?php echo $reste ?>"
               mont_fact_af="<?php echo $reste_af ?>"
               lfp_id="<?php echo $lfp_id ?>"
               pack_id="<?php echo $pack_id ?>"
               id_hotel="<?php echo $id_hotel ?>"
               company_id="<?php echo $company_id ?>"
               activer="<?php echo $activation ?>"
               pack_company_id="<?php echo $pack_company_id ?>"
               type_souscript="<?php echo $type_souscript ?>"
               fact1="<?php echo $fact1 ?>"
               fact1="<?php echo $fact1 ?>"
               id_user="<?php echo $id_user ?>"
               prnom_user="<?php echo $prnom_user ?>"
               nom_user="<?php echo $nom_user ?>"
               mail_company="<?php echo $mail_company ?>"
               regler="one"
               class="btn btn-info btn-xs btn_regler">Régler</a>
        </td>
    </tr>
    <?php
    $i++;
    $total_fact+=$mont_tot;
    $total_paye+=$mont_paye;
  }
?>