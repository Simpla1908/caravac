<?php
session_start();
include '../../bdd/connexion.php';
include '../../FUNCTION/hebergement.php';
include '../traitement/requette_abonnement.php';
include'../traitement/fonctionalites.php';
?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Admin | ebutelo</title>

        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- bootstrap-wysiwyg -->
        <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
        <!-- Switchery -->
        <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
        <!-- Datatables -->
        <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <!--<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">-->
        <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="../images/ico/favicon.png"> 

    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <!--<a href="index.php" class="site_title"><i class="fa fa-signal"></i> <span>ebutelo!</span></a>-->
                            <a href="index.php" class="site_title"><span>Ebutelo</span></a>
                        </div>
                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile">

                        </div>

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <ul class="nav side-menu">
                                    <li>
                                        <a>
                                            <i class="fa fa-home"></i>Menu</span>
                                        </a>
                                    </li>
                                    <li><a  href="?action=souscription"><i class="fa fa-th-list"></i>Souscriptions</a>
                                    <li><a  href="?action=facture"><i class="fa fa-file-text-o"></i>Factures</a>
<!--                                    <li><a><i class="fa fa-cog"></i>Paramétrage <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="?action=tarifs">Tarifs module/pack</a></li>
                                            <li><a href="#" data-toggle="modal" data-target="#myModaltva">TVA</a></li>

                                        </ul>
                                    </li>-->
                                </ul>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav class="" role="navigation">
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
<!--                                        <img src="images/img.jpg" alt="">-->
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li><a href="javascript:;"> Profile</a></li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="badge bg-red pull-right">50%</span>
                                                <span>Settings</span>
                                            </a>
                                        </li>
                                        <li><a href="javascript:;">Help</a></li>
                                        <li><a href="../traitement/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                    </ul>
                                </li>

                                <li role="presentation" class="dropdown">
                                    <a href="?action=mailbox" class="info-number" data-toggle="dropdown1" aria-expanded="false">
                                        <i class="fa fa-envelope-o"></i>
                                        <span class="badge bg-green"><?php echo $nbr; ?></span>
                                    </a>

                                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                        <li>
                                            <a>
                                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="text-center">
                                                <a>
                                                    <strong>See All Alerts</strong>
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main" id="conteneur">
                    <?php
                        if(!empty($_GET['action'])){
                           include '../production/souscription_ctrl.php';
                          }else {
                              
                          }
                        
                    ?> 
                </div>
                 <?php //  include './modal_reglement.php';?>
                <footer>
                    <div class="pull-right">
                        <!--<a href="https://colorlib.com">Colorlib</a>-->
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>
        <?php
        include('modal_tva.php');
        ?>
        <!-- jQuery -->
        <script src="../vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="../vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="../vendors/nprogress/nprogress.js"></script>
        <!-- Datatables -->
        <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!--    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>-->
        <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <!--<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>-->
        <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <!--<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>-->
        <!--<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>-->
        <!--<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>-->
        <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
        <script src="../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
        <!-- bootstrap-wysiwyg -->
        <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
        <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
        <script src="../vendors/google-code-prettify/src/prettify.js"></script>

        <script src="../vendors/jszip/dist/jszip.min.js"></script>
        <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
        <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="../build/js/custom.min.js"></script>
        <!--<script src="../parametrage/jsparametrage.js"></script>-->
        <!-- Datatables -->
        <script>
            $(document).ready(function () {
                var handleDataTableButtons = function () {
                    if ($("#datatable-buttons").length) {
                        $("#datatable-buttons").DataTable({
                            dom: "Bfrtip",
                            buttons: [
                                {
                                    extend: "copy",
                                    className: "btn-sm"
                                },
                                {
                                    extend: "csv",
                                    className: "btn-sm"
                                },
                                {
                                    extend: "excel",
                                    className: "btn-sm"
                                },
                                {
                                    extend: "pdfHtml5",
                                    className: "btn-sm"
                                },
                                {
                                    extend: "print",
                                    className: "btn-sm"
                                },
                            ],
                            responsive: true
                        });
                    }
                };

                TableManageButtons = function () {
                    "use strict";
                    return {
                        init: function () {
                            handleDataTableButtons();
                        }
                    };
                }();

                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable({
                    keys: true
                });

                $('#datatable-responsive').DataTable();

                $('#datatable-scroller').DataTable({
                    ajax: "js/datatables/json/scroller-demo.json",
                    deferRender: true,
                    scrollY: 380,
                    scrollCollapse: true,
                    scroller: true
                });

                var table = $('#datatable-fixed-header').DataTable({
                    fixedHeader: true
                });

                TableManageButtons.init();
            });
        </script>
        <!-- /Datatables -->
        <!-- bootstrap-wysiwyg -->
        <script>
            $(document).ready(function () {
                function initToolbarBootstrapBindings() {
                    var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
                        'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
                        'Times New Roman', 'Verdana'
                    ],
                            fontTarget = $('[title=Font]').siblings('.dropdown-menu');
                    $.each(fonts, function (idx, fontName) {
                        fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
                    });
                    $('a[title]').tooltip({
                        container: 'body'
                    });
                    $('.dropdown-menu input').click(function () {
                        return false;
                    })
                            .change(function () {
                                $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
                            })
                            .keydown('esc', function () {
                                this.value = '';
                                $(this).change();
                            });

                    $('[data-role=magic-overlay]').each(function () {
                        var overlay = $(this),
                                target = $(overlay.data('target'));
                        overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
                    });

                    if ("onwebkitspeechchange" in document.createElement("input")) {
                        var editorOffset = $('#editor').offset();

                        $('.voiceBtn').css('position', 'absolute').offset({
                            top: editorOffset.top,
                            left: editorOffset.left + $('#editor').innerWidth() - 35
                        });
                    } else {
                        $('.voiceBtn').hide();
                    }
                }

                function showErrorAlert(reason, detail) {
                    var msg = '';
                    if (reason === 'unsupported-file-type') {
                        msg = "Unsupported format " + detail;
                    } else {
                        console.log("error uploading file", reason, detail);
                    }
                    $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
                }

                initToolbarBootstrapBindings();

                $('#editor').wysiwyg({
                    fileUploadError: showErrorAlert
                });

                window.prettyPrint;
                prettyPrint();
            });
        </script>
        <!-- /bootstrap-wysiwyg -->
        <!--traitement -->
        <script>
            $(document).ready(function () {
                $("#conteneur").on('click', '#c .choix', function (e) {
                    var motif, id, etat, url;
                    url = $(this).attr("url");
                    motif = $(this).attr("motif");
                    if ($(this).is(":checked")) {
                        id = $(this).attr('id');
                        etat = 1;
                        $.ajax({
                            url: url,
                            async: true,
                            type: 'POST',
                            data: "id=" + id + "&motif=" + motif + "&etat=" + etat,
                            global: false,
                            cache: false,
                            success: function (html) {
//                               alert(html)
                            }
                        });

                    } else {
                        id = $(this).attr('id');
                        etat = 0;
                        $.ajax({
                            url: url,
                            async: true,
                            type: 'POST',
                            data: "id=" + id + "&motif=" + motif + "&etat=" + etat,
                            global: false,
                            cache: false,
                            success: function (html) {
//                               alert(html)
                            }
                        });
                    }

                })
                //Activation des packs/modules
                $("#conteneur").on('click', '.btn_active', function (e) {
                    e.preventDefault();
                    var bool = false;
                    var test = 1;
                    var donnees = '';
                    var idpackcomp = $(this).attr("idpackcomp");
                    var souscrip = $(this).attr("souscrip");
                    var site = $(this).attr("site");
                    //alert(site);
                    var type = $(this).attr("type");
                    var url;
                    if (type == 1) {
                        var dateecheance = $(this).attr("date_echeance");
                        url = '../traitement/activation.php?test=' + test + '&idpackcomp=' + idpackcomp + '&dateecheance=' + dateecheance + '&souscrip=' + souscrip;
                    } else {
                        test = 0;
                        url = '../traitement/activation.php?test=' + test + '&idpackcomp=' + idpackcomp + '&souscrip=' + souscrip;
                    }
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: donnees,
                        beforeSend: function () {
                            $(".loader").removeClass('hidden');
                            $(".btn_active").addClass('hidden');
                        },
                        success: function () {
                            $.ajax({
                                url: './datadetailssouscription.php?id=' + site,
                                type: 'POST',
                                data: donnees,
                                success: function (data) {
                                    //alert(data);
                                    $('#tb_contenu').empty().append(data);
                                }
                            });
                            bool = true;
                        }, complete: function () {
                            if (bool) {
                                $(".loader").addClass('hidden');
                                $(".btn_active").removeClass('hidden');
                            } else {
                                $(".loader").removeClass('hidden');
                            }
                        }
                    });

                });
                $('#btnsend').click(function (e) {
                    e.preventDefault();
                    var donnees = $('#formsend').serialize();
                    $.ajax({
                        url: '../traitement/envoie_mail.php',
                        type: 'POST',
                        data: donnees,
                        success: function (data) {
                            if (data.message_succes == 'succes') {

                                $('#msg').show().fadeOut(8000)
                                        .addClass('alert-success')
                                        .removeClass('alert-danger');
                                $('#msg_alert').text("Votre message a été envoyé avec succès!");
                            } else if (data.message_erreur == 'erreur') {
                                $('#msg').show().fadeOut(8000)
                                        .addClass('alert-danger')
                                        .removeClass('alert-success');
                                $('#msg_alert').text("Echec d'envoi")
                            }

                        }, dataType: 'json'
                    });
                });
                // MAJ SOUSCRIPTION
                //Activation souscription
                 $("#conteneur").on('click','.btn_actve_scrpt', function (e) {
                    e.preventDefault();
                    var donnees=$('.frm_souscription').serialize();
                    $.ajax({
                        url: '../production/souscription_ctrl.php?action=reactiver&ajx=1',
                        type: 'POST',
                        data: donnees,
                        success: function (data){
                            $('#conteneur').html(data);
                            //alert(data);
                        }
//                        , dataType: 'json'
                    });
                });
                //Desactivation souscription
                 $("#conteneur").on('click','.btn_bloque_scrpt', function (e) {
                    e.preventDefault();
                    var donnees=$('.frm_souscription').serialize();
                    $.ajax({
                        url: '../production/souscription_ctrl.php?action=bloquer&ajx=1',
                        type: 'POST',
                        data: donnees,
                        success: function (data){
                            $('#conteneur').html(data);
                        }
//                        , dataType: 'json'
                    });
                });
                
                $("#conteneur").on('click', '#btn_paie_scrpt',function(e){
                    e.preventDefault();
                    var bool = false;
                    var donnees = $('.f_modal_paiement').serialize();
                    $.ajax({
                         url: '../production/souscription_ctrl.php?action=payer&ajx=1',
                        type: 'POST',
                        data: donnees,
                        beforeSend: function () {
                            $(".loader").removeClass('hidden');
                            $(".btn_cache").addClass('hidden');
                        },
                        success: function(data){
                            if(data.succes){
                              $("#div_message").addClass('hidden');
                              $("#spetat").text('Payée');
                               $("#mode").text(data.mode);
                               $("#num_recu").text(data.num_recu);
                               $("#dtepaie").text(data.dtepaie);
                               $("#btnpaidscrpt").addClass('hidden');
                               $(".detailspaie").removeClass('hidden');
                              $("#myModalreglement").modal('hide');
                            }else{
                              $("#div_message").removeClass('hidden'); 
                              $("#message").text(data.message); 
                            }
                            bool = true; 
                        },complete: function(){
                            if (bool) {
                                $(".loader").addClass('hidden');
                                $(".btn_cache").removeClass('hidden');
                            }else {
                                $(".loader").removeClass('hidden');
                            }
                        },
                        dataType: 'json'
                    });

                });
            });
        </script>
        <script src="../../js/paiement.js"></script>
        <script src="./jsparametrage.js"></script>
        <!-- /Traitement -->
    </body>
</html>