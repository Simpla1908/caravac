<?php
session_start();
include('Traitement/cl_tbl.php');
?>                                                         
<div class="panel panel-default box" style="overflow: auto; height: 700px;">
    <ol class="breadcrumb">
        <li>
            <?php if(in_array('VLTR', $_SESSION['actions']['code_actions'])){ ?>
            <a href="#" id="fermer_tab">
                <i class="fa fa-mail-reply-all fa-2x"></i><b>  Liste des tables</b></a>
            <?php }elseif(in_array('TBLOCP', $_SESSION['actions']['code_actions'])){ ?>
                <a href="#">
                    <b>  Liste des tables</b></a>
             <?php } ?>
        </li>
    </ol>
    <div class="box-body">
        <div class="row">
            <div class="col-lg-12 listetable_client" id="produit1">
                <?php
                foreach ($tables as $tbl):
                    $etat_table = $tbl->statut;
                    if ($tbl->en_attente == 1) {
                        $etat_table = 'occupe';
                    }
                    ?>
                    <a class="btn btn-app client_table"
                       id1="<?php echo $tbl->id_client; ?>"
                       id2="<?php echo $tbl->designation; ?>"
                       etat_table="<?php echo $etat_table; ?>">
                        <?php echo ucfirst($tbl->designation); ?><br>
                            <?php if ($tbl->statut == 'reserve') { ?>
                            <span
                                class="label label-warning"><?php echo $tbl->statut ?></span>
                            <?php } elseif ($tbl->en_attente == 1) { ?>
                            <span
                                class="label label-danger"><?php echo 'occupe' ?></span>
                        <?php } else { ?>
                            <span
                                class="label label-success"><?php echo $tbl->statut ?></span>
                    <?php } ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.box -->
</div>
<script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script>
    $(document).ready(function () {
       $(".panel_client_table").on('click', '.client_table', function () {
        //c'est l'id du client ou table selectionné
        var table_id = $(this).attr("id1");
        var type_client = $(this).attr("tp-cl");
        var clresto = $(this).attr("clresto");
        var etat_table = $(this).attr("etat_table");
        if(etat_table=='occupe'){
            var id2 = $(this).attr("id2");
            $.ajax({
                url: 'Traitement/ticket_datas2.php?table_id='+table_id,
                async: true,
                type: 'POST',
                global: false,
                cache: false,
                success: function (html) {
                    $("#cl_chxi").empty().append(id2);
                    $('#affiche_commandes').empty().append(html);
                    $("#c1").show();
                    $("#c3").hide();
                    $("#id_cmd").val($("#id4x").val());
                    $("#client_id1").val(table_id);
                    $("#idfactcl").val($("#id4x").val());
                    $("#attente").val('attente');
                    $("#type_client").val($("#id5x").val());
                    $("#dte_edite").val($("#id6x").val());

                }
            });
        }else{
            var id1 = $(this).attr("id1");
            var type_client = $(this).attr("tp-cl");
            var clresto = $(this).attr("clresto");
            $(".tycl").val(type_client);
            $("#type_client").val(type_client);
            $("#clresto").val(clresto);
            $("#client_id").val(id1);
            $("#client_id1").val(id1);
            //c'est le nom du client ou table selectionné
            var id2 = $(this).attr("id2");
            $("#cl_chxi").empty().append(id2);
            $("#nom_client").val(id2);
            //c'est id de la table t_reserve_chambre
            id4 = $(this).attr("id4");
            id5 = $(this).attr("id5");//id reservation
            $("#res_ch_id3").val(id4);
            $("#reservechambre_id").val(id4);
            $("#id_res").val(id5);
            $("#idrescl").val(id5);
            $("#id_client").val(id1);
            $("#c1").show();
            $("#c2").hide();
            $("#msd_attente").hide();
        }
        
    });
    })
</script>