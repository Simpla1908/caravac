// JavaScript Document
$(document).ready(function () {
    // alert('bonjour2');
    function effacerfc1(){
        
       $(':input','#form').not(':button,:submit,:reset,:hidden,\n\
                               #optionsRadiosInline,#monnaie,#datebonentre,#optbanque,#beneficiaire,#libelle,#motif,#numBordereau')
               .val('')
               .removeAttr('checked')
               .removeAttr('selected');
     }
    $(".fc").hide();
    $(".usd").hide();

    $("#monnaie").change(onSelectChange);

    function onSelectChange() {
        var selected = $("#monnaie option:selected");
        if (selected.val() == 'fc') {
            $("#montantUSD").val(' ');
            $("#montantFC2").val(' ');
            $(".fc").show();
            $(".usd").hide();
            
            $("#changer_input").load('../Traitement/changer_input.php');
            $(".fc2").hide();
            
        }
        else if (selected.val() == 'usd') {
            $("#montantFC2").val(' ');
            $("#montantFC1").val(' ');
            $(".fc").hide();
            $(".fc2").hide();
            $(".usd").show();
        }
        else if (selected.val() == 'fc&usd') {
            $("#montantFC1").val(' ');
            $(".fc").hide();
            $(".fc2").show();
            $(".usd").show();
        }else{
            $("#montantFC1").val(' ');
            $("#montantFC2").val(' ');
            $("#montantUSD").val(' ');
            $(".fc").hide();
            
            $(".fc2").hide();
            
            $(".usd").hide();
            
        }
    }

});
  