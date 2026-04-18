<?php
session_start();
include('../../bdd/connexion.php');
$adresse = $_POST['adresse'];
$phone = $_POST['phone'];
$rccm = $_POST['rccm'];
$num_impot = $_POST['num_impot'];
$ville = $_POST['ville'];
$mail = $_POST['mail'];
$id_nat = $_POST['id_nat'];
//$mention = $_POST['mention'];
$cb = $_POST['cb'];
$id_c = $_SESSION['company_id'] ;
$user_id = $_SESSION['id_user'] ;
//$mi = $_POST['monnaie_prix'];
//$ma = $_POST['monnaie_fac'];
//$tva = $_POST['tva'];
//$rmz = $_POST['rmz'];
//$taux = $_POST['taux'];
//$checkin = $_POST['checkin'];
//$checkout = $_POST['checkout'];
if (empty($adresse) ||empty($phone) ||empty($rccm) ||empty($num_impot) ||empty($ville) ||empty($mail) ||empty($id_nat) ||empty($cb)) {
    header('Location:../tableaudebordRec.php?msg=vide');
} else {
//selection nom_company
    $requete = $bdd->prepare("SELECT nom_c FROM  t_company  WHERE id_c=:company_id");
    $requete->BindParam(':company_id', $id_c);
    $requete->execute();
    $company_nom = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($company_nom as $c) $nom_c = $c->nom_c;
    //upoload logo
    
    //$extension= pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
    $file_name = $_FILES['logo']['name'];
    $extension = strrchr($file_name, ".");
    move_uploaded_file($_FILES['logo']['tmp_name'], '../images/logo_entreprise/' . basename($_FILES['logo']['name']));
    $stocklogo = 'logo_' . $nom_c . $id_c . $extension;
    rename('../images/logo_entreprise/' . basename($_FILES['logo']['name']), '../images/logo_entreprise/' . $stocklogo);
    
    //mise a jour table company
    $requete = $bdd->prepare("UPDATE t_company SET adresse_c=:adresse_c,logo=:logo,idnat=:idnat,rccm=:rccm,mail_company=:mail_company,ville=:ville,phone=:phone,num_impot=:num_impot,cb=:cb WHERE id_c=:id_c");
    $requete->BindParam(':adresse_c', $adresse);
    $requete->BindParam(':logo', $stocklogo);
    $requete->BindParam(':idnat', $id_nat);
    $requete->BindParam(':rccm', $rccm);
    $requete->BindParam(':mail_company', $mail);
    $requete->BindParam(':ville', $ville);
    $requete->BindParam(':phone', $phone);
    $requete->BindParam(':num_impot', $num_impot);
    $requete->BindParam(':cb', $cb);
    $requete->BindParam(':id_c', $id_c);
    $requete->execute();
    
    //recuperation id_hotel(id_site) et insertion  dans reglage
    $requete = $bdd->prepare("SELECT id_hotel FROM  t_hotel  WHERE company_id=:company_id");
    $requete->BindParam(':company_id', $id_c);
    $requete->execute();
    $hotel = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($hotel as $h) $id_hotel = $h->id_hotel;
    
    //mise a jour table site
    $requete = $bdd->prepare("UPDATE t_hotel SET adresse_hotel=:adresse_hotel,ville_hotel=:ville_hotel,idnat=:idnat,rccm=:rccm,mail=:mail,phone=:phone,num_impot=:num_impot,cb=:cb,image=:image WHERE id_hotel=:id_hotel");
    $requete->BindParam(':adresse_hotel', $adresse);
    $requete->BindParam(':ville_hotel', $ville);
    $requete->BindParam(':idnat', $id_nat);
    $requete->BindParam(':rccm', $rccm);
    $requete->BindParam(':mail', $mail);
    $requete->BindParam(':phone', $phone);
    $requete->BindParam(':num_impot', $num_impot);
    $requete->BindParam(':cb', $cb);
    $requete->BindParam(':image', $stocklogo);
    $requete->BindParam(':id_hotel', $id_hotel);
    $requete->execute();
    
    //mise a jour table utilisateur
    $requete = $bdd->prepare("UPDATE  t_utilisateur SET fconnect=:fconnect WHERE id_user=:id_user");
    $fconnect = 1;
    $requete->BindParam(':fconnect', $fconnect);
    $requete->BindParam(':id_user', $user_id);
    $requete->execute();
    $_SESSION['fconnect'] = 1;
    
    //mise en session des donnees
    $_SESSION['entreprise'] = $_SESSION['nom_hotel'];
    $_SESSION['adresse'] = $adresse;
    $_SESSION['phone'] = $phone;
    $_SESSION['rccm'] = $rccm;
    $_SESSION['num_impot'] = $num_impot;
    $_SESSION['ville'] = $ville;
    $_SESSION['mail'] = $mail;
    $_SESSION['id_nat'] = $id_nat;
    $_SESSION['stocklogo'] = $stocklogo;
    $_SESSION['id_hotel'] = $id_hotel;
    $_SESSION['cb']=$cb;
    header('location:../tableaudebordRec.php');
}