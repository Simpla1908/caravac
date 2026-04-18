<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../bdd/connexion.php';
global $etat_table;
global $etat_table;
global $designation;
global $id_sousresto;
global $user_attente;
global $id_fact;
global $other;
global $idfactcl;
global $appear_state;
$idfactcl= 58;
//global $test; AND fa.id_fact=:id_fact 
?>
<div class="row">
    <div class="col-lg-12" style="overflow: auto; height:400px;">
        <?php
        $tables = array();
        $user_attente = $_SESSION['id_user'];
        $type_cl = 'table';
        // AND fa.date_edition=CURRENT_DATE()
        $requete = $bdd->prepare("SELECT  * FROM  t_client AS cl,t_facture AS fa WHERE cl.id_hotel=:hotel_id AND cl.type=:type_cl AND cl.en_attente=1  
                AND cl.id_client=fa.id_client AND fa.etat_cmd =1 AND fa.fusion=0 AND fa.appear_state=1  ORDER BY cl.designation ASC ");
        $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
        $requete->BindParam(':type_cl', $type_cl);
      //  $requete->BindParam(':id_fact', $idfactcl);
        $dones = $requete->execute();
        $tables = $requete->fetchAll(PDO::FETCH_OBJ);
        //Pour la recherche
        $_SESSION['TableResto'] = array();
        $_SESSION['TableResto']['name'] = array();
        $_SESSION['TableResto']['content'] = array();
        //Pour la recherche
        foreach ($tables as $tbl) :
            $etat_table = $tbl->statut;
            $designation = $tbl->designation;
            $id_sousresto = $tbl->idsousdepotfact;
            $user_attente = $tbl->user_attente;
            $test = $tbl->id_fact;
            if ($tbl->en_attente == 1) {
                $etat_table = 'occupe';
            }
            $other = "";
            if ($tbl->statut == 'reserve') {
                $other = '<span
                    class="label label-warning">' . $tbl->statut . '</span>';
            } elseif ($tbl->en_attente == 1) {
                $other = '<span
                    class="label label-danger">occupe</span>';
            } else {
                $other = '<span
                    class="label label-success">' . $tbl->statut . '</span>';
            }

            array_push($_SESSION['TableResto']['name'], $designation);

            $_SESSION['TableResto']['content'][$designation] = '<a class="btn btn-app tabtransfert1"
                                                                     id1="' . $tbl->id_client . '"
                                                                     id2="' . $designation . '"
                                                                     id_fact="' . $id_fact . '"
                                                                     nbrcouvert ="' . $tbl->nbrcouvert . '"
                                                                     etat_table="' . $etat_table . '"
                                                                     id_sousresto="' . $id_sousresto . '"
                                                                     user_attente="' . $user_attente . '">
                    ' . ucfirst($designation) . '<br>' . $other . '</a>';
            echo $_SESSION['TableResto']['content'][$designation];
        //  print_r($_SESSION['TableResto']['content'][$designation]);

        //   print_r($_SESSION['TableResto']['content'][$designation][$id_fact]);
        endforeach;



        ?>

    </div>
    <!-- /.col-lg-12 -->
</div>