<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../bdd/connexion.php';
?>
  <div class="row" id="box_fusion">
            <div class="col-lg-12" style="overflow: auto; height:400px;">
                <?php
                $tables=array();
//                $user_attente =$_SESSION['id_user'];
//                $type_cl = 'table';
                $requete = $bdd->prepare("SELECT  *,cl.type AS type_cl FROM  t_client AS cl,t_facture AS fa WHERE cl.id_hotel=:hotel_id AND (cl.type='table') AND cl.en_attente=1 AND cl.fusion=0 AND cl.pseudo_supp=0 AND cl.id_client=fa.id_client AND fa.etat_cmd =1 AND fa.appear_state=1  ORDER BY cl.id_client ASC");
                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
//                $requete->BindParam(':type_cl', $type_cl);
//              $requete->BindParam(':user_attente', $user_attente);
                $requete->execute();
                $tables = $requete->fetchAll(PDO::FETCH_OBJ); 
                //Pour la recherche
                $_SESSION['TableResto'] = array();
                $_SESSION['TableResto']['name'] = array();
                $_SESSION['TableResto']['content'] = array();
                //Pour la recherche

                foreach ($tables as $tbl):
                $type_cl=$tbl->type_cl;
                $etat_table=$tbl->statut;
                $designation=$tbl->designation;
                if($type_cl=='client'){
                $designation=$tbl->nom_client;
                }
                $id_sousresto=$tbl->idsousdepotfact;
                $user_attente=$tbl->user_attente;
                $id_fact=$tbl->id_fact;
                $mont_ttc=$tbl->mont_ttc;
                $taux=$tbl->taux;

                $serveur_id=$tbl->serveur_id;
                $serveur_name=$tbl->serveur_name;
                if($tbl->en_attente==1){
                $etat_table='occupe';    
                }
                $other="";
                if ($tbl->statut == 'reserve') {
                $other='<span
                    class="label label-warning">'.$tbl->statut.'</span>';
                }elseif($tbl->en_attente==1) {
                $other='<span
                    class="label label-danger">occupe</span>';
                }else{
                $other='<span
                    class="label label-success">'.$tbl->statut.'</span>';
                }

                array_push($_SESSION['TableResto']['name'],$designation);

                $_SESSION['TableResto']['content'][$designation]='<a class="btn btn-app btncheckedfusion" ids="'.$tbl->id_client.'">
                <input type="checkbox" id="'.$tbl->id_client.'"
                name="TblOcc[]"
                value="'.$tbl->id_client.'"
                class="tbl_occ_class" 
                type_cl="'.$type_cl.'"
                id1="'.$tbl->id_client.'"
                id2="'.$designation.'"
                id_fact="'.$id_fact.'"
                mont_ttc="'.$mont_ttc.'"
                taux="'.$taux.'"
                nbrcouvert ="'.$tbl->nbrcouvert .'"
                etat_table="'.$etat_table.'"
                id_sousresto="'.$id_sousresto.'"
                user_attente="'.$user_attente.'"
                serveur_id="'.$serveur_id.'"
                serveur_name="'.$serveur_name.'"
                >
                '.ucfirst($designation).'<br>'.$other.'</a>';
                echo $_SESSION['TableResto']['content'][$designation];
                endforeach; ?>

            </div>
            <!-- /.col-lg-12 -->
        </div>
   <script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>
    <script>
    $(document).ready(function() {

        $("#box_fusion").on('click', '.btncheckedfusion', function() {
            var id= $(this).attr('ids');
            var select_a = '#' + id;
       
            if ($(select_a).prop('checked')) {
            $(select_a).prop("checked", false);    
            }else{
            $(select_a).prop("checked", true);    
            }
            return false;
        });
        
    });
    </script>