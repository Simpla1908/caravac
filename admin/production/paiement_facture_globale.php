<?php
$msg='vide';
$bool=False;
include '../../bdd/connexion.php';
include'../traitement/requette_abonnement.php';
include '../traitement/fonctionalites.php';
if (!empty($_POST['id']) && !empty($_POST['mode_rglmt']) && !empty($_POST['montant_paye']) && !empty($_POST['montant_fac'])) {
    if (is_numeric($_POST['montant_paye']) && is_numeric($_POST['montant_paye'])){
        $data['montant_paye']=$_POST['montant_paye'];
        $data['montant_fac']=$_POST['montant_fac'];
        if($data['montant_paye']==$data['montant_fac']){
            $msg='ok';
            $data['id_hotel'] = $_POST['id'];
            $data['mode_rglmt'] = $_POST['mode_rglmt'];
            $data['mois'] = $_POST['mois'];
            reglement_facture_globale($bdd,$req_details_factureglobal_mois,$data);
            include '../../bdd/connexion.php';
            $totalregle = 0;
            $total = 0;
            $requete = $bdd->prepare($req_details_factureglobal_mois);
            $requete->BindParam(':mois', $data['mois']);
            $requete->BindParam(':id_hotel', $data['id_hotel']);
            $requete->execute();
            $resultats = $requete->fetchAll(PDO::FETCH_OBJ);
            // Obtention du total facture globale et total reglement fac globale        
            foreach ($resultats as $r) {
                $id_hotel = $r->id_hotel;
                $id_fact = $r->id_fact;
                $num_fact = $r->num_fact;
                $date_edition = $r->date_edition;
                $date_echeance = $r->date_echeance;
                $dte_blocage = $r->dte_blocage;
                $nom_c = $r->nom_hotel;
                $adresse_c = $r->adresse_hotel;
                $libelle = $r->libelle;
                $id_fact = $r->id_fact;
                
                $requete = $bdd->prepare("SELECT SUM(montant_dollar) AS mont_rglt FROM  t_reglement WHERE id_fact=:id_fact");
                $requete->BindParam(':id_fact', $id_fact);
                $requete->execute();
                $reglement_by_facture = $requete->fetchAll(PDO::FETCH_OBJ);
                foreach ($reglement_by_facture as $r1) {
                    $totalregle+=$r1->mont_rglt;
                }
                $total+=$r->montantmodule;
            }
            $totalregle = round($totalregle, 2);
            $reste = $total - $totalregle;
            // Fin Obtention du total facture globale et total reglement fac globale   
            $etat = '';
            
            if ($totalregle == 0) {
                $etat = 'Brouillon';
            } elseif ($totalregle > 0 && $totalregle < $total) {
                $etat = 'Ouverte';
            } else {
                $etat = 'Payé';
            }
           
            $bool=True;
        }else{
          echo $msg="Montant saisi doit être égal au total de la facture: ".$data['montant_fac']." $";
        }
        
    } else {
        echo $msg="Veuillez saisir une valeur numérique dans le champ montant!";
    }
} else {
    echo $msg="Veuillez entrer des valeurs correctes dans tous les champs!";
}
?>
<?php if($bool){?>
<section class="content invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12 invoice-header">
            <h3>
                <i class="fa fa-globe"></i><?php echo $libelle ?>
                <small class="pull-right"><span class="label label-danger"><?php echo $etat ?></span></small>

            </h3>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            Client
            <address>
                <strong><?php echo $nom_c ?></strong>
                <br>
                <?php echo $adresse_c ?>
            </address>
        </div>
        <div class="col-sm-4 invoice-col">
            <b>Date édition:</b> <?php echo $date_edition ?>
            <br>
            <b>Date échéance:</b> <?php echo $date_echeance ?>
            <br>
            <b>Date de blocage :</b> <?php echo $dte_blocage ?>
        </div>
        <!-- /.col -->
        <?php
        if ($totalregle > 0 && $totalregle < $total) {
            echo '<div class="col-sm-4 invoice-col" >
                    <h4>
                       <b> 
                           Reste:' . $reste . ' $</b>
                    </h4>
                 </div>';
        }
        ?>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 1%">#</th>
                        <th>Module</th>
                        <th>Utilisateur</th>
                        <th>Montant</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($resultats as $o):
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $o->nom ?></td>
                            <td><?php echo $o->nbreuser ?></td>
                            <td><?php echo $o->montantmodule . ' $' ?></td>
                        </tr>
                        <?php
                        $i++;
                    endforeach;
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <td ><?php echo $total . ' $' ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">

        </div>
    </div>
    <div class="row no-print">
        <div class="col-xs-12">
            <button class="btn btn-default" onclick=""><i class="fa fa-print"></i> Imprimer</button>
            <?php if($etat=='Brouillon'||$etat=='Ouverte'){  ?>
            <button class="btn btn-success pull-right" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-save"></i> Payer</button>
            <?php }  ?>
        </div>
    </div>
</section>

<?php }?>
