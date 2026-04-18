<!-- jQuery -->
<script src="datepicker/jquery.js"></script>
<script src="datepicker/jquery.datetimepicker.js"></script>
<script>
    $('#datebonentre').datetimepicker();
    $('#datedebut').datetimepicker();
    $('#datefin').datetimepicker();
    $('#datejour').datetimepicker();
    $('#date_rapport').datetimepicker(
        {
            format: "d/m/Y"
        }
    );
    $('#date_PF').datetimepicker(
        {
            format: "d/m/Y"
        }
    );
    $('#date1').datetimepicker({format: 'd/m/Y'});
    $('#date2').datetimepicker({format: 'd/m/Y'});
</script>
<script src="js/jquery.js"></script>
<script type="text/javascript">

      $(".myselect").select2();

</script>
<script src="js/jquery-2.2.3.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

<script src="js/plugins/select2/select2.full.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
        $('#dataTables-example1').dataTable();
        $('#dataTables-example2').dataTable();
        $('#dataTables-example3').dataTable();
        $('#dataTables-example4').dataTable();
        $('#dataTables-example5').dataTable();
        $('#dataTables-example55').dataTable();
        $('#dataTables-example6').dataTable();
        $('#dataTables-example22').dataTable();
        $('#dataTables-example12').dataTable();
        
    });
</script>
<script src="js/aparut_disparut_champ_bordereau.js"></script>
<script src="js/aparut_disparut_champ_monnaie.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/caisse.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#table_analyse').load('tableau_analyse_caisse.php');
        $('#valider').click(function () {
            var valider = $('#valider').val();
            var annee = $('#annee option:selected').val();
            if (annee == "Année") {
                //$('#msg').show(). fadeOut(4000);
                $('#msg').show();

            }
            else {
                $.ajax({
                    url: 'tableau_analyse_caisse.php',
                    async: true,
                    type: 'POST',
                    data: "valider=" + valider + "&annee=" + annee,
                    global: false,
                    cache: false,
                    success: function (html) {
                        $("#table_analyse").empty().append(html);
                    }
                });

            }

            return false;
        });

$('#btn_appro_prev').click(function (e) {
            e.preventDefault();
            var bool=false;
            var datedebut=$('#date1').val();
            var datefin=$('#date2').val();
            var donnees = $('#form').serialize();
            $.ajax({
                url: 'appro_affichage.php',
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                    $("#loader").removeClass('hidden');
                    $("#btn_appro_prev").addClass('hidden');
                },
                success: function (data) {
//                    alert(data);
                    $("#titre").empty().html(' du '+ datedebut+' au '+datefin);
                    $('#dataappro').empty().append(data);
                    $('#p_debut').val(datedebut);
                    $('#p_fin').val(datefin);
                    $("#approvmodal").modal('hide');
                    bool=true;

                },complete: function () {
                    if (bool) {
                        $("#loader").addClass('hidden');
                         $("#btn_appro_prev").removeClass('hidden');
                    } else {
                        $("#loader").removeClass('hidden');
                    }
                }
            });

         });
$('#tabsortie').click(function (e) {
e.preventDefault();
$('#typesorti').val(0);
});  
$('#tabtransfert').click(function (e) {
e.preventDefault();
$('#typesorti').val(1);
});  
$('#btn_sorti_prev').click(function (e) {
            e.preventDefault();
            var bool=false;
            var datedebut=$('#date1').val();
            var datefin=$('#date2').val();
            var typesorti=$('#typesorti').val();
            var donnees = $('#form').serialize();
            var url='sorti_affichage.php';
            var datacontent='#datasorti';
            if(typesorti==1){
            url='transfert_affichage.php';
            datacontent='#datatransfert';
            }
            $.ajax({
                url: url,
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                    $("#loader").removeClass('hidden');
                    $("#btn_sorti_prev").addClass('hidden');
                },
                success: function (data) {
                    $("#titre").empty().html(' du '+ datedebut+' au '+datefin);
                    $(datacontent).empty().append(data);
                    $('#p_debut').val(datedebut);
                    $('#p_fin').val(datefin);
                    $("#sortimodal").modal('hide');
                    bool=true;

                },complete: function () {
                    if (bool) {
                        $("#loader").addClass('hidden');
                         $("#btn_sorti_prev").removeClass('hidden');
                    } else {
                        $("#loader").removeClass('hidden');
                    }
                }
            });

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
                //    alert(data);
                    bool=true;
                     if (data.message_erreur =='yes') {
                        $('#msg_grp').empty().append('Veuillez entrer les valeurs correctes!').show().fadeOut(4000);
                    } else if (data.message_erreur =='no') {       
                       location.href='approvisionnement_liste.php?msgapbr=1';
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

   $('.quantite_change').keyup(function (e) {
    e.preventDefault();
    var id = $(this).attr("validate");
    var qte2 = $("#qteR"+id).val();
    var qte1 = $("#qteE"+id).val();
    var dif=qte1-qte2;
    $("#ecrat"+id).text(dif);
    });

    });
</script>

<script>
  $(function () {
    //Initialize Select2 Elements
    //$(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
 
  
  $("#searchfam_id").change(function(e){
        var donnees = ' ';
        var idfamille = $('#searchfam_id').val();
        $.ajax({
            url: './Traitement/listprodbyFamille.php?famille_id='+idfamille,
            type: 'POST',
            data: donnees,
            success: function (data) {
                $('#article').html(data);
            }
        });

        return false;
   });

   $("#searchfam_id2").change(function(e){
        var donnees = ' ';
        var idfamille = $('#searchfam_id2').val();
        $.ajax({
            url: './Traitement/listprodbyFamille.php?famille_id='+idfamille,
            type: 'POST',
            data: donnees,
            success: function (data) {
                $('#article2').html(data);
            }
        });

        return false;
   });
</script>
      