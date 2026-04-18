        <?php include('Receptionniste.php'); ?>
        <?php include('head.php'); ?>
        <?php
        include('menu_Rec_config.php');
        include '../bdd/connexion_mysql.php';
        ?>
        <?php
        $id_hotel = $_GET['id_hotel'];
        $result = mysql_query("SELECT * FROM  t_hotel h WHERE h.id_hotel='$id_hotel' ") or die(mysql_error());
        while ($rows = mysql_fetch_assoc($result)) {

        $nom_hotel = $rows['nom_hotel'];
        $adresse_hotel = $rows['adresse_hotel'];
        $province_hotel = $rows['province_hotel'];
        $ville_hotel = $rows['ville_hotel'];
         $idnat=$rows['idnat'];
         $rccm= $rows['rccm'];
         $mail= $rows['mail'];
         $phone= $rows['phone'];
        }
        ?>
        <?php  include 'Traitement/selection_inf_admin.php';?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Site</h3>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Detail des informations du site <i class="fa fa-angle-right"></i> <span class="text-info"><?php echo $nom_hotel; ?></span>
                                <div class="btn-group  btn-group-sm pull-right">
                                    <a href="gg_consultation_hotel.php" class="btn btn-default" title="Liste des hotels"><i class="fa fa-list"></i> Liste des sites</a>
                                </div>
                            </h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab">Général</a>
                                </li>
                                <li><a href="#profile" data-toggle="tab">Informations administratives</a>
                                </li>
                                <li><a href="#messages" data-toggle="tab">Modules du site</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                    <br />
                                    <form method="post" action="" data-parsley-validate class="form-horizontal form-label-left">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <!--<th style="width: 20%">First Name</th>-->
                                                        <th>Vos Informations Générales </th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Nom</td>
                                                        <td>
                                                            <span class="col-md-7 col-xs-12 cacher">: <?php echo $nom_hotel; ?></span>
                                                            <input type="text" id="nom_hotel" name="nom_hotel" value="<?php echo $nom_hotel; ?>" required class="form-control col-md-7 col-xs-12 voir">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Adresse</td>
                                                        <td>
                                                            <span class="col-md-7 col-xs-12 cacher">: <?php echo $adresse_hotel; ?></span>
                                                            <input type="text" id="adresse_hotel" name="adresse_hotel" value="<?php echo $adresse_hotel; ?>" required class="form-control col-md-7 col-xs-12 voir">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Province</td>
                                                        <td>
                                                            <span class="col-md-7 col-xs-12 cacher">: <?php echo $province_hotel; ?></span>
                                                            <input id="province_hotel" class="form-control col-md-7 col-xs-12 voir" value="<?php echo $province_hotel; ?>" type="text" name="province_hotel">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ville</td>
                                                        <td>
                                                            <span class="col-md-7 col-xs-12 cacher">: <?php echo $ville_hotel; ?></span>
                                                            <input id="ville_hotel" name="ville_hotel" value="<?php echo $ville_hotel; ?>" class="form-control col-md-7 col-xs-12 voir" required type="text">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tél.</td>
                                                        <td>
                                                            <span class="col-md-7 col-xs-12 cacher">: <?php echo $phone; ?></span>
                                                            <input id="phone" name="phone" value="<?php echo $phone; ?>" class="form-control col-md-7 col-xs-12 voir" required type="text">
                                                        </td>
                                                    </tr>
                                                     <tr>
                                                        <td>Email</td>
                                                        <td>
                                                            <span class="col-md-7 col-xs-12 cacher">: <?php echo $mail; ?></span>
                                                            <input id="mail" name="mail" value="<?php echo $mail; ?>" class="form-control col-md-7 col-xs-12 voir" required type="text">
                                                        </td>
                                                    </tr>
                                                     <tr>
                                                        <td>Id.Nat.</td>
                                                        <td>
                                                            <span class="col-md-7 col-xs-12 cacher">: <?php echo $idnat; ?></span>
                                                            <input id="idnat" name="idnat" value="<?php echo $idnat; ?>" class="form-control col-md-7 col-xs-12 voir" required type="text">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Rccm</td>
                                                        <td>
                                                            <span class="col-md-7 col-xs-12 cacher">: <?php echo $rccm; ?></span>
                                                            <input id="rccm" name="rccm" value="<?php echo $rccm; ?>" class="form-control col-md-7 col-xs-12 voir" required type="text">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                <!--<button type="submit" class="btn btn-primary">Cancel</button>-->
                                                <button id="btn_edit_regl" type="submit" name="btn_edit_regl" class="btn btn-success cacher">Modifier</button>
                                                <button style="display: none;" type="submit" name="sauvegarder" class="btn btn-success voir">Valider</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <div class="tab-pane fade" id="profile">
                                    <br />
                                    <form method="post" action="Traitement/trtm_inf_admin.php" id="form-inf-admin" name="form-inf-admin" class="form-horizontal form-label-left" novalidate>
                                        <input id="id_site" value="<?php echo $_GET['id_hotel'];?>" name="id_site" type="hidden">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <!--<th style="width: 20%">First Name</th>-->
                                                        <th>Vos Informations Administratives</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="inf-admin-maj">
                                                    <tr>
                                                        <td>Monnaie Prix</td>
                                                        <td>
                                                            <span class="col-md-7 col-xs-12 cacher1">: <?php echo $mi; ?></span>
                                                            <select name="monnaie_prix" id="monnaie_prix" class="form-control voir1">
                                                                <?php if ($mi=="USD"){?>
                                                                    <option selected value="USD">USD</option>
                                                                    <option value="CDF">CDF</option>
                                                                <?php }else if ($mi=="CDF"){?>
                                                                    <option value="USD">USD</option>
                                                                    <option selected value="CDF">CDF</option>
                                                                <?php }?>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Monnaie Facture</td>
                                                        <td>
                                                            <span class="col-md-7 col-xs-12 cacher1">: <?php echo $ma; ?></span>
                                                            <select name="monnaie_fac" id="monnaie_fac" class="form-control voir1">
                                                                <?php if ($mi=="USD"){?>
                                                                    <option selected value="USD">USD</option>
                                                                    <option value="CDF">CDF</option>
                                                                <?php }else if ($mi=="CDF"){?>
                                                                    <option value="USD">USD</option>
                                                                    <option selected value="CDF">CDF</option>

                                                                <?php }?>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Taux d'échange de USD en monnaie locale</td>
                                                        <td>
                                                            <span class="col-md-7 col-xs-12 cacher1">:  <?php echo $taux; ?></span>
                                                            <input id="taux" class="form-control col-md-7 col-xs-12 voir1" value="<?php echo $taux; ?>" name="taux" type="text">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>TVA par défaut</td>
                                                        <td>
                                                            <span class="col-md-7 col-xs-12 cacher1">: <?php echo $tva; ?>%</span>
                                                            <div class="input-group demo2 voir1">
                                                                <input type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $tva; ?>" id="tva" name="tva" />
                                                                <span class="input-group-addon">%</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Rémise</td>
                                                        <td>
                                                            <span class="col-md-7 col-xs-12 cacher1">: <?php echo $rmz; ?>%</span>
                                                            <div class="input-group demo2 voir1">
                                                                <input type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $rmz; ?>" id="rmz" name="rmz" />
                                                                <span class="input-group-addon">%</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Time Check in <small><i>(réservé à un hôtel)</i></small></td>
                                                        <td>
                                                            <span class="col-md-7 col-xs-12 cacher1">: <?php echo $checkin; ?></span>
                                                            <input type="text" id="timepicker1" placeholder="Check in" value="<?php echo $checkin; ?>" class="form-control voir1" id="checkin" name="checkin">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Time Check out <small><i>(réserver à un hôtel)</i></small></td>
                                                        <td>
                                                            <span class="col-md-7 col-xs-12 cacher1">: <?php echo $checkout; ?></span>
                                                            <input type="text" id="timepicker2" placeholder="Check out" value="<?php echo $checkout; ?>" class="form-control voir1" id="checkout" name="checkout">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="status alert alert-success col-md-12" id='msg' style="display:none"><i class="fa fa-info-circle"></i>Veuillez remplir ces champs vides</div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                                <button id="btn_edit_inf" name="btn_edit_inf" type="submit" class="btn btn-success cacher1">Modifier</button>
                                                <button id="btn_sve_inf" name="btn_sve_inf" style="display: none;" type="submit" class="btn btn-success voir1">Valider</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="messages">
                                    <br />
                                    <div class="table-responsive">
                                        <?php
                                        $company =  $_SESSION['company_id'];
                                        $id_site = $_GET['id_hotel'] ;
                                        $requete = $bdd->prepare("SELECT COUNT(id) AS nbre_module_sous FROM  t_modulecompany  WHERE company_id=:id_c AND site_id=:id_site");
                                        $requete->BindParam(':id_c', $company);
                                        $requete->BindParam(':id_site', $id_site);
                                        $requete->execute();
                                        $data_exists = ($requete->fetchColumn() > 0) ? true : false;
                                        if($data_exists){
                                        ?>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <!--<th style="width: 20%">First Name</th>-->
                                                    <th>Modules souscripts </th>
                                                    <th>Nombres d'utilisateurs</th>
                                                    <th>#Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                    $company =  $_SESSION['company_id'];
                                    $id_site = $_GET['id_hotel'] ;
                                            $requete = $bdd->prepare("SELECT c.nbreuser,c.etat_module,m.id,m.nom,m.code FROM  t_modulecompany AS c,module AS m WHERE c.company_id=:id_c AND c.site_id=:id_site AND c.module_id=m.id ORDER BY m.nom ASC");
                                    $requete->BindParam(':id_c', $company);
                                    $requete->BindParam(':id_site', $id_site);
                                    $requete->execute();
                                    $module_tuples = $requete->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($module_tuples as $module_t){
                                    $nom_module=$module_t->nom;
                                    $nbreuser=$module_t->nbreuser;
                                    $etat_module=$module_t->etat_module;
                                    $code=$module_t->code;
                                    $id_module=$module_t->id;

                                    ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $nom_module;?>
                                                    </td>
                                                    <td>
                                                        <?php echo $nbreuser;?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                    if($etat_module==0){
                                                    echo "en attente";
                                                    }else if($etat_module==2){
                                                    echo "nombre d'utilisateur atteint";
                                                    }
                                                    else if($etat_module==1){
                                                            if($id_module!=22){?>
                                                        <a href="tableaudebord_config.php?module=<?php echo $code;?>&site=<?php echo $id_site ;?>" class="btn btn-primary btn-xs setting-module"><i class="fa fa-cogs"></i> Paramétrer </a>
                                                        <?php   }
                                                        }?>
                                                    </td>
                                                </tr>
                                                <?php   }
                                    ?>
                                            </tbody>
                                            <?php
                                        }else{
                                            ?>
                                            <div class="status alert alert-success" id='msg'><i class="fa fa-info-circle"></i> Aucun module souscrit</div>

                                            <?php
                                        }
                                            ?>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="3">
                                                        <a href="../appstore.php?site=<?php echo $id_site;?>" class="btn btn-success btn-xs setting-module"><i class="fa fa-plus-circle"></i> Ajouter un module</a>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        <?PHP
if (isset($_POST['sauvegarder'])) {
    $nom_hotel = $_POST['nom_hotel'];
    $adresse_hotel = $_POST['adresse_hotel'];
    $province_hotel = $_POST['province_hotel'];
    $ville_hotel = $_POST['ville_hotel'];
    $phone = $_POST['phone'];
    $mail = $_POST['mail'];
    $idnat = $_POST['idnat'];
    $rccm = $_POST['rccm'];


//_requete
    $req_sql = mysql_query("UPDATE t_hotel SET
nom_hotel='" . $nom_hotel . "',
adresse_hotel='" . $adresse_hotel . "',
province_hotel='" . $province_hotel . "',
province_hotel='" . $province_hotel . "',
ville_hotel='" . $ville_hotel . "',
idnat='" . $idnat . "',
rccm='" . $rccm . "',
mail='" . $mail . "',
phone='" . $phone . "'
WHERE id_hotel='$id_hotel'") or die("impossible d'executer la requette*.<br>\n Erreur MySQL'" . mysql_error() . "'");
    echo "<script>

alert('La modification est éffectuée avec succès');
document.location='gg_consultation_hotel.php';
</script>";
}
?>

        <!-- jQuery -->
        <script src="datepicker/jquery.js"></script>
        <script>
            $(document).ready(function () {
                //         $('.voir').hide();
                $(window).load(function () {
                    $('.voir').hide();
                    $('.voir1').hide();
                    //        $('.bs-example-modal-lg').modal('show');
                });

                //    function getParams() {
                //     var url = window.location.href;
                //     var splitted = url.split("?");
                //     if(splitted.length === 1) {
                //        return {};
                //     }
                //     var paramList = decodeURIComponent(splitted[1]).split("&");
                //     var params = {};
                //     for(var i = 0; i < paramList.length; i++) {
                //         var paramTuple = paramList[i].split("=");
                //         params[paramTuple[0]] = paramTuple[1];
                //     }
                //     return params;
                // }
                $('.setting-module').click(function (e) {
                    e.preventDefault();
                    var url = $(this).attr('href');
                    var params = url.split("?");
                    $.ajax({
                        url: 'Traitement/maj-id-site.php?' + params[1],
                        type: 'POST',
                        success: function (data) {
                            window.location.href = url;
                        }
                    });

                });


                $('#btn_edit_regl').click(function (e) {
                    e.preventDefault();

                    $('.voir').show();
                    $('.cacher').hide();
                });

                $('#btn_edit_inf').click(function (e) {
                    e.preventDefault();

                    $('.voir1').show();
                    $('.cacher1').hide();
                });
                $('#btn_sve_inf').click(function (e) {
                    e.preventDefault();
                    var donnees = $('#form-inf-admin').serialize();
                    if ($('#taux').val() == '') {
                        $('#msg').empty().append('Veuillez remplir les champs vides!').show().fadeOut(4000);
                        if ($('#tva').val() == '') $("#tva").css("border-color", "red");
                        if ($('#taux').val() == '') $("#taux").css("border-color", "red");
                    } else {
                        $.ajax({
                            url: 'Traitement/trtm_inf_admin.php',
                            type: 'POST',
                            data: donnees,
                            success: function (data) {
                                $('#inf-admin-maj').empty().append(data);
                                $('.voir1').hide();
                                $('.cacher1').show();

                            }
                        });

                    }
                });
            });
        </script>
            <?php include('./gl_footer.php'); ?>
