<?php
// Inclusion du fichier contenant la connexion à la base
require './Amelioration/bdd/connexion .php';
include('Receptionniste.php');
include('headerRec.php');
include('menu_Rec.php');
?>
<div id="page-wrapper">
    <div class="col-lg-12">
        <h3 class="page-header">Rapport caisse</h3>
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-dashboard fa-fw"></i>Rapport du jour</a>
                    </li>
                    <li><a href="#profile" data-toggle="tab"><i class="fa fa-calendar fa-fw"></i>Rapport périodique</a>
                    </li>
                   <!-- <li><a href="#messages" data-toggle="tab"><i class="fa fa-history fa-fw"></i>Rapport historique</a>
                    </li>-->
                    <li><a href="#settings" data-toggle="tab"></a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="home">
                        <br>
                        <?php if ($_SESSION['libe_droit'] == 'Gerant Global') { ?>
                            <div class="row">
                                <br>
                                <form role="form" action="./Amelioration/caisse/caisse_global.php" method="GET">
                                    <div class="col-lg-4">
                                        <fieldset>
                                            <div class="form-group" >
                                                <select id="id_hotel" class="form-control" name="id_hotel">
                                                    <option value="0">Situation globale</option>
                                                    <?php
                                                    include("./Amelioration/caisse/caisse_hotel.php");
                                                    foreach ($hotels as $h):
                                                        echo '<option value=' . $h->id_hotel . '>' . $h->nom_hotel . '</option>';
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                    </div> 
                                    <div class="col-lg-4">
                                        <button type="submit" class="btn btn-primary" id="btn_valider_encours">Valider</button>
                                        </fieldset>

                                    </div>
                                </form>            

                            </div>
                        <?php } ?>
                        <div class="row div_caisse">

                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" style="padding-left:30px;">
                        <br>
                        <div class="row">
                            <form role="form">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <?php if ($_SESSION['libe_droit'] == 'Gerant Global') { ?>
                                                <br>
                                                <select id="id_hotel_p" class="form-control" name="id_hotel">
                                                    <option value="0">Situation globale</option>
                                                    <?php
                                                    include("./Amelioration/caisse/caisse_hotel.php");
                                                    foreach ($hotels as $h):
                                                        echo '<option value=' . $h->id_hotel . '>' . $h->nom_hotel . '</option>';
                                                    endforeach;
                                                    ?>
                                                </select>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Date debut&nbsp;:</label>
                                            <input class="form-control" id="date_d" name="date_d" required="required">
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Date fin&nbsp;:</label>
                                            <input class="form-control" id="date_f" name="date_f" required="required">
                                        </div>
                                    </div>
                                    <div class="col-lg-4" style="margin-top:22px;">
                                        <button type="submit" class="btn btn-primary" id="btn_valider_perio">Valider</button>
                                    </div>
                                </div>
                            </form>            

                        </div>
                        <div class="row div_caisse_perio">

                        </div> 

                    </div>
                    <div class="tab-pane fade" id="messages">
                        <br>
                        
                        <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example1">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Date</th>
                                            <th>Entrée</th>
                                            <th>Agent</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="gradeX">
                                            <td>Misc</td>
                                            <td>Links</td>
                                            <td>Text only</td>
                                            <td>Text only</td>
                                        </tr>
                                        <tr class="gradeX">
                                            <td>Misc</td>
                                            <td>Lynx</td>
                                            <td>Text only</td>
                                            <td>Text only</td>
                                        </tr>
                                        <tr class="gradeC">
                                            <td>Misc</td>
                                            <td>IE Mobile</td>
                                            <td>Windows Mobile 6</td>
                                            <td>Text only</td>
                                        </tr>
                                        <tr class="gradeC">
                                            <td>Misc</td>
                                            <td>PSP browser</td>
                                            <td>PSP</td>
                                            <td>Text only</td>
                                        </tr>
                                        <tr class="gradeU">
                                            <td>Other browsers</td>
                                            <td>All others</td>
                                            <td>-</td>
                                            <td>Text only</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr class="gradeU">
                                            <th colspan="2">Total</th>
                                            <th>2500</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        
                        
                        
                        
                        <?php if ($_SESSION['libe_droit'] == 'Gerant Global') { ?>
                            <div class="row">
                                <br>
                                <form role="form">
                                    <div class="col-lg-4">
                                        <fieldset>
                                            <div class="form-group" >
                                                <select id="id_hotel_h" class="form-control" name="id_hotel">
                                                    <option value="0">Situation globale</option>
                                                    <?php
                                                    include("./Amelioration/caisse/caisse_hotel.php");
                                                    foreach ($hotels as $h):
                                                        echo '<option value=' . $h->id_hotel . '>' . $h->nom_hotel . '</option>';
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                    </div> 
                                    <div class="col-lg-4">
                                        <button type="submit" class="btn btn-primary" id="btn_valider_histo">Valider</button>
                                        </fieldset>

                                    </div>
                                </form>            

                            </div>
                        <?php } ?>
                        <div class="row div_caisse_histo1">
                            
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.panel-body -->
        </div>

    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script src="datepicker/jquery.js"></script>
<script src="datepicker/jquery.datetimepicker.js"></script>
<script>
    $('#date_d').datetimepicker();
    $('#date_f').datetimepicker();
</script>

<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function () {
//        alert('gghh');
        $(".div_caisse_histo").load('./Amelioration/caisse/caisse_global_histo.php');
        $(".div_caisse").load('./Amelioration/caisse/caisse_global.php?id_hotel=0');
        $('#dataTables-example1').dataTable();
        $("#btn_valider_encours").click(function (e) {
            e.preventDefault();
            var donnees = " ";
            var id_hotel = $('#id_hotel').val();
//                    alert(id_hotel);
            $.ajax({
                url: './Amelioration/caisse/caisse_global.php?id_hotel=' + id_hotel,
                type: 'POST',
                data: donnees,
                success: function (html) {
                    $(".div_caisse").empty().append(html);
//                              alert(html);

                }
            });
        });
        $("#btn_valider_perio").click(function (e) {
            e.preventDefault();
            var donnees = " ";
            var id_hotel = $('#id_hotel_p').val();
            var date_d = $('#date_d').val();
            var date_f = $('#date_f').val();
//                    alert(date_d+date_f);
            $.ajax({
                url: './Amelioration/caisse/caisse_global_perio.php?id_hotel=' + id_hotel + "&date_d=" + date_d + "&date_f=" + date_f,
                type: 'POST',
                data: donnees,
                success: function (html) {
                    $(".div_caisse_perio").empty().append(html);
//                              alert(html);

                }
            });
        });
        $("#btn_valider_histo").click(function (e) {
            e.preventDefault();
            var donnees = " ";
            var id_hotel = $('#id_hotel_h').val();
            $.ajax({
                url: './Amelioration/caisse/caisse_global_histo.php?id_hotel=' + id_hotel,
                type: 'POST',
                data: donnees,
                success: function (html) {
                    $(".div_caisse_histo").empty().append(html);
//                              alert(html);

                }
            });
        });


    });

</script>

