<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../bdd/connexion.php';
?>
  <div class="row">
            <div class="col-lg-12" style="overflow: auto; height:400px;">
                <?php
                $tables=array();
                $user_attente =$_SESSION['id_user'];
                $type_cl = 'table';
                $requete = $bdd->prepare("SELECT DISTINCT * FROM  t_client AS cl,t_facture AS fa WHERE cl.id_hotel=:hotel_id AND cl.type=:type_cl AND cl.en_attente=1 AND cl.user_attente=:user_attente AND cl.id_client=fa.id_client AND fa.etat_cmd =1 AND fa.fusion=0 ORDER BY cl.designation ASC");
                $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
                $requete->BindParam(':type_cl', $type_cl);
                $requete->BindParam(':user_attente', $user_attente);
                $requete->execute();
                $tables = $requete->fetchAll(PDO::FETCH_OBJ); 
                //Pour la recherche
                $_SESSION['TableResto'] = array();
                $_SESSION['TableResto']['name'] = array();
                $_SESSION['TableResto']['content'] = array();
                //Pour la recherche

                foreach ($tables as $tbl):
                $etat_table=$tbl->statut;
                $designation=$tbl->designation;
                $id_sousresto=$tbl->idsousdepotfact;
                $user_attente=$tbl->user_attente;
                $id_fact=$tbl->id_fact;
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

                $_SESSION['TableResto']['content'][$designation]='<a class="btn btn-app tabtransfert1"
                                                                     id1="'.$tbl->id_client.'"
                                                                     id2="'.$designation.'"
                                                                     id_fact="'.$id_fact.'"
                                                                     nbrcouvert ="'.$tbl->nbrcouvert .'"
                                                                     etat_table="'.$etat_table.'"
                                                                     id_sousresto="'.$id_sousresto.'"
                                                                     user_attente="'.$user_attente.'">
                    '.ucfirst($designation).'<br>'.$other.'</a>';
                echo $_SESSION['TableResto']['content'][$designation];
                endforeach; ?>

            </div>
            <!-- /.col-lg-12 -->
        </div>