<!-- jQuery -->
	<script src="../datepicker/jquery.js"></script>
	<script src="../datepicker/jquery.datetimepicker.js"></script>
    <script>
    $('#datetimepicker6').datetimepicker();
	$('#datetimepickerOcc').datetimepicker();
	$('#datetimepickerLib').datetimepicker();
    </script>

     <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-modal.js"></script>
    <script src="../js/bootstrap-datepicker.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <!-- Page-Level Demo Scripts - Notifications - Use for reference -->
    <script>
    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })

    // popover demo
    $("[data-toggle=popover]")
        .popover()
    </script>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
	
    </script>
   <!-- Authentification -->
	<script src="../js_auth/jquery.js"></script>
	<script src="../Authentification/control_userAjax.js"></script>
    <!-- Reservation -->
    <script src="Traitement_reservation/verification_reservation.js"></script>
    <script src="Traitement_reservation/script_paie.js"></script>
    
    <script type="text/javascript">


		
$("#mode").change(onSelectChange);

function onSelectChange(){
var selected = $("#mode option:selected");
$("#lb_justif").hide();
$("#justif").hide();
if(selected.val() != 0){
if(selected.val() == 1){
$("#lb_justif").show();
$("#justif").show();
}else{
$("#lb_justif").hide();
$("#justif").hide();
}
}


}


$("#dollar").on('click',function(){
$('input[name="dollard"]:checked').val();
/*$("#montantusd").show();*/
alert($('input[name="dollard"]:checked').val());
});

</script>


<script type="text/javascript">		

<!--Vérification des monaies-->

$("#monnaie").change(onSelectChange);

function onSelectChange(){
var selected = $("#monnaie option:selected");
$("#lb_montant").hide();
$("#lb_montantUSD").hide();
$("#lb_montantFC").hide();

$("#montant").hide();
$("#montantUSD").hide();
$("#montantFC").hide();

if(selected.val() != 0){
	if(selected.val() == 1 || selected.val() == 2){
		$("#lb_montant").show();
		$("#montant").show();
	}else{
		$("#lb_montant").hide();
		$("#montant").hide();
	}
	
	if(selected.val() == 3 ){
		$("#lb_montantUSD").show();
		$("#montantUSD").show();
		$("#lb_montantFC").show();
		$("#montantFC").show();
	}else{
		$("#lb_montantUSD").hide();
		$("#montantUSD").hide();
		$("#lb_montantFC").hide();
		$("#montantFC").hide();
	}
}


}

</script>

<script type="text/javascript">
$(document).ready(function() {
<!--$('#table_reservation').load('tableau_resume_reservation.php');-->
$('#valider').click(function() {
var valider=$('#valider').val();
var mois= $("#datetimepicker6").val();
var annee=$("#datetimepickerLib").val();
if(false){
$('#msg').show().fadeOut(4000);
$("#table_reservation").empty();

}
else{
$.ajax({
url:'tableau_resume_reservation.php',
async:true,
type:'POST',
data:"valider="+valider+"&mois="+mois+"&annee="+annee, 
global: false,
cache: false,
success: function(html){
$("#table_reservation").empty().append(html);
}
});

	}

return false;
});

});
</script>
<!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- jQuery Smart Wizard -->
    <script src="vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    <!-- Select2 -->
    <script src="vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
    <!-- Datatables -->
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- jQuery Smart Wizard -->
    <script>
      $(document).ready(function() {
          $('#datatable-responsive').DataTable();
        $('#wizard').smartWizard();

        $('#wizard_verticle').smartWizard({
          transitionEffect: 'slide'
        });

        $('.buttonNext').addClass('btn btn-success');
        $('.buttonPrevious').addClass('btn btn-primary');
        $('.buttonFinish').addClass('btn btn-default');
        
        $(".select2").select2();
        $('#birthday').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_4"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
        
        $(".select2_single").select2({
          placeholder: "Select a state",
          allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
          maximumSelectionLength: 4,
          placeholder: "With Max Selection limit 4",
          allowClear: true
        });
        
        
      });
    </script>
    <!-- /jQuery Smart Wizard -->
    
</body>

</html>