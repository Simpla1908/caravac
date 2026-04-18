// JavaScript Document .addpanier

$(document).ready(function () {

    $("#form_reservation_insert").submit(function (e) { // On sélectionne le formulaire par son identifiant
        e.preventDefault(); // Le navigateur ne peut pas envoyer le formulaire
        var date_res = $("#date_res").val();
        $.post('insert_reservation.php',
                {
                    date_res: date_res

                }, function (data) {

            alert(data);
        },
                'text');

    });
});