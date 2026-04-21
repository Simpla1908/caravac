<!-- Modal -->
<?php

$musd='USD';
$mcdf='CDF';
$percu_cdf=0;
$percu_usd=0;
$rendu_cdf=0;
$rendu_usd=0;
$fond_cdf=0;
$fond_usd=0; 
$dte=date('Y-m-d');
$requete = $bdd->prepare("SELECT SUM(b.montantcdf) AS percu_cdf,SUM(b.montantusd) AS percu_usd,SUM(b.rendu_cdf) AS rendu_cdf,SUM(b.rendu_usd) AS rendu_usd
        FROM t_reglement AS a,paiement AS b
        WHERE a.id_regl=b.regl_id AND a.dte=:dte AND a.id_user=:id_user
        AND  b.site_id=:id_hotel AND b.id_sousresto=:id_sousresto GROUP BY a.dte,a.id_user");
$requete->BindParam(':dte',$dte);
$requete->BindParam(':id_user',$_SESSION['id_user']);
$requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
$requete->execute();
$result = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($result as $r) {
    $_SESSION['percu_cdf']=$percu_cdf=$r->percu_cdf;
    $_SESSION['percu_usd']=$percu_usd= $r->percu_usd;
    $_SESSION['rendu_cdf']=$rendu_cdf= $r->rendu_cdf;
    $_SESSION['rendu_usd']=$rendu_usd= $r->rendu_usd;
}
$requete = $bdd->prepare("SELECT SUM(cdf) AS fond_cdf,SUM(usd) AS fond_usd
        FROM fondscaisse 
        WHERE dte=:dte AND user_id=:id_user
        AND hotel_id=:id_hotel AND sousresto_id=:id_sousresto GROUP BY dte,user_id");
$requete->BindParam(':dte',$dte);
$requete->BindParam(':id_user',$_SESSION['id_user']);
$requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
$requete->execute();
$result = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($result as $r) {
    $_SESSION['fond_cdf']=$fond_cdf=$r->fond_cdf;
    $_SESSION['fond_usd']=$fond_usd=$r->fond_usd;
}
$_SESSION['averser_cdf']=$averser_cdf=($fond_cdf+$percu_cdf)-$rendu_cdf;
$_SESSION['averser_usd']=$averser_usd=($fond_usd+$percu_usd)-$rendu_usd; 
$requete = $bdd->prepare("SELECT a.date_vers,a.user_vers,SUM(a.montant_vers) AS mont_cdf,SUM(a.montantusd) AS mont_usd,a.date_vers,b.nom_user
        FROM t_versement AS a,t_utilisateur AS b
        WHERE  a.user_vers=b.id_user AND a.date_vers=:dte AND a.user_vers=:id_user
        AND  a.id_hotel=:id_hotel AND a.id_sousresto=:id_sousresto GROUP BY a.date_vers,a.user_vers");
$requete->BindParam(':dte',$dte);
$requete->BindParam(':id_user',$_SESSION['id_user']);
$requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
$requete->execute();
$result = $requete->fetchAll(PDO::FETCH_OBJ);
$verser_usd=0;
$verser_cdf=0;
foreach ($result as $r) {
$_SESSION['verser_usd']=$verser_usd=$r->mont_usd;
$_SESSION['verser_cdf']=$verser_cdf=$r->mont_cdf;
}
$_SESSION['solde_cdf']=$solde_cdf=$averser_cdf-$verser_cdf;
$_SESSION['solde_usd']=$solde_usd=$averser_usd-$verser_usd;
?>
<div class="modal fade Modal_versement" id="myModal_versement12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title" id="myModalLabel">Versement Caisse</h5>
            </div>
            <div class="modal-body" id="popup_paie">
                <form action='./Traitement/versement.php' method="post" id="formversement">
                    <div class="box-body">
                        <div class="box-group" id="accordion">
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="box-body">
                                    <div class="row">
                                       
                                       <div class="col-lg-12" style="overflow: auto; height: 350px;">
                                         <div class="col-lg-12 form-group">
                                            <p class="text-center">
                                                <strong>DETAILS VENTE DU <?php echo date('d/m/Y');?></strong>
                                            </p>
                                        </div>
                                        <div class="box-body table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>USD</th>
                                                <th>CDF</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                             <tr>
                                                <th>FOND DE CAISSE</th>
                                                <td><?php echo afficheMontant($musd,$fond_usd) ?></td>
                                                <td><?php echo afficheMontant($mcdf,$fond_cdf) ?></td>
                                            </tr>
                                             <tr>
                                                <th>MONTANT PERCU</th>
                                                <td><?php echo afficheMontant($musd,$percu_usd) ?></td>
                                                <td><?php echo afficheMontant($mcdf,$percu_cdf)?></td>
                                            </tr>
                                             <tr>
                                                <th>RENDU</th>
                                                <td><?php echo afficheMontant($musd,$rendu_usd) ?></td>
                                                <td><?php echo afficheMontant($mcdf,$rendu_cdf)?></td>
                                            </tr>
                                            <tr>
                                                <th>MONTANT A VERSER</th>
                                                <td><?php echo afficheMontant($musd,$averser_usd)?></td>
                                                <td><?php echo afficheMontant($mcdf,$averser_cdf) ?></td>
                                            </tr>
                                             <tr>
                                                <th>MONTANT VERSE</th>
                                                <td><?php echo afficheMontant($musd,$verser_usd)?></td>
                                                <td><?php echo afficheMontant($mcdf,$verser_cdf) ?></td>
                                            </tr>
                                            <tr>
                                                <th>SOLDE </th>
                                                <td><?php echo afficheMontant($musd,$solde_usd)?></td>
                                                <td><?php echo afficheMontant($mcdf,$solde_cdf) ?></td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                        <div class="col-lg-12 form-group">
                                            <p class="text-center">
                                                <strong>REPARTITION ET BILLETAGE DES MONTANTS</strong>
                                            </p>
                                        </div>
                                        
                                            <div class="col-lg-5">
                                            <div class="form-group">
                                                <input type="hidden" id="averser_usd" name="averser_usd"  value="<?php echo $solde_usd;?>">
                                                <input type="hidden" id="averser_cdf" name="averser_cdf"  value="<?php echo $solde_cdf;?>">
                                                <label>Montant en USD</label>
                                                <div class="input-group">
                                                    <input type="text" id="montant_usd" name="montant_usd"
                                                           class="form-control text-right text-blue " value="0">
                                                    <span class="input-group-addon">USD</span>
                                                </div>
                                            </div>
                                            <table class="table table-condensed">
                                                <tr>
                                                    <th class="text-center" style="width: 50%">BILLETS</th>
                                                    <th class="text-center" style="width: 50%">NOMBRES</th>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">100 USD</td>
                                                    <td class="text-center" style="width: 50%"><input type="number" name="100usd" id="100usd" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">50 USD</td>
                                                    <td class="text-center" style="width: 50%"><input type="number" name="50usd" id="50usd" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">20 USD</td>
                                                    <td class="text-center" style="width: 50%"><input type="number" name="20usd" id="20usd" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">10 USD</td>
                                                    <td class="text-center" style="width: 50%"><input name="10usd" id="10usd" type="number" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">5 USD</td>
                                                    <td class="text-center" style="width: 50%"><input name="5usd" id="5usd" type="number" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">1 USD</td>
                                                    <td class="text-center" style="width: 50%"><input type="number" name="1usd" id="1usd" min="0" value="0"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <!-- /.col-lg-6 -->
                                        <div class="col-lg-5 pull-right">
                                            <div class="form-group">
                                                <label>Montant en CDF</label>
                                                <div class="input-group">
                                                    <input type="text" id="montant_cdf" name="montant_cdf"
                                                           class="form-control text-right text-blue " value="0">
                                                    <span class="input-group-addon">CDF</span>
                                                </div>
                                            </div>
                                            <table class="table table-condensed">
                                                <tr>
                                                    <th class="text-center" style="width: 50%">BILLETS</th>
                                                    <th class="text-center" style="width: 50%">NOMBRES</th>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">20.000 CDF</td>
                                                    <td class="text-center" style="width: 50%"><input type="number" name="20000cdf" id="20000cdf" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">10.000 CDF</td>
                                                    <td class="text-center" style="width: 50%"><input type="number" name="10000cdf" id="10000cdf" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">5.000 CDF</td>
                                                    <td class="text-center" style="width: 50%"><input type="number" name="5000cdf" id="5000cdf" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">1000 CDF</td>
                                                    <td class="text-center" style="width: 50%"><input type="number" name="1000cdf" id="1000cdf" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">500 CDF</td>
                                                    <td class="text-center" style="width: 50%"><input name="500cdf" id="500cdf" type="number" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">200 CDF</td>
                                                    <td class="text-center" style="width: 50%"><input name="200cdf" id="200cdf" type="number" min="0" value="0"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <!-- /.col-lg-6 -->
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class=" modal-footer">
                        <div id="msg" class="alert alert-success alert-dismissable" style="display: none">
                    <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                    <span id="msg_alert">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                </div>
                        <span class="btn btn-danger hidden" id="loader_vers">
                            <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                        </span>
                        <button type="submit" id="verser_montant" class="btn btn-primary"><i class="fa fa-check fa-fw"></i>&nbsp;Valider
                        </button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

<!-- /.modal -->

