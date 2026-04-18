$(document).ready(function (event) {

    // alert("bonjour");
    $('#next').on('click', function (e) {
        //alert("bonjournext");
        var adresse;
        var phone;
        var rccm;
        var num_impot;
        var ville;
        var cb;
        var id_nat;
        var mention;
        var logo;
        var mail;
        // adresse=$('#adresse').val();
        // phone=$('#phone').val();
        // rccm=$('#rccm').val();
        // num_impot=$('#num_impot').val();
        // ville=$('#ville').val();
        // cb=$('#cb').val();
        // id_nat=$('#id_nat').val();
        // mention=$('#mention').val();
        // logo=$('#logo').val();
        // if (adresse==''|| phone==''|| rccm==''|| num_impot==''|| ville==''|| cb==''|| id_nat==''|| mention==''|| logo=='') {
        //  $('#msg').empty().append('Veuillez remplir les champs vides!').show().fadeOut(4000);
        //  if (adresse=='') $("#adresse").css("border-color","red");
        //  if (phone=='') $("#phone").css("border-color","red");
        //  if (rccm=='') $("#rccm").css("border-color","red");
        //  if (num_impot=='')$("#num_impot").css("border-color","red");
        //  if (ville=='')$("#ville").css("border-color","red");
        //  if (cb=='')$("#cb").css("border-color","red");
        //  if (id_nat=='')$("#id_nat").css("border-color","red");
        //  if (logo=='')$("#logo").css("border-color","red");

        // }else{ }
//        if (!($('#tc1111').prop('checked'))) {
//            $('#msg').empty().append('Veuillez cocher Termes & conditions!').show().fadeOut(4000);
//            //$("#tc").css("border-color","red");
//
//        } else {
//            e.preventDefault();
//            $('.reglage').show();
//            $('.entreprise').hide();
//        }
        
        e.preventDefault();
            $('.reglage').show();
            $('.entreprise').hide();


    });
    $('#precedent').on('click', function (e) {
        // alert("bonjourprecedent");
        e.preventDefault();
        $('.reglage').hide();
        $('.entreprise').show();
    });
    
    $('#save').on('click', function (e) {
        var adresse;
        var phone;
        var rccm;
        var num_impot;
        var ville;
        var cb;
        var id_nat;
        var mention;
        var logo;
        var mail;
         adresse=$('#adresse').val();
         phone=$('#phone').val();
         rccm=$('#rccm').val();
         num_impot=$('#num_impot').val();
         ville=$('#ville').val();
         cb=$('#cb').val();
         id_nat=$('#id_nat').val();
         mention=$('#mention').val();
         logo=$('#logo').val();
         if (adresse==''|| phone==''|| rccm==''|| num_impot==''|| ville==''|| cb==''|| id_nat==''|| mention==''|| logo=='') {
          $('#msg').empty().append('Veuillez remplir les champs vides!').show().fadeOut(4000);
          if (adresse=='') $("#adresse").css("border-color","red");
          if (phone=='') $("#phone").css("border-color","red");
          if (rccm=='') $("#rccm").css("border-color","red");
          if (num_impot=='')$("#num_impot").css("border-color","red");
          if (ville=='')$("#ville").css("border-color","red");
          if (cb=='')$("#cb").css("border-color","red");
          if (id_nat=='')$("#id_nat").css("border-color","red");
          if (logo=='')$("#logo").css("border-color","red");
    }

});
});