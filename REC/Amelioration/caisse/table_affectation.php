<?php
session_start();
include("../../bdd/connexion.php");
$id_res = $_GET['id_res'];
$requete = $bdd->prepare("SELECT R.idreserv,R.est_responsable,C.id_client,C.nom_client,S.id_ch,S.num_ch FROM t_client AS C, t_chambre AS S,t_reserve_chambre R WHERE R.id_client=C.id_client AND R.idchambre=S.id_ch AND R.statut='occupe' AND R.idreserv=:id_res AND S.id_hotel=:id_hotel ORDER BY R.idchambre");
$requete->BindParam(':id_res', $id_res);
$requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
$requete->execute();
$items = $requete->fetchAll(PDO::FETCH_OBJ);
?>
<div class="ln_solid"></div>
<table width="400" border="1" class="table table-bordered table-condensed table-striped">
    <tr>
        <th>N°</th>
        <th>Client</th>
        <th>Chambre</th>
        <th>Action</th> 

    </tr>  
    <?php $j=1;
    foreach ($items as $i) {
        ?>
        <tr >
            <td><?php echo $j; ?></td>
            <td><?php echo $i->nom_client; ?></td>
            <td><?php echo $i->num_ch; ?></td>
            <td>
                <?php if ($i->est_responsable == 'oui') { ?>
                    <input class="responsabiliser btn btn-xs" id1="<?php echo $i->id_client; ?>" id2="<?php echo $i->id_ch; ?>" id3="<?php echo $i->idreserv; ?>" type="submit" name="button" id="button" value="Responsable" style=" background-color:red; color: #ffffff"/>
                <?php } else if ($i->est_responsable == 'non') { ?>
                    <input  class="responsabiliser btn btn-xs" id1="<?php echo $i->id_client; ?>" id2="<?php echo $i->id_ch; ?>" id3="<?php echo $i->idreserv; ?>" type="submit" name="button" id="button" value="Responsable"/>
                    <input class="desaffecter btn btn-xs" id1="<?php echo $i->id_client; ?>" id2="<?php echo $i->id_ch; ?>" id3="<?php echo $i->idreserv; ?>"  type="submit" name="button" id="button" value="Desaffecter" />
                <?php } ?>

            </td> 
        </tr>  
    <?php $j++; }
    ?>

</table>
<script src="../js/jquery.js"></script>                             
<script>
    $(document).ready(function () {
        $(".responsabiliser").click(function () {
            var donnees = '';
            var id1 = $(this).attr("id1");
//        alert(id1);
            var id2 = $(this).attr("id2");
//        alert(id2);
            var id3 = $(this).attr("id3");
//        alert(id3);
            $.ajax({
                url: 'Traitement_reservation/responsabiliser.php?id_client=' + id1 + "&id_ch=" + id2 + "&idreserv=" + id3,
                type: 'POST',
                data: donnees,
                success: function (data) {
                    $('#div_affectation').empty().append(data);
                }
            });
            return false;
        });

        $(".desaffecter").click(function () {
            var donnees = '';
            var id_client = $(this).attr("id1");
            var id_ch = $(this).attr("id2");
            var idreserv = $(this).attr("id3");
            $.post('Traitement_reservation/desaffecter.php',
                    {
                        id_client: id_client,
                        id_ch: id_ch,
                        idreserv: idreserv

                    }, function (json) {
//            		$('#id_client').empty();
//                        alert($('#id_client').val());
//				$.each(json, function(index, value) {
//                       $('#id_client').append('<option value="'+ index +'">'+ value +'</option>');
//                 });
//					alert('Attribution chambre reussie!');

            },
                    'json');
            var donnees = '';
            $.ajax({
                url: 'Traitement_reservation/table_affectation.php?id_res=' + idreserv,
                type: 'POST',
                data: donnees,
                success: function (data) {
//                alert(data);
                    $('#div_affectation').empty().append(data);

                }
            });
            var donnees = '';
            $.ajax({
                url: 'Traitement_reservation/maj_form_occup.php?id_res=' + idreserv,
                type: 'POST',
                data: donnees,
                success: function (data) {
//            alert(data);
                    $('#data_occupa').empty().append(data);

                }
            });
//        var donnees = '';
//        $.ajax({
//            url: 'Traitement_reservation/maj_client_reserve.php?id_res='+idreserv,
//            type: 'POST',
//            data: donnees,
//            success: function (data) {
////            alert(data);
//            $('#id_client').empty().append(data);
//
//            }
//        });
//         var donnees = '';
//        $.ajax({
//            url: 'Traitement_reservation/maj_ch_reserve.php?id_res='+idreserv,
//            type: 'POST',
//            data: donnees,
//            success: function (data) {
////            alert(data);
//            $('#id_chambre').empty().append(data);
//
//            }
//        });
            return false;
        });
    });
</script>   							