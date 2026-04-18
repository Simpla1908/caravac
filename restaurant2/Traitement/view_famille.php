<?php
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
include('../bdd/connexion.php');
$plat=1;                        
$requete = $bdd->prepare("SELECT * FROM  stk_famille AS f"
                      . " WHERE f.hotel_id=:hotel_id AND f.plat=:plat ORDER BY idfamille DESC");

$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':plat', $plat);
$requete->execute();
$familles = $requete-> fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" type="text/css" href="../datepicker/jquery.datetimepicker.css">
        
    </head>
    <body>
        <div id="annule"></div>
        <div class="table-responsive">
        <table id="table" class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Désignation</th>
                    <th>Vente</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($familles as $fam):
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $fam->designation ?></td>
                        <?php if($fam->affichage==1){?>
                        <td><input type="checkbox" name="affichage_famille" class="affichage_famille" id="<?php echo $fam->idfamille ?>" value="<?php echo $fam->idfamille?>" checked="checked"></td>
                        <?php }else{?>
                        <td><input type="checkbox" name="affichage_famille" class="affichage_famille" id="<?php echo $fam->idfamille ?>" value="<?php echo $fam->idfamille?>"></td>
                         <?php }?>
                        <td>
                            <a href="./details_config_plat.php?detail=famille&id=<?php echo $fam->idfamille ?>" class="edit_famille"><span class="label label-success"><i class="fa fa-eye"></i> Voir</span></a>
                        </td>
                    </tr>
                    <?php
                    $i++;
                endforeach;
                ?>
            </tbody>
        </table>
            </div>

        <!-- Date time picker -->
        <script src="../datepicker/jquery.js"></script>
        <script src="../datepicker/jquery.datetimepicker.js"></script>
        <script>
        $(document).ready(function() {
            
            
            $('.affichage_famille').click(function (e) {
                var idfamille, affichage;
                idfamille = $(this).val();
                if ($(this).is(":checked")) {
                    idfamille = $(this).attr('id');
                    affichage = 1;
                    $.ajax({
                        url: 'Traitement/famille_change_statut.php',
                        async: true,
                        type: 'POST',
                        data: "idfamille=" + idfamille + "&affichage=" + affichage,
                        global: false,
                        cache: false,
                        success: function (html) {
                            $("#view_famille").load('./Traitement/view_famille.php');
                        }
                    });
                } else {
                    idfamille = $(this).attr('id');
                    affichage = 0;
                    $.ajax({
                        url: 'Traitement/famille_change_statut.php',
                        async: true,
                        type: 'POST',
                        data: "idfamille=" + idfamille + "&affichage=" + affichage,
                        global: false,
                        cache: false,
                        success: function (html) {

                        }
                    });
                }


            });
            
            var id;
            $(".confirmModalSuppr").click(function (e) {
                e.preventDefault();
                id = $(this).attr("id");
//                alert(id);
//                $(".myModalEdit").modal("show");
            });
            $("#confirmModalYesdel").click(function (e) {
                $.ajax({
                    url: 'Traitement/prod_rmv.php?id=' + id,
                    type: 'POST',
                    success: function (html) {
                        window.location.href ="pages_actions.php?page=plat";
                    }
                });
//                $("#view_plat").load('./Traitement/view_plat.php');
//                $(".myModalSuppr").modal("hide");
        //window.location.href ="approvisionnement_view.php?operation=appro";

            });
            
            var id;
        $(".confirmModalEdit").click(function () {
            id = $(this).attr("id");
            $("#ajout").hide();
            $("#modif").show();
//            window.location.href ="pages_actions.php?page=plat&&id_pro="+id;
//            alert(id);
        });
            
            $("#edit_produit").click(function (e) {
                e.preventDefault();
                $(".myModalEdit").modal('hide');
        //        alert('ok');
            });
            
            
            
            $('.dateres').datetimepicker(); 
            $('#annule a').click(function () {
                var donnees = '';
                var table_res_id = $(this).attr('id');       
//                alert(table_res_id);

                
                $.ajax({
                    url: 'Traitement/annulation_reservation_table.php?table_res_id=' + table_res_id,
                    type: 'POST',
                    data: donnees,
                    success: function (data) {
//                        alert(data);
                    $("#view_table").load('./Traitement/view_table.php');
                    $("#reservation").load('./Traitement/ajout_reservation.php');
                    }
                });
                return false;


                });
            
        });
        </script>
    </body>
</html>