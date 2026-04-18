 <?php
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
include'../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include'../FUNCTION/hebergement.php';
include('Traitement/liste_produits_alerte.php');
include('./Traitement/quantite_reste.php');
$id_fiche = $_GET['id_fiche'];
$num_bon = $_GET['num_bon'];
$depot_id = $_GET['depot_id'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Restaurant | Détails versement    </title>
   <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" type="text/css" href="daterangepicker/daterangepicker-bs3.css"/>
    <!-- /.daterange picker -->
    <!-- Ionicons -->
    <link rel="stylesheet" href="bootstrap/css/ionicons.min.css">
    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="plugins/fullcalendar/fullcalendar.print.css" media="print">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="shortcut icon" href="images/fanion.png">
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="datepicker/jquery.datetimepicker.css">

    <style>
        .loader {
            background-image: url(images/ajax-loader.gif);
            background-repeat: no-repeat;
            background-position: center;
            height: 30px;
        }
/*         .loader_cmd {
            display:none;
        }*/
    </style>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="index.php" class="navbar-brand"><b><i class="ion-android-restaurant"></i> Ebutelo</b> RESTO</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <!-- /.messages-menu -->
                        
                        <?php
                        $i = 0;
                        foreach ($produits as $prod):
                            $quantite_reste = quantite_ki_reste($prod->idprod, $bdd);
                            if ($quantite_reste <= $prod->qte_min) {
                                $i++;
                            }
                        endforeach;
                        ?>
                        <!-- Notifications Menu -->
                        <li class="dropdown notifications-menu">
                            <!-- Menu toggle button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="S.O.S Produit">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning"><?php echo $i; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Vous avez <?php echo $i; ?> produit(s) à approvisionner</li>
                                <li>
                                    <!-- Inner Menu: contains the notifications -->
                                    <ul class="menu">
                                        <?php
                                        $i = 0;
                                        foreach ($produits as $prod):
                                            $quantite_reste = quantite_ki_reste($prod->idprod, $bdd);
                                            if ($quantite_reste <= $prod->qte_min) {
                                                ?>
                                                <li><!-- start notification -->
                                                    <a href="#">
                                                        <i class="fa fa-circle-o text-red"></i> <?php echo ucfirst($prod->designation); ?>
                                                        <div class="pull-right" style="margin-top: -20px">
                                                            <?php echo $quantite_reste; ?>
                                                        </div>
                                                    </a>
                                                </li>
                                                <!-- end notification -->
                                                <?php

                                                $i++;
                                                if ($i == 5) {
                                                    break;
                                                }
                                            } endforeach; ?>
                                    </ul>
                                </li>
                                <li class="footer"><a href="pages_actions.php?page=bon">Voir tous</a></li>
                            </ul>
                        </li>
                        <li><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i> Plus</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><?php echo ucfirst($_SESSION['nom_user']); ?></a>
                        </li>
                        <li><a href="#">
                                <?php
                                if ($_SESSION['type_user'] == 1) {
                                    echo strtoupper($_SESSION['company_name']);
                                } else {
                                    echo strtoupper($_SESSION['nom_hotel']);
                                }
                                ?>
                            </a>
                        </li>
                        <li><a href="#">
                                <?php
                                if ($_SESSION['test'] == 1) {
                                    echo '('.$_SESSION['libelle_resto'].')';
                                }
                                ?>
                            </a>
                        </li>
                        <?php
                        if ($_SESSION['type_user'] != 1) {
                            ?>
<!--                            <li><a href="../REC2/detail_utilisateur.php?id_user=<?php echo $_SESSION['id_user']?>&prfl=1"><i class="fa fa-gear fa-fw"></i> MON PROFIL</a>
                            </li>-->
                            <?php
                        }
                        ?>
                        <li class="divider"></li>
                        <li><a href="../Authentification/logout.php"><i class="fa fa-sign-out fa-fw"></i> Déconnexion</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <li><a href="#">Taux du jour: <b><span id="taux_jr"><?php echo $taux_op; ?></span></b> </a></li>
                    </ul>
                    </div>
                </div>
                <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Full Width Column -->
    <?php
    include('./POP-UP/action.php');
    ?>
    <div class="content-wrapper">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Approvisionnement en attente</h1>        
            </section>

            <!-- Main content -->
            <section class="content">
               
                    <div class="box" id="details_versement">
                        <div class="box-header">
                    <div class="col-md-9">
                        <h3 class="box-title">
                            Bon de livraison n° : <?php echo $num_bon; ?>
                        </h3>
                    </div>
                    <div class="col-md-3">
                       <button type="submit" id="appro_validate" href="#" class="btn btn-primary">
                            <i class="fa fa-check"></i> Approuver
                        </button>
                             <span class="btn btn-danger hidden" id="loader"><i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...</span>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <div id="msg_grp" class="alert alert-danger alert-dismissable" style="display:none;">
                                <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                                <span id="msg_alert_grp">L'enrégistrement s'est effectué avec succès!</span>
                            </div>
                    <form role="form" id="form" action="Traitement/appro_validation.php" method="post">
                            <input type="hidden" min="1" value="<?php echo $id_fiche; ?>" name="id_fiche">
                            <input type="hidden" min="1" value="<?php echo $num_bon; ?>" name="num_bon">
                            <input type="hidden" min="1" value="<?php echo $depot_id; ?>" name="depot_id">

                    <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example01">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>PRODUIT</th>
                                <th>QUANTITE ENVOYEE</th>
                                <th>QUANTITE RECUE</th>
                                <th>ECART</th>
                                <th>UNITE</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php 
                        $requete = $bdd->prepare("SELECT  * FROM skt_fiche AS a,t_validation AS b,stk_produit AS c WHERE a.id_fiche=b.fiche_id AND b.produit_id=c.idprod AND a.id_fiche=:id_fiche ORDER BY a.id_fiche ASC");
                        $requete->BindParam(':id_fiche', $id_fiche);
                        $requete->execute();
                        $result = $requete->fetchAll(PDO::FETCH_OBJ);
                        $i=1;
                        foreach($result as $r):
                             ?>
                        <tr class="odd gradeX">
                            <td><?php echo $i ?></td>
                            <td><?php echo $r->designation?></td>
                            <td>
                                <?php echo $r->qte_envoye; ?>
                            </td>
                            <td>
                             <input type="hidden" min="1" value="<?php echo $r->id_validation; ?>" class="" id="<?php echo $r->id_validation; ?>" name="validates[]">
                             <input type="hidden" min="1" value="<?php echo $r->idprod; ?>" class="" id="idprod<?php echo $r->id_validation; ?>" name="idprod<?php echo $r->id_validation; ?>">
                             <input type="hidden" min="1" value="<?php echo $r->qte_envoye; ?>" class="" id="qteE<?php echo $r->id_validation; ?>" name="qteE<?php echo $r->id_validation; ?>">
                             <input size="10" type="number" min="1" value="<?php echo $r->qte_envoye; ?>" validate="<?php echo $r->id_validation; ?>" class="quantite_change" id="qteR<?php echo $r->id_validation; ?>" name="qteR<?php echo $r->id_validation; ?>">
                            </td>
                            <td id="ecrat<?php echo $r->id_validation; ?>">
                                <?php echo ($r->qte_envoye-$r->qte_envoye); ?>
                            </td>
                             <td>
                                <?php echo $r->unite; ?>
                            </td>
                        </tr>
                     <?php 
                     $i++;
                     endforeach;
                     ?>

                        </tbody>
                    </table>
            </form>
                </div>


                   
                    </div>
                    <!-- /.box -->
              
            </section>
            <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- Date time picker -->
<script src="datepicker/jquery.js"></script>
<script src="datepicker/jquery.datetimepicker.js"></script>
<script>
    $('#dateres').datetimepicker();
</script>
<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<script>
    $(function () {
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('.mailbox-messages input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });

        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function () {
            var clicks = $(this).data('clicks');
            if (clicks) {
                //Uncheck all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
                $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
            } else {
                //Check all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("check");
                $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
            }
            $(this).data("clicks", !clicks);
        });

        //Handle starring for glyphicon and font awesome
        $(".mailbox-star").click(function (e) {
            e.preventDefault();
            //detect type
            var $this = $(this).find("a > i");
            var glyph = $this.hasClass("glyphicon");
            var fa = $this.hasClass("fa");

            //Switch states
            if (glyph) {
                $this.toggleClass("glyphicon-star");
                $this.toggleClass("glyphicon-star-empty");
            }

            if (fa) {
                $this.toggleClass("fa-star");
                $this.toggleClass("fa-star-o");
            }
        });
    });
</script>
<script>
    $(function () {
        $("#example1").DataTable();
        $("#example3").DataTable();
        $("#example4").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script type="text/javascript" src="js/resto.js"></script>
<script type="text/javascript" src="js/tab.js"></script>


<script type="text/javascript" src="daterangepicker/jquery.min.js"></script>
<script type="text/javascript" src="daterangepicker/moment-with-langs.min.js"></script>
<script type="text/javascript" src="daterangepicker/daterangepicker.js"></script>
<script type="text/javascript">

    moment.lang('fr');

    var pickerLocale = {
        applyLabel: 'OK',
        cancelLabel: 'Annuler',
        fromLabel: 'Entre',
        toLabel: 'et',
        customRangeLabel: 'Période personnalisée',
        daysOfWeek: moment().lang()._weekdaysMin,
        monthNames: moment().lang()._months,
        firstDay: 0
    };

    var pickerRanges = {
        'Aujourd\'hui': [moment(), moment()],
        'Hier': [moment().subtract('days', 1), moment().subtract('days', 1)],
        '5 jours précédents': [moment().subtract('days', 4), moment().subtract('days', 1)],
        'Ce mois': [moment().startOf('month'), moment().endOf('month')],
        'Mois précedent': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
    };
$(document).ready(function () {
    $('.quantite_change').keyup(function (e) {
    e.preventDefault();
    var id = $(this).attr("validate");
    var qte2 = $("#qteR"+id).val();
    var qte1 = $("#qteE"+id).val();
    var dif=qte1-qte2;
    $("#ecrat"+id).text(dif);
    });
     $('#appro_validate').click(function (e) {
            e.preventDefault();
            var bool=false;
            var donnees = $('#form').serialize();
            var url='Traitement/appro_validation.php';
            var datacontent='#navigationcontent';
            $.ajax({
                url: url,
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                    $("#loader").removeClass('hidden');
                    $("#appro_validate").addClass('hidden');
                },
                success: function (data) {
                    $(datacontent).empty().append(data);
                    //alert(data);
                    bool=true;
                     if (data.message_erreur =='yes') {
                        $('#msg_grp').empty().append('Veuillez entrer les valeurs correctes!').show().fadeOut(4000);
                    } else if (data.message_erreur =='no') {       
                       location.href='pages_actions.php?page=fiche';
                       // $('#msg_grp').empty().append('Approbation effectuée avec succes').show().fadeOut(10000);
                    }

                },complete: function () {
                    if (bool) {
                        $("#loader").addClass('hidden');
                         $("#appro_validate").removeClass('hidden');
                    } else {
                        $("#loader").removeClass('hidden');
                    }
                }, dataType: 'json'
            });

         });
   $('#msgapbr').fadeOut(8000);

     });

</script>
</body>
</html>
