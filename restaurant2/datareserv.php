<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../bdd/connexion.php';
?>
  <div class="row" id="box_reserv">
            <div class="col-lg-12" style="overflow: auto; height:400px;">
                <?php
                $tables=array();
                $requete = $bdd->prepare("SELECT  *,cl.type AS type_cl FROM  t_client AS cl WHERE cl.id_hotel=:hotel_id AND cl.type='table' AND cl.statut='libre' AND cl.pseudo_supp=0  ORDER BY cl.id_client ASC");
                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                $requete->execute();
                $tables = $requete->fetchAll(PDO::FETCH_OBJ);
                //Pour la recherche
                $_SESSION['TableResto'] = array();
                $_SESSION['TableResto']['name'] = array();
                $_SESSION['TableResto']['content'] = array();
                //Pour la recherche

                foreach ($tables as $tbl):
                $designation=$tbl->designation;
                $other='<span
                    class="label label-success">'.$tbl->statut.'</span>';

                array_push($_SESSION['TableResto']['name'],$designation);

                $_SESSION['TableResto']['content'][$designation]='<a class="btn btn-app btnreserv" des="'.$designation.'" ids="'.$tbl->id_client.'">
                '.ucfirst($designation).'<br>'.$other.'</a>';
                echo $_SESSION['TableResto']['content'][$designation];
                endforeach; ?>

            </div>
            <!-- /.col-lg-12 -->
        </div>
 
   <script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>
    <script>
    $(document).ready(function() {

        $("#box_reserv").on('click', '.btnreserv', function() {
            var id= $(this).attr('ids');
            var des= $(this).attr('des');

            $("#table_id").val(id);
            $("#table_des").val(des);
            $("#modal_reserv_confirm").modal('show');
            $("#myModal_reserv").modal('hide');
          
            return false;
        });
        
    });
    </script>