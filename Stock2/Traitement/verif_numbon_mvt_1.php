<?php
function verif_numbon_mvt_1($numbon,$numbon_ex) {
    include('../bdd/connexion.php');
     $requete = $bdd->prepare("SELECT num_bon FROM  stk__mouvement WHERE num_bon<>:num_bon_ex AND hotel_id=:hotel_id");
     $requete->BindParam(':num_bon_ex',$numbon_ex);
     $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
     $requete->execute();
     $numbons = $requete->fetchAll(PDO::FETCH_OBJ);
     $existe = 0;
     foreach ($numbons as $n) {
//     echo $n->num_bon;
     if ($numbon==$n->num_bon) {
     $existe = 1;
     break;
                                }
                                }
    return $existe;
}
