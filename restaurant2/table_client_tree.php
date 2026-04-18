<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 2 | Top Navigation</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
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
        <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    </head>
    <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="wrapper">

            <div class="content-wrapper">

                <div class="row">
                    <div class="col-md-12">
                        <div id="messagesAlert"></div>
                        <div class="nav-tabs-custom" >

                            <div class="tab-content">
                                <div class="active tab-pane fade in" id="tab1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-lg-10">
                                                <h2 class="page-header">AdminLTE Custom Tabs</h2> 
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="btn btn-default"><i class="ion-chevron-left"></i><i class="ion-chevron-left"></i> Annuler</button>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-12">
                                                    <!-- Custom Tabs -->
                                                    <div class="nav-tabs-custom">
                                                        <ul class="nav nav-tabs">
                                                            <li class="active"><a href="#tab_1" data-toggle="tab">Tables</a></li>
                                                            <li><a href="#tab_2" data-toggle="tab">Clients</a></li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="tab_1">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="panel panel-default">
                                                                            <div class="panel-heading">
                                                                                <h4>Liste des tables</h4>
                                                                            </div>
                                                                            <!-- /.panel-heading -->
                                                                            <div class="panel-body">
                                                                                <table id="example1" class="table table-bordered table-striped table-hover">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Rendering engine</th>
                                                                                            <th>Browser</th>
                                                                                            <th>Platform(s)</th>
                                                                                            <th>Engine version</th>
                                                                                            <th>CSS grade</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td>Trident</td>
                                                                                            <td>Internet
                                                                                                Explorer 4.0
                                                                                            </td>
                                                                                            <td>Win 95+</td>
                                                                                            <td> 4</td>
                                                                                            <td>X</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Trident</td>
                                                                                            <td>Internet
                                                                                                Explorer 5.0
                                                                                            </td>
                                                                                            <td>Win 95+</td>
                                                                                            <td>5</td>
                                                                                            <td>C</td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                    <tfoot>
                                                                                        <tr>
                                                                                            <th>Rendering engine</th>
                                                                                            <th>Browser</th>
                                                                                            <th>Platform(s)</th>
                                                                                            <th>Engine version</th>
                                                                                            <th>CSS grade</th>
                                                                                        </tr>
                                                                                    </tfoot>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- /.tab-pane -->
                                                            <div class="tab-pane" id="tab_2">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="panel panel-default">
                                                                            <div class="panel-heading">
                                                                                <h4>Liste des clients</h4>
                                                                            </div>
                                                                            <!-- /.panel-heading -->
                                                                            <div class="panel-body">
                                                                                <table id="example1" class="table table-bordered table-striped table-hover">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Rendering engine</th>
                                                                                            <th>Browser</th>
                                                                                            <th>Platform(s)</th>
                                                                                            <th>Engine version</th>
                                                                                            <th>CSS grade</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td>Trident</td>
                                                                                            <td>Internet
                                                                                                Explorer 4.0
                                                                                            </td>
                                                                                            <td>Win 95+</td>
                                                                                            <td> 4</td>
                                                                                            <td>X</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Trident</td>
                                                                                            <td>Internet
                                                                                                Explorer 5.0
                                                                                            </td>
                                                                                            <td>Win 95+</td>
                                                                                            <td>5</td>
                                                                                            <td>C</td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                    <tfoot>
                                                                                        <tr>
                                                                                            <th>Rendering engine</th>
                                                                                            <th>Browser</th>
                                                                                            <th>Platform(s)</th>
                                                                                            <th>Engine version</th>
                                                                                            <th>CSS grade</th>
                                                                                        </tr>
                                                                                    </tfoot>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- /.tab-pane -->
                                                            <!-- /.tab-pane -->
                                                        </div>
                                                        <!-- /.tab-content -->
                                                    </div>
                                                    <!-- nav-tabs-custom -->
                                                </div>
                                                <!-- /.col -->

                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- ./wrapper -->

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
        <script type="text/javascript" src="js/resto.js"></script>
    </body>
</html>
