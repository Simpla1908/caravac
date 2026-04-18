
//Déconnexion automatique
function charger(){
    setTimeout(function(){
        $.ajax({
        url: '../deconnexion_auto.php',
        type: 'GET',
        success: function (data) {
//                    alert(data.bool);
            if(data.bool){
//                alert("ok");
                location.href = '../Authentification/logout.php';
            }

        }
        , dataType: 'json'
    });
        charger();
    }, 1800000);
}

charger();
// Fin Déconnexion automatique

$(function() {

    $('#side-menu').metisMenu();

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse')
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse')
        }

        height = (this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    })
});


$(document).ready(function (event) {

    // alert("bonjour");
    $('#btn_gratuit').on('click', function (e) {
//        alert("bonjournext");
        if (!($('.flat-red').is(":checked"))) {
            $('#msg').empty().append('Veuillez cocher au moin un module!').show().fadeOut(8000);
        } else {
            e.preventDefault();
            $('.appstore').hide();
            $('.entreprise').show();
        }
    });
    
    $('#precedent').on('click', function (e) {
        // alert("bonjourprecedent");
        e.preventDefault();
        $('.entreprise').hide();
        $('.appstore').show();
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