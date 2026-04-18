<!-- jQuery -->
    <script src="../datepicker/jquery.js"></script>
    <script src="../datepicker/jquery.datetimepicker.js"></script>
    <script>
    $('#datetimepicker6').datetimepicker();
    $('#datetimepickerOcc').datetimepicker();
    $('#datetimepickerLib').datetimepicker();

        $('#datetimepicker1').datetimepicker({
    format: 'hh:mm:ss',
    allowInputToggle: true
});
    </script>
    <!-- Authentification -->
    <script src="../js_auth/jquery.js"></script>
    <script src="../Authentification/control_userAjax.js"></script>
    <!-- Reservation -->
    <script src="Traitement_reservation/verification_reservation.js"></script>
    <script src="Traitement_reservation/script_paie.js"></script>
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../bootstrap.timepicker/js/bootstrap-timepicker.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

     <!-- DataTables JavaScript -->
    <script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>



    <!-- Custom Theme JavaScript -->
    <script src="../js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>

    <script type="text/javascript">
        $('#timepicker2').timepicker({
            minuteStep: 1,
            showSeconds: true,
            showMeridian: false,
            defaultTime: false
        });

        $('#timepicker1').timepicker({
            minuteStep: 1,
            showSeconds: true,
            showMeridian: false,
            defaultTime: false
        });

        $('#checkin').timepicker({
            minuteStep: 1,
            showSeconds: true,
            showMeridian: false,
            defaultTime: false
        });

        $('#checkout').timepicker({
            minuteStep: 1,
            showSeconds: true,
            showMeridian: false,
            defaultTime: false
        });
    </script>

<!-- validator -->

